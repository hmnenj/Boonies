<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/listaProdutos.css">
    <title>Lista de Produtos</title>
</head>
<body>
    <div class="flex-container">
        <a class="logo" href="./index.php"><img src="./img/logo.png" alt="bonny's" width='150' height='150'></a>
        <h1>Lista de Produtos</h1>
    </div>
    <?php
    $banco = "dadosProduto.json";
    if (file_exists($banco)) {
        $extrair_dados = file_get_contents($banco);
        $produtos = json_decode($extrair_dados, true);

        echo "<ul class='product-list'>";
        foreach ($produtos as $index => $produto) {
            echo "<li class='product-item'>";
            echo "<a href='detalhesProduto.php?index=$index'><img src='./" . $produto['imagem'] . "' width='150'></a> <br>";
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
