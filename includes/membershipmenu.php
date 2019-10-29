
<hr  style="width:800px; "/>

<?php if ($_SESSION['adminEdit'] = true)print'<a href="'. __SITEURL__ .'admin/index.php" class ="btn btn-info"> Members</a>'; ?>
<?php if ($_SESSION['adminEdit'] = true)print'<a href="'. __SITEURL__ .'admin/membernew.php"  class ="btn btn-info">New Member</a>'; ?>
<?php  if (isset($_GET['mid']) and $_SESSION['adminEdit'] = true)print'<a href="'. __SITEURL__ .'admin/memberview.php?mid='.$mid.'"  class ="btn btn-info">View Member</a>'; ?>
<?php if (isset($_GET['mid']) and $_SESSION['adminEdit'] = true) print'<a href="'. __SITEURL__ .'admin/memberedit.php?mid='.$mid.'"  class ="btn btn-info">Edit Member</button></a>'; ?>
<?php if ($_SESSION['adminEdit'] = true) print'<a href="'. __SITEURL__ .'admin/birthdaymail.php"  class ="btn btn-info">Birthdays</a>'; ?>
<?php if ($_SESSION['adminEdit'] = true)print'<a href="'. __SITEURL__ .'admin/weddinganniversarymail.php" class ="btn btn-info">Wedding Anniverary</a>';
  ?>
<?php if ($_SESSION['adminEdit'] = true)print'<a href="'. __SITEURL__ .'admin/uploadbanner.php" class ="btn btn-info">Banner Upload</a>';
  ?>

