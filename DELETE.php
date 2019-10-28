<?php

include("menu.php");

require_once("config.php");

if(isset($_GET['delete'])) {

	$stmt1 = $conn->prepare("DELETE FROM $dbname.tb_usuarios WHERE idusuario = ".$_GET['delete']);

	echo ($stmt1->execute()) ? "<strong>Everthing fine !</strong>" : "<strong>Failed !</strong>";

}

$order_by = (isset($_GET['order_by'])) ? $_GET['order_by'] : "deslogin";

$stmt = $conn->prepare("SELECT * FROM $dbname.tb_usuarios ORDER BY $order_by");

$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<table border='1' width='100%'>";

foreach ($results as $row) {

	echo ( $control_head === 0 ) ? "<thead>" : "<tr>";

	foreach ($row as $key => $value) {

		$getid = ($key === 'idusuario') ? $value : $getid;

		echo ( $control_head === 0 ) ? "<th><a href='?order_by=$key'>$key</a></th>" : "<td><p style='color: red'>$value</p></td>";

		$firstline = ($control_head === 0) ? $firstline .= "<td><p style='color: red'>$value</p></td>" : "";
		
	}

	echo ( $control_head === 0 ) ? 
		"<th>action</th></thead><tr>$firstline<td><a href='?delete=$getid' style='color: red' onclick=\"return confirm('Are you sure DELETE item ?')\">[DELETE]</a></td></tr>" : 
		"<td><a href='?delete=$getid' style='color: red' onclick=\"return confirm('Are you sure DELETE item ?')\">[DELETE]</a></td></tr>";

	$control_head = 1;

}

echo "</table>";

?>
