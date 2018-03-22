<?php
include("dbconnect.php");

$method = $_GET["method"];
$prodName = $_GET["prod_name"];
$prodCompanies = $_GET["prod_companies"];
$error = $_GET["error"];
$success = $_GET["success"];
?>

<form action="delete_production.php" method="GET">
<h3>Delete a production company. Select a company to delete and press submit.</h3>
<select name="prod_companies"><?php printQueryToOptionList("select * from production"); ?></select>
<input type="submit"></input>
</form>


<?php
if (isset($prodCompanies)) {
    if ($stmt = $connection->prepare("delete from production where prodId = " . $prodCompanies)) {
        $stmt->execute();
        header("Location: delete_production.php?success");
    }
} else if (empty($prodCompanies) && !isset($error) && !isset($success)) {
	header("Location: delete_production.php?error");
}

if (isset($success)) {
	echo "Company has been deleted! Please refresh the page to see your changes.<br />";
} else if (isset($error)) {
	echo "The production name is empty. Please enter in a non-empty production name.<br />";
}

?>