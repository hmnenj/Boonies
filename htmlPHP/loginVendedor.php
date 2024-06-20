<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boonies - Login Vendedor</title>
</head>
<body>
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

        $banco = "dadosVendedor.json";
        if (file_exists($banco)) {
            $extrair_dados = file_get_contents($banco);
            $dados = json_decode($extrair_dados, true);
            
            $usuario_encontrado = false;
            foreach ($dados as $usuario) {
                if ($usuario['email'] === $email && $usuario['senha'] === $senha) {
                    $usuario_encontrado = true;
                    break;
                }
            }
            
            if ($usuario_encontrado) {
                echo "Login realizado com sucesso!";
                header("Location: inicioVendedor.php");
                exit;
            } else {
                echo "E-mail ou senha incorretos.";
            }
        }
    }
    ?>
    <a href="./cadastroVendedor.php">Ainda não tem uma conta?</a>
</body>
</html>
