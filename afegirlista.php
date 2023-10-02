<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['nombre'])) {
        $name = $_POST['nombre'];

// Patrón para archivos JSON
$patron = "*.json";

// Obtener la lista de archivos JSON en el directorio actual
$archivosJson = glob($patron);

// Contar la cantidad de archivos JSON encontrados
$cantidadJson = count($archivosJson);

// Concatenar "llista" con la cantidad de archivos JSON
$nombreArchivo = "llista" . $cantidadJson . ".json";

// Crear un array con la estructura del JSON
$data = array(
    "name" => $name,
    "songs" => array()
);

// Convertir el array a formato JSON
$json_data = json_encode($data, JSON_PRETTY_PRINT);

// Escribir el JSON en un archivo con el nombre concatenado en el directorio actual
file_put_contents($nombreArchivo, $json_data);
header("Location: index.php");
    exit();
    }
}
?>

