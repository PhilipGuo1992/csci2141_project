<?php
include("dbconnect_local.php");

$method = $_GET["method"];
$newCredit = $_GET["newCredit"];
$oldCredit = $_GET["oldCredit"];
?>

<form action="update_credits.php" method="GET">
<h3>Modify the Credit Name</h3>
<select name="oldCredit"><?php printQueryToOptionList("select creditId,fullName from credit"); ?></select>
<input id="newCredit" placeholder="Change the name to..." name="newCredit"></input>
<input type="submit"></input>
</form>


<?php
if (isset($newCredit) && isset($oldCredit)) {
    if ($stmt = $connection->prepare("update credit set fullName = '" . $newCredit . "' where creditId = " . $oldCredit)) {
        $stmt->execute();
        echo "Credit Name has been updated! Please refresh the page to see your changes.<br />";
    }
} else if (empty($newCredit)) {
	echo "The Credit name is empty. Please enter in a non-empty name.<br />";
}

?>