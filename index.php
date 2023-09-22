<?php
        $playlist1 = file_get_contents("./llista1.json");
        $cancionPlay1 = json_decode($playlist1, true);
        $playlist2 = file_get_contents("./llista2.json");
        $cancionPlay2 = json_decode($playlist2, true);
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
              <button class="Llista" id="plst1">Un poco de todo</button>
              <button class="Llista" id="plst2">Rock</button>
              <button class="Llista"></button>
              <button class="Llista"></button>
              <button class="Afegir Llista+">Afegir Llista+</button>
            </div>
            <div class="Body">
              <div class="Art-Box">
                <div id="llistamusica">
                
                </div>
                <div class="caratula">
                    <img id="cover" alt="">
                </div>
              </div>
              <div class="Status-Box"></div>
              
              <div class="Controls-Box">
                <Button class="controls" >
                  <img src="./img/stop.png">
                </Button>
                <Button class="controls" >
                  <img src="./img/back.png" alt="">
                </Button>
                <Button class="controls" id="pause">
                  <img src="./img/playb.png" id="imgchange">
                </Button>
                <Button class="controls" id="next">
                  <img src="./img/next.png">
                </Button>
                <Button class="controls" >
                  <img src="./img/random.png">
                </Button>
              </div>
            </div>
          </div>
          <script>
            var llistaI = <?php echo json_encode($cancionPlay1); ?>;
            var llistaII = <?php echo json_encode($cancionPlay2); ?>;
            </script>
          <script src="./app.js"></script>
          
    </body>
</html>