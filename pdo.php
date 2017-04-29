<?php

// Data source name
$dsn = 'mysql:dbname=cakephp;host=127.0.0.1';
$user = 'cakephp';
$password = '';

// Try to connect to the database
try {
	$pdoConnection = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
	die('Error: ' . $e->getMessage());
}

// The SQL query contains a named parameter "owner" which has to be replaced later on
$selectQuery = 'SELECT owner, model, horsePower, color FROM `cars` WHERE `owner` = :owner';

// The insert query contains two numbered parameters; these have to be assigned in the right order
$insertQuery = 'INSERT INTO `cars`(owner, model, horsePower, color) VALUES (?, ?, ?, ?)';

// Prepare the statements
$selectStatement = $pdoConnection->prepare($selectQuery);
$insertStatement = $pdoConnection->prepare($insertQuery);

// Insert a new car, bind the numeric parameters
$insertStatement->execute([
	'Dennis Westphal',
	'Audi R8',
	520,
	'blue'
]);

// Execute the statement and bind the parameter owner to the value "Dennis Westphal"
$selectStatement->execute([
	'owner' => 'Dennis Westphal'
]);

// Get all results as associative array (within a numeric array)
$results = $selectStatement->fetchAll(PDO::FETCH_ASSOC);

// Iterate over the results
foreach($results as $row) {
	echo 'Car: ' . $row['model'];
	echo ' with '.$row['horsePower'];
	echo ' is ' . $row['color'];
	echo ' and owned by '.$row['owner'];
	echo '<br>';
}