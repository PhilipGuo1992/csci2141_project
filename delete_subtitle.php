<?php
include("dbconnect.php");

$method = $_GET["method"];


$subtitleId = $_GET["subtitle_type"];

$error = $_GET["error"];
$success = $_GET["success"];
?>

<form action="delete_subtitle.php" method="GET">
<h3>Delete the existing subtitle. Select a subtitle type to delete and press submit.</h3>
<select name="subtitle_type"><?php printQueryToOptionList("select * from subtitle"); ?></select>
<input type="submit"></input>
</form>


<?php
if (isset($subtitleId)) {
    if ($stmt = $connection->prepare("delete from subtitle where subtitleId = " . $subtitleId)) {
        $stmt->execute();

        header("Location: delete_subtitle.php?success");
    }
} else if (empty($subtitleId) && !isset($error) && !isset($success)) {
	header("Location: delete_subtitle.php?error");
}

if (isset($success)) {
	echo "Subtitle has been deleted! Please refresh the page to see your changes.<br />";
} else if (isset($error)) {
	echo "The subtitle type is empty. Please enter in a non-empty production name.<br />";
}



?>