{* Purpose : To add the navigation menu to all files.
   Created : Gayathri, Nikitasa
   Date : 04-06-2016 *}

<div id="navigation">
		<div class="container-fluid">
			<ul class='main-nav'>			
			<li class="dropdown" >
					<a href="/hrhome/" style="font-size:20px" data-toggle="dropdown" class='dropdown-toggle'>
						<span>IT</span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="dashboard.php">Home</a></li>
						<li><a href="{IT_DIR}hrhome/">HRIS</a></li>
						<li><a href="{IT_DIR}finhome/" class="">Finance</a></li>
						<li><a href="{IT_DIR}tskhome/" class="">Work Planner</a></li>
						<li><a href="{IT_DIR}tskhome/" class="">Biz Tour</a></li>
						
						<li><a href="{IT_DIR}bdhome/?type=N" class="">BD</a></li>
						
					</ul>
				</li>
				<li class="{$dashboard_active}">
					<a href="dashboard.php">
						<span>Dashboard</span>
					</a>
				</li>
				{if isset($Software)}
				<li class="{$software_active} dropdown">
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
				{/if}
				{if isset($Hardware)}					
				<li class="{$hardware_active} dropdown">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Hardware</span>
						<span class="caret"></span>	
					</a>
					<ul class="{$active} dropdown-menu">
					<li>
					<a href="list_hardware.php">Hardware</a>
					</li>
					<li>
					<a href="add_hardware_details.php">Add Hardware</a>
					
					{if isset($Billing)}	
					<li>
					<a href="list_billing.php">Billing</a>
					</li>
						<li>
					<a href="add_billing_hardware_details.php">Add Billing</a>
					</li>
					{/if}
					
					</li>
					</ul>
				</li>
				{/if}
				{if !empty($AssignAssset) || !empty($ChangeAssetInfo)}
				<li class="{$assign_asset_active} dropdown">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Assign Asset</span>
						<span class="label label-lightred bubble">{if $change_asset_count && $ChangeAssetInfo}{$change_asset_count}{/if}</span>
						<span class="caret"></span>				
					</a>
					<ul class="dropdown-menu">
					{if isset($AssignAssset)}					
					<li>
					<a href="list_assign_asset.php"><span>Assign Asset</span></a>
					</li>
					{/if}
					{if isset($ChangeAssetInfo)}							
					<li>
							<a href="list_change_asset_info.php"><span>Change Asset Info</span> 
							<span class="label label-lightred bubble">{if $change_asset_count}{$change_asset_count}{/if}</span>	
							</a>
						</li>
						{/if}
				
					</ul>
				</li>
           {/if}
		   
		   	{if !empty($ScrapHardware) || !empty($ApproveScrapHardware)}
				<li class="{$scrap_hardware_active} dropdown">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Approve Hardware</span>
						<span class="label label-lightred bubble">{$approve_hw_count}</span>
						<span class="caret"></span>				
					</a>
					<ul class="dropdown-menu">
				
					{if isset($ScrapHardware)}							
					<!--li>
							<a href="list_scrap_hardware.php">Hardware (Scrap, Lost, Resale & Exchange)</a>
						</li-->
						{/if}
						
						 {if isset($ApproveScrapHardware)}							
						<li>
							<a href="list_approve_scrap_hardware.php">Approve Hardware</a>
						</li>
						{/if}
					</ul>
				</li>
           {/if}
		   
		   
				{if isset($HelpDesk)}					
				<li class="{$help_desk_active} dropdown">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Help Desk</span>
						<span class="label label-lightred bubble">{if $ticket_count}{$ticket_count}{/if}</span>	
						<span class="caret"></span>	
					</a>
					<ul class="dropdown-menu">
					<li>
					<a href="list_ticket.php">Ticket <span class="label label-lightred bubble">{if $ticket_count}{$ticket_count}{/if}</span></a>
					</li>
					</ul>
				</li>
				{/if}
				{if isset($Logins)}	
				<li class="{$login_active} dropdown">
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
				{/if}
		     {if !empty($SettingsRoles) || !empty($SettingsSoftwareType) || !empty($SettingsHardwareType) 
		     || !empty($SettingsLoginType) || !empty($SettingsBrand) || !empty($SettingsTicketType)}
				<li class="{$settings_active} dropdown">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Settings</span>
						<span class="caret"></span>		
					</a>
					<ul class="dropdown-menu">
					{if isset($SettingsRoles)}	
					<li>
					<a href="list_role.php">Roles (Access Settings)</a>
					</li>
					{/if}
					{if isset($SettingsSoftwareType)}	
					<li>
					<a href="software_type.php">Software Type</a>
					</li>
					{/if}
					{if isset($SettingsHardwareType)}	
					<li>
					<a href="hardware_type.php">Hardware Type</a>
					</li>
					{/if}
					{if isset($SettingsLoginType)}	
					<li>
					<a href="login_type.php">Login Type</a>
					</li>
					{/if}
					{if isset($SettingsBrand)}	
					<li>
					<a href="list_brand.php">Brand</a>
					</li>
					{/if}
					{if isset($SettingsTicketType)}	
					<li>
					<a href="list_ticket_type.php">Ticket Type</a>
					</li>
					{/if}
					</ul>
				</li>
			
				{/if}	
				
			</ul>
			
			<div class="user" style="">
				<ul class="icon-nav">

			<li class="{$switch_module_active} dropdown language-select">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-reply"></i><span>Switch Module 
						<span class="switchLoad"></span>
						<span class="label label-lightred bubble switchPre switchTot" id="total_count" style="top:14px; right:12px "></span></span>
						</a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="{IT_DIR}home/"><i class="icon-home"></i><span>Home</span></a>
							</li>
							<li>
								<a href="{IT_DIR}hrhome/" class=""><i class="icon-user"></i><span>HRIS
								<span class="switchLoad-sub"></span></span>
								<span class="label label-lightred bubble switchTour switchPre" id="hr_count"></span></a>
							</li>
							<li>
								<a href="{IT_DIR}finhome/" class=""><i class="icon-money"></i><span>Finance
								<span class="switchLoad-sub"></span></span>
							<span class="label label-lightred bubble switchFin switchPre"  id="fin_count"></span>
							</a>
							</li>
							<li>
								<a href="{IT_DIR}tskhome/" class=""><i class="icon-check"></i><span>Work Planner
								<span class="switchLoad-sub"></span></span>
								<span class="label label-lightred bubble switchWork switchPre"  id="tsk_count"></span></a>
							</li>
						
						<li>
								<a href="{IT_DIR}tvlhome/" class=""><i class="icon-plane"></i><span>Biz Tour
								<span class="switchLoad-sub"></span></span>
								<span class="label label-lightred bubble switchTour switchPre"  id="tour_count"></span>
								</a>
							</li>
							<li>
								<a href="{IT_DIR}bdhome/?type=N" class=""><i class="icon-lightbulb"></i><span>BD
								<span class=""></span></span>
								<span class="label label-lightred bubble switchTour switchPre"  id="bd_menu_count"></span></a>
							</li>
						</ul>
					</li>
			
				
				<li class='dropdown language-select'>
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><span><i class="icon-signin"></i> {$smarty.session.user_name} 
						</span></a>
							<ul class="dropdown-menu pull-right">
						<!--li>
							<a href="#">Edit profile</a>
						</li>
						<li>
							<a href="#">Account settings</a>
						</li-->
						<li>
							<a href="{IT_DIR}logins/logout"> Sign out</a>
						</li>
					</ul>
					</li>
					</ul>	
			</div>
		</div>
	</div>