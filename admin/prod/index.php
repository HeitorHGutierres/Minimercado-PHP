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
<h1>ADMIN - Produtos</h1>
<p><a href="<?=constant("SITE_URL");?>/admin/prod/adicionar.php">+ ADICIONAR</a></p>

<?php
$dbObj = new mysql();
$user_id = $_SESSION['user_id'];
$is_admin = $_SESSION['is_admin'];

if ($user_id == 1) {
    $sql = "SELECT * FROM prod ORDER BY nome;";
} else {
    $sql = "SELECT * FROM prod WHERE conta_id = $user_id ORDER BY nome;";
}

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
				echo "<a href = '".constant("SITE_URL")."/admin/prod/apagar.php?id=".$row["id"]."'>apagar</a>";
			echo "</td>";
			echo "<td>";
				echo "<a href = '".constant("SITE_URL")."/admin/prod/editar.php?id=".$row["id"]."'>editar</a>";
			echo "</td>";
		echo "</tr>";
		}
	?>
</table>

<p><a href="<?=constant("SITE_URL");?>/admin/prod/adicionar.php">+ ADICIONAR</a></p>
<?php 
	include(constant("SITE_ROOT")."/footer.php");
?>