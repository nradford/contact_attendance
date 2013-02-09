<!DOCTYPE html>
<html>
<?$active="add_contact"; ?>
<head>
	<title>K.I.D.S. Church Contact Attendance</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="calendar/calendar.css?random=20051112" type="text/css" />
	<link rel="shortcut icon" href="images/favicon.ico" />
	<!-- <script language="javascript" type="text/javascript" src="add_validate.js"></script> -->
	<script type="text/javascript" src="calendar/calendar.js?random=20060118"></script>
</head>
<body>
	<div id="container">
	<div id="header">
		<?php include("navigation.inc"); ?>
	</div>
	
	<?php
		include("dbinfo.inc");
		mysql_connect($server,$username,$password);
		@mysql_select_db($db) or die("Unable to select $db database");
		
		$id=$_GET['id'];
	
		$sql = "SELECT * FROM contact WHERE id = ".$id."  ORDER BY last_name ASC";
// print $sql;
		$result=mysql_query($sql) or die ("The information could not be retrieved from the database.");	

		$name=mysql_result($result,$i,"first_name");
		$last_name=mysql_result($result,$i,"last_name");
		$bd=mysql_result($result,$i,"birthdate");
		$email=mysql_result($result,$i,"email");
		$mobile=mysql_result($result,$i,"mobile_phone");
		$home_phone=mysql_result($result,$i,"home_phone");
		$addr=mysql_result($result,$i,"address");
		$addr2=mysql_result($result,$i,"address2");
		$city=mysql_result($result,$i,"city");
		$state=mysql_result($result,$i,"state");
		$zip=mysql_result($result,$i,"zip");
		$school=mysql_result($result,$i,"school");
		$notes=mysql_result($result,$i,"notes");
		$status=mysql_result($result,$i,"status");

		mysql_close();
	?>
	
	<div id="content">
		<h1>Edit Contact</h1>

		<form action="contact.php" method="post" id="update_contact">
				<!-- <div class="row">
					<label for="class">Class:</label>
					<div class="form">
						<select name="class" id="class">
							<option value="1">K.I.D.S. Church (10 - 12)</option>
							<option value="2">Jr. K.I.D.S. Church (7 - 9)</option>
							<option value="3">Little K.I.D.S. Church (4 - 6)</option>
						</select>
					</div>
				</div> -->
				
				 <div class="row">
					<label for="class">Status:</label>
					<div class="form">
						<select name="status">
							<option value="1" <?if($status=="1")print " selected";?>>Active</option>
							<option value="0" <?if($status=="0")print " selected";?>>Non Active</option>
						</select>
					</div>
				</div>
				
				<div class="row">							
					<label for="first">First Name:</label>
					<div class="form">
						<input type="text" value="<?print $name; ?>" name="first" id="first" />
					</div>
				</div>	
				
				<div class="row">						
					<label for="last">Last Name:</label>
					<div class="form">
						<input type="text" value="<?print $last_name; ?>" name="last" id="last" />
					</div>
				</div>
			
				<div class="row">			
					<label for="date">Birthday:</label>
					<div class="form">
						<input type = "text" name="date" value="<?print date("m/d/Y", strtotime($bd));?>" autocomplete="off" onfocus="displayCalendar(this,'mm/dd/yyyy',this)" />
						<!-- <?php include("select_date.inc"); ?> -->
					</div>		
				</div>			
				
				<div class="row">				
					<label for="email">Email:</label>
					<div class="form">
						<input type="text" value="<?print $email; ?>" name="email" id="email" />
					</div>
				</div>
				
				<div class="row">
					<div class="form">
						<label for="mobile">Mobile Phone:</label>
						<input type="text" size="3" maxlength="3" value="<?print substr($mobile, 0, 3);?>" name="mobile1" id="mobile1" class="phone" /><span class="left">-</span>
						<input type="text" size="3" maxlength="3" value="<?print substr($mobile, 3, 3);?>" name="mobile2" id="mobile2" class="phone" /><span class="left">-</span>
						<input type="text" size="4" maxlength="4" value="<?print substr($mobile, 6, 4);?>" name="mobile3" id="mobile3" class="phone_end" />
					</div>
				</div>
			
				<div class="row">
					<div class="form">
						<label for="home_phone">Home Phone:</label>
						<input type="text" size="3" maxlength="3" value="<?print substr($home_phone, 0, 3);?>" name="home_phone1" id="home_phone1" class="phone" /><span class="left">-</span>
						<input type="text" size="3" maxlength="3" value="<?print substr($home_phone, 3, 3);?>" name="home_phone2" id="home_phone2" class="phone" /><span class="left">-</span>
						<input type="text" size="4" maxlength="4" value="<?print substr($home_phone, 6, 4);?>" name="home_phone3" id="home_phone3" class="phone_end" />
					</div>
				</div>
			
				<div class="row">	
					<label for="addr">Address:</label>
					<div class="form">
						<input type="text" value="<? print $addr; ?>" name="addr" id="addr" />
					</div>
				</div>
		
				<div class="row">	
					<label for="addr">Address 2:</label>
					<div class="form">
						<input type="text" value="<? print $addr2; ?>" name="addr2" id="addr2" />
					</div>
				</div>
		
				<div class="row">
					<label for="city">City:</label>
					<div class="form">
						<input type="text" value="<? print $city; ?>" name="city" id="city" />
					</div>
				</div>
		
				<div class="row">
					<label for="state">State:</label>
					<div class="form">
						<input type="text" value="<? print $state; ?>" value="MO" name="state" maxlength="2" id="state" size="3" />
					</div>
				</div>
		
				<div class="row">
					<label for="zip">Zip Code:</label>
					<div class="form">
						<input type="text" value="<? print $zip; ?>" name="zip" maxlength="6" id="zip" size="6" />
						<!-- <input type="text" value="<? print $zip ?>" onblur="isNumeric(document.getElementById('zip'))" name="zip" maxlength="6" id="zip" size="6" /> -->
					</div>
				</div>
		
				<div class="row">
					<label for="school">School:</label>
					<div class="form">
						<input type="text" value="<? print $school; ?>" name="school" id="school" />
					</div>
				</div>
		
				<div class="row">
						<label for="notes">Notes:</label>
					<div class="form">
						<textarea name="notes" value="<? print $notes; ?>" id="notes" rows="7" cols="50" class=></textarea>
					</div>
				</div>
				
			<div class="row">
				<label>&nbsp;</label>
				<div class="form">
					<p><input type="submit" class="button" value="Update Contact Info" /></p>
				</div>
			</div>
			<input type="hidden" name="id" value="<?print $id; ?>" id="id">
		</form>
	</div><!--/content-->
</div><!--/container-->
</body>
</html>