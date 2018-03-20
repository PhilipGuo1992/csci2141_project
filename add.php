<?php
include("dbconnect.php");
?>

<form action="add.php" method="GET">
<h3>Enter name of a new production company.</h3>
<input id="prod_name" placeholder="Name of new company." name="prod_name"></input>
<input type="submit"></input>
</form>

<?php

if (isset($_GET["prod_name"])) {
    if ($stmt = $connection->prepare("insert into production values (NULL, '" . $_GET["prod_name"] . "');")) {
        $stmt->execute();
        echo "Company has been added! Check the bottom of this table.";
    }
}
?>

<select name="prod_companies"><?php printQueryToOptionList("select * from production"); ?></select>

</table>
