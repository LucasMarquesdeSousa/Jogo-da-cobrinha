<!DOCTYPE html>
<html lang="pt-br">
<?php session_start(); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuração</title>
    <style>
        .fundo {
            background-color: grey;
            border: 8px solid black;
            width: 50%;
            height: 90%;
            text-align: center;
            font-size: 15pt;
        }

        .cobra {
            background-color: grey;
            border: 8px solid black;
            width: 50%;
            text-align: center;
            font-size: 15pt;
        }

        form {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: row;
        }

        .velo {
            background-color: grey;
            border: 8px solid black;
            width: 50%;
            align-items: center;
            text-align: center;
            font-size: 15pt;
        }

        #velo {
            margin-top: 40px;
            background-color: grey;
            font-size: 15pt;
        }

        #bot {
            background-color: rgb(0, 0, 0);
            color: grey;
            border: 2px solid grey;
            font-family: arial;
            font-size: 15pt;
        }

        input {
            margin: 0px 5px 10px 2px;
            background-color: grey;
            font-size: 15pt;
        }

        .titulo {
            font-size: 20pt;
            width: 100%;
            text-align: center;
            background-color: grey;
        }
    </style>
</head>

<body>
    <section>
        <div class="titulo">
            <h1>Menu de configuração</h1>
        </div>
        <nav>
            <form id="form" method="POST">
                <div class="velo">
                    <h1>Velocidade</h1>
                    <select name="velo" id="velo">
                        <option value="0"> Escola uma opção</option>
                        <option value="400"> Muito Lento</option>
                        <option value="200"> Lento</option>
                        <option value="100"> Normal</option>
                        <option value=" 70"> Rapido</option>
                        <option value=" 50"> Muito Rapido</option>
                    </select>
                </div>
                <div class="fundo">
                    <h1>Cor de fundo:</h1>
                    <h2>red:</h2><input name="redF" type="number" id="cor-fundoR" />
                    <h2>green: </h2><input name="greenF" type="number" id="cor-fundoG" />
                    <h2>blue: </h2><input name="blueF" type="number" id="cor-fundoB" />
                </div>
                <div class="cobra">
                    <h1>Cor da cobra</h1>
                    <h2>red:</h2><input name="redC" type="number" id="cor-cobraR" />
                    <h2>green: </h2><input name="greenC" type="number" id="cor-cobraG" />
                    <h2>blue: </h2><input name="blueC" type="number" id="cor-cobraB" />
                </div>
                <input type="submit" value="Enviar" id="bot" />
                <!-- Volume -->
            </form>
        </nav>
        <canvas id="canvas" width="1326" height="100"> </canvas>
    </section>
    <?php  ?>
    <script>
        //velocidade
        var velo = document.getElementById("velo")
        //cor do fundo
        var fundoR = document.getElementById("cor-fundoR")
        var fundoG = document.getElementById("cor-fundoG")
        var fundoB = document.getElementById("cor-fundoB")
        //cor da cobra
        var cobraR = document.getElementById("cor-cobraR");
        var cobraG = document.getElementById("cor-cobraG");
        var cobraB = document.getElementById("cor-cobraB");
        //observador de eventos.
        var formulario = document.getElementById("form");
        ///////
        var canvas = document.getElementById("canvas");
        var ctx = canvas.getContext("2d");
        canvas.style.border = "2px solid grey";
        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        let rastro = [];
        const tp = {
            X: 20,
            Y: 20,
        }
        const sniker = {
            positionX: 10,
            positionY: 0,
        }
        const vel = {
            X: 0,
            Y: 0,
        }
        const comida = {
            positionX: 0,
            positionY: 0,
        }
        let tam = 1;
        var tecla = document.addEventListener("keydown", function() {
            switch (event.key) {
                case "a": // left
                    vel.X = -1;
                    vel.Y = 0;
                    break;
                case "w": //top
                    vel.Y = -1;
                    vel.X = 0;
                    break;
                case "d": // right
                    vel.X = 1;
                    vel.Y = 0;
                    break;
                case "s": // down
                    vel.X = 0;
                    vel.Y = 1;
                    break;
            }
        })
        velo.addEventListener("input", function() {
            if (velo.value != "" && velo.value <= 400 && velo.value > 0) {
                var velocidade = velo.value;
                setInterval(redenrizar, velocidade);
                console.log(velo.value);
            }

        });

        function redenrizar() {
            ///////////////////////////////////////////////////////////////////////////////////////////
            //cor de fundo
            var velocidade = velo.value;

            if (fundoR.value > 255) {
                fundoR.value = 255;
            } else if (fundoR.value == "" || fundoR.value < 0) {
                fundoR.value = 0;
            }
            if (fundoG.value > 255) {
                fundoG.value = 255;
            } else if (fundoG.value == "" || fundoG.value < 0) {
                fundoG.value = 0;
            }
            if (fundoB.value > 255) {
                fundoB.value = 255;
            } else if (fundoB.value == "" || fundoB.value < 0) {
                fundoB.value = 0;
            }
            var corFundoR = fundoR.value;
            var corFundoG = fundoG.value;
            var corFundoB = fundoB.value;

            //cor da cobra
            if (cobraR.value > 255) {
                cobraR.value = 255;
            } else if (cobraR.value == "" || cobraR.value < 0) {
                cobraR.value = 0;
            }
            if (cobraG.value > 255) {
                cobraG.value = 255;
            } else if (cobraG.value == "" || cobraG.value < 0) {
                cobraG.value = 0;
            }
            if (cobraB.value > 255) {
                cobraB.value = 255;
            } else if (cobraB.value == "" || cobraB.value < 0) {
                cobraB.value = 0;
            }
            var corCobraR = cobraR.value;
            var corCobraG = cobraG.value;
            var corCobraB = cobraB.value;

            ////////////////////////////////////////////////////////////////////////////////////////////////
            sniker.positionX = sniker.positionX + vel.X
            sniker.positionY = sniker.positionY + vel.Y
            if (sniker.positionX < 0) {
                sniker.positionX = 65;
            } else if (sniker.positionX > 65) {
                sniker.positionX = 0
            } else if (sniker.positionY < 0) {
                sniker.positionY = 10
            } else if (sniker.positionY > 10) {
                sniker.positionY = 0
            }
            //fundo
            ctx.fillStyle = `rgb(${corFundoR}, ${corFundoG},${corFundoB})`;
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            //cobra 
            ctx.fillStyle = `rgb(${corCobraR}, ${corCobraG},${corCobraB})`;
            for (var i = 0; i < rastro.length; i++) {
                // desenhando a cobra no canvas 
                ctx.fillRect(rastro[i].X * tp.X, rastro[i].Y * tp.Y, tp.X - 1, tp.Y - 1)
            }
            while (rastro.length > tam) {
                // definindo o tamanho inicial da cobra
                rastro.shift() // tirar o primeiro elemento do array
            }
            rastro.push({
                X: sniker.positionX,
                Y: sniker.positionY,
            })
            //comida
            ctx.fillStyle = "red"
            ctx.fillRect(comida.positionX * tp.X, comida.positionY * tp.Y, tp.X - 1, tp.Y - 1)
        }

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    </script>
    <?php
    if (isset($_POST["velo"]) > 0 && isset($_POST["redC"])  && isset($_POST["greenC"])  && isset($_POST["blueC"])  && isset($_POST["redF"])  && isset($_POST["greenF"])  && isset($_POST["blueF"])) {
        //php
        require_once '../DAO/UsuarioDAO.php';
        $usuarioDAO = new UsuarioDAO();

        require_once '../DTO/UsuarioDTO.php';
        $usuarioDTO = new UsuarioDTO();


        $velocidade = $_POST["velo"];
        $redF = $_POST['redF'];
        $greenF = $_POST['greenF'];
        $blueF = $_POST['blueF'];
        $cor_fundo = "rgb(" . $redF . "," . $greenF . "," . $blueF . ")";
        $redC = $_POST['redC'];
        $greenC = $_POST['greenC'];
        $blueC = $_POST['blueC'];
        $cor_sniker = "rgb(" . $redC.",".$greenC.", ". $blueC . ")";
        $usuario = "";
        if (isset($_SESSION["cod"]) != "") {
            $cod = $_SESSION["cod"];
            $usuario = $usuarioDAO->PegarUsuario($cod);
        } else {
            $cod = rand(10000, 1000000000);
            $usuario = false;
        }
        $tecla_cima = "w";
        $tecla_baixo = "s";
        $tecla_direita = "d";
        $tecla_esquerda = "a";
        
        $usuarioDTO->setCod($cod);
        $usuarioDTO->setVelocidade($velocidade);
        $usuarioDTO->setCor_fundo($cor_fundo);
        $usuarioDTO->setCor_snike($cor_sniker);
        $usuarioDTO->setTecla_cima($tecla_cima);
        $usuarioDTO->setTecla_baixo($tecla_baixo);
        $usuarioDTO->setTecla_direita($tecla_direita);
        $usuarioDTO->setTecla_esquerda($tecla_esquerda);
        //rretorno do banco de dados;
        if ($usuario) {
            $usuarioDAO->EditarUsuario($usuarioDTO);
            $_SESSION["cod"] = $cod;
            $_SESSION["velocidade"] = $velocidade;
            $_SESSION["corFundo"] = $cor_fundo;
            $_SESSION["corSniker"] = $cor_sniker;
            $_SESSION["teclaCima"] = $tecla_cima;
            $_SESSION["teclaBaixo"] = $tecla_baixo;
            $_SESSION["teclaDireita"] = $tecla_direita;
            $_SESSION["teclaEsquerda"] = $tecla_esquerda;
            echo "<script> location.href='../index.html'</script>";
        } else {
            $usuarioCriar = $usuarioDAO->Criar($usuarioDTO);
            if ($usuarioCriar) {
                $_SESSION["cod"] = $cod;
                $_SESSION["velocidade"] = $velocidade;
                $_SESSION["corFundo"] = $cor_fundo;
                $_SESSION["corSniker"] = $cor_sniker;
                $_SESSION["teclaCima"] = $tecla_cima;
                $_SESSION["teclaBaixo"] = $tecla_baixo;
                $_SESSION["teclaDireita"] = $tecla_direita;
                $_SESSION["teclaEsquerda"] = $tecla_esquerda;
                echo "<script> location.href='../index.html'</script>";
            }
        }
    }
    ?>
</body>

</html>