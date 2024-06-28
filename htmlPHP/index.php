<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>bonny´s</title>
</head>
<header> 
    <div class>
            <button><a href="./cadastroCliente.php">Quero comprar</a></button>
    </div> 
    <div>
        <button><a href="./cadastroProduto.php">Quero Vender</a></button>
    </div>
    <div class="search">
        <form action="#">
            <input type ="text" placeholder="pesquisar:" name="search">
        </form>
    </div>
   <div><a href="./carrinho.php">meus pedidos</a></div>
</header>

<body>
    <div class=logo>
    <h1>bonny's</h1>
     <img src="./img/bonnys.png" alt="bonny's">
    </div>
    <h1>bem-vindos!</h1>
    <br>
    <h1>lista de produtos</h1>
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
</body>
</html>