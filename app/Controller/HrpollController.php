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
 
class HrpollController extends AppController {  
	
	public $name = 'HrPoll';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Poll - HRIS - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword'),'HrPoll'); 
			$this->redirect('/hrpoll/?'.$url_vars);					
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (HrPoll.ques) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}	
		
		$options = array(	
			array('table' => 'poll_options',
					'alias' => 'HrPollOption2',					
					'type' => 'INNER',
					'conditions' => array('`HrPollOption2`.`ques_id` = `HrPoll`.`id`')
			),
			array('table' => 'poll_votes',
					'alias' => 'HrPollVote',					
					'type' => 'LEFT',
					'conditions' => array('`HrPollVote`.`option_id` = `HrPollOption2`.`id`')
			)
		);
		
		$this->HrPoll->unBindModel(array('hasOne' => array('HrPollOption')));
		// fetch the advances		
		$this->paginate = array('fields' => array('id','ques', 'count(HrPollVote.id) as tot_votes', 'group_concat(distinct HrPollOption2.value) as options', 'status','created_on'),'limit' => 10,'conditions' => array($keyCond, 'HrPoll.is_deleted' => 'N'), 'order' => array('created_on' => 'desc'), 'group' => array('HrPoll.id', 'HrPollOption2.ques_id'), 'joins' => $options);
		$data = $this->paginate('HrPoll');			
		$this->set('poll_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any poll', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to save the customer */
	public function create_poll(){ 
		// set the page title		
		$this->set('title_for_layout', 'Create Poll - HRIS - My PDCA');	
		$this->set('correctAns', array('1' => 'Option 1', '2' => 'Option 2','3' => 'Option 3','4' => 'Option 4','5' => 'Option 5','6' => 'Option 6','7' => 'None'));
		if ($this->request->is('post')){ 
			// validates the form
			$this->HrPoll->set($this->request->data);			
			// validate file		
			if ($this->HrPoll->validates(array('fieldList' => array('ques','status','option1','option2','option3','answer')))) {
				$this->request->data['HrPoll']['created_on'] = $this->Functions->get_current_date();		
				// save the data
				if($this->HrPoll->save($this->request->data['HrPoll'], array('validate' => false))) {
					// save options
					$this->save_options($this->HrPoll->id, $this->request->data['HrPoll']);							
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Poll  created successfully', 'default', array('class' => 'alert alert-success'));
					$this->redirect('/hrpoll/');
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));
				}
			}else{
				//$errors = $this->HrPoll->validationErrors;
				//print_r($errors);
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
			}
		}
	}
	
	/* function to remove the options */
	public function remove_options($id){
		$this->HrPoll->HrPollOption->deleteAll(array('ques_id' => $id), false);
	}
	
	
	/* function to show poll options */
	public function save_options($id, $data){ 
		for($i = 1; $i <= 6; $i++){
			$option = $data['option'.$i];
			if(!empty($data['option'.$i])){
				$ans = $data['answer'] == $i ? 1 : '';				
				$result = array('ques_id' => $id, 'value' => $option, 'answer' => $ans);		
				// save the options
				$this->HrPoll->HrPollOption->create();				
				if($this->HrPoll->HrPollOption->save($result, true, $fieldList = array('ques_id', 'value','answer'))){
					
				}
			}		
		}
	}
	
	/* function to load view result */
	public function view_result($id){		
		$this->layout = 'iframe';
	}
	
	
		
		
	
	/* function to delete the adv. request */
	public function delete_poll($id){
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){		
				$this->HrPoll->id = $id;
				$this->HrPoll->saveField('is_deleted', 'Y'); 
				$this->HrPoll->saveField('modified_on', $this->Functions->get_current_date()); 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Poll deleted successfully', 'default', array('class' => 'alert alert-success'));			
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrpoll/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrpoll/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/hrpoll/');
	}
	
	
	/* function to edit the form */
	public function edit_poll($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit Poll - HRIS - My PDCA');
		$this->set('correctAns', array('1' => 'Option 1', '2' => 'Option 2','3' => 'Option 3','4' => 'Option 4','5' => 'Option 5','6' => 'Option 6','7' => 'None'));		
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// when the form submitted
				if (!empty($this->request->data)){ 
					// validates the form
					$this->HrPoll->set($this->request->data);					
					if ($this->HrPoll->validates(array('fieldList' => array('ques','status','option1','option2','option3','answer')))) {					
						$this->request->data['HrPoll']['modified_on'] = $this->Functions->get_current_date();		
						// save the data
						if($this->HrPoll->save($this->request->data['HrPoll'])) {	
							// remove the options
							$this->remove_options($id);
							$this->save_options($id, $this->request->data['HrPoll']);
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Poll details modified successfully', 'default', array('class' => 'alert alert-success'));
							$this->redirect('/hrpoll/');		
						}else{
							// show the error msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));									
						}					
									
					}	
				}else{
					$this->request->data = $this->HrPoll->findById($id);
					$this->get_poll_options($this->request->data['HrPoll']['id']);
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrpoll/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrpoll/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/hrpoll/');		
		}		
		
	}
	
	/* function to get poll options */
	public function get_poll_options($id){
		// fetch poll options
		$poll_options = $this->HrPoll->HrPollOption->find('all', array('conditions' => array('ques_id' => $id), 'order' => array('id' => 'asc'), 'fields' => array('value', 'answer')));		
		$this->set('correct', $this->get_correct_ans($poll_options));
		$this->set('poll_options', $poll_options);
	}
	
	/* function to get correct ans */
	public function get_correct_ans($options){		
		foreach($options as $key =>  $op){
			if($op['HrPollOption']['answer']){	 		
				return ++$key;
			}
		}
		return 7;
		
	}
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->HrPoll->findById($id, array('fields' => 'id','is_deleted','modified_on'));	
		// check the req belongs to the user
		if($data['HrPoll']['is_deleted'] == 'Y'){
			return $data['HrPoll']['modified_on'];
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	

	
	/* function to view the adv. request */
	public function view_poll($id, $tot_votes){
		// set the page title		
		$this->set('title_for_layout', 'View Poll - HRIS - My PDCA');
		$this->set('tot_votes', $tot_votes);
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->HrPoll->findById($id);
				$this->set('poll_data', $data);
				$this->get_poll_options($data['HrPoll']['id']);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrpoll/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrpoll/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/hrpoll/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(48);
	}
	
	

	
	
	
}