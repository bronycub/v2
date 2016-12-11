<div class="container">
  <div class="col-lg-12">
    <h2><i class="fa fa-comments-o fa-1x"></i> Contact</h2>

    <ul class="nav nav-tabs">
      <li class="active"><a href="#mailinglist" data-toggle="tab" aria-expanded="true"><i class="fa fa-envelope fa-1x"></i> Mailing List</a></li>
      <li class=""><a href="#agenda" data-toggle="tab" aria-expanded="false"><i class="fa fa-calendar fa-1x"></i> Agenda</a></li>
      <li class=""><a href="#carte" data-toggle="tab" aria-expanded="false"><i class="fa fa-map-marker fa-1x"></i> Carte</a></li>
      <li class=""><a href="#irc" data-toggle="tab" aria-expanded="false"><strong>#</strong> IRC</a></li>
      <li class=""><a href="#discord" data-toggle="tab" aria-expanded="false"><i class="fa fa-commenting fa-1x"></i> Discord</a></li>
      <li class=""><a href="#visio" data-toggle="tab" aria-expanded="false"><i class="fa fa-video-camera fa-1x"></i> Visio</a></li>
      <li class=""><a href="#mumble" data-toggle="tab" aria-expanded="false"><i class="fa fa-microphone fa-1x"></i> Mumble</a></li>
      <li class=""><a href="#mc" data-toggle="tab" aria-expanded="false"><i class="fa fa-square fa-1x"></i> Minecraft</a></li>
    </ul>

    <div id="TchatContent" class="tab-content">
      <div class="tab-pane fade active in" id="mailinglist">
        <p>
          La Mailing List (Liste de Diffusion) permet de communiquer les informations importantes lié à la vie du collectif. C'est notre 1er moyen de communication !
        </p>
        <p>
          Elle permet de s’organiser et de se tenir au courant de tous les évènements faits par le collectif et surtout de contacter le collectif directement dans son intégralité.<br />
          Centraliser nos communications impotantes par e-mail répond à notre besoin de neutralité car nous avons certitude que tout les membres disposent d’une adresse e-mail.
        </p>
        <p>
          Il est important de mettre en place un filtre dans votre boite e-mail avec le mot clef <em>[BronyCUB]</em> pour gérer efficacement le flux de messages (environ un millier par an).<br />
          Si vous ne savez pas comment créer un filtre, voici un <a href="https://www.youtube.com/watch?v=bTiDLK9naPQ">exemple avec Gmail</a> mais <strong>n'hésitez surtout pas à demander de l'aide !</strong>
        </p>
        <p>
          <span class="label label-info">Gestionnaire : Shinsaber</span>
        </p>
      </div>

      <div class="tab-pane fade" id="irc">
        <p>
          Salon de conversation libre. Ce Tchat permet aux membres de BronyCUB ou autre de venir discuter de manière pratique et simple.
        </p>
        <p>
          Berry-Punch, notre mascotte, est là pour modérer le salon et nous y sommes présents pour répondre à toutes vos questions !
        <p>
        <p>
          <a href="https://kiwiirc.com/client?settings=3ebf3eb7a40c2b03f47b918eb2f7087a" class="btn btn-info">Cliquez ici pour rejoindre #bronycub sur irc.freenode.net</a>
        </p>
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
        <span class="label label-info">Gestionnaire : Electron</span>
      </div>

      <div class="tab-pane fade" id="discord">
        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
        <p>
          <a href="https://discordapp.com" class="btn btn-info">https://discordapp.com</a>
        </p>
        <span class="label label-info">Gestionnaire : SalmonRagnar</span>
      </div>

      <div class="tab-pane fade" id="visio">
        <p>
          Si besoin, vous avez à votre disposition un outil de visio très simple à exploiter pour discuter à plusieurs.<br/>
          Il suffit de se rendre sur <a href="https://vroom.im/bronycub">vroom.im/bronycub</a>
        </p>
        <div class="alert alert-dismissible alert-success">
          <strong><i class="fa fa-info fa-1x"></i> Astuce :</strong> Le lien <a href="https://vroom.im/bronycub?video=false">vroom.im/bronycub<strong class="text-danger">?video=false</strong></a> désactive votre webcam.
        </div>
        <span class="label label-info">Gestionnaire : Heuzef</span>
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
        <span class="label label-info">Gestion automatisé par SugarCUB</span>
      </div>

      <div class="tab-pane fade" id="carte">
        <p>
          La carte des membres vous permet simplement d’avoir une vision géographique des Bronies de la CUB et ainsi vous appercevoir que votre voisin est un Brony ;)
        </p>
        <p>
          Nos amis du site d’information <a href="http://leponeyblanc.fr">Le Poney Blanc</a>, disposent également d’une carte similaire, à l'échelle de la France entière : <a href="http://carte.leponeyblanc.fr">carte.leponeyblanc.fr</a>
        </p>
        <span class="label label-info">Gestion automatisé par SugarCUB</span>
      </div>

      <div class="tab-pane fade" id="mc">
        <p>
          Le petit jeu de Lego dématérialisé n'a pas échappé à la vague de petits poneys tout roses ! Et c'est pour cela que notre collectif possède son propre serveur Minecraft !
        </p>
        <p>
          Pour pouvoir jouer, il faut faire une demande à Électron ( <em><a href="mailto:support@art-software.fr">support@art-software.fr</a></em> ) qui vous expliquera le fonctionnement du serveur.<br />
        <p>
        <p>
          <ul>
            <li>L'adresse : mc.bronycub.org:25565</li>
            <li>La version : 1.8.8</li>
            <li>Type : survie, créatif, et basiquement à peu près ce que vous voulez (système à plusieurs cartes avec des passages entre les cartes)</li>
          </ul>
        </p>
        <span class="label label-info">Gestionnaire : Electron</span>
      </div>

      <div class="tab-pane fade" id="mumble">
        <p>
          Mumble est un logiciel libre de voix sur IP (VoIP), son principal usage étant la communication pendant les parties de jeux en réseau.
        </p>
        <p>
          Pour pouvoir utiliser le service, il faut faire une demande à Électron ( <em><a href="mailto:support@art-software.fr">support@art-software.fr</a></em> ) qui vous expliquera le fonctionnement du serveur.<br />
        <p>
        <p>
          <ul>
            <li>L'adresse : mumble.bronycub.org (même serveur), port 64738</li>
            <li>Le pseudo est libre.</li>
          </ul>
        </p>
        <span class="label label-info">Gestionnaire : Electron</span>
      </div>
      </div><!-- End TchatContent -->
  </div>
</div>
