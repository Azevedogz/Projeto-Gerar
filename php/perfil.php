<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gerar";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o parâmetro 'id' está definido na URL
if (!isset($_GET['id'])) {
  die("ID do prestador não especificado.");
}

$id_prestador = $_GET['id'];

// Consulta para obter informações do prestador
$sql_prestador = "SELECT * FROM prestadores_servico WHERE id = $id_prestador";
$result_prestador = $conn->query($sql_prestador);

if ($result_prestador->num_rows > 0) {
  $row_prestador = $result_prestador->fetch_assoc();
} else {
  echo "Prestador não encontrado";
}

// Consulta para obter os serviços solicitados
$sql_servicos_solicitados = "SELECT * FROM servicos_solicitados WHERE id_prestador = $id_prestador";
$result_servicos_solicitados = $conn->query($sql_servicos_solicitados);

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil do Prestador</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h1 class="text-center">Perfil do Prestador</h1>
    <div class="card mt-4">
      <div class="card-body">
        <h2><?php echo $row_prestador['nome']; ?></h2>
        <p><strong>Tipo de Serviço:</strong> <?php echo $row_prestador['tipo_servico']; ?></p>
        <p><strong>Descrição:</strong> <?php echo $row_prestador['descricao']; ?></p>
        <p><strong>Anos de Experiência:</strong> <?php echo $row_prestador['anos_experiencia']; ?></p>
        <p><strong>Serviços Prestados:</strong> <?php echo $row_prestador['servicos_prestados']; ?></p>
      </div>
    </div>

    <h2 class="mt-5">Serviços Solicitados</h2>
    <?php if ($result_servicos_solicitados->num_rows > 0): ?>
      <ul class="list-group mt-3">
        <?php while($row_servico = $result_servicos_solicitados->fetch_assoc()): ?>
          <li class="list-group-item"><?php echo $row_servico['descricao']; ?></li>
        <?php endwhile; ?>
      </ul>
    <?php else: ?>
      <p class="mt-3">Nenhum serviço solicitado até o momento.</p>
    <?php endif; ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
