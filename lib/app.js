var formulario = document.getElementById('info');

//Obtenemos los campos
formulario.addEventListener("submit", function(e){
    e.preventDefault();
    var datos = new FormData(formulario);

    fetch('http://www.leveleuro.cl/lanzamiento/lib/snd.php', {
        method:'POST',
        body:datos
    })

})    

