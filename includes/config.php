<?php
$config = array(
		'order' => array(
				'header-start','header-close','nav', 'content-start','content-end','footer'
		)
);

PageServer::$CONTENTBREAK 	= 'content-start'; //content
PageServer::$TITLEBREAK		= 'header-start';  //header
PageServer::$SITEURL		= __SITEPATH__;
PageServer::$SITENAME		= __SITENAME__;