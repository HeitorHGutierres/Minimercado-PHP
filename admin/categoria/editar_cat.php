<?php

include("../../config.inc.php");
include(constant("SITE_ROOT")."/admin/config.inc.php");
include(constant("SITE_ROOT")."/admin/funcao.php");
validaSessao();

$id = $_GET["id"]?$_GET["id"]:$_POST["id"];
if ($id > 0) {
	$dbObj = new mysql();
	$sql = "";
	$sql .= "SELECT * FROM categoria WHERE id = ".$id.";";
	$result = $dbObj->query($sql);
	if ($dbObj->affectedRows() == 0) {
		header("Location: ".SITE_URL."/admin/categoria");
		exit;
	}
	$row = mysqli_fetch_assoc($result);
	extract($row);
} else {
	header("Location: ".SITE_URL."/admin/categoria");
	exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	extract($_POST);
	
	$erro = "";
	if (!$nome) {
		$erro .= " Nome não pode ser vazio. ";
	}
	
	if (!$erro) {
		$dbObj = new mysql();
		$sql = "";
		$sql .= " UPDATE categoria SET ";
		$sql .= " nome = '".$nome."' ";
		$sql .= " WHERE id = '".$id."'; ";
		$result = $dbObj->query($sql);
		header("Location: ".SITE_URL."/admin/categoria/index_cat.php");
		exit;
	}
	
}

include(constant("SITE_ROOT")."/header.php");

?>

<h1>ADMIN - Editar Categoria</h1>

<?php include(constant("SITE_ROOT")."/admin/menu.php"); ?>

<br><br>

<?php
if (isset($erro)) {
	echo "<span style=\"color: red; font-style: italic;\">";
	echo $erro;
	echo "</span>";
}
?>

<form method="POST">
	<input type="hidden" name="id" value="<?=isset($id)?$id:"";?>">
	<table>
		<tr>
			<td>Nome:</td>
			<td><input type="text" name="nome" value="<?=isset($nome)?$nome:"";?>"></td>
		<tr>
		<tr>
			<td>
				&nbsp;
			</td>
			<td>
				<input type="submit" name="submit" value="Editar">
			</td>
		</tr>
	</table>
</form>

<?php include(constant("SITE_ROOT")."/footer.php"); ?>
