	

		<div class="wrapper">
		<!--h1><a href="#">My PDCA</a></h1-->
		<div class="login-body">
		
	<img style="margin:10px 70px;" width="250" height="39" src="<?php echo $this->webroot;?>img/career-tree-logo-large.jpg"/>
	
	
			<h2 style="padding:2px 30px 5px 30px;">SIGN IN</h2>
			<?php echo $this->Form->create('Login', array('id' => 'formID', 'class' => '')); ?>
			

	
	
	<?php echo $this->Session->flash();?>
	
	
	
				<div class="control-group">
					<div class="email controls">
						<?php echo $this->Form->input('email', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-block-level',  'required' => false, 'placeholder' => 'Email Address', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
						
					
					</div>
				</div>
				<div class="control-group">
					<div class="pw controls">
						<?php echo $this->Form->input('mypassword', array('div'=> false,'type' => 'password', 'label' => false, 'class' => 'input-block-level', 'placeholder' => 'Password',  'required' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
						
						
					</div>
				</div>
				<div class="submit">
					<!--div class="remember">
						<input type="checkbox" name="remember" class='icheck-me' data-skin="square" data-color="blue" id="remember"> <label for="remember">Remember me</label>
					</div-->
					<input type="submit" value="Sign me in" class="btn btn-primary" />
					
				</div>
			<?php echo $this->Form->end(); ?>
			<div class="forget" style="margin-top:10px;">
				<a href="javascript:void(0)"><span>Copyright &copy; <?php echo date('Y'); ?> Career Tree.</span></a>
			</div>
		</div>
	</div>
	
	
	
	<div class="modal" id="myBrowser" style="display:none">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove small"></i></button>
          <h4 class="modal-title">Oops! Unsupported Browser</h4>
        </div><div class="container"></div>
        <div class="modal-body">
        
		
				 <div class="user-profile row" style="margin-left:20px">
		
	Dear User, <br><br>My PDCA is currently supported in Internet Explorer (9 and above), Google Chrome and Firefox latest versions.
	
	<br><br>
	We are sorry for the inconvenience caused.
	
	<br><br>
	Please download latest version of <a href="https://www.google.com/intl/en_in/chrome/browser/">Google Chrome</a> or <a href="https://www.mozilla.org/en-US/firefox/new/">Mozilla Firefox</a> and start using MyPDCA...
									</div>
        
		
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Close</a>
        </div>
      </div>
    </div>
</div>

		<div id="disablingDiv"></div>
			<input type="hidden" value="1" id="browserChk">
			<input type="hidden" value="1" id="loginPage">