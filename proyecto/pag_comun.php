<?php
require_once "templates/operaciones_db.php";
//------------------------------------------------------------------------------------------------------
function HTMLinicio($titulo)
{
	echo <<<HTML
<html lang="es">
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>$titulo</title>
    <link rel="icon" sizes="16x16" href="Imagenes/icono.jpg">
</head>
<body>
    <header>
     <img src="Imagenes/img10.jpg" alt="No se ha podido cargar la imagen">     
    </header>

	<nav>
        <ul>
HTML;
	$items = ["Inicio", "Biografia", "Discografia", "Conciertos", "Tienda", "Login"];
	$links = ["index.php", "biografia.php", "discografia.php", "conciertos.php", "tienda.php", "login.php"];
	foreach ($items as $k => $v)
		echo "<li><a" . ($v === $titulo ? " class='active'" : "") . " href='{$links[$k]}'>$v</a></li>";
	echo <<<HTML
     </ul>
    </nav>
HTML;
}

//------------------------------------------------------------------------------------------------------
function HTMLfin()
{
	echo <<<HTML
<footer>
    <p> Copyright &copy; Todos los derechos reservados 2017-2018</p>
</footer>
</body>
</html>
HTML;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
//--------------------------------------------TIENDA------------------------------------------------

function HTMLpag_tienda()
{
	echo <<<HTML
    <h2 class="titulosh2"> Tienda</h2>
    <!-- EN VEZ DE PONER php/p2/procesar.php  [que seria la ruta de (/~maiki/P2/.....)]
            Debo poner la que referencia a /var/www/html/
            PK me da un error -->
    <form action="php/procesarP2.php" method="POST" enctype="multipart/form-data" id="form">
        
        <main class="main">
                <h1 class="h1Tienda">Seleccione el disco a comprar</h1>
                <div class="flexpadre">
                    <div class="tiendaIZQ">
                        <input type="checkbox" name="disco">
                        <label>Highway to Hell</label><br>
                        <input type="checkbox" name="disco">
                        <label>Back in Black</label><br>
                        <input type="checkbox" name="disco">
                        <label>Stiff Upper Lip</label><br>
                        <input type="checkbox" name="disco">
                        <label>Black ice </label> <br>
                    </div>
                    <div class="tiendaDRCH">
                        <input type="checkbox" name="disco">For Those About to Rock We Salute You<br>
                        <input type="checkbox" name="disco">´74 Jailbreak<br>
                        <input type="checkbox" name="disco">Rock or Bust<br>
                        <input type="checkbox" name="disco">Ballbreaker<br>
                    </div>
                </div>
                <h1 class="h1Tienda">Introduzca Dados Personales</h1>
                <div class="flexpadre"> 
                        <div class="tiendaIZQ">
                                Nombre:<br><input type="text" name="nombre"><br><br>
                                Apellidos:<br> <input type="text" name="ape" size="60">
                        </div>
                        <div class="tiendaDRCH">
                                Telefono:<br><input type="tel" name="telf"><br><br>
                                Edad:<br><input type="number" name="edad">
                        </div> 
                </div>    
                    <h1 class="h1Tienda">Tipo De Pago</h1>
                <div class="flexpadre">
                            <div class="tiendaIZQ">
                            <label>Seleccione Targeta</label>
                                <select name="pago">
                                        <option>Visa</option>
                                        <option>Mastercard</option>
                                </select>
                            </div>
                            <div class="tiendaDRCH">
                            <label> Numero de la Targeta:</label>
                                <input type="number" name="targeta">
                            </div>
                </div>
                
                    <h1 class="h1Tienda">Direccion de Envio</h1>
                <div class="flexpadre">   
                    
                            <div class="tiendaIZQ">
                                <label>Calle:</label><br>
                                <input type="text" name="calle"><br>
                                <label>Poblacion:</label><br>
                                <input type="text" name="poblacion"><br>
                                <label> Codigo:</label><br>
                                <input type="text" name="codigo"> 
                            </div>
                        
                            <div class="tiendaDRCH">
                                <br>Comentario:<br>
                                <textarea name="area" cols="50" rows="10"></textarea>
                            </div>
                </div>
                            <div class="botones">
                                    <input class="bot" type="submit" value="Enviar Dados">
                                    <input class="bot" type="reset" value="Limpiar Dados">
                            </div>
                    
        </main>    
    </form> 
HTML;
}
////////////////////////////////////////////////////////////////////////////////////////////////////
//--------------------------------------------CONCIERTOS--------------------------------------------

function HTMLpag_conciertos(){
    echo <<<HTML
    <h2 class="titulosh2"> Conciertos </h2>
HTML;


    $conn = db_conectar();
    if ($conn->connect_error) {
        die('No se ha podido conectar: ' . $con->connect_error);
    }
    $sql = "select count(fecha) from conciertos";
    $result = $conn->query($sql);
    $row=$result->fetch_array(MYSQLI_NUM);
    $nRows=$row[0];
    $pageSize=600;
    if(isset($_GET['pageSize'])){
        $pageSize=$_GET['pageSize'];
    }
    $page=0;
    if(isset($_GET['page'])){
        $page=$_GET['page'];
    }
    $pos=$page*$pageSize;
    $pos=($pos>$nRows)?$nRows:$pos;
    $sql = "SELECT * FROM conciertos order by fecha";
    $result = $conn->query($sql);
if ($result->num_rows > 0) {
?>
    
    <table border='2'>
        <tr>
	<th>Fecha</th><th>Hora</th><th>Lugar</th><th>Descripcion</th>
        </tr>

<?php
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["Fecha"]."</td> ";
        echo "<td>".$row["Hora"]."</td> ";
        echo "<td>".$row["Lugar"]."</td> ";
        echo "<td>".$row["Descripcion"]."</td> ";
        echo "</tr>\n";
    }
?>
  	</tr>
     </table>
<?php
    } else {
	echo "No hay conciertos que mostrar";
    }
    $conn->close();
}
?>


