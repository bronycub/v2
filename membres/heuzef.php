<?php //INFOS DU MEMBRES

$pseudo="Heuzef";
$gravatar="c0f08ae603e364cb554fe71c9fc94ffd";
$prenom="Florent";
$nom="Heuzé";
$naissance="05/07/1990";
$url="";
$bio="Fondateur du collectif BronyCUB, Florent est ce que l'on appelle un Geek. Avec le soutien de l'association <a href='http://www.mandora.fr' target='_blank'>Mandora</a>, il a créé ce collectif suite aux difficultés rencontrées par les Bronies habitants la CUB à se regrouper et organiser des rencontres. Florent vit à Bordeaux depuis plusieurs années, où il à commencer <a href='http://www.heuzef.com' target='_blank'>sa carrière dans l'informatique</a>, il découvrit également une forte passion pour l'<a href='http://www.campus-aikido.fr' target='_blank'>Aïkido</a>.";
$pony="<img src='img/ponies/12.png' class='img-circle'>&nbsp;&nbsp;&nbsp;<span class='label label-info'>Derpy Hooves is best pony !</span>&nbsp;&nbsp;<img src='img/ponies/76.png' class='img-circle'>&nbsp;&nbsp;&nbsp;<span class='label label-info'>Brushie Brushie Brushie !</span>";
?>		



<div class="list-group-item">
  <table class="table table-striped table-hover">
    <tr>
      <td width="20%">
        <p align="left"><img src="http://fr.gravatar.com/avatar/<?php echo $gravatar; ?>?s=100" alt="" class="img-rounded img-responsive"></p>
      </td>
      <td width="30%">
        <h2 align="left"><?php echo $pseudo; ?></h2>
        <h5 align="left"><?php echo $prenom."&nbsp;".$nom ; ?></h5>
        <h5><?php echo $naissance; ?></h5>
      </td>
      <td width="50%">
        <div class="None" align="right">
          <a href="skype:alexouil4?call" target="_blank" class="zocial icon skype"></a>
          <a href="http://www.youtube.com/channel/UCqX2vIbM82qFLaqyg0studw/videos?view=1&feature=guide" target="_blank" class="zocial icon youtube"></a>
          <a href="https://plus.google.com/100034201101510718430" target="_blank" class="zocial icon googleplus"></a>
          <br />
          <a href="https://twitter.com/RagatorStilwell" target="_blank" class="zocial icon twitter"></a> 
          <a href="https://www.facebook.com/Ragator" target="_blank" class="zocial icon facebook"></a>
          <a href="http://alexouil4.deviantart.com" target="_blank" class="zocial icon disqus"></a>
          <br />
          <a href="http://ragator.tumblr.com" target="_blank" class="zocial icon tumblr"></a>
          <a href="http://steamcommunity.com/profiles/76561198025372514?l=french" target="_blank" class="zocial icon steam"></a>
          <a href="http://www.betaseries.com/membre/Ragator" target="_blank" class="zocial icon googleplay"></a>
        </div>
      </td>
    </tr>
  </table>
  <table class="table table-striped table-hover">
    <tr>
      <td width="100%">
        <div class="expandable">
          <p>
            <?php echo $bio; ?>
            <br /><br />
            <?php echo $pony; ?>
          </p>
        </div>
      </td>	
    </tr>
  </table> 
</div>
<br />