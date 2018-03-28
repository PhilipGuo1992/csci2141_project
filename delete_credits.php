<?php
error_reporting(E_ALL);
include("dbconnect.php");


$creditId = null;
if (isset($_GET["creditId"])) {
	$creditId = $_GET["creditId"];
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

<form action="delete_credits.php" method="GET">
<h3>Delete the existing Credit. Select a Credit Name you want to delete and press submit.</h3>
<select name="creditId"><?php printMultiQueryToOptionList("select creditId,fullName from credit"); ?></select>
<input type="submit"></input>
<h5><a href="admin.php">Go To HomePage</a></h5>
</form>


<?php
if (isset($creditId)) {
    if ($stmt = $connection->prepare("delete from credit where creditId = " . $creditId)) {
        $stmt->execute();

        header("Location: delete_credits.php?success");
    }
} else if (empty($creditId) && !isset($error) && !isset($success)) {
	header("Location: delete_credits.php?error");
}

if (isset($success)) {
	echo "Credit has been deleted! Please refresh the page to see your changes.<br />";
} else if (isset($error)) {
	echo "The Credit type is empty. Please enter in a non-empty production name.<br />";
}



?>
