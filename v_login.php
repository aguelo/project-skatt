<?php
    include('db_connection.php');
    require('functions.php');
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
        <div style="background:#4FBF54">
            <header>
            </header>
        </div>
        <div id="main">
            <h1><a href="index.php"><img class="logo" src="img/portalen.png"></a></h1>
            <div class="small-width blue-bg" id="login" style="background:#4FBF54">
                <h2>Logga in som vårdare</h2>
                <form name="form1" method="post" action="check_vlogin.php">
                    <label>Email :</label>
                    <input id="name" name="username" placeholder="Email" type="text">
                    <label>Password :</label>
                    <input id="password" name="password" placeholder="**********" type="password">
                    <input name="submit" type="submit" value="Login">
                    <span><?php echo $error; ?></span>
                </form>
            </div>
        </div>
    </body>
    <footer>
        <small><p>Skapad av Magnus Ulenius, Axel Jonsson, <br /> Johannes Swenson, Pietro Mattei och Johan Bergström. <br /><br />
            &copy; 2015</p></small>
            <a href="add_vardare.php">Lägg till vårdare</a>
            <br />
            <a href="login.php">Patient inloggning</a>
        </footer>
</html>
