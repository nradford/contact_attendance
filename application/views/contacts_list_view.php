<form action="<?php print base_url();?>contacts/contact_edit" id="contacts-list-form" method="post" accept-charset="utf-8">
    <input type="hidden" name="contact_id" value="" id="contact-id" />
        <div class="pull-right">
            <a href="<?php print base_url();?>contacts/contact_add" class="btn btn-small btn-primary">Add New Kid</a>
        </div>
        <div class="row-fluid">

    	<div class="pull-left">
    		<input type="text" name="contacts_search" class="inputf" value="" id="contacts-search" placeholder="Search" autocorrect="off" autocapitalize="off" />
    	</div>
    </div><!-- row-fluid -->
    <?php
    if(sizeof($contacts) > 0){?>
			<table id="contacts-list-tbl" class="table table-striped table-bordered table-condensed footable" data-filter="#contacts-search">
				<thead>
					<tr>
						<th id="fname" data-class="expand">First Name</th>
						<th id="last">Last Name</th>
                        <!-- <th id="email" data-hide="phone">E-mail</th> -->
						<th id="mobile" data-hide="phone">Mobile Phone</th>
						<th id="home" data-hide="phone">Home Phone</th>
                        <!-- <th id="address" data-hide="phone,tablet">Address</th>
                        <th id="address2" data-hide="phone,tablet">Address 2</th> -->
						<th id="city" data-hide="phone,tablet">City</th>
                        <!-- <th id="state" data-hide="phone,tablet">State</th>
                        <th id="zip" data-hide="phone,tablet">Zip</th> -->
						<th id="school" data-hide="phone,tablet">School</th>
						<th id="bd" data-hide="phone,tablet">Birthday</th>
						<th id="status" data-hide="phone,tablet">Status</th>
					</tr>
				</thead>
				<tbody><?php
				$i=0;
				foreach($contacts as $contact){
					$print_bd="";
					if($contact['birthdate'] != "")$print_bd=date("n/j/Y", strtotime($contact['birthdate']));?>
						
					<tr id="contact-<?php print $contact['id'];?>" data-id="<?php print $contact['id'];?>">
    					<td><?php print $contact['fname'];?></td>
    					<td><?php print $contact['lname'];?></td>
                        <!-- <td><?php print $contact['email'];?></td> -->
    					<td><?php print $contact['mobile_phone'];?></td>
    					<td><?php print $contact['home_phone'];?></td>
                        <!-- <td><?php print $contact['address'];?></td>
                        <td><?php print $contact['address2'];?></td> -->
    					<td><?php print $contact['city'];?></td>
                        <!-- <td><?php print $contact['state'];?></td>
                        <td><?php print $contact['zip'];?></td> -->
    					<td><?php print $contact['school'];?></td>
    					<td><?php print $print_bd;?></td>
    					<td><?php 
                            if($contact['status'] == 1){
                                print "Active";
                            }else{
                                print "Inactive";
                            }?>
                        </td>
					</tr><?php
				}?>	
				</tbody>
			</table><?php
		  }else{?>
				<p class="alert">No kids found.<p><?php
		  }?>
		</form>

<script>
	$(document).ready(function(){
        $('.footable').footable();
        
		$('#contacts-list-tbl').on('click', "tbody tr td", function(){
            $$this = $(this);

            if($$this.hasClass('expand') && $$this.css('background-image') != "none"){//allow click on the expand cells to expand them and not go the edit page
                // return false;
            }else{
                $('#contact-id').val($(this).parent().attr('data-id'));
                $('#contacts-list-form').submit();
            }
		});
/*
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
*/



	});//end document.ready
</script>