<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['index'])) {
        $index = $_POST['index'];


        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }


        if (!in_array($index, $_SESSION['carrinho'])) {
            $_SESSION['carrinho'][] = $index;
        }

        echo "<script type='text/javascript'>
        alert('Produto adicionado ao carrinho!');
        window.location.href = 'carrinho.php';
        </script>";
    } else {
        echo "Produto não encontrado.";
    }
} else {
    echo "Requisição inválida.";
}
?>
