<?php

/**
 * THE LOGIN PAGE FOR ACCESS TO THE ADMIN PART
 */

$title = "Enregistrement administrateur site de l'écrivain Jean Forteroche";
ob_start();
?>

<div id="login_page">
<h1>Page administrateur</h1>
<form action="index.php?pge=admin" method="POST" id="log_form">
    <input type="text" name="idAdmin" placeholder="Identifiant" required>
    <input type="password" name="pass" placeholder="Mot de passe" required>
    <input type="submit" value="Confirmer">
</form>
</div>

<?php
$content = ob_get_clean();
require_once('template.php');
?>
