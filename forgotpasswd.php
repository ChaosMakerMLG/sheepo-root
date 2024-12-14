<?php 

setcookie('error', 'forgotpasswd', time() - (61000 * 5), '/forgotpasswd.php');

?>


<!DOCTYPE html>
<html lang="pl-PL">

<head>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/css/forgotpasswd.css">
    <link rel="stylesheet" href="/css/loading.css">
    <script src="/js/forgotpasswd.js" ></script>
    <title>Password Change</title>
</head>

<body <?php if(isset($_COOKIE['error_forgotpasswd'])) {
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
            <form autocomplete="off" action="php/forgotpasswd.php" method="POST" id="form">
                <input autocomplete="false" name="hidden" type="text" style="display:none;">
                <div id="error" class="<?php if (@$_GET['default'] == true || @$_GET['kys'] == true || @$_GET['toolong'] == true || @$_GET['weak'] == true || @$_GET['nouser'] == true || @$_GET['empty'] == true || @$_GET['same'] == true || @$_GET['notsame'] == true || @$_GET['fullempty'] == true || @$_GET['sus'] == true) echo 'visible'; ?>">
                    <?php
                    if (@$_GET['notsame'] == true) {
                    ?>
                        <i class='bx bxs-error-circle'></i><strong>Passwords are not the same</strong>
                    <?php
                    }
                    if (@$_GET['fullempty'] == true) {
                    ?>
                        <i class='bx bxs-error-circle'></i><strong>Password can't be empty</strong>
                    <?php
                    }
                    if (@$_GET['default'] == true) {
                    ?>
                        <i class='bx bxs-error-circle'></i><strong>You can't use that Password</strong>
                    <?php
                    }
                    if (@$_GET['empty'] == true) {
                    ?>
                        <i class='bx bxs-error-circle'></i><strong>Please fill in the blanks</strong>
                    <?php
                    }
                    if (@$_GET['same'] == true) {
                    ?>
                        <i class='bx bxs-error-circle'></i><strong>You can't use the same password</strong>
                    <?php
                    }
                    if (@$_GET['kys'] == true) {
                    ?>
                        <i class='bx bxs-error-circle'></i><strong>You are insanely unfunny...</strong>
                    <?php
                    }
                    if (@$_GET['nouser'] == true) {
                    ?>
                        <i class='bx bxs-error-circle'></i><strong>There are no users named "<?php echo @$_GET['nouser']; ?>"</strong>
                    <?php
                    }
                    if (@$_GET['weak'] == true) {
                    ?>
                        <i class='bx bxs-error-circle'></i><strong>Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character</strong>
                    <?php
                    }
                    if (@$_GET['toolong'] == true) {
                    ?>
                        <i class='bx bxs-error-circle'></i><strong>The password can't be longer than 27 characters</strong>
                    <?php
                    }
                    if (@$_GET['sus'] == true) {
                    ?>
                        <i class='bx bxs-error-circle'></i><strong>Sorry. Your account got suspended.</strong>
                    <?php
                    }
                    ?>
                </div>
                <div class="inner">
                    <label>Username *</label>
                    <input type="text" name="login" value="<?php if(isset($_COOKIE['username'])) { echo $_COOKIE['username'];} ?>" placeholder="Enter your Username..." class="login_inputs" value="<?php echo $_POST['login']; ?>" />
                </div>
                <div class="inner">
                    <label>New Password *</label>
                    <input type="password" name="passwd" value="<?php if(isset($_COOKIE['passwd'])) { echo $_COOKIE['passwd'];} ?>" placeholder="Enter your new Password..." class="login_inputs" value="<?php echo $_POST['passwd']; ?>" />
                </div>
                <div class="inner">
                    <label>Repeat New Password *</label>
                    <input type="password" name="passwdrepeat" placeholder="Reapeat the new Password..." class="login_inputs" />
                </div>
                <div id="button_div">
                    <button type="submit" name="button" id="login_button">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
  window.onbeforeunload = confirmExit;
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
</body>
</html>