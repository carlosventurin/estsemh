<?php
session_start();

unset($_SESSION['id_usuario']);
unset($_SESSION['logado']);

header("Location: login.php");
?>