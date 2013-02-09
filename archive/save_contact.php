<?session_start();
	$contact_id=$_POST['contact_id'];
	$status=$_POST['status'];
	$last=$_POST['last'];
  $first=$_POST['first'];
	$bd="";
  if($_POST['birthdate'] != "")$bd=date("Ymd", strtotime($_POST['birthdate']));
  $email=$_POST['email'];
  $mobile=$_POST['mobile1'].$_POST['mobile2'].$_POST['mobile3'];
  $home_phone=$_POST['home_phone1'].$_POST['home_phone2'].$_POST['home_phone3'];
  $addr=$_POST['addr'];
  $addr2=$_POST['addr2'];
  $city=$_POST['city'];
  $state=$_POST['state'];
  $zip=$_POST['zip'];
  // $class=$_POST['class'];
  $school=$_POST['school'];
  $notes=htmlspecialchars($_POST['notes']);

  include("includes/dbinfo.inc");
  mysql_connect($server,$username,$password);
  @mysql_select_db($db) or die("Unable to select $db database");

	if($contact_id == ""){//add new contact
		$sql = "INSERT INTO contacts 
		VALUES ('','active','$last','$first','$bd','$email','$mobile','$home_phone','$addr','$addr2','$city','$state','$zip','$school','$notes')";
		mysql_query($sql);
		$contact_id=mysql_insert_id();
		if($contact_id > 0)$success=1;
	}else{//edit contact
		$sql="UPDATE contacts SET status='$status', last_name='$last', first_name='$first', birthdate='$bd', ";
		$sql.="email='$email', mobile_phone='$mobile', home_phone='$home_phone', address='$addr', ";
		$sql.="address2='$address2', city='$city', state='$state', zip='$zip', school='$school', notes='$notes'";
		$sql.=" WHERE id='$contact_id'";
		$success=mysql_query($sql);
	}
	mysql_close();
	if($success == 1){
		$notification="Contact information has been saved.";
	}else{
		$notification="There was a problem saving the contact information.";
	}
	// include 'list_contacts.php';
	header("Location: list_contacts.php?notification=$notification");?>