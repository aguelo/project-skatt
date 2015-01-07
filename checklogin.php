<?php
session_start();
include('db_connection.php');

$username=$_POST['username'];
$password=$_POST['password'];

// MySQL injection protection
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);

$sqlGetLogin = "SELECT * FROM TEMPLOGIN WHERE p_number='$username' and p_pass='$password'";

if ($mysqli = connect_db()) {
    $result = $mysqli->query($sqlGetLogin);
    $count= mysqli_num_rows($result);
    print_r($mysqli->error);
}

if($count==1){
    $_SESSION['p_number'] = $_POST['username'];
    header('Location: login_success.php');
    exit;
}

else {
    header('Location: login.php');
    exit;
}

?>
