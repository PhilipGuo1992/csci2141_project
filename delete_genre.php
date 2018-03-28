<?php
error_reporting(E_ALL);
include("dbconnect.php");


$genreId = null;
if (isset($_GET["genreId"])) {
	$genreId = $_GET["genreId"];
}

$error = null;
if (isset($_GET["error"])) {
	$error = $_GET["error"];
}


$success = null;
if (isset($_GET["success"])) {
	$success = $_GET["success"];
}


?>

<form action="delete_genre.php" method="GET">
<h3>Delete the existing genre. Select a genre name you want to delete and press submit.</h3>
<select name="genreId"><?php printMultiQueryToOptionList("select * from genre"); ?></select>
<input type="submit"></input>
<h5><a href="admin.php">Go To HomePage</a></h5>
</form>


<?php
if (isset($genreId)) {
    if ($stmt = $connection->prepare("delete from genre where genreId = " . $genreId)) {
        $stmt->execute();

        header("Location: delete_genre.php?success");
    }
} else if (empty($creditId) && !isset($error) && !isset($success)) {
	header("Location: delete_genre.php?error");
}

if (isset($success)) {
	echo "genreId has been deleted! Please refresh the page to see your changes.<br />";
} else if (isset($error)) {
	echo "The genreId type is empty. Please enter in a non-empty genreId name.<br />";
}



?>
