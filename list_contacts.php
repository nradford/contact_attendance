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
	<link rel="stylesheet" href="css/jquery.jgrowl.css" type="text/css" media="screen" charset="utf-8">
	
	<script src="js/jquery-1.4.2.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery-ui-1.7.2.custom.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/tablesorter.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/tablesorter.pager.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/fancybox.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery.alphanumeric.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery.easing.1.2.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery.jgrowl_min.js" type="text/javascript" charset="utf-8"></script>
	
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			$('#search_contacts').autocomplete(
				'search_contacts.php',{
					minChars: 0,
					autoFill: false					
				}).result(function(evt, data, formatted){
					$("#contact_id").val(data[1]);
					$('form').submit();
				});
				

			
			<?if($_GET['notification']){?>$.jGrowl('<?print $_GET['notification'];?>');<?}?>

			// SortableTable
			$.tablesorter.addWidget({
			 id: "rowHover",
			 format: function(table) {
			  $("tr:visible",table.tBodies[0]).hover(
			   function () { $(this).addClass(table.config.widgetRowHover.css); },
			   function () { $(this).removeClass(table.config.widgetRowHover.css); }
			  );
			 }
			});

			$("#contacts-tbl").tablesorter({
				// sort on the second column, order asc
				sortList: [[1,0]],
				widgets: ['zebra','rowHover'],
				widgetRowHover:{css:'highlight'}
			}).tablesorterPager({container: $("#pager"), size: 25, positionFixed: false});
			
			$('tr').live('click', function(){
				$('#contact_id').val($(this).attr('id'));
				$('#list-contacts').submit();
			});

			$('#add-contact').click(function(){
				document.location.href="add_contact.php";
			});
		});//end document.ready
	</script>
</head><?
	mysql_connect($server,$username,$password);
	@mysql_select_db($db) or die("Unable to select $db database");
	$sql = "SELECT * FROM contacts ORDER BY last_name ASC, first_name ASC";
	$result=mysql_query($sql) OR die("The information could not be retrieved from the database.");
	$contacts=array();	
	while($row=mysql_fetch_array($result,MYSQL_BOTH)){array_push($contacts, $row);}
	mysql_close();?>

<body onload="document.forms[0].search_contacts.focus();">
	<div id="container">
	  <div id="header"><?$active="contacts"; include_once 'includes/nav.inc';?></div>

		<div id="content">
		<form action="add_contact.php" id="list-contacts" method="post" accept-charset="utf-8">
			<input type="hidden" name="contact_id" value="" id="contact_id" />
			<!-- <h1>Contacts</h1> -->
			<div class="left">
				<label>Search: </label>
				<input type="text" name="search_contacts" class="inputf" value="" id="search_contacts" />
			</div><?

		  if(sizeof($contacts) > 0){?>
				<div id="pager" class="pager">
					<img src="images/first.png" alt="First Page" class="first" />
					<img src="images/prev.png" alt="Previous Page" class="prev" />
					
					<input type="text" class="pagedisplay" readonly="readonly" />
					
					<img src="images/next.png" alt="Next Page" class="next" />
					<img src="images/last.png" alt="Last Page" class="last" />
					
					<select class="pagesize">
						<option value="10">10</option>
						<option  value="15">15</option>
						<option value="20">20</option>
						<option selected="selected" value="25">25</option>
						<option value="30">30</option>
						<option value="40">40</option>
					</select>
				</div><!-- pager -->
			
				<table id="contacts-tbl" class="tablesorter">
					<thead>
						<tr>
							<th id="fname">First Name</th>
							<th id="last">Last Name</th>
							<th id="bd">Birthday</th>
							<th id="email">E-mail</th>
							<th id="mobile">Mobile Phone</th>
							<th id="home">Home Phone</th>
							<th id="address">Address</th>
							<th id="address2">Address 2</th>
							<th id="city">City</th>
							<th id="state">State</th>
							<th id="zip">Zip</th>
							<th id="school">School</th>
							<th id="status">Status</th>
						</tr>
					</thead>
					<tbody><?
					
					$i=0;
					foreach($contacts as $contact){
						$print_bd="";
						if($contact['birthdate'] != "")$print_bd=date("n/j/Y", strtotime($contact['birthdate']));?>
						
						<tr id="<?print $contact['id'];?>">
						<td><?print $contact['first_name'];?></td>
						<td><?print $contact['last_name'];?></td>
						<td><?print $print_bd;?></td>
						<td><?print $contact['email'];?></td>
						<td><?print $contact['mobile_phone'];?></td>
						<td><?print $contact['home_phone'];?></td>
						<td><?print $contact['address'];?></td>
						<td><?print $contact['address2'];?></td>
						<td><?print $contact['city'];?></td>
						<td><?print $contact['state'];?></td>
						<td><?print $contact['zip'];?></td>
						<td><?print $contact['school'];?></td>
						<td><?print $contact['status'];?></td>
						</tr><?
					}?>	
					</tbody>
				</table><?
			  }else{?>
					<p class="none-found">No contacts found.<p><?
			  }?>

			<div class="row">
				<input type="button" class="button" id="add-contact" value="Add New" />
			</div>

		</form>
		<div id="footer"></div>
		</div><!-- content -->
		</div><!-- container -->
</body>