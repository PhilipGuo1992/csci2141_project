<?php
include("dbconnect_local.php");

$method = $_GET["method"];
$newCredit = $_GET["newCredit"];
$oldCredit = $_GET["oldCredit"];
?>

<form action="update_movie.php" method="GET">
<h3>Modify the Credit Name</h3>
<select name="oldCredit"><?php printQueryToOptionList("select movieId,movieName from movie"); ?></select>
<input id="newCredit" placeholder="Change the name to..." name="newCredit"></input>
<input type="submit"></input>
<h5><a href="admin.php">Go To HomePage</a></h5>
</form>


<?php
if (isset($newCredit) && isset($oldCredit)) { 
    if ($stmt = $connection->prepare("update movie set movieName = '" . $newCredit . "' where movieIdId = " . $oldCredit)) {
        $stmt->execute();
        echo "Movie Name has been updated! Please refresh the page to see your changes.<br />";
    }
} else if (empty($newCredit)) {
	echo "The Movie name is empty. Please enter in a non-empty name.<br />";
}

?>