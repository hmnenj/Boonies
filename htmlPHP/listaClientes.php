<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
</head>
<body>
    <h1>Lista de Clientes</h1>
    <?php
    $banco = "dadosCliente.json";
    if (file_exists($banco)) {
        $extrair_dados = file_get_contents($banco);
        $clientes = json_decode($extrair_dados, true);

        echo "<ul>";
        foreach ($clientes as $index => $cliente) {
            echo "<li>";
            echo $cliente['nome'] . " - " . $cliente['email'];
            echo " <a href='editarCliente.php?index=$index'>Editar</a>";
            echo " | ";
            echo " <a href='apagarCliente.php?index=$index' onclick=\"return confirm('Tem certeza que deseja apagar este cliente?');\">Apagar</a>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "Nenhum cliente cadastrado.";
    }
    ?>
    <a href="cadastroCliente.php">Cadastrar Novo Cliente</a>
</body>
</html>
