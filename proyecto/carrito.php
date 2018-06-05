<?php
require_once "pag_comun.php";
require_once "templates/operaciones_db.php";
HTMLinicio("Carrito");
////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function formPedido(){
    echo "
	            <div align='center'>	
		            <div class='login'>
			            <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                            <fieldset>
                                <legend>Datos del comprador</legend>
                                <label>Nombre:</label>
                                <input type='text' name='nombre' value='" . (isset($_POST['nombre']) ? $_POST['nombre'] : '') ."'>
                                <br>
                                <label>Apellidos:</label>
                                <input type='text' name='apellidos' value='" . (isset($_POST['apellidos']) ? $_POST['apellidos'] : '') ."'>
                                <br>
                                <label>Telefono:</label>
                                <input type='text' name='telefono' value='" . (isset($_POST['telefono']) ? $_POST['telefono'] : '') ."'>
                                <br>
                                <label>Email:</label>
                                <input type='text' name='email' value='" . (isset($_POST['email']) ? $_POST['email'] : '') ."'>
                                <br>
                                <label>Dir. envio:</label>
                                <input type='text' name='dir' value='" . (isset($_POST['dir']) ? $_POST['dir'] : '') ."'>
                                <br>
                            </fieldset>
                                 <fieldset>
                                 <legend>Método de pago</legend>
                                 Modo de pago:<br>
                                 <input type='radio' name='tipopago' value='Tarjeta'> Mastercard <br>
                                 <input type='radio' name='tipopago' value='Reembolso'> Reembolso <br>
                                 <fieldset>
                                    <legend> Info tarjeta (solo rellenar si el metodo de pago es tarjeta) </legend>

                                    <span>Numero Tarjeta:</span><input type='text' name='numtar' value='" . (isset($_POST['numtar']) ? $_POST['numtar'] : '') ."'>
                                 <br>
                                 <span>Mes de caducidad:</span><input type='text' name='mescadu' value='" . (isset($_POST['mescadu']) ? $_POST['mescadu'] : '') ."'>
                                 <br>
                                 <span>Año de caducidad:</span><input type='text' name='añocadu' value='" . (isset($_POST['añocadu']) ? $_POST['añocadu'] : '') ."'>
                                 <br>
                                  <span>Cdodigo de seguridad:</span><input type='text' name='cvc' value='" . (isset($_POST['cvc']) ? $_POST['cvc'] : '') ."'>
                                 <br>
                                </fieldset>
                            </fieldset>
                            <input type='submit' name='submit' value='Finalizar pedido'>
                            <input type='hidden' name='enviar' value='enviar'>
				        </form>
			        </div>
		        </div>	
                ";
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////////////
$conn = db_conectar();
$res = $conn->query("SELECT * FROM discos");
$haydiscos = false;
echo "
<h2 class='titulosh2'>Carrito de compras</h2>

<div class='estructura'>

	
</div>";
if(isset($_COOKIE["tienda"]))
    $array = json_decode(stripslashes($_COOKIE["tienda"]), true);

if( $res !== FALSE && $res->num_rows > 0){
		
    while ($row = $res->fetch_assoc() ){
        $nombre = urlencode($row["Nombre"]);
        if(isset($array[$row["Nombre"]])){
            $haydiscos = true;
        } 
    }
}
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




             if (isset($_REQUEST['tramitar'])){
				
				/*Aqui entra con el boton*/
                
                
                    formPedido();
                }
            
             



}else{
    echo "  <div class='centrar'>
            <p class='error'>No hay discos en el carrito</p>
            <a href=tienda.php class='boton-carro'>Ir a la tienda</a>
            </div>";
}

 HTMLfin(); ?>