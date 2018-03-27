<?php
include("dbconnect_local.php");

$method = $_GET["method"];
$newCredit = $_GET["newCredit"];
$oldCredit = $_GET["oldCredit"];
?>

<form action="update_tvcontract.php" method="GET">
<h3>Modify the TvContract</h3>
<select name="oldCredit"><?php printQueryToOptionList("select showId,showName from tvcontract join tvshow"); ?></select>
<select name="newCredit"><?php printQueryToOptionList("select creditId,fullName from tvcontract join credit"); ?></select>
<input type="submit"></input>
</form>


<?php
if (isset($newCredit) && isset($oldCredit)) { 
    if ($stmt = $connection->prepare("update movie set creditId = '" . $newCredit . "' where creditId = " . $oldCredit)) {
        $stmt->execute();
        echo "The contact has been updated! Please refresh the page to see your changes.<br />";
    }
} else if (empty($newCredit)) {
	echo "The contract is empty. Please enter in a non-empty name.<br />";
}

?>