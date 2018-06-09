<?php
require_once "pag_comun.php";
require_once "templates/operaciones_db.php";
HTMLinicio("Carrito");
////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * Funcion que muestra el formulario que se debe rellenar para completar un pedido.
 * Comprobará los siguientes parámetros: Nombre, Apellidos, Dirección postal, Teléfono,
 * Email, Tipo de pago, Valores de la tarjeta(en caso necesario). Si algun campo esta incorrecto
 * mostrara mensaje de error y mantendra los valores ya introducidos.  Cuando todos los campos
 * esten correctos, añadira un pedido a la base de datos
 */
function formPedido(){

	$resultado = "";
	if (isset($_POST["nombre"]) && gettype($_POST["nombre"]) === "string" && strlen($_POST["nombre"]) > 0)
		$resultado .= "<p>Nombre: ".htmlentities($_POST["nombre"])."</p>\n";
	else{
		$error = "nombre";
		require_once "templates/formulario_compra.php";
		die();
	}

	if (isset($_POST["apellidos"]) && gettype($_POST["apellidos"]) === "string" && strlen($_POST["apellidos"]) > 0)
		$resultado .= "<p>Apellidos: ".htmlentities($_POST["apellidos"])."</p>\n";
	else{
		$error = "apellidos";
		require_once "templates/formulario_compra.php";
		die();
	}

	if (isset($_POST["postal"]) && gettype($_POST["postal"]) === "string" && strlen($_POST["postal"]) === 5
		&& preg_match("!^([1-9]{2}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$!", $_POST["postal"]))
		$resultado .= "<p>Direccion postal: ".htmlentities($_POST["postal"])."</p>\n";
	else{
		$error = "postal";
		require_once "templates/formulario_compra.php";
		die();
	}

	if (isset($_POST["telefono"]) && gettype($_POST["telefono"]) === "string"
		&& preg_match("![56789][0-9]{8}!", $_POST["telefono"]))
		$resultado .= "<p>Telefono: ".htmlentities($_POST["telefono"])."</p>\n";
	else{
		$error = "telefono";
		require_once "templates/formulario_compra.php";
		die();
	}

	if (isset($_POST["mail"]) && filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)){
		$resultado .= "<p>Email: ".htmlentities($_POST["mail"])."</p>\n";
	}
	else{
		$error = "mail";
		require_once "templates/formulario_compra.php";
		die();
	}

	if (isset($_POST["pago"]) && ($_POST["pago"] === "tarjeta" || $_POST["pago"] === "reembolso")){
		$resultado .= "<p>Tipo de pago: ".htmlentities($_POST["pago"])."</p>\n";

		if ($_POST["pago"] === "tarjeta"){
			if (isset($_POST["numero_tarjeta"]) &&
				(preg_match("/^5[1-5][0-9]{2}-?[0-9]{4}-?[0-9]{4}-?[0-9]{4}$/", $_POST["numero_tarjeta"])) || (preg_match("/^4[0-9]{3}-?[0-9]{4}-?[0-9]{4}-?[0-9]{4}$/", $_POST["numero_tarjeta"]))){
				$resultado .= "<p>Numero tarjeta: ".htmlentities($_POST["tipo_tarjeta"])."</p>\n";
			}
			else{
				$error = "numero_tarjeta";
				require_once "templates/formulario_compra.php";
				die();
			}

			if (isset($_POST["tarjeta_mes"]) && isset($_POST["tarjeta_anio"])
				&& $_POST["tarjeta_mes"] >= 1 && $_POST["tarjeta_mes"] <= 12
				&& $_POST["tarjeta_anio"] >= 2000 && $_POST["tarjeta_anio"] <= 2050){
				$resultado .= "<p>Tarjeta caduca el: {$_POST["tarjeta_mes"]}/{$_POST["tarjeta_anio"]}</p>\n";
			}
			else{
				$error = "tarjeta_caduca";
				require_once "templates/formulario_compra.php";
				die();
			}

			if (isset($_POST["tarjeta_cvc"]) && gettype($_POST["tarjeta_cvc"]) === "string"
				&& strlen($_POST["tarjeta_cvc"]) === 3){
				$resultado .= "<p>CVC tarjeta: {$_POST["tarjeta_cvc"]}</p>\n";
			}
			else{
				$error = "tarjeta_cvc";
				require_once "templates/formulario_compra.php";
				die();
			}
		}
	}
	else{
		$error = "pago";
		require_once "templates/formulario_compra.php";
		die();
	}

	echo $resultado;
	db_nuevo_pedido(json_decode($_COOKIE["tienda"]), "{$_POST["nombre"]} {$_POST["apellidos"]}");
	setcookie("tienda", "", 123);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * Nos conectamos a la base de datos y seleccionamos todos los discos que hay en ella
 */
$conn = db_conectar();
$res = $conn->query("SELECT * FROM discos");
$haydiscos = false;
echo "
<h2 class='titulosh2'>Carrito de compras</h2>

<div class='estructura'>

	
</div>";
/**
 * Si la cookie de la tienda esta seteada, 
 * la decodificamos para obtener los valores que hay en ella
 */
if(isset($_COOKIE["tienda"]))
    $array = json_decode(stripslashes($_COOKIE["tienda"]), true);
/**
 * Si los datos de la cookie coinciden con algun disco activamos la variable hay discos
 */
if( $res !== FALSE && $res->num_rows > 0){
		
    while ($row = $res->fetch_assoc() ){
        $nombre = urlencode($row["Nombre"]);
        if(isset($array[$row["Nombre"]])){
            $haydiscos = true;
        } 
    }
}
/**
 * Si la variable hay discos esta activada mostramos todos los discos que el usuario
 * selecciono en la tienda, asi como la cantidad de estos, y el precio total
 */
 if($haydiscos){
    echo "  <div class='centrar'>
            <p class='correcto'> Estos son los productos que hay en su carro</p>";
    echo "<table border='2' align='center'>
	    <tr>
		    <th>Disco</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th>
	    </tr>
        ";
        $res = $conn->query("SELECT * FROM discos");
        $total = 0;
        if( $res !== FALSE && $res->num_rows > 0){
            
            while ($row = $res->fetch_assoc() ){
                
                $nombre = urlencode($row["Nombre"]);
                if(isset($array[$row["Nombre"]])){
                    
                    echo "<tr>";
                    echo "<td>".$row["Nombre"]." </td>";        
                    echo "<td>".$row["Precio"]." € </td>";
                    echo "<td>".$array[$row["Nombre"]]." </td>";
                    $sub = $array[$row["Nombre"]] * $row["Precio"];
                    echo "<td>$sub €</td>";  
                    $total += $sub;  
                } 
            }
        }
        echo "</table>
                <p class='centrar'> Total: $total € </p>
                <a href=tienda.php class='boton-carro'>Ir a la tienda</a><a href='".htmlspecialchars($_SERVER["PHP_SELF"])."?tramitar=true' class='boton-carro'>Tramitar pedido</a>
             </div>";



			/**
			 * Si el usuario decide tramitar el pedido le mostraremos el formulario de compra
			 */
             if (isset($_REQUEST['tramitar'])){
				
				/*Aqui entra con el boton*/
                
                
                    formPedido();
                }
            
             


/**
 * Si el usuario no ha seleccionado discos en la tienda, le ofrecemos la opcion de ir a la tienda 
 * con un enlace y ademas le mostramos un mensaje diciendole que no tiene discos en el carrito 
 */
}else{
    echo "  <div class='centrar'>
            <p class='error'>No hay discos en el carrito</p>
            <a href=tienda.php class='boton-carro'>Ir a la tienda</a>
            </div>";
}

 HTMLfin(); ?>