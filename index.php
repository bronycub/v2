<?php include 'header.php'; ?>
	<div class="contenair">
		<p align="center">
			<img src="./img/logo_min.png" alt="logo_bronycub" height="200" width="600" class="img-responsive">
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
					BronyCUB est un collectif de Bronies de la <strong>C</strong>ommunauté <strong>U</strong>rbaine de <strong>B</strong>ordeaux en Gironde.
					<br /><br />
					Ce collectif a pour ambition de réunir les fans pour organiser diverses rencontres.
					<br /><br />
				</article>
				
				<!-- Question -->
				<a data-toggle="modal" data-target="#modal"><button type="button" class="btn btn-primary btn-lg">Plus d'info ...</button></a>
					<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="plusinfos" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="plusinfos">Plus d'info ...</h4>
								</div>
								<div class="modal-body">
								<h4>BronyCUB, Qu'est-ce que c'est ?</h4>
								BronyCUB est un collectif de Bronies de la <strong>C</strong>ommunauté <strong>U</strong>rbaine de <strong>B</strong>ordeaux en Gironde.
								<br />
								Ce collectif a pour ambition de réunir les fans pour organiser diverses rencontres.
								<hr />
								<h4>Un Brony ? Ça ce mange ? Kécéssé ?</h4>
								Si vous ne conaissez pas encore le phénomène Brony, voici quelques vidéos pour vous aider à comprendre :
								<li><a href="http://youtu.be/YHiRycK6UD4" target="_blank">Reportage sur Direct 8</a></li>
								<li><a href="http://youtu.be/RiIOGaEMx-g" target="_blank">Des poneys et des hommes</a></li>
								<br />
								Si vous souhaitez en apprendre d'avantage sur le phénomène, nous vous conseillons de regarder les documentaires tel que :
								<li><a href="http://youtu.be/kgcWpnvyZeA" target="_blank">A Brony Tale</a></li>
								<li><a href="http://youtu.be/ohnuyqJyEW0" target="_blank">Bronies: The Extremely Unexpected Adult Fans of My Little Pony</a></li>
								<hr />
								<h4>Sérieusement ... Pourquoi ?</h4>
								<iframe width="540" height="320" src="//www.youtube.com/embed/pXYqLKko6Ss" frameborder="0" allowfullscreen></iframe>
								<hr />
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
								</div>
							</div>
						</div>
					</div>
				<!-- /Question -->
 
			</div>
		</div>
		<div class="col-md-6">
			<a class="twitter-timeline" href="https://twitter.com/Bronycub" data-widget-id="443418858905296896">Tweets de @Bronycub</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
	</div>
<?php include 'footer.php'; ?>
