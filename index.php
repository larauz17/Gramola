<?php
session_start(); // Iniciar la sesión


$playlists = []; //se crea la variable playlists

foreach (glob("*.json") as $file) {
    $playlistData = json_decode(file_get_contents($file), true);
    if ($playlistData) {
        $playlists[] = $playlistData;
    }
}
?>
<?php
if(isset($_GET['playlist_id'])) {
    $playlistId = $_GET['playlist_id'];
    if(isset($playlistId) && isset($playlists[$playlistId])) {
        $selectedPlaylist = $playlists[$playlistId];

        //
        $playlistFileName = glob("*.json")[$playlistId]; //asi podemos saber a que archivo corresponde el id
        $_SESSION["playlistfilename"] = $playlistFileName;
        $_playlistname = $playlists[$playlistId]["name"];
        $_SESSION["playlistname"] = $_playlistname;
        $time =date("Y-m-d H:i:s");
        $_SESSION["time"] = $time;
        // Ahora $selectedPlaylist contiene el array asociado a la lista de reproducción seleccionada.        
    }}


    $playlistCounters = [];

    // Lee la cookie si existe
    if (isset($_COOKIE["playlist_counters"])) {
        $playlistCounters = json_decode($_COOKIE["playlist_counters"], true);
    }

    // Incrementa el contador de la playlist actual
    if (array_key_exists($playlistId, $playlistCounters)) {
        $playlistCounters[$playlistId]++;
    } else {
        // Si la playlist no existe en el array, inicializa el contador en 1
        $playlistCounters[$playlistId] = 1;
    }
    
    // Convierte el array a JSON y guarda la información en la cookie
    $playlistCountersJSON = json_encode($playlistCounters);
    setcookie("playlist_counters", $playlistCountersJSON, time() + 3600, "/"); // La cookie expirará en 1 hora (3600 segundos)
    ?>
<?php


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
        <div class="usuari">
       <?php
    // Comprobar si la session 'nombre' está establecida
        if (isset($_SESSION['nombre'])) {
        echo '<p>Hola, ' . htmlspecialchars($nombre) . '</p>';
        }
        ?>
        
    </div>
        <ul id="playlist-list">
        <ul id="playlist-list">
    
        </ul>
        
<?php
if (!isset($_SESSION['nombrePlaylists'])) {
    $_SESSION['nombrePlaylists'] = [] ;
}

foreach ($playlists as $index => $playlist) {
    $nombrePlaylist = $playlist['name'];
    if (!in_array($nombrePlaylist, $_SESSION['nombrePlaylists'])) {
        $_SESSION['nombrePlaylists'][] = $nombrePlaylist; // Agrega el nombre de la playlist a la sesión
    }
    echo '<li><a href="index.php?playlist_id=' . $index . '">' . $playlist['name'] . '</a></li>';


    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $_SESSION['url'] = $url;

   
}
?>
        </ul>
        <ul ><form action="afegirlista.php" method="post" id="addlistaform">
                    <button type="button" id="afegirlista"class="afegirllista" ></button>
                    <input type="hidden" name="nombre" id="nomllista">
                    <button type="submit" style="display: none;">Enviar</button>
                </form>
            
        </ul>
        <a href="fitxatec.php">Fitxa tecnica</a>
        </div>
        

    <div class="Body">
    <form action="borrarcanco.php" method="post" id="deleteForm">
        <input type="hidden" name="cancion" id="songIndex">
        <button type="button" style="display: none;" id="deleteButton"></button>
        <button type="submit" style="display: none;" id="submitButton"></button>
    </form>

        <div class="Art-Box">
            <div id="playlist-act">
                <ul id="song-list">
                </ul>
                <li id="borrar-playlist"><a href="borrarlista.php">Borrar playlist</a></li>
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
                <div id=vol-ctrl>
                    <img src="./img/speaker.png">
                <input type="range" id="volumen" min="0" max="1" step="0.01" value="0.5" />
                </div>
                


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
//comentario de prueba