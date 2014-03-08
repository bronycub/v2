<?php include 'header.php'; ?>

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
