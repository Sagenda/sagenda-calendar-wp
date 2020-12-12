<?php

namespace SagendaCalendar\Helpers;

/**
 * This helper class will give ease the usage of Date (and Time).
 * THING TO REMEMBER :
 * "DateTime::createFromFormat"   can't display litteral version of month in very languages.
 * "strftime"   can't escape char with \ in format
 */
class DateHelper
{
  /**
   * This method convert a PHP date time format to Momentjs date time format.
   * PHP doc : https://codex.wordpress.org/fr:Modifier_Date_et_Heure
   * Momentjs doc : http://momentjs.com/docs/#/displaying/
   * For example :
   * d => DD
   * @param  string  $value   the date format to be converted
   */
  public static function convertDateFormatFromPHPToMomentjs($value)
  {
    // Day
    if (strpos($value, 'jS') !== false) {
      $value = str_replace("jS", "Do", $value);
    } else {
      $value = str_replace("D", "ddd", $value);
      $value = str_replace("d", "DD", $value);
      $value = str_replace("j", "D", $value);
      $value = str_replace("l", "dddd", $value);
    }

    // month
    $value = str_replace("M", "MMM", $value);
    $value = str_replace("m", "MM", $value);
    $value = str_replace("n", "M", $value);
    $value = str_replace("F", "MMMM", $value);

    // year
    $value = str_replace("Y", "YYYY", $value);
    $value = str_replace("y", "YY", $value);

    return $value;
  }

  /**
   * This method convert a PHP date time format to Momentjs date time format.
   * PHP doc : https://codex.wordpress.org/fr:Modifier_Date_et_Heure
   * Momentjs doc : http://momentjs.com/docs/#/displaying/
   * For example :
   * s => ss
   * @param  string  $value   the date format to be converted
   */
  public static function convertTimeFormatFromPHPToMomentjs($value)
  {
    // Heure
    $value = str_replace("h", "hh", $value);
    $value = str_replace("g", "h", $value);
    $value = str_replace("H", "HH", $value);
    $value = str_replace("G", "H", $value);
    $value = str_replace("i", "mm", $value);
    $value = str_replace("s", "ss", $value);
    $value = str_replace("T", "z", $value);

    return $value;
  }
}
