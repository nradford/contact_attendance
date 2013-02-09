<?
  include("includes/dbinfo.inc");
  mysql_connect($server,$username,$password);
  @mysql_select_db($db) or die("Unable to select $db database");
	
	$id=$_GET['contact_id'];
	
	$sql="DELETE FROM check_in WHERE id=".$id;
	mysql_query($sql);
	// $del_id=mysql_insert_id();
	if($id > 0){
		print $id;
	}else{
		print "There was an error deleting the record";
	}
	mysql_close();?>