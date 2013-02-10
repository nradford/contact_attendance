<!DOCTYPE html>
<html>
<?$active="records"; ?>
<head>
	<title>K.I.D.S. Church Contact Attendance</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<link rel="stylesheet" href="css/eggplant/jquery-ui-1.7.2.custom.css" type="text/css" media="screen" charset="utf-8">
	
	<script src="js/jquery-1.4.2.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery-ui-1.7.2.min.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<div id="container">
	<div id="header">
		<?php include("navigation.inc"); ?>
	</div>
	<div id="content">
		<h1>Attendance Records</h1>
			<form action="records.php" method="post" id="view_records">
			<label for="date">Select a date:</label><br />
			<input type = "text" name="date" value="" autocomplete="off" onfocus="displayCalendar(this,'mm/dd/yyyy',this)" /><br />
			<input type="submit" class="button" value="View Attendance Records" />
		
			<?php // include("select_class.inc");?>
			
		</form>
	</div><!--/content-->
</div><!--/container-->
</body>
</html>