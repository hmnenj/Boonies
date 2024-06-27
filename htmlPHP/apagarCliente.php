<?php
if (isset($_GET['index'])) {
    $index = $_GET['index'];
    $banco = "dadosCliente.json";

    if (file_exists($banco)) {
        $extrair_dados = file_get_contents($banco);
        $clientes = json_decode($extrair_dados, true);

        if (isset($clientes[$index])) {
            array_splice($clientes, $index, 1);
            $json = json_encode($clientes);
            if (file_put_contents($banco, $json)) {
                echo "<script type='text/javascript'>
                alert('Cliente apagado com sucesso!');
                window.location.href = 'listaClientes.php';
                </script>";
            } else {
                echo "Erro ao apagar cliente";
            }
        } else {
            echo "Cliente não encontrado.";
        }
    } else {
        echo "Banco de dados não encontrado.";
    }
} else {
    echo "Nenhum cliente selecionado.";
}
?>
