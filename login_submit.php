<?session_start();
if($_POST['username'] == "nick" && $_POST['password']== "nick"){
	$_SESSION['logged_in']="1";
	header("Location: check_in.php");
}else{
	$notification="Incorrect username or password entered.";
	require_once 'index.php';
}
?>