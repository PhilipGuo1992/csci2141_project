<?php
include("dbconnect_local.php");

$method = $_GET["method"];
$newRegion = $_GET["newRegion"];
$oldRegion = $_GET["oldRegion"];
?>

<form action="update_region.php" method="GET">
<h3>Modify the Region</h3>

<select name="oldRegion"><?php printMultiQueryToOptionList("select regionId, regionName from region"); ?></select>

<input id="newRegion" placeholder="Change the name to..." name="newRegion"></input>
<input type="submit"></input>
</form>

<?php
if (isset($newRegion) && isset($oldRegion)) {
    if ($stmt = $connection->prepare("update region set regionName = '" . $newRegion . "' where regionId = " . $oldRegion)) {
        $stmt->execute();
        echo "Region has been updated! Please refresh the page to see your changes.<br />";
    }
} else if (empty($newRegion)) {
	echo "The region name is empty. Please enter in a non-empty name.<br />";
}

?>