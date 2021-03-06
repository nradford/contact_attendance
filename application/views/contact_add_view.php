<form action="<?php print base_url();?>contacts/contact_save" id="contact-add-form" class="" method="post" accept-charset="utf-8">
    <input type="hidden" name="visitor" value="<?php print $this->input->get('visitor');?>" id="visitor" />

    <legend>Contact Info</legend>
    <fieldset>
    	<input type="hidden" name="contact_id" value="<?php print $contact['id'];?>" id="contact_id" />

        <div class="span6">    									
        	<label for="fname">First Name:</label>
        	<input type="text" value="<?php print $contact['fname'];?>" name="fname" id="fname" />

    		<label for="lname">Last Name:</label>
    		<input type="text" value="<?php print $contact['lname'];?>" name="lname" id="lname" />

    		<label for="date">Birthday:</label>
    		<?php
            $bd = "";
            if($contact['birthdate'] != "0000-00-00"){
                if(strtotime($contact['birthdate']) === false){
                    $bd = "";               
                }else{
                    $bd = date("Y-m-d", strtotime($contact['birthdate']));
                }
            }?>

            <!-- <div class="input-append date" id="birthdate" data-date="<?php print $bd;?>">
                <input class="span2" type="text" name="birthdate" value="<?php print $bd;?>">
                <span class="add-on"><i class="icon-th"></i></span>
            </div> -->

    		<input type="text" value="<?php print $bd;?>" name="birthdate" id="birthdate" />

            
            <!-- <input type="date" name="birthdate" id="birthdate" value="<?php print $bd;?>" autocomplete="off" /> -->
    		
    		<label for="email">Email:</label>
    		<input type="email" value="<?php print $contact['email'];?>" name="email" id="email" />
    		
    		<label for="mobile-phone">Mobile Phone:</label>
    		<input type="tel" value="<?php print $contact['mobile_phone'];?>" name="mobile_phone" id="mobile-phone" />

    		<label for="home-phone">Home Phone:</label>
    		<input type="tel" value="<?php print $contact['home_phone'];?>" name="home_phone" id="home-phone" />
            
            <label for="school">School:</label>
    		<input type="text" value="<?php print $contact['school'];?>" name="school" id="school" />
        </div><!-- .span6 -->

        <div class="span6">
    		<label for="address">Address:</label>
    		<input type="text" value="<?php print $contact['address'];?>" name="address" id="address" />
    			
    		<label for="address2">Address 2:</label>
    		<input type="text" value="<?php print $contact['address2'];?>" name="address2" id="address2" />
    		
    		<label for="zip">Zip Code:</label>
    		<input type="text" value="<?php print $contact['zip']; ?>" name="zip" id="zip" />

    		<label for="city">City:</label>
    		<input type="text" value="<?php print $contact['city'];?>" name="city" id="city" />
    		
            <label for="state">State</label>
            <select name="state" id="state">
            	<option value="">Select a State</option>
            	<?php foreach($this->config->item('states') as $key => $value){?>
            		<option value="<?php print $value;?>"<?php if($contact["state"]==$value)print " selected";?>><?php print $value;?></option><?php 
                }?>
            </select>

    		<label for="class">Status:</label>
    		<select name="status">
    			<option value="1" <?if($contact['status']=="1")print " selected";?>>Active</option>
    			<option value="0" <?if($contact['status']=="0")print " selected";?>>Non Active</option>
    		</select>

    		<label for="notes">Notes:</label>
    		<textarea name="notes" id="notes"><?php print $contact['notes'];?></textarea>
        </div><!-- .span6 -->

        <div class="span12">
            <p id="button-row">
                <a href="<?php print base_url();?>contacts" class="btn btn-large btn-primary contact-cancel-btn">Cancel</a>
                <?php
                if($contact['id'] > 0){?>
                    <a href="<?php print base_url();?>contacts/contact_delete" id="contact-delete-btn" class="btn btn-large btn-primary">Delete</a><?php
                }?>
                <button type="button" id="save-contact-btn" class="btn btn-large btn-primary">Save Info</button>
            <p/>
        </div><!-- .span6 -->
    </fieldset>
</form>

<script>
    "use strict";
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
        
        // $('#birthdate').datepicker({
        //     format: "m/d/yyyy"
        // });
        
        $('#birthdate').combodate({
            format: "YYYY-MM-DD",
            template: "MMMM D YYYY",
            minYear: "<?php print date('Y') - 14;?>",
            maxYear: "<?php print date('Y');?>",
            errorClass: "error"
        });
        
		$("#contact-delete-btn").click(function(e){
            e.preventDefault();
			var confirm_delete=confirm("Are you sure you want to delete this record?");
			if(confirm_delete){
                $('#contact-add-form').attr('action', '<?php print base_url();?>contacts/contact_delete').submit();
            }
        });

        $('#save-contact-btn').click(function(){
            check_date();
        });
        
        $('.month, .day, .year').change(function(){
            var month = $('.month').val();
            if(month != "")month = (month * 1) + 1;
            var day = $('.day').val();
            var year = $('.year').val();

            if(moment(year+"-"+month+"-"+day, 'YYYY-MM-DD').isValid() || (month == "" && day == "" && year == "")){
                $('.month, .day, .year').removeClass('error').focus();
            }else{
                $('.month, .day, .year').addClass('error').focus();
            }
        });
    });//end document.ready

    function check_date(){
        /**
         * When submitting the form, check to see if birthdate is valid.
         * If the date is not valid add an error class to it and prevent the form from being submitted.
        */
        // var $$this = jQuery('span.combodate');

        //find the date values
        var month = $('.month').val();
        if(month != "")month = (month * 1) + 1;
        var day = $('.day').val();
        var year = $('.year').val();

        if(moment(year+"-"+month+"-"+day, 'YYYY-MM-DD').isValid() || (month == "" && day == "" && year == "")){
            jQuery('#contact-add-form').submit();
        }else{
            // $$this.find('select').removeClass('error');
            $('.month, .day, .year').addClass('error').focus();
        }
    }
</script>