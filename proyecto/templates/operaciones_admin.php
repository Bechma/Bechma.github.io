<?php

//print_r($_POST);
require_once "operaciones_db.php";
//----------------------------------------------------------------------------------------------------------------------------------------------------
function opciones_admin(){
	if ($_SESSION["tipo_user"] === "admin"){
		$href = ["componentes", "biografia", "discografia", "conciertos", "usuarios", "log", "logout"];
		$name = ["Editar Componentes Grupo", "Editar biografía", "Editar discografía", "Editar conciertos", "Editar usuarios", "Ver log del servidor", "Desconectarse"];
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
function acciones(){
	
	
	
	if (isset($_REQUEST["accion"])){
		switch ($_REQUEST["accion"]){
			case "componentes":
				break;
			case "biografia":
			if (isset($_POST["borrar_parrafo"])){
				db_borrar_biografia($_POST["borrar_parrafo"]);
				listar_biografia();
			}
			elseif (isset($_REQUEST["parrafo_add"])){
				insertar_biografia();
			}
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
			elseif (isset($_REQUEST["parrafo_mod"]) && !isset($_POST["cancelar"])){
				modificar_biografia(base64_decode($_REQUEST["parrafo_mod"]));
			}
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
					if($_POST['cancelar'])
					{
						echo "<p class='correcto' >Accion Cancelada correctamente</p>";
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

			case "discografia":
				break;
			case "conciertos":

			if (isset($_POST["borrar_conciertos"]))
			{
				db_borrar_conciertos($_POST["borrar_conciertos"]);
				echo "<p class='correcto'>Usuario borrado correctamente</p>";
				listar_conciertos();
			}
			elseif (isset($_REQUEST["conciertos_add"]))
			{
				insertar_concierto();
			}
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
			elseif (isset($_REQUEST["conciertos_mod"]))
			{
				//echo "VAMOS AL LIO";
				modificar_concierto(base64_decode($_REQUEST["conciertos_mod"]));
			}
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
					if($_POST['cancelar'])
					{
						echo "<p class='correcto'>Accion Cancelada correctamente</p>";
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


			case "usuarios":
				if (isset($_POST["borrar_user"])){
					db_borrar_usuario($_POST["borrar_user"]);
					listar_usuarios();
				}
				elseif (isset($_REQUEST["usuarios_add"])){
					insertar_usuario();
				}
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
						if($_POST['cancelar'])
						{
							echo "<p class='correcto' >Accion Cancelada correctamente</p>";
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
			case "log":
				listar_log();
				break;
			default:
				echo "<p class='h1login'>Elija una opcion</p>";
				break;
		}
	} else echo "<p class='h1login'>Elija una opcion</p>";
}

//------------------------------------------------------------------------------------LISTADOS----------------------------------------------------------------
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
		echo "
	<tr>
	<td>".htmlentities($row["Fecha"])."</td>
	<td>".htmlentities($row["Hora"])."</td>
	<td>".htmlentities($row["Lugar"])."</td>
	<td>".htmlentities($row["Descripcion"])."</td>
	<td><input class='admin-botones' type='button' value='Borrar' name='".base64_encode($row["Fecha"])."' onclick='eliminar(this)'>
		<a class='admin-botones' href='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=conciertos&conciertos_mod=".base64_encode($row["Fecha"])."'>Modificar</a></td>
	</tr>";
	}

	echo "
	</tbody>
	</table>
	<div align='center'>
	<a role='button'  class='admin-botones' href='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=conciertos&conciertos_add=true'>Agregar concierto</a>
	</div>";
	$conn->close();
}
//----------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------LISTADOS----------------------------------------------------------------
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
		<a class='admin-botones' href='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=biografia&parrafo_mod=".base64_encode($row["id"])."'>Modificar</a></td>
	</tr>";
	}

	echo "
	</tbody>
	</table>
	<div align='center'>
	<a role='button'  class='admin-botones' href='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=biografia&parrafo_add=true'>Agregar Parrafo</a>
	</div>";
	$conn->close();
}
//----------------------------------------------------------------------------------------------------------------------------------------------------



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
		<a class='admin-botones' href='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=usuarios&usuarios_mod=".base64_encode($row["Email"])."'>Modificar</a></td>
</tr>";
	}

	echo "
	</tbody>
	</table>
	<div align='center'>
	<a role='button'  class='admin-botones' href='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=usuarios&usuarios_add=true'>Agregar usuario</a>
	</div>";
	$conn->close();
}

//---------------------------------------------------------------------------------------MODIFICACIONES-------------------------------------------------------------

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
		$_POST["tipo"] = $row["TipoUser"];
		echo "<h1 class='h1login'>Modificar Usuario</h1>";
		form_usuario("usuarios_mod2", $email);
	} else
		echo "<p class='error'>ERROR</p>";
}
//-------------------------------------------------------------------------------------------------------

function modificar_concierto($fecha){
	$conn = db_conectar();
	$result = $conn->query("SELECT * FROM conciertos WHERE Fecha='$fecha'");
	$conn->close();
	if ($result !== FALSE && $result->num_rows === 1){
		$row = $result->fetch_assoc();
		$_POST["fecha"] = $row["Fecha"];
		$_POST["hora"] = $row["Hora"];
		$_POST["lugar"] = $row["Lugar"];
		$_POST["descripcion"] = $row["Descripcion"];
		
		echo "<h1 class='h1login'>Modificar Concierto</h1>";
		form_concierto("conciertos_mod2", $fecha);
	} else
		echo "<p class='error'>ERROR</p>";
}
//-------------------------------------------------------------------------------------------------------

function modificar_biografia($id){
	$conn = db_conectar();
	$result = $conn->query("SELECT * FROM biografia WHERE id='$id'");
	$conn->close();
	if ($result !== FALSE && $result->num_rows === 1){
		$row = $result->fetch_assoc();
		$_POST["id"] = $row["id"];
		$_POST["texto"] = $row["texto"];
		
		echo "<h1 class='h1login'>Modificar Parrafo</h1>";
		//print_r($id);
		form_biografia("parrafo_mod2", $id);
	} else
		echo "<p class='error'>ERROR</p>";
}
//-------------------------------------------------------------------------------------------------------

function insertar_usuario(){
	echo "<p class='correcto'>Inserta un nuevo usuario:</p>";
	form_usuario("usuarios_add2");
}
//-------------------------------------------------------------------------------------------------------

function insertar_concierto(){
	echo "<p class='correcto'>Inserta un nuevo concierto:</p>";
	form_concierto("conciertos_add2");
}
//-------------------------------------------------------------------------------------------------------
function insertar_biografia(){
	echo "<p class='correcto'>Inserta un nuevo Parrafo:</p>";
	form_biografia("parrafo_add2");
}
//-------------------------------------------------------------------------------------------------------




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
				<input type='submit' name='cancelar' value='Cancelar'>
			</form>
			</div>
		</div>	
";
}
//-------------------------------------------------------------------------------------------------------
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
				<input type='submit' name='cancelar' value='Cancelar'>
			</form>
			</div>
		</div>	
";
}


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
