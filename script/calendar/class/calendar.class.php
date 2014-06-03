<?php
/**
 * 
 * Google Calendar Reader Class
 *
 * @version 1.4.0
 * @author  Rik de Vos (http://rikdevos.com)
 * @license Copyright (C) 2012 Rik de Vos. This is not free software!
 */
class Calendar {

	/**
	 * Version of the script
	 * @var string
	 */
	public $version = '1.6.0';

	/**
	 * Calendar settings
	 * @var array
	 */
	public $settings = array(
		'url' 						=> false,
		'cache' 					=> true,
		'cache_dir' 				=> 'calendar/cache/',
		'cache_token' 				=> 1,
		'cache_time' 				=> 86400,
		'excerpt_length' 			=> 35,
		'auto_title_width' 			=> true,
		'group_events_by_date' 		=> false,				//new in 1.4.0
		'group_events_animate' 		=> true,				//new in 1.4.0
		'scale' 					=> 'month',
		'scale_change' 				=> true,
		'date_change' 				=> true,
		'date_picker' 				=> true,				//new in 1.4.0
		'date_picker_keep_scale' 	=> false,				//new in 1.4.0
		'dst'						=> false,				//new in 1.4.0
		'social_links' 				=> true,
		'show_map_link' 			=> true,				//new in 1.4.0
		'search_form' 				=> true,				//new in 1.4.0
		'search_all_events' 		=> true,				//new in 1.4.0
		'time_format' 				=> 12,
		'extra_time' 				=> 0,
		'date_day_addition' 		=> true,
		'skin' 						=> 'light',
		'hyperlink_urls'			=> false,				//new in 1.5.0
		'day' 						=> false,
		'month' 					=> false,
		'year' 						=> false,
	);

	/**
	 * Labels for easy translation
	 * @var array
	 */
	public $labels = array(
		'day' 						=> 'Jour',
		'month' 					=> 'Mois',
		'year' 						=> 'Année',
		'map' 						=> 'map',
		'view_in_google_maps' 		=> 'Voir avec Google Maps',
		'tweet_event' 				=> 'Tweeter Evenement',
		'share_event' 				=> 'Partager Evenement',
		'no_events_on' 				=> 'Aucun évenement le ',
		'no_events_in' 				=> 'Aucun évenement à ',
		'all_day' 					=> 'JOURNEE ENTIERE',
		'events' 					=> 'Evenements',
		'event' 					=> 'Evenement',
		'months' 					=> array(
										'Janvier',
										'Fevrier',
										'Mars',
										'Avril',
										'Mai',
										'Juin',
										'Juillet',
										'Aout',
										'Septembre',
										'Octobre',
										'Novembre',
										'Decembre',
									),
	);

	/**
	 * Downloaded events in ICS format
	 * @var string
	 */
	public $ics = '';

	/**
	 * Type of the downloaded format
	 * @var string
	 */
	public $type = '';

	/**
	 * Downloaded events in XML format
	 * @var string
	 */
	public $xml = '';

	public $data = array();

	/**
	 * Calendar events
	 * @var array
	 */
	public $events = array();

	/**
	 * Errors occured
	 * @var boolean
	 */
	public $error = false;

	/**
	 * Dates when for date groups
	 * @var array
	 */
	public $dates =  array();
	
	/**
	 * Constructor function
	 * @return null
	 */
	function __construct($settings = array()) {

		if(!isset($settings['url'])) {
			echo '<strong>ERROR:</strong> Missing parameter \'url\'.';
			$this->error = true;
			return;
		}

		if(!is_array($settings['url'])) {
			$settings['url'] = array($settings['url']);
		}

		//Set today's dates
		$this->settings['day'] = (int)date('j');
		$this->settings['month'] = (int)date('n');
		$this->settings['year'] = (int)date('Y');

		$this->settings['search'] = (isset($_GET['cal_search'])) ? $_GET['cal_search'] : false;

		$this->settings['cache_token'] = $this->_generate_cache_token($settings['url']);

		//Set user settings
		foreach($settings as $key=>$option) {
			$this->settings[$key] = $option;
		}

		if(!is_array($settings['url'])) {
			$settings['url'] = array($settings['url']);
		}

		//Set GET settings, if allowed
		foreach($_GET as $key=>$value) {
			if($key === 'cal_scale' && $this->settings['scale_change']) {

				$this->settings[str_replace('cal_', '', $key)] = $value;

			}elseif($key === 'cal_day' || $key === 'cal_month' || $key === 'cal_year') {

				if($this->settings['date_change']) {
					$this->settings[str_replace('cal_', '', $key)] = $value;
				}

			}
		}

		if($this->settings['search_all_events'] && isset($_GET['cal_search']) && !empty($_GET['cal_search'])) {
			$this->settings['scale'] = 'year';
		}

		if($this->settings['group_events_by_date'] && $this->settings['scale'] === 'day') {
			$this->settings['group_events_by_date'] = false;
		}

		if($this->settings['search']) {
			$this->settings['group_events_by_date'] = false;
		}

		//Retrieve event data
		if(!$this->_get_cache()) {
			if(!$this->_retrieve_data()) {
				echo '<strong>ERROR:</strong> Failed to retrieve data from given URL.';
				$this->error = true;
				return false;
			}

			if(!$this->_parse_data()) {
				echo '<strong>ERROR</strong> Failed to parse data.';
				$this->error = true;
				return false;
			}

			if($this->settings['cache']) {
				$this->_save_cache();
			}
		}

	}

	/**
	 * Creates the HTML for the calendar
	 * @return void
	 */
	public function output() {

		if($this->error) { return; }

		$events = $this->_events_within_query($this->events);

		//print_r($events);
		$url = $this->_get_page_url();
		$day = (int)$this->settings['day'];
		$month = (int)$this->settings['month'];
		$year = (int)$this->settings['year'];
		$scale = $this->settings['scale'];

		$html = '';

		if($this->settings['time_format'] == 12) {
			$time_format = 'g:ia';
		}else {
			$time_format = 'G:i';
		}

		$html .= '<div class="cal_container cal_scale_'.$this->settings['scale'].(($this->settings['auto_title_width']) ? ' auto_title_width' : '').(($this->settings['skin']) ? ' cal_skin_'.$this->settings['skin'] : '').'"><div class="cal_header">';
		switch ($this->settings['scale']) {
			case 'day':
				$html .= '<h2 class="cal_month_name">'.date('F jS, Y', (mktime(0, 0, 0, $month, $day, $year))).'</h2>';
				
				if($this->settings['date_change']) {

					if($day === 1 && $month === 1) {
						$html .= '<a href="'.$url.'cal_day=31&cal_month=12&cal_year='.($year-1).'&cal_scale='.$scale.'" class="cal_previous_month"></a>';
					}elseif($day === 1) {
						$html .= '<a href="'.$url.'cal_day='.date('t', (mktime(0, 0, 0, $month-1, 1, $year))).'&cal_month='.($month-1).'&cal_year='.$year.'&cal_scale='.$scale.'" class="cal_previous_month"></a>';
					}else {
						$html .= '<a href="'.$url.'cal_day='.($day-1).'&cal_month='.$month.'&cal_year='.$year.'&cal_scale='.$scale.'" class="cal_previous_month"></a>';
					}

					if($day == date('t', (mktime(0, 0, 0, $month, 1, $year))) && $month === 12) {
						$html .= '<a href="'.$url.'cal_day=1&cal_month=1&cal_year='.($year+1).'&cal_scale='.$scale.'" class="cal_next_month"></a>';
					}elseif($day == date('t', (mktime(0, 0, 0, $month, 1, $year)))) {
						$html .= '<a href="'.$url.'cal_day=1&cal_month='.($month+1).'&cal_year='.$year.'&cal_scale='.$scale.'" class="cal_next_month"></a>';
					}else {
						$html .= '<a href="'.$url.'cal_day='.($day+1).'&cal_month='.$month.'&cal_year='.$year.'&cal_scale='.$scale.'" class="cal_next_month"></a>';
					}

				}
				
				break;
			
			case 'month':
				$html .= '<h2 class="cal_month_name">'.date('F Y', (mktime(0, 0, 0, $this->settings['month'], $this->settings['day'], $this->settings['year']))).'</h2>';
				
				if($this->settings['date_change']) {

					if($month === 1) {
						$html .= '<a href="'.$url.'cal_day=1&cal_month=12&cal_year='.($year-1).'&cal_scale='.$scale.'" class="cal_previous_month"></a>';
					}else {
						$html .= '<a href="'.$url.'cal_day=1&cal_month='.($month-1).'&cal_year='.$year.'&cal_scale='.$scale.'" class="cal_previous_month"></a>';
					}
					
					if($month === 12) {
						$html .= '<a href="'.$url.'cal_day=1&cal_month=1&cal_year='.($year+1).'&cal_scale='.$scale.'" class="cal_next_month"></a>';
					}else {
						$html .= '<a href="'.$url.'cal_day=1&cal_month='.($month+1).'&cal_year='.$year.'&cal_scale='.$scale.'" class="cal_next_month"></a>';
					}

				}

				break;
			
			case 'year':
				$html .= '<h2 class="cal_month_name">'.$this->settings['year'].'</h2>';

				if($this->settings['date_change']) {

					$html .= '<a href="'.$url.'cal_day='.$day.'&cal_month='.$month.'&cal_year='.($year-1).'&cal_scale='.$scale.'" class="cal_previous_month"></a>';
					$html .= '<a href="'.$url.'cal_day='.$day.'&cal_month='.$month.'&cal_year='.($year+1).'&cal_scale='.$scale.'" class="cal_next_month"></a>';
				
				}

				break;
			
			
		}

		if($this->settings['date_change'] && $this->settings['date_picker']) {
			$html .= '<a href="https://www.google.com/calendar/embed?src=bronycub%40gmail.com" class="cal_select_month" target="_blank"></a><div class="cal_select_month_calendar" data-url="'.$url.'" data-scale="'.(($this->settings['date_picker_keep_scale']) ? $scale : 'day').'" data-day="'.$day.'" data-month="'.$month.'" data-year="'.$year.'"></div>';
		}
		
		if($this->settings['scale_change']) {

			$html .= '<div class="cal_scale_selector">';
			if($this->settings['search_form']) { $html .= '<div class="cal_search_form"><input type="text" class="cal_search_box" name="q" placeholder="Recherche..." value="'.((isset($_GET['cal_search'])) ? str_replace('"', '&quot;', $this->_prep_search_out($this->_strip_quotes($_GET['cal_search']))) : '').'" /><a href="'.$url.'cal_day='.$day.'&cal_month='.$month.'&cal_year='.($year).'&cal_scale='.$scale.'&" id="cal_search_button">Recherche</a></div>'; }
			$html .= '<a href="'.$url.'cal_day='.$day.'&cal_month='.$month.'&cal_year='.$year.'&cal_scale=day" class="cal_scale_option cal_scale_option_first'.(($scale === 'day') ? ' cal_scale_option_selected' : '').'">'.$this->labels['day'].'</a>';
			$html .= '<a href="'.$url.'cal_day='.$day.'&cal_month='.$month.'&cal_year='.$year.'&cal_scale=month" class="cal_scale_option'.(($scale === 'month') ? ' cal_scale_option_selected' : '').'">'.$this->labels['month'].'</a>';
			$html .= '<a href="'.$url.'cal_day='.$day.'&cal_month='.$month.'&cal_year='.$year.'&cal_scale=year" class="cal_scale_option cal_scale_option_last'.(($scale === 'year') ? ' cal_scale_option_selected' : '').'">'.$this->labels['year'].'</a>';
			$html .= '<div class="cal_clear"></div></div>';

		}

		$html .= '<div class="cal_clear"></div></div><div class="cal_events">';

		if(count($events) === 0) {
			switch ($scale) {
				case 'day':
					$html .= '<div class="cal_noevents">'.$this->labels['no_events_on'].date('F jS, Y', (mktime(0, 0, 0, $month, $day, $year))).'</div>';
					break;
				case 'month':
					$html .= '<div class="cal_noevents">'.$this->labels['no_events_in'].date('F Y', (mktime(0, 0, 0, $this->settings['month'], $this->settings['day'], $this->settings['year']))).'</div>';
					break;
				case 'year':
					$html .= '<div class="cal_noevents">'.$this->labels['no_events_in'].$year.'</div>';
					break;
			}
		}

		for($i=count($events)-1; $i>=0; $i--) {

			$event = $events[$i];
			if($this->type === 'xml') {
				$xml_extra_time = 0;
			}else {
				$xml_extra_time = 1;
			}

			if($this->settings['group_events_by_date'] && !empty($this->dates)) {
				$html .= $this->_render_event_group(date('j', $event['start']), date('n', $event['start']), date('Y', $event['start']));
			}

			$html .= '<div class="cal_event'.(($this->settings['group_events_by_date']) ? ' cal_grouped_event' : '').'" data-date="'.date('j-n-Y', $event['start']).'">';

			switch ($scale) {
				case 'day':
					if($event['start'] + 86400 == $event['end'] && date('G', $event['start']) == $this->settings['extra_time']/3600*$xml_extra_time) {
						$event_label = $this->labels['all_day'];
					}else {
						$event_label = strtoupper(date($time_format, $event['start']));
					}
					
					break;
				case 'month':
					$event_label = (int)$event['day'];
					break;
				case 'year':
					$event_label = strtoupper(substr($this->_month_name(date('n', $event['start'])), 0, 3).date(' j', $event['start']));
					break;

			}

			$html .= '<div class="cal_event_day">'.$event_label.'</div>';
			$html .= '<div class="cal_event_right"><div class="cal_event_header">';
			$html .= '<h3 class="cal_event_title">'.$event['title'].'</h3>';
			$excerpt = explode('\n', wordwrap(str_replace('\n', ' ', $event['description']), $this->settings['excerpt_length'], '\n'));
			if($this->settings['excerpt_length'] == 0) {
				$excerpt[0] = '';
			}
			$html .= '<div class="cal_event_short_description"'.((isset($_GET['cal_event']) && $_GET['cal_event'] == $event['id']) ? ' style="display: none;"' : '').'>'.$excerpt[0];
			if($this->settings['excerpt_length'] !== 0 && !empty($event['description'])) {
				$html .= '...';
			}
			$html .= '</div><div class="cal_clear"></div></div><div class="cal_event_reveal'.((isset($_GET['cal_event']) && $_GET['cal_event'] == $event['id']) ? ' cal_event_visible" style="display: block"' : '"').'>';

			$date_day_addition = ($this->settings['date_day_addition'])? 'S' : '';
			
			if($event['start'] + 86400 == $event['end'] && date('G', $event['start']) == abs($this->settings['extra_time']/3600*$xml_extra_time)) {

				//all day event date_day_addition
				$html .= '<div class="cal_event_date">'.$this->_month_name(date('n', $event['start'])).date(' j'.$date_day_addition, $event['start']).'</div>';

			}elseif($event['start'] + 86400 >= $event['end'] && date('G', $event['start']) < date('G', $event['end'])) {

				//event on one day
				$html .= '<div class="cal_event_date">'.$this->_month_name(date('n', $event['start'])).date(' j'.$date_day_addition.' '.$time_format, $event['start']).' - '.date($time_format, $event['end']).'</div>';

			}else {
				$html .= '<div class="cal_event_date">'.$this->_month_name(date('n', $event['start'])).date(' j'.$date_day_addition.' '.$time_format, $event['start']).' - '.$this->_month_name(date('n', $event['end'])).date(' j'.$date_day_addition.' '.$time_format, $event['end']).'</div>';
			}

			if(!empty($event['location'])) {
				$html .= '<div class="cal_event_location">'.$event['location'].(($this->settings['show_map_link']) ? '(<a href="http://maps.google.com/maps?q='.urlencode($event['location']).'" target="_blank" title="View in Google Maps" rel="nofollow">'.$this->labels['map'].'</a>)' : '').'</div>';
			}

			if($this->settings['social_links']) {
				$event_link = $url.'cal_day='.$day.'&cal_month='.$month.'&cal_year='.$year.'&cal_scale='.$scale.'&cal_event='.$event['id'].'#event_'.$event['id'];
				$extra = (strlen(str_replace('\n', '', $event['title'])) > 110) ? '...' : '';
				//$link_nohash = explode('#', $event_link);
				//$link_nohash = $link_nohash[0];
				$link_nohash = $event_link;
				$html .= '<a target="_blank" title="'.$this->labels['tweet_event'].'" href="https://twitter.com/share?url='.urlencode($link_nohash).'&text='.urlencode(substr(str_replace('\n', '', $event['title']), 0, 110)).$extra.'" class="cal_event_twitter"></a>';
				$html .= '<a target="_blank" title="'.$this->labels['share_event'].'" href="http://www.facebook.com/sharer.php?u='.urlencode($link_nohash).'&t='.urlencode(substr(str_replace('\n', '', $event['title']), 0, 110)).$extra.'" class="cal_event_facebook"></a><div class="cal_clear"></div>';
			}

			$html .= '<p class="cal_event_description" id="event_'.$event['id'].'">'.$this->_format_description($event['description']).'</p>';
			$html .= '</div></div><div class="cal_clear"></div></div>';

		}
		
		$html .= '</div></div>';
				
		echo $html;
		return;
	}

	private function _format_description($description) {
		if($this->settings['hyperlink_urls']) {
			$description = $this->_make_clickable($description);
		}
		$description = nl2br($description);
		return $description;
	}

	private function _render_event_group($date_day, $date_month, $date_year) {
		// $date_date = explode('-', $key);
		// $date_day = $date_date[0];
		// $date_month = $date_date[1];
		// $date_year = $date_date[2];

		$date = $date_day.'-'.$date_month.'-'.$date_year;

		if(!isset($this->dates[$date])) {
			return '';
		}

		$html = '';
		
		$html .= '<div class="cal_event cal_grouped_group" data-date="'.$date.'" data-animate="'.(($this->settings['group_events_animate']) ? 'true' : 'false').'" style="cursor: pointer">';

		if($this->settings['scale'] == 'month') {
			$html .= '<div class="cal_event_day">'.$date_day.'</div>';
		}elseif($this->settings['scale'] == 'year') {
			$html .= '<div class="cal_event_day">'.(strtoupper(substr($this->_month_name($date_month), 0, 3).' '.$date_day)).'</div>';
		}



		$html .= '<div class="cal_event_right">';
		$html .= '<div class="cal_event_header">';
		$html .= '<h3 class="cal_event_title">'.count($this->dates[$date]).' '.((count($this->dates[$date]) !== 1) ? $this->labels['events'] : $this->labels['event']).'</h3>';
		$html .= '<div class="cal_event_reveal"></div>';
		$html .= '';
		$html .= '';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="cal_clear"></div>';
		$html .= '</div>';

		unset($this->dates[$date]);

		return $html;

	}

	/**
	 * Checks if events are within given time limits
	 * @param  array  $events Events
	 * @return array          Allowed events
	 */
	private function _events_within_query($events) {

		$all_events = $events;

		switch ($this->settings['scale']) {
			case 'day':
				$start_time = mktime(0, 0, 0, $this->settings['month'], $this->settings['day'], $this->settings['year']);
				$end_time = mktime(23, 59, 59, $this->settings['month'], $this->settings['day'], $this->settings['year']);
				break;
			
			case 'month':
				$start_time = mktime(0, 0, 0, $this->settings['month'], 1, $this->settings['year']);
				$end_time = mktime(23, 59, 59, $this->settings['month'], date('t', (mktime(0, 0, 0, $this->settings['month'], $this->settings['day'], $this->settings['year']))), $this->settings['year']);
				break;

			case 'year':
				$start_time = mktime(0, 0, 0, 1, 1, $this->settings['year']);
				$end_time = mktime(23, 59, 59, 12, 31, $this->settings['year']);
				break;
		}

		$new_events = array();

		//print_r($events);

		for($i = 0; $i < count($events); $i++) {

			if($events[$i]['start'] >= $start_time && $events[$i]['start'] <= $end_time) {
				$new_events[] = $events[$i];
			}elseif($events[$i]['start'] <= $start_time && $events[$i]['end'] >= $start_time && $this->settings['scale'] == 'day' ) {
				if ( $events[$i]['start'] + 86400 != $events[$i]['end'] ) {
					$new_events[] = $events[$i];
				}
			}elseif($events[$i]['start'] + 86400 == $events[$i]['end'] && $events[$i]['start'] == $start_time) {
				$new_events[] = $events[$i];
			}
		}

		

		if(isset($_GET['cal_search']) && !empty($_GET['cal_search'])) {

			if($this->settings['search_all_events']) {
				$new_events = $all_events;
			}

			$found_events = array();

			foreach($new_events as $key=>$event) {
				//print_r($event);
				if($this->_search_found_event($event, $this->_prep_search_out($this->_strip_quotes($_GET['cal_search'])))) {
					$found_events[] = $event;
				}
			}

			$new_events = $found_events;

		}

		if(!$this->settings['group_events_by_date']) {
			return $new_events;
		}

		//calculate needed event divs
		
		$dates = array();

		if($this->settings['scale'] == 'month' || $this->settings['scale'] == 'year') {

			foreach($new_events as $event) {

				$dates[date('j-n-Y', $event['start'])][] = array();

			}
				
		}
		
		$this->dates = $dates;


		return $new_events;

	}

	private function _search_found_event($event, $search) {
		foreach($event as $key=>$data) {
			if($key == 'id' || $key == 'day' || $key == 'month' || $key == 'year') {
				continue;
			}
			if(strpos(strtolower($data), strtolower($search)) !== false) {
				return true;
			}
		}
	}

	private function _retrieve_data() {

		foreach($this->settings['url'] as $url) {
			$this->_download_data($url);
		}

		return true;

	}

	/**
	 * Downloads the data from the URL
	 * @return boolean Success of fail
	 */
	private function _download_data($xml_url) {

		$extern = (strpos($xml_url, 'http') === 0 || strpos($xml_url, 'ftp') === 0) ? true : false;
		
		if(function_exists('curl_init') && $extern) {
			$ch = curl_init($xml_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$download_data = curl_exec($ch);
			curl_close($ch);
		}else {
			$download_data = @file_get_contents($xml_url);
		}

		if(strpos($download_data, 'BEGIN:VCALENDAR') === 0) {

			//ics
			$this->data[] = array(
				'type' => 'ics',
				'data' => $download_data,
			);
			return true;

		}elseif(strpos($download_data, '<events>')) {

			//xml
			$this->data[] = array(
				'type' => 'xml',
				'data' => $download_data,
			);
			return true;

		}
 
		return false;

	}

	/**
	 * Parses the data
	 * @return boolean Success or fail
	 */
	private function _parse_data() {

		$events = array();
		foreach($this->data as $data) {
			if($data['type'] === 'xml') {
				$events = array_merge($this->_parse_data_xml($data['data']), $events);
			}elseif($data['type'] === 'ics') {
				$events = array_merge($this->_parse_data_ics($data['data']), $events);
			}
		}

		usort($events, array($this, '_sort_by_order'));

		$this->events = $events;

		return true;

	}

	/**
	 * Parses the XML data
	 * @return boolean Success or fail
	 */
	private function _parse_data_xml($data) {

		$events = new SimpleXMLElement($data);

		if(!$events) { return false; }

		$new_events = array();
		foreach($events->event as $event) {

			if(!isset($event->start_time)) { $event->start_time = '0:00'; }
			if(!isset($event->end_time)) { $event->end_time = '0:00'; }

			$start_date = explode('/', $event->start_date);
			$end_date = explode('/', $event->end_date);

			$start_time = explode(':', $event->start_time);
			$end_time = explode(':', $event->end_time);

			$start = mktime($start_time[0], $start_time[1], 0, $start_date[1], $start_date[0], $start_date[2]) + date('Z');
			$end = mktime($end_time[0], $end_time[1], 0, $end_date[1], $end_date[0], $end_date[2]) + date('Z');

			$new_events[] = array(
				'id' => md5(($start + $end) . (string)$event->title . $this->settings['cache_token']),
				'title' => (isset($event->title)) ? (string)$event->title : '',
				'description' => (isset($event->description)) ? (string)$event->description : '',
				'start' => $start,
				'end' => $end,
				'location' => (isset($event->location)) ? (string)$event->location : '',
				'day' => $start_date[0],
				'month' => $start_date[1],
				'year' => $start_date[2],
			);

			if($this->settings['hyperlink_urls']) {
				//$events[$i]['description'] = $this->_make_clickable($events[$i]['description']);
			}
		}

		//usort($new_events, array($this, '_sort_by_order'));

		//$this->events = $new_events;

		return $new_events;

	}

	/**
	 * Parses the .ics data
	 * @return boolean Success or fail
	 */
	private function _parse_data_ics($data) {

		$ical = new ical($data, $this->settings['dst']);
		$events_ical = $ical->events();
		$events = array();

		for($i = 0; $i < count($events_ical); $i++) {

			$start = $ical->iCalDateToUnixTimestamp($events_ical[$i]['DTSTART']) + $this->settings['extra_time'] + date('Z');

			$events[$i] = array(
				'id' => (isset($events_ical[$i]['UID'])) ? md5('s34s0_#'.$events_ical[$i]['UID'].$this->settings['cache_token']) : md5($events_ical[$i]['SUMMARY'].$this->settings['cache_token']),
				'title' => str_replace('\\,', ',', (isset($events_ical[$i]['SUMMARY'])) ? $events_ical[$i]['SUMMARY'] : ''),
				'description' => str_replace('\\,', ',', $events_ical[$i]['DESCRIPTION']),
				'start' => $start,
				'end' => $ical->iCalDateToUnixTimestamp($events_ical[$i]['DTEND']) + $this->settings['extra_time'] + date('Z'),
				'location' => str_replace('\\,', ',', (isset($events_ical[$i]['LOCATION'])) ? $events_ical[$i]['LOCATION'] : ''),
				'day' => date('j', $start),
				'month' => date('n', $start),
				'year' => date('Y', $start),
			);

			if($this->settings['hyperlink_urls']) {
				//$events[$i]['description'] = $this->_make_clickable($events[$i]['description']);
			}

		}

		//usort($events, array($this, '_sort_by_order'));

		return $events;

	}

	/**
	 * Saves the events in a cache file
	 * @return boolean Success or fail
	 */
	public function _save_cache() {

		$data = serialize($this->events);
		return @file_put_contents($this->settings['cache_dir'].$this->settings['cache_token'].'.txt', time().'<<{time|_|data}>>'.$data);

	}

	/**
	 * Reads the events from the cache file
	 * @return boolean Success or fail
	 */
	public function _get_cache() {

		if(!$this->settings['cache']) { return false; }

		$file = @file_get_contents($this->settings['cache_dir'].$this->settings['cache_token'].'.txt');
		if(!$file) { return false; }

		$data = explode('<<{time|_|data}>>', $file);
		if($data[0] + $this->settings['cache_time'] < time()) {
			return false;
		}else {
			$this->events = @unserialize($data[1]);
			if($this->events === false) { return false; }
			return true;
		}

	}

	/**
	 * Sort function
	 * @param  int    $a
	 * @param  int    $b 
	 * @return int
	 */
	private function _sort_by_order($a, $b) {
		return $a['start'] - $b['start'];
	}

	/**
	 * Generates a unique cache token for all feeds
	 * @return string Cache token
	 */
	private function _generate_cache_token($urls) {
		$all_urls = '';
		foreach($urls as $url) {
			$all_urls = $all_urls.$url;
		}
		return md5($all_urls.$this->version.'v3@#dfyt');
	}

	/**
	 * Returns the page URL without given $_GET's
	 * @return string Page URL
	 */
	private function _get_page_url() {

		if(function_exists('get_permalink')) {
			return get_permalink().'?';
		}

		 $pageURL = 'http';
		 $pageURL .= "://";
		 $pageURL .= $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];

		 if(empty($_GET)) {
		 	if($pageURL[strlen($pageURL)-1] !== '?') {
		 		$pageURL .= '?';
		 	}
		 }else {
		 	
			$url = explode('?', $pageURL.'...');
		 	$pageURL = $url[0].'?';

		 	//add previous vars
		 	
		 	$vars = $_GET;

		 	if(isset($_GET['cal_day'])) { unset($vars['cal_day']); }
		 	if(isset($_GET['cal_month'])) { unset($vars['cal_month']); }
		 	if(isset($_GET['cal_year'])) { unset($vars['cal_year']); }
		 	if(isset($_GET['cal_scale'])) { unset($vars['cal_scale']); }
		 	if(isset($_GET['cal_search'])) { unset($vars['cal_search']); }

		 	foreach($vars as $key=>$var) {
		 		$pageURL .= $key.'='.urlencode($var).'&';
		 	}


		}

		return $pageURL;
	}

	/**
	 * Changes URLs into anchor tags
	 * DEVELOPED BY WORDPRESS.ORG
	 * @param  array  $matches Link URL
	 * @return string          Anchor tag
	 */
	private function _make_url_clickable_cb($matches) {
		$ret = '';
		$url = $matches[2];
	 
		if ( empty ($url) )
			return $matches[0];
		// removed trailing [.,;:] from URL
		if ( in_array (substr ($url, -1), array ('.', ',', ';', ':')) === true ) {
			$ret = substr ($url, -1);
			$url = substr ($url, 0, strlen ($url)-1);
		}
		return $matches[1] . "<a href=\"$url\" rel=\"nofollow\">$url</a>" . $ret;
	}
	
	/**
	 * Changes ftp URLs into anchor tags
	 * DEVELOPED BY WORDPRESS.ORG
	 * @param  array  $matches FTP URL
	 * @return string          Anchor tag
	 */
	private function _make_web_ftp_clickable_cb($matches) {
		$ret = '';
		$dest = $matches[2];
		$dest = 'http://' . $dest;
	 
		if ( empty ($dest) )
			return $matches[0];
		// removed trailing [,;:] from URL
		if ( in_array (substr ($dest, -1), array ('.', ',', ';', ':')) === true ) {
			$ret = substr ($dest, -1);
			$dest = substr ($dest, 0, strlen ($dest)-1);
		}
		return $matches[1] . "<a href=\"$dest\" rel=\"nofollow\">$dest</a>" . $ret;
	}
	
	/**
	 * Changes email URLs into anchor tags
	 * DEVELOPED BY WORDPRESS.ORG
	 * @param  array  $matches Email URL
	 * @return string          Anchor tag
	 */
	private function _make_email_clickable_cb($matches) {
		$email = $matches[2] . '@' . $matches[3];
		return $matches[1] . "<a href=\"mailto:$email\">$email</a>";
	}
	
	/**
	 * Changes URLs into anchor tags
	 * DEVELOPED BY WORDPRESS.ORG
	 * @param  string $ret Input string
	 * @return string      Output string
	 */
	private function _make_clickable($ret) {

		if(function_exists('make_clickable')) {
			return make_clickable($ret);
		}

		$ret = ' ' . $ret;
		// in testing, using arrays here was found to be faster
		$ret = preg_replace_callback ('#([\s>])([\w]+?://[\w\\x80-\\xff\#$%&~/.\-;:=,?@\[\]+]*)#is', array($this, '_make_url_clickable_cb'), $ret);
		$ret = preg_replace_callback ('#([\s>])((www|ftp)\.[\w\\x80-\\xff\#$%&~/.\-;:=,?@\[\]+]*)#is', array($this, '_make_web_ftp_clickable_cb'), $ret);
		$ret = preg_replace_callback ('#([\s>])([.0-9a-z_+-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,})#i', array($this, '_make_email_clickable_cb'), $ret);
	 
		// this one is not in an array because we need it to run last, for cleanup of accidental links within links
		$ret = preg_replace ("#(<a( [^>]+?>|>))<a [^>]+?>([^>]+?)</a></a>#i", "$1$3</a>", $ret);
		$ret = trim ($ret);
		return $ret;
	}

	private function _month_name($month) {
		return $this->labels['months'][$month-1];
	}

	private function _strip_quotes($val) {
		if(get_magic_quotes_gpc()) {
			return stripslashes($val);
		}else {
			return $val;
		}
	}

	private function _prep_search_out($val) {
		$val = str_replace('<', '&lt;', $val);
		$val = str_replace('>', '&gt;', $val);
		return $val;

	}

}

?>
