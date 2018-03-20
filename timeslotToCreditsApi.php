<?php require_once("dbconnect.php"); 

// simulate database access
sleep(2);
$connection = db_connect();

$output = array();
$query = "select fullName, age, gender from timeslot natural join credit where timeslot_id = " . $_GET["timeslotId"];
    // http://php.net/manual/en/mysqli-result.fetch-row.php
    if ($result = mysqli_query($connection, $query)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_row($result)) {
    	array_push($output, $row);
    }

}

echo json_encode($output);

?>