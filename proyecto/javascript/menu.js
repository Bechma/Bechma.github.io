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

onload = function() {//ejecuta la funcion al terminar de cargar todo el html
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
