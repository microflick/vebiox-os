<?
require("../appLayer.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>HTML5</title>
	<style>
	
	
	#drop {
		width: 500px;
		height: 200px;
		border: 1px solid #CCC;
		background-color: #FFC;
		-moz-border-radius: 15px;
border-radius: 15px;
		margin-right: auto;
		margin-left: auto;
	}
	#status {
		width: 400px;
		height: 25px;
		font-size: 10px;
		color: #fff;
		padding: 5px;
	}
	#list {
		width: 210px;
		font-size: 10px;
		float: left;
		margin-left: 10px;
	}
	.addedIMG {
		width: 100px;
		height: 100px;
	}
	
	#status {
	color: #666;
	font-size: 200%;
	margin-top: 70px;
	text-align: center;	
	}
	</style>
	<script src="html5uploader.js"></script>
</head>

<body onload="new uploader('drop', 'status', 'uploader.php', 'list');">
<br><br>
	<div id="box">
		
		<center><div id="drop"><div id="status">Drop your files here</div></div></center>
		
	</div>
	<div id="list"></div>
</body>
</html>
