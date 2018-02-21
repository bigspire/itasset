<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
 
App::uses('Sanitize', 'Utility');
 
class HrvoiceController extends AppController {  
	
	public $name = 'HrVoice';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions','Excel');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Voice - HRIS - My PDCA');		
		// for export
		if($this->request->query['action'] == 'export'){
			// get users who have answered
			$options = array(	
				array('table' => 'hr_voice_user',
						'alias' => 'VoiceUser',					
						'type' => 'Left',
						'conditions' => array('`VoiceUser`.`hr_voice_id` = `HrVoice`.`id`')
				),
				array('table' => 'app_users',
						'alias' => 'Employee',					
						'type' => 'Left',
						'conditions' => array('`Employee`.`id` = `VoiceUser`.`app_users_id`')
				)
			);
			
			$data = $this->HrVoice->find('all', array('fields' => array('VoiceUser.app_users_id','Employee.first_name','Employee.last_name'),'conditions' => array('HrVoice.id' => $this->request->query['id']), 'group' => array('VoiceUser.app_users_id'), 'joins' => $options));
			$options = array(	
				array('table' => 'hr_voice_question',
						'alias' => 'VoiceQn',					
						'type' => 'INNER',
						'conditions' => array('`VoiceQn`.`hr_voice_id` = `HrVoice`.`id`')
				),				
				array('table' => 'app_users',
						'alias' => 'Employee',					
						'type' => 'Left',
						'conditions' => array('`Employee`.`id` = `VoiceQn`.`app_users_id`')
				)
			);	
			// extract each employee answers
			foreach($data as $result){
				$data = $this->HrVoice->find('all', array('fields' => array('VoiceQn.msg','VoiceQn.type','Employee.first_name','Employee.last_name'),'conditions' => array('HrVoice.id' => $this->request->query['id'], 'VoiceQn.app_users_id' => $result['VoiceUser']['app_users_id']), 
				'order' => array('VoiceQn.id' => 'asc'), 'joins' => $options, 'group' => array('VoiceQn.id')));
				//echo '<pre>'; print_r($data);die;
				$this->Excel->generate('voice', $data, $data, 'Report', 'Voice Report '.$result['Employee']['first_name'].' '.$result['Employee']['last_name'], 1);				
			}
			//print_r($data);
			
		}
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword'),'HrVoice'); 
			$this->redirect('/hrvoice/?'.$url_vars);					
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (HrVoice.desc) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}

		$options = array(	
			array('table' => 'hr_voice_user',
					'alias' => 'VoiceUser',					
					'type' => 'Left',
					'conditions' => array('`VoiceUser`.`hr_voice_id` = `HrVoice`.`id`')
			),
			array('table' => 'app_users',
					'alias' => 'Employee',					
					'type' => 'Left',
					'conditions' => array('`Employee`.`id` = `VoiceUser`.`app_users_id`')
			)
		);	
		
	
		// fetch the advances		
		$this->paginate = array('fields' => array('id','desc', "group_concat(Employee.first_name SEPARATOR ', ') as employee_name", 'start_date','end_date', 'count(VoiceUser.app_users_id) as person_ans',  'status','created_date'),'limit' => 10,'conditions' => array($keyCond, 'HrVoice.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'), 'group' => array('HrVoice.id'), 'joins' => $options);
		$data = $this->paginate('HrVoice');			
		$this->set('voice_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any voice', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to save the customer */
	public function create_voice(){ 
		// set the page title		
		$this->set('title_for_layout', 'Create Voice - HRIS - My PDCA');	
		if ($this->request->is('post')){ 
			// validates the form
			$this->HrVoice->set($this->request->data);			
			// validate file		
			if ($this->HrVoice->validates(array('fieldList' => array('desc','status','start_date','end_date')))) {
				$this->request->data['HrVoice']['created_date'] = $this->Functions->get_current_date();	
				$this->request->data['HrVoice']['created_by'] = $this->Session->read('USER.Login.id');
				$this->request->data['HrVoice']['start_date'] = $this->Functions->format_date_save($this->request->data['HrVoice']['start_date']);
				$this->request->data['HrVoice']['end_date'] = $this->Functions->format_date_save($this->request->data['HrVoice']['end_date']);
				// save the data
				if($this->HrVoice->save($this->request->data['HrVoice'], array('validate' => false))) {
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Voice created successfully', 'default', array('class' => 'alert alert-success'));
					$this->redirect('/hrvoice/');
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));
				}
			}else{
				//$errors = $this->HrVoice->validationErrors;
				//print_r($errors);
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
			}
		}
	}
	
	
		/* function to remove the options */
	public function remove_questions($id){
		$this->loadModel('HrSurveyQuestion');
		$this->HrSurveyQuestion->deleteAll(array('hr_voice_id' => $id), false);
	}

	/* function to get no. of questions */
	public function check_no_question(){
		$count = 0;
		for($i = 1; $i <= 10; $i++){
			if($this->request->data['HrVoice']['qn'.$i] != ''){
				$count++;
			}
		}
		return $count;
	}
	
	/* function to show poll options */
	public function save_questions($id, $data){ 
		$this->loadModel('HrSurveyQuestion');
		for($i = 1; $i <= 10; $i++){
			$option = $data['qn'.$i];
			if(!empty($data['qn'.$i])){
				$result = array('question' => $option, 'hr_voice_id' => $id);		
				// save the options
				$this->HrSurveyQuestion->create();				
				if($this->HrSurveyQuestion->save($result, true, $fieldList = array('question', 'hr_voice_id'))){
					
				}
			}		
		}
	}
	

		
		
	
	/* function to delete the adv. request */
	public function delete_voice($id){
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){		
				$this->HrVoice->id = $id;
				$this->HrVoice->saveField('is_deleted', 'Y'); 
				$this->HrVoice->saveField('modified_date', $this->Functions->get_current_date()); 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Voice deleted successfully', 'default', array('class' => 'alert alert-success'));			
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrvoice/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrvoice/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/hrvoice/');
	}
	
	
	/* function to edit the form */
	public function edit_voice($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit Voice - HRIS - My PDCA');
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// when the form submitted
				if (!empty($this->request->data)){ 
					// validates the form
					$this->HrVoice->set($this->request->data);					
					if ($this->HrVoice->validates(array('fieldList' => array('desc','status','end_date')))) {					
						$this->request->data['HrVoice']['modified_date'] = $this->Functions->get_current_date();
						$this->request->data['HrVoice']['modified_by'] = $this->Session->read('USER.Login.id');		
						$this->request->data['HrVoice']['start_date'] = $this->Functions->format_date_save($this->request->data['HrVoice']['start_date']);
						$this->request->data['HrVoice']['end_date'] = $this->Functions->format_date_save($this->request->data['HrVoice']['end_date']);
				
						// save the data
						if($this->HrVoice->save($this->request->data['HrVoice'])) {	
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Voice details modified successfully', 'default', array('class' => 'alert alert-success'));
							$this->redirect('/hrvoice/');		
						}else{
							// show the error msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));									
						}					
									
					}	
				}else{
					$this->request->data = $this->HrVoice->findById($id);
					$this->request->data['HrVoice']['start_date'] = $this->Functions->format_date_show($this->request->data['HrVoice']['start_date']);
					$this->request->data['HrVoice']['end_date'] = $this->Functions->format_date_show($this->request->data['HrVoice']['end_date']);
				
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrvoice/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrvoice/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/hrvoice/');		
		}		
		
	}
	
	/* function to get poll options */
	public function get_voice_question($id){
		// fetch poll options
		$this->loadModel('HrSurveyQuestion');
		$survey_qns = $this->HrSurveyQuestion->find('all', array('conditions' => array('hr_voice_id' => $id), 'order' => array('id' => 'asc'), 'fields' => array('question')));		
		$this->set('survey_question', $survey_qns);
	}
	

	/* function to auth record */
	public function auth_action($id){
		$data = $this->HrVoice->findById($id, array('fields' => 'id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['HrVoice']['is_deleted'] == 'Y'){
			return $data['HrVoice']['modified_date'];
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	

	
	/* function to view the adv. request */
	public function view_voice($id){
		// set the page title		
		$this->set('title_for_layout', 'View Voice - HRIS - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->HrVoice->findById($id);
				$this->set('voice_data', $data);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrvoice/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrvoice/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/hrvoice/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(98);
	}
	
	

	
	
	
}