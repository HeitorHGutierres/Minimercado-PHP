<?php
include("../config.inc.php");
include(constant("SITE_ROOT")."/user/config.inc.php");
include(constant("SITE_ROOT")."/header.php");

$dbObj = new mysql();
$sqlCategoria = "SELECT id, nome FROM categoria ORDER BY nome;";
$resultCategoria = $dbObj->query($sqlCategoria);
 
?>

<h1> USER </h1>

	<form method="GET">
	<input type="text" name="kw" value="<?=isset($_GET["kw"])?$_GET["kw"]:"";?>">
	<input type="submit" value="Buscar">
	</form>
 
	<?php
	$sql = "SELECT prod.*, categoria.nome AS nome_categoria FROM prod 
			LEFT JOIN categoria ON prod.categoria_id = categoria.id 
			WHERE 1=1 ";
	if (isset($_GET["kw"]) && $_GET["kw"]) {
		$kw = $_GET["kw"];
		$sql .= " AND (prod.nome LIKE '%$kw%' OR categoria.nome LIKE '%$kw%') ";
	}
	if (isset($_GET["categoria_id"]) && $_GET["categoria_id"]) {
		$sql .= " AND categoria_id = '".$_GET["categoria_id"]."' ";
	}
	 
	$sql .= " ORDER BY prod.nome;";
	$result = $dbObj->query($sql);
	?>
 
	<form method="GET">
	<input type="hidden" name="kw" value="<?=isset($_GET["kw"])?$_GET["kw"]:"";?>">
	<select name="categoria_id" onchange="this.form.submit()">
	<option value="">Todas as categorias</option>
	<?php
			mysqli_data_seek($resultCategoria, 0);
			while ($cat = mysqli_fetch_assoc($resultCategoria)) {
				$selected = (isset($_GET["categoria_id"]) && $_GET["categoria_id"] == $cat["id"]) ? "selected" : "";
				echo "<option value='".$cat["id"]."' $selected>".$cat["nome"]."</option>";
			}
			?>
	</select>
	</form>
 
	<table border="1px">
    <tr>
        <th>Nome</th>
        <th>Preço</th>
        <th>Ações</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row["nome"]; ?></td>
            <td>R$ <?= number_format($row["preco"], 2, ',', '.'); ?></td>
            <td>
                <a href="adicionar_carrinho.php?id=<?= $row['id']; ?>">Adicionar ao Carrinho</a>
            </td>
        </tr>
    <?php } ?>
</table>
<a style="color: blue;" href="<?=SITE_URL;?>/user/carrinho.php">VER CARRINHO</a>

 
<?php	include(constant("SITE_ROOT")."/footer.php");?>