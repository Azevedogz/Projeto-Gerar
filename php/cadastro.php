<?php
// Conectar ao banco de dados MySQL
$servername = "gerar";
$username = "admin"; // Seu nome de usuário do MySQL
$password = ""; // Sua senha do MySQL
$dbname = "banco_tempo"; // Nome do seu banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se há dados enviados do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se o checkbox foi marcado e salvar no banco de dados
    if (isset($_POST['checkbox_name'])) {
        $checkbox_value = $_POST['checkbox_name'];
        
        // Preparar e executar a consulta SQL para inserir os dados no banco de dados
        $sql = "INSERT INTO tabela_checkbox (valor_checkbox) VALUES ('$checkbox_value')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Dados salvos com sucesso!";
        } else {
            echo "Erro ao salvar os dados: " . $conn->error;
        }
    }
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
