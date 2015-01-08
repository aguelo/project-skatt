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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
    jQuery(document).ready(function($){
        $('#personnummer').autocomplete({source:'suggest.php', minLength:2});
    });
    </script>
    <title>Webbskattningsportalen</title>
</head>
	<body>
		<div class="header-bg">
			<header>
			</header>
            </div>
            <div class="main">
            <h1><a href="index.php"><img class="logo" src="img/portalen.png"></a></h1>
            <div class="med-width grey-bg" id="ny-skatt">
                <a href="newforms.php">Nya skattningar! <img src="img/warning.svg"></a>
            </div>
            <!-- Funktion som gör att notifikation endast syns om en ny skattning är inkommen?-->
            <div class="med-width blue-bg" id="send-module">
                <p>
                    <?php
                    //Om skattning är skickad
                        if (isset($_POST['generate'])) {

                        // Definiera sessions-variabler
                            $formToSend = $_POST['form'];
                            $_SESSION['form'] = $formToSend;
                            $patientToSendTo = $_POST['patient_number'];
                            $_SESSION['patient_number'] = $patientToSendTo;

                        // Om knapp är tryckt
                            if(empty($formToSend)) {
                                echo "Du valde inga formulär att skicka med i skattningen!";
                                echo '<form method="post" action="index.php"><button type="submit">Tillbaka</button></form>';
                            }
                        // Om inte intryckt
                            else {

                            // DBconnection + query + SQL Error message
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
                            $n = count($formToSend);
                            for ($i=0; $i < $n; $i++) {
                                $sqlSkattning = "INSERT INTO SKATTNING (f_key, t_key) VALUES ('$formToSend[$i]', '$tKey[0]');";
                                $mysqli->query($sqlSkattning);
                            }

                            // Skicka E-post
                                $array = getEmailPass($tKey[0]);
                                $patientEmail = $array[0];
                                $patientPass = $array[1];
                                sendEmail($patientEmail, $patientPass);
                            }
                        }
                    // Om EJ skattning skickad (Start)
                        else {
                                session_start();
                            ?>

                            <h2>Skicka ny skattning</h2>
                            <form action="" method="post">
                            <label for="patient_number">Personnummer: </label>
                            <input name="patient_number" type="text" id="personnummer">
                            <label for="patient_firstname">Förnamn: </label>
                            <input name="patient_firstname" type="text">
                            <label for="patient_lastname">Efternamn: </label>
                            <input name="patient_lastname" type="text">
                            <label for="patient_email">Epostadress: </label>
                            <input name="patient_email" type="text">

                            <?php
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
                        ?>
                    </p>
            </div>
         </div>
	</body>
    <footer>
        <p>Skapad av oss</p>
    </footer>
</html>
