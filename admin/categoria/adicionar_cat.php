<?php

include("../../config.inc.php");
include(constant("SITE_ROOT")."/admin/config.inc.php");
include(constant("SITE_ROOT")."/admin/funcao.php");
validaSessao();



if ($_SERVER["REQUEST_METHOD"] == "POST") {

	extract($_POST);

	$erro = "";

	if (!$nome) {

		$erro .= " Nome não pode ser vazio. ";

	}

	if (!$erro) {

		$dbObj = new mysql();

		$sql = "";

		$sql .= " INSERT INTO categoria ";

		$sql .= " (nome) ";

		$sql .= " VALUES ";

		$sql .= " ('".$nome."')";

		$result = $dbObj->query($sql);

		header("Location: ".SITE_URL."/admin/categoria/index_cat.php");

		exit;

	}

}

include(constant("SITE_ROOT")."/header.php");

?>
 

<h1 >ADMIN - Adicionar Categoria</h1>
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
<input type="submit" name="submit" value="Adicionar">
</td>
</tr>
</table>
</form>
</div>
</div>
<?php include(constant("SITE_ROOT")."/footer.php"); ?>