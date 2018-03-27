<?php
include("dbconnect_local.php");

$method = $_GET["method"];
$newName = $_GET["newName"];
$newYear = $_GET["newYear"];
$movieId = $_GET["movieId"];
?>

<form action="update_movie.php" method="GET">
<h3>Update Movie</h3>
<select name="movieId"><?php printQueryToOptionList("select movieId,concat(movieName,releaseYear) from movie"); ?></select>
<input id="newName" placeholder="Change the name to..." name="newName"></input>
<input id="newYear" placeholder="Change Year to" name="newYear"></input>
<input type="submit"></input>
</form>


<?php

	echo($newName);
	echo($movieId);
	echo($newYear);
	$nav = "update credit set movieName = '" . $newName . "' where movieId = " . $movieId;
	echo($nav);
	exit();
    if ($stmt = $connection->prepare("update credit set movieName = '" . $newName . "' where movieId = " . $movieId)) {
        $stmt->execute();
        echo "Movie has been updated! Please refresh the page to see your changes.<br />";
    }
	if ($stmt = $connection->prepare("update credit set releaseYear = '".$newYear."' where movieId = " . $movieId)) {
        $stmt->execute();
        echo "Movie has been updated! Please refresh the page to see your changes.<br />";
    }
?>