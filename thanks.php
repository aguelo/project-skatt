<?php
    session_start();
    if (!isset($_SESSION['p_number'])) {
        header('Location: login.php');
    }
    $pnumber = $_SESSION['p_number'];
    include('db_connection.php');

    $sqlCheckName = "SELECT p_firstname FROM PATIENT WHERE (p_number) = '$pnumber'";
    // SQL Error message
    if ($mysqli = connect_db()) {
        $result = $mysqli->query($sqlCheckName);
        print_r($mysqli->error);
        $row = mysqli_fetch_assoc($result);
        }
?>
<!DOCTYPE html PUBLIC "-//w3c//DTD XHTMLm 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmnlns="http://www.w3.org/1999/xhtml" xml:lang="sv" lang="sv">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Webbskattningsportalen</title>
</head>
<body>
    <div class="header-bg">
        <header>
        </header>
    </div>
    <div id="main">
        <h1><a href="login.php"><img class="logo" src="img/portalen.png"></a></h1>
        <div class="small-width blue-bg" id="login">
            <h2>Tack <?php echo $row['p_firstname']; ?>!</h2>
            <p>Du kan nu stänga fönstret</p>
        </div>
    </div>
</body>
<?php session_destroy(); ?>
</html>
