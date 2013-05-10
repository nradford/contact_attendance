<form action="<?php print base_url();?>teachers/teacher_save" id="teacher-add-form" class="" method="post" accept-charset="utf-8">
    <input type="hidden" name="visitor" value="<?php print $this->input->get('visitor');?>" id="visitor" />

    <legend>Teacher Info</legend>
    <fieldset>
    	<input type="hidden" name="teacher_id" value="<?php print $teacher['id'];?>" id="teacher_id" />

        <div class="span6">    									
        	<label for="fname">First Name:</label>
        	<input type="text" value="<?php print $teacher['fname'];?>" name="fname" id="fname" />

    		<label for="lname">Last Name:</label>
    		<input type="text" value="<?php print $teacher['lname'];?>" name="lname" id="lname" />
    		
    		<label for="date">Birthday:</label>
    		<?php
            $bd = "";
            if(strtotime($teacher['birthdate'])){
               $bd = date("n/j/Y", strtotime($teacher['birthdate']));
            }?>
                
            <div class="input-append date" id="birthdate" data-date="<?php print $bd;?>">
                <input class="span2" type="text" name="birthdate" value="<?php print $bd;?>">
                <span class="add-on"><i class="icon-th"></i></span>
            </div>
            
            <!-- <input type="date" name="birthdate" id="birthdate" value="<?php print $bd;?>" autocomplete="off" /> -->
    		
    		<label for="email">Email:</label>
    		<input type="email" value="<?php print $teacher['email'];?>" name="email" id="email" />
    		
    		<label for="mobile-phone">Mobile Phone:</label>
    		<input type="tel" value="<?php print $teacher['mobile_phone'];?>" name="mobile_phone" id="mobile-phone" />

    		<label for="home-phone">Home Phone:</label>
    		<input type="tel" value="<?php print $teacher['home_phone'];?>" name="home_phone" id="home-phone" />
        </div><!-- .span6 -->

        <div class="span6">
    		<label for="address">Address:</label>
    		<input type="text" value="<?php print $teacher['address'];?>" name="address" id="address" />
    			
    		<label for="address2">Address 2:</label>
    		<input type="text" value="<?php print $teacher['address2'];?>" name="address2" id="address2" />
    		
    		<label for="zip">Zip Code:</label>
    		<input type="text" value="<?php print $teacher['zip']; ?>" name="zip" id="zip" />

    		<label for="city">City:</label>
    		<input type="text" value="<?php print $teacher['city'];?>" name="city" id="city" />

            <label for="state">State</label>
            <select name="state" id="state">
            	<option value="">Select a State</option>
            	<?php foreach($this->config->item('states') as $key => $value){?>
            		<option value="<?php print $value;?>"<?php if($teacher["state"]==$value)print " selected";?>><?php print $value;?></option><?php 
                }?>
            </select>

    		<label for="class">Status:</label>
    		<select name="status">
    			<option value="1" <?if($teacher['status']=="1")print " selected";?>>Active</option>
    			<option value="0" <?if($teacher['status']=="0")print " selected";?>>Non Active</option>
    		</select>

    		<label for="notes">Notes:</label>
    		<textarea name="notes" id="notes"><?php print $teacher['notes'];?></textarea>
        </div><!-- .span6 -->

        <div class="span12">
            <p id="button-row">
                <a href="<?php print base_url();?>teachers" class="btn btn-large btn-primary teacher-cancel-btn">Cancel</a>
                <?php
                if($teacher['id'] > 0){?>
                    <a href="<?php print base_url();?>teachers/teacher_delete" id="teacher-delete-btn" class="btn btn-large btn-primary">Delete</a><?php
                }?>
                <button type="submit" class="btn btn-large btn-primary">Save Info</button>
            <p/>
        </div><!-- .span6 -->
    </fieldset>
</form>

<script>
    $(document).ready(function(){
        $('#fname').focus();

        var elements = {
            state: $('#state'),
            city: $('#city'),
            zip: $('#zip')
        }

        // Initialize the ziptastic and bind to the change of zip code
        elements.zip.ziptastic().on('zipChange', function(evt, country, state, city, zip){
            elements.state.val(state);
            elements.city.val(city);
        });
        
        $('#birthdate').datepicker({
            format: "m/d/yyyy"
        });
        
		$("#teacher-delete-btn").click(function(e){
            e.preventDefault();
			var confirm_delete=confirm("Are you sure you want to delete this teacher?");
			if(confirm_delete){
                $('#teacher-add-form').attr('action', '<?php print base_url();?>teachers/teacher_delete').submit();
            }
        });
    });//end document.ready
</script>