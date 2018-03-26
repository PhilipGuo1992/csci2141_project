<?php
error_reporting(E_ALL);
include("dbconnect.php");


$regionId = null;
if (isset($_GET["regionId"])) {
	$regionId = $_GET["regionId"];
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

<form action="delete_region.php" method="GET">
<h3>Delete the existing regionId. Select a regionId name you want to delete and press submit.</h3>
<select name="regionId"><?php printMultiQueryToOptionList("select regionId, regionName from region"); ?></select>
<input type="submit"></input>
</form>


<?php
if (isset($regionId)) {
    if ($stmt = $connection->prepare("delete from region where regionId = " . $regionId)) {
        $stmt->execute();

        header("Location: delete_region.php?success");
    }
} else if (empty($regionId) && !isset($error) && !isset($success)) {
	header("Location: delete_region.php?error");
}

if (isset($success)) {
	echo "regionId has been deleted! Please refresh the page to see your changes.<br />";
} else if (isset($error)) {
	echo "The regionId type is empty. Please enter in a non-empty regionId name.<br />";
}



?>
