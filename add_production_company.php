<?php
include("dbconnect.php");
$query = "select * from PRODUCTION";
?>
<form action="add_production_company.php" method="GET">
<h3>Enter name of a new production company.</h3>
<input id="prod_name" placeholder="Name of new company." name="prod_name"></input>
<input type="submit"></input>
</form>

<?php

if (isset($_GET["prod_name"])) {
if ($stmt = $connection->prepare("insert into PRODUCTION values (NULL, '" . $_GET["prod_name"] . "');")) {
$stmt->execute();
echo "Company has been added! Check the bottom of this table.";
}
}
?>

<select name="prod_companies">
<?php
if ($stmt = $connection->prepare($query)) {

    /* execute statement */
    $stmt->execute();

    /* bind result variables */
    $stmt->bind_result($name, $code);

    /* fetch values */
    while ($stmt->fetch()) {
        printf ("<option value='%s'>%s</option>", $name, $code);
    }

    /* close statement */
    $stmt->close();
} else {echo "Error: " . $connection->error;}
?>

</table>
