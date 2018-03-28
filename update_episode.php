<?php
include("dbconnect_local.php");

$method = $_GET["method"];
$newCredit = $_GET["newCredit"];
$oldCredit = $_GET["oldCredit"];
?>

<form action="update_movie.php" method="GET">
<h3>Modify the Episode</h3>
<select name="oldCredit"><?php printQueryToOptionList("select episodeId, CONCAT(showName, '(S', seasonNumber, ' E', episodeNumber, ')') from episode JOIN tvshow"); ?></select>
<input id="newCredit" placeholder="Change the episodeNumber to..." name="newCredit"></input>
<input type="submit"></input>
</form>


<?php
if (isset($newCredit) && isset($oldCredit)) { 
    if ($stmt = $connection->prepare("update episode set episodeNumber = '" . $newCredit . "' where episodeId = " . $oldCredit)) {
        $stmt->execute();
        echo "Episode Number has been updated! Please refresh the page to see your changes.<br />";
    }
} else if (empty($newCredit)) {
	echo "The Episode Number  is empty. Please enter in a non-empty name.<br />";
}

?>