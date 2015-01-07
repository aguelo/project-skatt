<?php
    include('db_connection.php');
    require('functions.php');
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
        <div class="main">
            <div class="container">
                <h2>Heading!</h2>
                <p>
                <?php

                if (isset($_POST['start'])) {
                    session_start();
                    $thisFormKey = $_POST['this_form_key'];
                    //$_SESSION['this_form_key'] = $thisFormKey;
                    $thisFormIndex = $_POST['this_form_index'];
                    //$_SESSION['this_form_index'] = $thisFormIndex;

                    echo 'index: ' . $thisFormIndex;
                    echo '<br />';
                    echo 'key: ' . $thisFormKey;
                    echo '<br />';

                    $i = $thisFormIndex;
                    $j = 0;
                    echo '<h3>' . $_SESSION['form_names'][$i] . ' </h3><br />';
                    echo '<form action="incoming.php" method="post">';
                    // Loopa frågor
                    while ($j < 10) {

                        getQs($_SESSION['form_keys'][$i]);

                        // Rubrik
                        echo '<h4>' . $_SESSION['q_string'][$j] . '</h4>';
                        echo '<br />';

                        // Hämta alternativ
                        getAlts($_SESSION['form_keys'][$i],$_SESSION['q_key'][$j]);
                        for ($m=0; $m < 4; $m++) {

                            echo '<input type="radio" name="' . $_SESSION['q_key'][$j] . '" value="' . $_SESSION['alt_key'][$m] . '" ><label for="' . $_SESSION['q_key'][$j] . '">' . $_SESSION['alt_string'][$m] . ' </label>';
                        }
                        $j++;
                    }
                    echo '<input type="hidden" name="this_form_index" value="' . ($thisFormIndex) . '">';
                    echo '<input type="hidden" name="this_form_key" value="' . ($thisFormKey) . '">';
                    echo '<input type="submit" name="skicka" value="Skicka skattning">';
                    echo '</form>';
                }
                ?>
                </p>
            </div>
        </div>
    </body>
<footer>
   <p>Skapad av oss</p>
</footer>
</html>
