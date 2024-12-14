    
    
<?php



if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['button']))
{
    func();
}

function func() 
{
    shell_exec("sudo useradd -m " . $_POST["login"] . "\n");
    $file1 = fopen("passy.txt", "w"); 
    fwrite($file1, "Login: " . $_POST["login"] . "\n");
    fwrite($file1, "Haslo: " . $_POST["passwd"] . "\n");
                fclose($file1);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database login form</title>
</head>
<body>
<h2>Logowanie</h2>
    <form action="" method="post">
        <p>Login:	<input type="text" name="login" /></p>
        <p>Hasło:	<input type="text" name="passwd" /></p>
        <p><input type="submit" name="button" /></p>
    </form>

</body>
<footer>
<p>Copyright by _ChaosMaker</p>
</footer>
</html>