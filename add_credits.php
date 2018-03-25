<?php
include("dbconnect.php");

$method = $_GET["method"];
?>

<form action="add_credits.php" method="GET">
<h3>Add new credit</h3>
Full Name: <input type="text" id="genre_type"  name="full_name"><br>
Age: <input type="number" name="age"><br>
Gender: <input type="tex" name="gender"><br>

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