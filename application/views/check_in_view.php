<?php
$check_ins=array();	
?>	
		<form action="save_check_in.php" id="check_in_form" method="post" accept-charset="utf-8">
			<!-- <input type="hidden" name="contact_id" value="" id="contact_id" /> -->
			<div class="left">
				<label>Search: </label>
				<input type="text" name="search_contacts" class="inputf" value="" id="search_contacts" />
			</div>
			
			<div id="check-in-date"><?print date("D, F j Y", strtotime($date));?></div>
			
			<table id="check-in" class="tablesorter">
				<thead>
				<tr>
					<th class="check-in-name">Name</th>
					<th class="check-in-time">Check In Time</th>
					<th>Notes</th>
					<th class="check-in-delete"></th>
				</tr>
				</thead>

				<tbody><?php
					if(sizeof($check_ins) > 0){
						$cnt++;
						foreach($check_ins as $check_in){
							if($check_in['checked_in'] != "")$check_in_time=date("g:i a", $check_in['checked_in']);?>
							<tr id='contact_<?print $check_in['id'];?>'>
								<td><?print $check_in['first_name']." ".$check_in['last_name'];?></td>
								<td>
									<?print $check_in_time;?>
									<input type="hidden" name="contact_id_<?print $cnt;?>" value="<?print $check_in['contact_id'];?>" id="contact_id_<?print $check_in['contact_id'];?>" />
								</td>
								
								<td><input type="button" name="add_note" value="Add Note" id="add_note_<?print $check_in['id'];?>" /><textarea class="check-in-notes" name="note_<?print $check_in['id'];?>"></textarea></td>
								
								<td>
									<a href='#' class='del-line-item' id='<?print $check_in['id'];?>'><img src='images/delete.png' alt='delete line item'></a>
								</td>
							</tr><?
						}
						$cnt++;
					}?>
				</tbody>
			</table>
			
			<div class="row">
				<!-- <input type="submit" class="button" id="save-check-in" value="Save" /> -->
			</div>
		</form>

<script>
	$(document).ready(function(){
		$('#search_contacts').focus();
		//prevent the form from submiting when enter/return is pressed when search box is focused
		$('#check_in_form').submit(function(e){e.preventDefault();});
		
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

		// $("#check-in has(tbody tr)").live(function(){
	 
		$("#check-in has(tbody tr)").tablesorter({
			// sort on the second column, order asc
			sortList: [[1,0]],
			widgets: ['zebra','rowHover'],
			widgetRowHover:{css:'highlight'}
		}).tablesorterPager({container: $("#pager"), size: 25, positionFixed: false});
	// });

		// $('#search_contacts').autocomplete(
		// 	'search_contacts.php',{
		// 		minChars: 0,
		// 		autoFill: false,
		// 		max: 300				
		// 	}).result(function(evt, data, formatted){
		// 		//save check_in info and then add row to table
		// 		$.ajax({
		// 		  url: 'save_check_in.php',
		// 		  type: 'get',
		// 		  dataType: 'html',
		// 		  data: "contact_id="+data[1],
		// 		  complete: function() {
		// 
		// 		  },
		// 		  success: function(msg){
		// 				var returned_data=msg.split('|');
		// 				if(parseFloat(returned_data[0].substr(0,1)) > 0){
		// 					var altrow="altrow";
		// 					var line_item="<tr class='"+altrow+"' id='contact_"+returned_data[0]+"'><td>"+data[0]+"</td><td>"+returned_data[1]+"</td>";
		// 					line_item+="<td><a href='#' class='del-line-item' id='"+returned_data[0]+"'><img src='images/delete.png' alt='delete line item></a></td></tr>";
		// 
		// 					$('#check-in tbody').append(line_item).hide().fadeIn(500);
		// 					$('#search_contacts').val('');
		// 				}
		// 		 },
		// 
		// 		  error: function() {
		// 				alert('there was an error saving the record.\nPlease try again later.');
		// 		  }
		// 		});
		// 
		// 	});





			$('#search_contacts').autocomplete({
				minLength: 1,
				source: function(request, response){
					$.ajax({
						url: "search_contacts.php?callback=?&limit=20",
						dataType: "json",
						data: {
							term: request.term
						},
						success: function(data){

							response($.map(data, function(item){
								return{
									label: item.first_name+" "+item.last_name,
									value: item.first_name+" "+item.last_name,
									contact_id: item.contact_id
								}
							}))
						}
					});
				},

				select: function(e, ui){//define select handler
					var id=$(this).parent().parent().attr('id');

					if(ui.item_contact_id != ""){//only submit the form if a name has been entered
						$.ajax({
						  url: 'save_check_in.php',
						  type: 'get',
						  dataType: 'html',
						  data: "contact_id="+ui.item.contact_id+"&name="+ui.item.label,
						  complete: function() {
					
						  },
						  success: function(msg){
								var returned_data=msg.split('|');

								if(parseFloat(returned_data[0].substr(0,1)) > 0){
									var altrow="altrow";
									var line_item="<tr class='"+altrow+"' id='contact_"+returned_data[0]+"'><td>"+unescape(returned_data[1].replace(/\+/g, " "))+"</td><td>"+unescape(returned_data[2].replace(/\+/g, " "))+"</td>";
									line_item+="<td><input type='button' name='add_note' value='Add Note' id='add_note_'+returned_data[0] /><textarea class='check-in-notes' name='note_'+returned_data[0]></textarea></td>";
									line_item+="<td><a href='#' class='del-line-item' id='"+returned_data[0]+"'><img src='images/delete.png' alt='delete line item'></a></td></tr>";
					
									$('#check-in tbody').append(line_item).hide().fadeIn(500);
									$('#search_contacts').val('');
									$.jGrowl("Check In Saved");
								}
						 },
					
						  error: function() {
								alert('there was an error saving the record.\nPlease try again later.');
						  }
						});
					}
					
				}
			});














			// $('#check-in').delegate('click', function(){
			$('.del-line-item').live('click', function(){
				// alert($(this).attr('id'));
				var confirm_delete=confirm("Are you sure you want to delete this record?");
				if(!confirm_delete)return false;

				$.ajax({
				  url: 'del_line_item.php',
				  type: 'get',
				  dataType: 'html',
				  data: 'contact_id='+$(this).attr('id'),
			  	success: function(id){
						if(id > 0){
							$('#contact_'+id).fadeOut(300);
							$('#search_contacts').focus();
						}else{
							alert('There was an error deleting the record.\nPlease try again later.')
						}
			 		},
				
			  	error: function(){
						alert('There was an error deleting the record.\nPlease try again later.')
			  	}
				});
			});

			$('.check-in-notes').autoResize({
			    // On resize:
			    onResize : function() {
			        $(this).css({opacity:0.8});
			    },
			    // After resize:
			    animateCallback : function() {
			        $(this).css({opacity:1});
			    },
			    animateDuration : 300,
			    // More extra space:
			    extraSpace : 15
			}).keydown();
			
		<?if($_GET['notification']){?>$.jGrowl('<?print $_GET['notification'];?>');<?}?>

		$('#save-check-in').click(function(){
			
		});
	});//end document.ready
</script>
