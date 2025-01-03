<?php

session_start();

$request_uname = $_SESSION['login'];

?>

<!DOCTYPE html>
<html lang="pl-PL">

<head>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/loading.css">
    <link rel="stylesheet" href="css/global.css">
    <script src="js/index.js"></script>
    <title>Login</title>
</head>

<body <?php if(isset($_COOKIE['error'])) {
            echo "onload='noloading()'";
        }else {
            echo "onload='loading()'";
        } ?>>
    <div id="dim">
        <div id="loading">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div id="center">

        <div id="main">
            <form autocomplete="off" action="php/session" method="POST" id="form">
                <input autocomplete="false" name="hidden" type="text" style="display:none;">
                <div id="error" class="<?php if (@$_GET['error'] == true || @$_GET['empty'] == true || @$_GET['sus'] == true || @$_GET['active'] == true) echo 'visible'; ?>">
                    <?php
                    if (@$_GET['error'] == true) {
                    ?>
                        <i class='bx bxs-error-circle'></i><strong>Login or Password are incorrect</strong>
                    <?php
                    }
                    if (@$_GET['empty'] == true) {
                    ?>
                        <i class='bx bxs-error-circle'></i><strong>Please fill in the blanks</strong>
                    <?php
                    }
                    if (@$_GET['sus'] == true) {
                    ?>
                        <i class='bx bxs-error-circle'></i><strong>Sorry. Your account got suspended.</strong>
                    <?php
                    }
                    if (@$_GET['active'] == true) {
                    ?>
                        <i class='bx bxs-error-circle'></i><strong>User is already logged in.</strong>
                    <?php    
                    }
                    ?>
                </div>
                <div class="inner">
                    <label>Username *</label>
                    <input type="text" name="login" value="<?php if (isset($_COOKIE['username'])) {
                                                                echo $_COOKIE['username'];
                                                            } ?>" placeholder="Enter your Username..." class="login_inputs" />
                </div>
                <div class="inner">
                    <label>Password *</label>
                    <input type="password" name="passwd" placeholder="Enter your Password..." class="login_inputs" />
                </div>
                <p><button type="submit" name="button" id="login_button">Login</button></p>
            </form>
            <div id="secnd">
                <a href="forgotpasswd.php" id="forgotpasswd">Forgot Password?</a>
            </div>
        </div>
        <div id="strech_filler"></div>
        <div id="cookiepopup">
            <i class='bx bx-cookie inner'></i>
            <h1 id="header">Ten serwis wykorzystuje pliki cookies.</h1>
            <p>Korzystanie z witryny oznacza zgodę na ich zapis lub odczyt wg ustawień przeglądarki.<br><br> Kliknij <a target="_blank" href="https://cookiealert.sruu.pl/o-ciasteczkach">Tutaj</a> aby dowiedzieć się więcej.</p>
            <form action="php/policy.php" method="GET" id="cookieform">
                <input autocomplete="false" name="hidden" type="text" style="display:none;">
                <input name="confirm" value="Okej" type="submit" id="confirm">
            </form>
        </div>
        <footer>
            <div id="cookie" onload="mouseEnter()">
                <div><i class='outer bx bxs-cookie'></i></div>
            </div>
        </footer>
    </div>
</body>

<?php 

if (isset($_COOKIE['timeout']) && isset($_SESSION['login'])) {

    header("Location:/main.php");

}
elseif (!$_COOKIE['timeout']) {
?>
<script>

function logoutUser() {
    var logout = $.ajax({
        url: "php/logout.php",
        type: "GET",
        async: false,
        data: {user: '<?php echo $request_uname; ?>'},
        success: function(response) {
        },
        error: function(xhr, status, error) {
            console.error("Error logging out user:", error);
        }
    });
}

logoutUser();

</script>
<?php
}
?>

<script type="text/javascript">
    this.window.addEventListener("onbeforeunload", confirmExit());
  function confirmExit()
  {
    $.ajax({
        url: '/php/clearcookies.php',
  success: function(data) {
    $('.result').html(data);
  }
});
  }
</script>
</html>

<?php

if (isset($_COOKIE['policy'])) {
    echo '<script type="text/javascript">',
    'onload();',
    'policy();',
    '</script>';
} else {
    echo '<script type="text/javascript">',
    'setTimeout(function () {',
    'mouseEnter();',
    'onload();',
    'repolicy();',
    '}, 4000);',
    '</script>';
}

?>