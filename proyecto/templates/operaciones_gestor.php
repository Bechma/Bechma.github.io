<?php
require_once "operaciones_db.php";
/**
 * Esta funcion imprimira el menu de operaciones que un gestor puede ejecutar 
 */
function opciones_gestor(){
	if ($_SESSION["tipo_user"] === "gestor"){
		$href = ["consulta", "historico", "precio", "logout"];
		$name = ["Consultar peticiones pendientes", "Consultar historico", "Editar precio discos", "Desconectarse"];
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
/**
 * Funcion que gestiona las acciones que puede realizar un usuario de tipo administrador: 
 * -Consultar peticiones pendientes: Permite al gestor ver que pedidos estan pendientes de ser aceptados
 * -Consultar historico: Permite al gestor consultar una lista de pedidos tanto aceptados como rechazados
 * -Editar precio discos: Permite al gestor modificar el precio de un disco
 * -Desconectarse: Permite al gestor cerrar su sesion
 */
function acciones(){
	if (isset($_REQUEST["accion"])){
		switch ($_REQUEST["accion"]){
			/******************************************************************/
			//Accion seleccionada es Consultar peticiones pendientes
			case "consulta":
			//Operacion seleccionada es gestionar pedidos
			if (isset($_REQUEST['gestionar_ped'])){
				
				/*Aqui entra con el boton*/
				gestionar_pedido(base64_decode($_REQUEST["gestionar_ped"]));
			//Operacion seleccionada es gestionar pedidos y se ha enviado el formulario
			}elseif(isset($_REQUEST['pedidos_mod2'])){
				
				$result = db_gestionar_pedido();

				if($result === TRUE){
					echo" <p class='correcto'> Pedido actualizado</p>";
					listar_peticiones();
				}
				elseif ($result === "id"){
					echo"<p class='error'> Id incorrecto </p> ";
					gestionar_pedido($_POST["pedidos_mod2"]);
				}
				else{
					if(isset($_POST['cancelar'])){
						echo "<p class='correcto'> Accion cancelada exitosamente</p>";	
					}
					else{
						echo "<p class='error'> Valor de result: '$result'  </p>";
					}
				}
			}
			else{
				listar_peticiones();
			}
			
			break;
			/******************************************************************/
			//Accion seleccionada es Consultar el historico
			case "historico":

			listar_historico();
			break;
			/******************************************************************/
			//Accion seleccionada es modificar el precio de un disco
			case "precio":
			//Operacion es modificar
			if(isset($_REQUEST["modificar_precio"])){
				gestionar_disco(base64_decode($_REQUEST["modificar_precio"]));
				//Operacion es modificar y se ha enviado el formulario
			}elseif(isset($_REQUEST["discos_mod2"])){
				$result = db_mod_precio();
				if($result === TRUE){
					echo"<p class='correcto'>Precio cambiado correctamente </p>";
					listar_discos();
				}elseif($result === "Nombre"){
					echo"<p class='error'> Nombre del disco incorrecto </p>";
					gestionar_disco($_POST["discos_mod2"]);
				}
				else{
					if(isset($_POST['cancelar'])){
						echo "<p class='correcto'> Accion cancelada exitosamente</p>";	
					}
					else{
						echo "<p class='error'> fallo </p>";
					}
				}
			}
			else{
				listar_discos();
			}
			
			break;
			/******************************************************************/
			//Accion predeterminada si no se ha elegido nada
			default:
				echo "<p class='h1login'>Elija una opcion</p>";
				break;
		}
	} else echo "<p class='h1login'>Elija una opcion</p>";
}
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
/**
 * Funcion que se encarga de listar en una tabla las peticiones de la tabla de pedidos cuyo estado es 'En Espera'
 */
function listar_peticiones(){

	$conn = db_conectar();
	$result = $conn->query("SELECT * from pedidos WHERE Estado='En Espera'");
	echo <<<HTML
	<table border='2' align='center'>
	<thead>
		<tr>
			<th>Fecha</th>
			<th>Email Gestor</th>
			<th>Texto Email</th>
			<th>Estado</th>
			<th>Accion</th>
		</tr>
	</thead>
	<tbody>
HTML;
	while ($row = $result->fetch_assoc() ){
		echo"
		<tr>
		<td>".htmlentities($row["Fecha"])."</td>
		<td>".htmlentities($row["EmailGestor"])."</td>
		<td>".htmlentities($row["TextoEmail"])."</td>
		<td>".htmlentities($row["Estado"])."</td>
		<td><a class='admin-botones' href='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=consulta&gestionar_ped=".base64_encode($row["id"])."'>Gestionar</a></td>
		</tr>
		
		<input type='hidden' name='gestor' value='{$_SESSION['email']}'> ";
	
		
	}
	echo "
	</tbody>
	</table>";
	$conn->close();
}
/**
 * Funcion que muestra el historico de pedidos gestionados por un gestor, los pedidos aceptados se mostraran
 * ordenados por fecha en una tabla, y los denegados en otra tabla distinta, ordenados de igual manera
 */
function listar_historico(){
	$conn = db_conectar();
	//Disco precio estado textomail y gestor
	// aceptados por un lado y denegados por otro, ordenados por fecha
	
	$discospedidos = $conn->query("SELECT * FROM discospedidos") or die($conn->error);
	$discos = $conn->query("SELECT * FROM discos") or die($conn->error);
	$pedidos = $conn->query("SELECT * FROM pedidos") or die($conn->error);
	$aux = $conn->query("SELECT * FROM pedidos") or die($conn->error);

	$precio_disco = [];

	while ($row = $discos->fetch_assoc()){ //fetch_array?
		$precio_disco[$row["Nombre"]] = $row["Precio"];
	}
	
	echo <<<HTML
	<table border='2' align='center'>
	<thead>
		<tr>
			<th>Id</th>
			<th>Precio</th>
			<th>Estado</th>
			<th>Texto Email</th>
			<th>Gestor</th>
			<th>Fecha</th>
		</tr>
	</thead>
	<tbody>
HTML;
$coste_pedido = [];
while ($row = $discospedidos->fetch_assoc()){ //fetch_array?
	if (isset($coste_pedido[$row["idpedidos"]])){
		$coste_pedido[$row["idpedidos"]] += $row["Cantidad"] * $precio_disco[$row["Nombrediscos"]];
	} else {
		$coste_pedido[$row["idpedidos"]] = $row["Cantidad"] * $precio_disco[$row["Nombrediscos"]];
	}
}

while($row = $pedidos->fetch_assoc()){

	if($row["Estado"]== "Aceptado"){
	echo"
	<tr>
	<td>".htmlentities($row["id"])."</td>
	<td>".htmlentities($coste_pedido[$row["id"]]). "</td>
	<td>".htmlentities($row["Estado"])."</td>
	<td>".htmlentities($row["TextoEmail"])."</td>
	<td>".htmlentities($row["EmailGestor"])."</td>
	<td>".htmlentities($row["Fecha"])."</td>
	</tr>";
	}
}
echo "
</tbody>
</table><br>";

echo <<<HTML
<table border='2' align='center'>
<thead>
	<tr>
		<th>Id</th>
		<th>Precio</th>
		<th>Estado</th>
		<th>Texto Email</th>
		<th>Gestor</th>
		<th>Fecha</th>
	</tr>
</thead>
<tbody>
HTML;
while($row = $aux->fetch_assoc()){

	if($row["Estado"]== "Denegado"){
	echo"
	<tr>
	<td>".htmlentities($row["id"])."</td>
	<td>".htmlentities($coste_pedido[$row["id"]]). "</td>
	<td>".htmlentities($row["Estado"])."</td>
	<td>".htmlentities($row["TextoEmail"])."</td>
	<td>".htmlentities($row["EmailGestor"])."</td>
	<td>".htmlentities($row["Fecha"])."</td>
	</tr>";
	}
}
echo "
</tbody>
</table>";

	$conn->close();

}
/**
 * Funcion que se encarga de listar en una tabla los discos que se encuentran almacenados en una base de datos
 * junto con todos sus campos, se añade ademas un boton para permitir su modificacion
 */
function listar_discos(){
	$conn = db_conectar();
	$result = $conn->query("SELECT * from discos");
	echo <<<HTML
	<table border='2' align='center'>
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Fecha Publicacion</th>
			<th>Descripcion</th>
			<th>Imagen</th>
			<th>Accion</th>
		</tr>
	</thead>
	<tbody>
HTML;
	while ($row = $result->fetch_assoc() ){
		echo"
		<tr>
		<td>".htmlentities($row["Nombre"])."</td>
		<td>".htmlentities($row["Precio"])."</td>
		<td>".htmlentities($row["FechaPublicacion"])."</td>
		<td>".htmlentities($row["Descripcion"])."</td>
		<td>".htmlentities($row["Imagen"])."</td>
		<td><a class='admin-botones' href='".htmlspecialchars($_SERVER["PHP_SELF"])."?accion=precio&modificar_precio=".base64_encode($row["Nombre"])."'>Modificar Precio</a></td>
		</tr>";
	
		
	}
	echo "
	</tbody>
	</table>";
	$conn->close();
}
/**
 * Funcion que se encarga de recopilar los datos del pedido seleccionado para mostrarlos en el formulario
 * y permitir su modificacion
 */
function gestionar_pedido($id){

	$conn = db_conectar();
	$result = $conn->query("SELECT * FROM pedidos WHERE id = '$id'");
	$conn->close();
	if($result !== FALSE && $result->num_rows === 1){
		$row = $result->fetch_assoc();
		$_POST["id"] = $row["id"];
		$_POST["EmailGestor"] = $_SESSION['email'];
		$_POST['Fecha'] = date("d/m/Y");
		$_POST['TextoEmail'] = $row["TextoEmail"];
		$_POST['Estado'] = $row["Estado"];
		echo "<h1 class='h1login'> Gestión del Pedido: #{$row["id"]}</h1>";
		form_pedido("pedidos_mod2",$id); 
	} else{
		echo "<p class='error'>Consulta a la base de datos fallida'</p>";
	}

}
/**
 * Funcion que se encarga de recopilar los datos del disco seleccionado para mostrarlos en el formulario
 * y permitir su modificacion
 */
function gestionar_disco($Nombre){
	$conn = db_conectar();
	$result = $conn->query("SELECT * FROM discos WHERE Nombre = '$Nombre'");
	$conn->close();
	if($result !== FALSE && $result->num_rows === 1){
		$row = $result->fetch_assoc();
		$_POST["Nombre"] = $row["Nombre"];
		$_POST["Precio"] = $row["Precio"];
		echo "<h1 class='h1login'> Modificación de precio de disco</h1>";
		form_modprecio("discos_mod2",$Nombre);
	} else{
		echo "<p class='error'>Consulta a la base de datos fallida</p>";
	}
}
/**
 * Funcion imprime el formulario que habra que rellenar para gestionar un pedido
 */
function form_pedido($location, $extra="true"){
	echo "
		<div align='center'>
			<div class='login' align='center'>
				<form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>

				
				<input type='hidden' id='id' name='id'
				value='" . (isset($_POST['id']) ? $_POST['id'] : '') . "' readonly>
				<br>
				<label for='EmailGestor'>Email del Gestor Asociado: </label>
				<input type='text' id='EmailGestor' name='EmailGestor'
				value='" . (isset($_POST['EmailGestor']) ? $_POST['EmailGestor'] : '') . "' readonly>
				<br>
				<label for='Fecha'>Fecha: </label>
				<input type='text' id='Fecha' name='Fecha'
				value='" . (isset($_POST['Fecha']) ? $_POST['Fecha'] : '') . "' readonly>
				<br>
				<label for='TextoEmail'>TextoEmail: </label>
				<input type='text' id='TextoEmail' name='TextoEmail'
				value='" . (isset($_POST['TextoEmail']) ? $_POST['TextoEmail'] : '') . "'>
				<br>
				<label for='Estado'>Estado: </label>
				<select name='EstadoNuevo'>
    				<option value='Aceptado'>Aceptar Pedido</option>
    				<option value='Denegado'>Denegar Pedido</option>
  				</select>
				<br>
				<input type='hidden' name='accion' value='consulta'>
				<input type='hidden' name='$location' value='$extra'>
				<input type='submit' value='Enviar'>
				<input type='submit' name='cancelar' value='Cancelar'>
			</form>
			</div>
		</div>	
	";
}
/**
 * Funcion que imprime el formulario que habra que rellenar para modificar el precio de un disco
 */
function form_modprecio($location, $extra="true"){
	echo"
		<div align='center'>
			<div class='login'>
				<form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>

				<label for='Nombre'>Nombre: </label>
				<input type='text' id='Nombre' name='Nombre'
				value='".(isset($_POST['Nombre']) ? $_POST['Nombre'] : '')."' readonly>
				<br>
				<label for='Precio'>Precio: </label>
				<input type='text' id='Precio' name='NuevoPrecio'
				value='".(isset($_POST['Precio']) ? $_POST['Precio'] : '')."'>
				<br>
				<input type='hidden' name='accion' value='precio'>
				<input type='hidden' name='$location' value='$extra'>
				<input type='submit'  value='Enviar'>
				<input type='submit' name='cancelar' value='cancelar'>
			</form>
			</div>
		</div>	

	";
}