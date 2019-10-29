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

    <?php 
    $unit = Members::getAllUnits($db) ;
    
    ?>
    
</script>
 <form method="post" action=""  name="personal" >
 <table cellspacing="0" class="color">
 	<tr>
 		<th><span class="star">*</span>Lastname</th>
 		<td><input type="text" name="lastname" class="form-control" value="<?php echo @$lastname; ?>" /></td>
	</tr>
	<tr>
		<th><span class="star">*</span>Firstname</th>
		<td><input type="text" name="firstname" class="form-control" value="<?php echo @$firstname ;?>" /></td>
	</tr>
	<tr>
		<th>Other Name</th>
		<td><input type="text" name="middlename" class="form-control"value="<?php echo @$middlename; ?>" /></td>
	</tr>
		<tr>
		<th><span class="star">*</span>Sex</th>
		<td><select name="sex" class="form-control">
				<option selected><?php echo @$sex ?></option>
				<option>Male</option>
				<option>Female</option>
			</select>
		</td>
	</tr>
	<tr>
		<th><span class="star">*</span>Date of Birth</th>
		<td><em>(yyyy-mm-dd) </em><br />
			<input name="dob" value="<?php print @$dob;?>" id="datepicker" class="form-control"/>
			
		</td>
	</tr>
	
	<tr>
		<th><span class="star">*</span>Units</th>
		<td><select name="ms" class="form-control">
             <?php for ($i = 0 ;$i < count($units) ;$i++)
               print'<option>'.$unit[i].'</option>';
				?>
				
			</select>
		</td>
	</tr>
	
			<td colspan="2"><input type="submit" class="form-control" value="Submit" onClick="return confirmUpdate()" /></td>
	</tr>
</table>

</form>
<em>Note that all the fields mark <span class="star">*</span> are required</em>