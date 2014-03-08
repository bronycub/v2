<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Agenda</title>
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="BootStrap/css/bootstrap.css"> 
 	<link rel="stylesheet" type="text/css" href="BootStrap/css/footer.css">

	<link rel="stylesheet" type="text/css" media="screen" href="agenda/calendar/css/smoothness/jquery-ui-1.8.23.custom.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="agenda/calendar/css/calendar.css" />

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="agenda/calendar/js/jquery-ui-1.8.23.custom.min.js"></script>
	<script type="text/javascript" src="agenda/calendar/js/calendar.min.js"></script>

</head>
<body>

	<?php include 'menu.php'; ?>

	<div class="container-fluid">
		<div class="row">
		 <div class="col-md-2">
		</div>

		 <div class="col-md-8">
			<?php
		
			require_once('agenda/calendar/class/calendar.class.php');
			require_once('agenda/calendar/class/ical.class.php');

			$cal = new Calendar(array(
			'url' 			=> "https://www.google.com/calendar/ical/bronycub%40gmail.com/public/basic.ics" ,
			'scale'       		 => 'year' ,
			'date_day_addition' 	=> false ,
			));

			 $cal->output(); 

			?>
		</div>

		 <div class="col-md-2">
		</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>
</body>
