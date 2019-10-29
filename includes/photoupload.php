<form method="POST" action="" enctype="multipart/form-data" 
style="margin:10px;display:table;border: thin solid #333; padding: 10px ">
   <fieldset style="padding:10px">
   <legend>Upload Photo</legend>
   <table>
<?php for($i = 0; $i<5; $i++){?>


<tr>
<td><input type="file" name="photo[]" value="" placeholder="Select Your Photo" /></td>
</tr>
<tr><td><textarea name="caption[]" placeholder="Caption" style="width:100%"></textarea></td>
</tr>
<?php }?>
</table>
<button>Upload</button>

  </fieldset>
</form>