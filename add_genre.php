<?php
include("dbconnect.php");

$method = $_GET["method"];
?>

<form action="add_genre.php" method="GET">
<h3>Add new Genre</h3>
<input id="genre_type" placeholder="New Genre name." name="genre_type"></input>
<input type="submit"></input>
</form>


<?php
if (isset($_GET["genre_type"])) {
    if ($stmt = $connection->prepare("insert into genre values (NULL, '" . $_GET["genre_type"] . "');")) {
        $stmt->execute();
        echo "New Genre has been added!<br />";
    }
} else if (empty($_GET["genre_type"])) {
	echo "The Genre name is empty. Please enter in a non-empty name.<br />";
}

?>