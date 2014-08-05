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
    $category = $_POST['category'];
    $level = $_POST['level'];
    if ($level == ""){
    	
    }
    $location = $_POST['location'];
	$lat = $_POST['latitude2'];
	$lng = $_POST['longitude2'];
	$geometry = "ST_SetSRID(ST_Point(" . $lng . ", " . $lat . "), 4326) ";

	$queryString;

	if ($level == ""){
    	$queryString = "INSERT INTO institution (the_geom, name, category, location) VALUES (" . $geometry . ", '" . $name . "', '" . $category . "', '" . $location . "')";
    
    } else {
		
        $queryString = "INSERT INTO institution (the_geom, name, category, location, level) VALUES (" . $geometry . ", '" . $name . "', '" . $category . "', '" . $location . "', '" . $level . "')";

	}

	$cartodb->runSql($queryString);
	echo "<div class='row'><p>Thank you for contributing to the map! If you made an error and need to delete something please contact the site administrator.</p></div>";
	echo "<div class='row'><p><a href='index.html'>Return to map update forms</a></p></div>";
    
}

?>