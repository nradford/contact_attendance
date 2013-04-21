<form action="<?php print base_url();?>reports" id="report-check-in-form" method="post">
    <div class="row-fluid">
        <div class="pull-right" id="data-date">
            <input type="hidden" name="check_date" value="<?php print $check_date;?>" id="check-date" />
            <a href="#" id="check-in-date-link" data-type="combodate" data-value="<?php print $check_date;?>" data-format="YYYY-MM-DD" data-viewformat="ddd, MMMM Do YYYY" data-template="MMM / D / YYYY"><?php print date("D, F j Y", strtotime($check_date));?></a>
        </div>
    </div><!-- row-fluid -->

    <div class="row-fluid">
		<table id="check-in" class="table table-striped table-bordered table-condensed footable">
			<thead>
			<tr>
				<th class="check-in-name" data-class="expand">Name</th>
				<th class="check-in-time">Check In Time</th>
                <th class="check-in-class" data-hide="phone">Class</th>
				<th data-hide="phone" data-hide="phone">Notes</th>
			</tr>
			</thead>

			<tbody><?php
				if(sizeof($check_ins) > 0){
					$cnt++;
					foreach($check_ins as $check_in){
						if($check_in['checked_in'] != "")$check_in_time = date("g:i a", strtotime($check_in['checked_in']));?>
						<tr id='check-in-<?print $check_in['id'];?>'>
							<td><?php print $check_in['fname']." ".$check_in['lname'];?></td>
							<td><?php print $check_in_time;?></td>
                            <td><?php print $check_in['class_name'];?></td>
							<td><?php print nl2br($check_in['notes']);?></td>
						</tr><?
					}
					$cnt++;
				}?>
			</tbody>
		</table>

        <a href="#" id="pencil"><i class="icon-pencil"></i> [edit]</a>
        <div id="class-report" data-pk="1" data-type="wysihtml5" data-toggle="manual" data-original-title="Enter notes" class="editable" tabindex="-1" style="display: block;"></div>
    </div><!-- row-fluid -->
</form>

<script>
	$(document).ready(function(){
        $.fn.editable.defaults.placement = 'bottom';

        $(document).ajaxSuccess(function(event, xhr, settings){
            //if the ajax success is from the date change
            if(settings.url == "<?php print base_url();?>reports/date_change"){
                //update the check-in date hidden input and post the form back to itself to load the check-in page for the new date
                $('#check-date').val(xhr.responseText);
                $('#report-check-in-form').submit();
            }
        });

        $('#check-in-date-link').editable({
            mode: 'inline',
            url: '<?php print base_url();?>reports/date_change',
            send: 'always',
            combodate: {
                minYear: '<?php print date("Y") - 5;?>',
                maxYear: '<?php print date("Y") + 1;?>'
            }
        });

        $('.footable').footable();
	});//end document.ready
</script>