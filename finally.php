<?php
require('include/config.php');
global $mysqli, $_GET;
$id = intval($_GET['id']);

if ((!isset($_GET['id'])) || ($id <= 0)) {
    exit('Could not retrieve requested session.');
}
try { 
    $query = $mysqli->prepare('SELECT `date`, `value` FROM `data` WHERE `id` = ?;');
	$query->bind_param('i', $id);
    $query->execute();
    $query->bind_result($date, $data);
    $query->fetch();
    $query->close();
    $data = json_decode($data, true);
} catch (mysqli_sql_exception $e) {
	exit('Could not retrieve requested session.');
}
if (!$data) {
	exit('Could not retrieve requested session.');
}