<?php
include("dbconnect_local.php");

$method = $_GET["method"];
$newtitle = $_GET["newtitle"];
$oldSubtitle = $_GET["oldSubtitle"];
?>

<form action="update_subtitle.php" method="GET">
<h3>Modify the subtitle type</h3>
<select name="oldSubtitle"><?php printQueryToOptionList("select subtitleId,subtitlesLang from subtitle"); ?></select>
<input id="newtitle" placeholder="Change the name to..." name="newtitle"></input>
<input type="submit"></input>
<h5><a href="admin.php">Go To HomePage</a></h5>
</form>


<?php
if (isset($newtitle) && isset($oldSubtitle)) {
    if ($stmt = $connection->prepare("update subtitle set subtitlesLang = '" . $newtitle . "' where subtitleId = " . $oldSubtitle)) {
        $stmt->execute();
        echo "Subtitle has been updated! Please refresh the page to see your changes.<br />";
    }
} else if (empty($newtitle)) {
	echo "The subtitle name is empty. Please enter in a non-empty name.<br />";
}

?>