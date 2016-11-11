<?php 

	date_default_timezone_set('Europe/London');
	require_once 'database.php'; // The mysql database connection script

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

//Get form input
	$post_date = file_get_contents("php://input");
 	$data = json_decode($post_date);

	$result = [];

	$result['id'] = $data->id;

    $members = $dbconfig->query("select 
    	members.id, 
    	members.name, 
    	members.email, 
    	members.uploaded_at,
    	schools.name as school_name
    from members
	join member_school on members.id = member_school.member_id 
	join schools on member_school.school_id = schools.id
	where member_school.school_id = '".$result['id']."' ");

	$output = "";
	while($rs = $members->fetch_array(MYSQLI_ASSOC)) {
	    if ($output != "") {$output .= ",";}
	    $output .= '{"id":"'.$rs["id"].'",';
	    $output .= '"name":"'.$rs["name"].'",';
	    $output .= '"email":"'.$rs["email"].'",';
	    $output .= '"uploaded_at":"'.$rs["uploaded_at"].'",';
	    $output .= '"school_name":"'.$rs["school_name"].'"}'; 
	}
	$output ='{"records":['.$output.']}';

	echo($output);


