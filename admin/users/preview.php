<?php
session_start();
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
include ('../connect/connect.php');
$userid = $_GET['userid'];
$sql = "SELECT *FROM users where id='$userid'";
$result = mysqli_query($conn, $sql);
$b = mysqli_fetch_array($result);
$name = $b['username'];
$email = $b['email'];
$password = $b['password'];
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND status='1'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 1) {
    $_SESSION['email'] = $email;
    header("location:../dashboard/index.php");
}
else{
    echo "<script> alert('INACTIVE USER')</script>";
}
?>
