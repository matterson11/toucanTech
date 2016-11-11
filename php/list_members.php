<?php 

	date_default_timezone_set('Europe/London');
	require_once 'database.php'; // The mysql database connection

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");


	// Select all members table data
	$query="select * from members";
	$members = $dbconfig->query($query);

		$output = "";
		while($rs = $members->fetch_array(MYSQLI_ASSOC)) {
		    if ($output != "") {$output .= ",";}
		    $output .= '{"id":"'.$rs["id"].'",';
		    $output .= '"name":"'.$rs["name"].'",';
		    $output .= '"email":"'.$rs["email"].'",';
		    $output .= '"uploaded_at":"'.$rs["uploaded_at"].'"}'; 
		}
		$output ='{"records":['.$output.']}';

		echo($output);

?>
