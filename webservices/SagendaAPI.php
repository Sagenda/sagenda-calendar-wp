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
  protected $apiUrl = 'https://sagenda.net/api/';

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
}
