<?php
include("dbconnect.php");

$method = $_GET["method"];
$newProfession = $_GET["newProfession"];
$oldProfession = $_GET["oldProfession"];
?>

<form action="update_profession.php" method="GET">
<h3>Change the profession name</h3>

<select name="oldProfession"><?php printMultiQueryToOptionList("select professionId, profession from profession"); ?></select>

<input id="newProfession" placeholder="Change the name to..." name="newProfession"></input>
<input type="submit"></input>
</form>

<?php
if (isset($newProfession) && isset($oldProfession)) {
    if ($stmt = $connection->prepare("update profession set profession = '" . $newProfession . "' where professionId = " . $oldProfession)) {
        $stmt->execute();
        echo "profession has been updated! Please refresh the page to see your changes.<br />";
    }
} else if (empty($newProfession)) {
	echo "The profession name is empty. Please enter in a non-empty name.<br />";
}

?>