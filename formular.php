<?php
    session_start();
    if (!isset($_SESSION['p_number'])) {
        header('Location: login.php');
    }
    include('db_connection.php');
    require('functions.php');
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
		<div class="header-bg">
			<header>
			</header>
		</div>
       <div class="main">
		   <h1><a href="formular.php"><img class="logo" src="img/portalen.png"></a></h1>
          <div class="med-width" id="formular">
             <h2>Välkommen!</h2>
             
                <?php
                    echo '<p>Vänligen fyll i nedanstående skattningar. Klicka på starta för att sätta igång. </p>';
                    getForm($_SESSION['p_number']);
                ?>
             
          </div>
       </div>
    </body>
    <footer>
       <p>Skapad av oss</p>
       <a href="logout.php">Logga ut</a>
    </footer>
</html>
