<?php
session_start();

if (isset($_SESSION["playlistfilename"])) {
    $json = $_SESSION["playlistfilename"]; //se busca si hay una sesion con el nombre del archivo json

}

if (isset($_SESSION["url"])) {
    $url = $_SESSION["url"];}  //escojemos la url actual

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el índice de la canción a eliminar desde el formulario
    $index = $_POST["cancion"];         //recibimos el index de la cancion js


    $playlistData = json_decode(file_get_contents($json), true);        //metemos el json en una variable

    if (isset($playlistData['songs'][$index])) {
        unset($playlistData['songs'][$index]);                              //si encuentra la cancion en el archivo la elimina
    }

    $playlistData['songs'] = array_values($playlistData['songs']);             // reorganiza el array 

    $jsonContent = json_encode($playlistData, JSON_PRETTY_PRINT);       //se vuelve a adaptar a json

    file_put_contents($json, $jsonContent);                             // se guarda el archivo 

    // Redirigir al usuario de vuelta a la página principal 
    header("Location: $url");
    exit();
}
?>
