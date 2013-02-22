<?php
$states = array(
'AL'=>"Alabama",
'AK'=>"Alaska",
'AZ'=>"Arizona",
'AR'=>"Arkansas",
'CA'=>"California",
'CO'=>"Colorado",
'CT'=>"Connecticut",
'DE'=>"Delaware",
'DC'=>"District Of Columbia",
'FL'=>"Florida",
'GA'=>"Georgia",
'HI'=>"Hawaii",
'ID'=>"Idaho",
'IL'=>"Illinois",
'IN'=>"Indiana",
'IA'=>"Iowa",
'KS'=>"Kansas",
'KY'=>"Kentucky",
'LA'=>"Louisiana",
'ME'=>"Maine",
'MD'=>"Maryland",
'MA'=>"Massachusetts",
'MI'=>"Michigan",
'MN'=>"Minnesota",
'MS'=>"Mississippi",
'MO'=>"Missouri",
'MT'=>"Montana",
'NE'=>"Nebraska",
'NV'=>"Nevada",
'NH'=>"New Hampshire",
'NJ'=>"New Jersey",
'NM'=>"New Mexico",
'NY'=>"New York",
'NC'=>"North Carolina",
'ND'=>"North Dakota",
'OH'=>"Ohio",
'OK'=>"Oklahoma",
'OR'=>"Oregon",
'PA'=>"Pennsylvania",
'RI'=>"Rhode Island",
'SC'=>"South Carolina",
'SD'=>"South Dakota",
'TN'=>"Tennessee",
'TX'=>"Texas",
'UT'=>"Utah",
'VT'=>"Vermont",
'VA'=>"Virginia",
'WA'=>"Washington",
'WV'=>"West Virginia",
'WI'=>"Wisconsin",
'WY'=>"Wyoming");
?>

<form action="<?php print base_url();?>contacts/contact_save" id="contact-add-form" class="" method="post" accept-charset="utf-8">
    <legend>Contact Info</legend>
    <fieldset>
    	<input type="hidden" name="contact_id" value="<?php print $contact['id'];?>" id="contact_id" />

        <div class="span6">
    		<label for="class">Status:</label>
    		<select name="status">
    			<option value="1" <?if($contact['status']=="1")print " selected";?>>Active</option>
    			<option value="0" <?if($contact['status']=="0")print " selected";?>>Non Active</option>
    		</select>
    									
        	<label for="fname">First Name:</label>
        	<input type="text" value="<?php print $contact['fname'];?>" name="fname" id="fname" />

    		<label for="lname">Last Name:</label>
    		<input type="text" value="<?php print $contact['lname'];?>" name="lname" id="lname" />
    		
    		<label for="date">Birthday:</label>
    		<?php
            $bd = "";
            print strtotime($contact['birthdate']);
            if(strtotime($contact['birthdate'])){
               $bd = date("n/j/Y", strtotime($contact['birthdate']));
            }?>
            
            <!-- <div class="input-prepend bfh-datepicker-toggle" data-toggle="bfh-datepicker">
              <span class="add-on"><i class="icon-calendar"></i></span>
              <input type="text" class="input-medium" readonly>
            </div> -->
            
            
    		<input type="date" name="birthdate" id="birthdate" value="<?php print $bd;?>" autocomplete="off" />
    		
    		<label for="email">Email:</label>
    		<input type="email" value="<?php print $contact['email'];?>" name="email" id="email" />
    		
    		<label for="mobile-phone">Mobile Phone:</label>
    		<input type="tel" value="<?php print $contact['mobile_phone'];?>" name="mobile_phone" id="mobile-phone" />

    		<label for="home-phone">Home Phone:</label>
    		<input type="tel" value="<?php print $contact['home_phone'];?>" name="home_phone" id="home-phone" />
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
            	<?php foreach($states as $key => $value){?>
            		<option value="<?php print $value;?>"<?php if($contact["state"]==$key)print " selected";?>><?php print $value;?></option>
            	<?php }?>
            </select>

            <label for="school">School:</label>
    		<input type="text" value="<?php print $contact['school'];?>" name="school" id="school" />
    		
    		<label for="notes">Notes:</label>
    		<textarea name="notes" id="notes"><?php print $contact['notes'];?></textarea>
        </div><!-- .span6 -->

        <div class="clearfix"></div>
        <button type="submit" class="btn btn-large btn-primary">Save Contact</button>
    </fieldset>
</form>

<script>
    $(document).ready(function(){
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
    })//end document.ready
</script>