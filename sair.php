<?php 
include_once "header.php";
?>

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

<?php 
include_once "footer.php";
?>
