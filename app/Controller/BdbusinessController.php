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
 
class BdbusinessController extends AppController {  
	
	public $name = 'BdBusiness';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions', 'Excel');
	
	public $layout = 'apps';

	public $spocUser, $bdAdmin;
	
	
	
	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$page_title = $this->request->query['type'] ? $this->Functions->get_biz_type($this->request->query['type']).' Business - ' : '';
		$this->set('title_for_layout', $page_title.'My Business - BD - My PDCA');		
				
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword','from','to','vertical','spoc','opportunity','priority',
			'spoc','opportunity','priority','sow','proposal_done','proposal_approve','work_status','agree_sign',
			'unread','type','srchSubmit','spot','source','work_complete','srchAdvance'),'BdBusiness'); 
			$this->redirect('/bdbusiness/?'.$url_vars);				
		}
		// load static drop downs
		$this->load_static_dropdown();
		// filter records based on admin and spoc
		if(!$this->bdAdmin && $this->Session->read('USER.Login.id') != '25'){ 
			// $userCond =  array('OR' => array ('Spoc.app_users_id' => $this->Session->read('USER.Login.id'),	'BdBusiness.app_users_id' => $this->Session->read('USER.Login.id')));
		}
		
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (BdBusiness.company_name,BdBusiness.project_name,District.district_name) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		// apply dofd date condition
		if($this->request->query['from'] != '' || $this->request->query['to'] != ''){
			$from = $this->request->query['from'] ?  $this->Functions->format_date_save($this->request->query['from']) : '2015-08-27';
			$to = $this->request->query['to'] ? $this->Functions->format_date_save($this->request->query['to']) : date('Y-m-d');
			//$dateCond = array('or' => array("date_format(BdHome.created_date, '%Y-%m-%d') between ? and ?" => array($from_date, $to_date)));		
			$dateCond = array('or' => array("BdBusiness.dofd between ? and ?" => array($from, $to)));
		}
		// for vertical condition
		if($this->request->query['vertical'] != ''){ 
			$verticalCond = array('BdBusiness.hr_business_unit_id' => $this->request->query['vertical']);
		}
		// for spoc condition
		if($this->request->query['spoc'] != ''){ 
			$spocCond = array('BdBusiness.bd_spoc_id' => $this->request->query['spoc']);
		}
		// for biz. opportunity condition
		if($this->request->query['opportunity'] != ''){ 
			$opporCond = array('bd_opportunity_id' => $this->request->query['opportunity']);
		}
		// for priority condition
		if($this->request->query['priority'] != ''){ 
			$priorCond = array('bd_priority_id' => $this->request->query['priority']);
		}
		// get sow done conditions		
		if($this->request->query['sow'] != ''){
			$sow_done = $this->request->query['sow'] == 2 ? '0' : $this->request->query['sow'];
			$sowCond = array('sow_done' => $sow_done);
		}
		// get proposal submitted conditions		
		if($this->request->query['proposal_done'] != ''){
			$proposal_done = $this->request->query['proposal_done'] == 2 ? '' : $this->request->query['proposal_done'];
			$psCond = array('proposal_done' => $proposal_done);
		}
		// get proposal approved conditions		
		if($this->request->query['proposal_approve'] != ''){
			$proposal_apr = $this->request->query['proposal_approve'] == 2 ? '' : $this->request->query['proposal_approve'];
			$paCond = array('proposal_approve' => $proposal_apr);
		}
		// get agreement sign conditions		
		if($this->request->query['agree_sign'] != ''){
			$sign = $this->request->query['agree_sign'] == 2 ? '' : $this->request->query['agree_sign'];
			$asCond = array('agreement_sign' => $sign);
		}
		
		// get work work start conditions		
		if($this->request->query['work_status'] != ''){
			$work_status = $this->request->query['work_status'] == 2 ? '' : $this->request->query['work_status'];
			$wsCond = array('work_start' => $work_status);
		}
		// get work work complete conditions		
		if($this->request->query['work_complete'] != ''){
			$work_comp = $this->request->query['work_complete'] == 2 ? '' : $this->request->query['work_complete'];
			$wcCond = array('work_complete' => $work_comp);
		}
		// get unread conditions
		if($this->request->query['unread'] == '1'){ 
			$readCond = array('Unread.id !=' => '');
			$this->set('unread_check', 'checked');
		}
		// for biz. type condition
		if($this->request->query['type'] != ''){ 
			$typeCond = array('BdBusiness.type' => $this->request->query['type']);
			$this->set('biz_type', $this->Functions->get_biz_type($this->request->query['type']));
		}
		// for spot by condition
		if($this->request->query['spot'] != ''){ 
			$spotCond = array('Spot.bd_spoc_id' => $this->request->query['spot']);
		}
		// for spot by condition
		if($this->request->query['source'] != ''){ 
			$sourceCond = array('BdBusiness.bd_business_source_id' => $this->request->query['source']);
		}
		$this->BdBusiness->unBindModel(array('belongsTo' => array('BdSpoc')));
		$options = array(
			array('table' => 'bd_spoc',
					'alias' => 'Spoc',	
					'type' => 'LEFT',
					'conditions' => array('`Spoc`.`id` = `BdBusiness`.`bd_spoc_id`')
			),
			array('table' => 'app_users',
					'alias' => 'Employee',	
					'type' => 'LEFT',					
					'conditions' => array('`Employee`.`id` = `Spoc`.`app_users_id`')
			),
			array('table' => 'bd_biz_read',
					'alias' => 'Unread',					
					'type' => 'LEFT',
					'conditions' => array('`Unread`.`bd_business_id` = `BdBusiness`.`id`',
					'Unread.app_users_id' => $this->Session->read('USER.Login.id'),
					'Unread.status' => 'U')
			),
			array('table' => 'app_users',
					'alias' => 'Approver',	
					'type' => 'LEFT',					
					'conditions' => array('`Approver`.`id` = `BdBusiness`.`approve_by`')
			),
			array('table' => 'bd_biz_reply',
					'alias' => 'ReviewRec',	
					'type' => 'LEFT',					
					'conditions' => array('`ReviewRec`.`bd_business_id` = `BdBusiness`.`id`')
			),
			array('table' => 'bd_business_spot',
					'alias' => 'Spot',	
					'type' => 'LEFT',					
					'conditions' => array('`Spot`.`bd_business_id` = `BdBusiness`.`id`')
			),
		);
		
		$this->BdBusiness->virtualFields = array('spoc' => 'Employee.first_name');

		// apply search field border
		$this->apply_border_color();
		
		// for export
		if($this->request->query['action'] == 'export'){			 
			$data = $this->BdBusiness->find('all', array('fields' => array('id','District.district_name', 'BdOpportunity.title','Creator.first_name','Creator.last_name','BdBusiness.type', 'Unread.id', 'Unread.created_date','BdPriority.id', 'Unread.modified_date', 'Unread.type','Employee.first_name','Employee.last_name','company_name',
			'dofd','BdBusiness.created_date','HrBusinessUnit.business_unit','Creator.first_name','Creator.last_name',
			'BdPriority.title', 'cb_share','proposal_approve','proposal_done', 'work_complete','sow_done','proposal_date','project_name','BdProposalVer.title','work_start',
			'agreement_sign','agreement_no','State.state_name','District.district_name','sow_detail','address','BdBizSource.title','referrer','work_complete'),
			'conditions' => array($userCond,$keyCond,$dateCond,$verticalCond,$spocCond,$opporCond,$priorCond,$sowCond,$psCond,$paCond,$asCond,
			$wsCond,$readCond,$typeCond,$sourceCond,$spotCond,$wcCond,'BdBusiness.is_deleted' => 'N', 'BdBusiness.status' => '1'),'order' => array('BdBusiness.created_date' => 'desc'),
			'group' => array('BdBusiness.id'), 'joins' => $options));
			if(!empty($data)){
				$this->Excel->generate('business', $data, $data, 'Report', 'Business Report');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no business to export', 'default', array('class' => 'alert alert'));	
			}
		}
		
		// fetch the advances		
		$this->paginate = array('fields' => array('id','is_approve','BdBusiness.type', 'count(ReviewRec.id) total_review', 'Approver.first_name', 'sow_done','proposal_done',
		'proposal_approve','agreement_sign','work_start', 'BdBusiness.status', 'work_complete', 'Spoc.app_users_id', 'Unread.id', 'District.district_name', 'Unread.created_date','BdPriority.id', 'Unread.modified_date', 'Unread.type','Employee.first_name','Employee.last_name','company_name',
		'dofd','BdBusiness.created_date','HrBusinessUnit.business_unit','Creator.first_name','Creator.last_name','BdPriority.title','approve_date','is_approve'),
		'limit' => 10,'conditions' => array($keyCond,$dateCond,$verticalCond,$spocCond,$opporCond,$priorCond,$sowCond,$psCond,$paCond,$asCond,
		$wsCond,$wcCond,$readCond,$typeCond,$userCond,$sourceCond,$spotCond,'BdBusiness.is_deleted' => 'N'),'group' => array('BdBusiness.id'), 'order' => array('BdBusiness.created_date' => 'desc'), 'joins' => $options);
		$data = $this->paginate('BdBusiness');			
		$this->set('business_data', $data);
		if(empty($data) && $this->request->query['action'] != 'export'){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no business', 'default', array('class' => 'alert alert'));	
		}
			

	}
	
	/* function to apply search form border */
	public function apply_border_color(){
		if($this->request->is('get')){
			$field_ar = array('keyword','from','to','vertical','spoc','opportunity','priority','type','sow',
			'proposal_done','proposal_approve','agree_sign','work_status','spot','source','work_complete');
			foreach($field_ar as $key => $val){	
				if($this->request->query[$val] != ''){
					$this->set('bdsrchSel'.++$key, 'bdsrchSel');
				}
			}			
		}
	}
	
	
	/* function to list the add  */
	public function add(){	
		// check bd spoc
			$this->set('title_for_layout', 'Add Business - My Business - BD - My PDCA');
			// load static drop downs
			$this->load_static_dropdown();
			if ($this->request->is('post')){
				// validates the form
				$this->BdBusiness->set($this->request->data);
				// retain form values
				$this->retain_form_radio();
				// validate file		
				if ($this->BdBusiness->validates(array('fieldList' => array('company_name','district_id','bd_opportunity_id','dofd','hr_business_unit_id','bd_priority_id','address')))) {
					$this->request->data['BdBusiness']['app_users_id'] = $this->Session->read('USER.Login.id');				
					$this->request->data['BdBusiness']['created_date'] = $this->Functions->get_current_date();
					$this->request->data['BdBusiness']['dofd'] = $this->Functions->format_date_save($this->request->data['BdBusiness']['dofd']);
					$this->request->data['BdBusiness']['proposal_date'] = $this->Functions->format_date_save($this->request->data['BdBusiness']['proposal_date']);
					$this->request->data['BdBusiness']['cb_share'] = $_POST['cb_share'];	
					$this->request->data['BdBusiness']['work_start'] = $_POST['work_start'];
					$this->request->data['BdBusiness']['work_complete'] = $_POST['work_comp'];					
					// reset the form based on condition
					$this->reset_int_form('sow_done', array('proposal_done','project_name','bd_proposal_version_id','upload_file','proposal_approve','proposal_date','agreement_no','agreement_sign','work_start', 'work_complete'));
					$this->reset_int_form('proposal_done', array('project_name','bd_proposal_version_id','upload_file','proposal_approve','proposal_date','agreement_no','agreement_sign','work_start', 'work_complete'));
					$this->reset_int_form('proposal_approve', array('agreement_no','agreement_sign','work_start', 'work_complete'));
					$this->reset_int_form('agreement_sign', array('agreement_no','work_start', 'work_complete'));
					$this->request->data['BdBusiness']['type'] = $this->update_biz_type();
					// update approver status
					if($this->bdAdmin){
						$this->request->data['BdBusiness']['status'] = '1';
					}else{
						$this->request->data['BdBusiness']['status'] = '0';
						$this->request->data['BdBusiness']['is_approve'] = 'W';
					}
					// save the data
					if($this->BdBusiness->save($this->request->data['BdBusiness'], array('validate' => false))){
						// upload the file
						if($file = $this->upload_attachment($this->request->data['BdBusiness']['upload_file'], $this->BdBusiness->id)){						
							$this->BdBusiness->saveField('proposal_doc', $file);
						}
						// save contact details
						$this->save_business_contact($this->BdBusiness->id);
						// save business spot
						$this->save_business_spot($this->BdBusiness->id);
						$this->loadModel('BdRead');
						$data = array('bd_business_id' => $this->BdBusiness->id, 'status' => 'R', 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $this->Session->read('USER.Login.id'));
						$this->BdRead->save($data, true, $fieldList = array('bd_business_id','created_date','app_users_id','status'));
						$this->BdRead->create();
						// save read status
						$this->save_read_status($this->BdBusiness->id);
						// send mail to spoc
						if($this->bdAdmin){
							$this->send_mail_user($this->request->data);
						}
						// show the msg.
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>New business created successfully', 'default', array('class' => 'alert alert-success'));
						$this->redirect('/bdbusiness/?type=N');
					}else{
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));
					}
				}else{
					//$errors = $this->BdBusiness->validationErrors;
					//print_r($errors);
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
				}
			}
		
	}
	
	
	/* send mail to spoc */
	public function send_mail_user($data, $approve){
		$spoc_details = $this->BdBusiness->BdSpoc->findById($data['BdBusiness']['bd_spoc_id'], array('fields' => 'HrEmployee.first_name',
		'HrEmployee.last_name','HrEmployee.email_address'));
		// when admin approves the biz.
		$status = $approve ? 'Approved' : 'Created';
		$sub = 'My PDCA - New Business '.$status.' By '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name'));
		$from = ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name'));
		$name = $spoc_details['HrEmployee']['first_name'].' '.$spoc_details['HrEmployee']['last_name'];
		$vars = array('from_name' => $from, 'name' => $name, 'status' => strtolower($status), 'company' => $data['BdBusiness']['company_name'],
		'location' => $this->BdBusiness->get_location($data['BdBusiness']['district_id']));
		// notify superiors						
		if(!$this->send_email($sub, 'notify_business', 'noreply@mypdca.in', $spoc_details['HrEmployee']['email_address'],$vars)){	
			// show the msg.								
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to finance...', 'default', array('class' => 'alert alert-error'));				
		}
	}
	
	/* function to download the file */
	public function download_proposal($file){		
		$this->download_file(WWW_ROOT.'/uploads/business/'.$file);
		die;
		
	}
	
	
	/* function to upload the file */
	public function upload_attachment($data, $id){
		// validate the file				
		if(!empty($data['tmp_name'])){
			$file = $id.'_'.$data['name']; 
			if($this->upload_file($data['tmp_name'], WWW_ROOT.'/uploads/business/'.$file)){
				return $file;
			}			
		}
				
	}
	
	/* function to save the read status */
	public function save_read_status($id){
		$this->loadModel('BdRead');
		// save the status for record owner				
		// disable for spoc user
		if($this->bdAdmin){
			$data = $this->get_spoc_user_id($id);
			$user_id = $data[0]['Spoc']['app_users_id'];
			// skip the same user
			if($user_id == $this->Session->read('USER.Login.id') && $this->request->data['BdBusiness']['app_users_id'] == $this->Session->read('USER.Login.id')){
				$status = 'R';
			}else{
				$status = 'U';
			}
			$data = array('bd_business_id' => $id, 'status' => $status, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $user_id);
			$this->BdRead->save($data, true, $fieldList = array('bd_business_id','created_date','app_users_id','status'));
			$this->BdRead->create();
		}
		$this->BdRead->create();
		// update other bd admin
		$this->loadModel('BdAdmin');
		$data = $this->BdAdmin->find('all', array('fields' => array('BdAdmin.app_users_id'), 'conditions' => array('BdAdmin.is_deleted' => 'N', 'BdAdmin.status' => '1',
		'BdAdmin.app_users_id !=' => $this->Session->read('USER.Login.id'))));
		foreach($data as $record){			
			$data = array('bd_business_id' => $id,'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $record['BdAdmin']['app_users_id']);
			$this->BdRead->save($data, true, $fieldList = array('bd_business_id','created_date','app_users_id'));
			$this->BdRead->create();			
		}
		
	}
	
	
	
	
	/* function to load the static tables */
	public function load_static_dropdown(){
		$this->set('statusVal', array('1' => 'Yes', '0' =>  'No'));
		$this->set('statusText', array('Y' => 'Yes', 'N' =>  'No'));
		$this->set('bizType', array('N' => 'New', 'E' =>  'Existing', 'O' => 'Old'));
		$this->set('bizOpportunity', $this->BdBusiness->get_opportunity());
		$bd_spoc_list = $this->BdBusiness->get_spoc_details();
		foreach($bd_spoc_list as $key => $value){ 
			$data_list[$value['BdSpoc']['id']] = $value['HrEmployee']['first_name'].' '.$value['HrEmployee']['last_name'];		
		}	
		$this->set('bizSpoc', $data_list);
		$this->set('propVersion', $this->BdBusiness->get_proposal_version());
		$this->set('bizPriority', $this->BdBusiness->get_business_priority());
		$this->set('bizVertical', $this->BdBusiness->get_business_vertical());
		$this->set('stateList', $this->BdBusiness->load_state());
		$this->set('bizSource', $this->BdBusiness->get_business_source());
		
	}
	
	/* function to load the districts */
	public function get_district_list($id){
		$this->set('districtList', $this->BdBusiness->load_district($id));
	}
	
	/* function to load the districts options */
	public function get_district(){
		$this->layout = 'ajax';		
		$this->BdBusiness->load_district_data($this->request->query['id']);
		$this->render(false);
		die;
	}
	
		/* function to edit the form */
	public function edit($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit Business - BD - My PDCA');
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->edit_auth_action($id);
			if($ret_value == 'pass'){
				// load static drop downs
				$this->load_static_dropdown();				
				// when the form submitted
				if (!empty($this->request->data)){ 
					// validates the form
					$this->BdBusiness->set($this->request->data);
					// retain form values
					$this->reset_int_form();
					// validate the data
					if ($this->BdBusiness->validates(array('fieldList' => $this->get_validation_field()))) {
						$this->request->data['BdBusiness']['modified_by'] = $this->Session->read('USER.Login.id');		
						$this->request->data['BdBusiness']['modified_date'] = $this->Functions->get_current_date();
						if($this->request->data['BdBusiness']['dofd'] != ''){
							$this->request->data['BdBusiness']['dofd'] = $this->Functions->format_date_save($this->request->data['BdBusiness']['dofd']);
						}
						$this->request->data['BdBusiness']['proposal_date'] = $this->Functions->format_date_save($this->request->data['BdBusiness']['proposal_date']);
							
						// update approver status
						if($this->request->data['BdBusiness']['is_approve'] == 'W'){
							$this->request->data['BdBusiness']['is_approve'] = 'A';
							$this->request->data['BdBusiness']['approve_by'] = $this->Session->read('USER.Login.id');
							$this->request->data['BdBusiness']['approve_date'] = $this->Functions->get_current_date();
							$this->request->data['BdBusiness']['status'] = 1;
							$this->send_mail_user($this->request->data, 'approved');
							$edit_status = 'approved';
						}else{
							$edit_status = 'modified';
						}
						$this->request->data['BdBusiness']['work_start'] = $_POST['work_start'];
						$this->request->data['BdBusiness']['work_complete'] = $_POST['work_comp'];
						// reset the form based on condition
						$this->reset_int_form('sow_done', array('proposal_done','project_name','bd_proposal_version_id','upload_file','proposal_approve','proposal_date','agreement_no','agreement_sign','work_start', 'work_complete'));
						$this->reset_int_form('proposal_done', array('project_name','bd_proposal_version_id','upload_file','proposal_approve','proposal_date','agreement_no','agreement_sign','work_start', 'work_complete'));
						$this->reset_int_form('proposal_approve', array('agreement_no','agreement_sign','work_start', 'work_complete'));
						$this->reset_int_form('agreement_sign', array('agreement_no','work_start', 'work_complete'));
						
						$this->request->data['BdBusiness']['type'] = $this->update_biz_type();
						// save the data
						if($this->BdBusiness->save($this->request->data['BdBusiness'], array('validate' => false))) {	
							// upload the file
							if($file = $this->upload_attachment($this->request->data['BdBusiness']['upload_file'], $this->BdBusiness->id)){						
								$this->BdBusiness->saveField('proposal_doc', $file);
							}
							// remove the contact data
							//$this->remove_biz_contact($id);
							// save the contact data
							$this->save_business_contact($id);
							// save business spot
							$this->remove_biz_spot($id);
							$this->save_business_spot($id);
							// save read status
							$this->update_read_status($id, 'M');
							// show the msg.							
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Business details '. $edit_status.' successfully', 'default', array('class' => 'alert alert-success'));
							$this->redirect('/bdbusiness/?type='.$this->request->query['type']);
						}else{
							// show the error msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));									
						}									
					}	
				}else{
					// get spoc for spoc user edit
					$options = array(
						array('table' => 'bd_spoc',
								'alias' => 'Spoc',					
								'type' => 'LEFT',
								'conditions' => array('`Spoc`.`id` = `BdBusiness`.`bd_spoc_id`')
						),
						array('table' => 'app_users',
								'alias' => 'Employee',					
								'type' => 'LEFT',
								'conditions' => array('`Employee`.`id` = `Spoc`.`app_users_id`')
						)
					);
					
					$this->BdBusiness->unBindModel(array('belongsTo' => array('BdSpoc','BdProposalVer','Creator')));
					$data = $this->BdBusiness->find('all', array('fields' => array('id','BdBusiness.app_users_id','project_name','company_name','dofd',
					'cb_share','sow_done','proposal_done','proposal_doc','HrBusinessUnit.business_unit', 'Employee.first_name','Employee.last_name','proposal_date','proposal_approve','agreement_no','agreement_sign','work_start',
					'bd_opportunity_id','hr_business_unit_id','bd_priority_id','bd_spoc_id','bd_proposal_version_id','BdOpportunity.title','BdPriority.title',
					'state_id','district_id','address','bd_business_source_id','referrer','sow_detail','BdBizSource.title', 'State.state_name','District.district_name','is_approve','work_complete'),
					'conditions' => array('BdBusiness.id' => $id), 'joins' => $options));
					$this->request->data = $data[0];
					$this->request->data['BdBusiness']['dofd']	= $this->Functions->format_date_show($this->request->data['BdBusiness']['dofd']);
					if(!empty($this->request->data['BdBusiness']['proposal_date'])){
						$this->request->data['BdBusiness']['proposal_date']	= $this->Functions->format_date_show($this->request->data['BdBusiness']['proposal_date']);
					}
					
					// get the contact details added by admin
					$this->get_contact_details($id, 'admin');
					
					if($this->spocUser && !$this->bdAdmin){ 
						// get contact details
						$this->get_contact_details($id, 'spoc');
					}
					
					// retain form values
					$this->retain_edit_form_radio($this->request->data['BdBusiness']);
					// get districts
					$this->get_district_list($this->request->data['BdBusiness']['state_id']);
					// get bd spot by
					if($this->bdAdmin){
						$this->get_biz_spot($id);
					}else{
						$this->get_biz_spot_user($id);
					}
					
					
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/bdbusiness/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/bdbusiness/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/bdbusiness/');		
		}		
		
	}
	
	/* function to reject the business */
	public function reject_business($id){
		$data = array('is_approve' => 'R', 'approve_by' => $this->Session->read('USER.Login.id'), 'approve_date' => $this->Functions->get_current_date(),
		'remark' => $this->request->query['remark']);	
		$this->BdBusiness->id = $id;
		if($this->BdBusiness->save($data, array('validate' => false))) {	
			/* send mail to spoc */
			$biz_details = $this->BdBusiness->findById($id, array('fields' => 'Creator.first_name',
			'Creator.last_name','Creator.email_address','company_name','dofd','District.district_name'));
			// when admin approves the biz.
			$status = 'Rejected';
			$sub = 'My PDCA - New Business '.$status.' By '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name'));
			$from = ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name'));
			$name = $biz_details['Creator']['first_name'].' '.$biz_details['Creator']['last_name'];
			$vars = array('from_name' => $from, 'name' => $name, 'status' => $status, 'company' => $biz_details['BdBusiness']['company_name'],
			'location' => $biz_details['District']['district_name'],'dofd' => $biz_details['BdBusiness']['dofd'], 'remark' => $this->request->query['remark']);
			
			// notify superiors						
			if(!$this->send_email($sub, 'notify_biz_reject', 'noreply@mypdca.in', $biz_details['Creator']['email_address'],$vars)){	
				// show the msg.								
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to user...', 'default', array('class' => 'alert alert-error'));				
			}
			// save read status
			$this->update_read_status($id, 'M');
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>New business rejected successfully', 'default', array('class' => 'alert alert-success'));
			$this->redirect('/bdbusiness/');	
		}
	}
	
	
	/* function to update business type */
	public function update_biz_type(){
		if($this->request->data['BdBusiness']['work_complete'] == '0'){
			return 'O';
		}else if($this->request->data['BdBusiness']['work_start'] == '1'){
			return 'E';
		}else{
			return 'N';
		}
	}
	
	/* function to get biz. spot */
	public function get_biz_spot_user($id){
		$this->loadModel('BdBizSpot');
		$options = array(
				array('table' => 'bd_spoc',
						'alias' => 'Spoc',					
						'type' => 'LEFT',
						'conditions' => array('`Spoc`.`id` = `BdBizSpot`.`bd_spoc_id`')
				),
				array('table' => 'app_users',
						'alias' => 'Employee',					
						'type' => 'LEFT',
						'conditions' => array('`Employee`.`id` = `Spoc`.`app_users_id`')
				)
			);
		$data = $this->BdBizSpot->find('all', array('fields' => array('Employee.first_name','Employee.last_name'), 
		'conditions' => array('bd_business_id' => $id), 'joins' => $options));
		foreach($data as $record){
			$spot .= ucwords($record['Employee']['first_name'].' '.$record['Employee']['last_name']).', ';
		}
		$this->set('spot_user', substr($spot, 0, strlen($spot)-2));
	}
	
	/* function to get biz. spot */
	public function get_biz_spot($id){
		$this->loadModel('BdBizSpot');
		$data = $this->BdBizSpot->find('all', array('fields' => array('bd_spoc_id'), 'conditions' => array('bd_business_id' => $id)));
		foreach($data as $record){
			$spot[] = $record['BdBizSpot']['bd_spoc_id'];
		}
		$this->set('selSpot', $spot);
	}
	
	/* function to save biz. spot */
	public function save_business_spot($id){
		$this->loadModel('BdBizSpot');
		foreach($this->request->data['BdBusiness']['spot'] as $val){
			$data = array('bd_spoc_id' => $val, 'created_date' => $this->Functions->get_current_date(), 'bd_business_id' => $id);
			$this->BdBizSpot->save($data);
			$this->BdBizSpot->create();
		}
	}
	
	/* get validation types */
	public function get_validation_field(){
		if($this->bdAdmin){
			return array('company_name','bd_opportunity_id','dofd','bd_spoc_id','hr_business_unit_id','bd_priority_id');
		}else{
			return array('');
		}
	}
	
	/* function to remove the biz. spot */
	public function remove_biz_spot($id){
		if(!empty($id) && $this->bdAdmin){
			$this->loadModel('BdBizSpot');
			// save in temp table
			$this->BdBizSpot->deleteAll(array('bd_business_id' => $id), false);
		}
	}
		
	/* function to remove the campus contact */
	public function remove_biz_contact($id){
		if(!empty($id)){
			$this->loadModel('BdBizContact');
			// save in temp table
			$this->BdBizContact->deleteAll(array('bd_business_id' => $id), false);
		}
	}
	
	/* function to get the contact details */
	public function get_contact_details($id,$type, $action){ 
		$this->loadModel('BdBizContact');
		// apply condition for only spoc
		if($action == 'all'){ // for view page 
			$userCond =  '';
		}else if($this->spocUser && $type == 'admin' && !$this->bdAdmin){ 
			$userCond =  array('created_by !=' => $this->Session->read('USER.Login.id'));
		}else if($this->spocUser && $type == 'spoc' && !$this->bdAdmin){
			$userCond = array('created_by' => $this->Session->read('USER.Login.id'));
		}
		
		$data = $this->BdBizContact->find('all', array('fields' => array('title','contact_name','email','mobile','designation', 'created_by', 'address', 'id'), 
		'conditions' => array('bd_business_id' => $id, 'BdBizContact.is_deleted' => 'N', $userCond),	'order' => array('BdBizContact.id' => 'asc')));
		
		$this->set($type.'_contact_data', $data);	
		
		
		$this->set('contact_data', $data);			
		$this->set('tot_contact', count($data));
		
		
		
	}
	
	/* function to auth record */
	public function edit_auth_action($id, $action){
		$this->BdBusiness->unBindModel(array('belongsTo' => array('BdProposalVer','HrBusinessUnit','Creator','BdOpportunity','BdPriority','State','District','BdBizSource')));
		$data = $this->BdBusiness->findById($id, array('fields' => 'id', 'is_approve', 'BdBusiness.status','BdBusiness.type','BdSpoc.app_users_id'));	
		// check the req belongs to the user
		if($this->bdAdmin && $data['BdBusiness']['status'] == '0' && $data['BdBusiness']['is_approve'] != 'R'){ // if bd admin
			return 'pass';
		}else if($data['BdSpoc']['app_users_id'] == $this->Session->read('USER.Login.id') && $data['BdBusiness']['type'] != 'O' && $data['BdBusiness']['is_approve'] != 'R'){ // if spoc for the business
			return 'pass';
		}else{
			return 'fail';
		}
	}
	
	/* function to auth record */
	public function auth_action($id, $action){
		$this->BdBusiness->unBindModel(array('belongsTo' => array('BdProposalVer','HrBusinessUnit','Creator','BdOpportunity','BdPriority','State','District','BdBizSource')));
		$data = $this->BdBusiness->findById($id, array('fields' => 'id', 'BdBusiness.app_users_id',  'BdSpoc.app_users_id','is_deleted','modified_date','bd_spoc_id'));	
		// check the req belongs to the user
		if($this->bdAdmin){ // if bd admin
			return 'pass';
		}else if($data['BdSpoc']['app_users_id'] == $this->Session->read('USER.Login.id')){ // if spoc for the business
			return 'pass';
		}else if($data['BdBusiness']['app_users_id'] == $this->Session->read('USER.Login.id') && $action == 'view'){ // if spoc for the business
			return 'pass';
		}else if($data['BdBusiness']['is_deleted'] == 'Y'){
			return $data['BdBusiness']['modified_date'];
		}else if(empty($data)){	
			return 'fail';
		}else{
			return 'fail';
		}
	}
	
		/* function to reset the form fields */
	public function reset_int_form($field, $reset_fields){
		if($this->request->data['BdBusiness'][$field] == '0'){
			foreach($reset_fields as $reset){
				$this->request->data['BdBusiness'][$reset] = '';
			}
		}
		
	}
	
	/* function to save the business contact details */
	public function save_business_contact($id){		
		$this->loadModel('BdBizContact');
		// update delete status before save
		$this->update_delete($id);
		for($i = 0; $i < $this->request->data['BdBusiness']['form_count']; $i++){ 
			if(!empty($this->request->data['BdBusiness']['contact_name'.$i])){
				$created_by = $this->request->data['BdBusiness']['contact_created'.$i] ? $this->request->data['BdBusiness']['contact_created'.$i] : $this->Session->read('USER.Login.id');
				$rec_id = $this->request->data['BdBusiness']['contact_id'.$i] ? $this->request->data['BdBusiness']['contact_id'.$i] : '';				
				$data = array('id' => $rec_id, 'title' => $this->request->data['BdBusiness']['title'.$i], 'contact_name' => $this->request->data['BdBusiness']['contact_name'.$i],'email' => $this->request->data['BdBusiness']['email'.$i],
				'mobile' => $this->request->data['BdBusiness']['mobile'.$i],'designation' => $this->request->data['BdBusiness']['designation'.$i],
				'address' => $this->request->data['BdBusiness']['address'.$i],'created_date' => $this->Functions->get_current_date(),'bd_business_id' => $id,
				'created_by' => $created_by, 'is_deleted' => 'N');
				$this->BdBizContact->save($data);
				$this->BdBizContact->create();				
			}
		}
	}
	
	/* function to update the delete status */
	public function update_delete($id){
		if($this->spocUser){
			$userCond = array('created_by' => $this->Session->read('USER.Login.id'));
		}
		$this->BdBizContact->updateAll(array('is_deleted' => "'Y'"), array('bd_business_id' => $id, $userCond));
	}
	
	/* function to update the update read status */
	public function update_read_status($id, $type){
		$this->loadModel('BdRead');
		$this->BdRead->updateAll(array('status' => "'U'", 'type' => '"'.$type.'"', 'modified_date' => '"'.$this->Functions->get_current_date().'"'), array('bd_business_id' => $id, 'app_users_id !=' => $this->Session->read('USER.Login.id')));
		// when modify
		if($type == 'M'){
			$this->BdRead->updateAll(array('status' => "'R'",  'modified_date' => '"'.$this->Functions->get_current_date().'"'), array('bd_business_id' => $id, 'app_users_id' => $this->Session->read('USER.Login.id')));
		}
	}
	
	/* function to retain the form radio values */
	public function retain_form_radio(){
		$field = array('proposal_done2','cb_share','sow_done2','agree_sign','work_start','proposal_approve2','work_comp');
		foreach($field as $val){
			if($_POST[$val] == '1'){
				$this->set($val.'_check1', 'checked');
				$this->set($val.'_check2', '');
			}elseif($_POST[$val] == '0'){
				$this->set($val.'_check2', 'checked');
				$this->set($val.'_check1', '');
			}				
		}
	}
	
	/* function to retain the form radio values */
	public function retain_edit_form_radio($data){
		$frm_field = array('proposal_done2','cb_share','sow_done2','agree_sign','work_start','proposal_approve2','work_comp');
		$table_field = array('proposal_done','cb_share','sow_done','agreement_sign','work_start','proposal_approve','work_complete');
		foreach($table_field as $key => $val){
			if($data[$val] == '1'){
				$this->set($frm_field[$key].'_check1', 'checked');
				$this->set($frm_field[$key].'_check2', '');
			}elseif($data[$val] == '0'){
				$this->set($frm_field[$key].'_check2', 'checked');
				$this->set($frm_field[$key].'_check1', '');
			}				
		}
	}
	
	
	public function view($id){	
		// set the page title
		$this->layout = 'iframe';
		$this->set('title_for_layout', 'View Business - My Business - BD - My PDCA');
		if (!empty($id) && intval($id)){
			// authorize user before action
			// enabled view privilege for all users
			$ret_value = 'pass';
			// $ret_value = $this->auth_action($id, 'view');
			if($ret_value == 'pass'){
				$this->BdBusiness->unBindModel(array('belongsTo' => array('BdSpoc')));
				$options = array(
					array('table' => 'bd_spoc',
							'alias' => 'Spoc',					
							'type' => 'LEFT',
							'conditions' => array('`Spoc`.`id` = `BdBusiness`.`bd_spoc_id`')
					),
					array('table' => 'app_users',
							'alias' => 'Employee',					
							'type' => 'LEFT',
							'conditions' => array('`Employee`.`id` = `Spoc`.`app_users_id`')
					)
				);
				$data = $this->BdBusiness->find('all', array('fields' => array('id','Employee.first_name','Employee.last_name', 'project_name','company_name','dofd',
				'cb_share','sow_done','proposal_done','proposal_doc','proposal_date','proposal_approve','agreement_no','agreement_sign','work_start',
				'BdOpportunity.title','BdPriority.title','HrBusinessUnit.business_unit','BdProposalVer.title','Creator.first_name','Creator.last_name','BdBusiness.created_date',
				'State.state_name','District.district_name','remark','address','BdBizSource.title','referrer','sow_detail','work_complete'), 
				'conditions' => array('BdBusiness.id' => $id, 'BdBusiness.is_deleted' => 'N'),
				'joins' => $options));
				$this->set('biz_data', $data[0]);	
				// get contact details
				$this->get_contact_details($id, 'admin', 'all');
				// get business spot by
				$this->get_biz_spot_user($id);
			}
		}
	}
	
	
	public function reply($id){
		//$this->layout = 'iframe';
		// get all reply
		$this->loadModel('BdReply');
		$this->get_bd_reply($id);
	}
	
		
	/* get the reply of tasks */
	public function get_bd_reply($id){
		$data = $this->BdReply->find('all', array('conditions' => array('bd_business_id' => $id), 'fields' => array('desc','created_date', 
		'HrEmployee.first_name','HrEmployee.last_name','HrEmployee.photo','HrEmployee.photo_status','HrEmployee.gender'), 'order' => array('created_date' => 'desc')));
		$this->set('reply_data', $data);
	}
	
	/* function to save the bd reply */
	public function save_reply(){ 
		$this->layout = 'refresh';		
		if ($this->request->is('post') && $this->request->data['reply'] != '') { 
			$data = array('bd_business_id' => $this->request->query['id'], 'desc' => trim($this->request->data['reply']), 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $this->Session->read('USER.Login.id'));		
			$this->loadModel('BdReply');			
			// update the todo
			if($this->BdReply->save($data, true, $fieldList = array('bd_business_id', 'desc','created_date','app_users_id'))){			
				$this->get_bd_reply($this->request->query['id']);
				// update unread status
				$this->update_read_status($this->request->query['id'], 'R');
				
			}
		}
		$this->render('/Elements/reply_bd/');	
	}
	
	/* function to check the read data available */
	public function check_read_data($user_id, $id){
		return $this->BdRead->find('count', array('conditions' => array('BdRead.bd_business_id' => $id, 'BdRead.app_users_id' => $user_id)));		
	}
	
	/* function to change the priority */
	public function change_priority(){
		$this->layout = 'refresh';
		$data = array('id' => $this->request->data['pk'], 'bd_priority_id' => $this->request->data['value'], 'modified_date' => $this->Functions->get_current_date(),
		'modified_by' => $this->Session->read('USER.Login.id'));
		$this->BdBusiness->save($data, array('validate' => false));
		$this->render(false);
	}
	
	/* function to change the biz. type */
	public function change_biz_type(){
		$this->layout = 'refresh';
		$data = array('id' => $this->request->data['pk'], 'type' => $this->request->data['value'], 'modified_date' => $this->Functions->get_current_date(),
		'modified_by' => $this->Session->read('USER.Login.id'));
		$this->BdBusiness->save($data, array('validate' => false));
		$this->render(false);
	}
	
	/* function to get approval data */
	public function get_reply_user_data($id){
		// if bd admin
		if($this->spocUser){
			$this->BdBusiness->unBindModel(array('belongsTo' => array('BdProposalVer','HrBusinessUnit','Creator','BdOpportunity','BdPriority','State','District','BdBizSource')));
			$data = $this->BdBusiness->findById($id, array('fields' => 'BdBusiness.app_users_id'));
			$save_user = $data['BdBusiness']['app_users_id'];
		}else{
			$data = $this->get_spoc_user_id($id);
			$save_user = $data[0]['Spoc']['app_users_id'];
		}
			return $save_user;
	}
	
	/* function to get the spoc user id */
	public function get_spoc_user_id($id){
		$this->BdBusiness->unBindModel(array('belongsTo' => array('BdSpoc', 'BdProposalVer','HrBusinessUnit','Creator',
		'BdOpportunity','BdPriority','State','District','BdBizSource')));				
			$options = array(
				array('table' => 'bd_spoc',
						'alias' => 'Spoc',					
						'type' => 'INNER',
						'conditions' => array('`Spoc`.`id` = `BdBusiness`.`bd_spoc_id`')
				),
				array('table' => 'app_users',
						'alias' => 'Employee',					
						'type' => 'INNER',
						'conditions' => array('`Employee`.`id` = `Spoc`.`app_users_id`')
				)
			);
			return $data = $this->BdBusiness->find('all', array('fields' => array('Spoc.app_users_id'),'conditions' => array('BdBusiness.id' => $id), 'joins' => $options));
	}
	
	/* function to update the read status */
	public function update_read(){
		$this->layout = 'refresh';
		$id = $this->request->query['id'];
		$this->loadModel('BdRead');
		$this->BdRead->id = $id;
		$this->BdRead->saveField('status', 'R');
		$this->BdRead->saveField('modified_date', $this->Functions->get_current_date());
		$this->render(false);
	}
	
	/* clear the cache */	
	public function beforeFilter() { 
		//$this->disable_cache();
		//$this->show_tabs();
		$this->spocUser = $this->check_spoc_user();
		$this->bdAdmin = $this->check_bd_admin();
		$this->set('bdAdmin', $this->bdAdmin);
		$this->check_valid_bd_user();

	}
	
	
	public function check_valid_bd_user(){
		if(!$this->spocUser && !$this->bdAdmin){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
			$this->redirect('/');
		}
	}
	
	/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$this->BdBusiness->unBindModel(array('belongsTo' => array('BdProposalVer','HrBusinessUnit','Creator','BdOpportunity','BdPriority','BdSpoc','BdBizSource')));
			$data = $this->BdBusiness->find('all', array('fields' => array('company_name','project_name','District.district_name','State.state_name'),
			'group' => array('company_name','project_name','District.district_name','State.state_name'), 'conditions' => 	array("OR" => array ('company_name like' => '%'.$q.'%',
			'project_name like' => '%'.$q.'%','State.state_name like' => '%'.$q.'%','District.district_name like' => '%'.$q.'%'),	'AND' => array('BdBusiness.is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	/* function to delete the spoc 
	public function delete_biz($id){
		if(!empty($id) && intval($id)){
			// authorize user before action
			if($this->bdAdmin){					
				$this->BdBusiness->id = $id;
				$this->BdBusiness->saveField('is_deleted', 'Y'); 
				$this->BdBusiness->saveField('modified_date', $this->Functions->get_current_date()); 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Business deleted successfully', 'default', array('class' => 'alert alert-success'));				
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/bdbusiness/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/bdbusiness/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/bdbusiness/');
	}
	*/
	
}