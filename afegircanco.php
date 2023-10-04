<?php
session_start(); 
if (isset($_SESSION["playlistfilename"])) {
    $json = $_SESSION["playlistfilename"];   // se mete el archivo en una variable 
}else{
    
        header("Location: nomsessio.php"); //si no lo essta redirecciona al formulario para añadir el nomnbre
        exit();
    
}
                // añadimos los datos de el cuestionario en las variables
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];                   
    $artist = $_POST["artist"];
    $audioFile = $_FILES["audio"];
    $coverImageFile = $_FILES["coverImage"];

    // Guardar archivos en el servidor (asegúrate de configurar los permisos adecuados en el directorio)
    $audioFilePath = "./src/" . basename($audioFile["name"]);
    $coverImagePath = "./img/" . basename($coverImageFile["name"]);

    move_uploaded_file($audioFile["tmp_name"], $audioFilePath);
    move_uploaded_file($coverImageFile["tmp_name"], $coverImagePath);


        // Crear un array con los datos de la nueva canción
    
        $newSong = [
        "title" => $title,
        "artist" => $artist,
        "url" => $audioFilePath,
        "cover" => $coverImagePath
    ];

    // Leer la lista de reproducción existente desde el archivo JSON
    $playlistData = json_decode(file_get_contents($json), true);

    // Añadir la nueva canción al array de canciones de la lista de reproducción
    $playlistData['songs'][] = $newSong;

    // Convertir el array actualizado a formato JSON
    $jsonContent = json_encode($playlistData, JSON_PRETTY_PRINT);

    // Guardar el JSON actualizado en el archivo de la lista de reproducción
    file_put_contents($json, $jsonContent);
    
    
    
    // Redirigir al usuario a la página de la lista de reproducción u otra página de tu elección
    header("Location: index.php");
    exit();
}
?>
