<?php
$playlists = [];

foreach (glob("*.json") as $file) {
    $playlistData = json_decode(file_get_contents($file), true);
    if ($playlistData) {
        $playlists[] = $playlistData;
    }
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
        <ul id="playlist-list">
        <?php
                foreach ($playlists as $index => $playlist) {
                    // Agrega un enlace o elemento de lista con un atributo 'data-id' para identificar la lista
                    echo '<li><a href="#" class="playlist-link" data-id="' . $index . '">' . $playlist['name'] . '</a></li>';
                }
                ?>
        </ul>
        <ul id=>Afegir playlist</ul>
        </div>
    <div class="Body">
            
            
        <div class="Art-Box">
            <div id="playlist-act">
                <ul id="song-list"></ul>
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
        
            
            <div class="Status-Box">
                <!-- Mostrar información de la canción actual (nombre, artista, tiempo, etc.) -->
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

   
    <script>
            var musica=<?php echo json_encode($playlists);?>
    </script>  
    <!-- Script JavaScript para manipular la música -->
    <script src="./app.js"></script>
      
</body>
</html>
