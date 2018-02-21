<?php 
error_reporting(E_ALL ^ E_NOTICE);
App::import('Vendor','PHPExcel',array('file' => 'excel/PHPExcel.php'));
App::import('Vendor','PHPExcelWriter',array('file' => 'excel/PHPExcel/Writer/Excel2007.php'));
App::import('Vendor','PHPExcelReader',array('file' => 'excel/PHPExcel/Reader/Excel2007.php'));
App::uses('Component', 'Controller');
class ExcelComponent extends Component {
    var $xls;
    var $sheet;
    var $data;
    var $data2;
    var $blacklist = array();
	
	/* initialize component to get data */
	public function initialize(Controller $controller) {
		$this->controller = $controller;
	}
    
    function ExcelComponent() {
        $this->xls = new PHPExcel();
        $this->sheet = $this->xls->getActiveSheet();
        $this->sheet->getDefaultStyle()->getFont()->setName('Verdana');
		
    }
	
	/* function used to read the data in the file */
	 function read_data($file) {		
		 $this->loadFile($file);
		 return $this->extract_data($this->sheet);
    }
	
	function extract_data($sheet){
		$array_data = array();
		$rowIterator = $this->sheet->getRowIterator();
		$col_array = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V');
		foreach($rowIterator as $row){
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
            //if(1 == $row->getRowIndex ()) continue;//skip first row
            $rowIndex = $row->getRowIndex();
			foreach($cellIterator as $cell){
                $count = 1;
                $array_size = sizeof($col_array);
                foreach($col_array as $inner_val){
                    if($inner_val == $cell->getColumn()){
                        if($array_size == $count) {
                            $array_data[$rowIndex][$cell->getColumn()] = PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue());
                        }else{
                             $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
                        }
                    }
                    $count++;
                }
            }
        }
		return $array_data;		
	}

	
                 
    function generate($template, &$data, &$data2, $title = 'Report',$file, $save) { 
		
		$this->loadFile($this->webroot.'uploads/export/'.$template.'.xlsx');
        $this->data =& $data;
		$this->data2 =& $data2;
		
		
		// $this->hdata =& $hdata;
        // $this->_title($title);
        // $this->_headers();
		 $this->template = $template.'_template';
		 $this->_rows($template, $file);
         $this->_output($file, $save);
         return true;
    }   
	
    
    function _title($title) { 
        $this->sheet->setCellValue('A2', $title);
        $this->sheet->getStyle('A2')->getFont()->setSize(14);
        $this->sheet->getRowDimension('2')->setRowHeight(23);
    }
	
	function loadFile($file) {
        $this->reader = new PHPExcel_Reader_Excel2007();
        $this->xls = $this->reader->load("{$file}");
        $this->xls->setActiveSheetIndex(0);
        $this->sheet = $this->xls->getActiveSheet();
        $this->sheet->getDefaultStyle()->getFont()->setName('Calibri');
		$this->sheet->getStyle()->getNumberFormat()->setFormatCode('@');
	
    } 

    function _headers() {
        $i=0;
        foreach ($this->hdata as $field => $value) {
            if (!in_array($value,$this->blacklist)) {
                $columnName = Inflector::humanize($value);
                $this->sheet->setCellValueByColumnAndRow($i++, 4, $columnName);
            }
        }
        $this->sheet->getStyle('A4')->getFont()->setBold(true);
        $this->sheet->getStyle('A4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $this->sheet->getStyle('A4')->getFill()->getStartColor()->setRGB('969696');
        $this->sheet->duplicateStyle( $this->sheet->getStyle('A4'), 'B4:'.$this->sheet->getHighestColumn().'4');
      
    }
	
	
	function _rows($template, $file) { 

		$i = 3; $j = 0;	
		
		if($template == 'approver'){
		// header title
		$this->sheet->getStyle('A1')->getFont()->setBold(true);
        $this->sheet->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $this->sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('F7D9F2');
		$this->sheet->setCellValueByColumnAndRow(0, 1, $file);
		

			// for testing.
			for($k=0;$k<count($this->data);$k++){
				foreach($this->data[$k] as $key => $value) { 
					switch($key){
						case 'Home';
						$value =  $value['first'].' '.$value['last'];
						break;
						case 'tbl_level1';
						$value =  $value['l1_first'].' '.$value['l1_last'];
						break;
						case 'tbl_level2';
						$value =  $value['l2_first'].' '.$value['l2_last'];
						break;
						case 'Approve';					
						if(!empty($value['modified_date'])){
							$date =  $value['modified_date'];
						}else{
							$date =  $value['created_date'];
						}
						$value = '';
						break;
					}
					if(!empty($value)){
						$this->sheet->setCellValueByColumnAndRow($j++,$i, $value);
					}
					// for last modified
					if($j == 3){					
						$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->format_date($date));
					}
				}
				$i++;
				$j = 0;
			}
		}else if($template == 'expense'){
			$i = 2; $j = 0;
				$controller = $this->controller->request->params['controller'] == 'finexpense' ? 'FinExpense' : 'FinExpApprove';
				// print exp. details
				$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->data2[$controller]['expense_no']);
				$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->data2['Home']['first_name'].' '.$this->data2['Home']['last_name']);
				$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->format_date($this->data2[$controller]['created_date']));
				$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->data2['TskCustomer']['company_name']);
				$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->data2['TskProject']['project_name']);
				$this->sheet->setCellValueByColumnAndRow($j++,$i, 'Rs. '.$this->data2[$controller]['amount']);
				
				$i += 3;
				$j = 0;
				// print exp. list
				foreach($this->data as $key => $value) {
					$this->sheet->setCellValueByColumnAndRow($j++,$i,$this->format_date($value['FinExpList']['date_exp']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['FinExpCat']['category']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['FinExpList']['description']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['FinExpList']['amount']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->check_status($value['FinExpList']['billable']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->check_status($value['FinExpList']['bill_avail']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['FinExpList']['bill_refno']);
					$j = 0;
					$i++;
					
					if((count($this->data) - 1) == $key){ 
						//$this->sheet->setCellValueByColumnAndRow(2,$i, 'Total');
						$this->sheet->getStyle($i, 3)->getFont()->setBold(true);
						$this->sheet->getStyle($i, 3)->getFont()->setBold(true);
						$this->sheet->setCellValueByColumnAndRow(3,$i, $this->data2[$controller]['amount']);
					}
				}
				
			//}
		}else if($template == 'employee'){
				$i = 2;
				foreach($this->data as $key => $value) {
					$this->sheet->setCellValueByColumnAndRow($j++,$i,$value['HrEmployee']['first_name']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrEmployee']['last_name']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->show_gender($value['HrEmployee']['gender']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->format_date($value['HrEmployee']['dob']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrEmployee']['email_address']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrEmployee']['emp_no']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrDepartment']['dept_name']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrDesignation']['desig_name']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrBusinessUnit']['business_unit']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['Role']['role_name']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrBranch']['branch_name']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrEmployee']['official_contact_no']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrEmployee']['contact_no']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrEmployee']['landline']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrEmployee']['personal_email']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrEmployee']['communication_addr']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrEmployee']['permanent_addr']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->marital_status($value['HrEmployee']['marital_status']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->format_date($value['HrEmployee']['wedding_date']));					
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrBloodGroup']['blood_group']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->format_date($value['HrEmployee']['doj']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->format_date($value['HrEmployee']['doc']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrEmployee']['pan']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrEmployee']['insurance_no']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrEmployee']['pf_no']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrEmployee']['esi_no']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrEmployee']['emergency_contact_person']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrEmployee']['emergency_contact_no']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrEmployee']['emergency_relation']);	
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrEmployee']['skype']);	

					$i++;	 $j= 0;			
				}
				
			//}
		}else if($template == 'advance'){
				$i = 2;
				foreach($this->data as $key => $value) {
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->format_date($value['FinAdvances']['created_date']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i,$value['Home']['first_name'].' '.$value['Home']['last_name']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->get_adv_id($value['FinAdvances']['id']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['FinAdvances']['purpose']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['FinAdvances']['req_amount']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->format_date($value['FinAdvances']['req_date']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value[0]['tot_amt']);				
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->show_pay_status($value['FinAdvances']['req_amount'],$value[0]['tot_amt'], $value['FinAdvPay']['paid_amount'],$value['FinAdvPay']['paid_date']));					
					$i++;	 $j= 0;			
				}				
			//}
		}else if($template == 'expense_pay'){
				$i = 2;
				foreach($this->data as $key => $value) {
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->format_date($value['FinExpenses2']['created_date']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i,ucfirst($value['Home']['first_name']).' '.ucfirst($value['Home']['last_name']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['FinExpenses2']['expense_no']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['Customer']['company_name']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['Project']['project_name']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['FinExpenses2']['amount']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->show_exppay_status($value['FinExpPay']['created_date']));					
					$i++;	 $j= 0;			
				}				
			//}
		}else if($template == 'individual_plan' || $template == 'company_plan'){
			$i = 2;
			foreach($this->data as $key => $value) {
				$this->sheet->setCellValueByColumnAndRow($j++,$i,$value[1]);
				$plan_split = explode('|', $value[0]);
				$this->sheet->setCellValueByColumnAndRow($j++,$i, $plan = $plan_split[0] > 100 ? 100 : $plan_split[0]);
				$this->sheet->setCellValueByColumnAndRow($j++,$i, $unplan =  $plan_split[1] > 100 ? 100 : $plan_split[1]);
				$no_plan = 100 - ($plan_split[1] + $plan_split[0]);
				$this->sheet->setCellValueByColumnAndRow($j++,$i, $no_plan = $no_plan < 0 ? 0 : $no_plan);

				
				//$this->sheet->getStyle('B'.$i)->getFill()->getStartColor()->setRGB('FF0000');
				
				//$this->sheet->setCellValueByColumnAndRow($j++,$i, 100-$value[0]);
				$i++;
				$j= 0;		
			}
		}else if($template == 'travel'){ 
				$i = 2;
				foreach($this->data as $key => $value) { 
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['TvlReq']['tvl_code']);
					$booking_date = $value['TvlTicket']['book_date'] ? $value['TvlTicket']['book_date'] : $value['TvlTicket']['created_date'];
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->format_date($booking_date));
					$this->sheet->setCellValueByColumnAndRow($j++,$i,$value[0]['passenger']);
					$doj = $value['TvlTicket']['tkt_type'] == 'R' ? $value['TvlReq']['return_date'] : $value['TvlReq']['start_date'];
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->format_date($doj));
					$start_place = $value['TvlTicket']['tkt_type'] == 'R' ? $value['Destination']['place'] : $value['Source']['place'];	
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $start_place);
					$dest_place = $value['TvlTicket']['tkt_type'] == 'O' ? $value['Destination']['place'] : $value['Source']['place'];	

					$this->sheet->setCellValueByColumnAndRow($j++,$i, $dest_place);
					
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['Employee']['first_name']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i,$value[0]['approver']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['TvlReq']['purpose']);

					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['Company']['company_name']);
									
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['TvlTicket']['amount']);		
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $status = $value['TvlReq']['status'] == 'A' ? 'Yes' : 'No');	
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['TvlTicket']['book_ref_no']);						
					$i++;	 $j= 0;			
				}				
			
		}else if($template == 'survey'){ 
				$i = 1; $j = 1;
				$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->data[0]['Employee']['first_name'].' '.$this->data[0]['Employee']['last_name']);
				$i = 2; $j = 0;
				foreach($this->data as $key => $value) { 
					$this->sheet->setCellValueByColumnAndRow($j++,$i, strip_tags($value['SurveyQn']['question']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i, strip_tags($value['SurveyAns']['answer']));					
					$i++;	 $j= 0;			
				}				
			
		}else if($template == 'voice'){ 
				$i = 1; $j = 1;
				$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->data[0]['Employee']['first_name'].' '.$this->data[0]['Employee']['last_name']);
				$i = 3; $j = 0;
				foreach($this->data as $key => $value) { 
					$this->sheet->setCellValueByColumnAndRow($j++,$i, ++$key);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['VoiceQn']['msg']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->get_message_type($value['VoiceQn']['type']));					
					$i++;	 $j= 0;			
				}				
			
		}else if($template == 'business'){
				$i = 2;
				foreach($this->data as $key => $value) {
					$this->sheet->setCellValueByColumnAndRow($j++,$i,ucwords($value['BdBusiness']['company_name']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['State']['state_name'].', '.$value['District']['district_name']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['BdBusiness']['address']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->format_date($value['BdBusiness']['created_date']));

					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['Creator']['first_name'].' '.$value['Creator']['last_name']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['BdOpportunity']['title']);

					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['BdPriority']['title']);
					
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['BdBizSource']['title']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, ucwords($value['BdBusiness']['referrer']));

					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->get_biz_type($value['BdBusiness']['type']));
					/*
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value[0]['contact']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value[0]['email']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value[0]['mobile']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value[0]['designation']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value[0]['address']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value[0]['review_record']);
					*/
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->format_date($value['BdBusiness']['dofd']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->check_status($value['BdBusiness']['cb_share']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['Employee']['first_name'].' '.$value['Employee']['last_name']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['HrBusinessUnit']['business_unit']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->check_status($value['BdBusiness']['sow_done']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['BdBusiness']['sow_detail']);

					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->check_status($value['BdBusiness']['proposal_done']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['BdBusiness']['project_name']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['BdProposalVer']['title']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->format_date($value['BdBusiness']['proposal_date']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->check_status($value['BdBusiness']['proposal_approve']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->check_status($value['BdBusiness']['agreement_sign']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $value['BdBusiness']['agreement_no']);
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->check_status($value['BdBusiness']['work_start']));
					$this->sheet->setCellValueByColumnAndRow($j++,$i, $this->check_status($value['BdBusiness']['work_complete']));
					$i++;	 $j= 0;			
				}
				
			//}
		}
	}
	
	/* function to get the business type */
	public function get_biz_type($type){
		switch($type){
			case 'N':
			$msg = 'New';
			break;
			case 'E':
			$msg = 'Existing';
			break;
			case 'O':
			$msg = 'Old';
			break;
		}
		return $msg;
	}
	
	/* function to get the message type */
	public function get_message_type($type){
		if($type == 'Q'){
			return 'Question';
		}else if($type == 'S'){
			return 'Suggestion';
		}else if($type == 'I'){
			return 'Idea';
		}
	}
	
		
	/* function used to format the date */
	public function format_date($date){ 
		if(!empty($date) && $date!= '0000-00-00' && $date!= '0000-00-00 00:00:00'){
			$date =  split("[-: ]", $date);
			return date('d-M-Y',mktime($date[3],$date[4],$date[5],$date[1],$date[2],$date[0]));
		}
	}
	
	
	/* function to show marital */
	public function marital_status($st){
		if($st == 1){
			return 'Single';
		}else if($st == 2){
			return 'Married';
		}
	}
	
	
     /* function to check the status */
   public function check_status($st){
		if($st != ''){
			return $st == '1' ? 'Yes' : 'No';
		}
   }    
    
	function _rows2($template) { //echo '<pre>'; print_r($this->data);
		$i = 2; $j = 0; 
		// for testing.
	//	for($k = 0; $k < count($this->data); $k++){
			foreach($this->data as $value) { //echo '<pre>'; print_r($value);
				$value = $value['Home']['first'];
				$this->sheet->setCellValueByColumnAndRow($j++,$i, $value);
			}
			//echo 'ravi';
			
			$i++;
			$j = 0;
			
		//}
	}


    function _output($title,$save) {
		$objWriter = new PHPExcel_Writer_Excel2007($this->xls);
		
		if($save){
			$objWriter->save('uploads/tmp/'.$title.'.xls');
			return;
		}
	
       header("Content-type: application/vnd.ms-excel"); 
       header('Content-Disposition: attachment;filename="'.$title.'.xlsx"');
       header('Cache-Control: max-age=0');
	   $this->xls->getActiveSheet()->setTitle($title);

		// Save Excel 2007 file
		//echo date('H:i:s') . " Write to Excel2007 format\n";
		
		//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $objWriter->save('php://output');
		/*
        $objWriter = new PHPExcel_Writer_Excel5($this->xls);
        $objWriter->setTempDir('tmp');
        $objWriter->save('php://output');
		*/
		
		
		exit;
	}
	
	
	/* to show the gender */
	public function show_gender($gen){
		if($gen == 'F'){
			return 'Female';
		}else if($gen == 'M'){
			return 'Male';
		}
	}
	
		 /* parse the status of the email send */
   public function show_pay_status($amt, $tot,$paid_amt, $paid_date){ 
		if(empty($tot)){
			$type = 'Not Paid';
		}else if($amt > $tot){
			$type = 'Partial';
		}else if($tot == $amt){
			$type = 'Paid';
		}else if($amt < $tot){
			$type = 'Overlimit';
		}		
		return $type;
   }
   
   /* function to show adv. id */
	public function get_adv_id($id){
		return  str_pad($id, 3, 0, STR_PAD_LEFT);		
	}
   
	   	 /* parse the status of the expense pay */
   public function show_exppay_status($date){		
		$st_value = $date === NULL ? 'Not Paid' : 'Paid';	
		return $st_value;	
   }
   
}
?>