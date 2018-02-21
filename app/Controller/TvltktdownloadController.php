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
class TvltktdownloadController extends AppController {  
	
	public $name = 'TvlTktDownload';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Download Ticket - Biz Tour - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			// fetch onward journey
			$this->TvlTktDownload->bindModel(
						array('belongsTo' => array(
								'TvlStart' => array(
									'className' => 'TvlPlace',
									'foreignKey' => 'tvl_depart_id'
								)
							)
						)
					);
			$data = $this->TvlTktDownload->find('all', array('conditions' => array('tvl_code' => trim($this->request->data['TvlTktDownload']['keyword']), 'is_approve' => 'Y', 'TvlTktDownload.status' => 'A', 'TvlTicket.tkt_type' => 'O', 'TvlTktDownload.app_users_id' => $this->Session->read('USER.Login.id')), 'fields' => array('TvlTicket.id','TvlTktDownload.id','TvlTicket.tkt','TvlPlace.place','TvlStart.place','start_date')));
			
			// fetch return  journey
			$this->TvlTktDownload->bindModel(
						array('belongsTo' => array(
								'TvlStart' => array(
									'className' => 'TvlPlace',
									'foreignKey' => 'tvl_depart_id'
								)
							)
						)
					);
			$data2 = $this->TvlTktDownload->find('all', array('conditions' => array('tvl_code' => trim($this->request->data['TvlTktDownload']['keyword']), 'is_approve' => 'Y', 'TvlTktDownload.status' => 'A', 'TvlTicket.tkt_type' => 'R','TvlTktDownload.app_users_id' => $this->Session->read('USER.Login.id')), 'fields' => array('TvlTicket.id','TvlTktDownload.id','TvlTicket.tkt','TvlPlace.place','TvlStart.place','return_date')));

			if(!empty($data) || !empty($data2)){ 
				//print_r($data);
				$this->set('ticket', $data);
				$this->set('ticket2', $data2);
			}else if(empty($this->request->data['TvlTktDownload']['keyword'])){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Please enter the travel code', 'default', array('class' => 'alert alert-error'));
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>No tickets found', 'default', array('class' => 'alert alert-info'));

			}
		}
		
	}
	
	/* function to download the file */
	public function download($id, $tvl_id){
		$ret_value = $this->auth_action($tvl_id);
		if($ret_value == 'pass'){			
			$data = $this->TvlTktDownload->TvlTicket->find('all', array('conditions' => array('TvlTicket.tvl_request_id' => $tvl_id, 'tkt_type' => $this->request->query['type']), 'fields' => array('tkt')));
			if(!empty($data)){
				// if only one file
				$this->download_file(WWW_ROOT.'/uploads/ticket/'.$data[0]['TvlTicket']['tkt']);
				die;
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>No tickets found', 'default', array('class' => 'alert alert-info'));
				$this->redirect('/tvltktdownload/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>No tickets found', 'default', array('class' => 'alert alert-info'));
			$this->redirect('/tvltktdownload/');
		}
	}
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->TvlTktDownload->findById($id, array('fields' => 'app_users_id', 'is_deleted'));	
		// check the req belongs to the user
		if($data['TvlTktDownload']['is_deleted'] == 'Y'){
			return ;
		}else if($data['TvlTktDownload']['app_users_id'] == $this->Session->read('USER.Login.id')){
			return 'pass';
		}else{
			return 'fail';
		}
	}
	
	
	/* clear the cache */	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(80);		
	}
	
		
	
	
	
}