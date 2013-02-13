<!doctype html>
<!--[if IE 7]>    <html class="no-js ie7 ie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Kidz Rock Check-In/Check-Out</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- Le styles -->
    <link href="<?php print base_url();?>css/styles.css" rel="stylesheet" />
    <link href="<?php print base_url();?>css/bootstrap.min.css" rel="stylesheet" />

	<script src="<?print base_url();?>js/modernizr.custom.2.6.2.js"></script>
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <a class="brand" href="#">Check-In/Out</a>
            <div class="nav-collapse collapse">
                <p class="navbar-text pull-right">
                    Logged in as <a href="#" class="navbar-link">Username</a>
                </p>
                <ul class="nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div><!-- .nav-collapse -->
        </div>
    </div>
</div>

<div class="container-fluid"><?php
		if($this->session->userdata('error') != ""){?>
            <div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
			    <?php print $this->session->userdata('error');?>
            </div><?php
			
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