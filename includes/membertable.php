  <script>
    function confirmUpdate(){
        var name = window.document.personal.lastname.value;
   var question =confirm("Are you certain about these details?");
    if(question){
     return true ;  
    }else{
        return false;
    }
 }
    
</script>
 <form method="post" action=""  name="personal" >
 <table cellspacing="0" class="color">
 	<tr>
 		<th><span class="star">*</span>Lastname</th>
 		<td><input type="text" name="lastname" value="<?php echo @$lastname; ?>" /></td>
	</tr>
	<tr>
		<th><span class="star">*</span>Firstname</th>
		<td><input type="text" name="firstname" value="<?php echo @$firstname ;?>" /></td>
	</tr>
	<tr>
		<th>Other Name</th>
		<td><input type="text" name="middlename" value="<?php echo @$middlename; ?>" /></td>
	</tr>
	<tr>
		<th><span class="star">*</span>Address</th>
		<td><textarea name="address" rows="4" cols="20"><?php echo @$address;?></textarea></td>
	</tr>
	
	<tr>
		<th><span class="star">*</span>Sex</th>
		<td><select name="sex">
				<option selected><?php echo @$sex ?></option>
				<option>Male</option>
				<option>Female</option>
			</select>
		</td>
	</tr>
	<tr>

		<th><span class="star">*</span>Date of Birth</th>
		<td><em>(yyyy-mm-dd) </em><br />
			<input name="dob" value="<?php print @$dob;?>" id="datepicker"/>
			
		</td>
	</tr>
	<tr>
		<th><span class="star">*</span>Marital Status</th>
		<td><select name="ms">
				<option selected><?php echo @$ms ?></option>
				<option>Married</option>
				<option>Single</option>
				<option>Single Parent</option>
			</select>
		</td>
	</tr>
	
	
	<tr>
		<th><span class="star">*</span>Wedding Anniversary</th>
		<td><em>(yyyy-mm-dd) </em><br />
			<input name="wa" value="<?php print @$wa;?>" id="datepicker"/>
			
		</td>
	</tr>
	<tr>
		<th>Telephone Number </th>
		<td><input type="text" name="phone" value="<?php echo @$phone ?>" /></td>
	</tr>
	
	<tr>
		<th>Email Address</th>
		<td><input type="text" name="email" value="<?php echo @$email ;?>" /></td>
	</tr>
	
	<tr>
		<th>facebook Id</th>
		<td><input type="text" name="fid" value="<?php echo @$fid ;?>" /></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="Submit" onClick="return confirmUpdate()" /></td>
	</tr>
</table>
<?php
             //$secureForm->htmlInput();
 ?>
</form>
<em>Note that all the fields mark <span class="star">*</span> are required</em>