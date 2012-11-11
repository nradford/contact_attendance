<!DOCTYPE html>
<html>
<?$active="attendance"; ?>
<head>
	<title>K.I.D.S. Church Attendance</title>
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
	<?php (include "navigation.inc"); ?>
</div>
<div id="content">
	<h1>Attendance</h1>
	<?php
		include("dbinfo.inc");
		mysql_connect($server,$username,$password);
		@mysql_select_db($db) or die("Unable to connect to $db database");?>

				<div id="table">
				<form name="attendance" action="submit_attendance.php" id="attendance" method="post">
					<input type="text" name="date" value="" autocomplete="off" onfocus="displayCalendar(this,'mm/dd/yyyy',this)" /><br />
					<table>

					<thead>
						<tr>
							<th>Name</th>
							<th>Attendance</th>
							<th>Offering</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$sql="SELECT last_name, first_name, id FROM contact WHERE status=1 ORDER BY last_name ASC, first_name ASC";

						$result=mysql_query($sql) or die ("The information could not be retrieved from the database.");	
						$num_rows=mysql_numrows($result);

						$i=0;
						while($i < $num_rows){
							$name=mysql_result($result,$i,"first_name")." ".mysql_result($result,$i,"last_name");
							// $last_name=mysql_result($result,$i,"last_name");
							$contact_id=mysql_result($result,$i,"id");?>

							<tr <?if($i%2 == 1)print "class='altrow'";?>><?
							print '<td>'.$name.'</td>';
			
							// print '<input type="hidden" value="'.$contact_id.'" id="'.$contact_id.'" name="contact_id[]" />';
							// 
							// print '<input type="hidden" value="'.$num_rows.'" id="num_rows" name="num_rows" />';
							?>
							<td>
								<select name="attendance[<?print $contact_id;?>]">
									<option value="1">Present</option>
									<option value="0">Absent</option>
								</select>
							</td>
							<?
							print '<td>$<input type="text" id="offering['.$contact_id.']" name="offering['.$contact_id.']" value="" /></td></tr>';

							$i++;
						}
						mysql_close();
					?>
				</tbody>
			</table>
			<p><input type="submit" class="button" value="Submit Attendance Report" /></p>
			</form>
	</div><!--/table-->
</div><!--/content-->
</div><!--/container-->
</body>
</html>