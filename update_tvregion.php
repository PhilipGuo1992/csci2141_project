<?php
include("dbconnect_local.php");

$method = $_GET["method"];
$newCredit = $_GET["newCredit"];
$oldCredit = $_GET["oldCredit"];
?>

<form action="update_tvregion.php" method="GET">
<h3>Update Tvshow Coverage</h3>
<select name="oldCredit"><?php printQueryToOptionList("select distinct(region_regionId),regionName from tvregion tvr 
join region r on r.regionId = tvr.region_regionId"); ?></select>
<select name="newCredit"><?php printQueryToOptionList("select showId,showName from tvshow"); ?></select>
<input type="submit"></input>
<h5><a href="admin.php">Go To HomePage</a></h5>
</form>


<?php
if (isset($newCredit) && isset($oldCredit)) { 
    if ($stmt = $connection->prepare("update tvregion set tvshow_showId = '" . $newCredit . "' where region_regionId = " . $oldCredit)) {
        $stmt->execute();
        echo "The Region has been updated! Please refresh the page to see your changes.<br />";
		header("Location:http://138.197.129.252/select.php?table=show_coverage");
    }
} else if (empty($newCredit)) {
	echo "The Region is empty. Please enter in a non-empty name.<br />";
}

?>