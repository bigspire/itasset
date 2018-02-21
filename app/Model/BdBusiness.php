<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

class BdBusiness extends AppModel {
	
	public $name = 'BdBusiness';
	 
	public $useTable = 'bd_business';
	  
	public $primaryKey = 'id';	

	public $belongsTo = array(		
		'BdOpportunity' => array(
            'className'  => 'BdOpportunity',
			'foreignKey' => 'bd_opportunity_id'			
        ),
		'BdSpoc' => array(
            'className'  => 'BdSpoc',
			'foreignKey' => 'bd_spoc_id'			
        ),
		'BdPriority' => array(
            'className'  => 'BdPriority',
			'foreignKey' => 'bd_priority_id'			
        ),
		'BdProposalVer' => array(
            'className'  => 'BdProposalVer',
			'foreignKey' => 'bd_proposal_version_id'			
        ),
		'HrBusinessUnit' => array(
            'className'  => 'HrBusinessUnit',
			'foreignKey' => 'hr_business_unit_id'			
        ),
		'Creator' => array(
            'className'  => 'User',
			'foreignKey' => 'app_users_id'			
        ),
		'State' => array(
            'className'  => 'State',
			'foreignKey' => 'state_id'			
        ),
		'District' => array(
            'className'  => 'District',
			'foreignKey' => 'district_id'			
        ),
		'BdBizSource' => array(
            'className'  => 'BdBizSource',
			'foreignKey' => 'bd_business_source_id'			
        )
	);
	
	public $validate = array(
		'company_name' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the company name'
            ),
			 'duplicate' => array(
                'rule'     => 'checkDup',
                'required' => true,
                'message'  => 'Business already created. Please check again!'
            )
        ),	
        'district_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the location'
            )
        ),
		'bd_opportunity_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the business opportunity'
            )
		),
		'dofd' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the DOFD'
            )
		),
		'bd_spoc_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the SPOC'
            )
		),
		'hr_business_unit_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the business vertical'
            )
		),
		'bd_priority_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the priority'
            )
		)
		,
		'address' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the address'
            )
		)
	);
	
	/* function to check for duplicate */
	public function checkDup(){	
		if($this->data['BdBusiness']['hr_business_unit_id'] == 'add_business'){
			$count = $this->find('count', array('conditions' => array('dofd' => $this->format_date_save($this->data['BdBusiness']['dofd']), 'BdBusiness.hr_business_unit_id' =>
			$this->data['BdBusiness']['hr_business_unit_id'], 'company_name' => $this->data['BdBusiness']['company_name'],
			'is_approve !=' => 'R', 'BdBusiness.id !=' => $this->data['BdBusiness']['id'])));
			if($count){
				return false;
			}else{
				return true;
			}
		}
		return true;
		
	}
	
	
	/* function to format the date to save */
	public function format_date_save($date){
		if(!empty($date)){
			$exp_date = explode('/', $date); 
			return $exp_date[2].'-'.$exp_date[1].'-'.$exp_date[0];
		}
	}
	
	
	/* function to get the biz. opportunity */
	public function get_opportunity(){
		return $list = $this->BdOpportunity->find('list', array('fields' => array('id','title'), 'order' => array('id ASC'),'conditions' => array('status' => 1)));
	}
	
	/* function to get the spoc details */
	public function get_spoc_details(){
		return $list = $this->BdSpoc->find('all', array('fields' => array('BdSpoc.id','HrEmployee.first_name', 'HrEmployee.last_name'), 
		'order' => array('HrEmployee.first_name ASC'),'conditions' => array('BdSpoc.status' => 1)));		
	}
	
	/* function to get the proposal version details */
	public function get_proposal_version(){
		return $list = $this->BdProposalVer->find('list', array('fields' => array('id','title'), 
		'order' => array('id ASC'),'conditions' => array('status' => 1)));		
	}

	
	/* function to get the priority details */
	public function get_business_priority(){
		return $list = $this->BdPriority->find('list', array('fields' => array('id','title'), 
		'order' => array('id ASC'),'conditions' => array('status' => 1)));		
	}
	
	/* function to get the business verticals */
	public function get_business_vertical(){
		return $list = $this->HrBusinessUnit->find('list', array('fields' => array('id','business_unit'), 
		'order' => array('business_unit ASC'),'conditions' => array('status' => 1, 'is_deleted' => 'N', 'is_bd' => '1')));		
	}
	
	/* function to get the business source */
	public function get_business_source(){
		return $list = $this->BdBizSource->find('list', array('fields' => array('id','title'), 
		'order' => array('priority ASC'),'conditions' => array('status' => 1)));		
	}
	
		
	/* function to load locations */
	public function load_district($id){
		$loc_list = $this->District->find('list', array('fields' => array('id','district_name'), 'order' => array('district_name ASC'),'conditions' => array('status' => '1',
		'state_id' => $id)));
		return $loc_list;
	}
	
	
	/* function to load locations */
	public function load_state(){
		$loc_list = $this->State->find('list', array('fields' => array('id','state_name'), 'order' => array('state_name ASC'),'conditions' => array('status' => '1')));
		return $loc_list;
	}
	
	
	
	/* function to load the districts options */
	public function load_district_data($id){
		$data = $this->District->find('all', array('fields' => array('id','district_name'), 'conditions' => array('state_id' => $id, 'status' => 'A'), 'order' => array('district_name' => 'asc')));		
		$options .= "<option value=''>Choose District</option>";
		foreach($data as $option){ 
			$options .= "<option value=".$option['District']['id'].">".$option['District']['district_name']."</option>";
		}	
		echo $options;
	}
	
	/* function to get location */
	public function get_location($id){
		$loc_list = $this->District->findById($id, array('fields' => 'district_name'));
		return $loc_list['District']['district_name'];
	}
	
}