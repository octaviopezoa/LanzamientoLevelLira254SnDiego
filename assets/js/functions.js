$(document).ready(function() {
  console.log("live!"); 

  window.onscroll = function() {
    console.log("Vertical: " + window.scrollY);
    console.log("Horizontal: " + window.scrollX);
  
  };

 console.log(window.onscroll );


  // oculto boton formulario
  $('#f-close').hide();


  // cargo formulario con boton formulario
  $("#f-close").click(function() {
      $("#f-open").fadeIn('slow');
      $("#f-close").fadeOut('slow');
  });



  // valido si es mobile o desktop
  var userAgent = navigator.userAgent || navigator.vendor || window.opera;

  if (/android/i.test(userAgent) || /iPad|iPhone|iPod/.test(userAgent)) {

    // mobile
    $("#tituloP").removeClass('ajuste');
    $("#tituloP").addClass('movil');    
    $("#f-close").addClass('is-fixed-bottom');
    $("#mostrar").addClass('navbar-start--centered');
    $("#mostrar").removeClass('plt40');
    $("#mostrar").removeClass('izq');


    $(function(){
      $(window).scroll(function(){        

        // ocultar/mostrar form y boton
        if ($(window).scrollTop() > 350 && $(window).scrollTop() < 245 || $(window).scrollTop() > 1700)
        {
            $("#f-open").fadeOut('slow');
            $("#f-close").fadeIn('slow');
        }
        else
        { 
          if ($(window).scrollTop() < 350)
            $("#f-open").fadeIn('slow');
            $("#f-close").fadeOut('slow');
        };

        });
      });
  } 
  else
  {
    // desktop
    $(function(){
      $(window).scroll(function(){

        // ocultar/mostrar form y boton
        if ($(window).scrollTop() > 30 && $(window).scrollTop() < 445 || $(window).scrollTop() > 1300)
        {
            $("#f-open").fadeOut('slow');
            $("#f-close").fadeIn('slow');
        }
        else
        { 
          if ($(window).scrollTop() < 30)
            $("#f-open").fadeIn('slow');
            $("#f-close").fadeOut('slow');
        };

        });
      });
  }  

  $("#cotiza-lira").click(function() {
    $('#proyecto').val('Lira 254');
  });

  $("#cotiza-sandiego").click(function() {
    $('#proyecto').val('San Diego');
  });


});