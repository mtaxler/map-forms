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
    $firstname = pg_escape_string($_POST['firstname']);
    $lastname = pg_escape_string($_POST['lastname']);
    $email = pg_escape_string($_POST['email']);
    $institutionName = pg_escape_string($_POST['institutionName']);
    $link = pg_escape_string($_POST['link']);
    $linkDescription = pg_escape_string($_POST['linkDescription']);
    $photolink = $_POST['photolink'];
    $subject = $_POST['subject'];

	$queryString;
    
    $queryString = "INSERT INTO people (firstname, lastname, email, institutionname, link, linkdescription, photolink, subject) VALUES ('" . $firstname . "', '" . $lastname . "', '" . $email . "', '" . $institutionName . "', '" . $link . "', '" . $linkDescription . "', '" . $photolink . "', '" . $subject . "')";

    $cartodb->runSql($queryString);

	echo "<div class='row'><p>Thank you for contributing to the map! If you made an error and need to delete something please contact the site administrator.</p></div>";
	echo "<div class='row'><p><a href='index.html'>Return to map update forms</a></p></div>";
    
}

?>