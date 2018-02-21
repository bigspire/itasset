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
 
class HrreportController extends AppController {  
	
	public $name = 'HrReport';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Reports - HRIS - My PDCA');
		
		
		
	}
	
	/* for attendance report */
	public function attendance(){
		$this->set('title_for_layout', 'Attendance Reports - HRIS - My PDCA');
	}
	
	
	/* for leave report */
	public function leave(){
		$this->set('title_for_layout', 'Leave Reports - HRIS - My PDCA');
		
	}
	
	
	/* for permission report */
	public function permission(){
		$this->set('title_for_layout', 'Permission Reports - HRIS - My PDCA');
		
	}
	
	
	/* for attendance change report */
	public function att_change(){
		$this->set('title_for_layout', 'Attendance Change Reports - HRIS - My PDCA');
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		$this->show_tabs(64);
	}
	
	
	
	
}