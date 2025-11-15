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
	
	$dbObj = new mysql();
	$sql = "";
	$sql .= " DELETE FROM categoria ";
	$sql .= " WHERE id = '".$id."'; ";
	$result = $dbObj->query($sql);
	header("Location: ".SITE_URL."/admin/categoria/index_cat.php");
	exit;
	
}

include(constant("SITE_ROOT")."/header.php");

?>

<h1>ADMIN - Apagar Categoria</h1>

<?php include(constant("SITE_ROOT")."/admin/menu.php"); ?>

<br><br>

<form method="POST">
	<input type="hidden" name="id" value="<?=isset($id)?$id:"";?>">
	<table>
		<tr>
			<td colspan="2">Você tem certeza que quer apagar a categoria "<?=isset($nome)?$nome:"";?>"?</td>
		<tr>
		<tr>
			<td align="right">
				<input type="submit" name="submit" value="Sim">
			</td>
			<td>
				<a href="<?=SITE_URL;?>/admin/categoria"><input type="button" value="Não"></a>
			</td>
		</tr>
	</table>
</form>

<?php include(constant("SITE_ROOT")."/footer.php"); ?>
