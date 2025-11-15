<?php

include("../../config.inc.php");
include(constant("SITE_ROOT")."/admin/config.inc.php");
include(constant("SITE_ROOT")."/admin/funcao.php");
validaSessao();

$id = $_GET["id"]?$_GET["id"]:$_POST["id"];
if ($id > 0) {
	$dbObj = new mysql();
	$sql = "";
$user_id = $_SESSION['user_id'];
$is_admin = $_SESSION['is_admin'];

if ($is_admin) {
    $sql = "SELECT * FROM prod WHERE id = $id;";
} else {
    $sql = "SELECT * FROM prod WHERE id = $id AND conta_id = $user_id;";
}
	$result = $dbObj->query($sql);
	if ($dbObj->affectedRows() == 0) {
		header("Location: ".SITE_URL."/admin/prod");
		exit;
	}
	$row = mysqli_fetch_assoc($result);
	extract($row);
} else {
	header("Location: ".SITE_URL."/admin/prod");
	exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	extract($_POST);
	
	$dbObj = new mysql();
	$sql = "";
	$sql .= " DELETE FROM prod ";
	$sql .= " WHERE id = '".$id."'; ";
	$result = $dbObj->query($sql);
	header("Location: ".SITE_URL."/admin/prod");
	exit;
	
}

include(constant("SITE_ROOT")."/header.php");

?>

<h1>ADMIN - Apagar Produto</h1>

<?php include(constant("SITE_ROOT")."/admin/menu.php"); ?>

<br><br>

<form method="POST">
	<input type="hidden" name="id" value="<?=isset($id)?$id:"";?>">
	<table>
		<tr>
			<td colspan="2">Você tem certeza que quer apagar o produto "<?=isset($nome)?$nome:"";?>"?</td>
		<tr>
		<tr>
			<td align="right">
				<input type="submit" name="submit" value="Sim">
			</td>
			<td>
				<a href="<?=SITE_URL;?>/admin/prod"><input type="button" value="Não"></a>
			</td>
		</tr>
	</table>
</form>

<?php include(constant("SITE_ROOT")."/footer.php"); ?>
