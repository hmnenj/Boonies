<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/listaClientes.css">
    <title>Lista de Clientes</title>
</head>
<body>
    <h1>Lista de Clientes</h1>
    <?php
    $banco = "dadosCliente.json";
    if (file_exists($banco)) {
        $extrair_dados = file_get_contents($banco);
        $clientes = json_decode($extrair_dados, true);

        echo "<ul class='cliente-list'>";
        foreach ($clientes as $index => $cliente) {
            echo "<li class='cliente-item'>";
            echo "<span class='cliente-info'>" . $cliente['nome'] . " - " . $cliente['email'] . "</span>";
            echo " <a href='editarCliente.php?index=$index' class='editar'>Editar</a>";
            echo " | ";
            echo " <a href='apagarCliente.php?index=$index' class='apagar' onclick=\"return confirm('Tem certeza que deseja apagar este cliente?');\">Apagar</a>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "Nenhum cliente cadastrado.";
    }
    ?>
    <a href="cadastroCliente.php" class="cadastrar">Cadastrar Novo Cliente</a>
</body>
</html>
