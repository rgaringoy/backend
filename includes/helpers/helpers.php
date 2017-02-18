<?php

/**
 * Clean html entities
 *
 * @param  string $string
 * @return string
 */
function e($string) {
    return htmlentities($string, ENT_QUOTES, 'UTF-8', false);
}

/**
 * Get Url
 *
 * @param  string $uri
 * @return string
 */
function get_url($uri = '/')
{
    return trim(SITE_URL, '/').'/'.trim($uri,'/');
}

/**
 * Get Current Full Url
 *
 * @return string
 */
function get_current_url()
{
    return "http://".array_get($_SERVER, 'HTTP_HOST').array_get($_SERVER, 'REQUEST_URI');
}

/**
 * Get url with token init
 *
 * @param  string $uri
 * @return string
 */
function get_url_token($uri)
{
    $token = get_session_token();
    $url = get_url($uri);
    return $url.url_separator($url).'_token='.urlencode($token);
}

/**
 * Redirect request
 *
 * @param  string $url
 * @return void
 */
function redirect($url)
{
    header('Location: '. $url);
    exit();
}

/**
 * Redirect request
 *
 * @param  string $url
 * @param  null $hash
 * @return void
 */
function redirect_back($url = '/', $hash=null)
{
	$hash = !empty($hash) ? '#'.$hash : null;
	if (strpos(array_get($_SERVER, 'HTTP_REFERER'), SITE_URL) !== false) {
		header('Location: ' . array_get($_SERVER, 'HTTP_REFERER').$hash);
	} else {
		redirect ($url.$hash);
	}

	exit();
}

/**
 * Get url separator
 *
 * @param  string $url
 * @return string
 */
function url_separator($url)
{
    return strpos($url, '?') === false ? '?' : '&';
}

/**
 * Get an item from an array using "dot" notation.
 *
 * @param  mixed   $array
 * @param  string  $key
 * @param  mixed   $default
 * @return mixed
 */
function array_get($array, $key, $default = null)
{
    if (!is_array($array)) return null;

    if (is_null($key)) return $array;

    if (isset($array[$key])) return $array[$key];

    foreach (explode('.', $key) as $segment)
    {
        if ( ! is_array($array) || ! array_key_exists($segment, $array))
        {
            return $default;
        }

        $array = $array[$segment];
    }

    return $array;
}


/**
 * This file is part of the array_column library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) 2013 Ben Ramsey <http://benramsey.com>
 * @license http://opensource.org/licenses/MIT MIT
 */
if (!function_exists('array_column')) {
	/**
	 * Returns the values from a single column of the input array, identified by
	 * the $columnKey.
	 *
	 * Optionally, you may provide an $indexKey to index the values in the returned
	 * array by the values from the $indexKey column in the input array.
	 *
	 * @param array $input A multi-dimensional array (record set) from which to pull
	 * a column of values.
	 * @param mixed $columnKey The column of values to return. This value may be the
	 * integer key of the column you wish to retrieve, or it
	 * may be the string key name for an associative array.
	 * @param mixed $indexKey (Optional.) The column to use as the index/keys for
	 * the returned array. This value may be the integer key
	 * of the column, or it may be the string key name.
	 * @return array
	 */
	function array_column($input = null, $columnKey = null, $indexKey = null)
	{
// Using func_get_args() in order to check for proper number of
// parameters and trigger errors exactly as the built-in array_column()
// does in PHP 5.5.
		$argc = func_num_args();
		$params = func_get_args();
		if ($argc < 2) {
			trigger_error("array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
			return null;
		}
		if (!is_array($params[0])) {
			trigger_error('array_column() expects parameter 1 to be array, ' . gettype($params[0]) . ' given', E_USER_WARNING);
			return null;
		}
		if (!is_int($params[1])
			&& !is_float($params[1])
			&& !is_string($params[1])
			&& $params[1] !== null
			&& !(is_object($params[1]) && method_exists($params[1], '__toString'))
		) {
			trigger_error('array_column(): The column key should be either a string or an integer', E_USER_WARNING);
			return false;
		}
		if (isset($params[2])
			&& !is_int($params[2])
			&& !is_float($params[2])
			&& !is_string($params[2])
			&& !(is_object($params[2]) && method_exists($params[2], '__toString'))
		) {
			trigger_error('array_column(): The index key should be either a string or an integer', E_USER_WARNING);
			return false;
		}
		$paramsInput = $params[0];
		$paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;
		$paramsIndexKey = null;
		if (isset($params[2])) {
			if (is_float($params[2]) || is_int($params[2])) {
				$paramsIndexKey = (int) $params[2];
			} else {
				$paramsIndexKey = (string) $params[2];
			}
		}
		$resultArray = array();
		foreach ($paramsInput as $row) {
			$key = $value = null;
			$keySet = $valueSet = false;
			if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
				$keySet = true;
				$key = (string) $row[$paramsIndexKey];
			}
			if ($paramsColumnKey === null) {
				$valueSet = true;
				$value = $row;
			} elseif (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
				$valueSet = true;
				$value = $row[$paramsColumnKey];
			}
			if ($valueSet) {
				if ($keySet) {
					$resultArray[$key] = $value;
				} else {
					$resultArray[] = $value;
				}
			}
		}
		return $resultArray;
	}
}


/**
 * Check if ajax request
 *
 * @return bool
 */
function is_ajax()
{
    return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') || input_get('_is_ajax', false);
}

/**
 * timestamp to sql date format
 *
 * @param  int $date
 * @return bool|string
 */
function sql_date($date) {
    return date('Y-m-d', $date);
}

/**
 * timestamp to sql datetime format
 *
 * @param  int $date
 * @return bool|string
 */
function sql_datetime($date) {
    return date('Y-m-d', $date);
}

/**
 * timestamp to sql date format
 *
 * return string
 */
function sql_now() {
    return date('Y-m-d H:i:s', time());
}

/**
 * Include path and extract $vars
 * the purpose of this is to avoid global variable conflict
 *
 * @param  string $path - file path
 * @param  $vars
 * @return void
 */
function include_path($path, $vars = []) {
	extract($vars);

	include $path;
}
