<?php

namespace SagendaCalendar\Controllers;

defined('ABSPATH') or die('No script kiddies please!');

use SagendaCalendar\webservices\sagendaAPI;
use SagendaCalendar\Helpers\DateHelper;
use SagendaCalendar\Helpers\ArrayHelper;

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

    $sagendaAPI = new sagendaAPI();

    // you should request name of the shortcode in lowercase
    $fixedBookableItem = ArrayHelper::getElementIfSetAndNotEmpty($shorcodeParametersArray, 'fixedbookableitem');
    $defaultView = ArrayHelper::getElementIfSetAndNotEmpty($shorcodeParametersArray, 'defaultview');
    $removeMonthViewButton = self::convertBoolean(ArrayHelper::getElementIfSetAndNotEmpty($shorcodeParametersArray, 'removemonthviewbutton'));
    $removeWeekViewButton = self::convertBoolean(ArrayHelper::getElementIfSetAndNotEmpty($shorcodeParametersArray, 'removeweekviewbutton'));
    $removeDayViewButton = self::convertBoolean(ArrayHelper::getElementIfSetAndNotEmpty($shorcodeParametersArray, 'removedayviewbutton'));
    $removeAgendaViewButton = self::convertBoolean(ArrayHelper::getElementIfSetAndNotEmpty($shorcodeParametersArray, 'removeagendaviewbutton'));

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
      'removeAgendaViewButton'      => $removeAgendaViewButton,
      'dateFormat'                  => DateHelper::convertDateFormatFromPHPToMomentjs(get_option('date_format')),
      'timeFormat'                  => DateHelper::convertTimeFormatFromPHPToMomentjs(get_option('time_format')),
    ));
  }

  function convertBoolean($value)
  {
    if ($value === 0 | $value === null) {
      return 'false';
    }
    return 'true';
  }
}
