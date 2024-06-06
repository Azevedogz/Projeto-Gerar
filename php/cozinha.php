<?php
require_once "config.php";

// Selecionar três prestadores de serviço
$sql = "SELECT id, nome, descricao FROM prestadores_servico WHERE tipo_servico='Serviços de Cozinha' LIMIT 3";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $prestadores = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $prestadores = [];
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Serviços de Cozinha</title>
  <link rel="stylesheet" href="css/style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>
<body>
  <div class="navbar">
    <ul class="nav justify-content-center">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.html">Início</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cadastro.php">Cadastro</a>
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
    <h1 class="text-center mb-4">Prestadores de Serviço - Serviços de Cozinha</h1>
    <div class="row">
      <?php foreach($prestadores as $prestador): ?>
        <div class="col-md-4 mb-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($prestador['nome']); ?></h5>
              <p class="card-text"><?php echo htmlspecialchars($prestador['descricao']); ?></p>
              <a href="perfil.php?id=<?php echo $prestador['id']; ?>" class="btn btn-primary">Ver Perfil</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
