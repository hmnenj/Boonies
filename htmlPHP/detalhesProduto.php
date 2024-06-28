<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>detalhes do produto</title>
    <link rel="stylesheet" href="./css/detalhes.css">
</head>
<body>
    <div class="container">
    <h1>detalhes do produto</h1>
    <?php
    session_start();

    if (isset($_GET['index'])) {
        $index = $_GET['index'];
        $banco = "dadosProduto.json";

        if (file_exists($banco)) {
            $extrair_dados = file_get_contents($banco);
            $produtos = json_decode($extrair_dados, true);

            if (isset($produtos[$index])) {
                $produto = $produtos[$index];
                if (isset($produto['imagem'])) {
                    echo "<img src='" . $produto['imagem'] . "' alt='" . $produto['nome'] . "' width='200'></p>";
                }
                echo "<div class = 'detalhes'><p>Nome: " . $produto['nome'] . "</p>", "</div>";
                echo "<div class = 'detalhes'><p>Preço: " . $produto['preco'] . "</p>", "</div>";
                echo "<div class = 'detalhes'><p>Descrição: " . $produto['descricao'] . "</p>", "</div>";
                echo "<div class = 'detalhes'><p>Categoria: " . $produto['categoria'] . "</p>", "</div>";
                echo "<div class = 'detalhes'><form method='post' action='adicionarCarrinho.php'>", "</div>";
                echo "<div class = 'detalhes'><input type='hidden' name='index' value='$index'>", "</div>";
                echo "<div class=carrinho><button type='submit'><img src= './img/carrinho.png'></button></div>";
                echo "</form>";
            } else {
                echo "produto não encontrado.";
            }
        } else {
            echo "banco de dados não encontrado.";
        }
    } else {
        echo "nenhum produto selecionado.";
    }
    ?>
    <a href="listaProdutos.php">voltar para lista de produtos</a>
    </div>
</body>
</html>
