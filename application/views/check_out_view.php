<form action="<?php print base_url();?>check_out" id="check-out-form" method="post">
    <div class="row-fluid">
        <div class="pull-right" id="check-out-date">
            <input type="hidden" name="check_date" value="<?php print $check_date;?>" id="check-date" />
            <a href="#" id="check-out-date-link" data-type="combodate" data-value="<?php print $check_date;?>" data-format="YYYY-MM-DD" data-viewformat="ddd, MMMM Do YYYY" data-template="MMM / D / YYYY"><?php print date("D, F j Y", strtotime($check_date));?></a>
        </div>

        <!-- <div class="pull-left">
            <input type="text" id="contacts-search" class="inputf" placeholder="Search" />
        </div> -->
    </div><!-- row-fluid -->

    <div class="row-fluid">
        <h3>Checked In</h3><?php

        $cnt = 0;
		if(sizeof($check_ins) > 0){?>
    		<table id="check-in-table" class="table table-striped table-bordered table-condensed footable" data-filter="#contacts-search">
    			<thead>
    			<tr>
    				<th class="check-out-name" data-class="expand">Name</th>
    				<th class="check-out-time">Checked In</th>
                    <th class="check-out-class" data-hide="phone">Class</th>
                    <th class="check-out-code">Check In Code</th>
    				<th class="check-out-note" data-hide="phone">Notes</th>
    				<th class="check-out-col"></th>
    			</tr>
                </thead>

                <tbody><?php
					$cnt++;
					foreach($check_ins as $check_in){
                        $check_in_time = "";
						if($check_in['checked_in'] != "")$check_in_time = date("g:i a", strtotime($check_in['checked_in']));?>
						<tr id='check-out-<?print $check_in['id'];?>'>
							<td><?php print $check_in['fname']." ".$check_in['lname'];?></td>
							<td>
								<?print $check_in_time;?>
								<input type="hidden" name="check_out_id_<?php print $cnt;?>" value="<?print $check_in['id'];?>" id="check-out-id-<?print $check_in['id'];?>" />
							</td>
                                
                            <td>
                                <?php print $check_in['class_name'];?>
                            </td>

                            <td>
                                <?php print $check_in['check_in_code'];?>
                            </td>

							<td>
                                <a href="#" id="contact-note-<?php print $check_in['id'];?>" data-type="textarea" data-pk="<?php print $check_in['contact_id'];?>" class="contact-note"><?php print nl2br($check_in['notes']);?></a>
                            </td>
								
							<td>
								<a href='#' class='check-out-btn btn btn-inverse' data-id='<?print $check_in['id'];?>' id='check-out-btn-<?print $check_in['id'];?>'>Check Out</a>
							</td>
						</tr><?
					}
					$cnt++;?>
    			</tbody>
    		</table>
            <?php
        }else{?>
            <p class="alert">No Check-Ins Found.</p><?php
        }?>

        <h3>Checked Out</h3><?php
        if(sizeof($check_outs) > 0){?>
    		<table id="check-out-table" class="table table-striped table-bordered table-condensed footable">
    			<thead>
    			<tr>
    				<th class="check-out-name" data-class="expand">Name</th>
    				<th class="check-out-time">Checked Out</th>
                    <th class="check-out-class" data-hide="phone">Class</th>
                    <th class="check-in-code">Check In Code</th>
    			</tr>
    			</thead>
    			<tbody><?php
					foreach($check_outs as $check_out){
                        $check_out_time = "";
						if($check_out['checked_out'] != "")$check_out_time = date("g:i a", strtotime($check_out['checked_out']));?>
						<tr id='check-out-<?print $check_out['id'];?>'>
							<td><?php print $check_out['fname']." ".$check_out['lname'];?></td>
							<td>
								<?print $check_out_time;?>
								<input type="hidden" name="check_out_id_<?php print $cnt;?>" value="<?print $check_out['id'];?>" id="check-out-id-<?print $check_out['id'];?>" />
							</td>
                                
                            <td>
                                <?php print $check_out['class_name'];?>
                            </td>

                            <td>
                                <?php print $check_out['check_in_code'];?>
                            </td>
						</tr><?
					}?>
                </tbody>
            </table><?php
        }else{?>
            <p class="alert">No Check-Outs Found.</p><?php   
        }?>
            
            
            
        <!-- <a href="#" id="pencil"><i class="icon-pencil"></i> [edit]</a>
        <div id="class-report" data-pk="1" data-type="wysihtml5" data-toggle="manual" data-original-title="Enter notes" class="editable" tabindex="-1" style="display: block;"></div> -->
    </div><!-- row-fluid -->
</form>

<script>
	$(document).ready(function(){
        // $('#contacts-search').focus();
        
        // $.fn.editable.defaults.mode = 'popover';
        $.fn.editable.defaults.placement = 'bottom';

        $(document).ajaxSuccess(function(event, xhr, settings){
            //if the ajax success is from the date change
            if(settings.url == "<?php print base_url();?>check_in/date_change"){
                //update the check-out date hidden input and post the form back to itself to load the check-out page for the new date
                $('#check-date').val(xhr.responseText);
                $('#check-out-form').submit();
            }
        });

        $('#check-out-date-link').editable({
            mode: 'inline',
            url: '<?php print base_url();?>check_in/date_change',
            send: 'always',
            combodate: {
                minYear: '<?php print date("Y") - 5;?>',
                maxYear: '<?php print date("Y") + 1;?>'
            }
        });

        init_x_editable();//initialize the dynamic x-editable fields

        $('#check-out-table').footable();


		$('.check-out-btn').click(function(){
            $.ajax({
                url: '<?php print base_url();?>check_out/check_out_save',
                type: 'get',
                dataType: 'json',
                data: 'check_in_id='+$(this).attr('data-id'),
                success: function(data){
                	if(data.check_out_id > 0){
                		$('#check-out-'+data.check_out_id).fadeOut(300);
                		$('#contacts-search').focus();

                        //add the checked out entry to the checked-out-list
                        // $('#checked-out-list').append('<li>'+data.name+' - '+data.check_in_code+' - '+data.check_out_time+'</li>')
                        
                        var line_item = "<tr id='check-out-"+check_out_id+"'>";
                        line_item += "<td>"+data.name+"</td>";
                        line_item += "<td>"+data.check_out_time+"</td>";
                        line_item += '<td><a id="check-in-class-link-"'+check_in_id+'" class="check-in-class-link" data-type="select" data-pk="'+check_in_id+'" data-value="'+data.class_id+'"></a></td>';
                        line_item += "<td>"+data.check_in_code+"</td>";
                        $('#check-out-table tbody').prepend(line_item).hide().fadeIn(300);
                	}else{
                		alert('There was an error checking out the entry :(\nPlease try again later.')
                	}
                },				
                error: function(){
                	alert('There was an error checking out the entry :(\nPlease try again later.')
                }
            });
        });

	});//end document.ready
    
    function init_x_editable(){        
        jQuery('.contact-note').removeClass('editable editable-click').editable({
            url: '<?php print base_url();?>contacts/note_save'
        });
    }
</script>