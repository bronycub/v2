/*
 * Google, iCal & XML Event Calendar List - for PHP 5
 * http://rikdevos.com/
 *
 * Copyright 2012, Rik de Vos
 * You need to buy a license if you want use this script.
 * http://codecanyon.net/wiki/buying/howto-buying/licensing/
 * 
 */

$(document).ready(function() {

	var hash = window.location.hash.split('#');
	
	$(".cal_container").each(function() {

		var $cal = $(this),
			max_title_width = 0;

		$cal.find('.cal_event').each(function() {

			var $event = $(this),
				title_width = $event.find('.cal_event_title').innerWidth();

			if(title_width > max_title_width) {
				max_title_width = title_width;
			}

			$event.find(".cal_event_header").click(function() {

				if($event.hasClass('cal_event_visible')) {
					$event.find('.cal_event_reveal').slideUp(200, function() {
						$event.removeClass('cal_event_visible');
						if($(window).width() > 480) {
							$event.find('.cal_event_short_description').fadeIn(200);
						}
						
					});

					//firefox fix
					if(window.mozInnerScreenX) { $event.find('.cal_event_right').css('margin-top', 0); }
				}else {
					$event.addClass('cal_event_visible');
					$event.find('.cal_event_reveal').slideDown(200, function() {

						//firefox fix
						if(window.mozInnerScreenX) { $event.find('.cal_event_right').css('margin-top', -9); }
					});
					$event.find('.cal_event_short_description').fadeOut(200);
					
				}

			});

		});

		if($cal.hasClass('auto_title_width')) {
			$cal.find('.cal_event_title').css('width', max_title_width + 5);
		}

		if($(window).width() <= 480) {
			small_screen_size($cal);
		}

		$(window).resize(function() {
			if($(window).width() <= 480) {
				small_screen_size($cal);
			}else {
				large_screen_size($cal);
			}
		});

		$cal.find('#cal_search_button').click(function() {
			var q = $cal.find(".cal_search_box").val(),
				href = $cal.find('#cal_search_button').attr('href')+'cal_search='+encodeURIComponent(q);

			window.location = href;
			return false;
		});


		var $date_selector = $cal.find(".cal_select_month_calendar"),
			defaultDate = $date_selector.attr('data-month')+'/'+$date_selector.attr('data-day')+'/'+$date_selector.attr('data-year');

		$cal.find(".cal_select_month_calendar").datepicker({
			defaultDate: defaultDate,
			onSelect: function(dateText, inst) {
				var url = $(this).attr('data-url'),
					scale = $(this).attr('data-scale');

				var dates = dateText.split('/');

				url = url + 'cal_day='+parseFloat(dates[1])+'&cal_month='+parseFloat(dates[0])+'&cal_year='+parseFloat(dates[2])+'&cal_scale='+scale;

				window.location = url;
			}
		});

		$cal.find(".cal_select_month").click(function() {
			$(".cal_select_month_calendar").fadeToggle();
			return false;
		});

		$cal.find('.cal_grouped_event').hide();

		$cal.find(".cal_grouped_group").click(function() {

			var $group = $(this),
				group_date = $group.attr('data-date'),
				animate = ($group.attr('data-animate') == 'true') ? true : false,
				$group_events = $cal.find('.cal_event[data-date='+group_date+']:not(.cal_grouped_group)');

			if(animate) {
				$group_events.slideDown(500, function() {
					$(this).animate({ opacity: 1 }, 500);
				});

				$group.animate({ opacity: 0 }, 500, function() {
					$group.slideUp(500);
				});
			}else {
				$group_events.css('opacity', 1).show();
				$group.hide();
			}
			

		});

	});

	function small_screen_size($cal) {

		$cal.find(".cal_event_short_description").hide();

	}

	function large_screen_size($cal) {

		$cal.find(".cal_event:not(.cal_event_visible)").find(".cal_event_short_description").show();

	}
	
});