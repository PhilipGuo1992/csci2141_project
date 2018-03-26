<?php
include("dbconnect.php");

$method = $_GET["method"];
?>

<form action="delete_credits.php" method="GET">
<h3>Delete Credit</h3>
<input id="Full_Name" placeholder="Full Name." name="Full_Name"></input>
<input type="submit"></input>
</form>


<?php
if (isset($_GET["Full_Name"])) {
    if ($stmt = $connection->prepare("DELETE FROM credit WHERE fullName =$_GET['Full_Name'] {
        $stmt->execute();
        echo "The Credit has been deleted<br />";
    }
} else if (empty($_GET['Full_Name'])) {
	echo "The Full Name is empty. Please enter in a non-empty name.<br />";
}

?>


