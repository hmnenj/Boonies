<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boonies</title>
</head>
<body>
    <h1>Boonies - Cadastro Cliente</h1>
    <form method="post">
        <div>
            <input type="text" name="nome" id="nome" placeholder="nome">
        </div>
        <div>
            <input type="email" name="email" id="email" placeholder="email">
        </div>
        <div>
            <input type="password" name="senha" id="senha" placeholder="sena">
        </div>
        <div>
            <button type="submit">Cadastrar-se</button>
        </div>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
 
        $banco = "dadosCliente.json";
        $dados = [];
        if (file_exists($banco)) {
            $extrair_dados = file_get_contents($banco);
            $dados = json_decode($extrair_dados, true);
        }
        $novo_dado = [
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha
        ];
        $dados[] = $novo_dado;
        $json = json_encode($dados);
 
        if (file_put_contents($banco, $json)) {
            echo "Dados cadastrados com sucesso!";
            header("Location: inicioCliente.html");
        }
    }
    ?>
    <a href="./loginCliente.php">Já tem uma conta?</a>
</body>
</html>
