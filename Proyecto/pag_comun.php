
<?PHP
//------------------------------------------------------------------------------------------------------
function HTMLinicio($titulo)
{
    echo <<<HTML
<html lang="es">
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>$titulo</title>
    <link rel="icon" sizes="16x16" href="Imagenes/icono.jpg">
</head>
<body>
    <header>
     <img src="Imagenes/img10.jpg" alt="No se ha podido cargar la imagen">     
    </header>
HTML;
}
//------------------------------------------------------------------------------------------------------
function HTMLfin()
{
    echo <<<HTML
</body>
</html>
HTML;
}
//------------------------------------------------------------------------------------------------------
function HTMLfooter()
{
    echo <<<HTML
<footer>
    <p> Copyright &copy; Todos los derechos reservados 2017-2018</p>
</footer>
HTML;
}
//------------------------------------------------------------------------------------------------------
function HTMLnav($activo)
{
    echo <<<HTML
    <nav>
        <ul>
HTML;
    $items= ["Inicio","Bibliografia","Discografia","Tienda"];
    $links=["pag_inicio.php","pag_bibliografia.php","pag_discografia.php","pag_tienda.php"];
    foreach($items as $k => $v)
        echo "<li><a".($k==$activo?" class='active'":"")." href='".$links[$k]."'>".$v."</a></li>";
    echo <<<HTML
     </ul>
    </nav>
HTML;
}
//------------------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////////
//--------------------------------------------INDEX------------------------------------------------
function HTMLpag_index()
{
    echo <<<HTML
    <div class="estructura">

        <aside class="columIZQ">
            
                <p>
                AC/DC es un grupo de hard rock australiano formado en 1973 en Sídney, Australia, 
                por los hermanos de origen escocés Malcolm y Angus Young.2​3​
                Sus álbumes se han vendido en numerosos países, en un total estimado de 200 millones 
                de copias,4​5​ embarcándose en giras multitudinarias por todo el mundo, y sus éxitos han
                musicalizado varias producciones cinematográficas sobresalientes.6​7​8​9​ Son famosas sus
                actuaciones en vivo, resultando vibrantes y exultantes espectáculos de primer orden.
                10​ Mucho de ello se debe al extravagante estilo de su guitarrista principal y símbolo
                visual, Angus Young, quien asume el rol de agitador musical durante los conciertos, 
                gracias a sus dinámicos y adrenalínicos despliegues escénicos uniformado de colegial
                callejero.11​ Al comienzo, los circuitos de pubs australianos fueron testigo de los 
                primeros meses de vida del proyecto, tiempos por los cuales sufrieron diversos cambios 
                en su alineación.12​13​ En 1974, la llegada del cantante Bon Scott, se convertiría en
                pieza clave del éxito del grupo. Su presencia en escena, junto a los hermanos Young, 
                lo convirtió en uno de los personajes más carismáticos de la historia del rock.
                La formación se estabilizaría con Mark Evans (bajo) y Phil Rudd (batería)
                </p>
            
            <section>
                <h2>Miembros del grupo</h2>
                <ul>    
                    <li>Dave Evans - primer vocalista (1973-1974).</li>
                    <li>Bon Scott - segundo vocalista (1974-1980). (fallecido en 1980)</li>
                    <li>Brian Johnson - tercer vocalista (1980-2016)</li>
                    <li>Cliff Williams: bajo eléctrico, coros (1977-2016)</li>
                    <li>Malcolm Young - Guitarra rítmica, Coros (1973-2014). (fallecido en 2017)</li>
                    <li>Mark Evans - Bajo eléctrico (1975-1977).</li>
                    <li>Simon Wright - Batería, Percusión (1983-1989).</li>
                    <li>Phil Rudd - Batería, Percusión (1975-1983, 1994-2014)</li>
                    <li>George Young - Bajo eléctrico (1974 - 1975) (fallecido en 2017).</li>

                </ul>
            </section>
            <section>
                <h2>Singles mas exitosos</h2>
                <ol>
                    <li>Back in Black 4:16 </li>
                    <li>You Shook Me All Night Long	3:31</li>
                    <li>Highway to hell 3:30</li>
                    <li>Walk All Over You»	5:12</li>
                    <li>Stiff Upper Lip 3:34</li>
                    <li>Hells Bells»	5:13</li>
                    <li>Shoot to Thrill 5:20</li>

                </ol>
            </section>
        </aside>
        <aside class="columDRCH">
            <h2>Actualidad</h2>
            <article>
                <h3>
                    Muere Malcolm Young, fundador y guitarrista de AC/DC
                </h3>
                <div class="img">
                        <img src="Imagenes/malcolm.jpg" alt="Imagen No ha cargado" width="60%">
                </div>
                
                <p>
                    El artista, nacido en Escocia pero que vivió desde niño en Australia, 
                    estaba retirado desde 2014 a causa de la demencia. Junto a su hermano Angus
                    era una de las caras más conocidas de la historia del rock. "Como hermano es difícil 
                    expresar con palabras lo que ha significado para mí en mi vida,
                    el vínculo que teníamos era único y muy especial", dijo Angus.
                </p>
            </article>
            <article>
                <h2> Tours</h2>
                <div class="img">
                    <img src="Imagenes/tour.jpg" alt="Imagen No ha cargado" width="50%">
                </div>
                
                    <h3>Rock or Bust</h3>
                <p>
                    Lanzado el 2 de diciembre de 2014, Rock or Bust es el primer disco lanzado desde Black Ice en 2008.
                    Rock or Bust es el primer álbum de la banda sin el miembro fundador y guitarrista Malcolm Young, quien
                    dejó la banda en 2014 por motivos de salud. La salida de Malcolm se aclaró por la banda y su gestión, 
                    diciendo que Malcolm fue oficialmente diagnosticado con demencia y posiblemente nunca volverá a tocar.
                    Antes de que el álbum fuera anunciado oficialmente, Brian Johnson admitió que era difícil hacer el álbum 
                    sin Malcolm Young. Él trajo consigo la idea de que el álbum podría llamarse Man Down, pero creyeron que el 
                    título era demasiado negativo hacia la situación de Malcolm y la salud en general.
                </p>


            </article>
            
        </aside>
        
    </div>
HTML;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
//--------------------------------------------BIBLIOGRAFIA------------------------------------------------
function HTMLpag_bibliografia()
{
    echo <<<HTML
    <h2 class="titulosh2">Bibliografia</h2>
    <div class="img">
        <img src="Imagenes/img2.jpg" alt="imagen no cargada">
    </div>
    <div class="estructura">
        
        <div class="parrafoBiblio">
        <p>
            El grupo australiano AC/DC se formó en (Australia) en 1973, gracias a dos hermanos escoceses,
            Malcolm y Angus Young. El nombre del grupo, con connotaciones eléctricas, son las iniciales en 
            inglés de Corriente alterna/ Corriente continua. Cuando el grupo se formó Angus apenas tenía 15 años, 
            por lo que alguien le sugirió que se subiera al escenario vestido con el uniforme colegial.
            A partir de ese momento, aquella fue la enseña de la banda. 
       
        </p>
        <p>
            En 1974 los hermanos Young se trasladan a Melbourne, donde se unen al batería Phil Rudd 
            y al bajista Mark Evans. Como cantante se les unió Bon Scott, quien ya había participado 
            anteriormente en algunas bandas de pop. Además, Scott aportó a la banda un estilo agresivo de chicos 
            inadaptados que les acompañó a lo largo de su carrera. De esta forma, con la banda ya formada, realizan 
            una gira por Australia, comenzando a trabajar en lo que sería su primer álbum.  
        </p>
        <p>
            En 1975 aparecen en Australia los dos primeros álbumes de AC/DC, titulados "High voltage" y "T.N.T".
            Un año más tarde firman contrato con la discográfica Atlantic Records, quienes editan "High voltage" 
            para el Reino Unido, un nuevo álbum que mezcla temas de sus dos trabajos en Australia. Ese mismo año 
            publican su primer trabajo propiamente británico, "Dirty deeds done dirt cheap". 
        </p> 
        <p>
            En 1977 Evans abandona la banda y es sustituído por Cliff Williams, con quien comienzan publicando el álbum 
            "Let there be rock", que se aupó al número uno de las listas americanas. Parte del éxito se lo deben a sus 
            espectaculares conciertos en directo y a la energía que derrochan sobre el escenario.
            En 1978 aparece publicado "Powerage", que precedió al primer gran éxito de la banda, "Highway to hell", 
            un álbum con ventas millonarias y que entró en los primeros puestos de todas las listas, consiguiendo numerosos
            discos de oro. Poco después del éxito de "Highway to hell", el cantante de la banda, Bon Scott apareció muerto 
            en Londres. AC/DC tuvo que recomponerse, uniéndose a la banda Brian Johnson en el lugar ocupado anteriormente 
            por Scott.
        </p>
        <p>
            El siguiente trabajo de AC/DC fue "Back in black", en 1980, que llegó a ser número uno en Inglaterra y Estados Unidos, 
            vendiendo más de 10 millones de copias solamente en el país norteamericano. Se calcula que hasta la fecha se han 
            vendido 44 millones del copias del álbum, lo que le colocaría como uno de los más vendidos de la historia. 
            A partir de este momento, los trabajos anteriores de AC/DC comenzaron a venderse como rosquillas, lo que llevó a la 
            banda a aprovechar el tirón en su siguiente disco.
        </p>
        <p>
            En 1981 aparece "For those about to rock", con el que nuevamente conquistaron el mercado americano. 
            Un año después, el batería Phil Rudd abandona la banda y es sustituído por Simon Wright.
            En 1983 se publica "Flick of the switch", con el que AC/DC comienza una etapa menos brillante en su historia. 
            Los siguientes trabajos de la banda siguen con la línea descendente de ventas: "Fly on the wall" y el recopilatorio 
            "Who made who" pertenecen a esta época del grupo.
        </p>  
        <p>
            En 1987 publican "Blow up your video", con el que se lanzaron a una gira en la que Malcom fue sustituído temporalmente 
            por su primo Steve. tras la gira, Wright abandonó el grupo, siendo sustituído por Chris Slade, con amplia experiencia 
            en diversos grupos.
        </p> 
        <p>
            En 1990 aparece un nuevo álbum de AC/DC, titulado "The razors edge", con el que llegan al número dos en las listas 
            americanas, estando situados en listas durante más de un año consecutivo. En 1992 publican un disco en directo,
             "AC/DC Live".
        <p>    
            El siguiente trabajo de la banda aparece en 1995, bajo el título de "Ballbreaker", de nuevo con Phil Rudd 
            incorporado al grupo. El disco fue un enorme éxito, vendiendo varios millones de copias y estando en puestos 
            preferentes en las listas de Estados Unidos.
        </p>  
        <p>  
            En 1997 publican una caja con cinco CD's, como homenaje al fallecido Bon Scott. 
            En el año 2000 publican el álbum "Stiff upper lip", grabado en el estudio de Bryan Adams en Canadá. 
            Para promocionar este disco realizaron una gira por innumerables países, entre ellos España. 
            Precisamente, los hermanos Young estuvieron en la localidad madrileña de Leganés, para inaugurar 
            una calle que lleva su nombre. Se da la circunstancia de que la placa que lleva el nombre de la calle 
            fue robada el mismo día de la inauguración.
        </p>
        <p>
            En Octubre de 2008, rompiendo un silencio de 8 años, AC/DC regresa a los estudios de grabación para 
            publicar un nuevo trabajo, titulado "Black ice". El álbum contiene 15 nuevas canciones, entre las que 
            destaca su primer single 'Rock 'n' Roll train'. 
            Finalmente el 2014 publiclan su ultimo algun ROCK OR BUST.
        </p>  
    </div>
        
    </div>
    <aside class="derecho">
        <ul>
            <li>1975 T.N.T.</li>
            <li>1975 High Voltage [Australia]</li>
            <li>1976 Dirty Deeds Done Dirt Cheap</li>
            <li>1976 High Voltage</li>
            <li>1977 Let There Be Rock</li>
            <li>1978 If You Want Blood You've Got It</li>
            <li>1978 Powerage</li>
            <li>1979 Highway to Hell</li>
            <li>1980 Back in Black</li>
            <li>1981 For Those About to Rock We Salute You</li>
            <li>1983 Flick of the Switch</li>
            <li>1984 ´74 Jailbreak</li>
            <li>1985 Fly on the Wall</li>
            <li>1986 Who Made Who</li>
            <li>1988 Blow up Your Video</li>
            <li>1990 The Razor's Edge</li>
            <li>1992 Live</li>
            <li>1995 Ballbreaker</li>
            <li>1997 Let There Be Rock: The Movie - Live in Paris</li>
            <li>2000 Stiff Upper Lip</li>
            <li>2008 Black ice</li>
            <li>2014 Rock or Bust</li>
        </ul>
    </aside>
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
                                Apellidos:<br> <input type="text" name="ape"size="60">
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
?>
