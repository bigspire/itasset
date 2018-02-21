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
 
class HrmypayslipController extends AppController {  
	
	public $name = 'HrMyPayslip';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions','Excel','Pdf');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
	
		// set the page title
		$this->set('title_for_layout', 'Payslip - HRIS - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('from','to'),'HrMyPayslip'); 
			$this->redirect('/hrmypayslip/?'.$url_vars);					
		}
		
		 			
		// for date search
		if($this->params->query['from'] != '' || $this->params->query['to'] != ''){
			$from = $this->Functions->format_date_search($this->params->query['from']).'-1';
			$to = $this->Functions->format_date_search($this->params->query['to']).'-1';
			
			$dateCond = array('or' => array('month between ? and ?' => array($from, $to),'month between ? and ?' => array($from, $to))); 			
		}		
		
		// assign url vars.
		if(!empty($this->request->query['from']) || !empty($this->request->query['to'])){
			$urlvar = '?from='.$this->request->query['from'].'&to='.$this->request->query['to'];
			$this->set('url_var', $urlvar);
		}
			
	
		$this->paginate = array('fields' => array('id', 'pdf_created', 'pdf_file', 'month', 'net_amount'),'limit' => 10,  'conditions' => array('HrMyPayslip.app_users_id' => $this->Session->read('USER.Login.id'), $dateCond, 'HrMyPayslip.is_deleted' => 'N', 'pdf_created !=' => ''), 'order' => array('month' => 'desc'));
		$data = $this->paginate('HrMyPayslip');			
		$this->set('pay_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no payslips', 'default', array('class' => 'alert alert'));	
		}
		
	}
		

	
	/* function to download the file */
	public function download_pay($file){		
		$this->download_file(WWW_ROOT.'/uploads/payslip/'.$file);
		die;		
	}
	
	


	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(38);
	}
	

	
	
}