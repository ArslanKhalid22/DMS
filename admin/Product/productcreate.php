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
    $itemname= $_POST['itemname'];
    $sql="SELECT *from product";
    $result=mysqli_query($conn,$sql);
    while($row=$result->fetch_assoc())
    {
        $existname=$row['itemname'];
        if($existname==$itemname)
        {
            $count++;
            echo "Product already exist";
            return ;
        }

    }
    $et=$_POST['et'];
    $tax=$_POST['tax'];
    $it=$et+$tax;
    $status=$_POST['status'];
    if($status=="active")
    {
        $status=1;
    }
    else{
        $status=0;
    }
    $addedon = date('Y-m-d H:i:s A',strtotime('+3 hours'));
    $p_code=$_POST['p_code'];
    $itemname=mysqli_real_escape_string($conn,$_POST['itemname']);
    if($count==0)
    {
        $sql="INSERT into product(p_code,itemname,et,tax,it,status,addedby,addedon)VALUES('$p_code','$itemname','$et','$tax','$it','$status','$aid','$addedon')";
        $result= mysqli_query($conn,$sql);
        if($result==TRUE)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }

?>
