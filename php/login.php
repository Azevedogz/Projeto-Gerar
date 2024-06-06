<?php
session_start();

// Verificar se o usuário já está logado, redirecionar para a página principal se estiver
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header("location: index.php");
//     exit;
// }

require_once "config.php";

$username = $password = "";
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Verificar se o campo de nome de usuário está vazio
    if(empty(trim($_POST["nome"]))){
        $username_err = "Por favor, insira o nome de usuário.";
    } else{
        $username = trim($_POST["nome"]);
    }
    
    // Verificar se o campo de senha está vazio
    if(empty(trim($_POST["senha"]))){
        $password_err = "Por favor, insira sua senha.";
    } else{
        $password = trim($_POST["senha"]);
    }
    
    // Validar credenciais
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, nome, senha FROM prestadores_servico WHERE nome = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("s", $param_username);
            
            $param_username = $username;
            
            if($stmt->execute()){
                $stmt->store_result();
                
                if($stmt->num_rows == 1){                    
                    $stmt->bind_result($id, $username, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            header("location: perfil.php?id={$id}");
                        } else{
                            $password_err = "A senha que você digitou não é válida.";
                        }
                    }
                } else{
                    $username_err = "Nenhuma conta encontrada com esse nome de usuário.";
                }
            } else{
                echo "Oops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
        }
        
        $stmt->close();
    }
    
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>

<div class="navbar">
    <ul class="nav justify-content-center">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.html">Início</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cadastro.html">Cadastro</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Logar-se</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contato.html">Ajuda</a>
      </li>
    </ul>
  </div>

    <div class="container mt-5">
        <h2 class="text-center">Login</h2>
        <p class="text-center">Preencha suas credenciais para fazer login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="w-50 mx-auto">
            <div class="form-group">
                <label>Nome de Usuário</label>
                <input type="text" name="nome" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="senha" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Ainda não tem uma conta? <a href="cadastro_prestador.html">Cadastre-se agora</a>.</p>
        </form>
    </div>    
</body>
</html>
