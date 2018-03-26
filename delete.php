<?php

function deleteRowFromTable($id, $success, $error, $filename, $query, $idColumnName, $table) {
?>
<form action="<?php echo $filename; ?>" method="GET">
<h3>Delete the existing <?php echo $table; ?>. Select a <?php echo $table; ?> you want to delete and press submit.</h3>
<select name="<?php echo $idColumnName; ?>"><?php printMultiQueryToOptionList($query); ?></select>
<input type="submit"></input>
</form>


<?php
if (isset($id)) {
	$query = "delete from " . $table . " where " . $idColumnName . " = " . $id;
	echo $query;

    if ($stmt = $connection->prepare($query)) {
        $stmt->execute();

        header("Location: " . $filename . "?success");
    }
} else if (empty($creditId) && !isset($error) && !isset($success)) {
	header("Location: " . $filename . "?error");
}

if (isset($success)) {
	echo $table . " has been deleted! Please refresh the page to see your changes.<br />";
} else if (isset($error)) {
	echo "The " . $table . " type is empty. Please enter in a non-empty " . $table . " name.<br />";
}}

?>