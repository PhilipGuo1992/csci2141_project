<?php
include("dbconnect.php");
?>
<?php

require_once("dbconnect.php");

?>Search for a timeslot. Only shows up to 100 shows per that timeslot, and skips shows which are on the same time.<br /><br />
For example, enter 6/18/2018 to see shows playing on June 18th, 2018.<br />
Leave all fields blank to see all movies.
<form action="find_timeslots.php" method="POST">
Find all shows playing <select name="boolOp"><option value="on this date">on this date</option><option value="after this date">after this date</option><option value="before this date">before this date</option></select> <input type="text" name="date" />
<button type="submit" value="Submit">Submit</button>
</form>

<?php
$date = $_POST["date"];
$boolOp = $_POST["boolOp"];

$mysqlOp = "";

if ($boolOp == "on this date") $mysqlOp = "=";
if ($boolOp == "after this date") $mysqlOp = "<";
if ($boolOp == "before this date") $mysqlOp = ">";

$query = "SELECT episodeName,seasonNumber,episodeNumber,dateCasted,runtimeMinutes,averageRating, timeslot_start, timeslot_end FROM timeslot join episode on episode.episodeId = timeslot.episode_id WHERE timeslot_start " . $mysqlOp . " STR_TO_DATE('" . $date . "  00:00:00', '%m/%d/%Y %H:%i:%s') LIMIT 100";
?>
<table>
	<tr><td>episode name</td><td>season number</td><td>episode number</td><td>date casted</td><td>runtime minutes</td><td>average rating</td><td>timeslot start</td></tr>


<?php	
	echo "RUNNING: " . $query;
	printQueryToTable($query); ?>
</table>