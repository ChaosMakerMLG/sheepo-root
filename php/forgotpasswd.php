<?php
        include "connect_db.php";
        setcookie('username', $_POST['login'], time() - (60000 * 5), '/forgotpasswd.php');
        setcookie('passwd', $_POST['passwd'], time() - (60000 * 5), '/forgotpasswd.php');
        setcookie('error_forgotpasswd', 'forgotpasswd', time() - (61000 * 5), '/forgotpasswd.php');
        $user = $_POST["login"];
        $passwd = $_POST['passwd'];

        

      $sql = "SELECT password FROM users WHERE login='$user'";

      $result = mysqli_query($conn, $sql);

      $row = mysqli_fetch_row($result);
if ($user == 'Admin') {
  mysqli_close($conn);
  header("location:/forgotpasswd.php?kys= You are not funny");
}

    if($_POST['passwd'] == NULL || $_POST['passwdrepeat'] == NULL || $_POST['login'] == NULL) {
  mysqli_close($conn);
  setcookie('username', $_POST['login'], time() + (60000 * 5), '/forgotpasswd.php');
  setcookie('passwd', $_POST['passwd'], time() + (60000 * 5), '/forgotpasswd.php');
  setcookie('error_forgotpasswd', 'forgotpasswd', time() + (60000 * 5), '/forgotpasswd.php');
        header("location:/forgotpasswd.php?empty= Please fill in the blanks?login= $user?passwd= $passwd");
    }
    else if($_POST['passwd'] == "ZAQ!2wsx") {
  mysqli_close($conn);
  setcookie('username', $_POST['login'], time() + (60000 * 5), '/forgotpasswd.php');
  setcookie('passwd', $_POST['passwd'], time() + (60000 * 5), '/forgotpasswd.php');
  setcookie('error_forgotpasswd', 'forgotpasswd', time() + (60000 * 5), '/forgotpasswd.php');
        header("location:/forgotpasswd.php?default= You cant use that password?login= $user");
    }
    else if($_POST['passwd'] != $_POST["passwdrepeat"]) {
  mysqli_close($conn);
  setcookie('username', $_POST['login'], time() + (60000 * 5), '/forgotpasswd.php');
  setcookie('passwd', $_POST['passwd'], time() + (60000 * 5), '/forgotpasswd.php');
  setcookie('error_forgotpasswd', 'forgotpasswd', time() + (60000 * 5), '/forgotpasswd.php');
        header("location:/forgotpasswd.php?notsame= Passwords are not the same?login= $user?passwd= $passwd");
        
    } 
    else if ($_POST['passwd'] == $row[0]) {
  mysqli_close($conn);
  setcookie('username', $_POST['login'], time() + (60000 * 5), '/forgotpasswd.php');
  setcookie('passwd', $_POST['passwd'], time() + (60000 * 5), '/forgotpasswd.php');
  setcookie('error_forgotpasswd', 'forgotpasswd', time() + (60000 * 5), '/forgotpasswd.php');
        header("location:/forgotpasswd.php?same= You cant use the same password?login= $user");
    }

$sql = "SELECT login FROM users WHERE login='$user'";
$result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) < 1) {
  mysqli_close($conn);
  setcookie('username', $_POST['login'], time() + (60000 * 5), '/forgotpasswd.php');
  setcookie('passwd', $_POST['passwd'], time() + (60000 * 5), '/forgotpasswd.php');
  setcookie('error_forgotpasswd', 'forgotpasswd', time() + (60000 * 5), '/forgotpasswd.php');
        header("location:/forgotpasswd.php?nouser=$user");

    }
    else if($_POST['passwd'] == $_POST["passwdrepeat"]) {

        $newpasswd = $_POST["passwd"];

        $uppercase = preg_match('@[A-Z]@', $newpasswd);
        $lowercase = preg_match('@[a-z]@', $newpasswd);
        $number = preg_match('@[0-9]@', $newpasswd);
        $specialChars = preg_match('@[^\w]@', $newpasswd);

  if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($newpasswd) < 8){
    mysqli_close($conn);
    setcookie('username', $_POST['login'], time() + (60000 * 5), '/forgotpasswd.php');
    setcookie('passwd', $_POST['passwd'], time() + (60000 * 5), '/forgotpasswd.php');
    setcookie('error_forgotpasswd', 'forgotpasswd', time() + (61000 * 5), '/forgotpasswd.php');
    header("location:/forgotpasswd.php?weak= The password is too weak?login= $user");
    

  }
  else if(strlen($newpasswd) > 27){
    mysqli_close($conn);
    setcookie('username', $_POST['login'], time() + (60000 * 5), '/forgotpasswd.php');
    setcookie('passwd', $_POST['passwd'], time() + (60000 * 5), '/forgotpasswd.php');
    setcookie('error_forgotpasswd', 'forgotpasswd', time() + (61000 * 5), '/forgotpasswd.php');
    header("location:/forgotpasswd.php?toolong= The password is too long?login= $user");
        
  }
  
  $sql_suspendcheck = "SELECT suspended FROM users WHERE login='$user'";
  $result_suspendcheck = mysqli_query($conn, $sql_suspendcheck);
  $row_suspendcheck = mysqli_fetch_assoc($result_suspendcheck);
  
  if($row_suspendcheck['suspended'] == '1') {
    setcookie('error_forgotpasswd', 'forgotpasswd', time() + (61000 * 5), '/forgotpasswd.php');
    header("Location:/forgotpasswd.php?sus= " . $_COOKIE['error']);
    mysqli_close($conn);
    exit;
  }
  else {
    setcookie('username', $_POST['login'], time() - (60000 * 5), '/forgotpasswd.php');
    setcookie('passwd', $_POST['passwd'], time() - (60000 * 5), '/forgotpasswd.php');
    setcookie('error_forgotpasswd', 'forgotpasswd', time() - (61000 * 5), '/forgotpasswd.php');

    $hash = password_hash($newpasswd, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password='$hash' WHERE login='$user'";
  }

        if (mysqli_query($conn, $sql)) {

          mysqli_close($conn);
          header("Location: /index.php");
    }
  }   
?>
