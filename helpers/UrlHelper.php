<?php

namespace SagendaCalendar\Helpers;

/**
 * This helper class will give ease the usage of URL.
 */
class UrlHelper
{

  /**
   * Try to get a value by POST if not working use GET
   * @param  string  $value - name of the var to get
   * @return string  var content
   */
  public static function getInput($value)
  {
    if (isset($_POST[$value])) {
      $selectedId = $_POST[$value];
    } else {
      if (isset($_GET[$value])) {
        $selectedId = $_GET[$value];
      }
    }
    return $selectedId;
  }

  /**
   * Get the query part of an URL (after ?) and add a "&" at the end if query is not null
   * @param  string  $url - url to parse
   * @return string  content of the url with "?" and the following code
   */
  public static function getQuery($url)
  {
    if ($url !== null) {
      return parse_url($url, PHP_URL_QUERY);
    }
    return;
  }

  /**
   * Remove just one query from the URL
   * @param  string  $url - url to parse
   * @param  string  $query - the query name
   * @return string   - the url without the given query name nor its value
   */
  public static function removeQuery($url, $query)
  {
    return preg_replace('/([?&])' . $query . '=[^&]+(&|$)/', '$1', $url);
  }

  /**
   * Update one or several queries from the URL
   * @param  string  $url - url to parse
   * @param  string  $array - array of query / values
   * @return string   - the url with updated queries
   */
  public static function updateQuery($url, $array)
  {
    $url_decomposition = parse_url($url);
    $cut_url = explode('?', $url);
    $queries = array_key_exists('query', $url_decomposition) ? $url_decomposition['query'] : false;
    $queries_array = array();
    if ($queries) {
      $cut_queries   = explode('&', $queries);
      foreach ($cut_queries as $k => $v) {
        if ($v) {
          $tmp = explode('=', $v);
          if (sizeof($tmp) < 2) $tmp[1] = true;
          $queries_array[$tmp[0]] = urldecode($tmp[1]);
        }
      }
    }
    $newQueries = array_merge($queries_array, $array);
    return $cut_url[0] . '?' . http_build_query($newQueries);
  }
}
