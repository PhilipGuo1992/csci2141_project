<?php
include("dbconnect.php");

$addType = $_GET["type"];
$method = $_GET["method"];

if ($addType == "prod") {
	if ($method == "add") {
?>

<form action="add.php" method="GET">
<h3>Add a production company</h3>
<input id="prod_name" placeholder="Name of new company." name="prod_name"></input>
<input name="type" value="<?php echo $method; ?>" style="display:none"></input>
<input type="submit"></input>
</form>

<?php
if (isset($_GET["prod_name"])) {
    if ($stmt = $connection->prepare("insert into production values (NULL, '" . $_GET["prod_name"] . "');")) {
        $stmt->execute();
        echo "Company has been added! Check the bottom of this table.";
    }
}

} else if ($method == "update") {
	// update method
?>

	<form action="add.php" method="GET">
<h3>Update a production company</h3>
<input id="prod_name" placeholder="Name of new company." name="prod_name"></input>
<input name="type" value="<?php echo $method; ?>" style="display:none"></input>
<input type="submit"></input>
</form>

<?php
} else if ($method == "delete") {
	// delete method
?>
<form action="add.php" method="GET">
<h3>Delete a production company</h3>
<select name="prod_companies"><?php printQueryToOptionList("select * from production"); ?></select>
<input name="type" value="<?php echo $method; ?>" style="display:none"></input>
<input type="submit"></input>
</form>
<?php } ?>



<?php } else { ?>

<h2>Choose an item to add to the database</h2>

<table>
	<tr>
		<td>Subtitle</td>
		<td><a href="add.php?type=subtitle&method=newMovie">To a new movie...</a></td>
		<td><a href="add.php?type=subtitle&method=existingMovie">To an existing movie...</a></td>
		<td><a href="add.php?type=subtitle&method=new">Create New</a></td>
	</tr>
	<tr>
		<td>Genre</td>
		<td><a href="add.php?type=genre&method=newMovie">To a new movie...</a></td>
		<td><a href="add.php?type=genre&method=existingMovie">To an existing movie...</a></td>
		<td><a href="add.php?type=genre&method=new">Create New</a></td>
	</tr>
	<tr>
		<td>Production Company</td>
		<td><a href="add.php?type=prod&method=newMovie">Add a new Genre</a></td>
		<td><a href="addgenre.php?type=prod&method=existingMovie">Delete an existing Genre</a></td>
		<td><a href="add.php?type=prod&method=new">Modify?</a></td>
	</tr>
	<tr>
		<td>Credit</td>
		<td><a href="add.php?type=credit&method=newMovie">To a new movie...</a></td>
		<td><a href="add.php?type=credit&method=existingMovie">To an existing movie...</a></td>
		<td><a href="add.php?type=credit&method=new">Create New</a></td>
	</tr>
	<tr>
		<td>Episode</td>
		<td><a href="add.php?type=episode&method=newMovie">To a new timeslot</a></td>
		<td><a href="add.php?type=episode&method=existingMovie">To an existing timeslot...</a></td>
		<td><a href="add.php?type=episode&method=new">Create New</a></td>
	</tr>
	<tr>
		<td>Region</td>
		<td><a href="add.php?type=region&method=newMovie">To a new subtitle...</a></td>
		<td><a href="add.php?type=region&method=existingMovie">To an existing subtitle...</a></td>
		<td><a href="add.php?type=region&method=new">Create New</a></td>
	</tr>
	<tr>
		<td>Timeslot</td>
		<td><a href="add.php?type=timeslot&method=newMovie">For an existing show or movie...</a></td>
		<td><a href="add.php?type=timeslot&method=existingMovie">To an existing movie...</a></td>
		<td><a href="add.php?type=timeslot&method=new">Create New</a></td>
	</tr>
</table>

<?php
}
