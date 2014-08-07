<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="robots" content="index,follow" />
	<meta name="keywords" content="cub, bronycub.org, heuzef, heuzé, florent, brony, bronie, bronies, pegasister, pegasisters, bordeaux, bordeau, bordo, bordau, bordaux, 33000, 33, gironde, cub, communaute, urbaine, collectif, france, aquitaine, gironde, sud-ouest, mlp, fim, my, little, pony, friendship, is, magic, fan, fans, french, vostfr, fr" />
	<meta name="description" content="BronyCUB" />
	<meta name="author" content="Heuzé Florent" />
	<title>BronyCUB</title>
	<link href="http://bronycub.org/css_global/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" type="image/png" href="http://bronycub.org/ressources/logo/favicon_bronycub.png" />
</head>

<body>
	<div class="span6">
		<a href="http://bronycub.org"><img src="http://bronycub.org/ressources/logo/logo_bronycub_min.png" /></a>
		<h3>Ressources</h3>
		<p><blockquote>
			<ul class="short arrow">
				<?php
				$folder = "./";
				$dossier = scandir($folder);
                foreach ($dossier as $fichier) {
				  if ($fichier != "." AND $fichier != ".." AND $fichier != "index.php" AND $fichier != ".htaccess" ) {
					echo "<li><a href='./".$fichier."'>".$fichier."</a></li>";
				  }
				}
				?>
			</ul>
		</blockquote></p>
	</div>
</body>
</html>