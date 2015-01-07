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
		<div class="header-bg">
			<header>
			</header>
		</div>
	   <div class="main">
		   <a href="index.php"><h1><img class="logo" src="img/portalen.png"></h1></a>
		   <div class="med-width grey-bg" id="ny-skatt">
			   <a href="incoming.php">Nya skattningar! <img src="img/warning.svg"></a>
		   </div>
		  <div class="med-width blue-bg" id="send-module">
			 <h2>Skicka ny skattning</h2>
				<p>
               <?php
               if (isset($_POST['generate'])) {
                  // Definiera sessions-variabler
                     $formToSend = $_POST['form'];
                     $_SESSION['form'] = $formToSend;
                     $patientToSendTo = $_POST['patient_number'];
                     $_SESSION['patient_number'] = $patientToSendTo;
                  // Om knapp är tryckt
                  // ...och minst ett formulär valt
                  if(empty($formToSend)) {
                     echo "Du valde inga formulär att skicka med i skattningen!";
                  }
                  // Om minst ett formulär ifyllt...
                  else {
                     // SQL Error message
                     if ($mysqli = connect_db()) {
                        $result = $mysqli->query($sqlSend);
                        print_r($mysqli->error);
                     }
                     // Skicka till TEMPLOGIN
                     $randPass = randomPassword();
                     $sqlTemp  = "INSERT INTO TEMPLOGIN (p_number, p_pass) VALUES ('$patientToSendTo', '$randPass');";
                     $mysqli->query($sqlTemp);
                     // Hämta t_key
                     $tKey = getTkey($patientToSendTo);
                     // Skicka till SKATTNING
                     // FUNKAR EJ?
                     // sendToSkattning($formToSend, $tKey);
                     $n = count($formToSend);
                     for ($i=0; $i < $n; $i++) {
                        $sqlSkattning = "INSERT INTO SKATTNING (f_key, t_key) VALUES ('$formToSend[$i]', '$tKey[0]');";
                        $mysqli->query($sqlSkattning);
                     }
                     $mysqli->close();
                     // Skicka E-post
                     // Hämta adress
                     $array = getEmailPass($tKey[0]);
                     $patientEmail = $array[0];
                     $patientPass = $array[1];
                     sendEmail($patientEmail, $patientPass);
                  }
               }
               else {
                  	session_start();
                	firstForm();
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
