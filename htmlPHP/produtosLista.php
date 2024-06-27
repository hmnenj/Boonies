<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
</head>
<body>
    <h1>Lista de Produtos</h1>
    <?php
    $banco = "dadosProduto.json";
    if (file_exists($banco)) {
        $extrair_dados = file_get_contents($banco);
        $produtos = json_decode($extrair_dados, true);

        if (is_array($produtos)) {
            echo "<ul>";
            foreach ($produtos as $index => $produto) {
                echo "<li>";
                echo $produto['nome'] . " - " . $produto['preco'];
                echo " <a href='editarProduto.php?index=$index'>Editar</a>";
                echo " | ";
                echo " <a href='apagarProduto.php?index=$index' onclick=\"return confirm('Tem certeza que deseja apagar este produto?');\">Apagar</a>";
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "Nenhum produto cadastrado.";
        }
    } else {
        echo "Nenhum produto cadastrado.";
    }
    ?>
    <a href="cadastroProduto.php">Cadastrar Novo Produto</a>
</body>
</html>
