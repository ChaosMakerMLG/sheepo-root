<?php 
setcookie('policy', 'guest', time() + (86400 * 366), '/');
header("Location:/index.php");
?>
