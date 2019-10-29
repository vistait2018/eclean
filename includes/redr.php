<?php
if (empty($_SESSION['adminEdit'])  or ($_SESSION['adminEdit'] == false)){
	 $redr=	'http:'.__SITEURL__.'index.php';
	  header('location:'.$redr);
}
?>
	