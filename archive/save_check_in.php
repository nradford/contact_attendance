<?
  // $notes=htmlspecialchars($_GET['notes']);

  include("includes/dbinfo.inc");
  mysql_connect($server,$username,$password);
  @mysql_select_db($db) or die("Unable to select $db database");
	
	$date=date("Ymd");
	// $time=date("His");
	$time=time();
	$contact_id=$_GET['contact_id'];
	
	$sql="INSERT INTO check_in (contact_id, check_date, checked_in) VALUES ($contact_id, $date, $time);";
	mysql_query($sql);
	$check_in_id=mysql_insert_id();
	if($check_in_id > 0){
		print $check_in_id."|".urlencode($_GET['name'])."|".urlencode(date("g:i a", $time));
	}else{
		print "There was an error saving the check in info";
	}
	mysql_close();
	?>