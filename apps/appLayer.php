<?
session_start();
define("IN_VEBIOX", true);
require("../../system/kernel.php");

if(!isset($_SESSION['uid'])){
	echo "<span style='font: 12px/1 \"Segoe UI\", \"Lucida Grande\";'><b>Error - No access</b></span>";
exit();	
}

?>