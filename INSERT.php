<?php

include("menu.php");

if(isset($_POST['bt_save'])) {

	if($_POST['login'] !== "" && $_POST['password'] !== "") {

		require_once("config.php");

		$stmt = $conn->prepare("INSERT INTO $dbname.tb_usuarios VALUES(NULL, '".$_POST['login']."', '".$_POST['password']."', '".Date("Y-m-d H:i:s")."');");

		echo ($stmt->execute()) ? "<strong>Everthing fine !</strong>" : "<strong>Failed !</strong>";
	
	} else {

		echo "<strong style='color: red'>Inform all data correctly !</strong>";

	}

}

echo "<form action='INSERT.php' method='post'>

		<fieldset>
			<p>Create User</p>
			<p>
			Login
				<input type='text' name='login' value='' placeholder='Inform your login' />
			Password
				<input type='password' name='password' value='' placeholder='Inform your password' />
			</p>
			<p>
				<input type='submit' name='bt_save' value='Send' />
			</p>
		</fieldset>

	</form>";

?>
