<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/cadastroCliente.css">
    <title>Boonies - Cadastro Cliente</title>
    <script>
        function aplicarMascaraCPF(input) {
            let value = input.value;
            value = value.replace(/\D/g, "");
            value = value.replace(/(\d{3})(\d)/, "$1.$2");
            value = value.replace(/(\d{3})(\d)/, "$1.$2");
            value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
            input.value = value;
        }

        function aplicarMascaraCEP(input) {
            let value = input.value;
            value = value.replace(/\D/g, "");
            value = value.replace(/(\d{5})(\d{1,3})$/, "$1-$2");
            input.value = value;
        }
    </script>
</head>
<body>
    <div class="container">
    <h1>Boonies - Cadastro Cliente</h1>

    <form method="post">
        <div>
            <input type="text" name="nome" id="nome" placeholder="Nome" required>
        </div>
        <div>
            <input type="email" name="email" id="email" placeholder="E-mail" required>
        </div>
        <div>
            <input type="text" name="CPF" id="CPF" placeholder="CPF" required oninput="aplicarMascaraCPF(this)">
        </div>
        <div>
            <input type="text" name="CEP" id="CEP" placeholder="CEP" required oninput="aplicarMascaraCEP(this)">
        </div>
        <div>
            <input type="password" name="senha" id="senha" placeholder="Senha" required>
        </div>
        <div>
            <button type="submit">Cadastrar-se</button>
        </div>
    </form>

    <a class="jaconta" href="./loginCliente.php">Já tem uma conta?</a>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $CPF = $_POST['CPF'];
        $CEP = $_POST['CEP'];
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
            'CPF' => $CPF,
            'CEP' => $CEP,
            'senha' => $senha
        ];
        $dados[] = $novo_dado;
        $json = json_encode($dados);
 
        if (file_put_contents($banco, $json)) {
            $url = 'inicioCliente.php';
            echo "<script type='text/javascript'>
            alert('Dados cadastrados com sucesso!');
            window.location.href = '$url';
            </script>";
        } else {
            echo "Erro ao cadastrar";
        }
    }
    ?>
</body>
</html>
