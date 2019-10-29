<script>
     function checkunit(){
     var unit = document.posttest.unitname.value ;
     
       if(!unit) {
           alert('Enter Unit Name!');
           return false;
           }
           
   }
    </script>
   
    <?php  If(isset($_GET['uid'])){
    	//print $_GET['uid'];
    	
    	$unitname = Members::gettUnitName($_GET['uid'],$db);
    	//var_dump($unitname);
    } 
    ?>
    
    
    
   

<form method="POST" action="" name="posttest" onSubmit="checkdepartment();">
    <table  class="color" cellpadding="5px" cellspacing="0" >
        <caption>Edit Unit Name</caption>
        <tbody>
            <tr>
                <td>Unit<br>
                    <input type="text" name="unitname" class="form-control" value="<?php  print @$unitname[0]['unitname'];?>
" /></td>
                           </tr>
            <tr>
                                 
                <td><input type="submit" value="Submit"class="form-control"  onClick="return checkunit(); "/></td>
            </tr>
             
    </table>
<input type="hidden" name="uid" value="<?php print @$_GET['uid'];?>" />
</form>
