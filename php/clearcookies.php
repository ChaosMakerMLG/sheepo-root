<?php 

setcookie('username', $_POST['login'], time() - (60000 * 5), '/forgotpasswd.php');
setcookie('passwd', $_POST['passwd'], time() - (60000 * 5), '/forgotpasswd.php');
setcookie('error_forgotpasswd', 'forgotpasswd', time() - (61000 * 5), '/forgotpasswd.php');
setcookie('error', 'index', time() - (61000 * 5), '/index.php');
setcookie('username', $_POST['login'], time() - (61000 * 5), '/index.php');

?>