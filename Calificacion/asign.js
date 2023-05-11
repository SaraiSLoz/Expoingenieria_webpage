document.getElementById("asigaleatorio-btn").addEventListener("click", function(event){
    // Evita que el botón redirija a la página por defecto
    event.preventDefault();

    // Crea una solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "asigaleatorio.php");

    // Maneja la respuesta de la solicitud
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) { // 4 significa que la solicitud se completó y se recibió una respuesta
            if (xhr.status === 200) { // 200 significa que la solicitud se realizó correctamente
                // Maneja la respuesta aquí
                alert(xhr.responseText);
            } else {
                // Maneja los errores aquí
                alert('Hubo un error al procesar la solicitud.');
            }
        }
    };

    // Envía la solicitud AJAX
    xhr.send();
});
