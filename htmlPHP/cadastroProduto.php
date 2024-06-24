<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boonies - Cadastro de Produto</title>
</head>
<body>
<h1>Boonies - Cadastro de Produto</h1>
    <form method="post" enctype="multipart/form-data">
        <div>
            <input type="text" name="nome" id="nome" placeholder="Nome do Produto" required>
        </div>
        <div>
            <input type="number" name="preco" id="preco" placeholder="Preço" required>
        </div>
        <div>
            <textarea name="descricao" id="descricao" placeholder="Descrição" required></textarea>
        </div>
        <div>
            <input type="text" name="categoria" id="categoria" placeholder="Categoria" required>
        </div>
        <div>
            <input type="file" name="imagem" id="imagem" required>
        </div>
        <div>
            <button type="submit">Cadastrar Produto</button>
        </div>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $descricao = $_POST['descricao'];
        $categoria = $_POST['categoria'];
        
        $imagem = $_FILES['imagem'];
        $imagemNome = $imagem['name'];
        $imagemTmp = $imagem['tmp_name'];
        $imagemDestino = 'uploads/' . $imagemNome;

        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }
   
        if (move_uploaded_file($imagemTmp, $imagemDestino)) {
            $banco = "dadosProduto.json";
            $dados = [];
            if (file_exists($banco)) {
                $extrair_dados = file_get_contents($banco);
                $dados = json_decode($extrair_dados, true);
            }
            $novo_dado = [
                'nome' => $nome,
                'preco' => $preco,
                'descricao' => $descricao,
                'categoria' => $categoria,
                'imagem' => $imagemDestino
            ];
            $dados[] = $novo_dado;
            $json = json_encode($dados);

            if (file_put_contents($banco, $json)) {
                echo "<script type='text/javascript'>
                alert('Produto cadastrado com sucesso!');
                </script>";
            } else {
                echo "Erro ao cadastrar produto";
            }
        } else {
            echo "Erro ao fazer upload da imagem";
        }
    }
    ?>
</body>
</html>
