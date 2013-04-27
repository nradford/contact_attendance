<form action="<?php print base_url();?>class_report" id="class-report-form" method="post">
    <div class="pull-left">
        <h3>Class Report</h3>
    </div>
    
    <div class="row-fluid">
        <div class="pull-right" id="data-date">
            <input type="hidden" name="class_date" value="<?php print $class_date;?>" id="class-date" />
            <a href="#" id="check-in-date-link" data-type="combodate" data-value="<?php print $class_date;?>" data-format="YYYY-MM-DD" data-viewformat="ddd, MMMM Do YYYY" data-template="MMM / D / YYYY"><?php print date("D, F j Y", strtotime($class_date));?></a>
        </div>
    </div><!-- row-fluid -->

    <div class="row-fluid">
		<table id="class-report-check-in-table" class="table table-striped table-bordered table-condensed footable">
			<thead>
			<tr>
				<th class="check-in-name" data-class="expand">Name</th>
				<th class="check-in-time">Checked In</th>
				<th class="check-in-time">Checked Out</th>
                <th class="check-in-class" data-hide="phone">Class</th>
                <th class="check-in-visitor" data-hide="phone">Visitor</th>
                <th class="check-in-offering" data-hide="phone">Offering</th>
			</tr>
			</thead>

			<tbody><?php
                $cnt = 0;
				if(sizeof($check_ins) > 0){
					$cnt++;
					foreach($check_ins as $check_in){
                        $check_in_time = "";
                        $check_out_time = "";
						if($check_in['checked_in'] > 0)$check_in_time = date("g:i a", strtotime($check_in['checked_in']));
						if($check_in['checked_out'] > 0)$check_out_time = date("g:i a", strtotime($check_in['checked_out']));
                        ?>
						<tr id='check-in-<?print $check_in['id'];?>'>
							<td><?php print $check_in['fname']." ".$check_in['lname'];?></td>
                            <td>
                                <?print $check_in_time;?>
                                <input type="hidden" name="check_in_id_<?php print $cnt;?>" value="<?print $check_in['id'];?>" id="check-in-id-<?print $check_in['id'];?>" />
                            </td>

                            <td>
                                <?print $check_out_time;?>
                            </td>
                                
                            <td>
                                <?php print $check_in['class_name'];?>
                            </td>

                            <td>
                                <?php
                                switch($check_in['visitor']){
                                    case '0':
                                        print "No";
                                    break;
                                    
                                    case '1':
                                        print "Yes";
                                    break;
                                }?>
                            </td>

                            <td>
                                $<?print $check_in['offering'];?>
                            </td>
						</tr><?
					}
					$cnt++;
				}?>
			</tbody>
            
            <tfoot>
                <tr>
                    <td>Totals</td>
                    <td><?php print $totals['num_check_ins'];?></td>
                    <td><?php print $totals['num_check_outs'];?></td>
                    <td></td>
                    <td><?php print $totals['num_visitors'];?></td>
                    <td>$<?php print $totals['offering_total'];?></td>
                </tr>
            </tfoot>
		</table>
    </div><!-- row-fluid -->

    <div class="row-fluid">
        <div class="span12">
            <h3>Incident Report</h3>
            <textarea id="incident-report-textarea"><?php print $incident_report['report'];?></textarea>
            <!-- <div id="incident-report-textarea" contenteditable><?php print $incident_report['report'];?></div> -->

            <!-- <a href="#" id="pencil"><i class="icon-pencil"></i> [edit]</a>
            <div id="incident-report" data-pk="<?php print $incident_report['id'];?>" data-type="textarea">
                <?php //print $incident_report['report'];?>
            </div> -->
        </div>
    </div><!-- row-fluid -->
    
</form>

<script>
	$(document).ready(function(){
        $.fn.editable.defaults.placement = 'bottom';

        $(document).ajaxSuccess(function(event, xhr, settings){
            //if the ajax success is from the date change
            if(settings.url == "<?php print base_url();?>check_in/date_change"){
                //update the check-in date hidden input and post the form back to itself to load the check-in page for the new date
                $('#class-date').val(xhr.responseText);
                $('#class-report-form').submit();
            }
        });

        $('#check-in-date-link').editable({
            mode: 'inline',
            url: '<?php print base_url();?>check_in/date_change',
            send: 'always',
            combodate: {
                minYear: '<?php print date("Y") - 5;?>',
                maxYear: '<?php print date("Y") + 1;?>'
            }
        });

        init_x_editable();//initialize the dynamic x-editable fields

        $('#class-report-check-in-table').footable();

		$('#class-report-check-in-table').on('click', '.del-line-item', function(){
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

	});//end document.ready
    
    function init_x_editable(){
        jQuery('.check-in-class-link').editable({
            url: '<?php print base_url();?>check_in/class_update',
            title: 'Select A Class',
            source: [
                <?php
                $class_source = "";
                foreach($classes as $class){
                    $class_source .= '{value: "'.$class['id'].'", text: "'.$class['name'].'"},';
                }
                $class_source = rtrim($class_source, ',');
                print $class_source;?>
            ],
            showbuttons: false
        });

        //remove the editable classes so that the plugin will not assume it has already been initialized
        jQuery('.contact-note').removeClass('editable editable-click').editable({
            url: '<?php print base_url();?>contacts/note_save'
        });
    }
</script>