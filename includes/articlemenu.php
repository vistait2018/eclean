<?php if ( @$_SESSION['adminEdit'] == true) 
	print' <a href="'. __SITEURI__ .'article/new.php" class="btn btn-info">Create Article </a> '; ?>
<?php if (@$_GET['aid'] and $_SESSION['adminEdit']= true)  
	print' <a href="'. __SITEURI__ .'article/edit.php?aid='.$_GET['aid'].'" class ="btn btn-info">Edit Article</a>'; ?>

