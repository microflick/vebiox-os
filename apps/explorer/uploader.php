<?
require("../appLayer.php");
?>

<?php
// Destination folder for downloaded files



$documents = array("doc", "txt", "pdf", "docx", "rtf");
$images = array("png", "jpeg", "jpg", "gif");
$music = array("mp3");
$video = array("mp4");

$path_parts = pathinfo($_FILES['upload']['name']);
$fileExt = $path_parts['extension'];

if (in_array($fileExt, $documents)) {
	$upload_folder = '../../users/'.$uid.'/documents';
}elseif(in_array($fileExt, $images)) {
		$upload_folder = '../../users/'.$uid.'/pictures';

}elseif(in_array($fileExt, $music)) {
		$upload_folder = '../../users/'.$uid.'/music';

}elseif(in_array($fileExt, $video)) {
		$upload_folder = '../../users/'.$uid.'/videos';

}else{
// No valid extension	
	exit();
}

// If the browser supports sendAsBinary () can use the array $ _FILES
if(count($_FILES)>0) { 
	if( move_uploaded_file( $_FILES['upload']['tmp_name'] , $upload_folder.'/'.$_FILES['upload']['name'] ) ) {
	echo 'done';
	}
	exit();
} else if(isset($_GET['up'])) {
	// If the browser does not support sendAsBinary ()
	if(isset($_GET['base64'])) {
		$content = base64_decode(file_get_contents('php://input'));
	} else {
		$content = file_get_contents('php://input');
	}

	$headers = getallheaders();
	$headers = array_change_key_case($headers, CASE_UPPER);
	
	if(file_put_contents($upload_folder.'/'.$headers['UP-FILENAME'], $content)) {
		echo 'done';
	}
	exit();
}
?>