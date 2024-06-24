<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
</head>
<body>
    <h1>Detalhes do Produto</h1>
    <?php
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
                echo "<p>Nome: " . $produto['nome'] . "</p>";
                echo "<p>Preço: " . $produto['preco'] . "</p>";
                echo "<p>Descrição: " . $produto['descricao'] . "</p>";
                echo "<p>Categoria: " . $produto['categoria'] . "</p>";

            } else {
                echo "Produto não encontrado.";
            }
        } else {
            echo "Banco de dados não encontrado.";
        }
    } else {
        echo "Nenhum produto selecionado.";
    }
    ?>
    <a href="listaProdutos.php">Voltar para lista de produtos</a>
</body>
</html>
