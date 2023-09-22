let pausebtn = document.getElementById("pause");
let play = document.getElementById("play");
let imgChange = document.getElementById("imgchange");
var coverimg = document.getElementById("cover")
var playorpause = true;
let next = document.getElementById("next");
const music = document.createElement("audio")

var plst1 = document.getElementById("plst1")
var plst2 = document.getElementById("plst2")
// funcion para poder pausar o reproducir musica (true es reproducir ) 
pausebtn.onclick = function(){
    if (playorpause){
        imgChange.src = "./img/pauseb.png"
        playorpause = false;
        music.play();
    }else{
        music.pause();
        imgChange.src = "./img/playb.png";
        playorpause = true;
    }
}


var lI = document.getElementById('llistamusica');





var currentPlaylist;


function loadAndShowPlaylist() {
    // Limpia la lista de reproducción actual
    llistamusica.innerHTML = '';
    
    // Crea una lista desordenada (ul)
    var ul = document.createElement('ul');

    // Recorre los elementos en la lista de reproducción actual y crea elementos de lista (li) para cada canción
    currentPlaylist.forEach(function(song) {
        var li = document.createElement('li');
        li.innerHTML = '<strong>' + song.title + '</strong> - ' + song.artist;

        // Agrega un evento de clic a cada elemento de la lista
        li.addEventListener('click', function() {
            selectedS = song
            showSelectedSongDetails(song);
        });

        // Añade el elemento de lista a la lista desordenada
        ul.appendChild(li);
    });
 
    // Añade la lista desordenada al div de la lista de reproducción
    llistamusica.appendChild(ul);

    // Muestra la primera canción de la lista de reproducción actual (si existe)
    if (currentPlaylist.length > 0) {
        showSelectedSongDetails(currentPlaylist[0]);
    }
}


// Función para mostrar los detalles de la canción seleccionada
function showSelectedSongDetails(song) {
    coverimg.src = song.cover;
    music.src = song.url;   
}

// Asigna eventos de clic a los botones de las playlists
plst1.addEventListener('click', function() {
    currentPlaylist = llistaI;
    loadAndShowPlaylist();
});

plst2.addEventListener('click', function() {
    currentPlaylist = llistaII;
    loadAndShowPlaylist();
});

// Carga y muestra la primera lista de reproducción inicialmente
loadAndShowPlaylist();