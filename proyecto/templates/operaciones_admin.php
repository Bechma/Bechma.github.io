<?php

//print_r($_POST);
require_once "operaciones_db.php";
//----------------------------------------------------------------------------------------------------------------------------------------------------
/**
 * Esta funcion imprimira el menu de operaciones que un administrador puede ejecutar 
 */
function opciones_admin(){
	if ($_SESSION["tipo_user"] === "admin"){
		$href = ["miembros", "biografia", "discografia", "conciertos", "usuarios", "log", "logout"];
		$name = ["Editar miembros Grupo", "Editar biografía", "Editar discografía", "Editar conciertos", "Editar usuarios", "Ver log del servidor", "Desconectarse"];
		echo '<div id="panel_control" align="center">';
			echo '<div class="login">';
				echo "<ul>";
				foreach($href as $i => $val){
					echo "<li><a href='dashboard.php?accion=$val#panel_control'>{$name[$i]}</a></li>";
				}
				echo "</ul>";
			echo "</div>";
		echo "</div>";
		
		acciones();
	}
}
//----------------------------------------------------------------------------------------------------------------------------------------------------
/**
 * Funcion que gestiona las acciones que puede realizar un usuario de tipo administrador: 
 * -Editar miembros: Se gestiona la modificacion, agregacion y eliminacion de un elemento
 * -Editar biografia: Se gestiona la modificacion, agregacion y eliminacion de un elemento
 * -Editar discografia: Se gestiona la modificacion, agregacion y eliminacion de un elemento
 * -Editar conciertos: Se gestiona la modificacion, agregacion y eliminacion de un elemento
 * -Editar usuarios: Se gestiona la modificacion, agregacion y eliminacion de un elemento
 * -Ver log del servidor
 * -Desconectarse
 */
function acciones(){
	
	
	if (isset($_REQUEST["accion"])){
		switch ($_REQUEST["accion"]){
			//La accion seleccionada es editar miembros
			case "miembros":
			//La operacion de editar miembros seleccionada es eliminat
			if (isset($_POST["borrar_miembro"])){
				db_borrar_miembro($_POST["borrar_miembro"]);
				listar_miembros();
			}
			//La operacion de editar miembros seleccionada es añadir
			elseif (isset($_REQUEST["miembro_add"])){  //$_REQUEST CONTIEN EL $_POST $_GET , $_COOKIEy las variables que se pasen por href
				insertar_miembro();
			}
			//La operacion seleccionada es añadir y el formulario se ha enviado
			elseif (isset($_POST["miembro_add2"]) && !isset($_POST["cancelar"])){
				$result = db_insertar_miembro();
				
				if ($result === TRUE){
					echo "<p class='correcto'>Miembro insertado correctamente</p>";
					listar_miembros();
				}
				elseif ($result === "nombre"){
					echo "<p class='error'>id_Miembro no valido</p>";
					insertar_miembro();
				}
				else {
					echo "<p class='error'>Se ha producido un error, vuelve a intentarlo";
					insertar_miembro();
				}
			}
			//La operacion de editar miembros seleccionada es modificar
			elseif (isset($_REQUEST["miembro_mod"]) && !isset($_POST["cancelar"])){
				modificar_miembro(base64_decode($_REQUEST["miembro_mod"]));
			}//La operacion de editar miembros seleccionada es modificar y el formulario se ha enviado
			elseif (isset($_POST["miembro_mod2"])){
				$result = db_modificar_miembro();
				if ($result === TRUE){
					echo "<p class='correcto'>Miembro modificado correctamente</p>";
					listar_miembros();
				}
				elseif ($result === "id"){
					echo "<p class='error'>Id_Miembro no valido</p>";
					modificar_miembro($_POST["miembro_mod2"]);
				}
				else {
					if(isset($_POST['cancelar']))
					{
						echo "<p id='cancelacion' class='correcto' >Accion Cancelada correctamente</p>";
					}
					else
					{
						echo "<p class='error'>Se ha producido un error, vuelve a intentarlo";
						modificar_miembro($_POST["miembro_mod2"]);
					}
					
				}
			}
			else
				listar_miembros();
			break;
				
			//-----------------------------------------------------------BIOGRAFIA-------------------------------------------------------------------
			//La accion seleccionada es editar biografia
			case "biografia":
			//La operacion seleccionada es borrar parrafo
			if (isset($_POST["borrar_parrafo"])){
				db_borrar_biografia($_POST["borrar_parrafo"]);
				listar_biografia();
			}
			//La operacion seleccionada es añadir un nuevo parrafo
			elseif (isset($_REQUEST["parrafo_add"])){  //$_REQUEST CONTIEN EL $_POST $_GET , $_COOKIEy las variables que se pasen por href
				insertar_biografia();
			}
			//La operacion seleccionada es añadir un nuevo parrafo y el formulario se ha enviado
			elseif (isset($_POST["parrafo_add2"]) && !isset($_POST["cancelar"])){
				$result = db_insertar_biografia();
				if ($result === TRUE){
					echo "<p class='correcto'>Parrafo insertado correctamente</p>";
					listar_biografia();
				}
				elseif ($result === "id"){
					echo "<p class='error'>id_Parrafo no valido</p>";
					insertar_biografia();
				}
				else {
					echo "<p class='error'>Se ha producido un error, vuelve a intentarlo";
					insertar_biografia();
				}
			}
			//La operacion seleccionada es modificar un parrafo
			elseif (isset($_REQUEST["parrafo_mod"]) && !isset($_POST["cancelar"])){
				modificar_biografia(base64_decode($_REQUEST["parrafo_mod"]));
			}
			//La operacion seleccionada es modificar un parrafo y el formulario se ha enviado
			elseif (isset($_POST["parrafo_mod2"])){
				$result = db_modificar_biografia();
				if ($result === TRUE){
					echo "<p class='correcto'>Parrafo modificado correctamente</p>";
					listar_biografia();
				}
				elseif ($result === "id"){
					echo "<p class='error'>Id_Parrafo no valido</p>";
					modificar_biografia($_POST["parrafo_mod2"]);
				}
				else {
					if(isset($_POST['cancelar']))
					{
						echo "<p id='cancelacion' class='correcto' >Accion Cancelada correctamente</p>";
					}
					else
					{
						echo "<p class='error'>Se ha producido un error, vuelve a intentarlo";
						modificar_biografia($_POST["parrafo_mod2"]);
					}
					
				}
			}
			else
				listar_biografia();
			break;
			//--------------------------------------------------------------DISCOGRAFIA----------------------------------------------------------------
			//La accion seleccionada es editar discografia
			case "discografia":
			//La operacion seleccionada es borrar disco
			if (isset($_POST["borrar_disco"]))
			{
				db_borrar_disco($_POST["borrar_disco"]);
				echo "<p class='correcto'>Disco borrado correctamente</p>";
				listar_discos();
			}
			//La operacion seleccionada es añadir disco
			elseif (isset($_REQUEST["disco_add"]))
			{
				insertar_disco();
			}
			//La operacion seleccionada es añadir disco y el formulario se ha enviado
			elseif (isset($_POST["disco_add2"]) && !isset($_POST["cancelar"]))
			{
				
				$result = db_insertar_disco();
				if ($result === TRUE){
					echo "<p class='correcto'>Disco insertado correctamente</p>";
					listar_discos();
				}
				elseif ($result === "nombre"){
					echo "<p class='error'>Nombre no valido</p>";
					insertar_disco();
				}
				else {
					echo "<p class='error'>Se ha producido un error, vuelve a intentarlo";
					insertar_disco();
				}
			}
			//La operacion seleccionada es modificar disco
			elseif (isset($_REQUEST["disco_mod"]))
			{
				//echo "VAMOS AL LIO";
				modificar_disco(base64_decode($_REQUEST["disco_mod"]));
			}
			//La operacion seleccionada es modificar disco y el formulario se ha enviado
			elseif (isset($_POST["disco_mod2"]))
			{
				//echo "VAMOS AL LIO22";
				$result = db_modificar_disco();
				if ($result === TRUE){
					echo "<p class='correcto'>Disco modificado correctamente</p>";
					listar_discos();
				}
				elseif ($result === "nombre"){
					echo "<p class='error'>Nombre no valido</p>";
					modificar_disco($_POST["disco_mod2"]);
				}
				else 
				{
					if(isset($_POST['cancelar']))
					{
						echo "<p id='cancelacion' class='correcto'>Accion Cancelada correctamente</p>";
					}
					else
					{
						echo "<p class='error'>Se ha producido un error, vuelve a intentarlo";
						modificar_disco($_POST["disco_mod2"]);
					}
					
				}
			}
			else
				listar_discos();
			break;

			//-------------------------------------------------------------CONCIERTOS-----------------------------------------------------------------
			//La accion seleccionada es editar conciertos
			case "conciertos":
			//La operacion seleccionada es borrar conciertos
			if (isset($_POST["borrar_conciertos"]))
			{
				db_borrar_conciertos($_POST["borrar_conciertos"]);
				echo "<p class='correcto'>Usuario borrado correctamente</p>";
				listar_conciertos();
			}
			//La operacion seleccionada es añadir conciertos
			elseif (isset($_REQUEST["conciertos_add"]))
			{
				insertar_concierto();
			}
			//La operacion seleccionada es añadir conciertos y se ha enviado el formulario
			elseif (isset($_POST["conciertos_add2"]) && !isset($_POST["cancelar"]))
			{
				
				$result = db_insertar_concierto();
				if ($result === TRUE){
					echo "<p class='correcto'>Concierto insertado correctamente</p>";
					listar_conciertos();
				}
				elseif ($result === "fecha"){
					echo "<p class='error'>Fecha no valido</p>";
					insertar_concierto();
				}
				else {
					echo "<p class='error'>Se ha producido un error, vuelve a intentarlo";
					insertar_concierto();
				}
			}
			//La operacion seleccionada es modificar 
			elseif (isset($_REQUEST["conciertos_mod"]))
			{
				//echo "VAMOS AL LIO";
				modificar_concierto(base64_decode($_REQUEST["conciertos_mod"]));
			}
			//La operacion seleccionada es modificar y se ha enviado el formulario
			elseif (isset($_POST["conciertos_mod2"]))
			{
				//echo "VAMOS AL LIO22";
				$result = db_modificar_concierto();
				if ($result === TRUE){
					echo "<p class='correcto'>Concierto modificado correctamente</p>";
					listar_conciertos();
				}
				elseif ($result === "fecha"){
					echo "<p class='error'>Fecha no valido</p>";
					modificar_concierto($_POST["conciertos_mod2"]);
				}
				else 
				{
					if(isset($_POST['cancelar']))
					{
						echo "<p id='cancelacion' class='correcto'>Accion Cancelada correctamente</p>";
					}
					else
					{
						echo "<p class='error'>Se ha producido un error, vuelve a intentarlo";
						modificar_concierto($_POST["conciertos_mod2"]);
					}
					
				}
			}
			else
				listar_conciertos();

			break;
			//------------------------------------------------------------USUARIOS------------------------------------------------------------------
			//La accion seleccionada es editar usuarios
			case "usuarios":
			//La operacion seleccionada es borrar usuario
				if (isset($_POST["borrar_user"])){
					if ($_POST["borrar_user"] !== $_SESSION["email"])
						db_borrar_usuario($_POST["borrar_user"]);
					listar_usuarios();
				}
				//La operacion seleccionada es añadir usuario
				elseif (isset($_REQUEST["usuarios_add"])){
					insertar_usuario();
				}
				//La operacion seleccionada es añadir usuario y se ha enviado el formulario
				elseif (isset($_POST["usuarios_add2"]) && !isset($_POST["cancelar"])){
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
				//La operacion seleccionada es modificar usuario
				elseif (isset($_REQUEST["usuarios_mod"])){
					modificar_usuario(base64_decode($_REQUEST["usuarios_mod"]));
				}
				//La operacion seleccionada es modificar usuario y se ha enviado el formulario
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
						if($_POST['cancelar'])
						{
							echo "<p id='cancelacion' class='correcto' >Accion Cancelada correctamente</p>";
						}
						else
						{
							echo "<p class='error'>Se ha producido un error, vuelve a intentarlo";
							modificar_usuario($_POST["usuarios_mod2"]);
						}
						
					}
				}
				else
					listar_usuarios();
				break;
			//La accion seleccionada es ver el log
			case "log":
				listar_log();
				break;
			//Si todavia no se ha escogido nada
			default:
				echo "<p class='h1login'>Elija una opcion</p>";
				break;
		}
	} else echo "<p class='h1login'>Elija una opcion</p>";
}

//------------------------------------------------------------------------------------LISTADOS----------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------
/**
 * Funcion que lista los conciertos en una tabla, añadiendoles un boton de modificar y borrar en cada fila de la tabla
 * ademas de un boton para añadir concierto al pie de la tabla
 */
function listar_conciertos()
{
	$conn = db_conectar();
	$result = $conn->query("SELECT * FROM conciertos");
	
	echo <<<HTML
	<script type='text/javascript'>
	function eliminar(objButton) {
	  const Fecha = atob(objButton.name);
	  if (window.confirm('Desea eliminar a ' + Fecha + '???')){
	  	let ajax = new XMLHttpRequest();
	  	ajax.open('POST', 'dashboard.php');
	  	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	  	ajax.onreadystatechange = () => {
	  		if (ajax.status === 200 && ajax.readyState === 4)
	  			objButton.parentNode.parentNode.parentNode.removeChild(objButton.parentNode.parentNode);
	  	};
	  	ajax.send('accion={$_REQUEST["accion"]}&borrar_conciertos='+Fecha);
	  } 
	}
	</script>
	<table border='2' align='center'>
	<thead>
		<tr>
			<th>Fecha</th>
			<th>Hora</th>
			<th>Lugar</th>
			<th>Descripcion</th>
		</tr>
	</thead>
	<tbody>
HTML;
	while ( $row = $result->fetch_assoc() ){
		$fecha = date("d/m/Y", (int)$row["Fecha"]);//transformar el numero en la fecha correspondiente
        $hora = date("H:i", (int)$row["Fecha"]);
		echo "
	<tr>
	<td>".htmlentities($fecha)."</td>
	<td>".htmlentities($hora)."</td>
	<td>".htmlentities($row["Lugar"])."</td>
	<td>".htmlentities($row["Descripcion"])."</td>
	<td><input class='admin-botones' type='button' value='Borrar' name='".base64_encode($row["Fecha"])."' onclick='eliminar(this)'>
		<a class='admin-botones' href='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=conciertos&conciertos_mod=".base64_encode($row["Fecha"])."#modificar'>Modificar</a></td>
	</tr>";
	}

	echo "
	</tbody>
	</table>
	<div align='center'>
	<a role='button'  class='admin-botones' href='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=conciertos&conciertos_add=true#inserccion'>Agregar concierto</a>
	</div>";
	$conn->close();
}
//----------------------------------------------------------------------DISCOS------------------------------------------------------------------------------
/**
 * Funcion que lista los discos en una tabla, añadiendoles un boton de modificar y borrar en cada fila de la tabla
 * ademas de un boton para añadir disco al pie de la tabla
 */
function listar_discos()
{
	$conn = db_conectar();
	$result = $conn->query("SELECT * FROM discos");
	echo <<<HTML
	<script type='text/javascript'>
	function eliminar(objButton) {
	  const Id = atob(objButton.name);
	  if (window.confirm('Desea eliminar a ' + Id + '???')){
	  	let ajax = new XMLHttpRequest();
	  	ajax.open('POST', 'dashboard.php');
	  	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	  	ajax.onreadystatechange = () => {
	  		if (ajax.status === 200 && ajax.readyState === 4)
	  			objButton.parentNode.parentNode.parentNode.removeChild(objButton.parentNode.parentNode);
	  	};
	  	ajax.send('accion={$_REQUEST["accion"]}&borrar_disco='+Id);
	  } 
	}
	</script>
	<table border='2' align='center'>
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Fecha Publicacion</th>
			<th>Imagen</th>
			<th>Descripcion</th>
		</tr>
	</thead>
	<tbody>
HTML;
while ($row=mysqli_fetch_array($result)){
		echo "
	<tr>
	<td>".htmlentities($row["Nombre"])."</td>
	<td>".htmlentities($row["Precio"])."</td>
	<td>".htmlentities($row["FechaPublicacion"])."</td>
	<td>".htmlentities($row["Imagen"])."</td>
	<td>".htmlentities($row["Descripcion"])."</td>
	<td><input class='admin-botones' type='button' value='Borrar' name='".base64_encode($row["Nombre"])."' onclick='eliminar(this)'>
		<a class='admin-botones' href='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=discografia&disco_mod=".base64_encode($row["Nombre"])."#modificar'>Modificar</a></td>
	</tr>";
	}

	echo "
	</tbody>
	</table>
	<div align='center'>
	<a role='button'  class='admin-botones' href='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=discografia&disco_add=true#inserccion'>Agregar Disco</a>
	</div>";
	$conn->close();
}
//------------------------------------------------------------------------------------BIOGRAFIA----------------------------------------------------------------
/**
 * Funcion que lista los parrafos de biografia en una tabla, añadiendoles un boton de modificar y borrar en cada fila de la tabla
 * ademas de un boton para añadir parrafo al pie de la tabla
 */
function listar_biografia()
{
	$conn = db_conectar();
	$result = $conn->query("SELECT * FROM biografia");
	echo <<<HTML
	<script type='text/javascript'>
	function eliminar(objButton) {
	  const Id = atob(objButton.name);
	  if (window.confirm('Desea eliminar a ' + Id + '???')){
	  	let ajax = new XMLHttpRequest();
	  	ajax.open('POST', 'dashboard.php');
	  	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	  	ajax.onreadystatechange = () => {
	  		if (ajax.status === 200 && ajax.readyState === 4)
	  			objButton.parentNode.parentNode.parentNode.removeChild(objButton.parentNode.parentNode);
	  	};
	  	ajax.send('accion={$_REQUEST["accion"]}&borrar_conciertos='+Id);
	  } 
	}
	</script>
	<table border='2' align='center'>
	<thead>
		<tr>
			<th>Id</th>
			<th>Texto</th>
		</tr>
	</thead>
	<tbody>
HTML;
while ($row=mysqli_fetch_array($result)){
		echo "
	<tr>
	<td>".htmlentities($row["id"])."</td>
	<td>".htmlentities($row["texto"])."</td>
	<td><input class='admin-botones' type='button' value='Borrar' name='".base64_encode($row["id"])."' onclick='eliminar(this)'>
		<a class='admin-botones' href='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=biografia&parrafo_mod=".base64_encode($row["id"])."#modificar'>Modificar</a></td>
	</tr>";
	}

	echo "
	</tbody>
	</table>
	<div align='center'>
	<a role='button'  class='admin-botones' href='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=biografia&parrafo_add=true#inserccion'>Agregar Parrafo</a>
	</div>";
	$conn->close();
}
//-------------------------------------------------------------------USUARIOS---------------------------------------------------------------------------------
/**
 * Funcion que lista los usuarios en una tabla, añadiendoles un boton de modificar y borrar en cada fila de la tabla
 * ademas de un boton para añadir usuario al pie de la tabla
 */


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

<table border='2' align='center'>
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
		<a class='admin-botones' href='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=usuarios&usuarios_mod=".base64_encode($row["Email"])."#modificar'>Modificar</a></td>
</tr>";
	}

	echo "
	</tbody>
	</table>
	<div align='center'>
	<a role='button'  class='admin-botones' href='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=usuarios&usuarios_add=true#inserccion'>Agregar usuario</a>
	</div>";
	$conn->close();
}
//-------------------------------------------------------------------------MIEMBROS GRUPO---------------------------------------------------------------------------------
/**
 * Funcion que lista los miembros del grupo en una tabla, añadiendoles un boton de modificar y borrar en cada fila de la tabla
 * ademas de un boton para añadir miembro al pie de la tabla
 */
function listar_miembros(){
	$conn = db_conectar();
	$result = $conn->query("SELECT * FROM `miembros_grupo`");
	echo "
<script type='text/javascript'>
	function eliminar(objButton) {
	  const Nombre = atob(objButton.name);
	  if (window.confirm('Desea eliminar a ' + Nombre + '???')){
	  	let ajax = new XMLHttpRequest();
	  	ajax.open('POST', 'dashboard.php');
	  	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	  	ajax.onreadystatechange = () => {
	  		if (ajax.status === 200 && ajax.readyState === 4)
	  			objButton.parentNode.parentNode.parentNode.removeChild(objButton.parentNode.parentNode);
	  	};
	  	ajax.send('accion={$_REQUEST["accion"]}&borrar_miembro='+Nombre);
	  } 
	}
</script>

<table border='2' align='center'>
<thead>
	<tr>
		<th>Nombre</th>
		<th>Roll</th>
		<th>Fecha Nacimiento</th>
		<th>Lugar Nacimiento</th>
		<th>Fotografia</th>
		<th>Biografia</th>
		<th>Acciones</th>
	</tr>
</thead>
<tbody>";

	while ( $row = $result->fetch_assoc() ){
		echo "
<tr>
	<td>".htmlentities($row["Nombre"])."</td>
	<td>".htmlentities($row["Roll"])."</td>
	<td>".htmlentities($row["Fechanacimiento"])."</td>
	<td>".htmlentities($row["Lugarnacimiento"])."</td>
	<td>".htmlentities($row["Fotografia"])."</td>
	<td>".htmlentities($row["Biografia"])."</td>
	<td><input class='admin-botones' type='button' value='Borrar' name='".base64_encode($row["Nombre"])."' onclick='eliminar(this)'>
		<a class='admin-botones' href='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=miembros&miembro_mod=".base64_encode($row["Nombre"])."#modificar'>Modificar</a></td>
</tr>";
	}

	echo "
	</tbody>
	</table>
	<div align='center'>
	<a role='button'  class='admin-botones' href='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=miembros&miembro_add=true#inserccion'>Agregar Miembro </a>
	</div>";
	$conn->close();
}

//---------------------------------------------------------------------------------------MODIFICACIONES-------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------------------------
/**
 * Funcion que gestiona la modificacion de un mmiembro del grupo, carga los datos que se van a modificar
 * y los muestra en el formulario para poderlos modificar
 */
function modificar_miembro($nombre){
	$conn = db_conectar();
	$nombre = $conn->real_escape_string($nombre);
	$result = $conn->query("SELECT * FROM `miembros_grupo` WHERE Nombre='$nombre'");
	$conn->close();
	if ($result !== FALSE && $result->num_rows === 1){
		$row = $result->fetch_assoc();
		$_POST["nombre"] = $row["Nombre"];
		$_POST["roll"] = $row["Roll"];
		$_POST["fechanacimiento"] = $row["Fechanacimiento"];
		$_POST["lugarnacimiento"] = $row["Lugarnacimiento"];
		$_POST["fotografia"] = $row["Fotografia"];
		$_POST["biografia"] = $row["Biografia"];
		echo "<h1 id='modificar' class='h1login'>Modificar Miembro</h1>";
		form_miembro("miembro_mod2", $nombre);
	} else
		echo "<p class='error'>ERROR</p>";
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------------
/**
 * Funcion que gestiona la modificacion de un usuario, carga los datos que se van a modificar
 * y los muestra en el formulario para poderlos modificar
 */
function modificar_usuario($email){
	
	$conn = db_conectar();
	$email = $conn->real_escape_string($email);
	$result = $conn->query("SELECT * FROM usuarios WHERE Email='$email'");
	$conn->close();
	if ($result !== FALSE && $result->num_rows === 1){
		$row = $result->fetch_assoc();
		$_POST["nombre"] = $row["Nombre"];
		$_POST["apellidos"] = $row["Apellidos"];
		$_POST["email"] = $row["Email"];
		$_POST["password"] = $row["Password"];
		$_POST["telefono"] = $row["Telefono"];
		$_POST["tipo"] = $row["TipoUser"];
		echo "<h1 id='modificar' class='h1login'>Modificar Usuario</h1>";
		form_usuario("usuarios_mod2", $email);
	} else
		echo "<p class='error'>ERROR</p>";
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------------
/**
 * Funcion que gestiona la modificacion de un disco, carga los datos que se van a modificar
 * y los muestra en el formulario para poderlos modificar
 */
function modificar_disco($nombre){
	$conn = db_conectar();
	$nombre = $conn->real_escape_string($nombre);
	$result = $conn->query("SELECT * FROM discos WHERE Nombre='$nombre'");
	$conn->close();
	if ($result !== FALSE && $result->num_rows === 1){
		$row = $result->fetch_assoc();
		$_POST["nombre"] = $row["Nombre"];
		$_POST["precio"] = $row["Precio"];
		$_POST["fechapublicacion"] = $row["FechaPublicacion"];
		$_POST["imagen"] = $row["Imagen"];
		$_POST["descripcion"] = $row["Descripcion"];
		$conn = db_conectar();
		$result = $conn->query("SELECT * FROM canciones WHERE Disco='$nombre'");
		$conn->close();
		//if(mysqli_num_rows($res)>0)
		if ($result !== FALSE && $result->num_rows > 1)
		{	
			while ($cancion=mysqli_fetch_array($result))
			{
				$_POST["titulo"][]=$cancion["Titulo"];
				$_POST["duracion"][]=$cancion["Duracion"];
			}
		}
		else
		{
			echo "<p class='error'> No hay canciones</p>";
		}
		echo "<h1 id='modificar' class='h1login'> Modificar Disco</h1>";
		//print_r($_POST);
		form_disco("disco_mod2", $nombre);
	} else
		echo "<p class='error'>ERROR disco1</p>";
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------------
/**
 * Funcion que gestiona la modificacion de un concierto, carga los datos que se van a modificar
 * y los muestra en el formulario para poderlos modificar
 */
function modificar_concierto($fecha){
	$conn = db_conectar();
	$fecha = $conn->real_escape_string($fecha);
	$result = $conn->query("SELECT * FROM conciertos WHERE Fecha='$fecha'");
	$conn->close();
	if ($result !== FALSE && $result->num_rows === 1){
		$row = $result->fetch_assoc();
        $hora = date("H:i", (int)$row["Fecha"]);
		$_POST["fecha"] = date("d/m/Y", (int)$row["Fecha"]);;
		$_POST["hora"] = $hora;
		$_POST["lugar"] = $row["Lugar"];
		$_POST["descripcion"] = $row["Descripcion"];
		echo "<h1 id='modificar' class='h1login'>Modificar Concierto</h1>";
		form_concierto("conciertos_mod2", $fecha);
	} else
		echo "<p class='error'>ERROR</p>";
}
//-------------------------------------------------------------------------------------------------------
/**
 * Funcion que gestiona la modificacion de un parrafo de biografia, carga los datos que se van a modificar
 * y los muestra en el formulario para poderlos modificar
 */
function modificar_biografia($id){
	$conn = db_conectar();
	$id = $conn->real_escape_string($id);
	$result = $conn->query("SELECT * FROM biografia WHERE id='$id'");
	$conn->close();
	if ($result !== FALSE && $result->num_rows === 1){
		$row = $result->fetch_assoc();
		$_POST["id"] = $row["id"];
		$_POST["texto"] = $row["texto"];
		
		echo "<h1 id='modificar' class='h1login'>Modificar Parrafo</h1>";
		//print_r($id);
		form_biografia("parrafo_mod2", $id);
	} else
		echo "<p class='error'>ERROR</p>";
}
//-------------------------------------------------------------------------------------------------------
/**
 * Funcion que te permite seguir añadiendo miembros una vez ya has añadido uno
 */
function insertar_miembro(){
	echo "<p id='inserccion' class='correcto'>Inserta un nuevo miembro:</p>";
	form_miembro("miembro_add2");
}
//-------------------------------------------------------------------------------------------------------
/**
 * Funcion que te permite seguir añadiendo discos una vez ya has añadido uno
 */
function insertar_disco(){
	echo "<p id='inserccion' class='correcto'>Inserta un nuevo disco:</p>";
	form_disco("disco_add2");
}
//-------------------------------------------------------------------------------------------------------
/**
 * Funcion que te permite seguir añadiendo usuarios una vez ya has añadido uno
 */
function insertar_usuario(){
	echo "<p id='inserccion' class='correcto'>Inserta un nuevo usuario:</p>";
	form_usuario("usuarios_add2");
}
//-------------------------------------------------------------------------------------------------------
/**
 * Funcion que te permite seguir añadiendo conciertos una vez ya has añadido uno
 */
function insertar_concierto(){
	echo "<p  id='inserccion' class='correcto'>Inserta un nuevo concierto:</p>";
	form_concierto("conciertos_add2");
}
//-------------------------------------------------------------------------------------------------------
/**
 * Funcion que te permite seguir añadiendo parrafos de biografia una vez ya has añadido uno
 */
function insertar_biografia(){
	echo "<p id='inserccion' class='correcto'>Inserta un nuevo Parrafo:</p>";
	form_biografia("parrafo_add2");
}
//-------------------------------------------------------------------------------------------------------

/**
 * Funcion que imprime el formulario para la modificacion o insercion de un usuario
 */
function form_usuario($location, $extra="true"){
	
	$gestor=$administrador='';
    if(isset($_POST['tipo']) && $_POST['tipo']=='gestor')//para el type = radio
    {
        $gestor='checked';
    }
    elseif(isset($_POST['tipo']) && $_POST['tipo']=='admin')
		$administrador='checked';
		
	echo "
	<div align='center'>	
		<div class='login'>
			<form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
				
				
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
				<input type='radio' id='admin' name='tipo' value='admin' $administrador>
				<label for='gestor'>Gestor: </label>
				<input type='radio' id='gestor' name='tipo' value='gestor' $gestor>
				<br>
				<input type='hidden' name='accion' value='usuarios'>
				<input type='hidden' name='$location' value='$extra'>
				<input type='submit' value='Enviar'>
				<input type='submit' name='cancelar' value='Cancelar'>
			</form>
			</div>
		</div>	
";
}
//-------------------------------------------------------------------------------------------------------

/**
 * Funcion que imprime el formulario para la modificacion o insercion de un disco
 */
function form_disco($location, $extra="true"){
	
	if(isset($_POST['nombre']))
		$nombre=$_POST['nombre'];
	else $nombre='';

	if(isset($_POST['precio']))
		$precio=$_POST['precio'];
	else $precio='';
	if(isset($_POST['fechapublicacion']))
		$fechapublicacion=$_POST['fechapublicacion'];
	else $fechapublicacion='';
	if(isset($_POST['imagen']))
		$imagen=$_POST['imagen'];
	else $imagen='';
	if(isset($_POST['descripcion']))
		$descripcion=$_POST['descripcion'];
	else $descripcion='';
	$action_form_disco=htmlspecialchars($_SERVER["PHP_SELF"]);//es para que no aparezca el nombre de dashboard.php

	echo <<<HTML
	<div align='center'>	
		<div class='login'>
			<form method='post' action='$action_form_disco'>
				
				
				<label for='nombre'>Nombre: </label>
				<input type='text' id='nombre' name='nombre' value='$nombre' required>
				<br>
				<label for='precio'>Precio: </label>
				<input type='text' id='precio' name='precio' value='$precio'>
				<br>
				<label for='fechapublicacion'>FechaPublicacion: </label>
				<input type='text' id='fechapublicacion' name='fechapublicacion' value='$fechapublicacion' >
				<br>
				<label for='imagen'>Imagen: </label><br>
				<textarea id='imagen' name='imagen' cols='50' rows='1'>$imagen</textarea>
				<br>
				<label for='descripcion'>Descripcion: </label><br>
				<textarea id='descripcion' name='descripcion' cols='50' rows='10'>$descripcion</textarea>
				<br>
				<label for='canciones'>Canciones: </label><br>
HTML;
				
				if(isset($_POST["titulo"]) && isset($_POST['duracion']))
				{
					
					
					$i=1;
					foreach(array_combine( $_POST["titulo"], $_POST["duracion"] ) as $titulo => $duracion)
					{
						echo "<input type='text' size='40'  name='titulo$i' value='$titulo' >";
						echo "<input type='text' size='40'  name='duracion$i' value='$duracion' >";
						echo "<br>";
						$i++;
						
					}
					
				}
				
			echo <<<HTML
				<input type='hidden' name='accion' value='discografia'>
				<input type='hidden' name='$location' value='$extra'>
				<input type='submit' value='Enviar'>
				
				<div id='inicioCancion'></div>
			</form>
HTML;
			if($location!='disco_mod2')
			{
		echo <<<HTML
				<button onclick='nuevaCancion()'>Nueva Cancion</button>
			<script>
				
			</script>
			
			<form method='post' action='$action_form_disco?accion=discografia#panel_control'>
				<input type='submit' name='cancelar' value='Cancelar'>
			</form>
			</div>
		</div>	
HTML;
			}
			

//print_r($_REQUEST);
}
//-------------------------------------------------------------------------------------------------------

/**
 * Funcion que imprime el formulario para la modificacion o insercion de un miembro
 */
function form_miembro($location, $extra="true"){
	
		
	echo "
	<div align='center'>	
		<div class='login'>
			<form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
				
				
				<label for='nombre'>nombre: </label>
				<input type='text' id='nombre' name='nombre'
				value='" . (isset($_POST['nombre']) ? $_POST['nombre'] : '') ."' required>
				<br>
				<label for='roll'>Roll: </label>
				<input type='text' id='roll' name='roll'
				value='" . (isset($_POST['roll']) ? $_POST['roll'] : '') . "'>
				<br>
				<label for='fechanacimiento'>Fecha Nacimiento: </label>
				<input type='text' id='fechanacimiento' name='fechanacimiento'
				value='" . (isset($_POST['fechanacimiento']) ? $_POST['fechanacimiento'] : '') . "' >
				<br>
				<label for='lugarnacimiento'>Lugar de Nacimiento: </label><br>
				<textarea id='lugarnacimiento' cols='50' rows='1' name='lugarnacimiento'>".
				 (isset($_POST['lugarnacimiento']) ? $_POST['lugarnacimiento'] : '') ."</textarea>
				<br>
				<label for='fotografia'>Fotografia: </label>
				<input type='text' id='fotografia' name='fotografia'
				value='" . (isset($_POST['fotografia']) ? $_POST['fotografia'] : '') . "' >
				<br>
				
				<label for='biografia'>Biografia: </label><br>
				<textarea id='biografia' name='biografia' cols='50' rows='10'>". 
				(isset($_POST['biografia']) ? $_POST['biografia'] : '') ."</textarea>
			
				<br>
				
				<input type='hidden' name='accion' value='miembros'>
				<input type='hidden' name='$location' value='$extra'>
				<input type='submit' value='Enviar'>
				
			</form>
			<form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=miembros#panel_control'>
				<input type='submit' name='cancelar' value='Cancelar'>
				</form>
			</div>
		</div>	
";
//print_r($_POST);

}
//-------------------------------------------------------------------------------------------------------

/**
 * Funcion que imprime el formulario para la modificacion o insercion de un concierto
 */
function form_concierto($location, $extra="true"){
	
	
	echo "
	<div align='center'>	
		<div class='login'>
			<form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
				
				
				<label for='fecha'>Fecha: </label>
				<input type='text' id='fecha' name='fecha'
				value='" . (isset($_POST['fecha']) ? $_POST['fecha'] : '') ."' required>
				<br>
				<label for='hora'>Hora: </label>
				<input type='text' id='hora' name='hora'
				value='" . (isset($_POST['hora']) ? $_POST['hora'] : '') . "'>
				<br>
				<label for='lugar'>Lugar: </label>
				<input type='text' id='lugar' name='lugar'
				value='" . (isset($_POST['lugar']) ? $_POST['lugar'] : '') . "' >
				<br>
				<label for='lugar'>Descripcion: </label><br>
				<textarea id='descripcion' name='descripcion' cols='50' rows='10'>". 
				(isset($_POST['descripcion']) ? $_POST['descripcion'] : '') ."</textarea>
			
				<br>
				
				<input type='hidden' name='accion' value='conciertos'>
				<input type='hidden' name='$location' value='$extra'>
				<input type='submit' value='Enviar'>
				
			</form>
			<form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=conciertos#panel_control'>
				<input type='submit' name='cancelar' value='Cancelar'>
				</form>
			</div>
		</div>	
";
//print_r($_POST);

}
//-------------------------------------------------------------------------------------------------------

/**
 * Funcion que imprime el formulario para la modificacion o insercion de un parrafo de biografia
 */
function form_biografia($location, $extra="true"){
	
	echo "
	<div align='center'>	
		<div class='login'>
			<form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
				
				
				<label for='id'>Id: </label>
				<input type='text' id='id' name='id'
				value='" . (isset($_POST['id']) ? $_POST['id'] : '') ."' required>
				<br>
				<label for='texto'>Texto: </label><br>
				
				<textarea id='texto' name='texto' cols='70' rows='10'>". 
				(isset($_POST['texto']) ? $_POST['texto'] : '') ."</textarea>
				<br>
				<input type='hidden' name='accion' value='biografia'>
				<input type='hidden' name='$location' value='$extra'>
				<input type='submit' value='Enviar'>
				</form>
				<form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=biografia#panel_control'>
				<input type='submit' name='cancelar' value='Cancelar'>
				</form>
			</div>
		</div>	
";
}

/**
 * Funcion para listar el log del sistema y mostrarlo en modo de tabla
 */
function listar_log(){
	$conn = db_conectar();
	$result = $conn->query("SELECT * FROM log");
	echo "
<table border='2' align='center'>
<thead>
	<tr>
		<th>ID</th>
		<th>Texto</th>
	</tr>
</thead>
<tbody>";
	while ( $row = $result->fetch_assoc() ){
		echo "
<tr>
	<td>".htmlentities($row["id"])."</td>
	<td>".htmlentities($row["descripcion"])."</td>
</tr>";
	}
	echo "
	</tbody>
	</table>";
	$conn->close();
}
