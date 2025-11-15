<?php
	define("SITE_SUBFOLDER", "/sist");
	define("SITE_ROOT", $_SERVER["DOCUMENT_ROOT"].SITE_SUBFOLDER);
	define("SITE_URL", "http://".$_SERVER["SERVER_NAME"].SITE_SUBFOLDER);

	define("_DB_HOST", "localhost");
	define("_DB_USER", "root");
	define("_DB_PASS", "");
	define("_DB_NAME", "sist");
	
	include(SITE_ROOT."/mysql.php");
?>