<?php
// boas_vindas.php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <?php
        // Verifique se o nome do usuário está definido na sessão
        if (isset($_SESSION['nome_usuario'])) {
            $nomeUsuario = $_SESSION['nome_usuario'];
            echo "<p class='message'>Seja bem-vindo, $nomeUsuario!</p>";
        } else {
            echo "<p class='message'>Você não está logado.</p>";
        }
        ?>
    </div>
</body>
</html>
