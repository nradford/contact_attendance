<form action="<?php print base_url();?>teachers/teacher_edit" id="teachers-list-form" method="post" accept-charset="utf-8">
    <input type="hidden" name="teacher_id" value="" id="teacher-id" />
        <div class="pull-right">
            <a href="<?php print base_url();?>teachers/teacher_add" class="btn btn-small btn-primary">Add New Teacher</a>
        </div>
        <div class="row-fluid">

    	<div class="pull-left">
    		<input type="text" name="teachers_search" class="inputf" value="" id="teachers-search" placeholder="Search" autocorrect="off" autocapitalize="off" />
    	</div>
    </div><!-- row-fluid -->
    <?php
    if(sizeof($teachers) > 0){?>
			<table id="teachers-list-tbl" class="table table-striped table-bordered table-condensed footable" data-filter="#teachers-search">
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
                        <!-- <th id="bd" data-hide="phone,tablet">Birthday</th> -->
                        <!-- <th id="status" data-hide="phone,tablet">Status</th> -->
					</tr>
				</thead>
				<tbody><?php
				$i=0;
				foreach($teachers as $teacher){
					$print_bd="";
					if($teacher['birthdate'] != "")$print_bd=date("n/j/Y", strtotime($teacher['birthdate']));?>
						
					<tr id="teacher-<?php print $teacher['id'];?>" data-id="<?php print $teacher['id'];?>">
    					<td><?php print $teacher['fname'];?></td>
    					<td><?php print $teacher['lname'];?></td>
                        <!-- <td><?php print $teacher['email'];?></td> -->
    					<td><?php print $teacher['mobile_phone'];?></td>
    					<td><?php print $teacher['home_phone'];?></td>
                        <!-- <td><?php print $teacher['address'];?></td>
                        <td><?php print $teacher['address2'];?></td> -->
    					<td><?php print $teacher['city'];?></td>
                        <!-- <td><?php print $teacher['state'];?></td>
                        <td><?php print $teacher['zip'];?></td> -->
                        <!-- <td><?php print $print_bd;?></td> -->
    					<!--
                        <td><?php 
                            if($teacher['status'] == 1){
                                print "Active";
                            }else{
                                print "Inactive";
                            }?>
                        </td>
                        -->
					</tr><?php
				}?>	
				</tbody>
			</table><?php
		  }else{?>
				<p class="alert">No teachers found.<p><?php
		  }?>
		</form>

<script>
	$(document).ready(function(){
        $('.footable').footable();
        
		$('#teachers-list-tbl').on('click', "tbody tr td", function(){
            $$this = $(this);

            if($$this.hasClass('expand') && $$this.css('background-image') != "none"){//allow click on the expand cells to expand them and not go the edit page
                // return false;
            }else{
                $('#teacher-id').val($(this).parent().attr('data-id'));
                $('#teachers-list-form').submit();
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
                    		$('#teachers-search').focus();
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