<?php
$playlists = [];

foreach (glob("*.json") as $file) {
    $playlistData = json_decode(file_get_contents($file), true);
    if ($playlistData) {
        $playlists[] = $playlistData;
    }
}
?>
<?php
session_start(); // Iniciar la sesión

// Verificar si la variable de sesión "nombre" está definida
if (isset($_SESSION["nombre"])) {
    $nombre = $_SESSION["nombre"];
} else {
    header("Location: nomsessio.php"); //si no lo essta redirecciona al formulario para añadir el nomnbre
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8"/>
    <title>La Gramola-Luis Arauz</title>
    <link rel="shortcut icon" href="./img/gramolaico.jpg">
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>

    <div class="container">
        <div class="Nav">
        <?php
    // Comprobar si la session 'nombre' está establecida
    if (isset($_SESSION['nombre'])) {
        echo '<p>Hola, ' . htmlspecialchars($nombre) . '</p>';
    }
    ?>
        <ul id="playlist-list">
        <ul id="playlist-list">
    
</ul>
<?php
foreach ($playlists as $index => $playlist) {
    echo '<li><a href="index.php?playlist_id=' . $index . '">' . $playlist['name'] . '</a></li>';
}
?>

        </ul>
        <ul id=><form action="afegirlista.php" method="post" id="addlistaform">
    <button type="button" id="afegirlista">Añadir Lista</button>
    <input type="hidden" name="nombre" id="nomllista">
    <button type="submit" style="display: none;">Enviar</button>
</form>

        </ul>

        </div>
    <div class="Body">
            
    <?php
if(isset($_GET['playlist_id'])) {
    $playlistId = $_GET['playlist_id'];
    if(isset($playlistId) && isset($playlists[$playlistId])) {
        $selectedPlaylist = $playlists[$playlistId];
        $playlistFileName = glob("*.json")[$playlistId]; //asi podemos saber a que archivo corresponde el id
        $_SESSION["playlistfilename"] = $playlistFileName;
        // Ahora $selectedPlaylist contiene el array asociado a la lista de reproducción seleccionada.
    }}
?>


        <div class="Art-Box">
            <div id="playlist-act">
                <ul id="song-list">
                </ul>
                <li id="borrar-canco"><a href="borrarlista.php">Borrar playlist</a></li>
                <li id="afegir-canco"><a href="formularicanco.html" target="_blank">Afegir canço</a><li>
            </div>
                <div id="columna">   
                    <div class="caratula">
                        <img id="cover" alt="">
                    </div>
                    <div class="informacion">
                        <div class="informacion-cancion">
                        <p id="artista"></p>   
                        <p id="cancion"></p>
                        </div>
                    </div>
                    <div id=volume-bar>
                        <p id="tactual"class="duration-cont">
                        </p>
                    <input type="range" id="duration-bar" min="0" value="0" step="1">
                    <p id=duration-song class="duration-cont"></p>
                    </div>
                </div>
        </div>
        
            
            <div class="Controls-Box">
                <button class="controls" id="stop">
                    <img src="./img/stop.png" alt="">
                </button>
                <button class="controls" id="back">
                    <img src="./img/back.png" alt="">
                </button>
                <button class="controls" id="play">
                    <img src="./img/playb.png" alt="" id="imgchange">
                </button>
                <button class="controls" id="next">
                    <img src="./img/next.png" alt="">
                </button>
                <button class="controls" id="random">
                    <img src="./img/random.png" alt="">
                </button>
                
            </div>
        </div>
    </div>

   
    <script> //se crea la variable que contiene la lista selecionadasa
            var musica=<?php echo json_encode($selectedPlaylist);?>
    </script>  
    <!-- Script JavaScript para manipular la música -->
    <script src="./app.js"></script>
      
</body>
</html>
