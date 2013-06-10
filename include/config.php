<?php
require('db.php');
date_default_timezone_set('America/Vancouver');

$mysqli = new mysqli($global['host'], $global['username'], $global['password'], $global['database']);

if ($mysqli->connect_errno) {
    echo 'Connection Failed: ' . $mysqli->connect_errno;
    exit();
}

/**
 * array_map for multi-dimensional arrays
 *
 * @author qeremy (from: http://php.net/manual/en/function.array-map.php)
 * @param fn The function that will modify each array element
 * @param arr The array to modify
 * @return The array with fn applied to each element
 */
function array_map_recursive($fn, $arr)
{
    $rarr = array();
    foreach ($arr as $k => $v) {
        $rarr[$k] = is_array($v)
                  ? array_map_recursive($fn, $v)
                  : $fn($v); // or call_user_func($fn, $v)
    }
    return $rarr;
}

/**
 * Converts a POSTed object to complete array form.
 *
 * @param object The data to be converted.
 * @returns The converted data.
 */
function objectToArray($object)
{
	if (is_object($object)) {
		$object = get_object_vars($object);
	}
    return is_array($object)
         ? array_map(__FUNCTION__, $object)
         : $object;
}

/**
 * Converts an array of POSTed data to JSON format and sanitizes the result.
 *
 * @param array The data to be converted and sanitized.
 * @returns A string in JSON form that is cleaned with htmlentities.
 */
function arrayToCleanJSON($array)
{
	return json_encode(array_map_recursive('htmlentities', $array));
}

/**
 * Cleans up an array to leave only the elements prefixed with table_. Also 
 * removes extraneous fields (Eng, Comments).
 *
 * @param array The data to be cleaned.
 * @returns A cleaned up array.
 */
function cleanArray($array)
{
    foreach ($array as $key => $value) {
        if (substr($key, 0, 6) != 'table_') {
            unset($array[$key]);
        } else {
            switch(substr($key, 6)) { 
                case 'Eng': // We aren't working with these ones.
                case 'Comments':
                    unset($array[$key]);
                    break;
            }
        }
    }
    return $array;
}

/**
 * Counts the data input as appropriate for a pie chart distribution of events.
 *
 * This converts the CDOP data to something that can be read by Google's
 * graphing API. The elements are formatted as: ['name', #], ['name', #], etc.
 *
 * @param array The data to be counted.
 * @param time_start The index in which to start counting for the array.
 * @param time_end The index in which to end counting for the array.
 * @returns An data set in the format as detailed above.
 */
function countForPieChartDist($array, $time_start, $time_end)
{
    $key_start = $time_start / 2; // key = time / 2;
    $key_end = $time_end / 2;
    $return = array();
    
    foreach ($array as $key => $value) { 
        foreach ($value as $keyb => $valueb) {
            if (($key_start > $keyb) || ($key_end < $keyb)) { 
                // This is not within our time range -- goodbye.
                unset($array[$key][$keyb]);
            }
        }
        // ['name'], #] where 'name' has the table_ prefix removed.
        $return[] = "['".substr($key, 6)."', ".count($array[$key])."]";
    }
    return implode(', ', $return);
}

/**
 * Global variable for the data table
 */
$tableElements = array(
    'L' => 'Listening',
    'Ind' => 'Individual thinking/problem solving',
    'CG' => 'Clicker question discussion',
    'WG' => 'Group worksheet activity',
    'OG' => 'Group activity',
    'AnQS' => 'Answering a question posed by instructor',
    'SQ' => 'Student asks question',
    'WC' => 'Class discussion',
    'Prd' => 'Making predictions (e.g. outcome of demo)',
    'SP' => 'Student presentation',
    'TQ' => 'Test/quiz',
    'SW' => 'Waiting (no instructor, technical issues, instructor busy)',
    'SO' => 'Other',

    'Lec' => 'Lecturing',
    'RtW' => 'Real-time writing',
    'FUp' => 'Instructor feedback on question/activity',
    'PQ' => 'Posing non-clicker question to students',
    'CQ' => 'Clicker question',
    'AnQI' => 'Listening to/answering student questions',
    'MG' => 'Moving through class and guiding student learning',
    '1o1' => 'Focus on small group of individuals',
    'DV' => 'Demo/video/photo/simulation',
    'AD' => 'Administration',
    'IW' => 'Waiting',
    'IO' => 'Other');