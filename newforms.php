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
						<button id="export">Skicka till journal</button>
					</td>	
				</tr>	
			</table>	
			<!-- Loop som hämtar varje skattning till tabell nedan? -->
			<div class="grey-bg" id="inkommen">
				<table>
					<tr>
						<td>
							[Datum]
						</td>
						<td>
							[Namn]
						</td>
						<td>
							[Skattning 1]
						</td>
						<td>
							[Skattning 2]
						</td>
						<td>
							[Skattning 3]
						</td>
						<td>
							<!-- Behöver funktion för att markera?-->	
							<input type="checkbox" name="mark" value="Markera">
						</td>
					</tr>
				</table>
			</div>
		</div>	
	</body>
	<footer>
        <p>Skapad av oss</p>
    </footer>
</html>