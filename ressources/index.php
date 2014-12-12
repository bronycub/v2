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
	<div class="container">
		<div class="span3"></div>
		<div class="span6">
			<a href="http://bronycub.org"><img src="http://bronycub.org/ressources/logo/logo_bronycub_min.png" /></a>
			<h3>Ressources Graphiques</h3>
			<hr />
			<?php
			if ($handle = opendir('.')) {
			    while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != ".." && $entry != "index.php") {
				    echo '
	<!-- PANEL START -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">'.$entry.'</a></h3>
		</div>
		<div class="panel-body">

';
						if ($sub_handle = opendir($entry)) {
							while (false !== ($sub_entry = readdir($sub_handle))) {
							if ($sub_entry != "." && $sub_entry != ".." && $sub_entry != "index.php") {
							echo '<p>➵&nbsp;<a href="'.$entry.'/'.$sub_entry.'">'.$sub_entry.'</a></p>';
							}
						    }
						    closedir($sub_handle);
						}
echo '
		</div>
	</div>
	<hr />
	<!-- PANEL END -->
';
				}
			    }
			    closedir($handle);
			}
			?>
		</div>
		<div class="span3"></div>
	</div>
</body>
</html>
