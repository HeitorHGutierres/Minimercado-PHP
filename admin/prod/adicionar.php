<?php
 
include("../../config.inc.php");
include(constant("SITE_ROOT")."/admin/config.inc.php");
include(constant("SITE_ROOT")."/admin/funcao.php");
validaSessao();
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	extract($_POST);
	
	$erro = "";
	if (!$nome) 
	{
		$erro .= " Nome não pode ser vazio. ";
	}
	if (!$preco) 
	{
		$erro .= " Preço não pode ser vazio. ";
	}
	if (!$erro) {
		$dbObj = new mysql();
		$sql = "";
		$conta_id = $_SESSION['user_id'];
		$sql .= " INSERT INTO prod ";
		$sql .= " (nome, preco, categoria_id, conta_id) ";
		$sql .= " VALUES ";
		$sql .= " ('".$nome."', '".$preco."', '".$categoria_id."', '".$conta_id."')";
		$result = $dbObj->query($sql);
		header("Location: ".SITE_URL."/admin/prod");
		exit;
	}
}
 
include(constant("SITE_ROOT")."/header.php");
 
?>
 
<h1>ADMIN - Adicionar Produto</h1>
 
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
						echo "<option value='".$cat["id"]."'>".$cat["nome"]."</option>";
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
		<input type="submit" name="submit" value="Adicionar">
	</td>
		</tr>
	</table>
</form>
 
<?php include(constant("SITE_ROOT")."/footer.php"); ?>