<?php
error_reporting(E_ALL);
include("dbconnect.php");


$prodId = null;
if (isset($_GET["prodId"])) {
	$prodId = $_GET["prodId"];
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

<form action="delete_production.php" method="GET">
<h3>Delete the existing prodId. Select a prodId name you want to delete and press submit.</h3>
<select name="prodId"><?php printMultiQueryToOptionList("select * from production"); ?></select>
<input type="submit"></input>
<h5><a href="admin.php">Go To HomePage</a></h5>
</form>


<?php
if (isset($prodId)) {
    if ($stmt = $connection->prepare("delete from production where prodId = " . $prodId)) {
        $stmt->execute();

        header("Location: delete_production.php?success");
    }
} else if (empty($creditId) && !isset($error) && !isset($success)) {
	header("Location: delete_production.php?error");
}

if (isset($success)) {
	echo "prodId has been deleted! Please refresh the page to see your changes.<br />";
} else if (isset($error)) {
	echo "The prodId type is empty. Please enter in a non-empty prodId name.<br />";
}



?>
