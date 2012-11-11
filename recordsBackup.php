<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title>K.I.D.S. Church Contact Attendance</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="shortcut icon" href="pictures/icon.ico" />
</head>
<body>
<div id="container">
	<div id="header">
		<?php include ("navigation.inc"); ?>
	</div>
	<div id="content">
		<?php
			include("dbinfo.inc");
			mysql_connect($server,$username,$password);
			@mysql_select_db($db) or die("Unable to select $db database");

			$date=($_POST['date']);
			$class=($_POST['class']);

			Switch($_POST['class']){ /*sets the class variable for the WHERE constraint in the SQL
																 statement that selects the class data*/
				case '1': /*K.I.D.S. Church is the selected class*/
					$class=1;
					$class_name="K.I.D.S. Church (10 - 12)";
				break;
				case '2': /*Jr. K.I.D.S. Church is the selected class*/
					$class=2;
					$class_name="K.I.D.S. Church (7 - 9)";
				break;
				case '3': /*Little K.I.D.S. Church is the selected class*/
					$class=3;
					$class_name="K.I.D.S. Church (4 - 6)";
				break;
				case 'all': /*All classes are selected*/
					$class='all';
					$class_name="K.I.D.S. Church (4 - 12)";
				break;
			}
			echo '<h1>'.$class_name.'</h1>';
			echo '<h2>'.$date.'</h2>';
		?>
		<div id="table">
			<table>
				<colgroup>
					<col class="first" />
					<col class="last" />
					<col class="attendance" />
					<col class="offering" />
				</colgroup>

				<thead>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Attendance</th>
						<th>Offering</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if ($class_name=='all'){
							$sql1 = "SELECT contact_id, last_name, first_name FROM contact ORDER BY last_name ASC, first_name ASC";
							
							$sql2 = "SELECT attendance, offering FROM attendance WHERE (date='$date') ORDER BY last_name ASC, first_name ASC";
						}
						else{
							$sql1 = "SELECT contact_id, last_name, first_name FROM contact WHERE (class='$class') ORDER BY last_name ASC, first_name ASC";
							
							$sql2 = "SELECT attendance, offering FROM attendance WHERE (date='$date')";
						}
						$result1=mysql_query($sql1) or die ("The information could not be retrieved from the contact table.");	
						$result2=mysql_query($sql2) or die ("The information could not be retrieved from the attendance table.");	

						$num=mysql_numrows($result1);
						
						$i=0;
						while($i < $num){
							$contact_id=mysql_result($result1,$i,"contact_id");
							$name=mysql_result($result1,$i,"first_name");
							$last_name=mysql_result($result1,$i,"last_name");
							$attendance=mysql_result($result2,$i,"attendance");
							$offering=mysql_result($result2,$i,"offering");
												
							$i++;
			
							$row_number=fmod ($i, 2);

							if($row_number == 0){
							   $row_class="even";
							}
							else{
							   $row_class="odd";
							}

							echo '<tr class="'.$row_class.'">';
							echo '<td>'.$name.'</td>';
							echo '<td>'.$last_name.'</td>';
							echo '<td>'.$attendance.'</td>';
							echo '<td>'.$offering.'</td>';
							echo '</tr>';
						}
						mysql_close();
					?>	
				</tbody>
			</table>
		</div>
		<!--/table-->
	</div>
	<!--/content-->
</div>
<!--/container-->
</body>
</html>