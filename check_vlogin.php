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

    $sqlGetLogin = "SELECT * FROM VARDARE WHERE v_email='$username' and v_pass='$password'";

    if ($mysqli = connect_db()) {
        $result = $mysqli->query($sqlGetLogin);
        $count= mysqli_num_rows($result);
        print_r($mysqli->error);
    }

    if($count==1){
        $_SESSION['v_email'] = $_POST['username'];
        header('Location: index.php');
        exit;
    }

    else {
        header('Location: v_login.php');
        exit;
    }
?>
