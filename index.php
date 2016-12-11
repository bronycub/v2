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
			<div class="progress progress-striped active">
			  <div class="progress-bar progress-bar-success" style="width: <?php $sc_percent=shell_exec('./sugarcub_percent.sh'); echo $sc_percent; ?>"><span class="badge"><?php echo $sc_percent; ?></span></div>
			</div>
			<a href="https://gitlab.com/mdevlamynck/sugarcub/milestones/3" class="btn btn-success btn-xs">Plus d'infos sur l'avancement du projet ...</a>
		</div>
		<div class="col-lg-2">
		</div>
	</div>
	<br />
	<br />
	<hr />
	<div class="container">
		<div class="col-lg-12">
			<h2><i class="fa fa-comments-o fa-1x"></i> Contact</h2>

			<ul class="nav nav-tabs">
				<li class="active"><a href="#mailinglist" data-toggle="tab" aria-expanded="true"><i class="fa fa-envelope fa-1x"></i> Mailing List</a></li>
				<li class=""><a href="#irc" data-toggle="tab" aria-expanded="false"><i class="fa fa-slack fa-1x"></i> IRC</a></li>
				<li class=""><a href="#visio" data-toggle="tab" aria-expanded="false"><i class="fa fa-video-camera fa-1x"></i> Visio</a></li>
				<li class=""><a href="#agenda" data-toggle="tab" aria-expanded="false"><i class="fa fa-calendar fa-1x"></i> Agenda</a></li>
				<li class=""><a href="#carte" data-toggle="tab" aria-expanded="false"><i class="fa fa-map-marker fa-1x"></i> Carte</a></li>
				<li class=""><a href="#mc" data-toggle="tab" aria-expanded="false"><i class="fa fa-square fa-1x"></i> Minecraft</a></li>
			</ul>

			<div id="TchatContent" class="tab-content">
				<div class="tab-pane fade active in" id="mailinglist">
					<p>
						La Mailing List (Liste de Diffusion) permet de communiquer les informations importantes lié à la vie du collectif. C'est notre 1er moyen de communication !
					</p>
					<p>
						Elle permet de s’organiser et de se tenir au courant de tous les évènements faits par le collectif et surtout de contacter le collectif directement dans son intégralité.<br />
						Nous somme présents sur les réseaux sociaux et ils nous aident mais ne répondent pas autant à notre besoin de neutralité, en effet, tout le monde dispose d’une adresse e-mail, mais n'est pas forcément fan de Facebook et autre Twitter.
					</p>
					<p>
						Il est important de mettre en place un filtre dans votre boite e-mail avec le mot clef <em>[BronyCUB]</em> pour gérer efficacement le flux de messages (environ un millier par an).<br />
						Si vous ne savez pas comment créer un filtre, voici un <a href="https://www.youtube.com/watch?v=bTiDLK9naPQ">exemple avec Gmail</a> mais <strong>n'hésitez surtout pas à demander de l'aide !</strong>
					</p>
				</div>

				<div class="tab-pane fade" id="irc">
					<p>
						C’est un salon de conversation. Ce Tchat permet aux membres de BronyCUB ou autre de venir discuter de manière pratique et simple (c’est mieux que les mails pour la discussion rapide).
					</p>
					<p>
						Berry-Punch, notre mascotte, est là pour modérer le salon et nous y sommes présents pour répondre à toutes vos questions !
						<a href="https://kiwiirc.com/client?settings=3ebf3eb7a40c2b03f47b918eb2f7087a">Cliquez ici pour rejoindre #bronycub sur irc.freenode.net.</a>
					</p>
					<div class="alert alert-dismissible alert-info">
						<p>
							Si vous souhaitez discuter d'informatique, nous avons un second salon de conversation. Il suffit de taper /join #bronycub-g33k pour le rejoindre (ou de cliquer <a href="http://kiwiirc.com/client/chat.freenode.net/bronycub-g33k/">ici</a>).
						</p>
					</div>
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

				<div class="tab-pane fade" id="visio">
					<p>
						Si besoin, vous avez à votre disposition un outil de visio très simple à exploiter pour discuter à plusieurs. Il suffit de se rendre sur <a href="https://vroom.im/bronycub">vroom.im/bronycub</a>
					</p>
					<div class="alert alert-dismissible alert-success">
						<strong>Astuce :</strong> le lien <a href="https://vroom.im/bronycub?video=false">vroom.im/bronycub<strong>?video=false</strong></a> désactivera automatiquement votre webcam !
					</div>
				</div>

				<div class="tab-pane fade" id="agenda">
					<p>
						L’Agenda vous renseigne des futurs événements importants du collectif, il peut être synchronisé avec votre agenda Google, smartphone, etc…
					</p>
					<p>
						Si vous souhaitez organiser vous-même quelque chose, il vous suffira alors de cliquer sur <a href="agenda/evenement">organiser un événement</a> et de vous laisser guider !
					</p>
					<div class="alert alert-dismissible alert-warning">
						<strong>Important :</strong> Nous vous encourageons vivement à <strong>vous lancer</strong> pour organiser votre meet-up, atelier, projet, action humanitaire, …<br />
						C'est ce qui fait vivre le collectif et le rend aussi magique !<br />
						Vous ne vous en sentez pas capable ? C'est donc l'occasion parfaite de gagner confiance en vous, vous aurez beaucoup de soutien ici.
					</div>
				</div>

				<div class="tab-pane fade" id="carte">
					<p>
						La carte des membres vous permet simplement d’avoir une vision géographique des Bronies de la CUB et ainsi vous appercevoir que votre voisin est un Brony ;)
					</p>
					<p>
						Nos amis du site d’information <a href="http://leponeyblanc.fr">Le Poney Blanc</a>, disposent également d’une carte similaire, à l'échelle de la France entière : <a href="http://carte.leponeyblanc.fr">carte.leponeyblanc.fr</a>
						</p>
				</div>

					<div class="tab-pane fade" id="mc">
						<p>
							Le petit jeu de Lego dématérialisé n'a pas échappé à la vague de petits poneys tout roses ! Et c'est pour cela que notre collectif possède son propre serveur Minecraft !
						</p>
						<p>
							Pour pouvoir jouer, il faut faire une demande à Électron ( <em><a href="mailto:support@art-software.fr">support@art-software.fr</a></em> ) qui vous expliquera le fonctionnement du serveur MC et Mumble.<br />
						<p>
						<p>
							<h4>Le Minecraft</h4>
							<ul>
								<li>L'adresse : mc.bronycub.org:25565</li>
								<li>La version : 1.8.8</li>
								<li>Type : survie, créatif, et basiquement à peu près ce que vous voulez (système à plusieurs cartes avec des passages entre les cartes)</li>
							</ul>
						</p>
						<p>
							<h4>Le Mumble</h4>
							<ul>
								<li>L'adresse : mumble.art-software.fr <strong>ou</strong> mumble.bronycub.org (même serveur), port 64738</li>
								<li>Le pseudo est libre.</li>
							</ul>
						</p>
					</div>
				</div><!-- End TchatContent -->


		</div>
	</div>
<?php include 'footer.php'; ?>
