<?php include 'header.php'; ?>

<?php
// compter le nombre de membres
$f = 0;
foreach(glob('*.php') as $f) {$f+=1;}
$nb_membres = count(glob('./membres/*.php'));
?>

<?php
	$folder = "membres";
	$dossier = opendir($folder);
	echo "<div class='container'>";
	while ($fichier = readdir($dossier))
	{
		if ($fichier != "." && $fichier != ".." )
		{
			$user = explode(".php", $fichier);
			echo "<div class='col-lg-6'>";
			include ("membres/".$user[0].".php");
			echo "</div>";
		}
	}
	closedir($dossier);
	echo "</div>";
?>

<?php include 'footer.php'; ?>