<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="robots" content="index,follow" />
	<meta name="keywords" content="cub, bronycub.org, heuzef, heuzé, florent, brony, bronie, bronies, pegasister, pegasisters, bordeaux, bordeau, bordo, bordau, bordaux, 33000, 33, gironde, cub, communaute, urbaine, collectif, france, aquitaine, gironde, sud-ouest, mlp, fim, my, little, pony, friendship, is, magic, fan, fans, french, vostfr, fr" />
	<meta name="description" content="BronyCUB" />
	<meta name="author" content="Heuzé Florent" />
	<title>BronyCUB</title>
	<link href="http://bronycub.org/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="http://bronycub.org/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="http://bronycub.org/bootstrap/css/zocial.css" />
	<link rel="shortcut icon" type="image/png" href="http://bronycub.org/ressources/logo/favicon_bronycub.png" />
	<script src="http://bronycub.org/bootstrap/js/jquery-2.0.3.min.js"></script> 
	<script src="http://bronycub.org/bootstrap/js/bootstrap.js "></script>
	<script>
	$(function (){
		$('a').tooltip();
	});
	$(function (){
		$("#pop").popover({placement:'bottom', trigger:'hover'});
	});
	</script>
	<link rel="stylesheet" type="text/css" href="http://bronycub.org/ressources/bootstrap-fileupload.css">
	<script type="text/javascript" src="http://bronycub.org/ressources/bootstrap-fileupload.js"></script>
</head>

<body>

	<div class="span6">
		<a href="http://bronycub.org"><img src="http://bronycub.org/ressources/logo/logo_bronycub_min.png" /></a>
		<h3>Ressources</h3>
		<p><blockquote>
			<ul class="short arrow">
				<?
				$folder = "./";
				$dossier = opendir($folder);
				while ($fichier = readdir($dossier)) {
				  if ($fichier != "." && $fichier != ".." && $fichier != "index.php" ) {
					echo "<li><a href='./".$fichier."'>".$fichier."</a></li>";
				  }
				}
				closedir($dossier);
				?>
			</ul>
		</blockquote></p>
	</div>
</body>
</html>
