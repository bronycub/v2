 <?php include 'header.php'; ?>
  	<div align="center" class="container-fluid">
		 		<a href="event.php"><button type="button" class="btn btn-primary btn-lg">Organiser un &eacute;venement</button></a>
				 		<hr />
						 	</div>
							 	<div class="container-fluid">
								 		<div class="row">
										 			<div class="col-md-3"></div>

 			 <div class="col-md-6">
          <br /><br />
          <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <i class="fa fa-info-circle fa-1x"></i>&nbsp;Des sessions de JDR ont lieu, chaque samedi après-midi au <a href="qg.php" class="alert-link">QG</a> avec nos amis de chez <a href="http://www.dragonstresorsetcontes.org" class="alert-link">DTC</a> !
          </div>
 				<?php
 				require_once('script/calendar/class/calendar.class.php');
 				require_once('script/calendar/class/ical.class.php');

				 				$cal = new Calendar(array(
									 				'url' 			=> "https://www.google.com/calendar/ical/bronycub%40gmail.com/public/basic.ics" ,
													 				'scale'       		 => 'year' ,
																	 				'date_day_addition' 	=> false ,
																					+				'time_format' 				=> 24,
																					+				'social_links' 				=> false,
																					 				));

				 				 $cal->output();
				 				?>
 			</div>

 			<div class="col-md-3"></div>
 		</div>
 	</div>
 <?php include 'footer.php'; ?>
