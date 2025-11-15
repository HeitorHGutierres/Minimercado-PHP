<?php
session_start();

include("../config.inc.php");
include(constant("SITE_ROOT")."/admin/config.inc.php");
include(constant("SITE_ROOT")."/admin/funcao.php");

$mensagem = "";
$username = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = md5($_POST["password"]); // Usando MD5 conforme seu sistema

    // Verificar se o usuário existe
    $dbObj = new mysql();
    $sql = "SELECT * FROM conta WHERE username = '$username' AND password = '$password'";
    $result = $dbObj->query($sql);

    if ($dbObj->affectedRows() > 0) {
        $user = mysqli_fetch_assoc($result);
        // Registra os dados essenciais na sessão
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_admin'] = $user['is_admin'];

        header("Location: ./index.php");
        exit;
    } else {
        $mensagem = "Username ou Password incorreto!";
    }
}

include(constant("SITE_ROOT") . "/header.php");
?>

<form name="formLogin" method="POST">
<table>
<tr>
    <td colspan="2" style="color: red; font-style: italic;">
        <?=isset($mensagem)?$mensagem:"";?>
    </td>
</tr>
<tr>
    <td>Username:</td>
    <td>
        <input type="text" name="username" value="<?=htmlspecialchars($username);?>">
    </td>
</tr>
<tr>
    <td>Password:</td>
    <td>
        <input type="password" name="password">
    </td>
</tr>
<tr>
    <td colspan="2">
        <input type="submit" name="submit" value="Entrar">
    </td>
</tr>
</table>
</form>

<script>
if (document.formLogin.username.value) {
    document.formLogin.password.focus();
} else {
    document.formLogin.username.focus();
}
</script>

<?php include(constant("SITE_ROOT") . "/footer.php"); ?>
