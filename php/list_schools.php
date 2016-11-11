<?php 

	date_default_timezone_set('Europe/London');
	require_once 'database.php'; // The mysql database connection script

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	$query="select * from schools";
	$schools = $dbconfig->query($query);

	// If schools table is not exmpty
	if ($schools->num_rows > 0) {
		$output = "";
		while($rs = $schools->fetch_array(MYSQLI_ASSOC)) {
		    if ($output != "") {$output .= ",";}
		    $output .= '{"Id":"'.$rs["id"].'",';
		    $output .= '"Name":"'.$rs["name"].'"}'; 
		}
		$output ='{"records":['.$output.']}';

		echo($output);

	} else {
		// If schools table is empty. Get JSON file and decode contents into PHP arrays/values
		$jsonFile = 'school-list.json';
		$jsonData = json_decode(file_get_contents($jsonFile), true);

		$result = [];

		$result = $jsonData['schools'];

		foreach($result as $name => $value){
			echo json_encode($value['name']);
			echo "<br>";

			$query="INSERT INTO schools(name)  VALUES ('".$value['name']."')";
			$school = $dbconfig->query($query);
		}
	}
	 
?>

