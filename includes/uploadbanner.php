
<form method="POST" action="" enctype="multipart/form-data">
 
<table border="0" width="50%" >

    <tbody>
        <tr>
            <td>Title:</td>
            <td><input class="form-control" type="text" name="title" value="<?php print@$media->title?>" /></td>
        </tr>
        <tr>
            <td>Author:</td>
            <td><input  class="form-control" type="text" name="author" value="<?php print@$media->author?>" /></td>
        </tr>
        <tr>
            <td>Type:</td>
            <td><select name="type" class="form-control">
                    <option><?php print@$media->typeselected ?></option>
                    <option>Banner</option>
                    <option>Images</option>
                    <option>Sound</option>
                    <option>Video</option>
            </select></td>
        </tr>
        <tr>
            <td>File:</td>
            <td><input type="file" name="file" id="file" value="" class="form-control"/></td>
        </tr>
                 <tr>
            <td></td>
                     
            <td><br><input type="submit" value="Upload" class="form-control btn btn-danger" /></td>
        </tr>
        
    </tbody>
</table>
              
</form>

