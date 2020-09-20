<?php
session_start();
if (empty($_SESSION["cod"])) {
    echo "<script>location.href='../index.html'</script>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/Confirmacao.js"></script>
    <title>Estudando a tag canvas</title>
</head>

<body>
    <div id="ganhador"></div>
    <div> 
        <a href="../view/Config.php"> Configuração </a>
        <a href="../controller/Sair.php" onclick="return Sair();"> Sair </a>

    </div>
    <canvas id="canvas" width="400" height="400"> </canvas>
    <script>
        //pegar o canvas e colcocar o contexto 2D
        var canvas = document.getElementById("canvas")
        var ctx = canvas.getContext("2d") //dizendo que vou desenhar em 2D

        //velocidade da cobrinha


        //definir as variáveis que vão ser usuadas no game
        let rastro = [];
        const comida = {
            positionX: 10,
            positionY: 19,
        }
        const sniker = {
            positionX: 10,
            positionY: 10,
        }
        const tp = {
            X: 20,
            Y: 20,
        }
        const vel = {
            X: 0,
            Y: 0,
        }
        const placar = {
            p: 0,
        }
        let tam = 2;
        let record = [];

        //metodo definido para escultar teclado 
        document.addEventListener("keydown", function() {
            //teclas
            switch (event.key) {
                case '<?= $_SESSION["teclaEsquerda"] ?>': // left
                    vel.X = -1;
                    vel.Y = 0;
                    break;
                case '<?= $_SESSION["teclaCima"] ?>': //top
                    vel.Y = -1;
                    vel.X = 0;
                    break;
                case '<?= $_SESSION["teclaDireita"] ?>': // right
                    vel.X = 1;
                    vel.Y = 0;
                    break;
                case '<?= $_SESSION["teclaBaixo"] ?>': // down
                    vel.X = 0;
                    vel.Y = 1;
                    break;
            }
        })

        // rechama a função a cada milisegundo
        setInterval(Redenrizarcampo, <?= $_SESSION["velocidade"] ?>)

        function Redenrizarcampo() {
            //incrementado a velocidade na posição x e y e assim dá a sensação de movimento
            sniker.positionX = sniker.positionX + vel.X
            sniker.positionY = sniker.positionY + vel.Y
            // não deixa a cobra desaparecer do quadrado no x e y
            if (sniker.positionX < 0) {
                sniker.positionX = tp.X
            } else if (sniker.positionX > tp.X) {
                sniker.positionX = 0
            } else if (sniker.positionY < 0) {
                sniker.positionY = tp.Y
            } else if (sniker.positionY > tp.Y) {
                sniker.positionY = 0
            }
            //campo
            ctx.fillStyle = '<?= $_SESSION["corFundo"] ?>';
            ctx.fillRect(0, 0, 400, 400);

            //comida
            ctx.fillStyle = "red"
            ctx.fillRect(comida.positionX * tp.X, comida.positionY * tp.Y, tp.X - 1, tp.Y - 1)

            //cobra
            ctx.fillStyle = '<?= $_SESSION["corSniker"] ?>';
            for (var i = 0; i < rastro.length; i++) {
                // desenhando a cobra no canvas 
                ctx.fillRect(rastro[i].X * tp.X, rastro[i].Y * tp.Y, tp.X - 1, tp.Y - 1)

                //detectar colisão 
                if (rastro[i].X == sniker.positionX && rastro[i].Y == sniker.positionY && vel.X != vel.Y) {
                    tam = 2
                    vel.X = 0;
                    vel.Y = 0;
                    var gameover = true
                }
            }

            while (rastro.length > tam) {
                // definindo o tamanho inicial da cobra
                rastro.shift() // tirar o primeiro elemento do array
            }
            // colocar a posição x e posição y da cobra dentro do array para criar o rastro
            if (sniker.positionX == comida.positionX && sniker.positionY == comida.positionY) {
                //comer a comida do campo , acrescentar mais um quadrado na cobra, mudar a comida de lugar
                tam++
                comida.positionX = Math.floor(Math.random() * tp.X);
                comida.positionY = Math.floor(Math.random() * tp.Y);
                placar.p++
            }
            if (gameover) {
                setTimeout(Tempo, 1000);
            }
            var vencedor = document.getElementById("ganhador")
            vencedor.innerHTML = `Pontos: ${placar.p}`
            rastro.push({
                X: sniker.positionX,
                Y: sniker.positionY,
            })
        }

        function Tempo() {
            record.push(placar.p)
            for (var i = 0; i < record.length; i++) {
                var anterior = i - 1;
                var posterior = i + 1;
                if(anterior < 0){
                    anterior = 0
                }else if(posterior > record.lastIndexOf){
                    posterior = record.length;
                }
                if (record[anterior] > record[i] || record[posterior] > record[i]) {
                    console.log(`${record[i]}`)
                    alert(`Record: ${record[i]}`)
                }else if(record[i] < record[anterior] || record[i] < record[posterior]){
                    console.log(`${record[anterior]}`)
                    alert(`Record: ${record[anterior]}`)
                }
            }
            alert(`Pontuação: ${placar.p}`)
            placar.p = 0
        }
    </script>
</body>

</html>