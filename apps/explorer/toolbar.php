<ul id="toolbar">
<li><a href="<?=$l ?>fileBrowser.php?l=documents" target="myFileBrowser" class="<?=$appName ?>" style="font-weight: bold">documents</a></li>
<li><a href="<?=$l ?>fileBrowser.php?l=pictures" target="myFileBrowser" class="<?=$appName ?>">pictures</a></li>
<li><a href="<?=$l ?>fileBrowser.php?l=videos" target="myFileBrowser" class="<?=$appName ?>">videos</a></li>
<li><a href="<?=$l ?>fileBrowser.php?l=music" target="myFileBrowser" class="<?=$appName ?>">music</a></li>
<li><a href="#" onClick="parent.createDialog('Upload files', '<iframe src=\'<?=$l ?>fileUpload.php\' height=\'300px\' width=\'600px\'></iframe>'); " style="float: right;">upload</a></li>
</ul>

