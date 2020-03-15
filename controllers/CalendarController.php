<?php

namespace SagendaCalendar\Controllers;

defined('ABSPATH') or die('No script kiddies please!');

use SagendaCalendar\webservices\sagendaAPI;
use SagendaCalendar\Helpers\PickadateHelper;
use SagendaCalendar\Helpers\DateHelper;
use SagendaCalendar\Helpers\ArrayHelper;
use SagendaCalendar\Helpers\UrlHelper;
use SagendaCalendar\Models\Entities\Booking;
use SagendaCalendar\Models\Entities\BookableItem;

include_once(SAGENDA_CALENDAR_PLUGIN_DIR . 'helpers/PickadateHelper.php');
include_once(SAGENDA_CALENDAR_PLUGIN_DIR . 'helpers/UrlHelper.php');
include_once(SAGENDA_CALENDAR_PLUGIN_DIR . 'helpers/DateHelper.php');
include_once(SAGENDA_CALENDAR_PLUGIN_DIR . 'helpers/ArrayHelper.php');
include_once(SAGENDA_CALENDAR_PLUGIN_DIR . 'webservices/SagendaAPI.php');
include_once(SAGENDA_CALENDAR_PLUGIN_DIR . 'models/entities/Booking.php');
include_once(SAGENDA_CALENDAR_PLUGIN_DIR . 'models/entities/BookableItem.php');

/**
 * This controller will be responsible for displaying the free events in frontend in order to be searched and booked by the visitor.
 */
class CalendarController
{

  /**
   * @var string - name of the view to be displayed
   */
  private $view = "calendar.twig";

  /**
   * Display the calendar form
   * @param    Array   The shortcode parameters
   * @param  object  $twig   TWIG template renderer
   */
  public function showCalendar($twig, $shorcodeParametersArray)
  {
    if (get_option('mrs1_authentication_code') == null) {
      return $twig->render($this->view, array(
        'isError'                  => true,
        'hideSearchForm'           => true,
        'errorMessage'             => __("You didn't configure Sagenda properly please enter your authentication code in Settings", 'sagenda-calendar-wp'),
      ));
      return;
    }

    if (isset($_GET['EventIdentifier'])) {
      $subscriptionController = new SubscriptionController();
      return $subscriptionController->callSubscription($twig);
    }

    $sagendaAPI = new sagendaAPI();

    // you should request name of the shortcode in lowercase
    $fixedBookableItem = ArrayHelper::getElementIfSetAndNotEmpty($shorcodeParametersArray, 'fixedbookableitem');
    $defaultView = ArrayHelper::getElementIfSetAndNotEmpty($shorcodeParametersArray, 'defaultview');
    $removeMonthViewButton = ArrayHelper::getElementIfSetAndNotEmpty($shorcodeParametersArray, 'removemonthviewbutton');
    $removeWeekViewButton = ArrayHelper::getElementIfSetAndNotEmpty($shorcodeParametersArray, 'removeweekviewbutton');
    $removeDayViewButton = ArrayHelper::getElementIfSetAndNotEmpty($shorcodeParametersArray, 'removedayviewbutton');

    return $twig->render($this->view, array(
      'SAGENDA_CALENDAR_PLUGIN_URL'          => SAGENDA_CALENDAR_PLUGIN_URL,
      'sagendaToken'                => get_option('mrs1_authentication_code'),
      'bearerToken'                 => $sagendaAPI->convertAPITokenToBearerToken(get_option('mrs1_authentication_code')),
      'weekStartsOn'                => get_option('start_of_week'),
      'defaultView'                 => $defaultView,
      'languageCultureShortName'    => get_locale(),
      'fixedBookableItem'           => $fixedBookableItem,
      'removeMonthViewButton'       => $removeMonthViewButton,
      'removeWeekViewButton'        => $removeWeekViewButton,
      'removeDayViewButton'         => $removeDayViewButton,
      'dateFormat'                  => DateHelper::convertDateFormatFromPHPToMomentjs(get_option('date_format')),
      'timeFormat'                  => DateHelper::convertTimeFormatFromPHPToMomentjs(get_option('time_format')),
    ));
  }
}
