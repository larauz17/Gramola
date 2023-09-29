document.addEventListener('DOMContentLoaded', function() {
let pausebtn = document.getElementById("play");
let imgChange = document.getElementById("imgchange");
var playorpause = true;
const music = document.createElement("audio");
const cover = document.getElementById("cover");
const artista = document.getElementById("artista");
const musicnme = document.getElementById("cancion");
const songduration = document.getElementById("duration-song");
const songdur= document.getElementById("tactual")
let nextbtn = document.getElementById("next")
let backbtn = document.getElementById("back")
let randombtn = document.getElementById("random")
var plstact=0; // playlist actual
var mscact = 0;  //cancinon actual
let plstlgt; //longitud de la lista actual
let rs = 0; //random song 
const durationBar = document.getElementById("duration-bar");
let stopbtn = document.getElementById("stop");

playsong(mscact,plstact); // se inicializa la gramola con la primera cancion de la primera lista


music.addEventListener("timeupdate", function() {
      //se crea la funcion de la barra de reproduccion
    const currentTime = music.currentTime;          // se crea la variable para saber el momento actual de la cancion
    const duration = music.duration;               // se mira la duracion
    if (music.currentTime==music.duration){        // se hace la media para saber en que momentot esta
        next();                                    //si la cancion ha terminado llama a la funcion next (cambio de cancion)
    }
    const progress = (currentTime / duration) * 100; //se actualiza la barra

    durationBar.value = progress;

    //ponemos el tiempo actual de la cancion
    const tactual= music.currentTime;
    const minutos = Math.floor(tactual / 60);
    const segundos = Math.floor(tactual % 60);
    const tactf =`${minutos}:${segundos < 10 ? '0' : ''}${segundos}`;
songdur.textContent = tactf;

});

durationBar.addEventListener("click", function(event) {
    const progressBar = event.target; 
    const position = (event.clientX - progressBar.getBoundingClientRect().left) / progressBar.clientWidth;

    music.currentTime = position * music.duration;
});





// funcion para poder pausar o reproducir musica (true es reproducir ) 
pausebtn.addEventListener("click",playpause)

nextbtn.addEventListener("click",next)


const songList = document.getElementById("song-list");

// Agregar un evento de clic a cada elemento de lista de reproducción


const playlistLinks = document.querySelectorAll('.playlist-link');

    playlistLinks.forEach((link, index) => {
        link.addEventListener('click', (event) => {
            // No necesitas evitar el comportamiento predeterminado, dejará que el enlace funcione
            var playlistId = this.getAttribute('href').split('=')[1];
            const playlistLength = musica[playlistId].songs.length;
            console.log(`Número de canciones en la lista de reproducción: ${playlistLength}`);
        });
    });


function showSongs(playlist, listIndex) {
    // Limpiar la lista de canciones
    songList.innerHTML = "";

    // Iterar a través de las canciones y agregarlas a la lista
    playlist.songs.forEach((song, index) => {
        const listItem = document.createElement("li");
        listItem.classList.add("song-item"); // Agrega una clase para el estilo CSS

        // Crear una imagen
        const songImage = document.createElement("img");
        songImage.src = song.cover; // Asignar la URL de la imagen de la portada
        songImage.alt = `${song.title} - ${song.artist}`; // Texto alternativo para la imagen
        listItem.appendChild(songImage);

        // Crear un div para el título
        const titleDiv = document.createElement("div");
        titleDiv.classList.add("title");
        titleDiv.textContent = song.title;
        listItem.appendChild(titleDiv);

        // Crear un div para el artista
        const artistDiv = document.createElement("div");
        artistDiv.classList.add("artist");
        artistDiv.textContent = song.artist;
        listItem.appendChild(artistDiv);

        // Agregar un evento de clic para mostrar información detallada
        listItem.addEventListener("click", () => {
            mscact = index;
            plstact = listIndex;
            playsong(mscact, plstact);
        });

        // Agregar el elemento de la lista completo a la lista de canciones
        songList.appendChild(listItem);
    });
}

// controles del reproductor
function playsong(index,listIndex){
    songdur.textContent="0:00"; 
    const plist = musica[listIndex]; //se define en que playlist esta la cancion que se va a reproducir
    const mscobj = plist.songs[index];  //se escoge la array que contiene la cancion
    cover.src= mscobj.cover;
    music.src =mscobj.url;
    artista.textContent = mscobj.artist;
    musicnme.textContent = mscobj.title;


    music.addEventListener('loadedmetadata', () => {
        
        const dtot = music.duration;
        const minut = Math.floor(dtot / 60);
        const sec = Math.floor(dtot % 60);
        const dtotal = `${minut}:${sec < 10 ? '0' : ''}${sec}`;
        songduration.textContent = dtotal;
      });

};

function playpause(){
    if (playorpause){
        imgChange.src = "./img/pauseb.png"
        playorpause = false;
        music.play();
    }else{
        music.pause();
        imgChange.src = "./img/playb.png";
        playorpause = true;
    };
}

stopbtn.addEventListener("click", function(){
    music.pause();
    music.currentTime = 0;
    playorpause = false;
    playpause();
}
)
function next (){
    playorpause = true;
    playpause();
    mscact++;
    if(mscact>plstlgt-1){
        mscact=0;
    }
    playsong(mscact,plstact); 
    music.play();
    
}

randombtn.addEventListener("click",function(){
    playorpause = true;
    playpause();
    var r = Math.floor(Math.random() * plstlgt);
    r = r-1;
    if (r<-1){
        r=-1
    }
    mscact = r;
    next();
})


backbtn.onclick = function(){
    console.log(mscact);
    playorpause = true;
    playpause();
    mscact--; 
    if(mscact<0){
        mscact=0;
    }
    playsong(mscact,plstact); 
    music.play();
}
})