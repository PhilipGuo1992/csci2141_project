<?php
include("dbconnect.php");

$table = $_GET["table"];

?>
<h1>Content of table: <?php echo $table; ?></h1>
<table>
<?php printQueryToTableWithHeaders("select * from " . $table, $table); ?>
</table>