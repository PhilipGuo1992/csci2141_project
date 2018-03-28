<?php
include("dbconnect_local.php");

$method = $_GET["method"];
$newCredit = $_GET["newCredit"];
$oldCredit = $_GET["oldCredit"];
?>

<form action="update_episode.php" method="GET">
<h3>Modify the Episode</h3>
<select name="oldCredit"><?php printQueryToOptionList("select episodeId, CONCAT(showName, '(S', seasonNumber, ' E', episodeNumber, ')') from episode JOIN tvshow"); ?></select>
<input id="newCredit" placeholder="Change the Runtime to..." name="newCredit"></input>
<input type="submit"></input>
<h5><a href="admin.php">Go To HomePage</a></h5>
</form>


<?php
if (isset($newCredit) && isset($oldCredit)) { 
    if ($stmt = $connection->prepare("update episode set runtimeMinutes = '" . $newCredit . "' where episodeId = " . $oldCredit)) {
        $stmt->execute();
        echo "Runtime has been updated! Please refresh the page to see your changes.<br />";
    }
} else if (empty($newCredit)) {
	echo "Runtime is empty. Please enter in a non-empty name.<br />";
}

?>