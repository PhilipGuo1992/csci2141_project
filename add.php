<?php
include("dbconnect.php");

$table = $_GET["table"];
$method = "add";
?>
<head>
	<style>
	/* https://stackoverflow.com/questions/4309950/how-to-align-input-forms-in-html */
	form  { display: table;      }
	p     { display: table-row;  margin-top:10px;}
	label { display: table-cell; }
	input { display: table-cell; margin-top: 10px;}
</style>
</head>
<h3><?php echo $method; ?> <?php echo $table; ?></h3>
<form action="<?php echo $method; ?>_<?php echo $table; ?>.php" method="GET">
<?php
    $connection = db_connect();
    $query = "describe " . $table;
    if ($result = mysqli_query($connection, $query)) {
    while ($row = mysqli_fetch_row($result)) {
    	// row[0] = Field name
    	// row[1] = Type (e.g. int(11))
    	// row[2] = Nullable (e.g. NO or YES)
    	// row[3] = Key (e.g. PRI, MUL, empty str)
    	// row[4] = Default value (e.g. NULL)
    	// row[5] = Extra (e.g. auto_increment)
    	if (($row[3] == "PRI") && ($row[5] == "auto_increment")) {
    		// don't do anything; it's just a primary key which will be automatically generated
    		// have it in the form for PHP but don't show to user
    	?>
    	
    	<input type="text" name="<?php echo $row[0]; ?>" value="NULL" style="display:none"></input>
    	
    	<?php
    	} else if (empty($row[3])) {
    		// it's not a primary key or a foreign key; user must enter in data for it
    		// generate inputs
    		// first, get the max length of the key
    		$maxLengthOfInput = (int)(explode(")", explode("(", $row[1])[1])[0]);

    		// https://stackoverflow.com/questions/4366730
    		$inputType = "text";
    		if (strpos($row[1], 'int(') !== false) {
    			$inputType = "number";
    		}

    		// check if the value is allowed to be nullable.
    		// if it's not, set the required attribute in html
    		// https://www.w3schools.com/tags/att_input_required.asp

    		$isNullable = false;
    		if ($row[2] == "YES") {
    			$isNullable = true;
    		}

    		// set the placeholder to a generic value if non defined in mysql
    		$placeholder = $row[0] . " " . $row[1];
    		// check if mysql has a default value that's not null
    		if ($row[4] != null) {
    			$placeholder = $row[4];
    		}

    		// check if it's a boolean value or a text
    		if ($row[1] != "tinyint(4)") {
	?>
	<p><label for="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></label> <input type="<?php echo $inputType; ?>" id="<?php echo $row[0]; ?>" placeholder="<?php echo $placeholder ?>" name="<?php echo $row[0]; ?>" maxlength="<?php echo $maxLengthOfInput; ?>" max="<?php echo $maxLengthOfInput*1000; ?>" <?php if (!$isNullable) {echo " required"; } ?>></input></p>

<?php } else {
// it's a boolean value; set up form appropriately
// https://www.w3schools.com/html/html_form_input_types.asp
?><p><label for="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></label>
	<input type="radio" name="<?php echo $row[0]; ?>" value="1" checked> True </input>
	<input type="radio" name="<?php echo $row[0]; ?>" value="0"> False</input></p>
<?php }

} else if ($row[3] == "MUL") {
	// it's a foreign key. Ut oh.
	// https://stackoverflow.com/questions/201621/how-do-i-see-all-foreign-keys-to-a-table-or-column/18825955
	$query = "SELECT REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE where COLUMN_NAME = '" . $row[0] . "' and TABLE_NAME = '" . $table . "' LIMIT 1";
	$REFERENCED_TABLE_NAME = "";
	$REFERENCED_COLUMN_NAME = "";

	// get foreign key column link and get that columns values
	if ($result1 = mysqli_query($connection, $query)) {
    	while ($row1 = mysqli_fetch_row($result1)) {
    		// only one row will be returned.
    		$REFERENCED_TABLE_NAME = $row1[0];
    		$REFERENCED_COLUMN_NAME = $row1[1];
    	}
	}

	$query = "SELECT * FROM " . $REFERENCED_TABLE_NAME;
	?>
	<p><label for="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></label>
		<select name="<?php echo $REFERENCED_COLUMN_NAME; ?>" id="<?php echo $REFERENCED_COLUMN_NAME; ?>">
	<?php printQueryToOptionList($query); ?>
	</select></p>

	<?php
} else {
	// probably another weird thing. Just ignore it for now.
}

}} ?>
<input type="text" name="FORM_SUBMIT" value="SUBMITTED" style="display:none"></input>
<input type="submit"></input>
</form>

<?php if (isset($_GET["success"])) {
	echo "New " . $table . " has been changed! Refresh the page.";
}

if (isset($_GET["FORM_SUBMIT"])) {

	// replace empty strings with NULLS for mysql
	// https://stackoverflow.com/questions/7142627/search-and-replace-inside-an-associative-array
	foreach($_GET as $key => $val)
	{
    	if (empty($val)) $_GET[$key] = 'NULL';
	}

	// remove form submission thing
	unset($_GET["FORM_SUBMIT"]);
	$query = "insert into " . $table . " values ('" . implode("', '", $_GET) . "')";
	// terrible hack
	$query = str_replace("'NULL'", "NULL", $query);
	echo $query;
    if ($stmt = $connection->prepare($query)) {
        $stmt->execute();
        sleep(2);
        echo "<script>window.location.href = '" . $method . "_" . $table . ".php?success';</script>";
    }
} else if (empty($_GET["FORM_SUBMIT"])) {
	echo "Submit the form to " . $method . " the item to the database.";
}

?>