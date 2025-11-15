<?php
setcookie('carrinho', '', time() - 3600, "/"); // expira o cookie
header("Location: carrinho.php");
exit;
