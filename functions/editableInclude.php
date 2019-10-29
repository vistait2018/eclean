<?php
function editableInclude($file,$id,$editable=false, $toolbar=true) {
	$file = __SITEPATH__.'contents/'.$file;
	$isFile = is_file($file);
	//var_dump($_POST);
	if($editable){
		
		if(isset($_POST['Editable-'.$id])){
			$fh  = fopen($file,'w+');
			$content = $_POST['Editable-'.$id];
			if($fh and fwrite($fh, $content)){
				//print '<div class="fg-white bg-green">Content Edited successfully</div>';
			}
			fclose($fh);
		}
	}
	
	if(@$_POST['Editable'] == $id){
	?>
	<form method="post">
	<div class="input-control textarea">
	<textarea class="editors" name="<?php print 'Editable-'.$id ?>"><?php if($isFile)print file_get_contents($file);?></textarea><br />
	
	</div>
	<button type="submit" class="button <?php if(defined("__THEME__BAR__COLOR__"))print __THEME__BAR__COLOR__?>">Submit</button>
	</form>
	<?php
	if($toolbar)
		@(include 'includes/editor_script.php');
	}else{
		if($isFile) {
			//include $file;
			$content = file_get_contents($file);
			$content =  preg_replace_callback(
				'/\[\[.*?\]\]/', 
				function ($matches) {
					$str = str_replace("[[", '', $matches[0]);
					$str = str_replace("]]", '', $str);
					if(defined($str)){
						return eval("return $str ;");
					}elseif(isset($$str)){
						return eval("return $$str ;");
					}
				}, 
				$content);
			print $content;
		}
		if($editable){
			?>
			<br><form method="post"><button name="Editable" value="<?php print $id ?>" 
			class="button <?php if(defined("__THEME__BAR__COLOR__"))print __THEME__BAR__COLOR__?>">Edit
			</button></form>
			<?php 
		}
	}
}

function minInclude($file,$size = 100){
	$path = __SITEPATH__."contents/".$file;
	if(is_file($path)){
		$str = file_get_contents($path);
		$str = strip_tags($str);
		$str = substr($str, 0, $size);
		print $str;
	}else print 'none';
}