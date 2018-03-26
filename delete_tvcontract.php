<?php
error_reporting(E_ALL);
include("dbconnect.php");


$contractId = null;
if (isset($_GET["contractId"])) {
	$contractId = $_GET["contractId"];
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

<form action="delete_tvcontract.php" method="GET">
<h3>Delete the existing contractId. Select a contractId name you want to delete and press submit.</h3>
<select name="contractId"><?php printMultiQueryToOptionList("select contractId, CONCAT(showName, ' (', fullName, ')')  from tvcontract natural join tvshow natural join credit"); ?></select>
<input type="submit"></input>
</form>


<?php
if (isset($contractId)) {
    if ($stmt = $connection->prepare("delete from tvcontract where contractId = " . $contractId)) {
        $stmt->execute();

        header("Location: delete_tvcontract.php?success");
    }
} else if (empty($contractId) && !isset($error) && !isset($success)) {
	header("Location: delete_tvcontract.php?error");
}

if (isset($success)) {
	echo "contractId has been deleted! Please refresh the page to see your changes.<br />";
} else if (isset($error)) {
	echo "The contractId type is empty. Please enter in a non-empty contractId name.<br />";
}



?>
