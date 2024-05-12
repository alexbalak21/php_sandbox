<?php
// Fichier "contact.php"
session_start();
//si captcha est envoyé et que le code existe en SESSION
if (isset($_POST['captcha'], $_SESSION['code'])) {

    if ($_POST['captcha'] == $_SESSION['code']) {
        echo "<p>Code correct :)</p>";
    } else {
        echo "<p>Le code est incorrect :(</p>";
    }
}
?>
<!-- Formulaire HTML -->
<form action="contact.php" method="post">
    <input type="text" name="captcha">
    <input type="submit">
    <img src="image.php" onclick="this.src='image.php?' + Math.random();" alt="captcha" style="cursor:pointer;">
</form>