<?php 

date_default_timezone_set('Europe/London');
require_once 'database.php'; // The mysql database connection script

 $post_date = file_get_contents("php://input");
 $data = json_decode($post_date);

 	// Add new member

	$result = [];

	$result['name'] = $data->name;
	$result['email'] = $data->email;
	$result['school'] = $data->school;
	$result['uploaded_time'] = date("Y-m-d");

	// Check when member already exists in members table
	$query = $dbconfig->query("select name, email from members where name = '" . $result['name'] . "'
    and email = '" . $result['email'] . "' ");

    if ($query->num_rows == 0) {

    	// Insert data into members table
		$resulting = $dbconfig->query("INSERT INTO members(name, email, uploaded_at)  VALUES ('".$result['name']."', '".$result['email']."', '".$result['uploaded_time']."')");

		// Get the id from the recently added member
		$member_id = $dbconfig->query("select id from members where email = '" . $result['email'] . "' ");
		$id = $member_id->fetch_object()->id;

		// Insert member and school id into member_school table
		$member_school = $dbconfig->query("INSERT INTO member_school(member_id, school_id)  VALUES ('".$id."', '".$result['school']."')");
		
	}
