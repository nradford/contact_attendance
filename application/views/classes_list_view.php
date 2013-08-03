<form action="<?php print base_url();?>classes/class_edit" id="classes-list-form" method="post" accept-charset="utf-8">
    <input type="hidden" name="class_id" value="" id="class-id" />
        <div class="pull-right">
            <a href="<?php print base_url();?>classes/class_add" class="btn btn-small btn-primary">Add New Class</a>
        </div>
        <div class="row-fluid">

    	<div class="pull-left">
    		<input type="text" name="classes_search" class="inputf" value="" id="classes-search" placeholder="Search" autocorrect="off" autocapitalize="off" />
    	</div>
    </div><!-- row-fluid -->
    <?php
    if(sizeof($classes) > 0){?>
			<table id="classes-list-tbl" class="table table-striped table-bordered table-condensed footable" data-filter="#classes-search">
				<thead>
					<tr>
						<th id="class_name">Class Name</th>
						<th id="min-age">Min. Age</th>
						<th id="max-age">Max. Age</th>
					</tr>
				</thead>
				<tbody><?php
				$i = 0;
				foreach($classes as $class){?>
					<tr id="class-<?php print $class['id'];?>" data-id="<?php print $class['id'];?>">
    					<td><?php print $class['name'];?></td>
    					<td><?php print $class['age_min'];?></td>
    					<td><?php print $class['age_max'];?></td>
					</tr><?php
				}?>	
				</tbody>
			</table><?php
		  }else{?>
				<p class="alert">No classes found.<p><?php
		  }?>
		</form>

<script>
	$(document).ready(function(){
        $('.footable').footable();
        
		$('#classes-list-tbl').on('click', "tbody tr td", function(){
            $$this = $(this);
            $('#class-id').val($(this).parent().attr('data-id'));
            $('#classes-list-form').submit();
		});
	});//end document.ready
</script>