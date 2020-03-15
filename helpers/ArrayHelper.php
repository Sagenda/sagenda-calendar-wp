<?php

namespace SagendaCalendar\Helpers;

/**
 * This helper class will give ease the usage of Array.
 */
class ArrayHelper
{

  /**
   * Find the value of an element in an array
   * @param  array   $array     The array to inspect
   * @param  string  $element   The name of the element to find in the array
   * @return   String  The value of given element
   */
  public static function getElementIfSetAndNotEmpty($array, $element)
  {
    if (isset($array)) {
      if (!empty($array)) {
        return $array[$element];
      }
    }
    return;
  }
}
