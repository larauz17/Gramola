let pausebtn = document.getElementById("pause");
let play = document.getElementById("play");
let imgChange = document.getElementById("imgchange");

var playorpause = true;
// funcion para poder pausar o reproducir musica (true es reproducir ) 
pausebtn.onclick = function(){
    if (playorpause){
        imgChange.src = "./img/pauseb.png"
        playorpause = false;
    }else{
        imgChange.src = "./img/playb.png";
        playorpause = true;
    }
}