<?php
require_once "operaciones_db.php";

function opciones_admin(){
	if ($_SESSION["tipo_user"] === "admin"){
		$href = ["componentes", "biografia", "discografia", "conciertos", "usuarios", "log", "logout"];
		$name = ["Editar Componentes Grupo", "Editar biografía", "Editar discografía", "Editar conciertos", "Editar usuarios", "Ver log del servidor", "Desconectarse"];
		echo "<ul>";
		foreach($href as $i => $val){
			echo "<li><a href='dashboard.php?accion=$val'>{$name[$i]}</a></li>";
		}
		echo "</ul>";

		acciones();
	}
}

function acciones(){
	if (isset($_REQUEST["accion"])){
		switch ($_REQUEST["accion"]){
			case "componentes":
				break;
			case "biografia":
				break;
			case "discografia":
				break;
			case "conciertos":
				break;
			case "usuarios":
				if (isset($_POST["borrar_user"])){
					db_borrar_usuario($_POST["borrar_user"]);
					listar_usuarios();
				}
				elseif (isset($_REQUEST["usuarios_add"])){
					insertar_usuario();
				}
				elseif (isset($_POST["usuarios_add2"])){
					$result = db_insertar_usuario();
					if ($result === TRUE){
						echo "<p class='correcto'>Usuario insertado correctamente</p>";
						listar_usuarios();
					}
					elseif ($result === "email"){
						echo "<p class='error'>Email no valido</p>";
						insertar_usuario();
					}
					else {
						echo "<p class='error'>Se ha producido un error, vuelve a intentarlo";
						insertar_usuario();
					}
				}
				elseif (isset($_REQUEST["usuarios_mod"])){
					modificar_usuario(base64_decode($_REQUEST["usuarios_mod"]));
				}
				elseif (isset($_POST["usuarios_mod2"])){
					$result = db_modificar_usuario();
					if ($result === TRUE){
						echo "<p class='correcto'>Usuario modificado correctamente</p>";
						listar_usuarios();
					}
					elseif ($result === "email"){
						echo "<p class='error'>Email no valido</p>";
						modificar_usuario($_POST["usuarios_mod2"]);
					}
					else {
						echo "<p class='error'>Se ha producido un error, vuelve a intentarlo";
						modificar_usuario($_POST["usuarios_mod2"]);
					}
				}
				else
					listar_usuarios();
				break;
			case "log":
				break;
			default:
				echo "<p>Elija una opcion</p>";
				break;
		}
	} else echo "<p>Elija una opcion</p>";
}

function listar_usuarios(){
	$conn = db_conectar();
	$result = $conn->query("SELECT * FROM usuarios");
	echo "
<script type='text/javascript'>
	function eliminar(objButton) {
	  const email = atob(objButton.name);
	  if (window.confirm('Desea eliminar a ' + email + '???')){
	  	let ajax = new XMLHttpRequest();
	  	ajax.open('POST', 'dashboard.php');
	  	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	  	ajax.onreadystatechange = () => {
	  		if (ajax.status === 200 && ajax.readyState === 4)
	  			objButton.parentNode.parentNode.parentNode.removeChild(objButton.parentNode.parentNode);
	  	};
	  	ajax.send('accion={$_REQUEST["accion"]}&borrar_user='+email);
	  } 
	}
</script>

<table>
<thead>
	<tr>
		<th>Nombre</th>
		<th>Apellidos</th>
		<th>Email</th>
		<th>Password</th>
		<th>Tipo Usuario</th>
		<th>Telefono</th>
		<th>Acciones</th>
	</tr>
</thead>
<tbody>";

	while ( $row = $result->fetch_assoc() ){
		echo "
<tr>
	<td>".htmlentities($row["Nombre"])."</td>
	<td>".htmlentities($row["Apellidos"])."</td>
	<td>".htmlentities($row["Email"])."</td>
	<td>".htmlentities($row["Password"])."</td>
	<td>".htmlentities($row["TipoUser"])."</td>
	<td>".htmlentities($row["Telefono"])."</td>
	<td><input class='admin-botones' type='button' value='Borrar' name='".base64_encode($row["Email"])."' onclick='eliminar(this)'>
		<a class='admin-botones' href='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=usuarios&usuarios_mod=".base64_encode($row["Email"])."'>Modificar</a></td>
</tr>";
	}

	echo "
	</tbody>
	</table>
	<a role='button' class='admin-botones' href='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=usuarios&usuarios_add=true'>Agregar usuario</a>";
	$conn->close();
}



function modificar_usuario($email){
	$conn = db_conectar();
	$result = $conn->query("SELECT * FROM usuarios WHERE Email='$email'");
	$conn->close();
	if ($result !== FALSE && $result->num_rows === 1){
		$row = $result->fetch_assoc();
		$_POST["nombre"] = $row["Nombre"];
		$_POST["apellidos"] = $row["Apellidos"];
		$_POST["email"] = $row["Email"];
		$_POST["password"] = $row["Password"];
		$_POST["telefono"] = $row["Telefono"];

		echo "<p>Modificar usuario:</p>";
		form_usuario("usuarios_mod2", $email);
	} else
		echo "<p class='error'>ERROR</p>";
}

function insertar_usuario(){
	echo "<p>Inserta un nuevo usuario:</p>";
	form_usuario("usuarios_add2");
}


function form_usuario($location, $extra="true"){
	echo "<form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
	<label for='nombre'>Nombre: </label>
	<input type='text' id='nombre' name='nombre'
	value='" . (isset($_POST['nombre']) ? $_POST['nombre'] : '') . "'>
	<br>
	<label for='apellidos'>Apellidos: </label>
	<input type='text' id='apellidos' name='apellidos'
	value='" . (isset($_POST['apellidos']) ? $_POST['apellidos'] : '') . "'>
	<br>
	<label for='email'>Email: </label>
	<input type='email' id='email' name='email'
	value='" . (isset($_POST['email']) ? $_POST['email'] : '') . "' required>
	<br>
	<label for='password'>Password: </label>
	<input type='password' id='password' name='password'
	value='" . (isset($_POST['password']) ? $_POST['password'] : '') . "' required>
	<br>
	<label for='telefono'>Telefono: </label>
	<input type='text' id='telefono' name='telefono'
	value='" . (isset($_POST['telefono']) ? $_POST['telefono'] : '') . "'>
	<br>
	<label for='admin'>Administrador: </label>
	<input type='radio' id='admin' name='tipo'>
	<label for='gestor'>Gestor: </label>
	<input type='radio' id='gestor' name='tipo' checked>
	<br>
	<input type='hidden' name='accion' value='usuarios'>
	<input type='hidden' name='$location' value='$extra'>
	<input type='submit' value='Enviar'>
</form>
";
}


function imprimir_formulario($name, $value){
	$storage = "<form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>";
	$storage .= "<input type='submit' name='$name' value='$value'></form>";
	return $storage;
}