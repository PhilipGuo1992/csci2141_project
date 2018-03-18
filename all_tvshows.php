
<?php
include("dbconnect.php");
?>



<?php

	$sql = "SELECT showName FROM tvshow";
	$result = $connection->query($sql);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			echo "Show name: " . $row["showName"]. "<br>";
		}

	}

?>

