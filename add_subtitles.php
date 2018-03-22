<?php
include("dbconnect.php");

$method = $_GET["method"];
?>

<form action="add_subtitle.php" method="GET">
<h3>Add new subtitle</h3>
<input id="subtitle_type" placeholder="New subtitle type." name="subtitle_type"></input>
<input type="submit"></input>
</form>


<?php
if (isset($_GET["subtitle_type"])) {
    if ($stmt = $connection->prepare("insert into subtitle values (NULL, '" . $_GET["subtitle_type"] . "');")) {
        $stmt->execute();
        echo "New subtitle has been added!<br />";
    }
} else if (empty($_GET["genre_type"])) {
	echo "The subtitle name is empty. Please enter in a non-empty name.<br />";
}

?>