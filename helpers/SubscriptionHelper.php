<?php

namespace SagendaCalendar\Helpers;

/**
 * This helper class will give ease the usage of Subscription.
 */
class SubscriptionHelper
{
  // pas certain de faire un helper...

  /**
   * Collect booking information and lauch the Subscription view
   * @param  object  $twig   TWIG template renderer
   */
  public function callSubscription($twig, $bookableItem)
  {
    $booking = new Booking();
    $booking->ApiToken = get_option('mrs1_authentication_code');
    $booking->EventScheduleId = $_GET['EventScheduleId'];
    $booking->DateDisplay = $_GET['DateDisplay']; // TODO : replace this by start end date with API v2.0
    $booking->BookableItemId = $bookableItem->Id;
    $booking->BookableItemName = $_GET['bookableItemName'];
    $booking->EventIdentifier = $_GET['EventIdentifier'];
    $booking->EventTitle = $_GET['eventTitle'];
    //payment Related
    $booking->IsPaidEvent = $_GET['isPaidEvent'];
    $booking->PaymentAmount = $_GET['paymentAmount'];
    $booking->PaymentCurrency = $_GET['paymentCurrency'];
    $booking->HostUrlLocation = $_GET['currentUrl'];
    //TODO : add payment info
    $subscriptionController = new SubscriptionController();
    return $subscriptionController->showSubscription($twig, $booking);
  }
}
