<?php
include("dbconnect.php");

$method = $_GET["method"];
?>

<form action="add_credits.php" method="GET">
<h3>Add new credit</h3>
<input id="credit_full_name" placeholder="Full name of credit persons name." name="credit_full_name"></input>
<input id="age" placeholder="Age (numeric)" name="age"></input>
<input id="gender" placeholder="M or F" name="gender"></input>
<input type="submit"></input>
</form>


<?php
if (isset($_GET["credit_full_name"])) {
    if ($stmt = $connection->prepare("insert into credit values (NULL, '" . $_GET["credit_full_name"] . "', '" . $_GET["age"] . "', '" . $_GET["gender"] . "');")) {
        $stmt->execute();
        echo "New Genre has been added!<br />";
    }
} else if (empty($_GET["credit_full_name"])) {
	echo "The credit_full_name is empty. Please enter in a non-empty name.<br />";
}

?>