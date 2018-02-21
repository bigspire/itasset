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

class BdHome extends AppModel {
	
	public $name = 'BdHome';
	 
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
		'District' => array(
            'className'  => 'District',
			'foreignKey' => 'district_id'			
        ),
		'State' => array(
            'className'  => 'State',
			'foreignKey' => 'state_id'			
        ),
		'BdBizSource' => array(
            'className'  => 'BdBizSource',
			'foreignKey' => 'bd_business_source_id'			
        )
	);
	
	
	/* get diff b/w the date */
	public function diff_date($from, $to){ 
		$sql = "SELECT DATEDIFF('$to','$from') AS date_diff";
		$result = $this->query($sql);		
		return $result[0][0]['date_diff'];

	}
	
	/* function to get the spoc details */
	public function get_spoc_details(){
		return $list = $this->BdSpoc->find('all', array('fields' => array('BdSpoc.id','HrEmployee.first_name', 'HrEmployee.last_name'), 
		'order' => array('HrEmployee.first_name ASC'),'conditions' => array('BdSpoc.status' => 1)));		
	}
	
}