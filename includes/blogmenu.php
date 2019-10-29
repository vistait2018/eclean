<?php if ( @$_SESSION['adminEdit'] == true) 
	print' <a href="'. __SITEURI__ .'blog/new.php" class="btn btn-info">Create Blog </a> '; ?>
<?php if (@$_GET['aid'] and $_SESSION['adminEdit']= true)  
	print' <a href="'. __SITEURI__ .'blog/edit.php?aid='.$_GET['aid'].'" class ="btn btn-info">Edit Blog</a>'; ?>

