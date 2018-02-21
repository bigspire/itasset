

		
	<?php echo $this->element('header'); ?>


	<div class="main-container" id="main-container">
			
			
		
			
			

			<div class="main-container-inner">
				<a class="menu-toggler" id="menu-toggler" href="#">
					<span class="menu-text"></span>
				</a>

				

				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo $this->webroot;?>home/">Home</a>
							</li>
							<li class="active">Organization Updates</li>
								<li class="active"><?php echo $org_detail[0]['HrOrg']['title']; ?></li>
							
						</ul><!-- .breadcrumb -->
						
						
				
											
					</div>
						

					<div class="page-content">
						<!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

							
			
								

								
					
								


								<div class="row" style="margin-top:15px">
									<div class="col-sm-10">
										<div class="widget-box transparent" id="recent-box">
											<div class="widget-header">
											
										
									
									
												<!--h4 class="lighter smaller">
													<i class="icon-rss orange"></i>
													Home
												</h4-->
												
						
							<h4>
								<?php echo $org_detail[0]['HrOrg']['title']; ?>
							
							</h4>
								
							
									
									

												
											</div>

											<div class="widget-body">
												<div class="widget-main padding-4">
												
											<?php echo $org_detail[0]['HrOrg']['desc']; ?>


													<!-- /widget-main -->
											</div><!-- /widget-body -->
										</div><!-- /widget-box -->
									</div><!-- /span -->

								
									</div><!-- /span -->
								</div><!-- /row -->

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->

			
				<!-- /#ace-settings-container -->
			</div><!-- /.main-container-inner -->

		</div><!-- /.main-container -->



		<script src="<?php echo $this->webroot;?>js/jquery.min.js"></script>
		<script src="<?php echo $this->webroot;?>js/jquery.cookie.js"></script>
		
		<script src="<?php echo $this->webroot;?>js/jquery-ui-1.10.4.custom.min.js"></script>

	



		<script src="<?php echo $this->webroot;?>js/bootstrap.min.js"></script>

		<script src="<?php echo $this->webroot;?>js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="<?php echo $this->webroot;?>js/jquery.slimscroll.min.js"></script>
		

		<!-- ace scripts -->

		<script src="<?php echo $this->webroot;?>js/ace-elements.min.js"></script>
		<script src="<?php echo $this->webroot;?>js/ace.min.js"></script>
			<script src="<?php echo $this->webroot;?>js/bootbox.min.js"></script>
		<script src="<?php echo $this->webroot;?>js/main.js"></script>
	
		<!-- inline scripts related to this page -->
	
	
<div id="footer">
	<div class="wrapper">
    	<span>&copy; Copyright <?php echo date('Y');?>. My PDCA. All rights reserved. Powered by <a href="http://bigspire.com" target="_blank" title="BigSpire Software">BigSpire</a>
		
	
		
		</span>
    </div>
</div>



