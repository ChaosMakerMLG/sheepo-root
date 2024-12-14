<?php

ini_Set("display_errors", "On");

session_start();

?>

<!DOCTYPE html>
<html lang="pl-PL">

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="js/dashboard/userlist.js"></script>
    <script src="js/dashboard/log.js"></script>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/dashboard/body.css">
    <link rel="stylesheet" href="css/dashboard/usrlist.css">
    <link rel="stylesheet" href="css/dashboard/userlog.css">
    <link rel="stylesheet" href="css/dashboard/diskinfo.css">

</head>

<?php

include 'php/patterns.php';
include 'php/jsdatavariables.php';

echo "<script>
var disk_max_space = " . json_encode($disk_max_space_gigabytes) . ";
var disk_free_space = " . json_encode($disk_free_space_gigabytes) . ";
var disk_filled_space = " . json_encode($disk_filled_space_gigabytes) . ";    
var disk_max_space_bytes = " . json_encode($disk_max_space_bytes) . ";
var disk_free_space_bytes = " . json_encode($disk_free_space_bytes) . ";
var disk_filled_space_bytes = " . json_encode($disk_filled_space_bytes) . ";
var percentage_archives = " . json_encode($percentage_archives) . ";
var percentage_images = " . json_encode($percentage_images) . ";
var percentage_documents = " . json_encode($percentage_documents) . ";
var percentage_backups = " . json_encode($percentage_backups) . ";
var percentage_text = " . json_encode($percentage_text) . ";
var percentage_audio = " . json_encode($percentage_audio) . ";
var percentage_video = " . json_encode($percentage_video) . ";
</script>";

?>
<script> 

var test_bytes='<?php echo $percentage_audio; ?>';

</script>
<body>
    <div class="visible" id="dim">
        <div id="popup">
            <!-- CONTENT  -->
        </div>
        <div id="loading">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div id="outer">
        <div class="inner" id="userlist">
            <div id="topbar-userlist">
                <i class='bx bxs-user-plus'></i>
                <input name="search" onkeyup="" placeholder="Search... " id="search-userlist" />
            </div>
            <table cellspacing='0' id="content-userlist">
                <tbody id="tbody-userlist">
                    <?php
                    include "php/connect_db.php";

                    $sql_userlist = "SELECT login, suspended, session_id FROM users WHERE login !='Admin'";
                    $result_userlist = mysqli_query( $conn, $sql_userlist);
                    
                    $x = 0;
                    $y = 0;
                    $z = 0;
                    $e = 0;   

                    while ($row_userlist = mysqli_fetch_array($result_userlist)) {

                        $toggle_class = ($row_userlist['suspended'] == 1) ? 'toggle' : '';
                        $login_class = ($row_userlist['session_id'] != NULL) ? 'loggedin' : '';

                        echo "<tr id='" . $row_userlist['login'] . "_cell' class='userlisttrs'>";
                        echo "<td id='" . "indicator_" . $x++ . "' class='indicator userlisttds'></td>";
                        echo "<td class='userlisttds username'><strong style='font-family: 'Varela Round',sans-serif;'>" . $row_userlist['login'] . "</strong>" ." " . "<strong id='" . $row_userlist['login'] . "_text' class='$toggle_class suspend_text'>(Suspended)</strong></td>";
                        echo "<td class='connector userlisttds'><div class='table_buttons'><div id='" . $row_userlist['login'] . "' onclick='enable(id)' class='$toggle_class open'><i class='bx bxs-lock-open-alt' ></i></div><div id='" . $row_userlist['login'] . "' onclick='disable(id)' class='$toggle_class shutdown'><i class='bx bxs-lock-alt' ></i></div><div id='" . $row_userlist['login'] . "' onclick='myDelete(id)' class='delete' ><i class='bx bxs-trash-alt' ></i></div></div></td>";
                        echo "<td class='padding lasteconnector userlisttds'><div id='" . "login0_" . $y++ . "' class='$login_class login_indicator'><i class='bx bxs-log-in'></i></div></td>";
                        echo "<td class='lasteconnector userlisttds'><div id='" . "login1_" . $z++ . "' class='$login_class login_indicator2'><i class='bx bx-log-in'></i></div></td>";
                        echo "</tr>";
                    }
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
            <div id="scroll-userlist">

            </div>
        </div>
    </div>
    <div id="outer2">
    <div class="inner" id="userlog">
        <div id="topbar-log">
        
        <div id="sorting-dropdown">
                <button id="toggle-dropdown" onclick="filter_dropdown()"><i class='bx bxs-filter-alt'></i></button>
            </div>
            

            

        <?php
        
        date_default_timezone_set('Europe/Warsaw');
        
        $now = date("Y-m-d H:i");
        $date = date("Y-m-d");
        $time = date("H:i");
        
        ?>
        <div id="high-low-icons">
        <i class='bx bx-sort-up'></i>
        <i class='bx bx-sort-down'></i>
        </div>
        <div id="filters">
                    <i onclick="sorting(this.id)" id="date-point" class='bx bxs-calendar-alt'></i>
                    <i onclick="sorting(this.is)" id="date-range" class='bx bxs-calendar-week'></i>
                    <br/>
                </div>
                <input name="search" onkeyup="" placeholder="Search... " id="search-userlog" />
    </div>
    <div id="log-table-wrapper">
    <table cellspacing='0' id="content-log" class="sortable">
            <tbody id="tbody-log">
                <?php 

                include "php/connect_db.php";

                $sql_log = "SELECT username, date, action, error FROM log WHERE user='1' ORDER BY date DESC";

                $result_log = mysqli_query($conn, $sql_log);

                $x = 0;
                $y = 0;
                $z = 0;
                $v = 0;
                $g = 0;
                $h = 0;

                while($row_log = mysqli_fetch_array($result_log)) {

                    $error = ($row_log['error'] != NULL) ? '' : 'error-toggle';


                    echo "<tr class='log-trs'>";
                    echo "<td class='error-indicator $error'><i class='bx bxs-error-circle'></i></td>";  
                    echo "<td id='date_" . $x++ . "' class='log-date'>" . $row_log['date'] . "</td>";
                    echo "<td class='log-name'>" . $row_log['username'] . "</td>";
                    echo "<td class='log-action'>" . $row_log['action'] . "</td>";
                    echo "<td class='log-dropdown-button'><i id='button_" . $z++ . "' onclick='infodropdown(this.id)' class='bx bxs-down-arrow info-button'></i></td>"; 
                    echo "</tr>";
                    echo "<tr class='info-box-wrapper' id='button_" . $y++ . "_info' style='display: none;'><td colspan='5' style='text-align: center;' class='log-dropdown-content' id='info_" . $v++ . "'><div class='info-box'>NIGGA</div></td></tr>";

                }         
                
                ?>
            </tbody>
        </table>
    </div>
            </div>
    </div>
    <div id='outer3'>
        <div class="inner" id="disk-info">
            <div class="chartBox">
                <canvas id="doughnut_chart"></canvas>
                <div id="legendContainer"></div>
            </div>
            <div id="detailsContainer">
            <canvas id="bar_chart"></canvas>
            </div>

        </div>
        <script src="js/dashboard/chart.js"></script>
            </div>

</body>


</html>
<?php 
mysqli_close($conn);
?>






