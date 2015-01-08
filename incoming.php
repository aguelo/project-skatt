<?php
    session_start();
    if (!isset($_SESSION['p_number'])) {
        header('Location: login.php');
    }
    include('db_connection.php');
    require('functions.php');

    if (isset($_POST['skicka'])) {
        session_start();
        $tfk = $_POST['this_form_key'];
        $tfi = $_POST['this_form_index'];
        $tsk = $_POST['this_s_key'];
        getQs($tfk);
        for ($j = 0; $j < 10; $j++) {
            $counter = $_SESSION['q_key'][$j];
            $maxCount = ($counter+10);
            while ($counter < $maxCount) {
                $answers[] = $_POST[$counter];
                $counter++;
            }
            sendAnswer($answers[$j], $tsk, $_SESSION['q_key'][$j]);
        }
    }
    header('Location: formular.php')
?>
