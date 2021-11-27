<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estórias sem H - Cadastro</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" href="css/cadastro.css" />
</head>

<body>
    <!-- Formulário para cadastrar usuários -->
    <?php include "header.php"; ?>
    
    <article>
        <div>
            <h1>Cadastro</h1>
            <hr>
            <form>
                <label for="username">Usuário:</label>
                <input type="text" name="username">
                <br>
                <label for="email">Email:</label>
                <input type="text" name="email">
                <br>
                <label for="password">Senha:</label>
                <input type="text" name="password">
                <br>
                <label for="rpassword">Repita a Senha:</label>
                <input type="text" name="rpassword">
                <br>
                <input type="submit" value="Cadastrar" id="botao">
            </form>
        </div>
    </article>
</body>

</html>