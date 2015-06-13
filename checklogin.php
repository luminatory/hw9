<?php
ob_start();
require_once 'db.php';
// Connect to server and select databse.
mysql_connect(SERVERNAME, USERNAME, PASSWORD)or die("cannot connect"); 
mysql_select_db(DBNAME)or die("cannot select DB");

// Define $myusername and $mypassword 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword']; 

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM users WHERE login = '$myusername' and password= '$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
//session_register("myusername");
//session_register("mypassword"); 
//header("location:login_success.php");
	  session_start();
    $_SESSION['myusername'] = $myusername;
    $_SESSION['mypassword'] = $mypassword;
    $cookie_name = $myusername;
    $cookie_value = "Cookie set!";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    header("location: index.php");
}
else {
echo "Wrong Username or Password";
echo "<h2> <a href='index.php?'>Return to login page</a> </h2>";
echo "<h2> <a href='login.php?'>Register</a> </h2>";
}
ob_end_flush();

