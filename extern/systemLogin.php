<?
session_start();
define("IN_VEBIOX", true);
define("HIDE_JQUERY", true);
// Include kernel files

include("../system/kernel.php");

//get the posted values
$user_name=htmlspecialchars($_POST['user_name'],ENT_QUOTES);
$pass=md5($_POST['password']); 

//now validating the username and password
$sql="SELECT * FROM datix_users WHERE username='".$user_name."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result); 

//if username exists
if(mysql_num_rows($result)>0)
{
        //compare the password
        if(strcmp($row['password'],$pass)==0)
        {
                echo "yes";
                //now set the session from here if needed
                $_SESSION['username'] = $user_name;
				$_SESSION['uid'] = $row['uid'];
        }
        else
                echo "no";
}
else
        echo "no"; //Invalid Login
?>