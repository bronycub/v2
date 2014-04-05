<?php include 'header.php'; ?>
	<div class="contenair">
		<p align="center">
			<img src="ressources/logo/logo_bronycub.png" alt="logo_bronycub" height="200" width="600" class="img-responsive">
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
								<h4>Question</h4>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer venenatis sapien eu ullamcorper mattis. Suspendisse ac egestas nibh. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tristique tempor eleifend. Sed quis lorem quis velit facilisis ornare. Etiam tempor porttitor purus, non aliquet magna mattis sed. Donec tincidunt turpis tempus, suscipit arcu a, porttitor sapien.
								<hr />
								<h4>Question</h4>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer venenatis sapien eu ullamcorper mattis. Suspendisse ac egestas nibh. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tristique tempor eleifend. Sed quis lorem quis velit facilisis ornare. Etiam tempor porttitor purus, non aliquet magna mattis sed. Donec tincidunt turpis tempus, suscipit arcu a, porttitor sapien.
								<hr />
								<h4>Question</h4>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer venenatis sapien eu ullamcorper mattis. Suspendisse ac egestas nibh. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tristique tempor eleifend. Sed quis lorem quis velit facilisis ornare. Etiam tempor porttitor purus, non aliquet magna mattis sed. Donec tincidunt turpis tempus, suscipit arcu a, porttitor sapien.
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
