<?include("dbinfo.inc");
  mysql_connect($server,$username,$password);
  @mysql_select_db($db) or die("Unable to select $db database");

	$num_rows=$_POST['num_rows'];/*this is the number of rows pulled from the database*/
	$date=date("Ymd", strtotime($_POST['date']));

	$contact_id=array();
	$attendance=array();
	$offering=array();
	
	foreach($_POST["attendance"] as $row=>$value){
		array_push($contact_id, $row);
		array_push($attendance, $value);
	}
	
	foreach($_POST["offering"] as $row){
		array_push($offering, $row);
	}

	$i=0;

	while($i<sizeof($contact_id)){
		$sql="INSERT INTO attendance VALUES('$date','','$contact_id[$i]','$attendance[$i]','$offering[$i]')";				
			
			// print $sql."<br />";
				
		$result=mysql_query($sql);
	
		$i++;
	}
	
	mysql_close();
	
	if($i > 0){
		$message="Attendance Records for ".date("m/d/Y", strtotime($date))." were successfully added.";
		require 'attendance_report.php';
		// header ("Location: records.php?message=$message");	
	}else{
		   die('Attendance records could not be added:<br /> ' .mysql_error().'<br /><input type="button" value="Go Back" onClick="history.back(-1)" />');
	}
?>