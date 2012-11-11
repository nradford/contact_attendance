<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  <title>K.I.D.S. Church Contact Attendance</title>
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
    <?php
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

      include("dbinfo.inc");
      mysql_connect($server,$username,$password);
      @mysql_select_db($db) or die("Unable to select $db database");
      $sql = "UPDATE contact SET status='$status', first_name='$first', last_name='$last', birthdate='$bd', email='$email', mobile_phone='$mobile', home_phone='$home_phone', address='$addr', address2='$addr2', city='$city', state='$state', zip='$zip', school='$school', notes='$notes'
				WHERE contact_id=$id";
				
      mysql_query($sql) or die("There was an error adding the contact information.");
 			?>
<form><input type="button" value="Go Back" onClick="history.back(-1)" /></form><?

      mysql_close();
  // print $sql;
    ?>

    <h2>Contact information successfully updated:</h2><br />
			<a href="contact.php">Go back to contact list</a>
			
  </div><!--content-->
  </div><!--container-->
</body>
</html>