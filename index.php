<?
session_start();

if(!isset($_SESSION['uid'])){
	header('Location: login.php');
exit();	
}

define("IN_VEBIOX", true);
// Include kernel files
include("system/kernel.php");

// Check user folder

$user_folder = "users/".$uid."/";
if(!file_exists($user_folder)){
	
	mkdir($user_folder);
	mkdir($user_folder."documents");
	mkdir($user_folder."music");
	mkdir($user_folder."videos");
	mkdir($user_folder."pictures");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

<style type="text/css">
.window_top {
background: url('system/resources/icons/<?=THEME ?>.png') no-repeat;
}

#bar_bottom {
  background: #fbfcfd url('system/resources/icons/<?=THEME ?>.png') no-repeat;	
}
.boxy-content {
background-image: url('system/resources/icons/<?=THEME ?>.png');
}
</style>

<meta name="description" content="JavaScript desktop environment built with jQuery." />
<title><?=OS_NAME ?> - <?=DEVELOPMENT_STATUS ?> <?=VERSION ?></title>

<link rel="stylesheet" href="system/assets/stylesheets/boxy.css" type="text/css" /> 
<link rel="stylesheet" href="system/assets/stylesheets/reset.css" />
<link rel="stylesheet" href="system/assets/stylesheets/desktop.css" />
<!--[if IE 9]>
<link rel="stylesheet" href="system/assets/stylesheets/ie.css" />
<![endif]-->
<?
echo $additional_styles;
?>

<script>
  
    document.write(unescape('%3Cscript src="system/assets/javascripts/jquery.js"%3E%3C/script%3E'));
    document.write(unescape('%3Cscript src="system/assets/javascripts/jquery.ui.js"%3E%3C/script%3E'));
 
</script>
<script>
setInterval("settime()", 1000);
 
function displayDialog(dialog) {


          // Get the link's target.
          var x = dialog;
          var y = $(x).find('a').attr('href');

          // Show the taskbar button.
          if ($(x).is(':hidden')) {
            $(x).remove().appendTo('#dock');
            $(x).show('fast');
          }

          // Bring window to front.
          JQD.util.window_flat();
          $(y).addClass('window_stack').show();
       
	
}

function changeFrame(frameName, frameNewLocation) {

document.getElementById(frameName).src = frameNewLocation;

}
 
function settime () {
  var curtime = new Date();
  var curhour = curtime.getHours();
  var curmin = curtime.getMinutes();
  var cursec = curtime.getSeconds();
  var time = "";
 
  if(curhour == 0) curhour = 12;
  time = (curhour > 12 ? curhour - 12 : curhour) + ":" +
         (curmin < 10 ? "0" : "") + curmin + " " +
        
         (curhour > 12 ? "PM" : "AM");
 
  document.getElementById("date").innerHTML = time;
}
</script>
<script type='text/javascript' src='system/assets/javascripts/jquery.boxy.js'></script> 
<script src="system/assets/javascripts/jquery.desktop.js"></script>

</head>
<body>
<div class="abs" id="wrapper">
  <div class="abs" id="desktop">
  
  <script>
  function createDialog(dialogTitle, text) {
  new Boxy('<p>' + text + '</p>', {title: dialogTitle, draggable: false});
  }
  </script>
  
 
  
  <?
	$sql = mysql_query("SELECT * FROM `datix_applications` WHERE NOT `desktop`='0'");
	$i = 1;

	while($i <= mysql_num_rows($sql) && $r = mysql_fetch_assoc($sql)){
	?>
    <a class="abs icon" style="top: <? 
	$top = $i++;
	if($top == 1){
		echo "20";
	}else{
	echo $top * 85 - 80; 
	}
	?>px; left: 20px;" href="#icon_dock_<?=$r['aid'] ?>">
    
    <img src="<?
	if(file_exists("apps/".$r['folder']."/icon_32.png")){
		echo "apps/".$r['folder']."/icon_32.png";
	}else{
		echo "system/resources/icons/icon_32.png";
	}
	?>" />
      <?=$r['title'] ?>
    </a>
    
    <? } ?>
    
    <?
	$sql = mysql_query("SELECT * FROM `datix_applications`");
	while($r = mysql_fetch_assoc($sql)){
	?>
    
    
    
    <div id="window_<?=$r['aid'] ?>" class="abs window">
      <div class="abs window_inner">
        <div class="window_top">
          <span class="float_left">
            
            <span class="appName"><?=$r['title'] ?></span></span>
            <?
		  if(is_file("apps/".$r['folder']."/toolbar.php")){
			  
			
			  $appName = $r['folder'];
			   $appLocation = "apps/".$r['folder']."/";
			   $l = $appLocation;
          include("apps/".$r['folder']."/toolbar.php");
		  
		  }
		  ?>
         
          
          <script type="text/javascript">
		  
		  $(".<?=$r['folder'] ?>").click(function () {
    $(".<?=$r['folder'] ?>").css("font-weight","");
	$(this).css("font-weight","bold");
  });
		  
		  </script>
          
          <span class="float_right buttonContainer">
            <a href="#" class="window_min"></a>
            <a href="#" class="window_resize"></a>
            <a href="#icon_dock_<?=$r['aid'] ?>" class="window_close"></a>
          </span>
        </div>
        
                
        <div class="abs window_content" style="margin: 0px; padding: 0px;">
          <?
		  if(is_file("apps/".$r['folder']."/index.php")){
			  
			  $appLocation = "apps/".$r['folder']."/";
			  
          include("apps/".$r['folder']."/index.php");
		  
		  }else{
			include("404.php");  
		  }
		  ?>
        </div>
        <div class="abs window_bottom">
          
        </div>
      </div>
      <span class="abs ui-resizable-handle ui-resizable-se"></span>
    </div>
    <? } ?>
    
  </div>
    <div class="abs" id="bar_bottom">
     <a href="#icon_dock_5" class="dashboard float_left">
      <img src="system/resources/icons/dashboard.png" />
    </a>
    
    <a href="#" id="show_desktop" class="float_right" style="margin: 0px; padding: 0px; height: 30px; width:20px; margin-right: -10px;" title="">
      <span style="height:30px; width:20px">&nbsp;</span>
    </a>
    <span id="date"></span>

   
    <ul id="dock">
    
    <?
	$sql = mysql_query("SELECT * FROM `datix_applications`");
	while($r = mysql_fetch_assoc($sql)){
	?>
      <li id="icon_dock_<?=$r['aid'] ?>">
        <a href="#window_<?=$r['aid'] ?>">
          
          <?=$r['title'] ?>
        </a>
      </li>
      <? } ?>
      
    </ul>
     </div>
</div>



</body>
</html>