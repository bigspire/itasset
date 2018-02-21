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

class HrEducation extends AppModel {
	
	public $name = 'HrEducation';
	 
	public $useTable = 'hr_emp_education';
	  
	public $primaryKey = 'id';
	
	public $belongsTo = array(		
		'HrCourse' => array(
            'className'  => 'HrCourse',
			'foreignKey' => 'hr_course_id'			
        ),
		'HrSpec' => array(
            'className'  => 'HrSpec',
			'foreignKey' => 'hr_specialization_id'			
        )
	);
	
	/*
	public $validate = array(		
		
		'inst_name1' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the school name'
            )
		),		
		
		'inst_name4' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the college name'
            )
		)
		,		
		
		'percent_marks1' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the % of marks'
            )
		)
		,		
		
		'percent_marks4' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the % of marks'
            )
		),		
		
		'year_passing1' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the year of passing'
            )
		)
		,		
		
		'year_passing4' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the year of passing'
            )
		),		
		
		'board1' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the board'
            )
		),		
		
		'hr_course_id4' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the course name'
            )
		),		
		
		'hr_specialization_id4' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the specialization'
            )
		),		
		
		'percent_marks4' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the % of marks'
            )
		)
		,		
		
		'university4' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter university name'
            )
		),		
		
		'course_type4' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the course type'
            )
		)
		
	);
	*/
	
}