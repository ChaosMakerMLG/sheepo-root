<?php

ini_Set("display_errors", "On");

session_start();
$request_uname = $_SESSION['login'];
if(empty($_COOKIE['timeout'])) {


}
if (empty($_SESSION['login']) && session_id()) {
    header('location:index.php');
}


?>

<!DOCTYPE html>
<html lang="pl-PL">

<head>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Styles-->
    
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/main/nav.css">
    <link rel="stylesheet" href="css/main/header.css">
    <link rel="stylesheet" href="css/main/buttons.css">
    <link rel="stylesheet" href="css/main/body.css">
    <link rel="stylesheet" href="css/loading.css">
    <!--Icons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <!--JavaScript-->
    <script src="js/main.js"></script>
    <script src="js/navmenu.js"></script>
    <title>Sheepo</title>
</head>
<script>
</script>

<body onbeforeunload="testingu()" onload="check()">


    <div id="main-wrapper">
        <div id="popup-wrapper">
            <div id="popup-dim">
        <div id="full-popup">
            <h1>NIGGER</h1>
            <button onclick='toggleMainPopup()'>click me</button>
        </div>
</div>
        </div>
    <div id="nav" class="nav">
        <header>
            <img id="logo" src="/images/logo.png">
            <i id='button' onclick="rewind()" class='bx bx-caret-right button toggle'></i>
        </header>
        <div id="08712398614" class="navbuttons">
            <div onclick="unwind()" class="top">
                <li id="strg" onclick="select(this.id)">
                    <div id="bar_strg" class="bar">|</div>
                    <a id="a_strg"><i id="i_strg" class='bx bxs-hdd icon'>
                            <strong class="strong" id="strong1">Storage</strong>
                        </i></a>
                </li>
                <li id="mail" onclick="select(this.id)">
                    <div id="bar_mail" class="bar">|</div>
                    <a id="a_mail"><i id="i_mail" class='bx bxs-envelope icon'>
                            <strong class="strong" id="strong2">E-Mail</strong>
                        </i></a>
                </li>
                <li id="dshbrd" onclick="select(this.id)" class="nouser <?php if ($_SESSION['login'] == 'Admin') echo 'admin'; ?>">
                    <div id="bar_dshbrd" class="bar">|</div>
                    <a id="a_dshbrd"><i id="i_dshbrd" class='bx bxs-dashboard icon'>
                            <strong class="strong" id="strong3">Dashboard</strong>
                        </i></a>
                </li>
                <li id="bckups" onclick="select(this.id)" class="nouser <?php if ($_SESSION['login'] == 'Admin') echo 'admin'; ?>">
                    <div id="bar_bckups" class="bar">|</div>
                    <a id="a_bckups"><i id="i_bckups" class='bx bxs-copy icon'>
                            <strong class="strong" id="strong4">Backups</strong>
                        </i></a>
                </li>
                <li id="log" onclick="select(this.id)" class="nouser <?php if ($_SESSION['login'] == 'Admin') echo 'admin'; ?>">
                    <div id="bar_log" class="bar">|</div>
                    <a id="a_log"><i id="i_log" class='bx bxs-file icon'>
                            <strong class="strong" id="strong5">Log</strong>
                        </i></a>
                </li>
            </div>
            <div class="bottom">
                <li id="usr" onclick="select(this.id)">
                    <div id="bar_usr" class="bar">|</div> 
                    <a id="a_usr"><i id="i_usr" class='bx bxs-user icon'>
                            <strong class="strong" id="strong6"><?php echo $_SESSION['login']; ?></strong>
                        </i></a>
                </li>
                <li>
                    <a id="a_lgout" href="/php/logout.php/?user=<?php echo $request_uname; ?>"><i id="logout" class='bx bxs-log-out icon'>
                            <strong class="strong" id="strong7">Logout</strong>
                        </i></a>
                </li>
            </div>
            <button onclick="toggleMainPopup(content)">Click Me!</button>
            </footer>
        </div>
    </div>
    <div id="body" class="body">
        <div id="content"></div>
        <div class="innerbody" id="innerbody">
        <div id="loading" class="main-loading">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <div></div>
</body>
<script>content = 'changepasswd.php'</script> 

<?php 

include 'php/connect_db.php';

$sql = "SELECT users.first_login FROM users where users.login='$request_uname'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

if ($row['first_login'] != NULL) {
    echo "<script>toggleMainPopup(content);</script>";
}

?>

<script type="text/javascript"> 
let timeout;
let refreshing = false;
let var1 = 0;
let var2 = 0;

function resetTimeout() {
    clearTimeout(timeout);
    timeout = setTimeout(logoutUser, 10 * 60 * 1000);
}

function handleUserActivity() {
    resetTimeout();
}

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

$(document).on('mousemove keydown', function() {
    handleUserActivity();
});

window.addEventListener('beforeunload', (event) => {
    event.preventDefault();
    event.returnValue = '';

});

document.addEventListener('unload', () => {
    console.log('tell me why... aint nothing but a heartache');
});

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
<!-- 

session cookie params do auto logouta

 -->