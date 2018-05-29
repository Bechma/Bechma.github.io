<?php
function db_conectar(){
	// $servername = "localhost";
	// $username = "mianbr1718";
	// $password = "mA29PIX8";
	// $dbname = "mianbr1718";

	$servername = "localhost";
	$username = "root";
	$password = "admin";
	$dbname = "mianbr1718";


	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->set_charset("utf8");

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	return $conn;
}


function db_modificar_usuario(){
	if (isset($_POST["tipo"], $_POST["nombre"], $_POST["apellidos"], $_POST["email"], $_POST["password"], $_POST["telefono"]) && !isset($_POST["cancelar"])){
		$conn = db_conectar();

		$old_email = $conn->real_escape_string($_POST["usuarios_mod2"]);
		//print_r($old_email);
		$nombre = $conn->real_escape_string($_POST["nombre"]);
		$apellidos = $conn->real_escape_string($_POST["apellidos"]);
		$email = $conn->real_escape_string($_POST["email"]);
		$password = preg_match('/^[a-f0-9]{32}$/',$_POST["password"]) ? $_POST["password"] : md5($_POST["password"]);
		$tipo = $conn->real_escape_string($_POST["tipo"]);
		$telefono = $conn->real_escape_string($_POST["telefono"]);

		$result = $conn->query("UPDATE usuarios SET Nombre='$nombre', Apellidos='$apellidos', Email='$email', Password='$password', Telefono='$telefono', TipoUser='$tipo' WHERE Email='$old_email'");
		db_log("El usuario {$_SESSION['email']} ha modificado un usuario");
		$conn->close();
		return $result;
	}
	return "";
}
function db_modificar_concierto(){
	if (isset($_POST["fecha"], $_POST["hora"], $_POST["lugar"], $_POST["descripcion"]) && !isset($_POST["cancelar"])){
		$conn = db_conectar();
		
		$old_fecha = $conn->real_escape_string($_POST["conciertos_mod2"]);
		//print_r($old_fecha);
		$fecha = $conn->real_escape_string($_POST["fecha"]);
		$hora = $conn->real_escape_string($_POST["hora"]);
		$descripcion = $conn->real_escape_string($_POST["descripcion"]);
	
		$result = $conn->query("UPDATE conciertos SET Fecha='$fecha', Hora='$hora', Descripcion='$descripcion' WHERE Fecha='$old_fecha'");
		db_log("El usuario {$_SESSION['email']} ha modificado un concierto");
		$conn->close();
		return $result;
	}
	return "";
}

function db_modificar_biografia(){
	if (isset($_POST["id"], $_POST["texto"])){
		$conn = db_conectar();
		
		$old_id = $conn->real_escape_string($_POST["parrafo_mod2"]);
		//print_r($old_fecha);
		$id = $conn->real_escape_string($_POST["id"]);
		$texto = $conn->real_escape_string($_POST["texto"]);
		
	
		$result = $conn->query("UPDATE biografia SET id='$id', texto='$texto' WHERE id='$old_id'");
		db_log("El usuario {$_SESSION['email']} ha modificado la biografía");
		$conn->close();
		return $result;
	}
	return "";
}


function db_insertar_usuario(){
	if (isset($_POST["nombre"], $_POST["apellidos"], $_POST["email"], $_POST["password"], $_POST["telefono"])
		&& $_SESSION["tipo_user"] === "admin"){

		if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
			return "email";
		}


		$conn = db_conectar();
		$tipo = (isset($_POST["tipo"]) && $_POST["tipo"] === "admin") ? "admin" : "gestor";
		$nombre = $conn->real_escape_string($_POST["nombre"]);
		$apellidos = $conn->real_escape_string($_POST["apellidos"]);
		$email = $conn->real_escape_string($_POST["email"]);
		$password = md5($_POST["password"]);
		$telefono = $conn->real_escape_string($_POST["telefono"]);

		$result = $conn->query("INSERT INTO usuarios VALUES ('$nombre', '$apellidos', '$email', '$password', '$tipo', '$telefono')");
		db_log("El usuario {$_SESSION['email']} ha insertado un nuevo usuario");
		$conn->close();
		return $result;
	}
	return "";
}

function db_insertar_concierto(){
	
	if (isset($_POST["fecha"], $_POST["hora"], $_POST["lugar"], $_POST["descripcion"])
		&& $_SESSION["tipo_user"] === "admin"){
		
		$conn = db_conectar();
		$fecha = $conn->real_escape_string($_POST["fecha"]);
		$hora = $conn->real_escape_string($_POST["hora"]);
		$lugar = $conn->real_escape_string($_POST["lugar"]);
		$descripcion = $conn->real_escape_string($_POST["descripcion"]);
		$result = $conn->query("INSERT INTO conciertos VALUES ('$fecha', '$hora', '$lugar', '$descripcion')");
		db_log("El usuario {$_SESSION['email']} ha insertado un nuevo concierto");
		$conn->close();
		return $result;
	}
	return "";
}

function db_insertar_biografia(){
	
	if (isset($_POST["id"], $_POST["texto"])
		&& $_SESSION["tipo_user"] === "admin"){
		
		$conn = db_conectar();
		$id = $conn->real_escape_string($_POST["id"]);
		$texto = $conn->real_escape_string($_POST["texto"]);
	
		$result = $conn->query("INSERT INTO biografia VALUES ('$id', '$texto')");
		db_log("El usuario {$_SESSION['email']} ha añadido un nuevo párrafo a la biografía");
		$conn->close();
		return $result;
	}
	return "";
}

function db_borrar_usuario($email){
	if ($_SESSION["tipo_user"] === "admin"){
		$conn = db_conectar();
		$email = $conn->real_escape_string($email);

		$result = $conn->query("DELETE FROM usuarios WHERE Email='$email'");
		db_log("El usuario {$_SESSION['email']} ha borrado un usuario");
		$conn->close();
		return $result;
	}
	return "";
}

function db_borrar_conciertos($fecha){
	if ($_SESSION["tipo_user"] === "admin"){
		$conn = db_conectar();
		$fecha = $conn->real_escape_string($fecha);

		$result = $conn->query("DELETE FROM conciertos WHERE Fecha='$fecha'");
		db_log("El usuario {$_SESSION['email']} ha borrado un concierto");
		$conn->close();
		return $result;
	}
	return "";
}

function db_gestionar_pedido(){
	if (isset($_POST['id'], $_POST['EmailGestor'], $_POST['TextoEmail'], $_POST['Fecha'], $_POST['EstadoNuevo']) && !isset($_POST['cancelar'])){
		$conn = db_conectar();

		$id = $conn->real_escape_string($_POST['id']);
		$mail = $conn->real_escape_string($_POST['EmailGestor']);
		$texto = $conn->real_escape_string($_POST['TextoEmail']);
		$fecha = $conn->real_escape_string($_POST['Fecha']);
		$estado = $conn->real_escape_string($_POST['EstadoNuevo']);

		$result = $conn->query("UPDATE pedidos SET EmailGestor='$mail', TextoEmail = '$texto', Fecha='$fecha', Estado='$estado' WHERE id='$id'");
		return $result;
	}
	return "";
}

function db_borrar_biografia($id){
	if ($_SESSION["tipo_user"] === "admin"){
		$conn = db_conectar();
		$id = $conn->real_escape_string($id);

		$result = $conn->query("DELETE FROM biografia WHERE id='$id'");
		db_log("El usuario {$_SESSION['email']} ha borrado un párrafo de la biografía");
		$conn->close();
		return $result;
	}
	return "";
}

function db_mod_precio(){
	if(isset($_POST["Nombre"], $_POST["NuevoPrecio"]) && !isset($_POST['cancelar'])){
		$conn = db_conectar();

		$precio = $conn->real_escape_string($_POST['NuevoPrecio']);
		$nombredisco = $conn->real_escape_string($_POST['Nombre']);

		$result = $conn->query("UPDATE discos SET Precio='$precio' WHERE Nombre='$nombredisco'");
		
		$conn->close();
		return $result;
	}
	return "";
}
function db_log($text){
	$conn = db_conectar();
	$text = $conn->real_escape_string($text);
	$conn->query("INSERT INTO log(descripcion) VALUES ('$text')");
	$conn->close();
}
