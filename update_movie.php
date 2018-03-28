<?php
include("dbconnect_local.php");

$method = $_GET["method"];
$newName = $_GET["newName"];
$newYear = $_GET["newYear"];
$showId = $_GET["showId"];
?>

<form action="update_movie.php" method="GET">
<h3>Modify the Name</h3>
<select name="showId"><?php printQueryToOptionList("select movieId,concat(movieName,releaseYear) from movie"); ?></select>
<input id="newName" placeholder="Change the name to..." name="newName"></input>
<input id="newYear" placeholder="Change Year to" name="newYear"></input>
<input type="submit"></input>
<h5><a href="admin.php">Go To HomePage</a></h5>
</form>


<?php
if (!empty($newName) && isset($showId)) {
    if ($stmt = $connection->prepare("update movie set movieName = '" . $newName . "' where movieId = " . $showId)) {
        $stmt->execute();
		 echo "Movie Name has been updated! Please refresh the page to see your changes.<br />";
    }
if(!empty($newYear) && isset($showId))
	if ($stmt = $connection->prepare("update movie set releaseYear = '".$newYear."' where movieId = " . $showId)) {
        $stmt->execute();
        echo "Movie Release Year has been updated! Please refresh the page to see your changes.<br />";
    }
} 

	else if (empty($newCredit)) {
	echo "The movie name or Release Year is empty. Please enter in a non-empty name.<br />";
}

?>