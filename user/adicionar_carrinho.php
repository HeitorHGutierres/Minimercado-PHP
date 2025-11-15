<?php
// Recebe o ID do produto
if (isset($_GET['id'])) {
    $id_produto = (int)$_GET['id'];

    // Verifica se já existe um cookie
    if (isset($_COOKIE['carrinho'])) {
        $carrinho = json_decode($_COOKIE['carrinho'], true);
    } else {
        $carrinho = [];
    }

    // Incrementa a quantidade se o produto já estiver no carrinho
    if (isset($carrinho[$id_produto])) {
        $carrinho[$id_produto]++;
    } else {
        $carrinho[$id_produto] = 1;
    }

    // Salva novamente o cookie (expira em 7 dias)
    setcookie('carrinho', json_encode($carrinho), time() + (86400 * 7), "/");
}

// Redireciona de volta para a página de produtos
header("Location: index.php"); 
exit;
