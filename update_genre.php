<?php
include("dbconnect.php");

$method = $_GET["method"];
$newGenre = $_GET["newGenre"];
$oldGenre = $_GET["oldGenre"];
?>

<form action="update_genre.php" method="GET">
<h3>Modify the Genre type</h3>
<select name="oldGenre"><?php printQueryToOptionList("select * from genre"); ?></select>
<input id="newGenre" placeholder="Change the name to..." name="newGenre"></input>
<input type="submit"></input>
</form>


<?php
if (isset($newGenre) && isset($oldGenre)) {
    if ($stmt = $connection->prepare("update genre set genreType = '" . $newGenre . "' where prodId = " . $oldGenre)) {
        $stmt->execute();
        echo "Genre has been updated! Please refresh the page to see your changes.<br />";
    }
} else if (empty($newGenre)) {
	echo "The Genre name is empty. Please enter in a non-empty name.<br />";
}

?>