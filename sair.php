<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estórias sem H - Sair</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" href="css/sair.css" />
</head>

<body>
    <!-- Criação do cabeçalho da página -->
    <?php include "header.php";?>

    <!-- Formulário para que usuários loguem -->
    <article>
        <div>
            <h1>Login</h1>
            <hr>
            <form>
                <label for="email">Email:</label>
                <input type="text" name="email">
                <br>
                <label for="password">Senha:</label>
                <input type="text" name="password">
                <br>
                <input type="submit" value="Entrar" id="botao">
            </form>
        </div>
    </article>
</body>

</html>