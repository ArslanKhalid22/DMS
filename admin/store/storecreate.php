
<?php
session_start();
include "../connect/connect.php";
$count=0;
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
    $count=0;
    $email=$_SESSION['email'];
    $a=mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $b=mysqli_fetch_array($a);
    $name=$b['username'];
    $aid=$b['id'];
    $s_code=$_POST['s_code'];
    $storename=$_POST['storename'];
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
    $longitude=$_POST['longitude'];
    $latitude=$_POST['latitude'];
    $status=$_POST['status'];
    if($status=="active")
    {
        $status=1;
    }
    else{
        $status=0;
    }
    $addedby=$name;
    $addedon = date('Y-m-d h:i:s A',strtotime('+3 hours'));
    $storename=mysqli_real_escape_string($conn,$_POST['storename']);
    if($count==0)
    {
        $sql="INSERT into store(s_code,storename,longitude,latitude,status,addedby,addedon)VALUES
        ('$s_code','$storename','$longitude','$latitude','$status','$aid','$addedon')";
        $result=mysqli_query($conn,$sql);
    //    echo $sql;
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
