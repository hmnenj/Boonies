<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/carrinho.css">
    <title>Meu Carrinho</title>
</head>
<body>
    <h1>Meu Carrinho</h1>
    <?php
    session_start();

    if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
        $banco = "dadosProduto.json";
        $total = 0;

        if (file_exists($banco)) {
            $extrair_dados = file_get_contents($banco);
            $produtos = json_decode($extrair_dados, true);

            echo "<ul class='product-list'>";
            foreach ($_SESSION['carrinho'] as $index) {
                if (is_numeric($index) && isset($produtos[$index])) {
                    $produto = $produtos[$index];
                    $preco = floatval($produto['preco']);
                    $total += $preco;
                    echo "<li class='product-item'>";
                    if (isset($produto['imagem'])) {
                        echo "<img src='" . $produto['imagem'] . "' alt='" . $produto['nome'] . "' width='100'>";
                    }
                    echo "<span>" . $produto['nome'] . " - R$ " . number_format($preco, 2, ',', '.') . "</span>";
                    echo " <a href='removerCarrinho.php?index=$index'>Remover</a>";
                    echo "</li>";
                }
            }
            echo "</ul>";
            echo "<p class='total'><strong>Total: R$ " . number_format($total, 2, ',', '.') . "</strong></p>";
        } else {
            echo "Banco de dados não encontrado.";
        }

        echo "<form method='post' action='finalizarCompra.php'>";
        echo "<button type='submit'>Finalizar Compra</button>";
        echo "</form>";
    } else {
        echo "Ainda não há produtos no carrinho :(";
    }
    ?>
    <a href="listaProdutos.php" class="continue-shopping">Continuar Comprando</a>
</body>
</html>
