<?php
include('../connect/connect.php');
session_start();
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
$itemid=$_POST['id'];
$sql="Delete from product where itemid='$itemid'";
$result= mysqli_query($conn,$sql);
if($result==TRUE)
{
    echo 1;

}
else
{
    echo 0;
}