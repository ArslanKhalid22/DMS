<?php
include('../connect/connect.php');
session_start();
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
        $email=$_SESSION['email'];
        $a=mysqli_query($conn, "SELECT * FROM users where email='$email'");
        $b=mysqli_fetch_array($a);
        $name=$b['username'];
        $upid=$b['id'];
        $count=1;
        $info=" ";
        $numinfo='';
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = $_POST['email'];
        $password = $_POST['password'];
        $status = $_POST['status'];
        if($status=="active")
        {
            $status=1;
        }
        else
        {
            $status=0;
        }
        $userid = $_POST['id'];
        $number = $_POST['number'];

        $updatedon = date('Y-m-d h:i:s A', strtotime('+3 hours'));
        if ($count == 1) {
            if ($password == "********") {

                if($count==1)
                {
                    $sql = "UPDATE  users SET username='$username',number='$number',status='$status',updatedby='$upid',updatedon='$updatedon' where id='$userid'";
                    $result = mysqli_query($conn, $sql);
                    echo 1;
                    return;
                }
            }
            else
                {
                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $integer = preg_match('@[0-9]@', $password);
                $specialChars = preg_match('@[^\w]@', $password);
                if (!$uppercase || !$lowercase || !$integer || !$specialChars || strlen($password) < 6) {
                    $count++;
                    echo "Password Requirement Not Fulfilled";
                    return;
                } else {

                }
                if($count==1)
                {
                    $sql = "UPDATE  users SET username='$username',number='$number',password='$password',status='$status',updatedby='$upid',updatedon='$updatedon' where id='$userid'";
                    $result = mysqli_query($conn, $sql);
                    echo 1;
                    return;
                }

            }
        }

    ?>