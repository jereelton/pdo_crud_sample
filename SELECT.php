<?php

include("menu.php");

require_once("config.php");

$order_by = (isset($_GET['order_by'])) ? $_GET['order_by'] : "deslogin";

$stmt = $conn->prepare("SELECT * FROM $dbname.tb_usuarios ORDER BY $order_by");

$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<table border='1' width='100%'>";

foreach ($results as $row) {

	echo ( $control_head === 0 ) ? "<thead>" : "<tr>";

	foreach ($row as $key => $value) {

		echo ( $control_head === 0 ) ? "<th><a href='?order_by=$key'>$key</a></th>" : "<td>$value</td>";
		
		$firstline = ($control_head === 0) ? $firstline .= "<td>$value</td>" : "";
	}

	echo ( $control_head === 0 ) ? "</thead><tr>$firstline</tr>" : "</tr>";

	$control_head = 1;
}

echo "</table>";

?>
