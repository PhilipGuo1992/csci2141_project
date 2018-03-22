<?php
include("dbconnect.php");

$method = $_GET["method"];


$genreId = $_GET["genre_type"];

$error = $_GET["error"];
$success = $_GET["success"];
?>

<form action="delete_genre.php" method="GET">
<h3>Delete the existing Genre. Select a Genre type to delete and press submit.</h3>
<select name="genre_type"><?php printQueryToOptionList("select * from genre"); ?></select>
<input type="submit"></input>
</form>


<?php
if (isset($genreId)) {
    if ($stmt = $connection->prepare("delete from genre where genreId = " . $genreId)) {
        $stmt->execute();

        header("Location: delete_genre.php?success");
    }
} else if (empty($genreId) && !isset($error) && !isset($success)) {
	header("Location: delete_genre.php?error");
}

if (isset($success)) {
	echo "Genre has been deleted! Please refresh the page to see your changes.<br />";
} else if (isset($error)) {
	echo "The Genre type is empty. Please enter in a non-empty production name.<br />";
}



?>