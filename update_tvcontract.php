<?php
include("dbconnect_local.php");

$method = $_GET["method"];
$newCredit = $_GET["newCredit"];
$oldCredit = $_GET["oldCredit"];
?>

<form action="update_tvcontract.php" method="GET">
<h3>Modify the TvContract</h3>
<select name="oldCredit"><?php printQueryToOptionList("select tvcontract.creditId,fullName from tvcontract join credit using(creditId) group by tvcontract.creditId"); ?></select>
<select name="newCredit"><?php printQueryToOptionList("select showId,showName from tvshow"); ?></select>
<input type="submit"></input>
<h5><a href="admin.php">Go To HomePage</a></h5>
</form>


<?php
if (isset($newCredit) && isset($oldCredit)) { 
    if ($stmt = $connection->prepare("update tvcontract set showId = '" . $newCredit . "' where tvcontract.creditId = " . $oldCredit)) {
        $stmt->execute();
        echo "The contract has been updated! Please refresh the page to see your changes.<br />";
    }
} else if (empty($newCredit)) {
	echo "The contract is empty. Please enter in a non-empty name.<br />";
}

?>