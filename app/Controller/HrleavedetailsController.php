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
 
class HrleavedetailsController extends AppController {  
	
	public $name = 'HrLeaveDetail';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions','Excel');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Employee  Leave Details - HRIS - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword'),'HrLeaveDetail'); 
			$this->redirect('/hrleavedetails/?'.$url_vars);					
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (HrEmployee.first_name) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		
		$options = array(	
			array('table' => 'hr_leave_balance',
					'alias' => 'HrLeaveDetail',					
					'type' => 'LEFT',
					'conditions' => array('`HrLeaveDetail`.`app_users_id` = `HrEmployee`.`id`')
			)
		);
			
		
		$this->HrLeaveDetail->HrEmployee->unBindModel(array('belongsTo' => array('HrDepartment','HrDesignation','HrGrade','Role','HrCompany',
		'HrBranch','HrBusinessUnit','HrBloodGroup'), 'hasOne' => array('HrEducation','HrExperience','HrFamily')));
		
		// fetch the advances		
		$this->paginate = array('fields' => array('id','HrLeaveDetail.id', 'sum(HrLeaveDetail.pl_bal) as pl_bal', 'HrLeaveDetail.nbl_bal','HrLeaveDetail.year', 
		'HrEmployee.first_name','HrEmployee.last_name','HrLeaveDetail.created_date'),'limit' => 50,  'conditions' => array($keyCond, 'HrEmployee.is_deleted' => 'N'),
		'order' => array('HrEmployee.first_name' => 'asc'), 'joins' => $options, 'group' => array('HrEmployee.id'));
		$data = $this->paginate('HrEmployee');			
		$this->set('leave_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any leave details', 'default', array('class' => 'alert alert'));	
		}
		
	}
	
	
	/* function to get nbl remaining */
	public function get_nbl_balance(){
		
	}

		
	
	/* function to edit the form */
	public function edit_leave_details($id,$timing_id){
		$this->layout = 'iframe';
		// set the page title		
		$this->set('title_for_layout', 'Edit Employee  Leave Details - HRIS - My PDCA');		
		// unbind unwanted models
		$this->HrLeaveDetail->HrEmployee->unBindModel(array('belongsTo' => array('HrDepartment','HrDesignation','HrGrade','Role','HrCompany','HrBranch','HrBusinessUnit')));
		// get employee
		$emp_data = $this->HrLeaveDetail->HrEmployee->findById($id, array('fields ' => 'full_name'));
		$this->set('emp_data', $emp_data);
		// set grace timings
		$this->set('grace_timings', array('0' => '0 mins', '10' => '10 mins.', '15' => '15 mins.', '20' => '20 mins.','30' => '30 mins.'));
		$this->set('rec_exists', $timing_id);
		
		// when the form submitted
		if (!empty($this->request->data)){ 
			// validates the form
			$this->HrLeaveDetail->set($this->request->data);				
			if ($this->HrLeaveDetail->validates(array('fieldList' => array('start_time', 'end_time', 'grace_time')))) {
					$this->request->data['HrLeaveDetail']['app_users_id'] = $id;
					
					$this->request->data['HrLeaveDetail']['start_time'] = $this->Functions->format_time_save($this->request->data['HrLeaveDetail']['start_time']);
					$this->request->data['HrLeaveDetail']['end_time'] = $this->Functions->format_time_save($this->request->data['HrLeaveDetail']['end_time']);
					
					// check edit or new
					if(empty($timing_id)){
						$this->HrLeaveDetail->id = '';
						$this->request->data['HrLeaveDetail']['created_date'] = $this->Functions->get_current_date();
						$this->request->data['HrLeaveDetail']['created_by'] = $this->Session->read('USER.Login.id');
					}else{
						$this->HrLeaveDetail->id = $timing_id;
						$this->request->data['HrLeaveDetail']['modified_by'] = $this->Session->read('USER.Login.id');	
						$this->request->data['HrLeaveDetail']['modified_date'] = $this->Functions->get_current_date();
					}
					// save the data
					if($this->HrLeaveDetail->save($this->request->data['HrLeaveDetail'])) {								
						// show the msg.
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Office timing updated successfully', 'default', array('class' => 'alert alert-success'));						
						$this->redirect('/hrleavedetails/edit_leave_details/'.$id.'/'.$this->HrLeaveDetail->id.'/?action=view');
						
					}			
				}	
			}else{
				$this->request->data = $this->HrLeaveDetail->findByAppUsersId($id);	
											
			}
	}
	
	/* function to upload the file */
	public function upload_attachment($data){
		// validate the file				
		if(!empty($data['tmp_name'])){
			$file = time().'_'.$data['name']; 
			if($this->upload_file($data['tmp_name'], WWW_ROOT.'/uploads/leaves/'.$file)){
				return $file;
			}			
		}
				
	}
	
	/* function to check leave already exists */
	public function check_leave_exists($id, $year){
		$upload_data = $this->HrLeaveDetail->find('all', array('fields' => array('id'), 'conditions' => array('HrLeaveDetail.app_users_id' => $id,
		'HrLeaveDetail.year' => $year), 'limit' => '1'));
		return $upload_data[0]['HrLeaveDetail']['id'];
	}
	
	/* function to edit the form */
	public function upload(){		
		// set the page title		
		$this->set('title_for_layout', 'Upload PL - HRIS - My PDCA');		
		// when the form submitted
		if (!empty($this->request->data)){ 
			// validates the form
			$this->HrLeaveDetail->set($this->request->data);				
			if ($this->HrLeaveDetail->validates(array('fieldList' => array('upload_file')))) {				
				
				$this->request->data['HrLeaveDetail']['year'] = $this->request->data['HrLeaveDetail']['sal_year']['year'];
				// upload excel file				
				$file = $this->upload_attachment($this->request->data['HrLeaveDetail']['upload_file']);	
				// read the excel file
				$data = $this->Excel->read_data('uploads/leaves/'.$file);
				$suc_start = "<span class='out_suc'>";
				$fail_start = "<span class='out_fail'> ";
				$end = ' </span>';
				$output = '';
				// iterate excel array
				foreach($data as $key =>  $leave){	
					// skip the headers and title
					if($key >= 3){	
						// make sure it has value
						if(!empty($leave['B'])){ 
							$this->HrLeaveDetail->HrEmployee->unBindModel(array('belongsTo' => array('HrDepartment','HrDesignation','HrGrade','Role','HrCompany','HrBranch')));
							$emp_detail = $this->HrLeaveDetail->HrEmployee->find('all', array('fields' => array('id'), 'conditions' => array('HrEmployee.emp_no' => trim(strtoupper($leave['B'])))));
							// check user exists							
							if(!empty($emp_detail[0]['HrEmployee']['id'])){ 
								$exists = $this->check_leave_exists($emp_detail[0]['HrEmployee']['id'], $this->request->data['HrLeaveDetail']['month']);
								// format the data
								$this->request->data['HrLeaveDetail']['app_users_id'] = $emp_detail[0]['HrEmployee']['id'];
								
								// 2014
								$this->request->data['HrLeaveDetail']['year'] = '2014';	
								$this->request->data['HrLeaveDetail']['pl_bal'] = $leave['E'];
								$this->request->data['HrLeaveDetail']['nbl_bal'] = $leave['D'];
								$this->request->data['HrLeaveDetail']['created_date'] = $this->Functions->get_current_date();
								$this->request->data['HrLeaveDetail']['created_by'] = $this->Session->read('USER.Login.id');
								$this->HrLeaveDetail->create();
								$this->HrLeaveDetail->save($this->request->data['HrLeaveDetail']);
								
								// 2013
								$this->request->data['HrLeaveDetail']['year'] = '2013';
								$this->request->data['HrLeaveDetail']['nbl_bal'] = 0;
								$this->request->data['HrLeaveDetail']['pl_bal'] = $leave['F'];
								$this->request->data['HrLeaveDetail']['created_date'] = $this->Functions->get_current_date();
								$this->request->data['HrLeaveDetail']['created_by'] = $this->Session->read('USER.Login.id');
								$this->HrLeaveDetail->create();
								$this->HrLeaveDetail->save($this->request->data['HrLeaveDetail']);
								// 2012
								$this->request->data['HrLeaveDetail']['year'] = '2012';	
								$this->request->data['HrLeaveDetail']['pl_bal'] = $leave['G'];
								$this->request->data['HrLeaveDetail']['nbl_bal'] = 0;
								$this->request->data['HrLeaveDetail']['created_date'] = $this->Functions->get_current_date();
								$this->request->data['HrLeaveDetail']['created_by'] = $this->Session->read('USER.Login.id');
								$this->HrLeaveDetail->create();
								$this->HrLeaveDetail->save($this->request->data['HrLeaveDetail']);
								// 2011
								$this->request->data['HrLeaveDetail']['year'] = '2011';	
								$this->request->data['HrLeaveDetail']['pl_bal'] = $leave['H'];
								$this->request->data['HrLeaveDetail']['nbl_bal'] = 0;
								$this->request->data['HrLeaveDetail']['created_date'] = $this->Functions->get_current_date();
								$this->request->data['HrLeaveDetail']['created_by'] = $this->Session->read('USER.Login.id');
								$this->HrLeaveDetail->create();
								$this->HrLeaveDetail->save($this->request->data['HrLeaveDetail']);
								// 2010
								$this->request->data['HrLeaveDetail']['year'] = '2010';	
								$this->request->data['HrLeaveDetail']['pl_bal'] = $leave['I'];
								$this->request->data['HrLeaveDetail']['nbl_bal'] = 0;
								$this->request->data['HrLeaveDetail']['created_date'] = $this->Functions->get_current_date();
								$this->request->data['HrLeaveDetail']['created_by'] = $this->Session->read('USER.Login.id');
								$this->HrLeaveDetail->create();
								$this->HrLeaveDetail->save($this->request->data['HrLeaveDetail']);
								
								
																								
								if($exists != ''){
									$output_str = 'modified';
									$this->HrLeaveDetail->id = $exists;
									// reset pdf created and file 
									$this->request->data['HrLeaveDetail']['modified_date'] = $this->Functions->get_current_date();	
									$this->request->data['HrLeaveDetail']['modified_by'] = $this->Session->read('USER.Login.id');	
									
								}else{
									$output_str = 'created';
									$this->request->data['HrLeaveDetail']['created_date'] = $this->Functions->get_current_date();
									$this->request->data['HrLeaveDetail']['created_by'] = $this->Session->read('USER.Login.id');
									$this->HrLeaveDetail->create();
								}
								// save into database							
								/*if($this->HrLeaveDetail->save($this->request->data['HrLeaveDetail'])) {		
									$output .= $suc_start.$leave['C'] ." PL details $output_str successfully<br>".$end;
								}else{
									$output .= $suc_start.$leave['C'] ." PL details failed to create <br>".$end;
								}*/
							}else{
								$output .= $fail_start.$leave['C'] ." doesn't exists in the company<br>".$end;
							}
						}						
					}
					
					
				}				
				
				$file = $this->write_report($output);
				
				// show the msg.
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>'.$output."<br><a href=".$this->webroot.'hrleavedetails/download_report/'.$file.'>Download Report</a>', 'default', array('class' => 'alert alert-success'));
				
			}	
		}
	}
	
	/* function to create report */
	public function write_report($op){ 		
		$file = time().'_leaves.txt';
		$path = WWW_ROOT.'/uploads/report/'.$file;
		$fp = fopen($path, 'w+');
		$op_new = str_replace(array("<span class='out_suc'>", "<span class='out_fail'>","</span>"), array('', '', ''), $op);
		$op_ar = explode('<br>', $op_new);		
		foreach($op_ar as $key =>  $str){ 
			if(trim($str) != ''){		
				fputs($fp, ++$key.') '.trim($str)."\r\n");
			}
		}
		fclose($fp);
		return $file;
		
	}
	
	
	/* function to download the file */
	public function download_report($file){
		$this->download_file(WWW_ROOT.'/uploads/report/'.$file);
		die;
	
	}
	
	/* function to download the file */
	public function download_sample($file){		
		$this->download_file(WWW_ROOT.'/uploads/leaves/'.$file);
		die;
	}
	
	
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(53);
	}
	
	
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->HrLeaveDetail->HrEmployee->find('all', array('fields' => array('HrEmployee.full_name'),  'group' => array('HrEmployee.first_name', 'HrEmployee.last_name'), 'conditions' => array("OR" => array ('HrEmployee.full_name like' => '%'.$q.'%'), 'AND' => array('HrEmployee.is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	
	
}