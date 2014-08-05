<?php

require_once 'cartodb.class.php';
require_once 'cartodb.config.php';

$config = getConfig();
$cartodb =  new CartoDBClient($config);

// Check if the $key and $secret work fine and you are authorized
if (!$cartodb->authorized) {
  error_log("uauth");
  print 'There is a problem authenticating, check the key and secret.';
  exit();
}


if(isset($_POST['SubmitCheck'])) {
    // The form has been submited
    // Check the values!
    $name = pg_escape_string($_POST['name']);
	$description = pg_escape_string($_POST['description']);
	$lat = $_POST['latitude'];
	$lng = $_POST['longitude'];
	$geometry = "ST_SetSRID(ST_Point(" . $lng . ", " . $lat . "), 4326) ";
	

	$location = $_POST['location'];
	$photolink = $_POST['photolink'];

	$queryString = "INSERT INTO stewardship (the_geom, name, description, location, photolink) VALUES (" . $geometry . ", '" . $name . "', '" . $description . "', '" . $location . "', '" . $photolink . "')";
	
	$cartodb->runSql($queryString);
	echo "<div class='row'><p>Thank you for contributing to the map! If you made an error and need to delete something please contact the site administrator.</p></div>";
	echo "<div class='row'><p><a href='index.html'>Return to map update forms</a></p></div>";
    
}

//ST_SetSRID(ST_Point(-110, 43),4326))



?>