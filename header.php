<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estórias sem H</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<body>
    <nav>
        <div class="nav-wrapper light-green lighten-3" id="menus">
            <a href="index.php" class="brand-logo black-text"><i class="material-icons"><img src="imagem/logo.png" class="logo" alt="Home"> Estórias sem H</i></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <?php
                session_start();
                include_once 'utils.php';

                if (isset($_SESSION['logado'])) {
                    $url="https://estorias-sem-h-crud.herokuapp.com/users/get_user.php?id=" . $_SESSION["id_usuario"];
                    $usuario = consultar($url);

                    echo '<li>
                    <a href="write.php" class="black-text">Escrever</a>
                    </li>
                    <li>
                        <a href="generos.php" class="black-text">Gêneros</a>
                    </li>
                    <li>
                        <a href="classif.php" class="black-text">Classificações Indicativas</a>
                    </li>
                    <li>
                        <a href="login.php" class="black-text">Sair</a>
                    </li>
                    <li>
                        <a href="sobre.php" class="black-text">Sobre</a>
                    </li>';

                    echo "<li><a href='usuario.php?id_user=". $usuario['idusuario'] ."' class='black-text'> " . $usuario['nomusuario'] . "</a></li>";
                }
                ?>
            </ul>
        </div>
    </nav>
    <br>