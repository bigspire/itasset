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
class BdhomeController extends AppController {  
	
	public $name = 'BdHome';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	
	
	public $spocUser, $bdAdmin;

	/* function to login the employer */
	public function index(){	
		// set the page title
		$page_title = $this->request->query['type'] ? $this->Functions->get_biz_type($this->request->query['type']).' Business - ' : '';
		$this->set('title_for_layout', $page_title.'Home - BD - My PDCA');	
		
		// filter records based on admin and spoc
		if(!$this->bdAdmin && $this->Session->read('USER.Login.id') != '25'){ 
			// $userCond = array('Spoc.app_users_id' => $this->Session->read('USER.Login.id'));
		}
		// when the form posted
		if($this->request->data['BdHome']['from'] != '' || $this->request->data['BdHome']['to'] != ''){
			$from = $this->request->data['BdHome']['from'];
			$to = $this->request->data['BdHome']['to'];	
			$diff = $this->BdHome->diff_date($this->Functions->format_date_save($from), $this->Functions->format_date_save($to));
		}else{
			$from = date('d/m/Y', strtotime('-30 days'));
			$to = date('d/m/Y');
			$diff = 30;
		}	
		
		$this->set('startDate', $from);
		$this->set('endDate', $to);	
		
		$from_date = $this->Functions->format_date_save($from);
		$to_date = $this->Functions->format_date_save($to);
		//$dateCond = array('or' => array("date_format(BdHome.created_date, '%Y-%m-%d') between ? and ?" => array($from_date, $to_date)));		
		$dateCond = array('or' => array("BdHome.dofd between ? and ?" => array($from_date, $to_date)));		
		// get sow done conditions
		if($this->request->data['BdHome']['sow'] != ''){
			$sowCond = array('sow_done' => $this->request->data['BdHome']['sow']);
		}
		// get proposal submitted conditions		
		if($this->request->data['BdHome']['proposal_done'] != ''){
			$proposal_done = $this->request->data['BdHome']['proposal_done'] == 2 ? '' : $this->request->data['BdHome']['proposal_done'];
			$psCond = array('proposal_done' => $proposal_done);
		}
		// get proposal approved conditions		
		if($this->request->data['BdHome']['proposal_approve'] != ''){
			$proposal_apr = $this->request->data['BdHome']['proposal_approve'] == 2 ? '' : $this->request->data['BdHome']['proposal_approve'];
			$paCond = array('proposal_approve' => $proposal_apr);
		}
		// get agreement sign conditions		
		if($this->request->data['BdHome']['agree_sign'] != ''){
			$sign = $this->request->data['BdHome']['agree_sign'] == 2 ? '' : $this->request->data['BdHome']['agree_sign'];
			$asCond = array('agreement_sign' => $sign);
		}
		
		// get work work start conditions		
		if($this->request->data['BdHome']['work_status'] != ''){
			$work_status = $this->request->data['BdHome']['work_status'] == 2 ? '' : $this->request->data['BdHome']['work_status'];
			$wsCond = array('work_start' => $work_status);
		}
		// get work work complete conditions		
		if($this->request->data['BdHome']['work_complete'] != ''){
			$work_comp = $this->request->data['BdHome']['work_complete'] == 2 ? '' : $this->request->data['BdHome']['work_complete'];
			$wcCond = array('work_complete' => $work_comp);
		}
		// when spoc selected
		if($this->request->data['BdHome']['spoc'] != ''){
			$spocCond = array('BdHome.bd_spoc_id' => $this->request->data['BdHome']['spoc']);
		}
		
		// for biz. type condition
		if($this->request->query['type'] != ''){ 
			$typeCond = array('BdHome.type' => $this->request->query['type']);
			$this->set('biz_type', $this->Functions->get_biz_type($this->request->query['type']));
		}
		
		$bd_spoc_list = $this->BdHome->get_spoc_details();
		foreach($bd_spoc_list as $key => $value){ 
			$data_list[$value['BdSpoc']['id']] = $value['HrEmployee']['first_name'].' '.$value['HrEmployee']['last_name'];		
		}	
		$this->set('bizSpoc', $data_list);
		
		// apply search color
		$this->apply_border_color();
		
		// get graph data
		$this->BdHome->unBindModel(array('belongsTo' => array('BdSpoc','BdProposalVer')));
		
		
		$options = array(
			array('table' => 'bd_spoc',
					'alias' => 'Spoc',					
					'type' => 'LEFT',
					'conditions' => array('`Spoc`.`id` = `BdHome`.`bd_spoc_id`')
			),
			array('table' => 'app_users',
					'alias' => 'Employee',					
					'type' => 'LEFT',
					'conditions' => array('`Employee`.`id` = `Spoc`.`app_users_id`')
			)
		);
		$options3 = array_merge($options, $spot_options);
		$gdata = $this->BdHome->find('all', array('conditions' => array('BdHome.is_deleted' => 'N','BdHome.status' => '1',$typeCond,$spocCond,$spocCond,$userCond,$dateCond,$sowCond,$psCond,$paCond,$asCond,$wsCond,$wcCond),
		'fields' => array('dofd','company_name', 'District.district_name','HrBusinessUnit.business_unit','id','BdPriority.title','Employee.first_name','BdHome.type','BdOpportunity.title','BdHome.created_date','sow_done',
		'State.state_name','BdBizSource.title', 'work_start'),'order' => array('BdHome.created_date' => 'desc'), 'joins' => $options));
		$this->set('graphData', $gdata);
		
		// for conversion wise
		foreach($gdata as $conversion){
			if($conversion['BdHome']['work_start'] == '1'){
				$conver_yes++; 
			}else{
				$conver_no++; 
			}
		}		
		$this->set('conver_yes', $conver_yes ? $conver_yes : 0);
		$this->set('conver_no', $conver_no ? $conver_no : 0);
		
		$options = array(
			array('table' => 'bd_spoc',
					'alias' => 'Spoc',					
					'type' => 'LEFT',
					'conditions' => array('`Spoc`.`id` = `BdHome`.`bd_spoc_id`')
			),
			array('table' => 'app_users',
					'alias' => 'Employee',					
					'type' => 'LEFT',
					'conditions' => array('`Employee`.`id` = `Spoc`.`app_users_id`')
			)
		);
		// get business vertical wise
		$this->loadModel('BdHome');
		
		$this->BdHome->unBindModel(array('belongsTo' => array('BdSpoc','BdProposalVer','BdPriority','BdOpportunity','State','District','BdBizSource')));
		$data = $this->BdHome->find('all', array('conditions' => array('BdHome.is_deleted' => 'N','BdHome.status' => '1',$typeCond,$spocCond,$userCond, $dateCond,$sowCond,$psCond,$paCond,$asCond,$wsCond,$wcCond),
		'fields' => array('HrBusinessUnit.business_unit', 'count(*) count'),'group' => array('BdHome.hr_business_unit_id'), 'joins' => $options));
		$this->set('verticalGraph', $data);
	
		// get biz. priority wise
		$this->BdHome->unBindModel(array('belongsTo' => array('BdSpoc','BdProposalVer','HrBusinessUnit','BdOpportunity','State','District','BdBizSource')));
		$data = $this->BdHome->find('all', array('conditions' => array('BdHome.is_deleted' => 'N','BdHome.status' => '1',$typeCond,$spocCond,$userCond, $dateCond,$sowCond,$psCond,$paCond,$asCond,$wsCond,$wcCond),
		'fields' => array('BdPriority.title', 'count(*) count'),'group' => array('bd_priority_id'), 'joins' => $options));
		$this->set('priorityGraph', $data);
		
		// get biz. spoc wise
		$this->BdHome->unBindModel(array('belongsTo' => array('BdSpoc','BdProposalVer','HrBusinessUnit','BdPriority','BdOpportunity','State','District','BdBizSource')));
		$data = $this->BdHome->find('all', array('conditions' => array('BdHome.is_deleted' => 'N','BdHome.status' => '1',$typeCond,$spocCond,$userCond, $dateCond,$sowCond,$psCond,$paCond,$asCond,$wsCond,$wcCond),
		'fields' => array('Employee.first_name', 'count(*) count'),'group' => array('Employee.id'), 'joins' => $options));
		$this->set('spocGraph', $data);
		
		// get biz. type wise
		$this->BdHome->unBindModel(array('belongsTo' => array('BdSpoc','BdProposalVer','HrBusinessUnit','BdPriority','BdOpportunity','State','District','BdBizSource')));
		$data = $this->BdHome->find('all', array('conditions' => array('BdHome.is_deleted' => 'N','BdHome.status' => '1',$typeCond,$spocCond,$userCond, $dateCond,$sowCond,$psCond,$paCond,$asCond,$wsCond,$wcCond),
		'fields' => array('BdHome.type', 'count(*) count'),'group' => array('BdHome.type'), 'joins' => $options));
		$this->set('typeGraph', $data);
		
		// get biz. opportunity wise
		$this->BdHome->unBindModel(array('belongsTo' => array('BdSpoc','BdProposalVer','HrBusinessUnit','BdPriority','State','District','BdBizSource')));
		$data = $this->BdHome->find('all', array('conditions' => array('BdHome.is_deleted' => 'N','BdHome.status' => '1',$typeCond,$spocCond,$userCond, $dateCond,$sowCond,$psCond,$paCond,$asCond,$wsCond,$wcCond),
		'fields' => array('BdOpportunity.title', 'count(*) count'),'group' => array('BdOpportunity.title'), 'joins' => $options));
		$this->set('opporGraph', $data);
		
		// get biz. location wise
		$this->BdHome->unBindModel(array('belongsTo' => array('BdSpoc','BdProposalVer','HrBusinessUnit','BdPriority','BdOpportunity','State','BdBizSource')));
		$data = $this->BdHome->find('all', array('conditions' => array('BdHome.is_deleted' => 'N','BdHome.status' => '1',$typeCond,$spocCond,$userCond, $dateCond,$sowCond,$psCond,$paCond,$asCond,$wsCond,$wcCond),
		'fields' => array('District.district_name', 'count(*) count'),'group' => array('district_id'), 'joins' => $options));
		$this->set('locGraph', $data);
		
		// get state wise
		$this->BdHome->unBindModel(array('belongsTo' => array('BdSpoc','BdProposalVer','HrBusinessUnit','BdPriority','BdOpportunity','District','BdBizSource')));
		$data = $this->BdHome->find('all', array('conditions' => array('BdHome.is_deleted' => 'N','BdHome.status' => '1',$typeCond,$spocCond,$userCond, $dateCond,$sowCond,$psCond,$paCond,$asCond,$wsCond,$wcCond),
		'fields' => array('State.state_name', 'count(*) count'),'group' => array('state_id'), 'joins' => $options));
		$this->set('stateGraph', $data);
		
		// get proposal sow wise
		$this->BdHome->unBindModel(array('belongsTo' => array('BdSpoc','BdProposalVer','HrBusinessUnit','BdPriority','BdOpportunity','State','District','BdBizSource')));
		$data = $this->BdHome->find('all', array('conditions' => array('BdHome.is_deleted' => 'N','BdHome.status' => '1',$typeCond,$spocCond,$userCond, 'sow_done !=' => '', $dateCond,$sowCond,$psCond,$paCond,$asCond,$wsCond,$wcCond),
		'fields' => array('sow_done', 'count(*) count'),'group' => array('sow_done'), 'joins' => $options));
		$this->set('sowGraph', $data);
		
		// get biz. reference wise
		$this->BdHome->unBindModel(array('belongsTo' => array('BdSpoc','BdProposalVer','HrBusinessUnit','BdPriority','BdOpportunity','State','District')));
		$data = $this->BdHome->find('all', array('conditions' => array('BdHome.is_deleted' => 'N','BdHome.status' => '1',$typeCond,$spocCond,$userCond, $dateCond,$sowCond,$psCond,$paCond,$asCond,$wsCond,$wcCond),
		'fields' => array('BdBizSource.title', 'count(*) count'),'group' => array('bd_business_source_id'), 'joins' => $options));
		$this->set('referGraph', $data);
		
		
		$spot_options = array(
			array('table' => 'bd_business_spot',
					'alias' => 'Spot',					
					'type' => 'LEFT',
					'conditions' => array('`Spot`.`bd_business_id` = `BdHome`.`id`')
			),
			array('table' => 'bd_spoc',
					'alias' => 'Spoc',					
					'type' => 'LEFT',
					'conditions' => array('`Spoc`.`id` = `Spot`.`bd_spoc_id`')
			),
			array('table' => 'app_users',
					'alias' => 'Employee',					
					'type' => 'LEFT',
					'conditions' => array('`Employee`.`id` = `Spoc`.`app_users_id`')
			)
		);
		// get biz. spot wise
		$this->BdHome->unBindModel(array('belongsTo' => array('BdSpoc','BdProposalVer','HrBusinessUnit','BdPriority','BdOpportunity','State','District','BdBizSource')));
		$data = $this->BdHome->find('all', array('conditions' => array('BdHome.is_deleted' => 'N','BdHome.status' => '1',$typeCond,$spocCond,$userCond, $dateCond,$sowCond,$psCond,$paCond,$asCond,$wsCond,$wcCond),
		'fields' => array('Employee.first_name', 'count(*) count'),'group' => array('Employee.id'), 'joins' => $spot_options));
		$this->set('spotGraph', $data);
				
		// calculate the weekly graph
		$no_week = ceil($diff / 7); // get no. of weeks
		$i = 0; $k = 1;
		$week_day[$i][] = $from_date;
		while($no_week > 0){
			$week[] = $i;	
			$week_start_label = $from_date;
			if(!empty($next_day)){ // assign the next day if its not empty
				$week_start_label = date('Y-m-d', strtotime($next_day . ' +1 day'));
			}
			// add one week date
			for($j = 0; $j <= 5; $j++){
				if(strtotime($to_date) > strtotime($next_day)){  
					$next_day = date('Y-m-d', strtotime($from_date . ' +1 day'));
					$week_day[$i][] = $next_day;
					$from_date = $next_day;
				}
			} 
			$week_label[$k++] = date('d/m', strtotime($week_start_label)).'-'.date('d/m', strtotime($from_date));
			$no_week--;
			$i++;
		}
		// iterate the graph data for weekly graph
		foreach($gdata as $record){
			foreach($week_day as $key => $week){ 
				if(in_array($record['BdHome']['dofd'], $week)){
					$weekly_graph[++$key]++;
					//echo date('Y-m-d', strtotime($record['BdHome']['created_date'])); echo $key;  echo '<br>';
				}
			}			
		}
		ksort($weekly_graph);		
		$this->set('weeklyGraph', $weekly_graph);
		$this->set('weeklyLabel', $week_label);
		
	}
	
	
	/* function to apply search form border */
	public function apply_border_color(){
		if($this->request->is('post')){
			$field_ar = array('sow','proposal_done','proposal_approve','agree_sign','work_status','spoc','work_complete');
			foreach($field_ar as $key => $val){	
				if($this->request->data['BdHome'][$val] != ''){
					$this->set('bdsrchSel'.++$key, 'bdsrchSel');
				}
			}			
		}
	}
	
	
	/* clear the cache */	
	public function beforeFilter() { 
		$this->show_tabs();
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
	
	
	
	
}