<?php
include("dbconnect.php");
?>
Choose an actor to view:
<form action="list_actors.php" method="POST">
<select name="actors">
	<?php printQueryToOptionList("select actor_id, CONCAT(actor_lname, ' ', actor_fname) from ACTOR LIMIT 500"); ?>
</select>

<button type="submit" value="Submit">Submit</button>
</form>
<?php
if (isset($_POST["actors"])) {
?>
<table>
	<tr><td>actor_id</td><td>first_name</td><td>last_name</td><td>age</td><td>gender?</td></tr>
	<?php
	printQueryToTable("select * from ACTOR where actor_id = '" . $_POST["actors"] . "'");
?>
</table>

Actors with the same age as that actor:

<table>
	<tr><td>actor_id</td><td>first_name</td><td>last_name</td><td>age</td><td>gender?</td></tr>
	<?php
	printQueryToTable("select * from ACTOR where actor_age = (select actor_age from ACTOR where actor_id = '" . $_POST["actors"] . "') LIMIT 500");
}
?>
</table>