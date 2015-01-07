<?php
session_start();

if (!isset($_SESSION['p_number'])) {
    header('Location: login.php');
}
?>

<!DOCTYPE html PUBLIC "-//w3c//DTD XHTMLm 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmnlns="http://www.w3.org/1999/xhtml" xml:lang="sv" lang="sv">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Webbskattningsportalen</title>
</head>
<body>
    <p><?php echo "Bögars, " . $_SESSION['p_number']; ?> <br/>
    Den här sidan byter vi mot formulärdelen. Alltså header redirect i checklogin.php<br/>
    p_number sparas som en sessionvariabel</p>
    <a href="logout.php">Logga ut</a>
</body>
</html>
