<form action="save_check_in.php" id="check_in_form" method="post" accept-charset="utf-8">
	<!-- <input type="hidden" name="contact_id" value="" id="contact_id" /> -->
    
    <div class="row-fluid">
    	<div class="pull-left">
    		<input type="text" name="contacts_search" class="inputf" value="" id="contacts-search" placeholder="Search" />
    	</div>
			
        <div class="pull-right" id="check-in-date"><?php
        $check_date = date('Y-m-d');
        ?>
            <input type="hidden" name="check_date" value="<?php print $check_date;?>" id="check-date" />
            <a href="#" id="check-in-date-link" data-type="date" data-pk="1" data-url="" data-original-title="Select date"><?php print date("D, F j Y", strtotime($check_date));?></a>
        </div>
    </div><!-- row-fluid -->

			<table id="check-in" class="table table-striped table-bordered table-condensed footable">
				<thead>
				<tr>
					<th class="check-in-name" data-class="expand">Name</th>
					<th class="check-in-time">Check In Time</th>
                    <th class="check-in-class" data-hide="phone">Class</th>
					<th data-hide="phone" data-hide="phone">Notes</th>
					<th class="check-in-delete"></th>
				</tr>
				</thead>

				<tbody><?php
					if(sizeof($check_ins) > 0){
						$cnt++;
						foreach($check_ins as $check_in){
							if($check_in['checked_in'] != "")$check_in_time=date("g:i a", $check_in['checked_in']);?>
							<tr id='check-in-<?print $check_in['id'];?>'>
								<td><?print $check_in['fname']." ".$check_in['lname'];?></td>
								<td>
									<?print $check_in_time;?>
									<input type="hidden" name="check_in_id_<?print $cnt;?>" value="<?print $check_in['id'];?>" id="check-in-id-<?print $check_in['id'];?>" />
								</td>
                                
                                <td>
                                    <a href="#" id="check-in-class-link-<?php print $check_in['id'];?>" class="check-in-class-link" data-type="select" data-pk="<?php print $check_in['id'];?>" data-value="<?php print $check_in['class_id'];?>"></a>
                                </td>
								
								<td>
                                    <a href="#" id="contact-note-<?php print $check_in['id'];?>" data-type="textarea" data-pk="<?php print $check_in['contact_id'];?>" class="contact-note"><?php print nl2br($check_in['notes']);?></a>
                                </td>
								
								<td>
									<a href='#' class='del-line-item' data-id='<?print $check_in['id'];?>' id='check-in-delete-<?print $check_in['id'];?>'><i class="icon-trash"></i></a>
								</td>
							</tr><?
						}
						$cnt++;
					}?>
				</tbody>
			</table>

            <!-- <a href="#" id="pencil"><i class="icon-pencil"></i> [edit]</a>
            <div id="class-report" data-pk="1" data-type="wysihtml5" data-toggle="manual" data-original-title="Enter notes" class="editable" tabindex="-1" style="display: block;"></div> -->
			
			<div class="row">
				<!-- <input type="submit" class="button" id="save-check-in" value="Save" /> -->
			</div>
		</form>

<script>
	$(document).ready(function(){
        $('#contacts-search').focus();
        
        // $.fn.editable.defaults.mode = 'popover';
        $.fn.editable.defaults.placement = 'bottom';

        $('#check-in-date-link').editable({
            placement: 'left',
            format: 'yyyy-mm-dd',
            viewformat: 'dd/mm/yyyy',
            datepicker:{weekStart: 1},
            showbuttons: false
        });
        
        init_x_editable();//initialize the dynamic x-editable fields

        $('.footable').footable();

/*        
        $('#class-report').editable({
            mode: 'inline'
        }); 
        $('#pencil').click(function(e) {
            e.stopPropagation();
            e.preventDefault();
            $('#class-report').editable('toggle');
       }); 
*/     

		//prevent the form from submiting when enter/return is pressed when search box is focused
		$('#check_in_form').submit(function(e){e.preventDefault();});

        $('#contacts-search').typeahead({
            minLength: 2,
            source: function (typeahead, process){
                $.ajax({
                    url: "check_in/contacts_search/?callback=options&limit=20&check_date=<?php print $check_date;?>",
                    type: 'get',
                    data: {term: typeahead},
                    dataType: 'json',
                    success: function(json){
                        // create array of contact names to return for the drop down list and a map with the fname and lname as the key with the contact_id as the value
                        contacts = [];
                        check_in_data = [];
                        map = {};
                        $.each(json.options, function (i, option){
                            map[option.fname+' '+option.lname] = option.contact_id;
                            contacts.push(option.fname+' '+option.lname);
                        });

                        return process(contacts);//return name to be displayed as the typeahead results
                    },
                    error: function(){
                        alert("There was an error processing your request.\nPlease try again later.");
                    }
                });
             },
             updater: function(item){
                 contact_id = map[item];
                 
                 if(contact_id != ""){//only process if a name has been entered
                     $.ajax({
                         url: '<?php print base_url();?>check_in/check_in_save',
                         type: 'get',
                         dataType: 'jsonp',
                         data: "contact_id="+contact_id+"&name="+item,
                         complete: function(){},
                         success: function(check_in_data){
                             var check_in_id = check_in_data.check_in_id;
                             if(check_in_id > 0){
                                 var line_item = "<tr id='contact-"+check_in_id+"'>";
                                 line_item += "<td>"+check_in_data.name+"</td>";
                                 line_item += "<td>"+check_in_data.check_in_time+"</td>";
                                 line_item += '<td><a id="check-in-class-link-"'+check_in_id+'" class="check-in-class-link" data-type="select" data-pk="'+check_in_id+'" data-value="'+check_in_data.class_id+'"></a></td>';
                                 line_item += '<td><a href="#" id="contact-note-'+contact_id+'" data-type="textarea" data-pk="'+contact_id+'" class="contact-note">'+check_in_data.notes+'</a></td>';
                                 line_item += "<td><a href='#' class='del-line-item' data-id='"+check_in_id+"' id='check-in-delete-"+check_in_id+"'><i class='icon-trash''></i></a></td></tr>";
                                 $('#check-in tbody').prepend(line_item).hide().fadeIn(300);
                                 $('#contacts-search').val('');
                                 
                                 init_x_editable();//re-initialize the x-editable fields after adding new content to the table

                                 // $.jGrowl("Check In Saved");
                             }else{
                                 alert("There was an error processing your request.\nPlease try again later.");
                             }
                         }
                     });
                 }

                 return item;//return the contact's name
             }
         });

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


			
		<?if($_GET['notification']){?>$.jGrowl('<?print $_GET['notification'];?>');<?}?>

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
            // autotext: 'auto',
            // display: function(value, sourceData) {
            //      var colors = {"": "gray", 1: "green", 2: "blue"},
            //          elem = $.grep(sourceData, function(o){return o.value == value;});
            //      
            //      if(elem.length) {    
            //          $(this).text(elem[0].text).css("color", colors[value]); 
            //      } else {
            //          $(this).empty(); 
            //      }
            // }   
        });
        
        
        jQuery('.contact-note').editable({
            url: '<?php print base_url();?>contacts/note_save'
        });
    }
</script>