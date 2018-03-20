<?php require_once("dbconnect.php"); ?>
<style type="text/css">
	td.time {background-color:#292929;color:rgb(255,255,255,0.5);font-family:Helvetica!important;width:95px;}
	td.time:hover {background-color:#caad2d;color:#000;}
	td {font-family: Arial, sans-serif;font-size:15px; }
	td {padding: 20px;}
	td.show {background-color:#1f1f1f;color:#fff;width:550px;}
	td.show div {float:right;padding-left:5px;}
	a {text-decoration:none;}
	a:hover {font-weight:bold;}
	body {background-color:#17181c;color:#fff;}
</style>
<!-- https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_two_columns_unequal -->
<style>
* {
    box-sizing: border-box;
}

/* Create two unequal columns that floats next to each other */
.column {
    float: left;
    padding: 10px;
}

.left {
  width: 25%;
}

.right {
  width: 75%;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>

  <script type="text/javascript">
  	//https://stackoverflow.com/questions/38007345/how-to-show-ajax-response-as-modal-popup
$(document).on('click', 'div.timeslot a', function () {
	// https://www.w3schools.com/jquery/jquery_dom_get.asp
        var $data = $(this).attr('timeslot-id');
         var url = "http://138.197.129.252/timeslotToCreditsApi.php?timeslotId=" + $data;
        $.ajax({
            type: 'GET',
            url: url,
            success: function (output) {
            alert(output);
            // https://stackoverflow.com/questions/8628413/jquery-find-the-element-with-a-particular-custom-attribute
            $("div[timeslot-id=" + $data + "]").append(output);
            },
            error: function(output){
            alert("fail");
            }
        });
    });

  </script>
  <h1 style='font-family:Helvetica'>Search for a timeslot</h1>
<div class="row">
  <div class="column left">

<form action="search.php" method="GET">
Find all shows playing <select name="boolOp"><option value="on this date">on this date</option><option value="after this date">after this date</option><option value="before this date">before this date</option></select> <input type="text" name="date" id="datepicker" placeholder="Click to set date"/>
<button type="submit" value="Submit">Submit</button>
</form>
</div>
<div class="column right">
<?php

$date = $_GET["date"];
$boolOp = $_GET["boolOp"];

$mysqlOp = "";

if ($boolOp == "on this date") $mysqlOp = "> STR_TO_DATE('" . $date . "  00:00:00', '%m/%d/%Y %H:%i:%s') and timeslot_start < STR_TO_DATE('" . $date . "  23:59:59', '%m/%d/%Y %H:%i:%s')";

if ($boolOp == "after this date") $mysqlOp = " < STR_TO_DATE('" . $date . "  00:00:00', '%m/%d/%Y %H:%i:%s')";
if ($boolOp == "before this date") $mysqlOp = " > STR_TO_DATE('" . $date . "  00:00:00', '%m/%d/%Y %H:%i:%s')";

$query = "select DATE_FORMAT(timeslot_start, \"%H:%i\"), CONCAT(showName, ' -- ', \"S\", seasonNumber, \" E\", episodeNumber), timeslot_id from timeslot join tvshow on tvshow.showId = timeslot.showId join episode on episode.showId = tvshow.showId WHERE timeslot_start " . $mysqlOp . " order by timeslot_start LIMIT 50";
?>
<table>


<?php	
	
	echo "<h2 style='font-family:Helvetica'>Showing results for shows playing " . $boolOp . ": " . $date . "</h2>";
	$connection = db_connect();
    // http://php.net/manual/en/mysqli-result.fetch-row.php
    if ($result = mysqli_query($connection, $query)) {

    /* fetch associative array */
    
    while ($row = mysqli_fetch_row($result)) {
        echo("<tr>");
        echo "<td class='time'>" . $row[0] . "</td>";
        echo "<td class='show'><div>" . $row[1] . "</div><br /><div class='timeslot' style='width:300px;color:rgb(135, 135, 135)'>sample text with some information relating to each show, maybe including the release date and other information<br /><a href='#' timeslot-id='" . $row[2] . "' style='float:right;font-size:11px;color:rgb(202, 173, 45);'>MORE INFO for #" . $row[2] . "</a></div><img src='https://placem.at/people?w=227&h=87&random=" . sha1($row[1]) ."' /></td>";
            
        echo("</tr>");
        }

        
    }

	?>
</table>
  </div>
</div>

<?php echo "MYSQL QUERY: <code style='background-color:#000'>RUNNING: " . $query . "</code>"; ?>