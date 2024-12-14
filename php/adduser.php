<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
</body>
</html>
<?php
ini_Set("display_errors", "On");
  include "connect_db.php";
   
  $user =  $_POST['login'];
  $password =  "ZAQ!2wsx";

  $hash = password_hash($password, PASSWORD_DEFAULT);

  $sql = "INSERT INTO users (login, password, first_login) VALUES ('$user', '$hash', '1')";
      
  if(mysqli_query($conn, $sql)){
      echo "<h3>User $user has been added successfully</h3>";
      exit();
  } else{
      echo "ERROR: Hush! Sorry $sql. "
          . mysqli_error($conn);
  }
mysqli_close($conn);
?>