<?php
/* Smarty version 3.1.29, created on 2018-04-16 16:36:51
  from "C:\xampp\htdocs\2017\itassetsvn\itasset\app\webroot\it\templates\include\menu.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ad483cb3706f7_22809171',
  'file_dependency' => 
  array (
    '1bce1e980f092a1a6da0d347ba547198b46e05fb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\include\\menu.tpl',
      1 => 1523876664,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ad483cb3706f7_22809171 ($_smarty_tpl) {
?>


<div id="navigation">
		<div class="container-fluid">
			<ul class='main-nav'>			
			<li class="dropdown" >
					<a href="/hrhome/" style="font-size:20px" data-toggle="dropdown" class='dropdown-toggle'>
						<span>IT</span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="dashboard.php">Home</a></li>
						<li><a href="<?php echo IT_DIR;?>
hrhome/">HRIS</a></li>
						<li><a href="<?php echo IT_DIR;?>
finhome/" class="">Finance</a></li>
						<li><a href="<?php echo IT_DIR;?>
tskhome/" class="">Work Planner</a></li>
						<li><a href="<?php echo IT_DIR;?>
tskhome/" class="">Biz Tour</a></li>
						
						<li><a href="<?php echo IT_DIR;?>
bdhome/?type=N" class="">BD</a></li>
						
					</ul>
				</li>
				<li class="<?php echo $_smarty_tpl->tpl_vars['dashboard_active']->value;?>
">
					<a href="dashboard.php">
						<span>Dashboard</span>
					</a>
				</li>
				<?php if (isset($_smarty_tpl->tpl_vars['Software']->value)) {?>
				<li class="<?php echo $_smarty_tpl->tpl_vars['software_active']->value;?>
 dropdown">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Software</span>
						<span class="caret"></span> 	
					</a>
					<ul class="dropdown-menu">
					<li>
					<a href="list_software.php">Software</a>
					</li>			
					<li>
					<a href="add_software_details.php">Add Software</a>
					</li>
					</ul>
				</li>
				<?php }?>
				<?php if (isset($_smarty_tpl->tpl_vars['Hardware']->value)) {?>					
				<li class="<?php echo $_smarty_tpl->tpl_vars['hardware_active']->value;?>
 dropdown">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Hardware</span>
						<span class="caret"></span>	
					</a>
					<ul class="<?php echo $_smarty_tpl->tpl_vars['active']->value;?>
 dropdown-menu">
					<li>
					<a href="list_hardware.php">Hardware</a>
					</li>
					<li>
					<a href="add_hardware_details.php">Add Hardware</a>
					
					<?php if (isset($_smarty_tpl->tpl_vars['Billing']->value)) {?>	
					<li>
					<a href="list_billing.php">Billing</a>
					</li>
						<li>
					<a href="add_billing_hardware_details.php">Add Billing</a>
					</li>
					<?php }?>
					
					</li>
					</ul>
				</li>
				<?php }?>
				<?php if (!empty($_smarty_tpl->tpl_vars['AssignAssset']->value) || !empty($_smarty_tpl->tpl_vars['ChangeAssetInfo']->value)) {?>
				<li class="<?php echo $_smarty_tpl->tpl_vars['assign_asset_active']->value;?>
 dropdown">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Assign Asset</span>
						<span class="label label-lightred bubble"><?php if ($_smarty_tpl->tpl_vars['change_asset_count']->value && $_smarty_tpl->tpl_vars['ChangeAssetInfo']->value) {
echo $_smarty_tpl->tpl_vars['change_asset_count']->value;
}?></span>
						<span class="caret"></span>				
					</a>
					<ul class="dropdown-menu">
					<?php if (isset($_smarty_tpl->tpl_vars['AssignAssset']->value)) {?>					
					<li>
					<a href="list_assign_asset.php"><span>Assign Asset</span></a>
					</li>
					<?php }?>
					<?php if (isset($_smarty_tpl->tpl_vars['ChangeAssetInfo']->value)) {?>							
					<li>
							<a href="list_change_asset_info.php"><span>Change Asset Info</span> 
							<span class="label label-lightred bubble"><?php if ($_smarty_tpl->tpl_vars['change_asset_count']->value) {
echo $_smarty_tpl->tpl_vars['change_asset_count']->value;
}?></span>	
							</a>
						</li>
						<?php }?>
				
					</ul>
				</li>
           <?php }?>
		   
		   	<?php if (!empty($_smarty_tpl->tpl_vars['ScrapHardware']->value) || !empty($_smarty_tpl->tpl_vars['ApproveScrapHardware']->value)) {?>
				<li class="<?php echo $_smarty_tpl->tpl_vars['scrap_hardware_active']->value;?>
 dropdown">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Approve Hardware</span>
						<span class="label label-lightred bubble"><?php echo $_smarty_tpl->tpl_vars['approve_hw_count']->value;?>
</span>
						<span class="caret"></span>				
					</a>
					<ul class="dropdown-menu">
				
					<?php if (isset($_smarty_tpl->tpl_vars['ScrapHardware']->value)) {?>							
					<!--li>
							<a href="list_scrap_hardware.php">Hardware (Scrap, Lost, Resale & Exchange)</a>
						</li-->
						<?php }?>
						
						 <?php if (isset($_smarty_tpl->tpl_vars['ApproveScrapHardware']->value)) {?>							
						<li>
							<a href="list_approve_scrap_hardware.php">Approve Hardware</a>
						</li>
						<?php }?>
					</ul>
				</li>
           <?php }?>
		   
		   
				<?php if (isset($_smarty_tpl->tpl_vars['HelpDesk']->value)) {?>					
				<li class="<?php echo $_smarty_tpl->tpl_vars['help_desk_active']->value;?>
 dropdown">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Help Desk</span>
						<span class="label label-lightred bubble"><?php if ($_smarty_tpl->tpl_vars['ticket_count']->value) {
echo $_smarty_tpl->tpl_vars['ticket_count']->value;
}?></span>	
						<span class="caret"></span>	
					</a>
					<ul class="dropdown-menu">
					<li>
					<a href="list_ticket.php">Ticket <span class="label label-lightred bubble"><?php if ($_smarty_tpl->tpl_vars['ticket_count']->value) {
echo $_smarty_tpl->tpl_vars['ticket_count']->value;
}?></span></a>
					</li>
					</ul>
				</li>
				<?php }?>
				<?php if (isset($_smarty_tpl->tpl_vars['Logins']->value)) {?>	
				<li class="<?php echo $_smarty_tpl->tpl_vars['login_active']->value;?>
 dropdown">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Logins</span>
						<span class="caret"></span>	
					</a>
					<ul class="dropdown-menu">
					<li>
					<a href="list_login.php">Login</a>
					</li>
					<li>
					<a href="add_login.php">Add Login</a>
					</li>
					</ul>
				</li>
				<?php }?>
		     <?php if (!empty($_smarty_tpl->tpl_vars['SettingsRoles']->value) || !empty($_smarty_tpl->tpl_vars['SettingsSoftwareType']->value) || !empty($_smarty_tpl->tpl_vars['SettingsHardwareType']->value) || !empty($_smarty_tpl->tpl_vars['SettingsLoginType']->value) || !empty($_smarty_tpl->tpl_vars['SettingsBrand']->value) || !empty($_smarty_tpl->tpl_vars['SettingsTicketType']->value)) {?>
				<li class="<?php echo $_smarty_tpl->tpl_vars['settings_active']->value;?>
 dropdown">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Settings</span>
						<span class="caret"></span>		
					</a>
					<ul class="dropdown-menu">
					<?php if (isset($_smarty_tpl->tpl_vars['SettingsRoles']->value)) {?>	
					<li>
					<a href="list_role.php">Roles (Access Settings)</a>
					</li>
					<?php }?>
					<?php if (isset($_smarty_tpl->tpl_vars['SettingsSoftwareType']->value)) {?>	
					<li>
					<a href="software_type.php">Software Type</a>
					</li>
					<?php }?>
					<?php if (isset($_smarty_tpl->tpl_vars['SettingsHardwareType']->value)) {?>	
					<li>
					<a href="hardware_type.php">Hardware Type</a>
					</li>
					<?php }?>
					<?php if (isset($_smarty_tpl->tpl_vars['SettingsLoginType']->value)) {?>	
					<li>
					<a href="login_type.php">Login Type</a>
					</li>
					<?php }?>
					<?php if (isset($_smarty_tpl->tpl_vars['SettingsBrand']->value)) {?>	
					<li>
					<a href="list_brand.php">Brand</a>
					</li>
					<?php }?>
					<?php if (isset($_smarty_tpl->tpl_vars['SettingsTicketType']->value)) {?>	
					<li>
					<a href="list_ticket_type.php">Ticket Type</a>
					</li>
					<?php }?>
					</ul>
				</li>
			
				<?php }?>	
				
			</ul>
			
			<div class="user" style="">
				<ul class="icon-nav">

			<li class="<?php echo $_smarty_tpl->tpl_vars['switch_module_active']->value;?>
 dropdown language-select">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-reply"></i><span>Switch Module 
						<span class="switchLoad"></span>
						<span class="label label-lightred bubble switchPre switchTot" id="total_count" style="top:14px; right:12px "></span></span>
						</a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="<?php echo IT_DIR;?>
home/"><i class="icon-home"></i><span>Home</span></a>
							</li>
							<li>
								<a href="<?php echo IT_DIR;?>
hrhome/" class=""><i class="icon-user"></i><span>HRIS
								<span class="switchLoad-sub"></span></span>
								<span class="label label-lightred bubble switchTour switchPre" id="hr_count"></span></a>
							</li>
							<li>
								<a href="<?php echo IT_DIR;?>
finhome/" class=""><i class="icon-money"></i><span>Finance
								<span class="switchLoad-sub"></span></span>
							<span class="label label-lightred bubble switchFin switchPre"  id="fin_count"></span>
							</a>
							</li>
							<li>
								<a href="<?php echo IT_DIR;?>
tskhome/" class=""><i class="icon-check"></i><span>Work Planner
								<span class="switchLoad-sub"></span></span>
								<span class="label label-lightred bubble switchWork switchPre"  id="tsk_count"></span></a>
							</li>
						
						<li>
								<a href="<?php echo IT_DIR;?>
tvlhome/" class=""><i class="icon-plane"></i><span>Biz Tour
								<span class="switchLoad-sub"></span></span>
								<span class="label label-lightred bubble switchTour switchPre"  id="tour_count"></span>
								</a>
							</li>
							<li>
								<a href="<?php echo IT_DIR;?>
bdhome/?type=N" class=""><i class="icon-lightbulb"></i><span>BD
								<span class=""></span></span>
								<span class="label label-lightred bubble switchTour switchPre"  id="bd_menu_count"></span></a>
							</li>
						</ul>
					</li>
			
				
				<li class='dropdown language-select'>
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><span><i class="icon-signin"></i> <?php echo $_SESSION['user_name'];?>
 
						</span></a>
							<ul class="dropdown-menu pull-right">
						<!--li>
							<a href="#">Edit profile</a>
						</li>
						<li>
							<a href="#">Account settings</a>
						</li-->
						<li>
							<a href="<?php echo IT_DIR;?>
logins/logout"> Sign out</a>
						</li>
					</ul>
					</li>
					</ul>	
			</div>
		</div>
	</div><?php }
}
