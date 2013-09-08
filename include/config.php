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
                  : call_user_func($fn, $v);
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
 * Cleans up an array to leave only the requested elements as per param typeToKeep
 *
 * @param typeToKeep The type of data to keep ('student', 'instructor', 'Eng')
 * @param array The data to be cleaned.
 * @returns A cleaned up array.
 */
function cleanArray($typeToKeep, $array)
{
    foreach ($array as $key => $value) {
        if (strpos($key, 'table_' . $typeToKeep) === false) {
            unset($array[$key]);
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
        $return[] = "['".substr(str_replace(array('student_', 'instructor_'), '', $key), 6)."', ".count($array[$key])."]";
    }
    return implode(', ', $return);
}

// Same as above but for Eng codes
function countEngForPieChartDist($array, $time_start, $time_end)
{
    $key_start = $time_start / 2; // key = time / 2;
    $key_end = $time_end / 2;
    $return = array();

    foreach ($array['table_Eng'] as $key => $value) {
        if (($key_start > $key) || ($key_end < $key)) {
            // This is not within our time range -- goodbye.
            unset($array['table_Eng'][$key]);
        }
    }
    foreach (array_count_values($array['table_Eng']) as $key => $value) {
        if ($key != "") {
            $return[] = "['".$key."', ".$value."]";
        }
    }
    return implode(', ', $return);
}

/**
 * Global variable for the data table
 */
$tableElements = array(
    'student_L' => 'Listening',
    'student_Ind' => 'Individual thinking/problem solving',
    'student_CG' => 'Clicker question discussion',
    'student_WG' => 'Group worksheet activity',
    'student_OG' => 'Group activity',
    'student_AnQ' => 'Answering a question posed by instructor',
    'student_SQ' => 'Student asks question',
    'student_WC' => 'Class discussion',
    'student_Prd' => 'Making predictions (e.g. outcome of demo)',
    'student_SP' => 'Student presentation',
    'student_TQ' => 'Test/quiz',
    'student_W' => 'Waiting (instructor late, working on fixing AV problems, instructor otherwise occupied, etc.)',
    'student_O' => 'Other',

    'instructor_Lec' => 'Lecturing',
    'instructor_RtW' => 'Real-time writing',
    'instructor_FUp' => 'Instructor feedback on question/activity',
    'instructor_PQ' => 'Posing non-clicker question to students',
    'instructor_CQ' => 'Clicker question',
    'instructor_AnQ' => 'Listening to/answering student questions',
    'instructor_MG' => 'Moving through class and guiding student learning',
    'instructor_1o1' => 'Focus on small group of individuals',
    'instructor_DV' => 'Demo/video/photo/simulation',
    'instructor_AD' => 'Administration',
    'instructor_W' => 'Waiting (opportunity for instructor to be doing something and not doing so)',
    'instructor_O' => 'Other');