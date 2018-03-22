<?php
include("dbconnect.php");

$method = $_GET["method"];
?>

<!-- https://stackoverflow.com/questions/503093/how-do-i-redirect-to-another-webpage -->
<h3>Add a TV show</h3>

<form action="add_tv_show.php" method="GET">
TV Show Name: <input type="text" name="tv_show"></input>
<select name="prod_companies"><?php printQueryToOptionList("select * from production"); ?><option onclick="window.location.href='add_production.php'" name="-1">Add new production...</option></select>
<select name="genres"><?php printQueryToOptionList("select * from genre"); ?><option onclick="javascript:window.location.href='add_genre.php" name="-1">Add new genre...</option></select>
<input type="number" name="year" placeholder="Enter year..." value="2000"></input>
<input type="submit"></input>
</form>


<?php
if (isset($_GET["prod_companies"]) && isset($_GET["genres"]) && isset($_GET["year"])) {
    if ($stmt = $connection->prepare("INSERT INTO tvshow(showName,prodId,genreId,releaseYear) values('" . $_GET["tv_show"] . "', '" . $_GET["prod_companies"] . "', '" . $_GET["genres"] . "', '" . $_GET["year"] . "')")) {
        $stmt->execute();
        echo "Show has been added!<br />";
    }
} else {
	echo "At least one field was left blank. No queries performed.<br />";
}

?>