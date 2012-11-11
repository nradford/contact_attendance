<?
// include("includes/dbinfo.inc");
// mysql_connect($server,$username,$password);
// @mysql_select_db($db) or die("Unable to select $db database");
// 
// $q=$_GET['q'];
// $limit=$_GET['limit'];
// // if($q != ""){
// 	mysql_connect($server,$username,$password);
// 	@mysql_select_db($db) or die("Unable to select $db database");
// 	$sql = "SELECT * FROM contacts WHERE first_name like '%$q%' OR last_name like '%$q%' LIMIT 0, $limit;";
// 	$result=mysql_query($sql) OR die("The information could not be retrieved from the database.");
// 	$contacts=array();
// 	while($row=mysql_fetch_array($result,MYSQL_BOTH)){array_push($contacts, $row);}
// 	mysql_close();
// // }
// 
// foreach($contacts as $contact){
// 	print $contact['first_name']." ".$contact['last_name']."|".$contact["id"]."\n";



include("includes/dbinfo.inc");
mysql_connect($server,$username,$password);
@mysql_select_db($db) or die("Unable to select $db database");

$term=$_GET["term"];
$limit=$_GET["limit"];
// if($term != ""){
	mysql_connect($server,$username,$password);
	@mysql_select_db($db) or die("Unable to select $db database");
	$sql = "SELECT id as contact_id, first_name, last_name FROM contacts WHERE first_name like '%$term%' OR last_name like '%$term%' LIMIT 0, $limit;";
	
	// print $sql;
	
	$result=mysql_query($sql) OR die("The information could not be retrieved from the database.");
	$results=array();
	while($row=mysql_fetch_array($result,MYSQL_BOTH)){array_push($results, $row);}
	mysql_close();
// }

$response = $_GET["callback"]."(".json_encode($results).")";
print $response;

?>