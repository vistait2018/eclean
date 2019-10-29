
<form method="POST" action="" enctype="multipart/form-data">
 
<table >

    <tbody>
        <tr>
            <td>Title:</td>
            <td><input type="text" name="title" value="<?php print@$media->title?>" /></td>
        </tr>
        <tr>
            <td>Author:</td>
            <td><input type="text" name="author" value="<?php print@$media->author?>" /></td>
        </tr>
        <tr>
            <td>Type:</td>
            <td><select name="type">
                    <option><?php print@$media->typeselected ?></option>
                    <option>Video</option>
                    <option>Images</option>
                    <option>Sound</option>
            </select></td>
        </tr>
        <tr>
            <td>File:</td>
            <td><input type="file" name="file" id="file" value="" /></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Upload" /></td>
        </tr>
    </tbody>
</table>
</form>

