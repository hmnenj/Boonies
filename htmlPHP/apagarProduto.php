<?php
if (isset($_GET['index'])) {
    $index = $_GET['index'];
    $banco = "dadosProduto.json";

    if (file_exists($banco)) {
        $extrair_dados = file_get_contents($banco);
        $produtos = json_decode($extrair_dados, true);

        if (isset($produtos[$index])) {

            if (isset($produtos[$index]['imagem']) && !empty($produtos[$index]['imagem'])) {
                $imagem = "imagens/" . $produtos[$index]['imagem'];
                if (file_exists($imagem)) {
                    unlink($imagem);
                }
            }

            array_splice($produtos, $index, 1);
            $json = json_encode($produtos);
            if (file_put_contents($banco, $json)) {
                echo "<script type='text/javascript'>
                alert('Produto apagado com sucesso!');
                window.location.href = 'listaProdutos.php';
                </script>";
            } else {
                echo "Erro ao apagar produto";
            }
        } else {
            echo "Produto não encontrado.";
        }
    } else {
        echo "Banco de dados não encontrado.";
    }
} else {
    echo "Nenhum produto selecionado.";
}
?>
