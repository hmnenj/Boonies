<?php
session_start();

if (isset($_GET['index'])) {
    $index = $_GET['index'];

    if (isset($_SESSION['carrinho'])) {
        $carrinho = $_SESSION['carrinho'];
        if (($key = array_search($index, $carrinho)) !== false) {
            unset($carrinho[$key]);
        }
        $_SESSION['carrinho'] = array_values($carrinho);
    }

    echo "<script type='text/javascript'>
    alert('Produto removido do carrinho!');
    window.location.href = 'carrinho.php';
    </script>";
} else {
    echo "Produto não encontrado.";
}
?>
