<?php
error_reporting(E_ALL);
include("dbconnect.php");


$subtitleId = null;
if (isset($_GET["subtitleId"])) {
	$subtitleId = $_GET["subtitleId"];
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

<form action="delete_subtitle.php" method="GET">
<h3>Delete the existing subtitleId. Select a subtitleId name you want to delete and press submit.</h3>
<select name="subtitleId"><?php printMultiQueryToOptionList("select * from subtitle"); ?></select>
<input type="submit"></input>
<h5><a href="admin.php">Go To HomePage</a></h5>
</form>


<?php
if (isset($subtitleId)) {
    if ($stmt = $connection->prepare("delete from subtitle where subtitleId = " . $subtitleId)) {
        $stmt->execute();

        header("Location: delete_subtitle.php?success");
    }
} else if (empty($subtitleId) && !isset($error) && !isset($success)) {
	header("Location: delete_subtitle.php?error");
}

if (isset($success)) {
	echo "subtitleId has been deleted! Please refresh the page to see your changes.<br />";
} else if (isset($error)) {
	echo "The subtitleId type is empty. Please enter in a non-empty subtitleId name.<br />";
}



?>
