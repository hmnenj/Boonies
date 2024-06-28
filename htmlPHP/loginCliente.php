<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/logincliente.css">
    <title>Boonies - Login</title>
</head>
<body>
    <div class="logo">
     <center><a href= ./index.php><img src="./img/ebonnys.png" alt="ebonny's"></center>
    </div>
    <center><form method="post">
        <div>
            <label for="email">E-mail </label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="senha">Senha </label>
            <input type="password" name="senha" id="senha" required>
        </div>
        <div>
            <button type="submit">entrar</button>
        </div>
    </form></center>
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


            if ($email === $adm && $senha === $senhaadm) {
                $adm_encontrado = true;
            } else {

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
                alert('login de administrador realizado com sucesso!');
                window.location.href = '$url';
                </script>";
            } elseif ($usuario_encontrado) {
                $url = 'inicioCliente.php';
                echo "<script type='text/javascript'>
                alert('login realizado com sucesso!');
                window.location.href = '$url';
                </script>";
            } else {
                echo "e-mail ou senha incorretos.";
            }
        } else {
            echo "banco de dados não encontrado.";
        }
    }
    ?>
   <center> <a class="semconta" href="./cadastroCliente.php">ainda não tem uma conta?</a></center>
</body>
</html>
