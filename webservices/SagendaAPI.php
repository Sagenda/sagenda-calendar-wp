<?php

namespace SagendaCalendar\Webservices;

use Unirest;
use SagendaCalendar\Helpers\DateHelper;

if (class_exists('Unirest\Exception') === false) {
  require_once(SAGENDA_CALENDAR_PLUGIN_DIR . 'assets/vendor/mashape/unirest-php/src/Unirest.php');
}

require_once(SAGENDA_CALENDAR_PLUGIN_DIR . 'helpers/DateHelper.php');

/**
 * This class will be responsible for accessing the Sagenda's RESTful API
 */
class SagendaAPI
{
  /**
   * @var string - url of the API
   */
  protected $apiUrl = 'https://sagenda.net/api/'; //Live Server
  // rotected $apiUrl = 'https://sagenda-test.apphb.com/api/'; // TEST
  //protected $apiUrl = 'http://sagenda-dev.apphb.com/api/'; //staging test for payment Server

  public function convertAPITokenToBearerToken($token)
  {
    try {
      $body = "grant_type=api_token&api_token=" . $token;
      $response = Unirest\Request::post(
        $this->apiUrl . "token",
        array(
          "Content-Type" => "application/json",
          "Accept" => "application/json"
        ),
        $body
      );
    } catch (Exception $e) {
      echo "Oups, I did it again : " . $e->getMessage();
    }
    //print_r($response->body->access_token);
    return $response->body->access_token;
  }

  /**
   * Validate the Sagenda's account with the token in order to check if we get access
   * @param  string  $token   The token identifing the sagenda's account
   * @return array array('didSucceed' => boolean -> true if ok, 'Message' => string -> the detail message);
   */
  public function validateAccount($token)
  {
    $result = \Unirest\Request::get($this->apiUrl . "ValidateAccount/" . $token)->body;
    $message = __('Successfully connected', 'sagenda-calendar-wp');
    $didSucceed = true;
    //TODO : use a better checking error code system than string comparaison
    if ($result->Message == "Error: API Token is invalid") {
      $message = __('Your token is wrong; please try again or generate another one in Sagenda’s backend.', 'sagenda-calendar-wp');
      $didSucceed = false;
    }
    return array('didSucceed' => $didSucceed, 'Message' => $message);
  }

  /**
   * Get the bookable items for the given account
   * @param  string          $token                The token identifing the sagenda's account
   */
  public function getBookableItems($token)
  {
    return \Unirest\Request::get($this->apiUrl . "Events/GetBookableItemList/" . $token)->body;
  }

  /**
   * Set a booking without payment
   * @param  string          $token                The token identifing the sagenda's account
   * @param  boolean     $withPayment    True if should manage payment, false if booking should not be paid online.
   */
  public function setBooking($booking, $withPayment)
  {
    $didSucceed = true;
    $wsName = "SetBooking";

    if ($withPayment == "1") {
      $wsName = "SetBookingWithPayment";
    }

    $result = Unirest\Request::post(
      $this->apiUrl . "Events/" . $wsName,
      array(
        "X-Mashape-Key" => "1qj2G3vQg5mshgOPxMAFsmrfleIap1lPGN8jsn8v0qG4AIuFJa",
        "Content-Type" => "application/json",
        "Accept" => "application/json"
      ),
      $booking->toJson()
    );

    if ($result->Message == "An error has occurred.") {
      $message = __("An error has occurred. Booking wasn't saved.", 'sagenda-calendar-wp');
      $didSucceed = false;
    }

    $apiOutput = json_decode($result->raw_body);

    if ($apiOutput->ReturnUrl != "") {
      return array('didSucceed' => $didSucceed, 'Message' => $message, 'ReturnUrl' => $apiOutput->ReturnUrl);
    }

    return array('didSucceed' => $didSucceed, 'Message' => $message, 'ReturnUrl' => "");
  }

  /**
   * Get the bookable items for the given account
   * @param  string  $token   The token identifing the sagenda's account
   */
  public function getAvailability($token, $fromDate, $toDate, $bookableItemId)
  {
    return self::setDateTimeFormat(\Unirest\Request::get($this->apiUrl . "Events/GetAvailability/" . $token . "/" . rawurlencode($fromDate) . "/" . rawurlencode($toDate) . "?bookableItemId=" . $bookableItemId));
  }

  /**
   * Set the date and time format according to WP values
   * @param  array  $bookings   List of bookings
   */
  private static function setDateTimeFormat($bookings)
  {
    if ($bookings !== null) {
      if (!empty($bookings->body)) {
        foreach ($bookings->body as $booking) {
          $booking->DateDisplay = DateHelper::setDateTimeFormat($booking->From) . " - " . DateHelper::setDateTimeFormat($booking->To);
        }
      }
    }

    return $bookings;
  }
}
