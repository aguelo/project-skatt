<?php
    session_start();
    if (!isset($_SESSION['v_email'])) {
        header('Location: v_login.php');
    }
    include('db_connection.php');
    require('functions.php');
?>
<!DOCTYPE html PUBLIC "-//w3c//DTD XHTMLm 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmnlns="http://www.w3.org/1999/xhtml" xml:lang="sv" lang="sv">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Webbskattningsportalen</title>
    <body>
		<div class="staff-admin">
        <h1><a href="add_patient.php"><img class="logo" src="img/portalen.png"></a></h1>
        <div class="med-width" id="new-forms">
        <a href="index.php">Index</a></div>
        <div class="small-width grey-bg" id="login">
            <?php
            if(isset($_POST['submit']))
            {
                $pnumber = $_POST['pnummer'];
                $fname = $_POST['fnamn'];
                $lname = $_POST['enamn'];
                $email = $_POST['epost'];
                $sqlSendPatient = "INSERT INTO `PATIENT` (`p_number`, `p_firstname`, `p_lastname`, `p_email`) VALUES ('$pnumber', '$fname', '$lname', '$email');";

                // SQL Error message
                if ($mysqli = connect_db()) {
                    $result = $mysqli->query($sqlSendPatient);
                    print_r($mysqli->error);
                }
                echo '<p class="grey-center">Patient tillagd</p>';
            }
            else {
            ?>
            <h2>Lägg till patient</h2>
            <form name="patient" method="post" action="">
                <label>Personnummer :</label>
                <input id="pnummer" name="pnummer" placeholder="ÅÅMMDDXXXX" type="text">
                <label>Förnamn :</label>
                <input id="fnamn" name="fnamn" placeholder="Förnamn" type="text">
                <label>Efternamn :</label>
                <input id="enamn" name="enamn" placeholder="Efternamn" type="text">
                <label>E-post :</label>
                <input id="epost" name="epost" placeholder="patient@mail.com" type="text">
                <input name="submit" type="submit" value="Lägg till">
            </form>
            <?php
            }
            ?>
            </div>
        </div>
		</div>
    </body>
    <footer>
        <small><p>Skapad av Magnus Ulenius, Axel Jonsson, <br /> Johannes Swenson, Pietro Mattei och Johan Bergström. <br /><br />
            &copy; 2015</p></small><br />
        <a href="v_logout.php">Logga ut</a>
    </footer>
    </html>
