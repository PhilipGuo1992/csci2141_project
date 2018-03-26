<?php
error_reporting(E_ALL);
include("dbconnect.php");


$movieId = null;
if (isset($_GET["movieId"])) {
	$movieId = $_GET["movieId"];
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

<form action="delete_movie.php" method="GET">
<h3>Delete the existing movieId. Select a movieId name you want to delete and press submit.</h3>
<select name="movieId"><?php printMultiQueryToOptionList("select movieId, movieName from movie"); ?></select>
<input type="submit"></input>
</form>


<?php
if (isset($movieId)) {
    if ($stmt = $connection->prepare("delete from movie where movieId = " . $movieId)) {
        $stmt->execute();

        header("Location: delete_movie.php?success");
    }
} else if (empty($movieId) && !isset($error) && !isset($success)) {
	header("Location: delete_movie.php?error");
}

if (isset($success)) {
	echo "movieId has been deleted! Please refresh the page to see your changes.<br />";
} else if (isset($error)) {
	echo "The movieId type is empty. Please enter in a non-empty movieId name.<br />";
}



?>
