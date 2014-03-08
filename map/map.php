<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>BronyCUB</title>
	<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../BootStrap/css/bootstrap.css"> 
  <link rel="stylesheet" type="text/css" href="../BootStrap/css/footer.css">
</head>
<body>

	<?php include '../menu.php'; ?>
<div class="container">
<p align="left">
  
  <img src="../ressources/logo/logo_bronycub_hd.png" alt="" width="800" height="200">
</p>
  </div> 
<hr>


<script src="http://maps.googleapis.com/maps/api/js?sensor=false&v=3.exp"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.gmap.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$("#responsive_map").gMap({
		 maptype: google.maps.MapTypeId.ROADMAP, 
		 zoom: 11, 
		 markers: [{
			 latitude: 44.837789, 
			 longitude: -0.5791799999999512, 
			 html: "<img src='http://yava.ro/images/logo.png' width='147' height='29'><br/>Your address or description here.<br><strong>Drag the marker anywhere!</strong>", 
			 popup: false, 
			 flat: true, 
			 icon: { 
				 image: "icons/zoo.png", 
				 iconsize: [32, 37], 
				 iconanchor: [15, 30], 
				 shadow: "icons/icon-shadow.png", 
				 shadowsize: [32, 37], 
				 shadowanchor: null}
				} 
			], 
		 panControl: false, 
		 zoomControl: true, 
		 mapTypeControl: false, 
		 scaleControl: false, 
		 streetViewControl: true, 
		 scrollwheel: false, 
		 styles: [ { "stylers": [ { "hue": "#7c2bb4" }, { "gamma": 1.58 } ] } ], 
		 onComplete: function() {
			 // Resize and re-center the map on window resize event
			 var gmap = $("#responsive_map").data('gmap').gmap;
			 window.onresize = function(){
				 google.maps.event.trigger(gmap, 'resize');
				 $("#responsive_map").gMap('fixAfterResize');
			 };
		}
	});
});
</script>
<div id="responsive_map"></div>
<style type="text/css">
#responsive_map {height: 1080px; width: 100%;}
#responsive_map div {-webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px;}
.gm-style-iw {max-width: none !important; min-width: none !important; max-height: none !important; min-height: none !important; overflow-y: hidden !important; overflow-x: hidden !important; line-height: normal !important; padding: 5px !important; }
</style>

	<?php include '../footer.php'; ?>
</body>
</html>
