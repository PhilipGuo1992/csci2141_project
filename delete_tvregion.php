<?php
error_reporting(E_ALL);
include("dbconnect.php");


$regionHasShowId = null;
if (isset($_GET["regionHasShowId"])) {
	$regionHasShowId = $_GET["regionHasShowId"];
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

<form action="delete_tvregion.php" method="GET">
<h3>Delete the existing regionHasShowId. Select a regionHasShowId name you want to delete and press submit.</h3>
<select name="regionHasShowId"><?php printMultiQueryToOptionList("select regionHasShowId, CONCAT(regionName, ' -- ', showName) from tvregion natural join region natural join tvshow"); ?></select>
<input type="submit"></input>
</form>


<?php
if (isset($regionHasShowId)) {
    if ($stmt = $connection->prepare("delete from tvregion where regionHasShowId = " . $regionHasShowId)) {
        $stmt->execute();

        header("Location: delete_tvregion.php?success");
    }
} else if (empty($regionHasShowId) && !isset($error) && !isset($success)) {
	header("Location: delete_tvregion.php?error");
}

if (isset($success)) {
	echo "regionHasShowId has been deleted! Please refresh the page to see your changes.<br />";
} else if (isset($error)) {
	echo "The regionHasShowId type is empty. Please enter in a non-empty regionHasShowId name.<br />";
}



?>
