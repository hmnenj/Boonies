<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bonny´s</title>
    <link rel="stylesheet" href="./css/inicioCliente.css">
</head>

<body>
    <header>
        <div class="flex-container">
            <div>
                <button><a href="./listaProdutos.php">Produtos</a></button>
            </div>
            <div class="carrinho">
                <a href="./carrinho.php">Carrinho</a>
            </div>
        </div>
    </header>

    <div class="logo">
        <center><img src="./img/bonnys.png" alt="bonny's"></center>
    </div>

    <h1>lista de produtos:</h1>
    <?php
    $banco = "dadosProduto.json";
    if (file_exists($banco)) {
        $extrair_dados = file_get_contents($banco);
        $produtos = json_decode($extrair_dados, true);

        echo "<ul class='product-list'>";
        foreach ($produtos as $index => $produto) {
            echo "<li class='product-item'>";
            echo "<a href='detalhesProduto.php?index=$index'><img src='./" . $produto['imagem'] . "' width='200'></a><br>";
            echo "<a href='detalhesProduto.php?index=$index'>" . $produto['nome'] . "</a>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "nenhum produto cadastrado.";
    }
    ?>
</body>
</html>
