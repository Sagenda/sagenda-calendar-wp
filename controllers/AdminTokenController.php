<?php

namespace SagendaCalendar\Controllers;

defined('ABSPATH') or die('No script kiddies please!');

use SagendaCalendar\webservices\sagendaAPI;

include_once(SAGENDA_CALENDAR_PLUGIN_DIR . 'webservices/SagendaAPI.php');

/**
 * This controller will be responsible for displaying the Settings in WP backend.
 */
class AdminTokenController
{
  /**
   * @var string - name of the view to be displayed
   */
  private $view = "adminToken.twig";

  /**
   * Display the search events form
   * @param  object  $twig   TWIG template renderer
   */
  public function showAdminTokenSettingsPage($twig)
  {
    $tokenValue = $this->getAuthenticationToken();
    $this->saveAuthenticationToken();

    $sagendaAPI = new sagendaAPI();
    $result = $sagendaAPI->validateAccount($tokenValue);
    $color = "red";
    $connectedStatus = esc_html('NOT CONNECTED', 'sagenda-calendar-wp');

    if ($result['didSucceed'] && $tokenValue != null) {
      $color = "green";
      $connectedStatus  = esc_html('CONNECTED', 'sagenda-calendar-wp');
    }

    return $twig->render($this->view, array(
      'SAGENDA_CALENDAR_PLUGIN_URL'           => SAGENDA_CALENDAR_PLUGIN_URL,
      'sagendaAuthenticationSettings'         => esc_html('Sagenda Authentication Settings', 'sagenda-calendar-wp'),
      'sagendaAuthenticationCode'             => esc_html('Sagenda Authentication Code', 'sagenda-calendar-wp'),
      'saveChanges'                           => esc_html('Save Changes', 'sagenda-calendar-wp'),
      'currentStatus'                         => esc_html('Current Status', 'sagenda-calendar-wp'),
      'clickHereToGetYourAuthenticationCode'  => esc_html('Click here to get your Authentication code.', 'sagenda-calendar-wp'),
      'shortCodeInfo'                         => __('<strong>[sagenda-calendar-wp]</strong> add this shortcode either in a post or page where you want to display the Sagenda form.', 'sagenda-calendar-wp'),
      'shortCodeOptionDefaultView'            => __('<strong>[sagenda-calendar-wp defaultView="x"]</strong> to define the view you want to open by default, where x is "month", "week", "day", "agenda".', 'sagenda-calendar-wp'),
      'shortCodeOptionFixedBookableItem'      => __('<strong>[sagenda-calendar-wp fixedbookableitem="x"]</strong> where x is the "id" of your bookable item. To know the identifier of your bookable item, you can just go to your bookable item list :  <a href="https://sagenda.net/BookableItems/List" target="_blank">https://sagenda.net/BookableItems/List</a> and select "edit". You will find a button to copy the identifier.', 'sagenda-calendar-wp'),
      'shortCodeOptionUnactivateView'         => __('<strong>[sagenda-calendar-wp removeMonthViewButton="true" removeWeekViewButton="true" removeDayViewButton="true" removeAgendaViewButton="true"]</strong> This will simply remove the corresponding view name to switch from a view to another one.'),
      'shortCodeInfoInPHP'                    => __('If you want to use a shortcode outside of the WordPress post or page editor, you can use this snippet to output it from the shortcode’s handler(s): <pre>echo do_shortcode([sagenda-calendar-wp])</pre>', 'sagenda-calendar-wp'),
      'registeringInfo'                       => esc_html('NOTE: You first need to register on Sagenda and then you will get a Authentication token which you will use to validate this Sagenda Plugin.', 'sagenda-calendar-wp'),
      'readMore'                              => esc_html('Read more', 'sagenda-calendar-wp'),
      'createAccount'                         => esc_html('Create a free account ', 'sagenda-calendar-wp'),
      'aboutIntegrationTitle'                 => esc_html('About integration in your WP WebSite :', 'sagenda-calendar-wp'),
      'howToGetTheTokenTitle'                 => esc_html('How to get the token :', 'sagenda-calendar-wp'),
      'usefulLinksTitle'                      => esc_html('Useful links :', 'sagenda-calendar-wp'),
      'result'                                => $result,
      'color'                                 => $color,
      'connectedStatus'                       => $connectedStatus,
      'tokenValue'                            => $tokenValue,
    ));
  }

  /**
   * Get the authentication code from db or formulary
   * @return string  user authentication code
   */
  private function getAuthenticationToken()
  {
    if (isset($_POST['sagendaAuthenticationCode'])) {
      return sanitize_text_field($_POST['sagendaAuthenticationCode']);
    } else {
      return get_option('mrs1_authentication_code');
    }
  }

  /**
   * Save the authentication code from formulary to db
   */
  private function saveAuthenticationToken()
  {
    if (isset($_POST['sagendaAuthenticationCode'])) {
      // add option does nothing if already exist. So try to create, if exist update the value.
      add_option('mrs1_authentication_code', sanitize_text_field($_POST['sagendaAuthenticationCode']), '', 'yes');
      update_option('mrs1_authentication_code', sanitize_text_field($_POST['sagendaAuthenticationCode']));
    }
  }
}
