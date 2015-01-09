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
       echo '<form method="post" action="index.php">
       <button type="submit">Tillbaka</button>
       </form>';
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
        $sqlGetForm  = "SELECT SKATTNING.f_key, SKATTNING.s_key, FORM.f_name FROM SKATTNING INNER JOIN TEMPLOGIN INNER JOIN FORM ON SKATTNING.t_key = TEMPLOGIN.t_key AND SKATTNING.f_key = FORM.f_key WHERE TEMPLOGIN.p_number = '$pNumber';";

        // SQL Error message
        if ($mysqli = connect_db()) {
           $result = $mysqli->query($sqlGetForm);
            print_r($mysqli->error);
        }

        while($myRow = $result->fetch_array()) {
            $formKeys[] = $myRow['f_key'];
            $formNames[] = $myRow['f_name'];
            $sKeys[] = $myRow['s_key'];
        }

        session_start();
        $_SESSION['form_keys'] = $formKeys;
        $_SESSION['form_names'] = $formNames;

        // s_key sessionsvariabel
        $_SESSION['s_key'] = $sKeys;

        // Counter för # formulär
        $formCount = count($formKeys);
        $_SESSION['form_count'] = $formCount;

        // Skriv ut de skattningsformulär som patienten ska genomföra

        $i = 0;
        $h = 0;

        while ($i < $formCount) {
            echo '<table>';
            echo '<tr><td>';
            echo $formKeys[$i] . ' ' . $formNames[$i];
            //$check = 0;
            $sqlCheckAnswer = "SELECT s_key FROM ANSWER WHERE (s_key) = '$sKeys[$i]' LIMIT 1;";
            // SQL Error message
            if ($mysqli = connect_db()) {
                $result = $mysqli->query($sqlCheckAnswer);
                print_r($mysqli->error);
                $check = mysqli_num_rows($result);
            }

            if ($check == 0) {
                echo '<form action="formular-single.php" method="post">';
                echo '<input type="hidden" name="this_s_key" value="' . ($sKeys[$i]) . '">';
                echo '<input type="hidden" name="this_form_index" value="' . ($i) . '">';
                echo '<input type="hidden" name="this_form_key" value="' . ($formKeys[$i]) . '">';
                echo '</td><td align="right">';
                echo '<input name="start" type="submit" value="Starta denna skattning">';
                echo '</form>';

            }
            else {
                echo '</td><td align="right">';
                echo 'Klar ';
                $h++;
            }
            echo '</td></tr>';
            echo '</table>';
            echo '<br />';
            $i++;
        }
        if ($h == $formCount) {
            echo 'Tack! Du har nu fyllt i alla formulär.<br />';
            echo '<a href="send-answers.php">Skicka till behandlare KNAPP!</a>';
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

    // ----- Skicka svar till databasen -----
    function sendAnswer($altKey, $sKey, $qKey) {

        $sqlSendAnswer = "INSERT INTO `ANSWER` (`alt_key`, `s_key`, `q_key`) VALUES ('$altKey', '$sKey', '$qKey');";

        // SQL Error message
        if ($mysqli = connect_db()) {
            $result = $mysqli->query($sqlSendAnswer);
            print_r($mysqli->error);
        }
    }

    // ----- skriv in resultat i databas -----
    function sendResult($sKey, $res) {
        $sqlSendResult = "INSERT INTO `RESULT` (`s_key`, `res_value`) VALUES ('$sKey', '$res');";
        if ($mysqli = connect_db()) {
            $result = $mysqli->query($sqlSendResult);
            print_r($mysqli->error);
        }
    }
?>
