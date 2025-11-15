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
	if ($dbObj->affectedRows () == 0) {
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
	$erro = "";
	if (!$nome) {
		$erro .= " Nome não pode ser vazio. ";
	}
	if (!$preco) {
		$erro .= " Preço não pode ser vazio. ";
	}
	if (!$erro) {
		$mysqli = new mysql();
		$sql = "";
		$sql .= " UPDATE prod SET ";
		$sql .= " nome = '" .$nome."' ";
		$sql .= " , ";
		$sql .= " preco = '".$preco."' ";
		$sql .= " , "; 
		$sql .= " categoria_id = '".$categoria_id."' ";
		$sql .= "WHERE id = '".$id."'; ";
		$result = $dbObj->query($sql);
		header("Location: ".SITE_URL."/admin/prod");
		exit;
	}
}
 
include(constant("SITE_ROOT")."/header.php");
 
?>
 
<h1>ADMIN - Editar Produto</h1>
 
<?php include(constant("SITE_ROOT")."/admin/menu.php"); ?>
 
<br><br>
 
<?php
if (isset($erro)) {
	echo "<span style=\"color: red; font-style: italic;\">";
	echo $erro;
	echo "</span>";
}
?>
 
 <?php
$dbObj = new mysql();
$sqlCategoria = "SELECT id, nome FROM categoria ORDER BY nome;";
$resultCategoria = $dbObj->query($sqlCategoria);
?>

<form method="POST">
	<td><input type="hidden" name="id" value="<?=isset($id)?$id:"";?>">
	<table>
		<tr>
			<td>Nome:</td>
			<td><input type="text" name="nome" value="<?=isset($nome)?$nome:"";?>"></td>
		<tr>
	<tr>
		<td>Preço:</td>
		<td><input type="text" name="preco" value="<?=isset($preco)?$preco:"";?>"></td>
	<tr>
		<tr>
			<td>Categoria:</td>
				<td>
				<select name="categoria_id">
				<option value="">Selecione uma categoria</option>
					<?php
					  while ($cat = mysqli_fetch_assoc($resultCategoria)) {
						$selected = ($cat["id"] == $categoria_id) ? "selected" : "";
						echo "<option value='".$cat["id"]."' $selected>".$cat["nome"]."</option>";
					  }
					  ?>
				</select>
				</td>
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