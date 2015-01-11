<?php

require_once 'db_connection.php';

if($_GET['type'] == 'patient'){
    $row_num = $_GET['row_num'];
    $result = mysql_query("SELECT p_number, p_firstname, p_lastname, p_email FROM PATIENT where p_number LIKE '".strtoupper($_GET['name_startsWith'])."%'");
    $data = array();
    while ($row = mysql_fetch_array($result)) {
        $name = $row['p_number'].'|'.$row['p_firstname'].'|'.$row['p_lastname'].'|'.$row['p_email'].'|'.$row_num;
        array_push($data, $name);
    }
    echo json_encode($data);
}

?>
