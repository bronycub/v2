<?php include 'header.php'; ?>

<?php
// compter le nombre de membres
$f = 0;
foreach(glob('*.php') as $f) {$f+=1;}
$nb_membres = count(glob('./membres/*.php'));
?>

<?php
// if ($handle = opendir('membres'))
// 	{
// 		while (false !== ($entry = readdir($handle)))
// 		{
// 			if ($entry != "." && $entry != ".." && $entry != "index.php")
// 			{
// 				if ($handle = opendir($entry))
// 				{ 
// 					while (false !== ($entry = readdir($handle)))
// 					{ 
// 						if ($entry != "." && $entry != "..")
// 						{ 
// 							echo '<p><a href="'.$entry.'/'.$entry.'">'.$entry.'</a></p>';
// 						}
// 					}
// 				closedir($handle);
// 				}
// 			}
// 		}
// 	closedir($handle);
// 	}
?>

<?php echo "Il y à ".$nb_membres." membres";?>


<div class="container">

	<div class="col-lg-6">
		<?php include 'membres/heuzef.php'; ?>
	</div>

	<div class="col-lg-6">
		<?php include 'membres/heuzef.php'; ?>
	</div>

</div>

<div class="container">

	<div class="col-lg-6">
		<?php include 'membres/heuzef.php'; ?>
	</div>

</div>

<?php include 'footer.php'; ?>