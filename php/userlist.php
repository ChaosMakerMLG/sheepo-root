<?php 
header('Content-Type: application/json');

$response = array();


// DELETE USERS

if (isset($_POST['delname'])) {
    $del_username = $_POST['delname'];
    include "connect_db.php";

    $sql = "DELETE FROM users WHERE login='$del_username'";

    if(mysqli_query($conn, $sql)) {
            $response['success'] = true;
            /* $response['message'] = "User '$del_username' deleted successfully"; */
        } else {
            $response['success'] = false;
           /*  $response['message'] = "Error deleting user '$del_username': " . mysqli_error($conn); */
        }
    }
    
//DISABLE USERS

if (isset($_POST['suspend_name'])) {
    $suspend_username = $_POST['suspend_name'];
    include "connect_db.php";

    $sql1 = "UPDATE users SET suspended='1' WHERE login='$suspend_username'";

    if(mysqli_query($conn, $sql1)) {
            $response['success'] = true;
            $response['message'] = "User '$suspend_username' suspended successfully";
        } else {
            $response['success'] = false;
            /* $response['message'] = "Error suspending user '$suspend_username': " . mysqli_error($conn); */
        }
    }

//ENABLE USERS

if (isset($_POST['unsuspend_name'])) {
    $unsuspend_username = $_POST['unsuspend_name'];
    include "connect_db.php";

    $sql2 = "UPDATE users SET suspended='0' WHERE login='$unsuspend_username'";

    if(mysqli_query($conn, $sql2)) {
            $response['success'] = true;
            $response['message'] = "User '$unsuspend_username' unsuspended successfully";
        } else {
            $response['success'] = false;
            /* $response['message'] = "Error unsuspending user '$unsuspend_username': " . mysqli_error($conn); */
        }
}


    echo json_encode($response);
?>