<?php
require('include/config.php');
global $mysqli;

if (!isset($_POST)) {
    echo 'You cannot access this page.';
	exit();
}
$array = objectToArray($_POST);
unset($array['submit']);

try {
    $data = arrayToCleanJSON($array);
    
    // We now have the data in JSON format so save it in the database.
    $query = $mysqli->prepare('INSERT INTO `data` (`value`) VALUES (?);');
    $query->bind_param('s', $data);
    $query->execute();
    $query->close();
} catch (mysqli_sql_exception $e) {
    // Database isn't working so we'll save it to the filesystem and inform the
    // user to contact webmaster to resolve the problem.
	$fileName = date('U') . mt_rand(0, 9999);
	
	try { 
	    $file = fopen($fileName . '.txt', 'w');
		fwrite($file, $data);
		fclose($file);
		exit('The database could not be updated. Please contact the webmaster with the following code: ' . $fileName);
	} catch (Exception $e) {
        // Filesystem doesn't work either. Check the error log.
		exit('The class data could not be saved.');
	}
}
header('Location: view.php?id=' . $mysqli->insert_id);
exit;