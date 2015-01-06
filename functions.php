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
   echo '<input name="patient_number" type="text">';
   echo '<label for="patient_firstname">Förnamn: </label>';
   echo '<input name="patient_firstname" type="text">';
   echo '<label for="patient_lastname">Efternamn: </label>';
   echo '<input name="patient_lastname" type="text">';
   echo '<label for="patient_email">Epostadress: </label>';
   echo '<input name="patient_email" type="text">';

   $sqlForms = "SELECT f_key, f_code, f_name FROM FORM;";

   if ($mysqli = connect_db()) {
      $result = $mysqli->query($sqlForms);
      print_r($mysqli->error);
   }
	echo '<br />';
   while($myRow = $result->fetch_array()) {
      echo '<input name="form[ ]" type="checkbox" value="' . $myRow['f_key'] . '">';
      echo $myRow['f_code'] . ' / ' . $myRow['f_name'] . '<br />';
   }
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
?>
