<?php require_once("dbconnect.php"); ?>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="scripts.js"></script>
</head>
<body>

<h1 style='font-family:Helvetica'>Search for a timeslot</h1>
<a href="search.php?boolOp=allShows" style="float:right;color:#fff;padding-left:20px">All Shows</a> <a href="search.php?boolOp=allMovies" style="float:right;color:#fff;padding-left:20px">Movies</a>
<div class="row">
  <div class="column left">

<form action="search.php" method="GET">
Find all shows playing <select name="boolOp"><!--<option value="on this date">on this date</option>--><option value="after this date">after this date</option><option value="before this date">before this date</option></select> <input type="text" name="date" id="datepicker" placeholder="Click to set date"/>
<button type="submit" value="Submit">Submit</button>
</form>

<button type="button" id="admin-button" onclick="javascript:document.location='http://138.197.129.252/add.php'">Toggle admin interface</button>
</div>
<div class="column right">
<?php

$date = $_GET["date"];
$boolOp = $_GET["boolOp"];

$mysqlOp = "";

if ($boolOp == "on this date") $mysqlOp = "timeslot_start  > STR_TO_DATE('" . $date . "  00:00:00', '%m/%d/%Y %H:%i:%s') and timeslot_start < STR_TO_DATE('" . $date . "  23:59:59', '%m/%d/%Y %H:%i:%s')";

if ($boolOp == "after this date") $mysqlOp = "timeslot_start  < STR_TO_DATE('" . $date . "  00:00:00', '%m/%d/%Y %H:%i:%s')";
if ($boolOp == "before this date") $mysqlOp = "timeslot_start  > STR_TO_DATE('" . $date . "  00:00:00', '%m/%d/%Y %H:%i:%s')";
if ($boolOp == "allShows") $mysqlOp = "1 = 1";
$query = "select DATE_FORMAT(timeslot_start, \"%H:%i\"), CONCAT(showName, ' -- ', \"S\", seasonNumber, \" E\", episodeNumber), timeslot_id from timeslot  join episode using(episodeId) join tvshow using(showId) WHERE " . $mysqlOp . " order by timeslot_start";

if ($boolOp == "allMovies") {
	$query = "select movieName, ratings, timeslot_id from movie";
}
?>
<table id="results">


<?php	
	
	echo "<h2 style='font-family:Helvetica'>Showing results for shows playing " . $boolOp . ": " . $date . "</h2>";
	$connection = db_connect();
    // http://php.net/manual/en/mysqli-result.fetch-row.php
    if ($result = mysqli_query($connection, $query)) {

    /* fetch associative array */
    
    while ($row = mysqli_fetch_row($result)) {
        echo("<tr>");
        echo "<td class='time'>" . $row[0] . "</td>";
        echo "<td class='show'><div>" . $row[1] . "</div><br /><div class='timeslot' style='width:300px;color:rgb(135, 135, 135)'>sample text with some information relating to each show, maybe including the release date and other information<br /><a href='#' timeslot-id='" . $row[2] . "' style='float:right;font-size:11px;color:rgb(202, 173, 45);'>MORE INFO for #" . $row[2] . "</a></div><img src='https://placem.at/people?w=227&h=87&random=" . sha1($row[1]) ."' /></td><td id='admin'><table id='admin'><tr id='addslot'><td>^</td></tr><tr id='deleteslot'><td>X</td></tr><tr id='addslot'><td>V</td></tr></table></td>";
            
        echo("</tr>");
        }
    }

	?>
</table>
  </div>
</div>

<?php echo "<code style='background-color:#000'>QUERY: " . $query . "</code>"; ?>