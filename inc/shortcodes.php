<?php
/*************************************
* Shortcodes
*************************************/

add_shortcode('opening-times-today', 'cx_sc_openingtimes_today');
function cx_sc_openingtimes_today($atts, $content = null) {
	
	extract(shortcode_atts(array(
		"open" => 'We are open today from',
		"closed" => 'Sorry, we\'re closed today.',
		"to" => 'to'
	), $atts));
	
	$opentext = $open;
	$closedtext = $closed;
		
	ob_start();
	
			$contact_details = get_option( 'cx_openingtimes' );
			$today = strtolower(date('D'));
			
			if (($contact_details['day_'.$today] != NULL) && ($contact_details['day_'.$today.'_close'] != NULL)) {
			echo '<p class="opentoday">' . $opentext . ' ' . $contact_details['day_'.$today] . ' ' . $to . ' ' . $contact_details['day_'.$today.'_close'] . '</p>';
			} else {
				echo '<p class="opentoday">' . $closedtext . '</p>';
			}
			
	$output_string = ob_get_contents();  	
	ob_end_clean();
	return $output_string;  

}

add_shortcode('opening-times', 'cx_sc_openingtimes');
function cx_sc_openingtimes($atts, $content = null) {

	extract(shortcode_atts(array(
		"format" => 'table'
	), $atts));

	ob_start();
	
			$contact_details = get_option( 'cx_openingtimes' );
			$today = strtolower(date('D'));
						
			if ($contact_details['day_mon'] != NULL) {
				$times_mon = $contact_details['day_mon'] . ' - ' . $contact_details['day_mon_close'];
			} else {
				$times_mon = 'Closed';
			}
			if ($contact_details['day_tue'] != NULL) {
				$times_tue = $contact_details['day_tue'] . ' - ' . $contact_details['day_tue_close'];
			} else {
				$times_tue = 'Closed';
			}
			if ($contact_details['day_wed'] != NULL) {
				$times_wed = $contact_details['day_wed'] . ' - ' . $contact_details['day_wed_close'];
			} else {
				$times_wed = 'Closed';
			}
			if ($contact_details['day_thu'] != NULL) {
				$times_thu = $contact_details['day_thu'] . ' - ' . $contact_details['day_thu_close'];
			} else {
				$times_thu = 'Closed';
			}
			if ($contact_details['day_fri'] != NULL) {
				$times_fri = $contact_details['day_fri'] . ' - ' . $contact_details['day_fri_close'];
			} else {
				$times_fri = 'Closed';
			}
			if ($contact_details['day_sat'] != NULL) {
				$times_sat = $contact_details['day_sat'] . ' - ' . $contact_details['day_sat_close'];
			} else {
				$times_sat = 'Closed';
			}
			if ($contact_details['day_sun'] != NULL) {
				$times_sun = $contact_details['day_sun'] . ' - ' . $contact_details['day_sun_close'];
			} else {
				$times_sun = 'Closed';
			}
			
			$montue = false;
			$monwed = false;
			$monthu = false;
			$monfri = false;
			$monsat = false;
			$monsun = false;
			
			$tuewed = false;
			$tuethu = false;
			$tuefri = false;
			$tuesat = false;
			$tuesun = false;
			
			$wedthu = false;
			$wedfri = false;
			$wedsat = false;
			$wedsun = false;
			
			$thufri = false;
			$thusat = false;
			$thusun = false;
			
			$frisat = false;
			$frisun = false;
	
			$satsun = false;
			
			$nextday = 'mon';
			
			if ($format == 'table') {
				echo '<table class="cx-opening-times">';
				echo '<tr>';
				echo '<td class="day">Monday</td>';
				echo '<td>'.$times_mon.'</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td class="day">Tuesday</td>';
				echo '<td>'.$times_tue.'</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td class="day">Wednesday</td>';
				echo '<td>'.$times_wed.'</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td class="day">Thursday</td>';
				echo '<td>'.$times_thu.'</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td class="day">Friday</td>';
				echo '<td>'.$times_fri.'</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td class="day">Saturday</td>';
				echo '<td>'.$times_sat.'</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td class="day">Sunday</td>';
				echo '<td>'.$times_sun.'</td>';
				echo '</tr>';
				echo '</table>';
			} else {
				echo '<ul class="cx-opening-times">';
				
				if ($nextday == 'mon') {
					echo '<li>Monday';
					
					// Check if opening times on Tue are the same as Mon
					if ($times_tue == $times_mon) {
						$montue = true;
						$nextday = 'wed';
					}
					
					// and if that's true check if Wed is also the same
					if ( ($montue == true) && ($times_wed == $times_mon) ) { 
						$monwed = true;
						$nextday = 'thu';
					}
					
					// and then check for thursday...
					if ( ($monwed == true) && ($times_thu == $times_mon) ) {
						$monthu = true;
						$nextday = 'fri';
					}
					
					// ...friday...
					if ( ($monthu == true) && ($times_fri == $times_mon) ) {
						$monfri = true;
						$nextday = 'sat';
					}
					
					// ...saturday...
					if ( ($monfri == true) && ($times_sat == $times_mon) ) {
						$monsat = true;
						$nextday = 'sun';
					}
					
					// ...and sunday
					if ( ($monsat == true) && ($times_sun == $times_mon) ) {
						$monsun = true;
						$nextday = false;
					}
					
					if ($monsun == true) {
						echo '-Sunday ' . $times_mon;
					} elseif ($monsat == true) {
						echo '-Saturday ' . $times_mon;
					} elseif ($monfri == true) {
						echo '-Friday ' . $times_mon;
					} elseif ($monthu == true) {
						echo '-Thursday ' . $times_mon;
					} elseif ($monwed == true) {
						echo '-Wednesday ' . $times_mon;
					} elseif ($montue == true) {
						echo '-Tuesday ' . $times_mon;
					} else {
						echo ' ' . $times_mon;
						$nextday = 'tue';
					}
					
					echo '</li>';
				}
				
				if ($nextday == 'tue') {
					echo '<li>Tuesday';
					// Check if opening times on Fri are the same as Thu
					if ($times_wed == $times_tue) {
						$tuewed = true;
						$nextday = 'thu';
					}
					if ( ($tuewed == true) && ($times_thu == $times_tue) ) {
						$tuethu = true;
						$nextday = 'fri';
					}
					if ( ($tuethu == true) && ($times_fri == $times_tue) ) {
						$tuefri = true;
						$nextday = 'sat';
					}
					if ( ($tuefri == true) && ($times_sat == $times_tue) ) {
						$tuesat = true;
						$nextday = 'sun';
					}
					if ( ($tuesat == true) && ($times_sun == $times_tue) ) {
						$tuesun = true;
						$nextday = false;
					}
					if ( isset($tuesun) && ($tuesun == true) ) {
						echo '-Sunday ' . $times_tue;
					} elseif ( isset($tuesat) && ($tuesat == true) ) {
						echo '-Saturday ' . $times_tue;
					} elseif ( isset($tuefri) && ($tuefri == true) ) {
						echo '-Friday ' . $times_tue;
					} elseif ( isset($tuethu) && ($tuethu == true) ) {
						echo '-Thursday ' . $times_tue;
					} elseif ( isset($tuewed) && ($tuewed == true) ) {
						echo '-Wednesday ' . $times_tue;
					} else {
						echo ' ' . $times_tue;
						$nextday = 'wed';
					}
					echo '</li>';
				}
				
				if ($nextday == 'wed') {
					echo '<li>Wednesday';
		
					if ($times_thu == $times_wed) {
						$wedthu = true;
						$nextday = 'fri';
					}
					if ( ($wedthu == true) && ($times_fri == $times_wed) ) {
						$wedfri = true;
						$nextday = 'sat';
					}
					if ( ($wedfri == true) && ($times_sat == $times_wed) ) {
						$wedsat = true;
						$nextday = 'sun';
					}
					if ( ($wedsat == true) && ($times_sun == $times_wed) ) {
						$wedsun = true;
						$nextday = false;
					}
					if ( isset($wedsun) && ($wedsun == true) ) {
						echo '-Sunday ' . $times_wed;
					} elseif ( isset($wedsat) && ($wedsat == true) ) {
						echo '-Saturday ' . $times_wed;
					} elseif ( isset($wedfri) && ($wedfri == true) ) {
						echo '-Friday ' . $times_wed;
					} elseif ( isset($wedthu) && ($wedthu == true) ) {
						echo '-Thursday ' . $times_wed;
					} else {
						echo ' ' . $times_wed;
						$nextday = 'thu';
					}
					echo '</li>';
				}
				
				if ($nextday == 'thu') {
					echo '<li>Thursday';
					// Check if opening times on Fri are the same as Thu
					if ($times_fri == $times_thu) {
						$thufri = true;
						$nextday = 'sat';
					}
					if ( ($thufri == true) && ($times_sat == $times_thu) ) {
						$thusat = true;
						$nextday = 'sun';
					}
					if ( ($thusat == true) && ($times_sun == $times_thu) ) {
						$thusun = true;
						$nextday = false;
					}
					if ( isset($thusun) && ($thusun == true) ) {
						echo '-Sunday ' . $times_thu;
					} elseif ( isset($thusat) && ($thusat == true) ) {
						echo '-Saturday ' . $times_thu;
					} elseif ( isset($thufri) && ($thufri == true) ) {
						echo '-Friday ' . $times_thu;
					} else {
						echo ' ' . $times_thu;
						$nextday = 'fri';
					}
					echo '</li>';
				}
				
				if ($nextday == 'fri') {
					echo '<li>Friday';
		
					if ($times_sat == $times_fri) {
						$frisat = true;
						$nextday = 'sun';
					}
					if ( ($frisat == true) && ($times_sun == $times_fri) ) {
						$frisun = true;
						$nextday = false;
					}
					if ( isset($frisun) && ($frisun == true) ) {
						echo '-Sunday ' . $times_fri;
					} elseif ( isset($frisat) && ($frisat == true) ) {
						echo '-Saturday ' . $times_fri;
					} else {
						echo ' ' . $times_fri;	
						$nextday = 'sat';
					}
					echo '</li>';
				}
				
				if ($nextday == 'sat') {
					echo '<li>Saturday';
		
					if ($times_sun == $times_sat) {
						$satsun = true;
						$nextday = false;
					}
					if ( isset($satsun) && ($satsun == true) ) {
						echo '-Sunday ' . $times_sat;
					} else {
						echo ' ' . $times_sat;	
						$nextday = 'sun';
					}
					echo '</li>';
				}
				
				if ($nextday == 'sun') {
					echo '<li>Sunday ' . $times_sun . '</li>';
				}
				
				echo '</ul>';
			}

	$output_string = ob_get_contents();  	
	ob_end_clean();
	return $output_string;  

}

/*************************************
* Shortcodes Part 2: Add button to Tiny MCE
*************************************/

function register_button( $buttons ) {
   array_push( $buttons, "|", "openingtimestoday" );
   array_push( $buttons, "|", "openingtimes" );
   return $buttons;
}

function add_plugin( $plugin_array ) {
   $plugin_array['openingtimes'] = plugins_url('/js/openingtimes.js',__file__);
   $plugin_array['openingtimestoday'] = plugins_url('/js/openingtimes.js',__file__);
   return $plugin_array;
}

function cx_ot_button() {

   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
      return;
   }

   if ( get_user_option('rich_editing') == 'true' ) {
      add_filter( 'mce_external_plugins', 'add_plugin' );
      add_filter( 'mce_buttons_2', 'register_button' );
   }

}

add_action('init', 'cx_ot_button');

?>