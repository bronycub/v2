<?php
if ($handle = opendir('.')) {
    while (false !== ($entry = readdir($handle))) {
	if ($entry != "." && $entry != ".." && $entry != "index.php") {
			if ($sub_handle = opendir($entry)) { 
				while (false !== ($sub_entry = readdir($sub_handle))) { 
				if ($sub_entry != "." && $sub_entry != "..") { 
				echo '<p><a href="'.$entry.'/'.$sub_entry.'">'.$sub_entry.'</a></p>';
				}
			    }
			    closedir($sub_handle);
			}
	}
    }
    closedir($handle);
}
?>


<?php include 'header.php'; ?>

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