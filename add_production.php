<?php
include("dbconnect.php");

$method = $_GET["method"];
?>

<form action="add_production.php" method="GET">
<h3>Add a production company</h3>
<input id="prod_name" placeholder="Name of new company." name="prod_name"></input>
<input type="submit"></input>
</form>


<?php
if (isset($_GET["prod_name"])) {
    if ($stmt = $connection->prepare("insert into production values (NULL, '" . $_GET["prod_name"] . "');")) {
        $stmt->execute();
        echo "Company has been added!<br />";
    }
} else if (empty($_GET["prod_name"])) {
	echo "The production name is empty. Please enter in a non-empty production name.<br />";
}

?>