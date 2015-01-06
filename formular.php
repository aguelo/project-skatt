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
            session_start();
            $_SESSION['alt_string'] = $altStrings;
               if (!isset($_POST['send']) && !isset($_POST['start']) && !isset($_POST['next'])) {
                  echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
                  echo '<label for="patient_number">Personnummer: </label>';
                  echo '<input name="patient_number" type="text"> <br />';
                  echo '<input name="send" type="submit" value="Login">';
                  echo '</form>';
               }
               else {

                  $pNumber = $_POST['patient_number'];
                  $_SESSION['patient_number'] = $pNumber;

                  if (!isset($_POST['start']) && !isset($_POST['next'])) {
                     echo 'Vänligen fyll i nedanstående skattningar. Klicka på starta för att sätta igång. <br />';

                     getForm($pNumber);

                     echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
                     echo '<input name="start" type="submit" value="Starta">';
                     echo '</form>';
                  }
                  else {

                     $fKey = $_SESSION['formKeys'];
                     $fNames = $_SESSION['formNames'];
                     $formCount = count($fKey);
                     //echo $formCount;
                     //echo '<br />';
                     $ii = 0;

                     while($ii < $formCount) {
                        echo '<h3>' . $fNames[$ii] . ' </h3><br />';

                        getQs($fKey[$ii]);

                        //echo $_SESSION['alt_string'][0];

                        echo '<br />';
                        $ii++;

                     }

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
