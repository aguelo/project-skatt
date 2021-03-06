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
    <link rel="stylesheet" type="text/css" href="/style.css" />
    <link rel="stylesheet" href="js/jquery.css" />
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>Webbskattningsportalen</title>
</head>
	<body>
		<div class="header-bg">
			<header>
			</header>
            </div>
            <div class="main">
            <h1><a href="index.php"><img class="logo" src="img/portalen.png"></a></h1>
            <?php
                $tKeys = getAllTkeys();
                if (!empty($tKeys)) {
            ?>
            <div class="med-width blue-bg" id="ny-skatt">
                <a href="newforms.php">Det finns skattningar att skicka till journal! <img src="img/warning.svg"></a>
            </div>
            <?php
					echo '<div class="med-width grey-bg" id="send-module";>';
                }
				else {
					echo '<div class="med-width grey-bg" id="send-module" style="border-radius:10px">';
				}
            ?>

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
								echo '<div class="grey-center">';
                                echo "<p>Du valde inga formulär att skicka med i skattningen!</p>";
                                echo '<form method="post" action="index.php"><button type="submit">Tillbaka</button></form>';
								echo '</div>';
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
                            <input name="patient_firstname" type="text" id="firstname" readonly>
                            <label for="patient_lastname">Efternamn: </label>
                            <input name="patient_lastname" type="text" id="lastname" readonly>
                            <label for="patient_email">Epostadress: </label>
                            <input name="patient_email" type="text" id="email" readonly>

                        <!-- JQuery Autocomplete script. Skickar förfrågning till ajax.php -->
                        <script>
                        $('#personnummer').autocomplete({
                            source: function( request, response ) {
                                $.ajax({
                                    url : 'ajax.php',
                                    dataType: "json",
                                    data: {
                                        name_startsWith: request.term,
                                        type: 'patient',
                                        row_num : 1
                                    },
                                    success: function( data ) {
                                        response( $.map( data, function( item ) {
                                            var code = item.split("|");
                                            return {
                                                label: code[0] +  " (" + code[1] + " " + code[2] + ")",
                                                value: code[0],
                                                data : item
                                            }
                                        }));
                                    }
                                });
                            },
                            autoFocus: true,
                            minLength: 0,
                            select: function( event, ui ) {
                                var names = ui.item.data.split("|");
                                $('#firstname').val(names[1]);
                                $('#lastname').val(names[2]);
                                $('#email').val(names[3]);
                            }
                        });
                        </script>

                        <?php
                        if (isset($_POST['submit'])) {
                            echo "<p>";
                            while (list($key,$value) = each($_POST)){
                                echo "<strong>" . $key . "</strong> = ".$value."<br />";
                            }
                            echo "</p>";
                        }
                        ?>


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
				<div class="med-width" id="staff-nav">
					<a href="add_patient.php">Lägg till patient</a>
					<a href="login.php">Patient inloggning</a>
				</div>
         </div>
	</body>
    <footer>
        <small><p>Skapad av Magnus Ulenius, Axel Jonsson, <br /> Johannes Swenson, Pietro Mattei och Johan Bergström. <br /><br />
        &copy; 2015</p></small>
        <a href="v_logout.php">Logga ut</a>
    </footer>
</html>
