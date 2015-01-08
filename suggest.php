<?php

// if the 'term' variable is not sent with the request, exit
if ( !isset($_REQUEST['term']) )
exit;

// connect to the database server and select the appropriate database for use
$dblink = mysql_connect('localhost', 'root', 'root') or die( mysql_error() );
mysql_select_db('typografique_se');

// query the database table for p_number's that match 'term'
$rs = mysql_query('SELECT p_number, p_firstneme, p_lastname, p_email FROM PATIENT WHERE p_number LIKE "'. mysql_real_escape_string($_REQUEST['term']) .'%" ORDER BY p_number ASC LIMIT 0,10', $dblink);

// loop through each p_number returned and format the response for jQuery
$data = array();
if ( $rs && mysql_num_rows($rs) )
{
    while( $row = mysql_fetch_array($rs, MYSQL_ASSOC) )
    {
        $data[] = array(
            'label' => $row['p_number'] .', '. $row['p_firstname'] .' '. $row['p_lastname'].' '. $row['p_email'] ,
            'value' => $row['p_number']
        );
    }
}

// jQuery wants JSON data
echo json_encode($data);
flush();
