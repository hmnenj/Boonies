<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boonies - Cadastro Vendedor</title>
    <script>
        function aplicarMascaraCNPJ(input) {
            let value = input.value;
            value = value.replace(/\D/g, "");
            value = value.replace(/(\d{2})(\d)/, "$1.$2");
            value = value.replace(/(\d{3})(\d)/, "$1.$2");
            value = value.replace(/(\d{3})(\d{1,4})/, "$1/$2");
            value = value.replace(/(\d{4})(\d{1,2})$/, "$1-$2");
            input.value = value;
        }
    </script>
</head>
<body>
<h1>Boonies - Cadastro Vendedor</h1>
    <form method="post">
        <div>
            <input type="text" name="nome" id="nome" placeholder="nome" required>
        </div>
        <div>
            <input type="email" name="email" id="email" placeholder="email" required>
        </div>
        <div>
            <input type="password" name="senha" id="senha" placeholder="senha" required>
        </div>
        <div>
            <input type="text" name="CNPJ" id="CNPJ" placeholder="CNPJ" required oninput="aplicarMascaraCNPJ(this)" maxlength="18">
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
        $CNPJ = $_POST['CNPJ'];
 
        $banco = "dadosVendedor.json";
        $dados = [];
        if (file_exists($banco)) {
            $extrair_dados = file_get_contents($banco);
            $dados = json_decode($extrair_dados, true);
        }
        $novo_dado = [
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha,
            'CNPJ' => $CNPJ
        ];
        $dados[] = $novo_dado;
        $json = json_encode($dados);
 
        if (file_put_contents($banco, $json)) {
            $url = 'inicioVendedor.php';
            echo "<script type='text/javascript'>
            alert('Dados cadastrados com sucesso!');
            window.location.href = '$url';
            </script>";
        } else {
            echo "Erro ao cadastrar";
        }
    }
    ?>
    <a href="./loginVendedor.php">Já tem uma conta?</a>
</body>
</html>
