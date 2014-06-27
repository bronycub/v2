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
	<div id="WhenIm"></div>
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
								<h4>Un Brony ? Ça ce mange ? Kécéssé ?</h4>
								<iframe width="540" height="320" src="//www.youtube.com/embed/Y67pwC9iOBw" frameborder="0" allowfullscreen></iframe>
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
			<h2>Tchat - <small><a href="https://kiwiirc.com/client?settings=3ebf3eb7a40c2b03f47b918eb2f7087a">Nous rejoindre</a></small></h2>
			<div class="jumbotron">
				<?php
					$_match=array("/(.*(kick|ban).*)\n/",	// Kicks/bans
												"/(&lt;[a-zA-Z0-9\-_]*&gt;)/",	// Pseudos
												"/(.*\*\*\*.*)\n/");	// Annonces d'IRC
					$_replace=array('<span class="text-warning">${1}</span>'."\n",
													'<span class="text-primary">${1}</span>',
													'<span class="text-info">${1}</span>'."\n");
					$buffer = file_get_contents("http://www.art-software.fr/files/lastlog_bronycub.php");	// Récupère le log
					$buffer = preg_replace($_match, $_replace, $buffer);
					echo "$buffer";
				?>
			</div>
		</div>
	</div>
<?php include 'footer.php'; ?>
