<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/logincliente.css">
    <title>Boonies - Login</title>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form method="post">
            <div>
                <label for="email">E-mail </label>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="senha">Senha </label>
                <input type="password" name="senha" id="senha" required>
            </div>
            <div>
                <button type="submit">Entrar</button>
            </div>
        </form>
        <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $adm = "adm@gmail.com";
        $senhaadm = "senha123";

        $banco = "dadosCliente.json";
        if (file_exists($banco)) {
            $extrair_dados = file_get_contents($banco);
            $dados = json_decode($extrair_dados, true);

            $usuario_encontrado = false;
            $adm_encontrado = false;

            // Verificação de administrador
            if ($email === $adm && $senha === $senhaadm) {
                $adm_encontrado = true;
            } else {
                // Verificação de usuário comum
                foreach ($dados as $usuario) {
                    if ($usuario['email'] === $email && $usuario['senha'] === $senha) {
                        $usuario_encontrado = true;
                        break;
                    }
                }
            }

            if ($adm_encontrado) {
                $url = 'inicioVendedor.php';
                echo "<script type='text/javascript'>
                alert('Login de administrador realizado com sucesso!');
                window.location.href = '$url';
                </script>";
            } elseif ($usuario_encontrado) {
                $url = 'inicioCliente.php';
                echo "<script type='text/javascript'>
                alert('Login realizado com sucesso!');
                window.location.href = '$url';
                </script>";
            } else {
                echo "E-mail ou senha incorretos.";
            }
        } else {
            echo "Banco de dados não encontrado.";
        }
    }
    ?>
        <a class="semconta" href="./cadastroCliente.php">Ainda não tem uma conta?</a>
    </div>
</body>
</html>
