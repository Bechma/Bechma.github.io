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
	$links = ["index.php", "biografia.php", "pag_discografia.php", "conciertos.php", "tienda.php", "login.php"];
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
//--------------------------------------------DISCOGRAFIA------------------------------------------------
function HTMLpag_discografia()
{
	echo <<<HTML
    <h2 class="titulosh2"> Discografia</h2>
       
        <div class="estructura">
        <!-- COLUMNA DE LA IZQUIERDA-->
            <aside class="columIZQ2">
                <h2>Back In Black</h2>
                <div class="img">
                        <img width="50%" src="Imagenes/back.png" alt="No se ha podido cargar imagen" >
                </div>
                <table border="2">
                    <thead align="center" >
                        <tr>
                            <td colspan="3" align="center">Lista de canciones</td>
                        </tr>    
                    </thead>
                    
                    <tr align="right"> 
                            <td colspan="3"> Cara A </td>
                    </tr>
                    <tr align="center" class="titulo">
                        
                        <th>Nº</th>
                        <th>Titulo</th>
                        <th>Duracion</th>
                        
                    </tr>
                    <tbody align="center">
                        <tr>
                            <th>1</th>
                            <th>Hells Bells </th>
                            <th>5:13</th>
                        </tr>
                        <tr>
                            <th>2</th>
                            <th>Shoot to Thrill</th>
                            <th>5:20</th>
                        </tr>
                        <tr>
                            <th>3</th>
                            <th>What Do You Do for Money Honey</th>
                            <th>3:36</th>
                        </tr>
                        <tr>
                            <th>4</th>
                            <th>Given The Dog a Bone</th>
                            <th>3:32</th>
                        </tr>
                        <tr>
                            <th>5</th>
                            <th>Let Me Put my Love Into You</th>
                            <th>4:16</th>
                        </tr> 
                    </tbody>
                    
                    <tr  align="left">
                        <td colspan="3" align="right">Cara B</td>
                    </tr>
                    <tr align="left" class="titulo">
                            
                            <th>Nº</th>
                            <th>Titulo</th>
                            <th>Duracion</th>
                            
                    </tr>
                    <tr>
                        <th>6</th>
                        <th>Back In Black</th>
                        <th>4:16</th>
                    </tr>
                    <tr>
                        <th>7</th>
                        <th>You Shook Me All Night Long</th>
                        <th>5:20</th>
                    </tr>
                    <tr>
                        <th>8</th>
                        <th>Have a Drink on Me</th>
                        <th>4:00</th>
                    </tr>
                    <tr>
                        <th>9</th>
                        <th>Shake a Leg</th>
                        <th>4:06</th>
                    </tr>
                    <tr>
                        <th>10</th>
                        <th>Rock 'n' Roll Ain't Noise Pollution</th>
                        <th>4:16</th>
                    </tr> 
        
                </table>
            </aside>
            <div class="DHparrafos">
                    <p>
                            Back in Black es el séptimo álbum de estudio de la banda australiana de hard rock AC/DC, 
                            lanzado en 1980. Fue grabado en Bahamas y, por segunda vez, producido por Robert "Mutt" Lange, 
                            siendo Highway to Hell la primera ocasión.
                            En este disco figura por primera vez como vocalista Brian Johnson, quien sustituyó a Bon Scott 
                            tras su trágica muerte. Las ventas internacionales del disco ascienden a más de 50 millones de 
                            copias,11​ Lo que lo convierte en el segundo más vendido de la historia de la música tras 
                            Thriller de Michael Jackson a pesar de nunca haber llegado al número 1 del Billboard 200. 
                            El álbum está dedicado a Bon Scott, la portada del disco (el logo de AC/DC sobre un fondo negro) 
                            es un claro homenaje al cantante fallecido.
                    </p>
                </div>
            <!-- COLUMNA DE LA DERECHA-->
            <aside class="columDRCH2"> <!-- Incorporar en cada parrafo una mini imagen de cada albun-->
                <h3>AC/DC ALBUNS</h3>
                <ul>
                    <li><a href="pag_discografia.php">Back In Black</a></li>
                    <li><a href="pag_highway.php">Highway To Hell</a> </li>
                </ul>
           
            </aside>
        </div>
HTML;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
//--------------------------------------------HIGHWAY------------------------------------------------
function HTMLpag_highway()
{
	echo <<<HTML

    <h2 class="titulosh2">Discografia</h2>
   
    <div class="estructura">
        <!-- COLUMNA DE LA IZQUIERDA-->
        <aside class="columIZQ2">
            <h2>Highway to Hell</h2>
            <div class="img">
                    <img width="50%" src="Imagenes/highway.jpg" alt="No se ha podido cargar imagen">
            </div>
            <table border="2">
                <thead align="center" >
                    <tr>
                        <td colspan="3" align="center">Lista de canciones </td>
                    </tr>    
                </thead>
                
                <tr align="right"> 
                        <td colspan="3" align="right" > Cara A </td>
                </tr>
                <tr align="center" class="titulo">
                    
                    <th>Nº</th>
                    <th>Titulo</th>
                    <th>Duracion</th>
                    
                </tr>
                <tbody align="center">
                    <tr>
                        <th>1</th>
                        <th>Highway to Hell</th>
                        <th>3:30</th>
                    </tr>
                    <tr>
                        <th>2</th>
                        <th>Girls Got Rhythm</th>
                        <th>5:20</th>
                    </tr>
                    <tr>
                        <th>3</th>
                        <th>Walk All Over You</th>
                        <th>3:36</th>
                    </tr>
                    <tr>
                        <th>4</th>
                        <th>Touch Too Much</th>
                        <th>3:32</th>
                    </tr>
                    <tr>
                        <th>5</th>
                        <th>Beating Around the Bush</th>
                        <th>4:16</th>
                    </tr> 
                </tbody>
                
                <tr  align="left">
                    <td colspan="3" align="right" >Cara B</td>
                </tr>
                <tr align="center" class="titulo">
                        
                        <th>Nº</th>
                        <th>Titulo</th>
                        <th>Duracion</th>
                        
                </tr>
                <tr>
                    <th>6</th>
                    <th>Shot Down in Flames</th>
                    <th>3:25</th>
                </tr>
                <tr>
                    <th>7</th>
                    <th>Get It Hot</th>
                    <th>2:37</th>
                </tr>
                <tr>
                    <th>8</th>
                    <th>If You Want Blood (You've Got It)</th>
                    <th>4:40</th>
                </tr>
                <tr>
                    <th>9</th>
                    <th>Love Hungry Man</th>
                    <th>4:20</th>
                </tr>
                <tr>
                    <th>10</th>
                    <th>Night Prowler</th>
                    <th>6:17</th>
                </tr> 
                
            </table>
        </aside>
        <div class="DHparrafos">
                <p>
                    Highway to Hell (Autopista al infierno), es el sexto álbum de estudio de la banda de hard rock 
                    australiana AC/DC que salió a la venta en 1979. También es el quinto álbum de estudio internacional 
                    de la banda y todas sus canciones fueron escritas por Angus Young, Malcolm Young, y Bon Scott, entre 
                    las que se destacan "Highway to Hell", "Touch Too Much", "Walk All Over You", "Shot Down in Flames", 
                    "If You Want Blood (You've Got It)" y el oscuro blues "Night Prowler".
                    Se consideró el álbum más popular de la banda hasta el momento, y ayudó a incrementar la popularidad de 
                    ésta considerablemente, posicionándola para el éxito de su álbum Back In Black el año siguiente. 
                    Fue el último álbum grabado con el vocalista Bon Scott antes de que este muriese en febrero de 1980.
                    Highway To Hell fue el primer álbum de AC/DC que no fue producido por Harry Vanda y George Young.
                    En Australia, salió a la venta con una cubierta ligeramente diferente. A diferencia de la internacional, 
                    tenía llamas en la guitarra. En Alemania del Este se cambiaron los diseños de las carátulas.
                </p>
            </div>
        <!-- COLUMNA DE LA DERECHA-->
        <aside class="columDRCH2"> <!-- Incorporar en cada parrafo una mini imagen de cada albun-->
            <h3>AC/DC ALBUNS</h3>
            <ul>
              <li><a href="pag_discografia.php">Back In Black</a></li>
              <li><a href="pag_highway.php">Highway To Hell</a> </li>
            </ul>
        </aside>
    </div>
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


