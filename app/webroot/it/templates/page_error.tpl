{* Purpose : To list logins.
   Created : Nikitasa
   Date : 16-06-2016 *}

	{include file='include/header.tpl'}		
	<div id="page_wrapper">
	{include file='include/menu.tpl'}
	
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Error</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
					</ul>
				</div>
						<div class="row-fluid  footer_div previewDiv" >
					<div class="span12">
						<div class="box box-bordered box-color">
						<div class="box-title">
								<h3><i class="icon-list"></i>Error Page</h3>
						</div>
						<form action=" " name="" id="formID" class="" method="post" accept-charset="utf-8">	
							
						<div class="dataTables_wrapper">
						<h1 align="center">{$ntfd}</h1> 
						<h3 align="center">{$msg}</h3>
						<a href="dashboard.php" ><button type="button" val="dashboard.php" class="jsRedirect btn regCancel" >Back</button></a>
							</div>
						 </form>						
						 </div>
					</div>
				</div>
			 </div>
	    </div>			
	</div>
	{include file='include/footer.tpl'}
	</div>
	<input type="hidden" value="/" id="css_root">
	{include file='include/footer_js.tpl'}