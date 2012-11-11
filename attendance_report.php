<!DOCTYPE html>
<html>
<?$active="records"; ?>
<head>
	<title>K.I.D.S. Church Contact Attendance</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<link rel="stylesheet" href="css/eggplant/jquery-ui-1.7.2.custom.css" type="text/css" media="screen" charset="utf-8">
	
	<script src="js/jquery-1.4.2.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery-ui-1.7.2.min.js" type="text/javascript" charset="utf-8"></script>
	
</head>
<body>	
<div id="container">
	<div id="header">
		<?php include ("navigation.inc"); ?>
	</div>
	<div id="content">

		<h1>Attendance Report</h1>
			<form action="attendance_report.php" method="post" id="view_records">
			<label for="date" class="date_label">Select a date:</label><br />
			<input type="text" name="date" value="<?print date("m/d/Y")?>" autocomplete="off" onfocus="displayCalendar(this,'mm/dd/yyyy',this)" /><br />
			<input type="submit" class="button" value="View Attendance Records" />
		<?php
			include_once("dbinfo.inc");
			mysql_connect($server,$username,$password);
			@mysql_select_db($db) or die("Unable to select $db database");

			$date=date("Ymd", strtotime($_POST['date']));

			$table="contact c left join attendance a on c.id=a.contact_id";
		
			$sql="SELECT contact_id, last_name, first_name, attendance, offering FROM ".$table." WHERE(date='$date') ORDER BY last_name ASC, first_name ASC";	
			//print $sql;
			
			$details=mysql_query($sql) or die ("The information could not be retrieved from the database.");
			$num=mysql_numrows($details);

			?>

			<div id="table" class="showHide">
				<h2><?print date("m/d/Y", strtotime($date));?></h2>

				<table>
					<thead>
						<tr>
							<th>Name</th>
							<th>Attendance</th>
							<th>Offering</th>
						</tr>
					</thead>
					<tbody>
			<?
			$i=0;
			while($i < $num){
				$name=mysql_result($details,$i,"first_name")." ".mysql_result($details,$i,"last_name");
				$attendance=mysql_result($details,$i,"attendance");
				if($attendance=="1")$attendance="Present";
				if($attendance=="0")$attendance="Absent";
				$offering=mysql_result($details,$i,"offering");
				
			?>
				<tr <?if($i%2 == 1)print "class='altrow'";?>>
					<td><?print $name;?></td>
					<td><?print $attendance;?></td>
					<td>$<?print number_format($offering, 2, ".", ",");?></td>
				</tr>
			<?
				$i++;
				}
			mysql_close();
?>	
						</tbody>
					</table>
				</div>						
			
			
						
						
						
						

		<h2 class="<?print $showHide?>">Total Present: <? print $total_present; ?></h2>
		<h3 class="<?print $showHide?>">Offering Total: <? print '$'.number_format($offering_total,2); ?></h3>
	</div>
	<!--/content-->
</div>
<!--/container-->
</body>
</html>