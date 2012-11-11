<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<?php $thisPage="contact_info"; ?>
<head>
	<title>K.I.D.S. Church Contact Attendance</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />

	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="shortcut icon" href="pictures/icon.ico" />
</head>
<body>
<div id="container">
	<div id="header">
		<?php include ("navigation.inc"); ?>
	</div>
	<div id="content">
		<h1>Contact Information</h1>
		<?php
			$action="contact.php";/*Sets a variable for select_class form action*/
			include ("select_class.inc");
			include("dbinfo.inc");
			
			mysql_connect($server,$username,$password);
			@mysql_select_db($db) or die("Unable to connect to $db database");

			Switch($_POST['class']){ /*sets the class variable for the WHERE constraint in the SQL
																 statement that selects the class data*/
				case '1': /*K.I.D.S. Church is the selected class*/
					$class=1;
					$class_name="K.I.D.S. Church (10 - 12)";
				break;
				case '2': /*Jr. K.I.D.S. Church is the selected class*/
					$class=2;
					$class_name="Jr. K.I.D.S. Church (7 - 9)";
				break;
				case '3': /*Little K.I.D.S. Church is the selected class*/
					$class=3;
					$class_name="Little K.I.D.S. Church (4 - 6)";
				break;
				case 'all': /*All classes are selected*/
					$class='all';
					$class_name="K.I.D.S. Church (4 - 12)";
				break;
			}
			echo '<h2>'.$class_name.'</h2>';
		?>
		<div id="table">
			<table>
				<colgroup>
					<col class="edit" />
					<col class="first" />
					<col class="last" />
					<col class="birthday" />
					<col class="email" />
					<col class="mobile" />
					<col class="home" />
					<col class="address" />
					<col class="city" />
					<col class="state" />
					<col class="zip" />
					<col class="school" />
					<col class="notes" />
				</colgroup>

				<thead>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Birthday</th>
						<th>E-mail</th>
						<th>Mobile Phone</th>
						<th>Home Phone</th>
						<th>Address</th>
						<th>City</th>
						<th>State</th>
						<th>Zip</th>
						<th>School</th>
						<th>Notes</th>
						<th>Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if ($class=='all'){
							$sql = "SELECT last_name, first_name, birthdate, email, mobile_phone, home_phone, address, city, state, zip, school, notes FROM contact ORDER BY last_name ASC";
						}
						else{
							$sql = "SELECT last_name, first_name, birthdate, email, mobile_phone, home_phone, address, city, state, zip, school, notes FROM contact WHERE class='$class' ORDER BY last_name ASC, first_name ASC";
						}
			
						$results=mysql_query($sql) or die ("The information could not be retrieved from the database.");	
print_r($results);
						// foreach($results as $row){
						// 	print '<tr class=".$row_class.">';
						// 	print '<td>'.$row['name'].'</td>';
						// 	print '<td>'.row['last_name'].'</td>';
						// 	print '<td>'.$row['birthdate'].'</td>';
						// 	print '<td>'.$row['email'].'</td>';
						// 	print '<td>'.$row['mobile_phone'].'</td>';
						// 	print '<td>'.$row['home_phone'].'</td>';
						// 	print '<td>'.$row['address'].'</td>';
						// 	print '<td>'.$row['city'].'</td>';
						// 	print '<td>'.$row['state'].'</td>';
						// 	print '<td>'.$row['zip'].'</td>';
						// 	print '<td>'.$row['school'].'</td>';
						// 	print '<td>'.$row['notes'].'</td>';
						// 	print '<td class="edit"><a href="/contact_attendance/edit.php" >edit</a></td>';
						// 	print '</tr>';
						// }
						// 
						// $num=mysql_numrows($result);
						// $i=0;
						// 
						// while ($i < $num){
						// 	$i++;
						// 			
						// 	$row_number= fmod ($i, 2);
						// 
						// 	if($row_number == 0){
						// 	   $row_class="even";
						// 	}else{
						// 	   $row_class="odd";
						// 	}
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