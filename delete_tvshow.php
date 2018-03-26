<?php
error_reporting(E_ALL);
include("dbconnect.php");


$showId = null;
if (isset($_GET["showId"])) {
	$showId = $_GET["showId"];
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

<form action="delete_tvshow.php" method="GET">
<h3>Delete the existing showId. Select a showId name you want to delete and press submit.</h3>
<select name="showId"><?php printMultiQueryToOptionList("select showId, CONCAT(showName, ' (', releaseYear, ')') from tvshow"); ?></select>
<input type="submit"></input>
</form>


<?php
if (isset($showId)) {
    if ($stmt = $connection->prepare("delete from tvshow where showId = " . $showId)) {
        $stmt->execute();

        header("Location: delete_tvshow.php?success");
    }
} else if (empty($showId) && !isset($error) && !isset($success)) {
	header("Location: delete_tvshow.php?error");
}

if (isset($success)) {
	echo "showId has been deleted! Please refresh the page to see your changes.<br />";
} else if (isset($error)) {
	echo "The showId type is empty. Please enter in a non-empty showId name.<br />";
}



?>
