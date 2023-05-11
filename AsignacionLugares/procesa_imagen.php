<?php
// Verificar si se envió el formulario
if (isset($_POST['submit'])) {
    // Carpeta donde se guardarán las imágenes
    $target_dir = "uploads/";

    // Obtener el nombre del archivo y la ruta de destino
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);

    // Verificar si el archivo es una imagen
    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if($check !== false) {
        // Mover la imagen a la carpeta de uploads
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file);
        echo "La imagen se cargó correctamente.";

        // Mostrar la imagen en la página del usuario
        echo "<img src='$target_file' alt='Imagen del usuario'>";
    } else {
        echo "El archivo no es una imagen.";
    }
}
