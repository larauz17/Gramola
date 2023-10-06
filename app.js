document.addEventListener('DOMContentLoaded', function() {
let pausebtn = document.getElementById("play");                 //el boton de pausa del reprodutor
let imgChange = document.getElementById("imgchange");           // //el atributo boton de pausa del reprodutor
var playorpause = true;                                         //la boleana que cambia la imagen de play/pausa
const music = document.createElement("audio");                  //se crea el archivo de audio del reproductor
const cover = document.getElementById("cover");                 //se busca el elemento cover del index.php
const artista = document.getElementById("artista");             //se busca el elemento artista del index.php
const musicnme = document.getElementById("cancion");            //se busca el elemento cancion del index.php
const songduration = document.getElementById("duration-song");  //se busca el elemento duration-song del index.php
const songdur= document.getElementById("tactual")
let nextbtn = document.getElementById("next")                   //boton que avanza de cancion
let backbtn = document.getElementById("back")                   //boton que retrocede la cancion
let randombtn = document.getElementById("random")               //boton de random
let afegirlista = document.getElementById("afegirlista")        //el boton de añadir lista
var mscact = 0;  //cancinon actual                              
let plstlgt= musica.songs.length;                               //cojemos la longitud de la lista
const durationBar = document.getElementById("duration-bar");    //elemento de la duracion de la cancion
let stopbtn = document.getElementById("stop");                  //boton que pausa la cancion

//el boton que borra cancion(se manda al formulario borrarcanco.php)
const deleteButton = document.getElementById("deleteButton");
    const songIndexInput = document.getElementById("songIndex");
    const submitButton = document.getElementById("submitButton");

    //cuando llega una lista se inicializa con la primera cancion de la pagina
playsong(mscact); // se inicializa la gramola con la primera cancion de la primera lista

//pop up para pedir al usuario el nombre de la lista, se manda a un formulario
afegirlista.addEventListener("click",mostrarPopUp);
function mostrarPopUp() {
    var nombre = prompt("Que nombre tendra la lista");
    document.getElementById("nomllista").value = nombre;
        document.getElementById("addlistaform").submit();
}




//se encarga del volumen de la musica
music.addEventListener("timeupdate", function() {
    music.volume = volumen.value;
    volumen.addEventListener("input", function () {
        music.volume = volumen.value;
    });
    
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

showSongs(musica)
// Agregar un evento de clic a cada elemento de lista de reproducción)
function showSongs(musica) {
    // Limpiar la lista de canciones
    const songList = document.getElementById("song-list");
    songList.innerHTML = "";

    // Iterar a través de las canciones y agregarlas a la lista
    musica.songs.forEach((song, index) => {
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

        const deleteButton = document.createElement("button");
        deleteButton.classList.add("delete-button"); // Agrega una clase para el estilo CSS
        listItem.appendChild(deleteButton);

        deleteButton.addEventListener("click", (event) => {
            event.stopPropagation();
        
            const songIndex = index;
        
            songIndexInput.value = songIndex;

        // Simula el clic en el botón de enviar el formulario
            submitButton.click();
        });


        // Agregar un evento de clic para mostrar información detallada
        listItem.addEventListener("click", () => {
            mscact = index;
            playsong(mscact); //manda el index de la cancion que se tiene que reproducir
        });

        // Agregar el elemento de la lista completo a la lista de canciones
        songList.appendChild(listItem);
    });
}

// controles del reproductor
function playsong(index){
    //recibe el index de la cancion para reproducir-la
    songdur.textContent="0:00"; 
 //se define en que playlist esta la cancion que se va a reproducir
    const mscobj = musica.songs[index];  //se escoge la array que contiene la cancion
    cover.src= mscobj.cover;
    music.src =mscobj.url;              //escojemos la ubicacion del archivo
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
pausebtn.addEventListener("click",playpause);

//esta funcion se encarga de cambiar la imagen a play o pausa a demas de pausar o reproducir la cancion
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
nextbtn.addEventListener("click",next);
function next (){
    playorpause = true;
    playpause();
    mscact++;
    if(mscact>plstlgt-1){
        mscact=0;
    }
    playsong(mscact); 
    music.play();
    
}

randombtn.addEventListener("click",function(){
    var r = Math.floor(Math.random() * plstlgt);
    mscact = r;
    playsong(mscact);
    playorpause=true; 
    playpause();
    music.play();
})

backbtn.onclick = function(){
    console.log(mscact);
    playorpause = true;
    playpause();
    mscact--; 
    if(mscact<0){
        mscact=0;
    }
    playsong(mscact); 
    music.play();
}
});
//comentario de prueba