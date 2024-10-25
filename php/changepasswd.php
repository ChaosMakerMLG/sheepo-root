<?php
        include "connect_db.php";
        setcookie('passwd', $_POST['passwd'], time() - (60000 * 5), '/changepasswd.php');
        setcookie('error_forgotpasswd', 'forgotpasswd', time() - (61000 * 5), '/changepasswd.php');
        $user = $_SESSION['login'];
        $passwd = $_POST['passwd'];

        

      $sql = "SELECT password FROM users WHERE login='$user'";

      $result = mysqli_query($conn, $sql);

      $row = mysqli_fetch_row($result);

    if($_POST['passwd'] == NULL || $_POST['passwdrepeat'] == NULL) {
  mysqli_close($conn);
  setcookie('passwd', $_POST['passwd'], time() + (60000 * 5), '/changepasswd.php');
  setcookie('error_forgotpasswd', 'forgotpasswd', time() + (60000 * 5), '/changepasswd.php');
        header("location:/changepasswd.php?empty= Please fill in the blanks?login= $user?passwd= $passwd");
    }
    else if($_POST['passwd'] == "ZAQ!2wsx") {
  mysqli_close($conn);
  setcookie('passwd', $_POST['passwd'], time() + (60000 * 5), '/changepasswd.php');
  setcookie('error_forgotpasswd', 'forgotpasswd', time() + (60000 * 5), '/changepasswd.php');
        header("location:/changepasswd.php?default= You cant use that password?login= $user");
    }
    else if($_POST['passwd'] != $_POST["passwdrepeat"]) {
  mysqli_close($conn);
  setcookie('passwd', $_POST['passwd'], time() + (60000 * 5), '/changepasswd.php');
  setcookie('error_forgotpasswd', 'forgotpasswd', time() + (60000 * 5), '/changepasswd.php');
        header("location:/changepasswd.php?notsame= Passwords are not the same?login= $user?passwd= $passwd");
        
    } 
    else if ($_POST['passwd'] == $row[0]) {
  mysqli_close($conn);
  setcookie('passwd', $_POST['passwd'], time() + (60000 * 5), '/changepasswd.php');
  setcookie('error_forgotpasswd', 'forgotpasswd', time() + (60000 * 5), '/changepasswd.php');
        header("location:/changepasswd.php?same= You cant use the same password?login= $user");
    }

$sql = "SELECT login FROM users WHERE login='$user'";
$result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) < 1) {
  mysqli_close($conn);
  setcookie('passwd', $_POST['passwd'], time() + (60000 * 5), '/changepasswd.php');
  setcookie('error_forgotpasswd', 'forgotpasswd', time() + (60000 * 5), '/changepasswd.php');
        header("location:/changepasswd.php?nouser=$user");

    }
    else if($_POST['passwd'] == $_POST["passwdrepeat"]) {

        $newpasswd = $_POST["passwd"];

        $uppercase = preg_match('@[A-Z]@', $newpasswd);
        $lowercase = preg_match('@[a-z]@', $newpasswd);
        $number = preg_match('@[0-9]@', $newpasswd);
        $specialChars = preg_match('@[^\w]@', $newpasswd);

  if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($newpasswd) < 8){
    mysqli_close($conn);
    
    setcookie('passwd', $_POST['passwd'], time() + (60000 * 5), '/changepasswd.php');
    setcookie('error_forgotpasswd', 'forgotpasswd', time() + (61000 * 5), '/changepasswd.php');
    header("location:/changepasswd.php?weak= The password is too weak?login= $user");
    

  }
  else if(strlen($newpasswd) > 27){
    mysqli_close($conn);
    
    setcookie('passwd', $_POST['passwd'], time() + (60000 * 5), '/changepasswd.php');
    setcookie('error_forgotpasswd', 'forgotpasswd', time() + (61000 * 5), '/changepasswd.php');
    header("location:/changepasswd.php?toolong= The password is too long?login= $user");
        
  }
  else {
    setcookie('passwd', $_POST['passwd'], time() - (60000 * 5), '/changepasswd.php');
    setcookie('error_forgotpasswd', 'forgotpasswd', time() - (61000 * 5), '/changepasswd.php');

    $hash = password_hash($newpasswd, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password='$hash' WHERE login='$user'";
  }

        if (mysqli_query($conn, $sql)) {

          mysqli_close($conn);
          header("Location: /index.php");
    }
  }   
?>
