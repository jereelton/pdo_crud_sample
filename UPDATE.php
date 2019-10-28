<?php

include("menu.php");

require_once("config.php");

if(isset($_POST['bt_update'])) {

	if($_POST['deslogin'] !== "" && $_POST['dessenha'] !== "") {

		$update = $conn->prepare("UPDATE $dbname.tb_usuarios SET deslogin = '".$_POST['deslogin']."', dessenha = '".$_POST['dessenha']."', dtcadastro = '".Date("Y-m-d H:i:s")."' WHERE idusuario = ".$_POST['hidusuario']);

		echo ($update->execute()) ? "<strong>Everthing fine !</strong>" : "<strong>Failed !</strong>";

	} else {

		echo "<strong style='color: red'>Inform all data correctly !</strong>";

	}
}

if(isset($_GET['update'])) {

	$stmt1 = $conn->prepare("SELECT * FROM $dbname.tb_usuarios WHERE idusuario = ".$_GET['update']);

	$stmt1->execute();

	$results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

	echo '
	<h3>Data Update</h3>
	<form action="UPDATE.php" method="post">
		<fieldset>
			<p>
			Id
			<input type="text" name="idusuario" value="'.$results1[0]["idusuario"].'" disabled />
			<input type="hidden" name="hidusuario" value="'.$results1[0]["idusuario"].'" />
			Login
			<input type="text" name="deslogin" value="'.$results1[0]["deslogin"].'" />
			Password
			<input type="password" name="dessenha" value="'.$results1[0]["dessenha"].'" />
			Creation Date
			<input type="text" name="dtcadastro" value="'.$results1[0]["dtcadastro"].'" disabled />

			<input type="submit" name="bt_update" value="Save" />
			</p>
		</fieldset>
	</form>';

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

		echo ( $control_head === 0 ) ? 
		"<th><a href='?order_by=$key'>$key</a></th>" : 
		"<td><a href='?update=$getid' style='color: orange'>$value</a></td>";

		$firstline = ($control_head === 0) ? $firstline .= "<td><a href='?update=$getid' style='color: orange'>$value</a></td>" : "";
		
	}

	echo ( $control_head === 0 ) ? "</thead><tr>$firstline</tr>" : "</tr>";

	$control_head = 1;
}

echo "</table>";

?>
