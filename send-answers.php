<?php
    include('db_connection.php');
    require('functions.php');

    session_start();
    $pNumber = $_SESSION['p_number'];
    $formCount = $_SESSION['form_count'];
    $sKeys = $_SESSION['s_key'];

    //echo $pNumber . '<br />';

    $i = 0;
    while ($i < $formCount) {

        $values = array();
        //echo $sKeys[$i] . '<br />';
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
            //echo $value[0] . '<br />';
            sendResult($sKeys[$i], $value[0]);
        }


        $i++;
        //echo '<br />';
    }
    
    // DELETE TEMPLOGIN!!!

    session_destroy();
    header('Location: login.php')
?>
