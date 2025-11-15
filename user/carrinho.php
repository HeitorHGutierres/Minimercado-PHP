<?php
include("../config.inc.php");
include(constant("SITE_ROOT")."/user/config.inc.php");
include(constant("SITE_ROOT")."/header.php");

echo "<h1>Seu Carrinho</h1>";

if (!isset($_COOKIE['carrinho'])) {
    echo "<p>Seu carrinho está vazio.</p>";
} else {
    $carrinho = json_decode($_COOKIE['carrinho'], true);

    if (empty($carrinho)) {
        echo "<p>Seu carrinho está vazio.</p>";
    } else {
        $dbObj = new mysql();

        // Monta os IDs dos produtos
        $ids = implode(",", array_keys($carrinho));
        $sql = "SELECT * FROM prod WHERE id IN ($ids)";
        $result = $dbObj->query($sql);

        echo "<table border='1px'>";
        echo "<tr><th>Produto</th><th>Preço</th><th>Quantidade</th><th>Subtotal</th></tr>";

        $total = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["id"];
            $quantidade = $carrinho[$id];
            $subtotal = $quantidade * $row["preco"];
            $total += $subtotal;

            echo "<tr>";
            echo "<td>".$row["nome"]."</td>";
            echo "<td>R$ ".number_format($row["preco"], 2, ',', '.')."</td>";
            echo "<td>".$quantidade."</td>";
            echo "<td>R$ ".number_format($subtotal, 2, ',', '.')."</td>";
            echo "</tr>";
        }

        echo "<tr><td colspan='3'><strong>Total</strong></td><td><strong>R$ ".number_format($total, 2, ',', '.')."</strong></td></tr>";
        echo "</table>";

        echo "<p><a href='limpar_carrinho.php'>🗑️ Esvaziar Carrinho</a></p>";
		echo "<p><a href='fim.php'>Finalizar compra</a></p>";
    }
}
echo "<p><a href='index.php'>Voltar</a></p>";
include(constant("SITE_ROOT")."/footer.php");
?>
