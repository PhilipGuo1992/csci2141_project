<?php
error_reporting(E_ALL);
include("dbconnect.php");


$episodeId = null;
if (isset($_GET["episodeId"])) {
	$episodeId = $_GET["episodeId"];
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

<form action="delete_episode.php" method="GET">
<h3>Delete the existing episode. Select a episodeId name you want to delete and press submit.</h3>
<select name="episodeId"><?php printMultiQueryToOptionList("select episodeId, CONCAT(showName, '(S', seasonNumber, ' E', episodeNumber, ')') from episode JOIN tvshow"); ?></select>
<input type="submit"></input>
</form>


<?php
if (isset($episodeId)) {
    if ($stmt = $connection->prepare("delete from episode where episodeId = " . $episodeId)) {
        $stmt->execute();

        header("Location: delete_episode.php?success");
    }
} else if (empty($episodeId) && !isset($error) && !isset($success)) {
	header("Location: delete_episode.php?error");
}

if (isset($success)) {
	echo "episodeId has been deleted! Please refresh the page to see your changes.<br />";
} else if (isset($error)) {
	echo "The episodeId type is empty. Please enter in a non-empty episodeId name.<br />";
}



?>
