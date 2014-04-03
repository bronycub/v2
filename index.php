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
			<div class="jumbotron">
				<!-- Question -->
				<a class="linkhome" data-toggle="modal" data-target="#modal">BronyCUB, Qu'est-ce que c'est ?</a>
					<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h4 class="modal-title" id="myModalLabel">BronyCUB, Qu'est-ce que c'est ?</h4>
					      </div>
					      <div class="modal-body">
					      	BronyCUB est un collectif de Bronies de la <strong>C</strong>ommunauté <strong>U</strong>rbaine de <strong>B</strong>ordeaux en Gironde. <br />
					      	Ce collectif a pour ambition de réunir les fans pour organiser diverses rencontres.
					      </div>
					    </div>
					  </div>
					</div>
				<!-- /Question -->
				<hr />
				<!-- Question -->
				<a class="linkhome" data-toggle="modal" data-target="#modal">Lorem ipsum dolor sit.</a>
					<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h4 class="modal-title" id="myModalLabel">Lorem ipsum dolor sit.</h4>
					      </div>
					      <div class="modal-body">
					      	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius, quibusdam?
					      </div>
					    </div>
					  </div>
					</div>
				<!-- /Question -->
				<hr />
				<!-- Question -->
				<a class="linkhome" data-toggle="modal" data-target="#modal">Lorem ipsum dolor sit.</a>
					<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h4 class="modal-title" id="myModalLabel">Lorem ipsum dolor sit.</h4>
					      </div>
					      <div class="modal-body">
					      	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius, quibusdam?
					      </div>
					    </div>
					  </div>
					</div>
				<!-- /Question -->
				<hr />
				<!-- Question -->
				<a class="linkhome" data-toggle="modal" data-target="#modal">Lorem ipsum dolor sit.</a>
					<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h4 class="modal-title" id="myModalLabel">Lorem ipsum dolor sit.</h4>
					      </div>
					      <div class="modal-body">
					      	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius, quibusdam?
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