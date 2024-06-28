<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/produto.css">

    <title>lista de produtos</title>
</head>
<body>
    <div class= "flex-container">
<a class= "logo" href= ./index.php><img src="./img/logo.png" alt="bonny's"></a>
<h1>lista de produtos</h1></div>
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
        echo "nenhum produto cadastrado.";
    }
    ?>
</body>
</html>
