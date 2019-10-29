 
    <script>
   $("#datepicker").datepicker();

 
   function confirmUpdate(t){

	 var lastname = t.lastname.value;
       var firstname = t.firstname.value;
  		return confirm("Are you certain about these details of "+lastname +" "+firstname);
   
}
   </script>
 
 
 <form method="post" action ="" name="member" onsubmit="return confirmUpdate(this)">
 	<fieldset>
 		<label><span class="star">*</span>Last Name</label>
 		<div class="input-control text" data-role="input-control">
	 		<input class="form-control" type="text" name="lastname" placeholder="Enter Last Name" value="<?php echo @$lastname; ?>">
	 		
 		</div>
 		<label><span class="star">*</span>First Name</label>
 		<div class="input-control text" data-role="input-control">
 			<input class="form-control" type="text" name="firstname" placeholder="Enter First Name" value="<?php echo @$firstname; ?>" >
 			
 		</div>
 		<label>Middle Name</label>
 		<div class="input-control text" data-role="input-control">
 			<input type="text" class="form-control" name="middlename" placeholder="Enter Middle Name" value="<?php echo @$middlename; ?>" >
 			
		</div>
		<label><span class="star">*</span>Address</label>
			<div class="input-control textarea" data-role="input-control" >
				<textarea name="address"placeholder="Enter  Address" class="form-control"><?php echo @$address; ?></textarea>
			</div>
		<label><span class="star">*</span>Sex</label>
			<div class="input-control select">
				<select name="sex" class="form-control">
					<option selected><?php echo @$sex ?></option>
					<option>Male</option>
					<option>Female</option>
				</select>
			</div>
		<label><span class="star">*</span>Date of Birth<em>(yyyy-mm-dd) </em></label>
		<div class="input-control text form-control" data-role="datepicker" data-effect="fade" data-format ="yyyy-mm-dd" class="form-control">
			<input type="text" name="dob"  class="input-control ">
            <button class="btn-clear" tabindex="-1"></button>
		</div>
		<label><span class="star">*</span>Marital Status</label>
		<div class="input-control">
			<select name="ms" class="input-control text form-control">
				<option selected><?php echo @$ms ?></option>
				<option>Single</option>
				<option>Married</option>
				<option>Single Parent</option>
			</select>
		</div>
		<label><span class="star">*</span>	Wedding Anniversary<em>(yyyy-mm-dd) </em></label>
			<div class="input-control text form-control" data-role="datepicker" data-effect="fade" data-format ="yyyy-mm-dd">
				<input type="text" name="wa">
			</div>
		<label><span class="star">*</span>Telephone Number</label>
		<div class="input-control tel" data-role="input-control">
			<input class="form-control" type="tel" name="phone" placeholder="Enter Telephone No" value="<?php echo @$phone; ?>">
			
		</div>
		<label>Email Address</label>
		<div class="input-control text" data-role="input-control">
			<input type="text" class="form-control" name="email" placeholder="Enter Email Address" value="<?php echo @$email; ?>">
        	
        </div>
        <label>Facebook Id</label>
        <div class="input-control text" data-role="input-control">
        	<input type="text" class="form-control" name="fid" placeholder="Enter facebook" value="<?php echo @$fid; ?>">
        	
       	</div>
<?php $secureForm->htmlInput(); ?>
         <br>
		<input type="submit" value="Submit" class="form-control">
	</fieldset>
</form>
<em>Note that all the fields mark <span class="star">*</span> are required</em>