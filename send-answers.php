<?php
    include('db_connection.php');
    require('functions.php');

    session_start();
    $pNumber = $_SESSION['p_number'];
    $formCount = $_SESSION['form_count'];
    $sKeys = $_SESSION['s_key'];

    $i = 0;
    while ($i < $formCount) {

        $values = array();

        $sqlGetAnswer = "SELECT SUM(ALT.alt_value) FROM ALT INNER JOIN ANSWER INNER JOIN SKATTNING INNER JOIN TEMPLOGIN ON ANSWER.s_key = SKATTNING.s_key AND SKATTNING.t_key = TEMPLOGIN.t_key AND ALT.alt_key = ANSWER.alt_key WHERE (TEMPLOGIN.p_number = '$pNumber' AND SKATTNING.s_key = '$sKeys[$i]'); ";
        // SQL Error message

        if ($mysqli = connect_db()) {
            $result = $mysqli->query($sqlGetAnswer);
            print_r($mysqli->error);
        }

        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
            $values[] = $row;
        }

        foreach ($values as $value) {

            if ($value[0] < 175) {
                $string = 1;
            }
            else if ($value[0] < 250){
                $string = 2;
            }
            else if ($value[0] < 325) {
                $string = 3;
            }
            else if ($value[0] <= 400) {
                $string = 4;
            }

            sendResult($sKeys[$i], $string, $value[0]);
        }


        $i++;

    }

    // DELETE TEMPLOGIN!!!

    header('Location: thanks.php')
?>
