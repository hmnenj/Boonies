<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
</head>
<body>
    <h1>Editar Cliente</h1>
    <?php
    $banco = "dadosCliente.json";
    if (isset($_GET['index']) && file_exists($banco)) {
        $index = $_GET['index'];
        $extrair_dados = file_get_contents($banco);
        $clientes = json_decode($extrair_dados, true);
        $cliente = $clientes[$index];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $clientes[$index]['nome'] = $_POST['nome'];
            $clientes[$index]['email'] = $_POST['email'];
            $clientes[$index]['CPF'] = $_POST['CPF'];
            $clientes[$index]['CEP'] = $_POST['CEP'];
            $clientes[$index]['senha'] = $_POST['senha'];

            $json = json_encode($clientes);
            if (file_put_contents($banco, $json)) {
                echo "<script type='text/javascript'>
                alert('Dados atualizados com sucesso!');
                window.location.href = 'listaClientes.php';
                </script>";
            } else {
                echo "Erro ao atualizar dados";
            }
        }
    ?>
    <form method="post">
        <div>
            <input type="text" name="nome" value="<?php echo $cliente['nome']; ?>" placeholder="Nome" required>
        </div>
        <div>
            <input type="email" name="email" value="<?php echo $cliente['email']; ?>" placeholder="Email" required>
        </div>
        <div>
            <input type="text" name="CPF" value="<?php echo $cliente['CPF']; ?>" placeholder="CPF" required>
        </div>
        <div>
            <input type="text" name="CEP" value="<?php echo $cliente['CEP']; ?>" placeholder="CEP" required>
        </div>
        <div>
            <input type="password" name="senha" value="<?php echo $cliente['senha']; ?>" placeholder="Senha" required>
        </div>
        <div>
            <button type="submit">Salvar Alterações</button>
        </div>
    </form>
    <?php
    } else {
        echo "Cliente não encontrado.";
    }
    ?>
    <a href="listaClientes.php">Voltar para lista de clientes</a>
</body>
</html>
