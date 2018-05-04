<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title id="titulo">Variables recibidas</title>
</head>
<body>
    <?php
        echo "<p>Variables GET: </p>";
        echo "<ul>";
        foreach ($_GET as $c => $v) //Hacemos un recorrido del "array" $_GET donde $c=claves y $v=valor de una clave 
        if (is_array($v)) {
            echo "<li>$c = ";
            print_r($v);
            echo "</li>";
        } 
        else
            echo "<li>$c = $v</li>";// Se que $c contiene los name y $v el contenido
            echo "</ul>";
            echo "<p>Variables POST: </p>";
            echo "<ul>";
            foreach ($_POST as $c => $v) 
            {
                if (is_array($v))  
                {
                    echo "<li>$c = ";
                    print_r($v);
                    echo "</li>";
            }
            else
                echo "<li>$c = $v</li>";
            }
        echo "</ul>";
    ?>
</body>
</html>