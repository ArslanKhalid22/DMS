
<?php
include('../connect/connect.php');
session_start();
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
$userid=$_POST['id'];
$sql="Delete from users where id=$userid";
$result= mysqli_query($conn,$sql);
if($result==TRUE)
{
    echo "delete record successfully";

}
else
{
    echo "Not deleted properly";
}