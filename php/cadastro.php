<?php
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(empty(trim($_POST["nome"]))){
        $username_err = "Por favor, insira um nome de usuário.";
    } else{
        $sql = "SELECT id FROM prestadores_servico WHERE nome= ?";
        
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("s", $param_username);
            
            $param_username = trim($_POST["nome"]);
            
            if($stmt->execute()){
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "Este nome de usuário já está em uso.";
                } else{
                    $username = trim($_POST["nome"]);
                }
            } else{
                echo "Oops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
        }
        
        $stmt->close();
    }
    
    if(empty(trim($_POST["senha"]))){
        $password_err = "Por favor, insira uma senha.";     
    } elseif(strlen(trim($_POST["senha"])) < 6){
        $password_err = "A senha deve ter pelo menos 6 caracteres.";
    } else{
        $password = trim($_POST["senha"]);
    }
    
    if(empty(trim($_POST["confirmar_senha"]))){
        $confirm_password_err = "Por favor, confirme a senha.";     
    } else{
        $confirm_password = trim($_POST["confirmar_senha"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "As senhas não coincidem.";
        }
    }
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        $sql = "INSERT INTO prestadores_servico (nome, senha) VALUES (?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("ss", $param_username, $param_password);
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Hash da senha
            
            if($stmt->execute()){
                $last_inserted_id = mysqli_insert_id($mysqli);
                echo "<script>alert('Cadastro realizado com sucesso!');</script>";
                header("location: perfil.php?id={$last_inserted_id}");
            } else{
                echo "Oops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
        }
         
        $stmt->close();
    }
    
    $mysqli->close();
}

