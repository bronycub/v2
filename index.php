<?php include 'header.php'; ?>
	<div>
		<p align="center">
			<img src="./img/logo_min.png" alt="logo_bronycub" height="200" width="600" class="img-responsive" />
		</p>
 		<div class="quotes">
            <?php

            $fichier = file('quotes.txt');
            $total = count($fichier);

            for ($i = 1; $i<=$total ; $i++)
            {
            ?>
			<blockquote class="textItem">
				 <?php
                    echo $fichier[$i - 1];
				 ?>
			</blockquote>
            <?php
            }
            ?>
		</div>
	</div>
    <br />
    <br />
    <hr />
	<div id="WhenIm"></div>
	<div class="container">
		<div class="col-lg-2">
		</div>
		<div class="col-lg-8">
			<p><img src="http://sugarcub.org/img/logo_sugarcub.png" alt="Logo SugarCUB" height="100" /></p>
			<a href="https://gitlab.com/mdevlamynck/sugarcub/milestones/3" class="btn btn-success btn-xs">Plus d'infos sur l'avancement du projet ...</a>
		</div>
		<div class="col-lg-2">
		</div>
	</div>
	<br />
	<br />
	<hr />
	<?php include 'contact.php'; ?>
<?php include 'footer.php'; ?>
