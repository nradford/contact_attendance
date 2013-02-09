<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  <title>K.I.D.S. Church Attendance Report</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <link rel="stylesheet" href="style.css" type="text/css" />
  <link rel="shortcut icon" href="images/icon.ico" />
</head>
<body>
  <div id="container">
 	<div id="header">
		<?php (include "navigation.inc"); ?>
	</div>
	<div id="content">
		<h2>Attendance Report for - :</h2>
		
		<colgroup>
			<col class="first" />
			<col class="last" />
			<col class="date" />
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
	      include("dbinfo.inc");
	      mysql_connect($server,$username,$password);
	      @mysql_select_db($db) or die("Unable to select $db database");

	      $sql = "SELECT* FROM contact_attendance.attendance";
	      mysql_query($sql) or die("The information could not be retrieved from the database.");  
	
					if ($class=="all"){
						$sql = "SELECT last_name, first_name, member_number FROM contact_info ORDER BY last_name ASC, first_name ASC";
					}
					else{
						$sql = "SELECT last_name, first_name, member_number FROM contact_info WHERE class = '$class' ORDER BY last_name ASC";
					}
			
					$result=mysql_query($sql) or die ("The information could not be retrieved from the database.");	
					$num=mysql_numrows($result);

					$i=0;
					while ($i < $num){
						$name=mysql_result($result,$i,"first_name");
						$last_name=mysql_result($result,$i,"last_name");
						$member_number=mysql_result($result,$i,"member_number");
	
						$row_number= fmod ($i, 2);

	          if($row_number == 0){
	             $row_class="even";
	          }
	          else{
	             $row_class="odd";
	          }

						echo '<tr class="'.$row_class.'"><td>'.$name.'</td>';

						echo '<td>'.$last_name.'</td>';
	
						echo '<input type="hidden" value="'.$member_number.'" id="member_number'.$i.'" name="member_number'.$i.'"></input>';
					
						echo '<input type="hidden" value="'.$num.'" id="num_row" name="num_row"></input>';
	
						echo '<td><select id="attendance'.$i.'" name="attendance'.$i.'"> 			
							  <option value="Absent"></option><option>Present</option><option>Absent</option></td>';
	
						echo '<td><input type="text" id="offering'.$i.'" name="offering'.$i.'"></input></td></tr>';

						$i++;
					}
					mysql_close();
				?>
		</tbody>
	</table>
	<p><input type="submit" class="button" value="Submit Attendance Report" /></p>
</div>
<!--/table-->
</div>
<!--/content-->
</div>
<!--/container-->
</body>
</html>