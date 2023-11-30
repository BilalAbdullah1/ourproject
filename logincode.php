<?php
include('security.php');

if (isset($_POST['login_btn'])) {
    $login_email = $_POST['email'];
    $email_password = $_POST['password'];

    $query = "SELECT * FROM register where email='$login_email' and password = '$email_password'";
    $query_result = mysqli_query($connection,$query);
    $usertype = mysqli_fetch_array($query_result);

    if ($usertype == "admin") {
        $_SESSION['username'] = $login_email;
        header('location : index.php');
    }
    else if ($usertype == "user") {
        $_SESSION['username'] = $login_email;
        header('location : register.php');
    }
}
?>