<!doctype html>
<?php
/*******************************************************************************************************
 * Name                     Date               Ticket         Description
 * =====================================================================================================
 * Erin Briggs (ERB)        10/18/2012         108            Limit menu items available based on user role
 * 
 ******************************************************************************************************/
?>
<!--[if IE 7]>    <html class="no-js ie7 ie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>AchieveLinks Admin</title>

	<meta name="viewport" content="width=device-width,initial-scale=1">

	<link rel="stylesheet" href="<?print base_url();?>css/custom-theme/jquery-ui-1.8.20.custom.css" />
	<link rel="stylesheet" href="<?print base_url();?>css/jquery.qtip.min.css">
	<link rel="stylesheet" href="<?print base_url();?>css/colorbox.css" />
	<link rel="stylesheet" href="<?print base_url();?>css/jquery.jgrowl.css">
	<link rel="stylesheet" href="<?print base_url();?>css/colorpicker/css/colorpicker.css" media="screen" />
	<link rel="stylesheet" href="<?print base_url();?>css/style.css" />
    <!-- <link href="<?print base_url();?>css/TableTools.css" rel="stylesheet" /> -->
	
	<script src="<?print base_url();?>js/modernizr-2.0.6.min.js"></script>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
	<script>window.jQuery || document.write('<script src="<?print base_url()."js/jquery-1.7.2.min.js";?>"><\/script>')</script>
	
	<script src="<?print base_url();?>js/jquery-ui-1.8.20.custom.min.js"></script>
	<script src="<?print base_url();?>js/jquery.validate.js"></script>
	<script src="<?print base_url();?>js/additional-methods.js"></script>
	<script src="<?print base_url();?>js/jquery.ui.potato.menu.js"></script>
	<script src="<?print base_url();?>js/jquery.qtip.min.js"></script>
	<script src="<?print base_url();?>js/jquery.dataTables1.9.2.min.js"></script>
	<script src="<?print base_url();?>js/jquery.jgrowl_minimized.js"></script>
	<script src="<?print base_url();?>js/jquery.colorbox-min.js"></script>
	<script src="<?print base_url();?>ckeditor/ckeditor.js"></script>
	<script src="<?print base_url();?>ckeditor/adapters/jquery.js"></script>
	<script src="<?print base_url();?>js/colorpicker.js"></script>	
    <!-- <script type="text/javascript" src="<?php print base_url();?>js/TableTools.js" ></script>
    <script type="text/javascript" src="<?php print base_url();?>js/ZeroClipboard.js" ></script> -->
	

	<script src="<?print base_url();?>js/script.js"></script>

	<!--[if lt IE 7 ]>
		<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
		<script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
	<![endif]-->

</head>
<body>

<div id="container"><?php
    // print "CodeIgniter Version: ".CI_VERSION;
	if($this->db->hostname == "50.56.28.216"){?>
		<p class="ui-state-error ui-corner-all"><span class="ui-icon ui-icon-alert"></span>Using The Production Database.</p><?php
	}?>
	<header class="ui-widget-header ui-corner-top">
		<nav>
			<ul class="potato-menu">
				<?if($this->session->userdata('account_id') > 0){?>
					<li<?if($this->uri->segment(1) == "associations" || $this->uri->segment(1) == "industries" || $this->uri->segment(1) == "contentboxes" || $this->uri->segment(2) == "default_offers")print ' class="current"';?>>
						<a href="<?print base_url();?>associations" class="ui-button ui-widget ui-state-default">Associations</a>
						<ul>
							<li<?if($this->uri->segment(1) == "contentboxes")print ' class="current"';?>>
								<a href="<?print base_url();?>contentboxes" class="ui-button ui-widget ui-state-default">Content Boxes</a>
							</li>
							<?php if ($this->session->userdata('level') != 3) { ?>
								<li<?if($this->uri->segment(1) == "industries")print ' class="current"';?>>
									<a href="<?print base_url();?>industries" class="ui-button ui-widget ui-state-default">Industries</a>
								</li>
								<li<?if($this->uri->segment(2) == "default_offers")print ' class="current"';?>>
									<a href="<?print base_url();?>associations/default_offers" class="ui-button ui-widget ui-state-default">Default Offers</a>
								</li>
								<li<?if($this->uri->segment(2) == "default_showcases")print ' class="current"';?>>
									<a href="<?print base_url();?>associations/default_showcases" class="ui-button ui-widget ui-state-default">Default Showcases</a>
								</li>
							<?php } ?>
						</ul>
					</li>

					<li<?if($this->uri->segment(1) == "members" || $this->uri->segment(1) == "transactions")print ' class="current"';?>>
						<a href="<?print base_url();?>members" class="ui-button ui-widget ui-state-default">Members</a>
						<?php if ($this->session->userdata('level') != 3) { ?>
							<ul>
								<li<?if($this->uri->segment(1) == "transactions")print ' class="current"';?>>
									<a href="<?print base_url();?>transactions" class="ui-button ui-widget ui-state-default">Transactions</a>
								</li>
	
								<li<?if($this->uri->segment(2) == "auto_enroll")print ' class="current"';?>>
									<a href="<?print base_url();?>members/auto_enroll_import" class="ui-button ui-widget ui-state-default">Auto Enroll Import</a>
								</li>
								<li<?if($this->uri->segment(2) == "member_export")print ' class="current"';?>>
									<a href="<?print base_url();?>members/member_export" class="ui-button ui-widget ui-state-default">Member Export</a>
								</li>
							</ul>
						<?php } ?>
					</li>
					
					<?php if ($this->session->userdata('level') != 3) { ?>
						<li<?if($this->uri->segment(1) == "merchants")print ' class="current"';?>>
							<a href="<?print base_url();?>merchants" class="ui-button ui-widget ui-state-default">Merchants</a>
							<ul>
								<li<?if($this->uri->segment(2) == "pending_changes_list" || $this->uri->segment(2) == "pending_changes")print ' class="current"';?>>
                                    <a href="<?print base_url();?>merchants/pending_changes_list" class="ui-button ui-widget ui-state-default">Pending Changes</a>
                                </li>
								<li<?if($this->uri->segment(2) == "messages" || $this->uri->segment(2) == "messages")print ' class="current"';?>>
                                    <a href="<?print base_url();?>merchants/messages" class="ui-button ui-widget ui-state-default">Merchant Messages</a>
                                </li>
								<li<?if($this->uri->segment(2) == "export")print ' class="current"';?>>
									<a href="<?print base_url();?>merchants/export" class="ui-button ui-widget ui-state-default">Merchant Export</a>
								</li>
							</ul>
						</li>
					
						<li<?if($this->uri->segment(1) == "pages")print ' class="current"';?>>
							<a href="<?print base_url();?>pages" class="ui-button ui-widget ui-state-default">Content</a>
						</li>
					<?php } ?>

					<li<?if($this->uri->segment(1) == "accounts")print ' class="current"';?>>
						<a href="<?print base_url();?>accounts" class="ui-button ui-widget ui-state-default">Accounts</a>
					</li>
                                        
					<li<?if($this->uri->segment(1) == "resources")print ' class="current"';?>>
						<a href="<?print base_url();?>resources" class="ui-button ui-widget ui-state-default">Resources</a>
					</li>                

					<li<?if($this->uri->segment(1) == "reports")print ' class="current"';?>>
						<a href="<?print base_url();?>reports" class="ui-button ui-widget ui-state-default">Reports</a>
						<?php if ($this->session->userdata('level') != 3) { ?>
							<ul>
								<li<?if($this->uri->segment(2) == "financial")print ' class="current"';?>>
									<a href="<?print base_url();?>reports/financial" class="ui-button ui-widget ui-state-default">Financial Reports</a>
								</li>
								<li<?if($this->uri->segment(2) == "operational")print ' class="current"';?>>
									<a href="<?print base_url();?>reports/operational" class="ui-button ui-widget ui-state-default">Operational Reports</a>
								</li>
								<li<?if($this->uri->segment(2) == "assn_rewards")print ' class="current"';?>>
									<a href="<?print base_url();?>reports/assn_rewards" class="ui-button ui-widget ui-state-default">Association Rewards</a>
								</li>
							</ul>
						<?php } ?>
					</li>
					
					<li>
						<a href="<?print base_url();?>login/logout" class="ui-button ui-widget ui-state-default">Log Out</a>
					</li><?
				}?>
			</ul>
		</nav>
	</header>

	<div id="main" class="ui-widget-content"><?
		if($this->session->userdata('error') != ""){
			print "<p class='ui-state-error ui-corner-all'><span class='ui-icon ui-icon-info'></span>".$this->session->userdata('error')."</p>";
			
			//clear the error message
			$this->session->unset_userdata('error');
		}

		if($this->session->userdata('message') != ""){
			// print "<p class='ui-state-highlight ui-corner-all'><span class='ui-icon ui-icon-info'></span>".$this->session->userdata('message')."</p>";
			?><script>
				$.jGrowl("<?print $this->session->userdata('message');?>");
			</script><?
			
			//clear the message
			$this->session->unset_userdata('message');
		}?>