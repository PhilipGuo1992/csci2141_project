<?php
error_reporting(E_ALL);
include("dbconnect.php");


$professionId = null;
if (isset($_GET["professionId"])) {
	$professionId = $_GET["professionId"];
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

<form action="delete_profession.php" method="GET">
<h3>Delete the existing profession. Select a profession name you want to delete and press submit.</h3>
<select name="professionId"><?php printMultiQueryToOptionList("select professionId, profession from profession"); ?></select>
<input type="submit"></input>
</form>


<?php
if (isset($professionId)) {
    if ($stmt = $connection->prepare("delete from profession where professionId = " . $professionId)) {
        $stmt->execute();

        header("Location: delete_profession.php?success");
    }
} else if (empty($professionId) && !isset($error) && !isset($success)) {
	header("Location: delete_profession.php?error");
}

if (isset($success)) {
	echo "profession has been deleted! Please refresh the page to see your changes.<br />";
} else if (isset($error)) {
	echo "The profession type is empty. Please enter in a non-empty professionId name.<br />";
}



?>
