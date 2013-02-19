<form action="" id="contacts-list-form" method="post" accept-charset="utf-8">
    <div class="row-fluid">
    	<div class="span4">
    		<input type="text" name="contacts_search" class="inputf" value="" id="contacts-search" placeholder="Search" />
    	</div>
			
        <!-- <div class="span8" id="check-in-date"><?php print date("D, F j Y", strtotime(date("Ymd")));?></div> -->
    </div><!-- row-fluid -->
    <?php
             if(sizeof($contacts) > 0){?>
			<table id="check-in" class="table table-striped table-bordered table-condensed footable">
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
						<th id="status" data-hide="phone,tablet">Status</th>
					</tr>
				</thead>
				<tbody><?php
				$i=0;
				foreach($contacts as $contact){
					$print_bd="";
					if($contact['birthdate'] != "")$print_bd=date("n/j/Y", strtotime($contact['birthdate']));?>
						
					<tr id="<?print $contact['id'];?>">
    					<td><?print $contact['fname'];?></td>
    					<td><?print $contact['lname'];?></td>
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
					</tr><?php
				}?>	
				</tbody>
			</table><?php
		  }else{?>
				<p class="none-found">No contacts found.<p><?php
		  }?>


		</form>

<script>
	$(document).ready(function(){
        $('#contacts-search').focus();
        
        $('.footable').footable();

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
                                 line_item+="<td><a href='#' class='btn btn-mini' id='add-note-'"+returned_data[0]+">Add Note</a><textarea class='check-in-notes' name='note_'+returned_data[0]></textarea></td>";
                                 line_item+="<td><a href='#' class='del-line-item' data-id='"+returned_data[0]+"' id='check-in-delete-"+returned_data[0]+"'><i class='icon-trash''></i></a></td></tr>";
					
                                 $('#check-in tbody').prepend(line_item).hide().fadeIn(300);
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
			if(!confirm_delete){
                return false;
            }else{
                $.ajax({
                    url: '<?php print base_url();?>check_in/check_in_delete',
                    type: 'get',
                    dataType: 'html',
                    data: 'check_in_id='+$(this).attr('data-id'),
                    success: function(id){
                    	if(id > 0){
                    		$('#check-in-'+id).fadeOut(300);
                    		$('#contacts-search').focus();
                    	}else{
                    		alert('There was an error deleting the record.\nPlease try again later.')
                    	}
                    },				
                    error: function(){
                    	alert('There was an error deleting the record.\nPlease try again later.')
                    }
                });
            }
        });


			
		<?if($_GET['notification']){?>$.jGrowl('<?print $_GET['notification'];?>');<?}?>

	});//end document.ready
</script>
