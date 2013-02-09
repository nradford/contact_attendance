<?session_start();
if($_SESSION['logged_in']!=1) header("Location: index.php");
include("includes/dbinfo.inc");
mysql_connect($server,$username,$password);
@mysql_select_db($db) or die("Unable to select $db database");?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>	
	<title>K.I.D.S Church</title>
	<link rel="stylesheet" href="css/eggplant/jquery-ui-1.8.5.custom.css" type="text/css" charset="utf-8" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" charset="utf-8" />
	<link rel="stylesheet" href="css/fancybox/fancybox.css" type="text/css" media="screen" charset="utf-8">
	
	<script src="js/jquery-1.4.2.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery-ui-1.7.2.custom.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/tablesorter.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/tablesorter.pager.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/fancybox.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery.alphanumeric.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery.easing.1.2.js" type="text/javascript" charset="utf-8"></script>
	
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			// $("a.largerimage").fancybox({
			// 	'zoomSpeedIn': 500,
			// 	'zoomSpeedOut': 500,
			// 	'overlayShow': true,
			// 	'overlayColor': '#000',
			// 	'overlayOpacity': 0.7
			// });
			$('#birthdate').datepicker();

			$('#add_contact').click(function(){

			});
		});//end document.ready
	</script>
</head><?
	$contact_id=$_POST['contact_id'];
	if($contact_id > 0){
		mysql_connect($server,$username,$password);
		@mysql_select_db($db) or die("Unable to select $db database");
		$sql = "SELECT * FROM contacts WHERE id = ".$contact_id;
		$result=mysql_query($sql) OR die("The information could not be retrieved from the database.");
		$contact=array();	
		$contact=mysql_fetch_array($result,MYSQL_BOTH);
		mysql_close();
	}?>

<body>
	<div id="container">
	  <div id="header"><?$active="contacts"; include_once 'includes/nav.inc';?></div>

		<div id="content">
			<!-- <h1><?if($contact_id > 0){print "Edit";}else{print "Add";}?> Kid</h1> -->
			
		<form action="save_contact.php" id="add-contact" class="data-input" method="post" accept-charset="utf-8">
			<input type="hidden" name="contact_id" value="<?print $contact_id;?>" id="contact_id" />				
				 <div class="row">
					<label for="class">Status:</label>
						<select name="status">
							<option value="1" <?if($contact['status']=="1")print " selected";?>>Active</option>
							<option value="0" <?if($contact['status']=="0")print " selected";?>>Non Active</option>
						</select>
				</div>
				
				<div class="row">							
					<label for="first">First Name:</label>
					<input type="text" class="inputf" value="<?print $contact['first_name'];?>" name="first" id="first" />
				</div>	
				
				<div class="row">						
					<label for="last">Last Name:</label>
					<input type="text" class="inputf" value="<?print $contact['last_name'];?>" name="last" id="last" />
				</div>
			
				<div class="row">			
					<label for="date">Birthday:</label>

					<?$bd=$contact['birthdate'];?>
					<input type="text" class="inputf" name="birthdate" id="birthdate" value="<?print date("m/d/Y", strtotime($bd));?>" autocomplete="off" />
				</div>
				
				<div class="row">				
					<label for="email">Email:</label>
					<input type="text" class="inputf" value="<?print $contact['email'];?>" name="email" id="email" />
				</div>
				
				<div class="row">
					<?$mobile=$contact['mobile_phone'];?>
					<label for="mobile">Mobile Phone:</label>
					<input type="text" class="phone-input" size="3" maxlength="3" value="<?print substr($mobile, 0, 3);?>" name="mobile1" id="mobile1" class="phone" /><span class="left">-</span>
					<input type="text" class="phone-input" size="3" maxlength="3" value="<?print substr($mobile, 3, 3);?>" name="mobile2" id="mobile2" class="phone" /><span class="left">-</span>
					<input type="text" class="phone-input" size="4" maxlength="4" value="<?print substr($mobile, 6, 4);?>" name="mobile3" id="mobile3" class="phone_end" />
				</div>
			
				<div class="row">
					<?$home_phone=$contact['home_phone'];?>
					<label for="home_phone">Home Phone:</label>
					<input type="text" class="phone-input" size="3" maxlength="3" value="<?print substr($home_phone, 0, 3);?>" name="home_phone1" id="home_phone1" class="phone" /><span class="left">-</span>
					<input type="text" class="phone-input" size="3" maxlength="3" value="<?print substr($home_phone, 3, 3);?>" name="home_phone2" id="home_phone2" class="phone" /><span class="left">-</span>
					<input type="text" class="phone-input" size="4" maxlength="4" value="<?print substr($home_phone, 6, 4);?>" name="home_phone3" id="home_phone3" class="phone_end" />
				</div>
			
				<div class="row">	
					<label for="addr">Address:</label>
					<input type="text" class="inputf" value="<?print $contact['address'];?>" name="addr" id="addr" />
				</div>
		
				<div class="row">	
					<label for="addr">Address 2:</label>
					<input type="text" class="inputf" value="<?print $contact['address2'];?>" name="addr2" id="addr2" />
				</div>
		
				<div class="row">
					<label for="city">City:</label>
					<input type="text" class="inputf" value="<?print $contact['city'];?>" name="city" id="city" />
				</div>
		
				<div class="row">
					<label for="state">State:</label>
					<input type="text" class="inputf" value="<?print $contact['state'];?>" name="state" maxlength="2" id="state" size="3" />
				</div>
		
				<div class="row">
					<label for="zip">Zip Code:</label>
					<input type="text" class="inputf" value="<? print $contact['zip']; ?>" name="zip" maxlength="6" id="zip" size="6" />
						<!-- <input type="text" class="inputf" value="<? print $zip ?>" onblur="isNumeric(document.getElementById('zip'))" name="zip" maxlength="6" id="zip" size="6" /> -->
				</div>
		
				<div class="row">
					<label for="school">School:</label>
					<input type="text" class="inputf" value="<?print $contact['school'];?>" name="school" id="school" />
				</div>
		
				<div class="row">
					<label for="notes">Notes:</label>
					<textarea name="notes" id="notes"><?print $contact['notes'];?></textarea>
				</div>
				
			<div class="row">
				<input type="submit" class="button" value="Save Contact Info" />
			</div>
		</form>
		<div id="footer"></div>
	</div><!--/content-->
</div><!--/container-->
</body>
</html>