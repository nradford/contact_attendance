<form action="<?php print base_url();?>classes/class_save" id="class-add-form" class="" method="post" accept-charset="utf-8">

    <legend>Class Info</legend>
    <fieldset>
    	<input type="hidden" name="class_id" value="<?php print $class['id'];?>" id="class-id" />

        <div class="span12">
        	<label for="class-name">Class Name:</label>
        	<input type="text" value="<?php print $class['name'];?>" name="class_name" id="class-name" />

            <label for="min-age">Min. Age:</label>
            <input type="text" value="<?php print $class['age_min'];?>" name="age_min" id="age-min" />

            <label for="max-age">Max. Age:</label>
            <input type="text" value="<?php print $class['age_max'];?>" name="age_max" id="age-max" />
        </div><!-- .span12 -->

        <div class="span12">
            <p id="button-row">
                <a href="<?php print base_url();?>classes" class="btn btn-large btn-primary class-cancel-btn">Cancel</a>
                <?php
                if($class['id'] > 0){?>
                    <a href="<?php print base_url();?>classes/class_delete" id="class-delete-btn" class="btn btn-large btn-primary">Delete</a><?php
                }?>
                <button type="submit" class="btn btn-large btn-primary">Save Class</button>
            <p/>
        </div><!-- .span12 -->
    </fieldset>
</form>

<script>
    $(document).ready(function(){
        $('#class-name').focus();
        
		$("#class-delete-btn").click(function(e){
            e.preventDefault();
			var confirm_delete=confirm("Are you sure you want to delete this class?");
			if(confirm_delete){
                $('#class-add-form').attr('action', '<?php print base_url();?>classes/class_delete').submit();
            }
        });
    });//end document.ready
</script>