<?
require("../appLayer.php");
?>

<style>
td {
line-height: 20px;
}
</style>
<div style="overflow: auto; height: 100%; width: 100%;">
<?
if($_GET['l'] == "documents"){
$folder = "documents";
}elseif($_GET['l'] == "pictures"){
$folder = "pictures";
}elseif($_GET['l'] == "videos"){
$folder = "videos";
}elseif($_GET['l'] == "music"){
$folder = "music";
}else{
	?>Unknown folder<?
	exit();
}


if($folder !== "pictures"){
?>

<table width="100%" border="0">
<tr><td width="60%"><strong>Name</strong></td><td width="25%"><strong>Size</strong></td><td width="15%"><strong>Type</strong></td></tr>
<?
foreach (glob("../../users/".$uid."/".$folder."/*") as $filename) {
	?>
<tr><td><?=basename($filename) ?></td><td>2340 Bytes</td><td>PNG File</td></tr>
<? } ?>


</table>



<? }else{
	
	?>
    
    
    
    
    <div style="-moz-column-width: 200px; -webkit-column-width: 200px; -moz-column-gap: 10px; -webkit-column-gap: 10px;">
    
    <?
foreach (glob("../../users/".$uid."/".$folder."/*") as $filename) {
	?>
<a href="#" onclick="parent.changeFrame('PhotoGallery', 'apps/photogallery/myMedia.php?src=<?=base64_encode($filename) ?>'); parent.displayDialog('#icon_dock_2');"><img src="imageResize.php?src=<?=base64_encode($filename) ?>" style="margin-bottom: 20px;" border="0px" /></a>
<? } ?>

    
    </div>
    <?
}
?></div>