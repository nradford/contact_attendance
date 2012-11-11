<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<?php $thisPage="add_contact"; ?>
<head>
	<title>K.I.D.S. Church Contact Attendance</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />

	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="shortcut icon" href="images/favicon.ico" />
	<script language="javascript" type="text/javascript" src="add_validate.js"></script>
	<script language="javascript" type="text/javascript" src="date_picker.js"></script>
</head>
<body>
	<div id="container">
	<div id="header">
		<?php include("navigation.inc"); ?>
	</div>
	<div id="content">
		<h1>New Contact</h1>
		
		<form action="insert.php" method="post" id="add_contact">
			<div id="col1">
				<label for="class">Class</label><br />
				<select name="class" id="class">
					<option value="1">K.I.D.S. Church (10 - 12)</option>
					<option value="2">Jr. K.I.D.S. Church (7 - 9)</option>
					<option value="3">Little K.I.D.S. Church (4 - 6)</option>
				</select><br />
			
				<label for="first">First Name</label><br />
				<input type="text" name="first" id="first" /><br />
			
				<label for="last">Last Name</label><br />
				<input type="text" name="last" id="last" /><br />
			
				<label for="date" class="left">Birthday</label>
				<?php include("select_date.inc"); ?><br />
				<input type="text" readonly="readonly" size="15px" name="date" id="date" /><br />
			
				<label for="email">Email</label><br />
				<input type="text" name="email" id="email" /><br />
			
				<label for="mobile">Mobile Phone</label><br />
				<input type="text" size="3px" maxlength="3" value="573" name="mobile" id="mobile" class="phone" /><span class="phone">-</span>
				<input type="text" size="3px" maxlength="3" name="mobile" id="mobile" class="phone" /><span class="phone">-</span>
				<input type="text" size="4px" maxlength="4" name="mobile" id="mobile" class="phone_end" /><br />
			
				<label for="home_phone">Home Phone</label><br />
				<input type="text" size="3px" maxlength="3" value="573" name="home_phone" id="home_phone" class="phone" /><span class="phone">-</span>
				<input type="text" size="3px" maxlength="3" name="home_phone" id="home_phone" class="phone" /><span class="phone">-</span>
				<input type="text" size="4px" maxlength="4" name="home_phone" id="home_phone" class="phone_end" /><br />
			</div><!-- col1 -->
			
			<div id="col2">
				<label for="addr">Address</label><br />
				<input type="text" name="addr" id="addr" /><br />
			
				<label for="city">City</label><br />
				<input type="text" name="city" id="city" /><br />
			
				<label for="state">State</label><br />
				<input type="text" value="MO" name="state" maxlength="2" id="state" size="2" /><br />
			
				<label for="zip">Zip Code</label><br />
				<input type="text" onblur="isNumeric(document.getElementById('zip'))" name="zip" maxlength="6" id="zip" size="6" /><br />
			
				<label for="school">School</label><br />
				<input type="text" name="school" id="school" /><br />
			
				<label for="notes">Notes</label><br />
				<textarea name="notes" id="notes" rows="7" cols="50"></textarea><br />
			</div><!-- col1 -->
			
			<p><input type="submit" class="button" value="Add Contact Info" /></p>
		</form>
	</div>
<!--/content-->
</div>
<!--/container-->
</body>
</html>