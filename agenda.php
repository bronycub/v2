<head>

	<link rel="stylesheet" type="text/css" media="screen" href="calendar/css/smoothness/jquery-ui-1.8.23.custom.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="calendar/css/calendar.css" />

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="calendar/js/jquery-ui-1.8.23.custom.min.js"></script>
	<script type="text/javascript" src="calendar/js/calendar.min.js"></script>

</head>

<?php include 'header.php'; ?>
	<div class="container-fluid">
		<div class="row">
		 <div class="col-md-3">
		</div>

		 <div class="col-md-6">
			<?php
			require_once('calendar/class/calendar.class.php');
			require_once('calendar/class/ical.class.php');

			$cal = new Calendar(array(
			'url' 			=> "https://www.google.com/calendar/ical/bronycub%40gmail.com/public/basic.ics" ,
			'scale'       		 => 'year' ,
			'date_day_addition' 	=> false ,
			));

			 $cal->output(); 
			?>
		</div>

		<div class="col-md-3">
		</div>
		</div>
	</div>

<?php include 'footer.php'; ?>
