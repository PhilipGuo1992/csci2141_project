<?php
include("/var/www/html/dbconnect.php");
$query = "select * from PRODUCTION";
?>
<form action="add_show.php" method="GET">
<h3>Enter details of new show:</h3>
<input id="show_name" placeholder="Name of new show." name="show_name"></input>
<input id="genre_id" placeholder="Genre ID" name="genre_id"></input>
<input id="prod_id" placeholder="Production ID" name="prod_id"></input>

<input type="submit"></input>
</form>

<?php

if (isset($_GET["show_name"])) {
if ($stmt = $connection->prepare("INSERT INTO `csci2141_project`.`TV_SHOW` (`show_id`, `genre_id`, `prod_id`, `duration`, `show_language`, `time_slot_id`, `rating`) VALUES (NULL, 1, 1, NULL, 'English', NULL, 5);")) {
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
