<?php include 'header.php'; ?>
	<div class="contenair">
		<p align="center">
			<img src="ressources/logo/logo_bronycub_hd.png" alt="logo_bronycub" height="200" width="600">
		</p>
		<div align="center" class="quotes">
			 <blockquote>
				 <?php
				 	$fichier = file('quotes.txt');
				 	$total = count($fichier);
				 	$i = mt_rand(0, $total-1);
				 	echo $fichier[$i];
				 ?>
			 </blockquote>
		</div>
	</div>
	<hr />
	<div class="container">
		<div class="col-md-6">
			<h2>BronyCUB, Qu'est-ce que c'est ?</h2>
			<div class="jumbotron">
				<article>
					BronyCUB est un collectif de Bronies <a href="http://espace-numerique.fr/le-mouvement-brony" target="_blank">(?)</a> de la Communauté Urbaine de Bordeaux en Gironde.<br />
					Ce collectif a pour ambition de réunir les fans pour organiser divers Meet-up.
				</article>
				<br />
				<p align="center">
					<a href="https://plus.google.com/u/0/104553540007842899140" data-toggle="tooltip" data-placement="top" title="Google+" target="_blank"><i class="fa fa-google-plus-square fa-1x"></i>Google+</a>&nbsp;&nbsp;&nbsp;
					<a href="https://twitter.com/bronycub" data-toggle="tooltip" data-placement="top" title="Twitter" target="_blank"><i class="fa fa-twitter-square fa-1x"></i>Twitter</a>&nbsp;&nbsp;&nbsp;
					<a href="https://www.facebook.com/Bronycub" data-toggle="tooltip" data-placement="top" title="Facebook" target="_blank"><i class="fa fa-facebook-square fa-1x"></i>Facebook</a>&nbsp;&nbsp;&nbsp;
				</p>
			</div>
		</div>
		<div class="col-md-6">
			<a class="twitter-timeline" href="https://twitter.com/Bronycub" data-widget-id="443418858905296896">Tweets de @Bronycub</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
	</div>
<?php include 'footer.php'; ?>