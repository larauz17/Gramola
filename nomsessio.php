<?php
session_start(); // Iniciar la sesión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el nombre del formulario
    $nombre = $_POST["nombre"];

    // Guardar el nombre en la sesión
    $_SESSION["nombre"] = $nombre;

    // Redirigir a otra página o mostrar un mensaje de éxito
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Sesión</title>
    <link rel="stylesheet" type="text/css" href="./forn.css">
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="nombre">Como te llamas?</label>
        <input type="text" id="nombre" name="nombre" required>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
