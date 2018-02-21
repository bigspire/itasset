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
 
class HrsurveyController extends AppController {  
	
	public $name = 'HrSurvey';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions','Excel');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Survey - HRIS - My PDCA');		
		// for export
		if($this->request->query['action'] == 'export'){
			// get users who have answered
			$options = array(	
				array('table' => 'hr_survey_user',
						'alias' => 'SurveyUser',					
						'type' => 'Left',
						'conditions' => array('`SurveyUser`.`hr_survey_id` = `HrSurvey`.`id`')
				),
				array('table' => 'app_users',
						'alias' => 'Employee',					
						'type' => 'Left',
						'conditions' => array('`Employee`.`id` = `SurveyUser`.`app_users_id`')
				)
			);
			
			$data = $this->HrSurvey->find('all', array('fields' => array('SurveyUser.app_users_id','Employee.first_name','Employee.last_name'),'conditions' => array('HrSurvey.id' => $this->request->query['id']), 'group' => array('SurveyUser.app_users_id'), 'joins' => $options));
			$options = array(	
				array('table' => 'hr_survey_question',
						'alias' => 'SurveyQn',					
						'type' => 'INNER',
						'conditions' => array('`SurveyQn`.`hr_survey_id` = `HrSurvey`.`id`')
				),
				array('table' => 'hr_survey_answer',
						'alias' => 'SurveyAns',					
						'type' => 'INNER',
						'conditions' => array('`SurveyAns`.`hr_survey_question_id` = `SurveyQn`.`id`')
				),
				array('table' => 'app_users',
						'alias' => 'Employee',					
						'type' => 'Left',
						'conditions' => array('`Employee`.`id` = `SurveyAns`.`app_users_id`')
				)
			);	
			// extract each employee answers
			foreach($data as $result){
				$data = $this->HrSurvey->find('all', array('fields' => array('SurveyQn.question','SurveyAns.answer','Employee.first_name','Employee.last_name'),'conditions' => array('HrSurvey.id' => $this->request->query['id'], 'SurveyAns.app_users_id' => $result['SurveyUser']['app_users_id']), 
				'order' => array('HrSurvey.id' => 'asc'), 'joins' => $options, 'group' => array('SurveyQn.id')));
				//echo '<pre>'; print_r($data);die;
				$this->Excel->generate('survey', $data, $data, 'Report', 'Survey Report '.$result['Employee']['first_name'].' '.$result['Employee']['last_name'], 1);				
			}
			//print_r($data);
			
		}
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword'),'HrSurvey'); 
			$this->redirect('/hrsurvey/?'.$url_vars);					
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (HrSurvey.desc) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}

		$options = array(	
			array('table' => 'hr_survey_user',
					'alias' => 'SurveyUser',					
					'type' => 'Left',
					'conditions' => array('`SurveyUser`.`hr_survey_id` = `HrSurvey`.`id`')
			),
			array('table' => 'app_users',
					'alias' => 'Employee',					
					'type' => 'Left',
					'conditions' => array('`Employee`.`id` = `SurveyUser`.`app_users_id`')
			)
		);	
		
		$this->HrSurvey->virtualFields = array('person_ans' => 'count(SurveyUser.app_users_id)');
	
		// fetch the advances		
		$this->paginate = array('fields' => array('id','desc', "group_concat(Employee.first_name SEPARATOR ', ') as employee_name", 'start_date','end_date', 'count(SurveyUser.app_users_id) as person_ans', 'no_question',  'status','created_date'),'limit' => 10,'conditions' => array($keyCond, 'HrSurvey.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'), 'group' => array('HrSurvey.id'), 'joins' => $options);
		$data = $this->paginate('HrSurvey');			
		$this->set('survey_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any survey', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to save the customer */
	public function create_survey(){ 
		// set the page title		
		$this->set('title_for_layout', 'Create Survey - HRIS - My PDCA');	
		if ($this->request->is('post')){ 
			// validates the form
			$this->HrSurvey->set($this->request->data);			
			// validate file		
			if ($this->HrSurvey->validates(array('fieldList' => array('qn1','qn2','qn3','qn4','desc','status','start_date','end_date')))) {
				$this->request->data['HrSurvey']['created_date'] = $this->Functions->get_current_date();	
				$this->request->data['HrSurvey']['created_by'] = $this->Session->read('USER.Login.id');
				$this->request->data['HrSurvey']['no_question'] = $this->check_no_question();	
				$this->request->data['HrSurvey']['start_date'] = $this->Functions->format_date_save($this->request->data['HrSurvey']['start_date']);
				$this->request->data['HrSurvey']['end_date'] = $this->Functions->format_date_save($this->request->data['HrSurvey']['end_date']);
				// save the data
				if($this->HrSurvey->save($this->request->data['HrSurvey'], array('validate' => false))) {
					// save options
					$this->save_questions($this->HrSurvey->id, $this->request->data['HrSurvey']);							
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Survey created successfully', 'default', array('class' => 'alert alert-success'));
					$this->redirect('/hrsurvey/');
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));
				}
			}else{
				//$errors = $this->HrSurvey->validationErrors;
				//print_r($errors);
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
			}
		}
	}
	
	
		/* function to remove the options */
	public function remove_questions($id){
		$this->loadModel('HrSurveyQuestion');
		$this->HrSurveyQuestion->deleteAll(array('hr_survey_id' => $id), false);
	}

	/* function to get no. of questions */
	public function check_no_question(){
		$count = 0;
		for($i = 1; $i <= 10; $i++){
			if($this->request->data['HrSurvey']['qn'.$i] != ''){
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
				$result = array('question' => $option, 'hr_survey_id' => $id);		
				// save the options
				$this->HrSurveyQuestion->create();				
				if($this->HrSurveyQuestion->save($result, true, $fieldList = array('question', 'hr_survey_id'))){
					
				}
			}		
		}
	}
	

		
		
	
	/* function to delete the adv. request */
	public function delete_survey($id){
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){		
				$this->HrSurvey->id = $id;
				$this->HrSurvey->saveField('is_deleted', 'Y'); 
				$this->HrSurvey->saveField('modified_date', $this->Functions->get_current_date()); 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Survey deleted successfully', 'default', array('class' => 'alert alert-success'));			
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrsurvey/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrsurvey/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/hrsurvey/');
	}
	
	
	/* function to edit the form */
	public function edit_survey($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit Survey - HRIS - My PDCA');
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// when the form submitted
				if (!empty($this->request->data)){ 
					// validates the form
					$this->HrSurvey->set($this->request->data);					
					if ($this->HrSurvey->validates(array('fieldList' => array('desc','status','qn1','qn2','qn3','qn4')))) {					
						$this->request->data['HrSurvey']['modified_date'] = $this->Functions->get_current_date();
						$this->request->data['HrSurvey']['modified_by'] = $this->Session->read('USER.Login.id');		
						$this->request->data['HrSurvey']['no_question'] = $this->check_no_question();
						$this->request->data['HrSurvey']['start_date'] = $this->Functions->format_date_save($this->request->data['HrSurvey']['start_date']);
						$this->request->data['HrSurvey']['end_date'] = $this->Functions->format_date_save($this->request->data['HrSurvey']['end_date']);
				
						// save the data
						if($this->HrSurvey->save($this->request->data['HrSurvey'])) {	
							// remove the options
							$this->remove_questions($id);
							$this->save_questions($id, $this->request->data['HrSurvey']);
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Survey details modified successfully', 'default', array('class' => 'alert alert-success'));
							$this->redirect('/hrsurvey/');		
						}else{
							// show the error msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));									
						}					
									
					}	
				}else{
					$this->request->data = $this->HrSurvey->findById($id);
					$this->get_survey_question($this->request->data['HrSurvey']['id']);
					$this->request->data['HrSurvey']['start_date'] = $this->Functions->format_date_show($this->request->data['HrSurvey']['start_date']);
					$this->request->data['HrSurvey']['end_date'] = $this->Functions->format_date_show($this->request->data['HrSurvey']['end_date']);
				
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrsurvey/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrsurvey/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/hrsurvey/');		
		}		
		
	}
	
	/* function to get poll options */
	public function get_survey_question($id){
		// fetch poll options
		$this->loadModel('HrSurveyQuestion');
		$survey_qns = $this->HrSurveyQuestion->find('all', array('conditions' => array('hr_survey_id' => $id), 'order' => array('id' => 'asc'), 'fields' => array('question')));		
		$this->set('survey_question', $survey_qns);
	}
	

	/* function to auth record */
	public function auth_action($id){
		$data = $this->HrSurvey->findById($id, array('fields' => 'id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['HrSurvey']['is_deleted'] == 'Y'){
			return $data['HrSurvey']['modified_date'];
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	

	
	/* function to view the adv. request */
	public function view_survey($id){
		// set the page title		
		$this->set('title_for_layout', 'View Survey - HRIS - My PDCA');
		$this->set('tot_votes', $tot_votes);
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->HrSurvey->findById($id);
				$this->set('survey_data', $data);
				$this->get_survey_question($data['HrSurvey']['id']);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrsurvey/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrsurvey/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/hrsurvey/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(96);
	}
	
	

	
	
	
}