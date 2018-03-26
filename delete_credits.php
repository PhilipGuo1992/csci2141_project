<?php
include("dbconnect.php");

$method = $_GET["method"];


$creditId = $_GET["fullName"];

$error = $_GET["error"];
$success = $_GET["success"];
?>

<form action="delete_credits.php" method="GET">
<h3>Delete the existing Credit. Select a Credit Name you want to delete and press submit.</h3>
<select name="genre_type"><?php printQueryToOptionList("select * from credit"); ?></select>
<input type="submit"></input>
</form>


<?php
if (isset($genreId)) {
    if ($stmt = $connection->prepare("delete from credit where creditId = " . $crediId)) {
        $stmt->execute();

        header("Location: delete_genre.php?success");
    }
} else if (empty($genreId) && !isset($error) && !isset($success)) {
	header("Location: delete_credits.php?error");
}

if (isset($success)) {
	echo "Credit has been deleted! Please refresh the page to see your changes.<br />";
} else if (isset($error)) {
	echo "The Credit type is empty. Please enter in a non-empty production name.<br />";
}



?>