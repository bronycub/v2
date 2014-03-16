<?php include 'header.php'; ?>
	<div align="center" class="container-fluid">
		<a href="event.php"><button type="button" class="btn btn-primary btn-lg">Organiser un &eacute;venement</button></a>
		<hr />
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3"></div>

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

			<div class="col-md-3"></div>
		</div>
	</div>
<?php include 'footer.php'; ?>
