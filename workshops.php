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
    $title = pg_escape_string($_POST['title']);
	$description = pg_escape_string($_POST['description']);
	$lat = $_POST['latitude3'];
	$lng = $_POST['longitude3'];
	$geometry = "ST_SetSRID(ST_Point(" . $lng . ", " . $lat . "), 4326) ";
	

	$location = $_POST['location'];
	$photolink = $_POST['photolink'];
	$date = $_POST['date'];
	$url = $_POST['url'];

	$queryString = "INSERT INTO workshops (the_geom, title, description, date, url, location, photolink) VALUES (" . $geometry . ", '" . $title . "', '" . $description . "', '" . $date . "', '" . $url . "', '" . $location . "', '" . $photolink . "')";

	$cartodb->runSql($queryString);
	echo "<div class='row'><p>Thank you for contributing to the map! If you made an error and need to delete something please contact the site administrator.</p></div>";
	echo "<div class='row'><p><a href='index.html'>Return to map update forms</a></p></div>";
    
}

//ST_SetSRID(ST_Point(-110, 43),4326))



?>