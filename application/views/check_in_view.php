<form action="save_check_in.php" id="check_in_form" method="post" accept-charset="utf-8">
	<!-- <input type="hidden" name="contact_id" value="" id="contact_id" /> -->
	<div class="span6">
		<input type="text" name="contacts_search" class="inputf" value="" id="contacts-search" placeholder="Search" />
	</div>
			
    <div class="span6" id="check-in-date"><?print date("D, F j Y", strtotime(date("Ymd")));?></div>
			
			<table id="check-in" class="table table-striped table-bordered table-condensed">
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
								<td><?print $check_in['fname']." ".$check_in['lname'];?></td>
								<td>
									<?print $check_in_time;?>
									<input type="hidden" name="contact_id_<?print $cnt;?>" value="<?print $check_in['contact_id'];?>" id="contact_id_<?print $check_in['contact_id'];?>" />
								</td>
								
								<td><input type="button" name="add_note" value="Add Note" id="add_note_<?print $check_in['id'];?>" /><textarea class="check-in-notes" name="note_<?print $check_in['id'];?>"></textarea></td>
								
								<td>
									<a href='#' class='del-line-item' id='<?print $check_in['id'];?>'><i class="icon-trash"></i></a>
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
        $('#contacts-search').focus();

		//prevent the form from submiting when enter/return is pressed when search box is focused
		$('#check_in_form').submit(function(e){e.preventDefault();});

        $('#contacts-search').typeahead({
            minLength: 2,
            source: function (typeahead, process){
                $.ajax({
                    url: "check_in/contacts_search/?callback=options&limit=20",
                    type: 'get',
                    data: {term: typeahead},
                    dataType: 'json',
                    success: function(json){
                        contacts = [];
                        map = {};
                        
                        /*
                            TODO need to find a way to check in based on the contact_id rather than mapping based on fname lname. Not currently supported by the typeahead function 
                        */

                        // create array of contact names to return for the drop down list and a map witht the fnam and lname as the key with the contact_id 
                        $.each(json.options, function (i, option){
                            map[option.fname+' '+option.lname] = option.contact_id;
                            contacts.push(option.fname+' '+option.lname);
                        });

                        return process(contacts);
                    },
                    error: function(){
                        alert("There was an error processing your request.\nPlease try again later.");
                    }
                });
             },
             updater: function(item){
                 /*
                     TODO prevent duplicate check-ins
                 */
                 // var id=$(this).parent().parent().attr('id');
                 contact_id = map[item];
                 
                 if(contact_id != ""){//only process if a name has been entered
                     $.ajax({
                         url: 'check_in/check_in_save',
                         type: 'get',
                         dataType: 'html',
                         data: "contact_id="+contact_id+"&name="+item,
                         complete: function(){},
                         success: function(msg){
                             var returned_data=msg.split('|');

                             if(parseFloat(returned_data[0].substr(0,1)) > 0){
                                 var altrow="altrow";
                                 var line_item="<tr class='"+altrow+"' id='contact_"+returned_data[0]+"'><td>"+unescape(returned_data[1].replace(/\+/g, " "))+"</td><td>"+unescape(returned_data[2].replace(/\+/g, " "))+"</td>";
                                 line_item+="<td><input type='button' name='add_note' value='Add Note' id='add_note_'+returned_data[0] /><textarea class='check-in-notes' name='note_'+returned_data[0]></textarea></td>";
                                 line_item+="<td><a href='#' class='del-line-item' id='"+returned_data[0]+"'><i class='icon-trash''></i></a></td></tr>";
					
                                 $('#check-in tbody').prepend(line_item).hide().fadeIn(500);
                                 $('#contacts-search').val('');
                                 // $.jGrowl("Check In Saved");
                             }
                         }
                     });
                 }

                 return item;//return the contact's name
             }
         });

		$('.del-line-item').on('click', function(){
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


			
		<?if($_GET['notification']){?>$.jGrowl('<?print $_GET['notification'];?>');<?}?>

	});//end document.ready
</script>
