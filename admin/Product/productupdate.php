<?php
session_start();
include "../connect/connect.php";
$count=0;
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
$email=             $_SESSION['email'];
$a=                 mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$b=                 mysqli_fetch_array($a);
$name=              $b['username'];
$upid=              $b['id'];
$et=                $_POST['et'];
$tax=               $_POST['tax'];
$it=                $tax+$et;
$status=            $_POST['status'];
    if($status=="active")
    {
                    $status=1;
    }
    else
    {
                    $status=0;
    }

$itemid=            $_POST['id'];
$sql=               "SELECT itemname from product where itemid='$itemid'";
$a=                 mysqli_query($conn,$sql);
$b=                 mysqli_fetch_array($a);
$itename=           $b['itemname'];
$itemname=          $_POST['itemname'];
if($itemname!=$itename)
{
$sql=               "SELECT *from product";
$result=            mysqli_query($conn,$sql);
        while($row=$result->fetch_assoc())
        {
            $existname=$row['itemname'];
            if($existname==$itemname)
            {
                $count++;
                echo "Product already exist";
                return;
            }

        }
}
$updatedon = date('Y-m-d h:i:s A',strtotime('+3 hours'));
$itemname=mysqli_real_escape_string($conn,$_POST['itemname']);
if($count==0)
{
    $sql="UPDATE  product SET itemname='$itemname',et='$et',tax='$tax',it='$it',status='$status',updatedby='$upid',updatedon='$updatedon' where itemid='$itemid'";
    $result= mysqli_query($conn,$sql);
    $query="UPDATE productorder SET itemname='$itemname'where itemid='$itemid'";
    $q=mysqli_query($conn,$query);
    $query="UPDATE secondaryproductorder SET itemname='$itemname'where itemid='$itemid'";
    $q=mysqli_query($conn,$query);
    if($result==TRUE)
    {
        echo 1;
        return;
    }
    else{
        echo 0;
    }



}
if($itename==$itemname)
{
    $sql="UPDATE  product SET itemname='$itemname',et='$et',tax='$tax',it='$it',status='$status',updatedby='$upid',updatedon='$updatedon' where itemid='$itemid'";
    $result= mysqli_query($conn,$sql);
    $query="UPDATE productorder SET itemname='$itemname'where itemid='$itemid'";
    $q=mysqli_query($conn,$query);
    $query="UPDATE secondaryproductorder SET itemname='$itemname'where itemid='$itemid'";
    $q=mysqli_query($conn,$query);
    if($result==TRUE)
    {
        echo 1;
    }
    else{
        echo 0;
    }

//header("location:productupdate.php");
}








?>