<?php
    include("db_connection.php")
?>

<!DOCTYPE html PUBLIC "-//w3c//DTD XHTMLm 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmnlns="http://www.w3.org/1999/xhtml" xml:lang="sv" lang="sv">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Webbskattningsportalen</title>
</head>
<body>
	<header>

	</header>

   <div class="content">
	   <h1>Webbskattningsportalen</h1>

	   <div class="small-width grey-bg" id="ny-skatt">
	   		Nya Skattningar!
	   </div>

      <div class="med-width blue-bg" id="send-module">
         <h2>Skicka ny skattning</h2>
            <p>
               <?php
               if (isset($_POST['send'])) {
                  $formToSend = $_POST['form'];
                  if(empty($formToSend)) {
                     echo "Du valde inga formulär att skicka med i skattningen!";
                  }
                  else {

                     // Skicka till SKATTNING
                     $n = count($formToSend);
                     if ($mysqli = connect_db()) {
                        $result = $mysqli->query($sqlSend);
                        print_r($mysqli->error);
                     }
                     for ($i=0; $i < $n; $i++) {
                        $sqlSkattning = "INSERT INTO SKATTNING (f_key) VALUES ('$formToSend[$i]');";
                        $mysqli->query($sqlSkattning);
                     }
                     echo $n . " rows inserted to database! <br />";

                     // Skicka till TEMPLOGIN
                     $patientToSendTo = $_POST['patient_number'];
                     $sqlTemp  = "INSERT INTO TEMPLOGIN (p_number) VALUES ('$patientToSendTo');";
                     $mysqli->query($sqlTemp);

                  }


               }
               else { ?>
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                  <label for="patient_number">Personnummer: </label>
                  <input name="patient_number" type="text"> <br />
                  <label for="patient_firstname">Förnamn: </label>
                  <input name="patient_firstname" type="text"> <br />
                  <label for="patient_lastname">Efternamn: </label>
                  <input name="patient_lastname" type="text"> <br />
                  <label for="patient_email">Epostadress: </label>
                  <input name="patient_email" type="text"> <br /><br />
                  <?php
                     $sqlForms = "SELECT f_key, f_code, f_name FROM FORM;";

                     if ($mysqli = connect_db()) {
                        $result = $mysqli->query($sqlForms);
                        print_r($mysqli->error);
                     }

                     while($myRow = $result->fetch_array()) {
                        echo '<input name="form[ ]" type="checkbox" value="' . $myRow['f_key'] . '">';
                        echo $myRow['f_code'] . '/ ' . $myRow['f_name'] . '<br />';
                     }

                  ?>
                  <br />
                  <input name="send" type="submit" value="Skicka skattning">
               </form>
               <?php } ?>

              <?php/*

               $sql = 'SELECT * FROM PATIENT ';

	            if($mysqli = connect_db()) {

                  $result = $mysqli->query($sql);
		            print_r($mysqli->error);
	            }

               echo '<table cellpadding="6" border="1">';
               echo '<tr>';
               echo '<th>Personnummer</th>';
               echo '<th>Förnamn</th>';
               echo '<th>Efternamn</th>';
               echo '<th>Epostadress</th>';
               echo '</tr>';

               while($myRow = $result->fetch_array()){
    	             echo '<tr>';
                   echo '<td>' . $myRow['p_number'] . '</td>';
                   echo '<td>' . $myRow['p_firstname'] . '</td>';
                   echo '<td>' . $myRow['p_lastname'] . '</td>';
                   echo '<td>' . $myRow['p_email'] . '</td>';
                   echo '</tr>';
               }
               echo '</table>';

               */?>
            </p>
            <!--<p>Here be dragons</p>!-->
         </div>
      </div>
</body>
<footer>
  <p>Powered by Aguel and friends</p>
  <!--<p>hur funkar commits?</p>
  <p>Foot</p>!-->
</footer>
