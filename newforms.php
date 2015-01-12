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
		<div class="header-bg">
			<header>
			</header>
		</div>
		<h1><a href="index.php"><img class="logo" src="img/portalen.png"></a></h1>
		<div class="med-width" id="new-forms">

            <?php
                if (!isset($_POST['export'])) {
            ?>
			<a href="index.php">Tillbaka</a>

            <script language="JavaScript">
            function toggle(source) {
                checkboxes = document.getElementsByName('mark[ ]');
                for(var i=0, n=checkboxes.length;i<n;i++) {
                    checkboxes[i].checked = source.checked;
                }
            }
            </script>
            <form action=" <?php $_SERVER['PHP_SELF'] ?> " method="post">
			<table>
				<tr>
					<td>
						<!-- Markera alla skattningar, Behöver funktion?-->
						Markera alla: <input type="checkbox" name="mark[ ]" onClick="toggle(this)" value="Markera alla">
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
                <table cellspacing="10">
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
                //$arrcount < 7;
                $topcount = 0;
                    foreach ($tKeys as $tKey) {
                        $checkbox = '<input type="checkbox" name="mark[ ]" value="' . $tKey . '">';

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

                        if (!isset($result[6])) { $result[6] = '-'; }
                        if (!isset($result[7])) { $result[7] = '-'; }

                        $result[] = '<input type="hidden" name="s_key[]" value="' . $sKeys . '">';

                        echo '<tr>';

                        foreach ($result as $values) {
                            echo '<td>';
                            echo $values;
                            echo '</td>';
                        }
                        echo '</tr>';

                        $topcount++;
                    }

                ?>
				</table>
            </form>
    <?php
        }
        else {

            $resultsToDeploy = $_POST['mark'];

            $sKeys = array();
            foreach ($resultsToDeploy as $resultTkey) {
                $sKeys = getSkeys($resultTkey);
            }

            foreach ($sKeys as $sKey) {
                exportResult($sKey);
                deleteResult($sKey);
                deleteAnswer($sKey);
            }

            $resultCount = count($sKeys);
            if ($resultCount == 1) {
				echo '<a href="index.php">Index</a>';
                echo '<h3>Skattningen är nu skickad till journalsystemet.</h3>';
            } else {
				echo '<a href="index.php">Index</a>';
                echo '<h3>Skattningarna är nu skickade till journalsystemet.</h3>';
            }
        }
    ?>
			</div>
		</div>
	</body>
	<footer>
        <small><p>Skapad av Magnus Ulenius, Axel Jonsson, <br /> Johannes Swenson, Pietro Mattei och Johan Bergström. <br /><br />
            &copy; 2015</p></small><br />
        <a href="v_logout.php">Logga ut</a>
    </footer>
</html>
