<?php
include('db_connection.php');
require('functions.php');
session_start();
?>
<!DOCTYPE html PUBLIC "-//w3c//DTD XHTMLm 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmnlns="http://www.w3.org/1999/xhtml" xml:lang="sv" lang="sv">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Webbskattningsportalen</title>
    <body>
		<div class="header-bg">
			<header>
			</header>
		</div>
		<h1><a href="index.php"><img class="logo" src="img/portalen.png"></a></h1>
		<div class="med-width" id="new-forms">
			<a href="index.php">Tillbaka</a>

            <?php
                if (!isset($_POST['export'])) {
            ?>

            <form action=" <?php $_SERVER['PHP_SELF'] ?> " method="post">
			<table>
				<tr>
					<td>
						<!-- Markera alla skattningar, Behöver funktion?-->
						Markera alla: <input type="checkbox" name="markall" value="Markera alla">
					</td>
				</tr>
				<tr>
					<td>
						<!-- Skicka till journal-knapp. Behöver funktion?-->
						<button name="export" id="export">Skicka till journal</button>
					</td>
				</tr>
			</table>
			<!-- Loop som hämtar varje skattning till tabell nedan? -->
			<div class="grey-bg" id="inkommen">
                <?php
                    //$tKeys = array();
                    $tKeys = getAllTkeys();

                    $results = array();
                ?>
                <table>
                    <tr>
                        <th>
                            <!-- Behöver funktion för att markera?-->
                            <!-- <input type="checkbox" name="mark" value="Markera"> -->
                        </th>
                        <th>
                            [Datum]
                        </th>
                        <th>
                            [Personnummer]
                        </th>
                        <th>
                            [Namn]
                        </th>
                        <th>
                            [ALK-1]
                        </th>
                        <th>
                            [DEP-2]
                        </th>
                        <th>
                            [KLA-3]
                        </th>
                    </tr>
                <?php
                // SKAPA ARRAY FÖR RAD:
                $topcount = 0;
                    foreach ($tKeys as $tKey) {
                        $checkbox = '<input type="checkbox" name="' . $tKey . '">';
                        $date = getResultDate($tKey);

                        $result = array();

                        $result[$topcount] = $checkbox;
                        $result[$topcount+1] = $date;

                        //echo $tKey;
                        $patient = getPatientID($tKey);

                        foreach ($patient as $pInfo) {
                            $result[] = $pInfo;

                        }
                        $sKeys = getSkeys($tKey);
                        //echo $sKeys;
                        $count = count($sKeys);
                        foreach ($sKeys as $sKey) {

                            $fKey = getFormKey($sKey);
                            switch ($fKey) {
                                case 1:
                                    $result[5] = getResult($sKey);
                                    break;
                                case 2:
                                    if (!isset($result[5])) { $result[5] = '-'; }
                                    $result[6] = getResult($sKey);
                                    break;
                                case 3:
                                    if (!isset($result[5])) { $result[5] = '-'; }
                                    if (!isset($result[6])) { $result[6] = '-'; }
                                    $result[7] = getResult($sKey);
                                    break;
                            }
                        }

                        if (!isset($result[7])) { $result[7] = '-'; }

                        echo '<tr>';
                        foreach ($result as $values) {
                            echo '<td>';
                            echo $values;
                            echo '</td>';
                        }
                        echo '</tr>';
                        $results[] = $result;
                        $_SESSION['results'] = $results;
                        $topcount++;
                    }

                ?>
				</table>
            </form>
    <?php
        }
        else {
            
            foreach ($_SESSION['results'] as $result) {
                foreach ($result as $value) {
                    echo $value . ' | ';
                }
                echo '<br />';
            }
        }
    ?>
			</div>
		</div>
	</body>
	<footer>
        <p>Skapad av oss</p>
    </footer>
</html>
