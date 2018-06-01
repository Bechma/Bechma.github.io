// $(document).ready(function()
// {   
//     var altura = $('.menu').offset().top; //guarda la altura  desde el inicio hasta el nav con la clase menu
//     alert(altura);  
     
//     $(windows).on('scroll',function()
//     {
//         if($(windows).scrollTop() > altura)
//         {
//             $('.menu').addClass('menu-fixed');
//         } 
//         else
//         {
//             $('.menu').removeClass('menu-fixed');
//         }
//     });
// });
//<script src="http://code.jquery.com/jquery-latest.js"></script>
//onload = function()
function nav() {//ejecuta la funcion al terminar de cargar todo el html
    window.onscroll = function() {myFunction()};

    var nav = document.getElementById("myNav");////guarda la altura  desde el inicio hasta el nav con la clase menu
    var sticky = nav.offsetTop;

    function myFunction() 
    {
        if (window.pageYOffset >= sticky) 
        {
            nav.classList.add("sticky");
        } else 
        {
            nav.classList.remove("sticky");
        }
    }
}

var nuevaCancion = (function () {
    id = 1;//al volver a llamar, no se inicializa a uno, es estatica
    return function() {
        var nuevoNodoTitulo = document.createElement("input");
        nuevoNodoTitulo.type = "text";
        nuevoNodoTitulo.name = "titulo" + id;
        var nuevoNodoDuracion = document.createElement("input");
        nuevoNodoDuracion.type = "text";
        nuevoNodoDuracion.name = "duracion" + id;
        var div = document.getElementById("inicioCancion");
        div.appendChild(nuevoNodoTitulo);
        div.appendChild(nuevoNodoDuracion);
        div.appendChild(document.createElement("br"));

        id++;
    }
})();

/* ARRAY DE IMAGENES */
ads = new Array(5);
ads[0] = "Imagenes/img10.jpg";
ads[1] = "Imagenes/img9.jpg";
ads[2] = "Imagenes/img11.jpg";
ads[3] = "Imagenes/img12.jpg";
ads[4] = "Imagenes/img13.jpg";

//variable para llevar la cuenta de las imagenes
var longuitudArray = ads.length;
var contador = 0;

// Cojemos un numero aleatorio
contador = Math.floor((Math.random() * longuitudArray))

// Cambia la imagen cada segundo en este ejemplo
var tiempo = 5;// En segundos
var timer = tiempo * 1000;

function banner() {
	contador++;
	contador = contador % longuitudArray
    document.banner.src = ads[contador];
	setTimeout("banner()", timer);
}

function lanzador()//y si tengo de otros script etc etc como soluciono el lanzarlas todas a la vez
{
    banner();
    nav();
}


 