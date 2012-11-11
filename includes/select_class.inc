
<form action="<?print $action; ?>" method="post" id="class_selection">
	<label for="class">Select a class</label><br />
	<select name="class" id="class">
		<option value="1">K.I.D.S. Church (10 - 12)</option>
		<option value="2">K.I.D.S. Church (7 - 9)</option>
		<option value="3">K.I.D.S. Church (4 - 6)</option>
		<option value="all">All Classes (4 - 12)</option>
	</select>
	<input type="submit" class="button" value="Submit" />
</form>
<?
	Switch($_POST['class']){ /*sets the class variable for the WHERE constraint in the SQL
														 statement that selects the class data*/
	
	case '1':
		$class=1;
		$class_name="K.I.D.S. Church (10 - 12)";//Variable used to print the age group
	break;

	case '2':
		$class=2;
		$class_name="Jr. K.I.D.S. Church (7 - 9)";//Variable used to print the age group
	break;

	case '3':
		$class=3;
		$class_name="Little K.I.D.S. Church (4 - 6)";//Variable used to print the age group
	break;
	case 'all':
		$class='all';
		$class_name="K.I.D.S. Church (4 - 12)";//Variable used to print the age group
	break;
?>
