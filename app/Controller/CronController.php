<?php
class CronController extends AppController {

	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->layout=null;
	}

	public function test() {
		// Check the action is being invoked by the cron dispatcher 
		if (!defined('CRON_DISPATCHER')) { $this->redirect('/'); exit(); } 

		
		//no view
		$this->autoRender = false;

		//do stuff...

		return;
	}
}

?>