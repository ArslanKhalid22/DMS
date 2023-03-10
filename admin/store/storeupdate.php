<?php
session_start();
include "../connect/connect.php";
$count=0;
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
$email=$_SESSION['email'];
$a=mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$b=mysqli_fetch_array($a);
$name=$b['username'];
$upid=$b['id'];
$longitude=$_POST['longitude'];
$latitude=$_POST['latitude'];
$status=$_POST['status'];
if($status=="active")
{
    $status=1;
}
else
{
    $status=0;
}
$storeid=$_POST['id'];
$sql="SELECT storename from store where storeid='$storeid'";
$a=mysqli_query($conn,$sql);
$b=mysqli_fetch_array($a);
$storname=$b['storename'];
$storename=$_POST['storename'];
if($storename!=$storname)
{
    $sql="SELECT *from store";
    $result=mysqli_query($conn,$sql);
    while($row=$result->fetch_assoc())
    {
        $existname=$row['storename'];
        if($existname==$storename)
        {
            $count++;
            echo "Store already exist";
            return;
        }

    }
}
$updatedon = date('Y-m-d h:i:s A',strtotime('+3 hours'));
$storename=mysqli_real_escape_string($conn,$_POST['storename']);
if($count==0)
{
    $sql="UPDATE store SET storename='$storename',longitude='$longitude',latitude='$latitude',status='$status',updatedby='$upid',updatedon='$updatedon' where storeid='$storeid'";
    $result= mysqli_query($conn,$sql);
    if($result==TRUE)
    {
        echo 1;
        return;
    }
    else
    {
        echo 0;
    }
}
if($storname==$storename)
{
    $sql="UPDATE store SET storename='$storename',longitude='$longitude',latitude='$latitude',status='$status',updatedby='$upid',updatedon='$updatedon' where storeid='$storeid'";
    $result= mysqli_query($conn,$sql);
    if($result==TRUE)
    {
        echo 1;
        return;
    }
    else
    {
        echo 0;
    }
}
?>