	<body>
	<html>	
	
	<?php include 'header.php'; ?>
	<div class="contenair">

  
  
  <p align="center"> <img src="ressources/logo/logo_bronycub_hd.png" alt="" height="200" width="600"></p>
 <div align="center" class="quotes">
 <blockquote>
 	<?php $fichier = file('quotes.txt'); // Nom du fichier qui contient les citations

$total = count($fichier); // Total du nombre de lignes du fichier

$i = mt_rand(0, $total-1); // Nombre au hasard entre 0 et le total du nombre de lignes

echo $fichier[$i]; // On affiche une citation au hasard

 ?>
 </blockquote>
 </div>
 </div>
 

</div> 
<hr>
	
	<div class="container">
	<div class="col-md-6">
	<h2>BronyCUB, Qu'est-ce que c'est ?</h2>
	<div class="jumbotron">
		<article>BronyCUB est un collectif de Bronies de la Communauté Urbaine de Bordeaux en Gironde.
Ce collectif a pour ambition de réunir les fans pour organiser divers Meet-up</article>
</br>
	<button type="button" class="btn btn-info btn-lg">Nous contacter</button>
	</div>
	</div>
		<div class="col-md-6">
		<a class="twitter-timeline"  href="https://twitter.com/Bronycub"  data-widget-id="442332182942449664">Tweets de @Bronycub</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>
		
	</div>
	<?php include 'footer.php'; ?>
</body>
</html>
