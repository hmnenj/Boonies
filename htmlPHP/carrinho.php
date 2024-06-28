<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>meus pedidos</title>
</head>
<body>
    <h1>meus pedidos</h1>
    <?php
    session_start();

    if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
        $banco = "dadosProduto.json";
        $total = 0;

        if (file_exists($banco)) {
            $extrair_dados = file_get_contents($banco);
            $produtos = json_decode($extrair_dados, true);

            echo "<ul>";
            foreach ($_SESSION['carrinho'] as $index) {
                if (is_numeric($index) && isset($produtos[$index])) {
                    $produto = $produtos[$index];
                    $preco = floatval($produto['preco']);
                    $total += $preco;
                    echo "<li>";
                    if (isset($produto['imagem'])) {
                        echo "<img src='" . $produto['imagem'] . "' alt='" . $produto['nome'] . "' width='50'>";
                    }
                    echo $produto['nome'] . " - R$ " . number_format($preco, 2, ',', '.');
                    echo " <a href='removerCarrinho.php?index=$index'>remover</a>";
                    echo "</li>";
                }
            }
            echo "</ul>";
            echo "<p><strong>Total: R$ " . number_format($total, 2, ',', '.') . "</strong></p>";
        } else {
            echo "Banco de dados não encontrado.";
        }

        echo "<form method='post' action='finalizarCompra.php'>";
        echo "<button type='submit'>finalizar compra!</button>";
        echo "</form>";
    } else {
        echo "ainda não há pedidos :(";
    }
    ?>
    <a href="listaProdutos.php">continuar comprando</a>
</body>
</html>
