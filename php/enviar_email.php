<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $mensagem = trim($_POST["mensagem"]);

    if (!empty($nome) && !empty($email) && !empty($mensagem)) {
        $mail = new PHPMailer(true);
        try {
            // Configurações do servidor
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Substitua com o servidor SMTP do seu provedor de email
            $mail->SMTPAuth = true;
            $mail->Username = 'guguazevedo90@gmail.com'; // Substitua com seu endereço de email
            $mail->Password = 'suasenha'; // Substitua com sua senha de email
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Configurações do email
            $mail->setFrom('seuemail@dominio.com', 'Nome do Remetente'); // Substitua com seu endereço de email e nome
            $mail->addAddress('admin@example.com'); // Substitua com o email do administrador
            $mail->isHTML(true);
            $mail->Subject = 'Contato do Site';
            $mail->Body = "<p>Nome: $nome</p><p>Email: $email</p><p>Mensagem: $mensagem</p>";

            $mail->send();
            echo "<script>alert('Mensagem enviada com sucesso!'); window.location.href='contato.html';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erro ao enviar mensagem. Por favor, tente novamente.'); window.location.href='contato.html';</script>";
        }
    } else {
        echo "<script>alert('Por favor, preencha todos os campos.'); window.location.href='contato.html';</script>";
    }
} else {
    echo "<script>alert('Método de solicitação inválido.'); window.location.href='contato.html';</script>";
}
?>
