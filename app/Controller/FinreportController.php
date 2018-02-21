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
 
class FinreportController extends AppController {  
	
	public $name = 'FinReport';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Reports - Finance - My PDCA');
		
		
		
	}
	
	/* for expense report */
	public function expense(){
		$this->set('title_for_layout', 'Expense Reports - Finance - My PDCA');
	}
	
	
	/* for advance report */
	public function advance(){
		$this->set('title_for_layout', 'Advance Reports - Finance - My PDCA');
		
	}
	
	
	/* for adv. payable report */
	public function adv_payable(){
		$this->set('title_for_layout', 'Advance Payable Reports - Finance - My PDCA');
		
	}
	
	
	/* for expense payable eport */
	public function exp_payable(){
		$this->set('title_for_layout', 'Expense Payable Reports - Finance - My PDCA');
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		$this->show_tabs(65);
	}
	
	
	
	
}