<?php
include("dbconnect_local.php");

$method = $_GET["method"];
$newName = $_GET["newName"];
$newYear = $_GET["newYear"];
$oldName = $_GET["oldName"];
?>

<form action="update_movie.php" method="GET">
<h3>Modify the Credit Name</h3>
<select name="movieId"><?php printQueryToOptionList("select movieId,concat(movieName,releaseYear) from movie"); ?></select>
<input id="newName" placeholder="Change the name to..." name="newName"></input>
<input id="newYear" placeholder="Change Year to" name="newYear"></input>
<input type="submit"></input>
</form>


<?php
if (isset($newName) && isset($oldName)) {
    if ($stmt = $connection->prepare("update credit set movieName = '" . $newName . "' and releaseYear = '.$newYear.' where movieId = " . $movieId)) {
        $stmt->execute();
        echo "Movie has been updated! Please refresh the page to see your changes.<br />";
    }
} 


else if (isset($newYear)) {
	if ($stmt = $connection->prepare("update credit set releaseYear = '".$newYear."' where movieId = " . $movieId)) {
        $stmt->execute();
        echo "Movie has been updated! Please refresh the page to see your changes.<br />";
    }
}
	else if (empty($newCredit)) {
	echo "The Genre name is empty. Please enter in a non-empty name.<br />";
}

?>