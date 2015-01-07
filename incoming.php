<?php
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
       <div class="main">
          <div class="container">
             <h2>Heading!</h2>
             <p>
                <?php
                   if (isset($_POST['skicka'])) {
                      session_start();
                      $tfk = $_SESSION['this_form_key'];
                      echo '<b>f_key: ' . $tfk . '</b><br />';

                      for ($j = ($tfk+1); $j < 31; $j++) {
                         echo $_SESSION['q_key'][$j];
                         $answer = $_POST[$j];
                         echo 'alt_key =' . $answer;
                         echo '<br />';

                      }

                   }
                ?>
             </p>
          </div>
       </div>
    </body>
    <footer>
       <p>Skapad av oss</p>
    </footer>
</html>
