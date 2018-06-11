<?php
/**
 * Funcion que nos permite establecer una conexion con la base de datos
 */
function db_conectar(){
	$servername = "localhost";
	
	$username = "mianbr1718";
	$password = "mA29PIX8";
	$dbname = "mianbr1718";

	//  $servername = "localhost";
	//  $username = "root";
	//  $password = "admin";
	//  $dbname = "mianbr1718";


	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->set_charset("utf8");

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	return $conn;
}

/**
 * Funcion que se encarga de actualizar los datos de un usuario de la tabla de usuarios de la base 
 * de datos. Añade un registro al log al completar la operacion
 */
function db_modificar_usuario(){
	if (isset($_POST["tipo"], $_POST["nombre"], $_POST["apellidos"], $_POST["email"], $_POST["password"], $_POST["telefono"]) && !isset($_POST["cancelar"])){
		$conn = db_conectar();

		$old_email = $conn->real_escape_string($_POST["usuarios_mod2"]);
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

/**
 * Funcion que se encarga de actualizar los datos de un concierto de la tabla de conciertos de la base 
 * de datos. Añade un registro al log al completar la operacion
 */
function db_modificar_concierto(){
	
	if (isset($_POST["fecha"], $_POST["hora"], $_POST["lugar"], $_POST["descripcion"]) && !isset($_POST["cancelar"])){
		$conn = db_conectar();
		
		$old_fecha = $conn->real_escape_string($_POST["conciertos_mod2"]);
		$fecha = DateTime::createFromFormat("d/m/Y H:i", ($_POST["fecha"] . " " . $_POST["hora"]))->getTimeStamp();
		
		$lugar = $conn->real_escape_string($_POST["lugar"]);

		$descripcion = $conn->real_escape_string($_POST["descripcion"]);
	
		$result = $conn->query("UPDATE conciertos SET Fecha=$fecha, Descripcion='$descripcion', Lugar='$lugar' WHERE Fecha=$old_fecha");
		db_log("El usuario {$_SESSION['email']} ha modificado un concierto");
		$conn->close();
		return $result;
	}
	return "";
}
/**
 * Funcion que se encarga de actualizar los datos de un miembro de la tabla de miembros de la base 
 * de datos. Añade un registro al log al completar la operacion
 */
function db_modificar_miembro(){
	
	if (isset($_POST["nombre"], $_POST["roll"], $_POST["fechanacimiento"], $_POST["fotografia"], $_POST["biografia"]) && !isset($_POST["cancelar"])){
		$conn = db_conectar();
		
		$old_nombre = $conn->real_escape_string($_POST["miembro_mod2"]);
		$nombre = $conn->real_escape_string($_POST["nombre"]);
		$roll = $conn->real_escape_string($_POST["roll"]);
		$fechanacimiento = $conn->real_escape_string($_POST["fechanacimiento"]);
		$fotografia = $conn->real_escape_string($_POST["fotografia"]);
		$biografia = $conn->real_escape_string($_POST["biografia"]);
	
		$result = $conn->query("UPDATE `miembros_grupo` SET Nombre='$nombre', Roll='$roll', Fechanacimiento='$fechanacimiento',Fotografia='$fotografia',Biografia='$biografia' WHERE Nombre='$old_nombre'");
		db_log("El miembro {$_SESSION['email']} ha modificado un miembro");
		$conn->close();
		return $result;
	}
	return "";
}
/**
 * Funcion que se encarga de actualizar los datos de un concierto de la tabla de conciertos de la base 
 * de datos. Añade un registro al log al completar la operacion
 */
function db_modificar_disco(){
	// print_r($_POST["titulo"]);
	// print_r($_POST["duracion"]);

	if (isset($_POST["nombre"], $_POST["precio"], $_POST["fechapublicacion"],$_POST["imagen"], $_POST["descripcion"]) && !isset($_POST["cancelar"])){
		$conn = db_conectar();
		$old_nombre = $conn->real_escape_string($_POST["disco_mod2"]);
		$nombre = $conn->real_escape_string($_POST["nombre"]);
		$precio = $conn->real_escape_string($_POST["precio"]);
		$fechapublicacion = $conn->real_escape_string($_POST["fechapublicacion"]);
		$descripcion = $conn->real_escape_string($_POST["descripcion"]);

		$conn->query("UPDATE discos SET Nombre='$nombre', Precio='$precio', FechaPublicacion='$fechapublicacion', Descripcion='$descripcion' WHERE Nombre='$old_nombre'");
		db_log("El usuario {$_SESSION['email']} ha modificado un concierto");
		
		$result = $conn->query("SELECT * FROM canciones WHERE Disco='$nombre'");
		$totalcaciones=$result->num_rows;

		for($i=1;$i<=$totalcaciones;$i++)
		{
			$titulo = $_POST["titulo$i"];
			$duracion = $_POST["duracion$i"];
			$row = $result->fetch_assoc();
			$conn->query("UPDATE canciones SET Titulo='$titulo', Duracion='$duracion' WHERE Titulo='{$row["Titulo"]}'");
		}
		
		$conn->close();
		return true;
	}
	return "";
}
/**
 * Funcion que se encarga de actualizar los datos biograficos de la tabla de biografia de la base 
 * de datos. Añade un registro al log al completar la operacion
 */
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

/**
 * Funcion que se encarga de insertar una nueva fila en la tabla de usuarios de la base 
 * de datos. Añade un registro al log al completar la operacion
 */
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
/**
 * Funcion que se encarga de insertar una nueva fila en la tabla de discos de la base 
 * de datos. Añade un registro al log al completar la operacion
 */
function db_insertar_disco(){
	
	if (isset($_POST["nombre"], $_POST["precio"], $_POST["fechapublicacion"], $_POST['imagen'],$_POST["descripcion"])
		&& $_SESSION["tipo_user"] === "admin"){
		
		$conn = db_conectar();
		$nombre = $conn->real_escape_string($_POST["nombre"]);
		$precio = $conn->real_escape_string($_POST["precio"]);
		$fechapublicacion = $conn->real_escape_string($_POST["fechapublicacion"]);
		$imagen = $conn->real_escape_string($_POST["imagen"]);
		$descripcion = $conn->real_escape_string($_POST["descripcion"]);
		$result = $conn->query("INSERT INTO discos VALUES ('$nombre','$precio','$fechapublicacion','$imagen', '$descripcion')");
		db_log("El usuario {$_SESSION['email']} ha insertado un nuevo concierto");
		$i=1;
		while(isset($_POST["titulo$i"]))
		{
			echo"HOLA$i";
			$titulo=$conn->real_escape_string($_POST["titulo$i"]);
			$duracion=$conn->real_escape_string($_POST["duracion$i"]);
			$result = $conn->query("INSERT INTO canciones VALUES ('$titulo','$duracion','$nombre') ");
			$i++;
		}
		$conn->close();
		return $result;
	}
	return "";
}
/**
 * Funcion que se encarga de insertar una nueva fila en la tabla de conciertos de la base 
 * de datos. Añade un registro al log al completar la operacion
 */
function db_insertar_concierto(){
	
	if (isset($_POST["fecha"], $_POST["hora"], $_POST["lugar"], $_POST["descripcion"])
		&& $_SESSION["tipo_user"] === "admin"){
		
		$conn = db_conectar();
		$fecha = DateTime::createFromFormat("d/m/Y H:i", ($_POST["fecha"] . " " . $_POST["hora"]))->getTimeStamp();
		$lugar = $conn->real_escape_string($_POST["lugar"]);
		$descripcion = $conn->real_escape_string($_POST["descripcion"]);
		$result = $conn->query("INSERT INTO conciertos VALUES ('$fecha', '$lugar', '$descripcion')");
		db_log("El usuario {$_SESSION['email']} ha insertado un nuevo concierto");
		$conn->close();
		return $result;
	}
	return "";
}
/**
 * Funcion que se encarga de insertar una nueva fila en la tabla de miembros de la base 
 * de datos. Añade un registro al log al completar la operacion
 */
function db_insertar_miembro(){
	print_r($_POST);
	if (isset($_POST["nombre"], $_POST["roll"], $_POST["fechanacimiento"], $_POST["lugarnacimiento"], $_POST["fotografia"], $_POST["biografia"]) && $_SESSION["tipo_user"] === "admin"){
		
		$conn = db_conectar();
		$nombre = $conn->real_escape_string($_POST["nombre"]);
		$roll = $conn->real_escape_string($_POST["roll"]);
		$fechanacimiento = $conn->real_escape_string($_POST["fechanacimiento"]);
		$lugarnacimiento = $conn->real_escape_string($_POST["lugarnacimiento"]);
		$fotografia = $conn->real_escape_string($_POST["fotografia"]);
		$biografia = $conn->real_escape_string($_POST["biografia"]);

		$result = $conn->query("INSERT INTO `miembros_grupo`  VALUES ('$nombre', '$roll', '$fechanacimiento', '$lugarnacimiento', '$fotografia', '$biografia')");
		db_log("El usuario {$_SESSION['email']} ha insertado un nuevo miembro");
		$conn->close();
		return $result;
	}
	return "";
}
/**
 * Funcion que se encarga de insertar una nueva fila en la tabla de biografias de la base 
 * de datos. Añade un registro al log al completar la operacion
 */
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

/**
 * Funcion que se encarga de borrar una fila definida por su clave primaria de la tabla de usuarios de la base 
 * de datos. Añade un registro al log al completar la operacion
 */
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
/**
 * Funcion que se encarga de borrar una fila definida por su clave primaria de la tabla de conciertos de la base 
 * de datos. Añade un registro al log al completar la operacion
 */
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
/**
 * Funcion que se encarga de borrar una fila definida por su clave primaria de la tabla de biografias de la base 
 * de datos. Añade un registro al log al completar la operacion
 */
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
/**
 * Funcion que se encarga de borrar una fila definida por su clave primaria de la tabla de miembros de la base 
 * de datos. Añade un registro al log al completar la operacion
 */
function db_borrar_miembro($nombre){
	echo "AL LIODDD";
	if ($_SESSION["tipo_user"] === "admin"){
		$conn = db_conectar();
		$nombre = $conn->real_escape_string($nombre);

		$result = $conn->query("DELETE FROM `miembros_grupo` WHERE Nombre='$nombre'");
		db_log("El usuario {$_SESSION['email']} ha borrado un miembro del grupo");
		$conn->close();
		return $result;
	}
	return "";
}
/**
 * Funcion que se encarga de borrar una fila definida por su clave primaria de la tabla de discos de la base 
 * de datos. Añade un registro al log al completar la operacion
 */
function db_borrar_disco($nombre){
	if ($_SESSION["tipo_user"] === "admin"){
		$conn = db_conectar();
		$nombre = $conn->real_escape_string($nombre);

		$conn->query("DELETE FROM canciones WHERE Disco='$nombre'");
		$result = $conn->query("DELETE FROM discos WHERE Nombre='$nombre'");
		db_log("El usuario {$_SESSION['email']} ha borrado el disco y canciones de la discografia");
		$conn->close();
		return $result;
	}
	return "";
}
/**
 * Funcion que se encarga de actualizar el estado de un pedido de la tabla pedidos de la base de datos. Añade un registro al log al completar la operacion
 */
function db_gestionar_pedido(){
	if (isset($_POST['id'], $_POST['EmailGestor'], $_POST['TextoEmail'], $_POST['EstadoNuevo']) && !isset($_POST['cancelar'])){
		$conn = db_conectar();

		$id = $conn->real_escape_string($_POST['id']);
		$mail = $conn->real_escape_string($_POST['EmailGestor']);
		$texto = $conn->real_escape_string($_POST['TextoEmail']);
		$estado = $conn->real_escape_string($_POST['EstadoNuevo']);

		$result = $conn->query("UPDATE pedidos SET EmailGestor='$mail', TextoEmail = '$texto', Estado='$estado' WHERE id=$id");
		db_log("El usuario {$_SESSION['email']} ha gestionado un pedido");
		$conn->close();
		return $result;
	}
	return "";
}


/**
 * Funcion que se encarga de actualizar el estado de un disco de la tabla discos de la base de datos. Añade un registro al log al completar la operacion
 */
function db_mod_precio(){
	if(isset($_POST["Nombre"], $_POST["NuevoPrecio"]) && !isset($_POST['cancelar'])){
		$conn = db_conectar();

		$precio = $conn->real_escape_string($_POST['NuevoPrecio']);
		$nombredisco = $conn->real_escape_string($_POST['Nombre']);

		$result = $conn->query("UPDATE discos SET Precio='$precio' WHERE Nombre='$nombredisco'");
		db_log("El usuario {$_SESSION['email']} ha modificado el precio de $nombredisco");
		
		$conn->close();
		return $result;
	}
	return "";
}
/**
 * Funcion que se encarga de insertar tanto pedidos como en discospedidos los datos de un nuevo pedido
 * realizado al sistema. Añade un registro al log al completar la operacion
 */
function db_nuevo_pedido($discos_cantidad, $nombre){
	$conn = db_conectar();
	$discos = $conn->query("SELECT * from discos");

	$fecha = date("d/m/Y H:i", time());
	$conn->query("INSERT INTO pedidos(TextoEmail, Estado, Fecha) VALUES ('Gracias por su compra $nombre', 'En Espera', '$fecha')");
	$id = $conn->query("SELECT LAST_INSERT_ID()");

	if( $discos !== FALSE && $discos->num_rows > 0 && $id !== FALSE && $id->num_rows > 0){
		$id = $id->fetch_assoc()["LAST_INSERT_ID()"];
		foreach ($discos_cantidad as $value => $item){
			try {
				$value = urldecode($value);
				$item = (int) $item;
				$conn->query("INSERT INTO discospedidos(idpedidos, Nombrediscos, Cantidad) VALUE ($id, '$value', $item)");
			} catch (Exception $exception){

			}
		}
	}
	db_log("Compra de discos realizada $fecha");
}
/**
 * Funcion que se encarga de insertar un nuevo log en la tabla de logs
 */
function db_log($text){
	$conn = db_conectar();
	$text = $conn->real_escape_string($text);
	$conn->query("INSERT INTO log(descripcion) VALUES ('$text')");
	$conn->close();
}
