<?php
// ----- Random Password function -----
function randomPassword() {
   $alphabet = "ABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
   $pass = array(); //remember to declare $pass as an array
   $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
   for ($i = 0; $i < 6; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
   }
   return implode($pass); //turn the array into a string
}

// ----- Send module - Index-formuläret -----
function firstForm() {
   echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
   echo '<label for="patient_number">Personnummer: </label>';
   echo '<input name="patient_number" type="text"> <br />';
   echo '<label for="patient_firstname">Förnamn: </label>';
   echo '<input name="patient_firstname" type="text"> <br />';
   echo '<label for="patient_lastname">Efternamn: </label>';
   echo '<input name="patient_lastname" type="text"> <br />';
   echo '<label for="patient_email">Epostadress: </label>';
   echo '<input name="patient_email" type="text"> <br />';

   $sqlForms = "SELECT f_key, f_code, f_name FROM FORM;";

   if ($mysqli = connect_db()) {
      $result = $mysqli->query($sqlForms);
      print_r($mysqli->error);
   }

   while($myRow = $result->fetch_array()) {
      echo '<input name="form[ ]" type="checkbox" value="' . $myRow['f_key'] . '">';
      echo $myRow['f_code'] . ' / ' . $myRow['f_name'] . '<br />';
   }
   echo '<br />';
   echo '<input name="generate" type="submit" value="Skicka skattning">';
   echo '</form>';
}
// ----- Get t_key ------
function getTkey($p_n) {
   $sqlGetDataTempLogin = "SELECT t_key FROM TEMPLOGIN WHERE (p_number = '$p_n') ORDER BY t_key DESC LIMIT 1;";

   if ($mysqli = connect_db()) {
      $result = $mysqli->query($sqlGetDataTempLogin);
      print_r($mysqli->error);
   }
   $data = $result->fetch_array(MYSQLI_NUM);
   return $data;
   $mysqli->close();
}

// ----- getEmailPass function -----
function getEmailPass($temploginKey) {
   $sqlGetEmail = "SELECT PATIENT.p_email, TEMPLOGIN.p_pass FROM PATIENT INNER JOIN TEMPLOGIN INNER JOIN SKATTNING ON PATIENT.p_number = TEMPLOGIN.p_number AND TEMPLOGIN.t_key = SKATTNING.t_key WHERE TEMPLOGIN.t_key = '$temploginKey' LIMIT 1;";
   if ($mysqli = connect_db()) {
      $result = $mysqli->query($sqlGetEmail);
      print_r($mysqli->error);
   }
   $data = $result->fetch_array(MYSQLI_NUM);
   return $data;
   $mysqli->close();
}

// ----- sendEmail function -----
function sendEmail($patientEmail, $patientPass) {
   $msg = 'Hej! Här kommer din webbskattning. Klicka på länken nedan för att logga in med ditt personnummer och koden: ' . $patientPass;
   mail($patientEmail, 'Webbskattning', $msg);
   echo 'Email sent to ' . $patientEmail;
}

// ----- getLogin -----
function getLogin($p_number, $p_pass) {
   $sqlGetLogin = "SELECT p_number, p_pass FROM TEMPLOGIN WHERE p_number = '$p_number' AND p_pass = '$p_pass' LIMIT 1;";
   if ($mysqli = connect_db()) {
      $result = $mysqli->query($sqlGetLogin);
      print_r($mysqli->error);
   }
   $data = $result->fetch_array(MYSQLI_NUM);
   return $data;
   $mysqli->close();
}

// ----- Hämta formulär -----
function getForm($pNumber) {
   $sqlGetForm  = "SELECT SKATTNING.f_key, FORM.f_name FROM SKATTNING INNER JOIN TEMPLOGIN INNER JOIN FORM ON SKATTNING.t_key = TEMPLOGIN.t_key AND SKATTNING.f_key = FORM.f_key WHERE TEMPLOGIN.p_number = '$pNumber';";

   // SQL Error message
   if ($mysqli = connect_db()) {
      $result = $mysqli->query($sqlGetForm);
      print_r($mysqli->error);
   }

   while($myRow = $result->fetch_array()) {
      $formKeys[] = $myRow['f_key'];
      $formNames[] = $myRow['f_name'];
   }

   session_start();
   $_SESSION['form_keys'] = $formKeys;
   $_SESSION['form_names'] = $formNames;
   $_SESSION['this_form_key'] = $thisFormKey;
   $_SESSION['form_count'] = $formCount;

   $formCount = count($formKeys);
   // Skriv ut de skattningsformulär som patienten ska genomföra
   for ($i=0; $i < $formCount; $i++) {
      echo $formKeys[$i] . ' ' . $formNames[$i] . '<br />';
      echo '<form action="formular-single.php" method="post">';
      echo '<input type="hidden"name="this_form_key" value="' . ($formKeys[$i] - 1) . '">';
      echo '<input name="start" type="submit" value="Starta denna skattning">';
      echo '</form>';

   }

}
// Hämta alternativ till frågefunktion -----
function getAlts($fKey, $qKey) {
   $kk = 0;
   while ($kk < 4) {
      $sqlGetAlts = "SELECT ALT.alt_key, ALT.alt_string FROM ALT INNER JOIN FORM INNER JOIN QUESTION ON FORM.f_key = QUESTION.f_key AND QUESTION.q_key = ALT.q_key WHERE FORM.f_key = '$fKey' AND ALT.q_key = '$qKey';";

      // SQL Error message
      if ($mysqli = connect_db()) {
         $result = $mysqli->query($sqlGetAlts);
         print_r($mysqli->error);
      }
      while($myRow = $result->fetch_array()) {
         $altKeys[] = $myRow['alt_key'];
         $altStrings[] = $myRow['alt_string'];
      }
      session_start();
      $_SESSION['alt_key'] = $altKeys;
      $_SESSION['alt_string'] = $altStrings;
      $kk++;
   }
}

// ----- Hämta formulärfrågor och alternativ -----
function getQs($key) {
   $jj = 0;
   while($jj < 10) {
      $sqlGetQs  = "SELECT QUESTION.q_key, QUESTION.q_string FROM QUESTION WHERE QUESTION.f_key = '$key';";

      // SQL Error message
      if ($mysqli = connect_db()) {
         $result = $mysqli->query($sqlGetQs);
         print_r($mysqli->error);
      }
      while($myRow = $result->fetch_array()) {
         $qKeys[] = $myRow['q_key'];
         $questions[] = $myRow['q_string'];
      }
      session_start();
      $_SESSION['q_key'] = $qKeys;
      $_SESSION['q_string'] = $questions;
      $jj++;
   }
}

?>
