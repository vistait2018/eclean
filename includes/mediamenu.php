<hr  style="width:800px; "/>
<?php if (!empty($_GET['mid']) and $_SESSION['admin'] ="true")  print'<a href="'.__SITEURL__.'media/medianew.php" class="btn btn-info"> Media Upload</a>'; ?>
<?php if (!empty($_GET['mid']) and $_SESSION['admin'] ="true")  print'<a href="'.__SITEURL__.'media/mediaaudiolist.php" class="btn btn-info">Audio List</a>'; ?>
<?php if (!empty($_GET['mid']) and $_SESSION['admin'] ="true")  print'<a href="'.__SITEURL__.'media/mediavideolist.php" class="btn btn-info">Video List</a>'; ?>
	<?php if (!empty($_GET['mid']) and $_SESSION['admin'] ="true")  print'<a href="'.__SITEURL__.'media/mediaedit.php?mid='.$mid.'" class="btn btn-info">Edit Media</a>'; ?>
