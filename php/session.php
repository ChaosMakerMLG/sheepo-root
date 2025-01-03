<?php

/* if(isset($_COOKIE['session'])) {

} */

$user = isset($_POST['login']) ? $_POST['login'] : '';
$passwd = isset($_POST['passwd']) ? $_POST['passwd'] : '';

function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

function new_session_id() {

    session_set_cookie_params(0);
    session_start();
    if (!empty($_SESSION['deleted_time']) && $_SESSION['deleted_time'] < time() - 180) {
        session_destroy();
        session_start();
    }

}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
}

setcookie('error', 'index', time() - (61000 * 5), '/index.php');
setcookie('username', $_POST['login'], time() - (61000 * 5), '/index.php');
$_SESSION['login'] = NULL;

ini_Set("display_errors", "On");

include 'connect_db.php';

if(empty($_POST['login']) || empty($_POST['passwd'])) {
    setcookie('username', $_POST['login'], time() + (60000 * 5), '/index.php');
    setcookie('error', 'index', time() + (60000 * 5), '/index.php');
    exit;
}

$sql = "SELECT suspended FROM users WHERE login='$user'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if($row['suspended'] == '1') {
    setcookie('error', 'index', time() + (60000 * 5), '/index.php');
    $sql = "INSERT INTO log (username, date, action, error, user)
        VALUES ('$user', NOW(), 'User login', 'Login failed - Account suspended', '1');";
    header("Location:/?sus= Your account got suspended.");
    mysqli_close($conn);
    exit;
}
else {

    $sql = "SELECT session_id FROM users WHERE login='$user'";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

}
if(isset($row['session_id'])) {
    setcookie('error', 'index', time() + (60000 * 5), '/index.php');

    $sql = "INSERT INTO log (username, date, action, error, user)
        VALUES ('$user', NOW(), 'User login', 'Login failed - User already logged in', '1');";
    header("Location:/?active= User already logged in.");
    mysqli_close($conn);    
    
}
else {

    debug_to_console($row['suspended']);
    
    $sql = "SELECT password FROM users WHERE login='$user'";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    $hash = $row['password'];

    if(password_verify($passwd, $hash)) {
        
        new_session_id();

        if(session_status() != PHP_SESSION_ACTIVE) {
            session_set_cookie_params(0);
            session_start();
        }

        $ses_prefix = generateRandomString();

        $ses_id = session_create_id($ses_prefix);
        $_SESSION['deleted_time'] = time();
        session_commit();
        ini_set('session.use_strict_mode', 0);
        session_id($ses_id);
        session_set_cookie_params(0);
        session_start();



        $_SESSION['login'] = $user;   
        $sql = "UPDATE users SET session_id='$ses_id' WHERE login='$user'";
        mysqli_query($conn, $sql);
        $sql = "INSERT INTO log (username, date, action, user)
        VALUES ('$user', NOW(), 'User login', '1');";
        mysqli_query($conn, $sql);
        setcookie('timeout', 'bomboklat', time() + (60000 * 30), '/');
        setcookie('username', $_POST['login'], time() - (61000 * 5), '/index.php');

        include 'encryption.php';

        $content = secured_encrypt(session_id());

        setcookie('session', $content, time() - (61000 * 5), '/index.php');
        header("Location:/main.php");
        mysqli_close($conn);
        exit;
        
    }
    else {
        setcookie('error', 'index', time() + (60000 * 5), '/index.php');
        $sql = "INSERT INTO log (username, date, action, error, user)
        VALUES ('$user', NOW(), 'User login', 'Login failed - Incorrect login or password', '1');";
        mysqli_query($conn, $sql);
        header("Location:/?error= Incorrect login or password.");
        exit;
    }
}


?>