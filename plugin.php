<?php defined('ABSPATH') or die('No script kiddies please!');
/**
 * @wordpress-plugin
 * Plugin Name:       Sagenda Calendar
 * Plugin URI:        https://www.sagenda.com/
 * Description:       Sagenda is a free Online Booking / Scheduling / Reservation System, which gives customers the opportunity to choose the date and the time of an appointment according to your preferences.
 * Version:           1.5.0
 * Author:            sagenda
 * Author URI:        http://www.iteration.info
 * License:           GPLv2
 * Domain Path:       /languages
 */

/**
 * Plugin path management - you can re-use those constants in the plugin
 */
define('SAGENDA_CALENDAR_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('SAGENDA_CALENDAR_PLUGIN_URL', plugins_url('/', __FILE__));


/**
 * Load tranlations of the plugin
 */
function sagenda_calendar_load_textdomain()
{
	load_plugin_textdomain('sagenda-calendar-wp', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}
add_action('plugins_loaded', 'sagenda_calendar_load_textdomain');

/**
 * Shortcode management
 * @param  string  $atts   a list of parameter allowing more options to the shortcode
 */
function sagenda_calendar_main($atts)
{
	if (sagenda_calendar_is_CURL_Enabled() === true) {
		if (sagenda_calendar_is_PHP_version_OK() == true) {
			include_once(SAGENDA_CALENDAR_PLUGIN_DIR . 'initializer.php');
			$initializer = new SagendaCalendar\Initializer();
			return $initializer->initFrontend($atts);
		}
	}
}
add_shortcode('sagenda-calendar-wp', 'sagenda_calendar_main');

/**
 * Check the version of PHP used by the server. Display a message in case of error. Unirest project require php >=5.4
 * @return true if version is ok, false if version is too old.
 */
function sagenda_calendar_is_PHP_version_OK()
{
	if (version_compare(phpversion(), '5.4.0', '<')) {
		echo "You are runing an outdated version of PHP !" . "<br>";
		echo "Your version is : " . phpversion() . "<br>";
		echo "Minimal version : " . "5.4.0<br>";
		echo "Recommended version : 7.2 or higher  (all version <7.1 are \"End of life\" and don't have security fixes!)" . "<br>";
		echo "Please read offical PHP recommendations <a href=\"http://php.net/supported-versions.php\">http://php.net/supported-versions.php</a><br>";
		echo "Please update your PHP version form your admin panel. If you don't know how to do it please contact your WebMaster or your Hosting provider!";
		return false;
	}
	return true;
}

/**
 * Check if CURL is enabled on the server, required for calling web services.
 * @return true if curl is enabled
 */
function sagenda_calendar_is_CURL_Enabled()
{
	if (!function_exists('curl_version')) {
		echo "You need to install cURL module in your PHP server in order to make WebServices calls!" . "<br>";
		echo "More info there : <a href=\"http://php.net/manual/en/curl.installation.php\">http://php.net/manual/en/curl.installation.php</a><br>";
		return false;
	}
	return true;
}

/**
 * Include CSS, JavaScript in the head section of the plugin.
 */
function head_code_sagenda_calendar()
{
	$headcode = '';
	$headcode .= '<link rel="stylesheet" href="' . SAGENDA_CALENDAR_PLUGIN_URL . 'assets/vendor/bootstrap/bootstrap-wrapper.css" >';
	$headcode .= '<link href="https://unpkg.com/@angular/material@8.2.3/prebuilt-themes/indigo-pink.css" rel="stylesheet">';
	$headcode .= '<link href="' . SAGENDA_CALENDAR_PLUGIN_URL . 'assets/angular/styles.css" rel="stylesheet"/>';
	echo $headcode;
}
add_action('wp_head', 'head_code_sagenda_calendar', 1, 1);

/**
 * Include CSS, JavaScript in the footer section of the plugin.
 */
function footer_code_sagenda_calendar()
{
	echo '<link href="' . SAGENDA_CALENDAR_PLUGIN_URL . 'assets/angular/sagenda-integration.css" rel="stylesheet"/>';
}
add_action('wp_footer', 'footer_code_sagenda_calendar');

/**
 * Action hooks for adding admin page
 */
function sagenda_calendar_admin()
{
	if (sagenda_calendar_is_CURL_Enabled() === true) {
		if (sagenda_calendar_is_PHP_version_OK() === true) {
			include_once(SAGENDA_CALENDAR_PLUGIN_DIR . 'initializer.php');
			$initializer = new SagendaCalendar\Initializer();
			echo $initializer->initAdminSettings();
		}
	}
}

function sagenda_calendar_admin_actions()
{
	add_options_page("Sagenda Calendar", "Sagenda Calendar", "manage_options", "Sagenda Calendar", "sagenda_calendar_admin");
}
add_action('admin_menu', 'sagenda_calendar_admin_actions');
