<?php
error_reporting(E_ALL);
include("dbconnect.php");


$timeslotId = null;
if (isset($_GET["timeslotId"])) {
	$timeslotId = $_GET["timeslotId"];
}

$error = null;
if (isset($_GET["error"])) {
	$error = $_GET["error"];
}


$success = null;
if (isset($_GET["success"])) {
	$success = $_GET["success"];
}


?>

<form action="delete_timeslot.php" method="GET">
<h3>Delete the existing timeslotId. Select a timeslotId name you want to delete and press submit.</h3>
<select name="timeslotId"><?php printMultiQueryToOptionList("select timeslot_id, CONCAT(timeslot_start, ' to ', timeslot_end) from timeslot"); ?></select>
<input type="submit"></input>
</form>


<?php
if (isset($timeslotId)) {
    if ($stmt = $connection->prepare("delete from timeslot where timeslot_id = " . $timeslotId)) {
        $stmt->execute();

        header("Location: delete_timeslot.php?success");
    }
} else if (empty($timeslotId) && !isset($error) && !isset($success)) {
	header("Location: delete_timeslot.php?error");
}

if (isset($success)) {
	echo "timeslotId has been deleted! Please refresh the page to see your changes.<br />";
} else if (isset($error)) {
	echo "The timeslotId type is empty. Please enter in a non-empty timeslotId name.<br />";
}



?>
