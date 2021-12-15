<?php include_once "header.php"; ?>
<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5">
        <h1>Cadastro</h1>
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
            <input type="submit" value="Cadastrar" id="botao" class="waves-effect waves-light btn">
        </form>
    </div>
</article>

<?php include_once "footer.php"; ?>
