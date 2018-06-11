<?php
//------------------------------------------------------------------------------------------------------
//  Esta página contendra información que es común a todas las paginas, como es el menu de navegacion
//  o el footer
//---------------------------------------------------------------------------------------------------
/**
 * Función que añade el inicio de HTML allí donde sea llamada
 */
function HTMLinicio($titulo)
{
	echo <<<HTML
<html lang="es">
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>$titulo</title>
    
    <script src="javascript/menu.js"></script>
    <link rel="icon" sizes="16x16" href="Imagenes/icono.jpg">
</head>
<body onload="lanzador()">
    <header>
     <img src="" id="banner" name="banner" alt="No se ha podido cargar la imagen">     
    </header>
    
        <nav  class="menuNav" id="myNav">
            <ul>
HTML;
        $items = ["Inicio", "Biografia", "Discografia", "Conciertos", "Tienda", "Buscar", "Carrito", "Login"];
        $links = ["index.php", "biografia.php", "discografia.php", "conciertos.php", "tienda.php", "buscar.php","carrito.php", "login.php"];
        foreach ($items as $k => $v)
            echo "<li><a" . ($v === $titulo ? " class='active'" : "") . " href='{$links[$k]}'>$v</a></li>";
        echo <<<HTML
        	</ul>
        </nav>
        <a href="documentacion.pdf">Link a la documentacion</a>
HTML;
}

//------------------------------------------------------------------------------------------------------
/**
 * Funcion que añade el final de fichero HTML alli donde sea llamada, este incluye enlaces a paginas sociales del
 * propio grupo
 */
function HTMLfin()
{
    echo <<<HTML
    </div>
<footer>
    <div id="foot">
        
        <div class="footIMG">
        <a href="https://www.instagram.com/acdc/"><img src="Imagenes/insta.png" alt="No se ha podido cargar la imagen"> </a>
        </div>
        <div class="footIMG">
        <a href="https://www.facebook.com/acdc/"><img src="Imagenes/facebook.png" alt="No se ha podido cargar la imagen"></a>     
        </div>
        <div class="footIMG">
        <a href="https://twitter.com/acdc"><img src="Imagenes/twitter.png" alt="No se ha podido cargar la imagen"></a> 
        </div>
        
    </div>
    <p> Copyright &copy; Todos los derechos reservados 2017-2018</p>
 
</footer>
</body>
</html>
HTML;
}
