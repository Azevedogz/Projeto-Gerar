<?php
// autenticar.php
session_start();

// Aqui você pode definir suas credenciais de usuário para simulação
$usuario_valido = "admin";
$senha_valida = "1234";

// Obter dados do formulário
$username = $_POST['username'];
$password = $_POST['password'];

// Validar credenciais
if ($username === $usuario_valido && $password === $senha_valida) {
    $_SESSION['nome_usuario'] = $username;
    header("Location: boas_vindas.php");
    exit();
} else {
    $_SESSION['erro'] = "Nome de usuário ou senha inválidos!";
    header("Location: login.php");
    exit();
}
?>
