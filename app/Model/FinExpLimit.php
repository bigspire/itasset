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

class FinExpLimit extends AppModel {
	
	public $name = 'FinExpLimit';
	 
	public $useTable = 'fin_expense_limit';
	  
	public $primaryKey = 'id';
	
	public $belongsTo = array(		
		'HrGrade' => array(
            'className'  => 'HrGrade',
			'foreignKey' => 'hr_grade_id'			
        ),
		'FinExpCat' => array(
            'className'  => 'FinExpCat',
			'foreignKey' => 'fin_exp_category_id'			
        )
	);

	
	public $validate = array(
			
        'amount' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the amount'
            ),
			 'numeric' => array(
                'rule'     => 'numeric',
                'required' => true,
                'message'  => 'Please enter valid amount (numeric only)'
            )
        ),
		'hr_grade_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the grade name'
            ),
			 'exists' => array(
                'rule'     => 'check_exists',
                'required' => true,
                'message'  => 'Amount already added for this grade for this category'
            )
		),
		'fin_exp_category_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the expense category'
            )
		),
		'status' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the status'
            )
		)
		
	);
	
	public function check_exists(){
		$cat_id = $this->data['FinExpLimit']['fin_exp_category_id'];
		$grade_id = $this->data['FinExpLimit']['hr_grade_id'];
		if($this->data['FinExpLimit']['page'] == 'edit'){
			$edit_cond = array('FinExpLimit.id !=' => $this->data['FinExpLimit']['id']);
		}		
		$count = $this->find('count', array('conditions' => array('fin_exp_category_id' => $cat_id, 'hr_grade_id' => $grade_id, $edit_cond)));
		if($count > 0){
			return false;
		}else{
			return true;
		}
	}
	
	
	
	

	
	
	
	

	
}