<!DOCTYPE html>
<html>
<?$active="contact_info"; ?>
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
	<?php
		include("dbinfo.inc");
		mysql_connect($server,$username,$password);
		@mysql_select_db($db) or die("Unable to select $db database");
		
		if($_POST['first'] != "" && $_POST['last'] != ""){		
			$id=$_POST['id'];
      $last=$_POST['last'];
      $first=$_POST['first'];
      $bd=date("Ymd", strtotime($_POST['date']));
      $email=$_POST['email'];
      $mobile=$_POST['mobile1'].$_POST['mobile2'].$_POST['mobile3'];
      $home_phone=$_POST['home_phone1'].$_POST['home_phone2'].$_POST['home_phone3'];
      $addr=$_POST['addr'];
      $addr2=$_POST['addr2'];
      $city=$_POST['city'];
      $state=$_POST['state'];
      $zip=$_POST['zip'];
      $status=$_POST['status'];
      $school=$_POST['school'];
      $notes=$_POST['notes'];

      $sql="UPDATE contact SET status='$status', first_name='$first', last_name='$last', birthdate='$bd', email='$email', mobile_phone='$mobile', home_phone='$home_phone', address='$addr', address2='$addr2', city='$city', state='$state', zip='$zip', school='$school', notes='$notes'
				WHERE id=$id";

      mysql_query($sql) or die("There was an error adding the contact information.");
			
			mysql_close();
			$message="Contact information for <b>".$first." ".$last."</b> has been updated.";
		}
		?>
	<div id="content">
		<p class="message">
			<?if($message != "")print $message;?>
		</p>
		<h1>Contact Information</h1>
			<div id="contact">
			<table>
				<!-- <colgroup>
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
				</colgroup> -->

				<thead>
					<tr>
						<th id="fname">First Name</th>
						<th id="last">Last Name</th>
						<th id="bd">Birthday</th>
						<th id="email">E-mail</th>
						<th id="mobile">Mobile Phone</th>
						<th id="home">Home Phone</th>
						<th id="address">Address</th>
						<th id="address2">Address 2</th>
						<th id="city">City</th>
						<th id="state">State</th>
						<th id="zip">Zip</th>
						<th id="school">School</th>
						<th id="notes">Notes</th>
						<th id="status">Status</th>
					</tr>
				</thead>
				<tbody>
					<?php	
						mysql_connect($server,$username,$password);
						@mysql_select_db($db) or die("Unable to select $db database");
						
						$sql = "SELECT * FROM contact ORDER BY last_name ASC, first_name ASC";
			
						$result=mysql_query($sql) or die ("The information could not be retrieved from the database.");	

						$num=mysql_numrows($result);

						$i=0;
						while ($i < $num){
							$id=mysql_result($result,$i,"id");
							$name=mysql_result($result,$i,"first_name");
							$last_name=mysql_result($result,$i,"last_name");
							$bd=mysql_result($result,$i,"birthdate");
							$email=mysql_result($result,$i,"email");
							$mobile_phone=mysql_result($result,$i,"mobile_phone");
							$home_phone=mysql_result($result,$i,"home_phone");
							$address=mysql_result($result,$i,"address");
							$address2=mysql_result($result,$i,"address2");
							$city=mysql_result($result,$i,"city");
							$state=mysql_result($result,$i,"state");
							$zip=mysql_result($result,$i,"zip");
							$school=mysql_result($result,$i,"school");
							$notes=mysql_result($result,$i,"notes");
							$status=mysql_result($result,$i,"status");
			
							$bd=date("m/d/Y", strtotime($bd));?>
							<tr <?if($i%2==1)print "class='altrow'";?> onclick="document.location.href='edit_contact.php?id=<?print $id;?>'"><?
							print '<td>'.$name.'</td>';
							print '<td>'.$last_name.'</td>';
							print '<td>'.$bd.'</td>';
							print '<td>'.$email.'</td>';
							print '<td>'.$mobile_phone.'</td>';
							print '<td>'.$home_phone.'</td>';
							print '<td>'.$address.'</td>';
							print '<td>'.$address2.'</td>';
							print '<td>'.$city.'</td>';
							print '<td>'.$state.'</td>';
							print '<td>'.$zip.'</td>';
							print '<td>'.$school.'</td>';
							print '<td>'.$notes.'</td>';
							print '<td>'.$status.'</td>';
							print '</tr>';
							
							$i++;
						}
						mysql_close();
					?>	
				</tbody>
			</table>
			</div><!-- contact -->
	</div>
	<!--/content-->
</div>
<!--/container-->
</body>
</html>