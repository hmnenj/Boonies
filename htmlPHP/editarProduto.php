<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
</head>
<body>
    <h1>Editar Produto</h1>
    <?php
    $banco = "dadosProduto.json";
    if (isset($_GET['index']) && file_exists($banco)) {
        $index = $_GET['index'];
        $extrair_dados = file_get_contents($banco);
        $produtos = json_decode($extrair_dados, true);
        $produto = $produtos[$index];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $produtos[$index]['nome'] = $_POST['nome'];
            $produtos[$index]['preco'] = $_POST['preco'];
            $produtos[$index]['descricao'] = $_POST['descricao'];

            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
                $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
                $novo_nome = md5(uniqid()) . "." . $extensao;
                $diretorio = "imagens/";

                move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . $novo_nome);

                $produtos[$index]['imagem'] = $novo_nome;
            }

            $json = json_encode($produtos);
            if (file_put_contents($banco, $json)) {
                echo "<script type='text/javascript'>
                alert('Dados atualizados com sucesso!');
                window.location.href = 'produtosLista.php';
                </script>";
            } else {
                echo "Erro ao atualizar dados";
            }
        }
    ?>
    <form method="post" enctype="multipart/form-data">
        <div>
            <input type="text" name="nome" value="<?php echo $produto['nome']; ?>" placeholder="Nome" required>
        </div>
        <div>
            <input type="text" name="preco" value="<?php echo $produto['preco']; ?>" placeholder="Preço" required>
        </div>
        <div>
            <textarea name="descricao" placeholder="Descrição" required><?php echo $produto['descricao']; ?></textarea>
        </div>
        <div>
            <input type="file" name="imagem" placeholder="Imagem">
        </div>
        <div>
            <button type="submit">Salvar Alterações</button>
        </div>
    </form>
    <?php
    } else {
        echo "Produto não encontrado.";
    }
    ?>
    <a href="listaProdutos.php">Voltar para lista de produtos</a>
</body>
</html>
