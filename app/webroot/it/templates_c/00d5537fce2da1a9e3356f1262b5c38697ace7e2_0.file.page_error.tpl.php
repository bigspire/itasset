<?php
/* Smarty version 3.1.29, created on 2018-02-28 11:03:48
  from "C:\xampp\htdocs\2017\itassetsvn\itasset\app\webroot\it\templates\page_error.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a963f3c280d95_42941352',
  'file_dependency' => 
  array (
    '00d5537fce2da1a9e3356f1262b5c38697ace7e2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\page_error.tpl',
      1 => 1519292829,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:include/header.tpl' => 1,
    'file:include/menu.tpl' => 1,
    'file:include/footer.tpl' => 1,
    'file:include/footer_js.tpl' => 1,
  ),
),false)) {
function content_5a963f3c280d95_42941352 ($_smarty_tpl) {
?>


	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		
	<div id="page_wrapper">
	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	
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
						<h1 align="center"><?php echo $_smarty_tpl->tpl_vars['ntfd']->value;?>
</h1> 
						<h3 align="center"><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</h3>
						<a href="dashboard.php" ><button type="button" val="dashboard.php" class="jsRedirect btn regCancel" >Back</button></a>
							</div>
						 </form>						
						 </div>
					</div>
				</div>
			 </div>
	    </div>			
	</div>
	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	</div>
	<input type="hidden" value="/" id="css_root">
	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer_js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
