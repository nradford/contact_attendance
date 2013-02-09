<?session_start();?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>K.I.D.S Church</title>

	<link rel="stylesheet" href="css/custom-theme/jquery-ui-1.8.12.custom.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/fancybox/fancybox.css" media="screen">
	<link rel="stylesheet" href="css/jquery.jgrowl.css" media="screen">
	
	<!-- <script src="js/jquery-1.4.4.min.js"></script> -->
	<script src="js/jquery-1.6.min.js"></script>
	<script src="js/jquery-ui-1.8.12.custom.min.js"></script>
	<script src="js/tablesorter.min.js"></script>
	<script src="js/tablesorter.pager.js"></script>
	<script src="js/fancybox.js"></script>
	<script src="js/jquery.alphanumeric.js"></script>
	<script src="js/jquery.easing.1.2.js"></script>
	<script src="js/autoresize.jquery.min.js"></script>
	<script src="js/jquery.jgrowl_min.js"></script>
	
	<!-- <script type="text/javascript">
		$(document).ready(function(){
			$('#username').focus();
		});//end document.ready
		
	</script> -->
</head>

<body>
	<div id="container" class="ui-widget-content">
		<header><?
			$active="check_in";?>
			<nav class="ui-widget-header">
				<ul>
					<li<?if($active=="check_in")print " class='currentPage'";?>>
						<a href="check_in.php">Check In</a>
					</li>
					<li<?if($active=="contacts")print " class='currentPage'";?>>
						<a href="list_contacts.php">Kids</a>
					</li>
					<li<?if($active=="attendance")print " class='currentPage'";?>>
						<a href="attendance.php">Attendance</a>
					</li>
					<li<?if($active=="contact_info") print " class=\"currentPage\"";?>>
						<a href="contact.php">Contact Info</a>
					</li>
					<li<?if($active=="attendance_report")print " class='currentPage'";?>>
						<a href="attendance_report.php">Report</a>
					</li>
				</ul>
			</nav>
		</header>

		<div id="content">