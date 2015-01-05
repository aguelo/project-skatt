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
               if (!isset($_POST['send']) && !isset($_POST['start']) && !isset($_POST['skicka'])) {
                  echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
                  echo '<label for="patient_number">Personnummer: </label>';
                  echo '<input name="patient_number" type="text"> <br />';
                  echo '<input name="send" type="submit" value="Login">';
                  echo '</form>';
               }
               else {

                  $pNumber = $_POST['patient_number'];
                  $_SESSION['patient_number'] = $pNumber;

                  if (!isset($_POST['start']) && !isset($_POST['skicka'])) {
                     echo 'Vänligen fyll i nedanstående skattningar. Klicka på starta för att sätta igång. <br />';

                     getForm($pNumber);

                     echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
                     echo '<input name="start" type="submit" value="Starta">';
                     echo '</form>';
                  }
                  else {

                     for($i = 0; $i < 10; $i++) {
                        $fKey[$i] = $_SESSION["formKeys"][$i];
                        //echo $fKey[$i];

                     $sqlGetQs  = "SELECT QUESTION.q_key, QUESTION.q_string FROM QUESTION INNER JOIN FORM ON QUESTION.f_key = FORM.f_key WHERE FORM.f_key = '$fKey[$i]';";

                     // SQL Error message
                     if ($mysqli = connect_db()) {
                        $result = $mysqli->query($sqlGetQs);
                        print_r($mysqli->error);
                     }
                     while($myRow = $result->fetch_array()) {
                        $qKeys[] = $myRow['q_key'];
                        $questions[] = $myRow['q_string'];
                     }
                     echo $questions[$i] . "<br />";
                     echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';

                     for($j = 0; $j < 4; $j++) {
                        $sqlGetAlts = "SELECT ALT.alt_key, ALT.alt_string FROM ALT INNER JOIN QUESTION ON ALT.q_key = QUESTION.q_key WHERE QUESTION.q_key = '$qKeys[$j]';";

                        // SQL Error message
                        if ($mysqli = connect_db()) {
                           $result = $mysqli->query($sqlGetAlts);
                           print_r($mysqli->error);
                        }
                        while($myRow = $result->fetch_array()) {
                           $altKeys[] = $myRow['alt_key'];
                           $altStrings[] = $myRow['alt_string'];
                        }
                        // echo '<input name="answer_key" type="hidden" value="' .  . '"/>';
                        echo '<input name="answer" type="radio" value="' . $altKeys[$j] . '">';
                        echo $altStrings[$j];
                     }
                     echo '<input name="next" type="submit" value="Nästa fråga" >';
                     echo '</form>';

                     echo '<br /> <br />';
                     }


                     if (isset($_POST['skicka'])) {
                        $answers = $_POST['answer'];
                        $_SESSION['answer'] = $answers;
                        echo $answers;
                     }


                     // $alts[] = $myRow['alt_string'];
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
