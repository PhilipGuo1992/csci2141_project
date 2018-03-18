<?php
include("dbconnect.php");
?>
<?php

require_once("dbconnect.php");

?>Search for a movie. Leave any fields blank if you do not wish to restrict your search criteria on those fields.<br /><br />

Leave all fields blank to see all movies.
<form action="search_movies.php" method="POST">
Movie name contains: <input type="text" name="movieName">
<select name="boolOperatorMovieName">
  <option value="or">OR</option>
  <option value="and">AND</option>
  <option value="and not">AND NOT</option>
  <option value="not">NOT</option>
</select> <br />
Movie release date is: <input type="text" name="movieRelease">
<select name="boolOperatorMovieRelease">
  <option value="or">OR</option>
  <option value="and">AND</option>
  <option value="and not">AND NOT</option>
  <option value="not">NOT</option>
</select> <br />
Movie runtime minutes greater than: <input type="text" name="movieRuntimeGreater">
<select name="boolOperatorMovieRuntimeGreater">
  <option value="or">OR</option>
  <option value="and">AND</option>
  <option value="and not">AND NOT</option>
  <option value="not">NOT</option>
</select> <br />
Movie runtime minutes less than: <input type="text" name="movieRuntimeLess"><select name="boolOperatorMovieRuntimeLess">
  <option value="or">OR</option>
  <option value="and">AND</option>
  <option value="and not">AND NOT</option>
  <option value="not">NOT</option>
</select> 
<button type="submit" value="Submit">Submit</button>
</form>

<?php
$movieName = $_POST["movieName"];
$boolOperatorMovieName = $_POST["boolOperatorMovieName"];

$movieRelease = $_POST["movieRelease"];
$boolOperatorMovieRelease = $POST["boolOperatorMovieRelease"];

$movieRuntimeGreater = $_POST["movieRuntimeGreater"];
$boolOperatorMovieRuntimeGreater = $_POST["boolOperatorMovieRuntimeGreater"];

$movieRuntimeLess = $_POST["movieRuntimeLess"];
$boolOperatorMovieRuntimeLess = $_POST["boolOperatorMovieRuntimeLess"];

$query = "where ";
$finalQuery = "";

// at least one value has been posted; lets create a query to search movies table
if (!empty($movieName) || !empty($movieRelease) || !empty($movieRuntimeGreater) || !empty($movieRuntimeLess)) { ?>
<table>
	<tr><td>movie name</td><td>release date</td><td>runtime</td></tr>
	<?php

	
	if (!empty($movieName)) {
		$query = $query . "movieName LIKE '%" . $movieName . "%' " . $boolOperatorMovieName . " ";
	}

	if (!empty($movieRelease)) {
		$query = $query . "releaseDate = " . $movieRelease . " " . $boolOperatorMovieRelease . " ";
	}

	if (!empty($movieRuntimeGreater)) {
		$query = $query . "runtime > " . $movieRuntimeGreater . " " . $boolOperatorMovieRuntimeGreater . " ";
	}

	if (!empty($movieRuntimeLess)) {
		$query = $query . "runtime < " . $movieRuntimeLess . " " . $boolOperatorMovieRuntimeLess . " ";
	}
	$finalQuery = "select movieName, releaseDate, runtime from movie " . $query . " 1 = 0";
} else {
	echo "Please enter a search term!";
}
	
	echo "RUNNING: " . $finalQuery;
	printQueryToTable($finalQuery); ?>
</table>