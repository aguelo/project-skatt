<?php
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
            <a href="v_login.php">Logga in</a></div>
            <div class="small-width grey-bg" id="login">
                <?php
                if(isset($_POST['submit']))
                {
                    $pnumber = $_POST['pnummer'];
                    $pw = $_POST['pw'];
                    $email = $_POST['epost'];
                    $sqlSendPatient = "INSERT INTO `VARDARE` (`v_number`, `v_pass`, `v_email`) VALUES ('$pnumber', '$pw', '$email');";

                    // SQL Error message
                    if ($mysqli = connect_db()) {
                        $result = $mysqli->query($sqlSendPatient);
                        print_r($mysqli->error);
                    }
                    echo "<p>Vårdare tillagd</p>";
                }
                else {
                    ?>
                    <h2>Lägg till vårdare</h2>
                    <form name="patient" method="post" action="">
                        <label>Personnummer:</label>
                        <input id="pnummer" name="pnummer" placeholder="ÅÅMMDDXXXX" type="text">
                        <label>E-post:</label>
                        <input id="epost" name="epost" placeholder="vårdare@mail.com" type="text">
                        <label>Lösenord:</label>
                        <input id="pw" name="pw" placeholder="Password" type="password">
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
            &copy; 2015</p></small>
    </footer>
</html>
