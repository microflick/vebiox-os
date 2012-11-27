<?
include("system/kernel.php");


if(isset($_POST['user'])){
	  
	  $password = mysql_query("SELECT `password` FROM `datix_users` WHERE `username`='".$_POST['user']."'");
		if(mysql_num_rows($password) > 0){
		  $password = mysql_result($password, 0);
		  // Check if passwords are identical
		  	if($password == md5($_POST['password'])){
				$getUID = mysql_query("SELECT `uid` FROM `datix_users` WHERE `username`='".$_POST['user']."' AND `password`='".md5($_POST['password'])."'");
				$getUID = mysql_result($getUID, 0);
				$_SESSION['uid'] = $getUID;
				$_SESSION['username'] = $_POST['user'];
				header("Location: index.php");
			}else{
				$error = "Oops, wrong credentials";
			}
		}else{
			$error = "Sorry, user doesn't exist";	
		}
  }
  
?>
<html>
<head>
<style>

body, td {
  background-color: #333;
  font-family: 'Segoe UI', sans-serif;
  font-size: 120%;
  color: white;
}

td {
width: 300px;	
}

input, select {
	background-color: #333;
	color: white;
  font-family: 'Segoe UI', sans-serif;
  font-size: 100%;
padding: 5px;
	border: 1px solid white;	
	outline: none;
	width: 300px;
}

#login_container {

  margin-top: 150px;
  color: white;
  margin-left: auto;
  margin-right: auto;
}

#submit {
border: 0px;
float: right;	
width: 45px;
margin-right: -15px;
}

#error {
padding-top: 150px;
height: 50px;
width: 250px;
margin-left: auto;
margin-right: auto;
color: #CCC
}
</style>

<title><?=OS_NAME ?> - <?=DEVELOPMENT_STATUS ?> <?=VERSION ?></title>
</head>
<body>

  <form name="login" method="post" action="login.php">
  <div id="error"><p>
  <?
  	if(isset($error)){
		?>
        	
                	<?=$error ?>
                
        <?
	}
  ?>
  </p></div>
  <table id="login_container">
  
    <tr>
      <td width="300px">
        Gebruikersnaam:
      </td>
      <td width="300px">
        <input type="text" name="user" autocomplete="off" />
      </td>
    </tr>
      <tr>
      <td>
          Wachtwoord:
      </td>
      <td>
          <input type="password" name="password" />
      </td>
    </tr>
    <tr>
      <td>
      </td>
      <td>
      <input type="image" name="submit" id="submit" value="" src="system/resources/icons/check.png" />
      </td>
    </tr>
  </table>
  </form>

</body>
</html>
<?



?>