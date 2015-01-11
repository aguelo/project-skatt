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

    // ----- Create new TEMPLOGIN -----
    function createTemplogin($pNum) {

        // DBconnection + query + SQL Error message
        if ($mysqli = connect_db()) {
            $result = $mysqli->query($sqlSend);
            print_r($mysqli->error);
        }
        // Skicka till TEMPLOGIN
        $randPass = '123456';
        $sqlTemp  = "INSERT INTO TEMPLOGIN (p_number, p_pass) VALUES ('$pNum', '$randPass');";
        $mysqli->query($sqlTemp);
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

    // ----- send to SKATTNING -----
    function sendSkattning() {

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
    function sendResult($sKey, $strKey, $res) {
        $sqlSendResult = "INSERT INTO `RESULT` (`s_key`, `str_key`, `res_value`) VALUES ('$sKey', '$strKey', '$res');";
        if ($mysqli = connect_db()) {
            $result = $mysqli->query($sqlSendResult);
            print_r($mysqli->error);
        }
    }

    // ----- getAllTkeys funktion för newform.php -----
    function getAllTkeys() {
        $sqlGetAllTkeys = "SELECT DISTINCT TEMPLOGIN.t_key FROM TEMPLOGIN INNER JOIN RESULT INNER JOIN SKATTNING ON RESULT.s_key = SKATTNING.s_key AND SKATTNING.t_key = TEMPLOGIN.t_key WHERE SKATTNING.s_key = RESULT.s_key;";

        if ($mysqli = connect_db()) {
            $result = $mysqli->query($sqlGetAllTkeys);
            print_r($mysqli->error);
        }
        while($myRow = $result->fetch_array()) {
            $tKeys[] = $myRow['t_key'];
        }
        return $tKeys;

    }

    // ----- getSkey -----
    function getSkeys($tKey) {
        $sqlGetSkeys = "SELECT RESULT.s_key, SKATTNING.f_key FROM RESULT INNER JOIN SKATTNING INNER JOIN TEMPLOGIN ON RESULT.s_key = SKATTNING.s_key AND SKATTNING.t_key = TEMPLOGIN.t_key WHERE TEMPLOGIN.t_key = '$tKey';";
        if ($mysqli = connect_db()) {
            $result = $mysqli->query($sqlGetSkeys);
            print_r($mysqli->error);
        }
        while($myRow = $result->fetch_array()) {
            $sKeys[] = $myRow['s_key'];
        }
        return $sKeys;
    }

    // ----- getFkey function -----
    function getFormKey($sKey) {
        $sqlGetFormKey = "SELECT SKATTNING.f_key FROM SKATTNING WHERE SKATTNING.s_key = '$sKey';";
        if ($mysqli = connect_db()) {
            $result = $mysqli->query($sqlGetFormKey);
            print_r($mysqli->error);
        }
        while($myRow = $result->fetch_array()) {
            $fKey = $myRow['f_key'];
        }
        return $fKey;
    }

    // ----- getPatientID function -----
    function getPatientID($tKey) {
        $sqlGetPatientID = "SELECT TEMPLOGIN.p_number, PATIENT.p_firstname, PATIENT.p_lastname FROM TEMPLOGIN INNER JOIN PATIENT ON TEMPLOGIN.p_number = PATIENT.p_number WHERE TEMPLOGIN.t_key = '$tKey';";
        if ($mysqli = connect_db()) {
            $result = $mysqli->query($sqlGetPatientID);
            print_r($mysqli->error);
        }
        while($myRow = $result->fetch_array()) {
            $patient[] = $myRow['p_number'];
            $patient[] = $myRow['p_firstname'] . ' ' . $myRow['p_lastname'];
            //$patient[] = $myRow['p_lastname'];
        }
        return $patient;
    }

    // ----- getResult function för newform.php -----
    function getResult($sKey) {
        $sqlGetResult = "SELECT RESULTSTRING.string FROM RESULT INNER JOIN RESULTSTRING ON (RESULT.str_key = RESULTSTRING.str_key) WHERE RESULT.s_key = '$sKey';";
        if ($mysqli = connect_db()) {
            $result = $mysqli->query($sqlGetResult);
            print_r($mysqli->error);
        }
        while($myRow = $result->fetch_array()) {
            $resultstring = $myRow['string'];
        }
        return $resultstring;
    }

    // ----- Get Result Date -----
    function getResultDate($tKey) {
        $sqlGetResultDate = "SELECT DISTINCT RESULT.r_timestamp FROM RESULT INNER JOIN TEMPLOGIN INNER JOIN SKATTNING ON RESULT.s_key = SKATTNING.s_key AND SKATTNING.t_key = TEMPLOGIN.t_key WHERE TEMPLOGIN.t_key = '$tKey';";
        if ($mysqli = connect_db()) {
            $result = $mysqli->query($sqlGetResultDate);
            print_r($mysqli->error);
        }
        while($myRow = $result->fetch_array()) {
            $timestamp = $myRow['r_timestamp'];
        }
        return $timestamp;
    }

    // ----- exportResult function -----
    function exportResult($tKey) {
        $sqlExport = "SELECT RESULT.s_key, RESULT.str_key, RESULT.res_value, RESULTSTRING.string, TEMPLOGIN.p_number, PATIENT.p_firstname, PATIENT.p_lastname FROM RESULT INNER JOIN TEMPLOGIN INNER JOIN SKATTNING INNER JOIN RESULTSTRING INNER JOIN PATIENT ON RESULT.s_key = SKATTNING.s_key AND SKATTNING.t_key = TEMPLOGIN.t_key AND RESULT.str_key = RESULTSTRING.str_key AND TEMPLOGIN.p_number = PATIENT.p_number WHERE TEMPLOGIN.t_key = '$tKey';";

        if ($mysqli = connect_db()) {
            $result = $mysqli->query($sqlExport);
            print_r($mysqli->error);
        }
        while($myRow = $result->fetch_array()) {
            $sKey = $myRow['s_key'];
            $strKey = $myRow['str_key'];
            $resValue = $myRow['res_value'];
            $resString = $myRow['string'];
            $pNumber = $myRow['p_number'];
            $firstName = $myRow['p_firstname'];
            $lastName = $myRow['p_lastname'];
        }
        $filename = 'data_skattning_' . $sKey . '.txt';
        $exportfile = fopen($filename, 'w');
        $text = 'Personnummer: ' . $pNumber . ' Namn: ' . $firstName . ' ' . $lastName . ' Status: ' . $resString . ' str_key: ' . $strKey . ' res_value: ' . $resValue;
        fwrite($exportfile, $text);
        fclose($exportfile);
    }

    // ----- DELETE RESULT FUNCT. -----
    function deleteResult($sKey) {
        $sqlDeleteResult = "DELETE FROM RESULT WHERE s_key = '$sKey';";
        if ($mysqli = connect_db()) {
            $result = $mysqli->query($sqlDeleteResult);
            print_r($mysqli->error);
        }
        $mysqli->query($sqlDeleteResult);

    }

?>
