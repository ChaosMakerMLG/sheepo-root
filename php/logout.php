<html>
    <script src="/js/navmenu.js">
        
        

    </script>
</html>
<?php
ini_Set("display_errors", "On");
setcookie('timeout', 'bomboklat', time() - (60000 * 30), '/');
session_set_cookie_params(0);
session_start();
$request_uname = NULL;

if (isset($_GET['user'])) {
    $user = $_GET['user'];
    include "connect_db.php";
    $sql = "UPDATE users SET session_id=NULL WHERE login='$user'";
        mysqli_query($conn, $sql);
        $sql = "INSERT INTO log (username, date, action, user)
        VALUES ('$user', NOW(), 'User logout', '1');";
        mysqli_query($conn, $sql);
    session_unset();   
    session_destroy();
    header("Location:/index.php");

}
?>

