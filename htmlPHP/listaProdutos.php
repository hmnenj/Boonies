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

        echo "<ul>";
        foreach ($produtos as $index => $produto) {
            echo "<li>";
            echo "<a href='detalhesProduto.php?index=$index'>" . $produto['nome'] . "</a>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "Nenhum produto cadastrado.";
    }
    ?>
</body>
</html>
