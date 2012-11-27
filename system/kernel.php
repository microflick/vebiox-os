<?
// Connect al connected files to database

define("ROOT_URL", "http://www.example.org/", true);

$link = mysql_connect('localhost', 'database_user', 'database_password');
if (!$link) {
    die('Not connected : ' . mysql_error());
}

// make foo the current db
$db_selected = mysql_select_db('database_name', $link);
if (!$db_selected) {
    die ('Can\'t use foo : ' . mysql_error());
}
?><?

if(!defined('IN_VEBIOX')){
echo "<span style='font: 12px/1 \"Segoe UI\", \"Lucida Grande\";'><b>Error - Unregistered application</b></span>";
exit();	
}


$uid = $_SESSION['uid'];
$username = $_SESSION['username'];

define('OS_NAME', 'Vebiox');
define('DEVELOPMENT_STATUS', 'Alpha');
define('VERSION', '0.5');
define('THEME', 'red');

$additional_styles = "<link type=\"text/css\" href=\"".ROOT_URL."system/assets/stylesheets/smoothness/jquery-ui-1.8.11.custom.css\" rel=\"Stylesheet\" />";






function getApplicationFrame($url, $targetName)
{
	echo '<iframe src="'.$url.'" name="'.$targetName.'" id="'.$targetName.'" width="100%" height="100%" style="width: 100%; height: 100%; margin: 0px; padding: 0px;" scrolling="no" frameborder="0"></iframe>';
}

if(!defined('HIDE_JQUERY')){
?>

<script> 
  
    document.write(unescape('%3Cscript src="<?=ROOT_URL ?>system/assets/javascripts/jquery.js"%3E%3C/script%3E'));
    document.write(unescape('%3Cscript src="<?=ROOT_URL ?>system/assets/javascripts/jquery.ui.js"%3E%3C/script%3E'));
 
</script> 
<? } ?>