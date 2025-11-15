<?php
include("../../config.inc.php");
include(constant("SITE_ROOT")."/admin/config.inc.php");
include(constant("SITE_ROOT")."/admin/funcao.php");
validaSessao();
include(constant("SITE_ROOT")."/header.php");
?>
<h1>ADMIN</h1>
<?php
include(constant("SITE_ROOT")."/admin/menu.php");
?>
<p>ADMIN - Categorias</p>
<p><a href="<?=constant("SITE_URL");?>/admin/categoria/adicionar_cat.php">+ ADICIONAR CATEGORIA</a></p>

<?php
$dbObj = new mysql();
$sql = "";
$sql .= "SELECT * FROM categoria ORDER BY nome;";
$result = $dbObj->query($sql);
?>
<table border="1px">
	<tr>
		<th>
			Nome
		</th>
		<th>
			Apagar
		</th>
		<th>
			Editar
		</th>
	</tr>
	<?php
	while ($row = mysqli_fetch_assoc($result)) {
		echo "<tr>";
			echo "<td>";
				echo $row["nome"];
			echo "</td>";
			echo "<td>";
				echo "<a href='".constant("SITE_URL")."/admin/categoria/apagar_cat.php?id=".$row["id"]."'>apagar</a>";
			echo "</td>";
			echo "<td>";
				echo "<a href='".constant("SITE_URL")."/admin/categoria/editar_cat.php?id=".$row["id"]."'>editar</a>";
			echo "</td>";
		echo "</tr>";
		}
	?>
</table>
<?php
include(constant("SITE_ROOT")."/footer.php");
?>
