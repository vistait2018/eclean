

<form method="POST" action="">

<fieldset>

                	<legend >New Album</legend>
                    <label for="title">Name</label>
                    <div class="input-control text" data-role="input-control">
						<input id="name" type="text" name="name" class="form-control" placeholder="Enter The Name of Album" data-transform="input-control"
						value="<?php echo @$album->name; ?>">
                       
                    </div>

                    	<input type="submit" value="Submit"
                        	class="form-control"></br>
                </br
				</fieldset>
				
               
				<input id="aid" type="hidden" name="aid" value="<?php echo @$_GET['aid'];?>" >






</form>