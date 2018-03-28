<?php
include("dbconnect_local.php");

$method = $_GET["method"];
$prodName = $_GET["prod_name"];
$prodCompanies = $_GET["prod_companies"];
?>

<form action="modify_production.php" method="GET">
<h3>Modify a production company</h3>
<select name="prod_companies"><?php printQueryToOptionList("select prodId,prodName from production"); ?></select>
<input id="prod_name" placeholder="Change the name to..." name="prod_name"></input>
<input type="submit"></input>
<h5><a href="admin.php">Go To HomePage</a></h5>
</form>


<?php
if (isset($prodName) && isset($prodCompanies)) {
    if ($stmt = $connection->prepare("update production set prodName = '" . $prodName . "' where prodId = " . $prodCompanies)) {
        $stmt->execute();
        echo "Production Name has been updated! Please refresh the page to see your changes.<br />";
    }
} else if (empty($prodName)) {
	echo "The production name is empty. Please enter in a non-empty production name.<br />";
}

?>