<?php
session_start(); 
if (isset($_SESSION["playlistfilename"])) {
    $json = $_SESSION["playlistfilename"];
    if (file_exists($json)) {
        // Intentar borrar el archivo
        if (unlink($json)) {
            header("Location: index.php");
        }
    } 
}else{
    
        header("Location: nomsessio.php"); //si no lo essta redirecciona al formulario para añadir el nomnbre
        exit();
    
}

// Verificar si el archivo existe antes de intentar eliminarlo

?>
//comentario de prueba