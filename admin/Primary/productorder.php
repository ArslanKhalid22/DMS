<?php
include ('../connect/connect.php');
session_start();
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
$email=$_SESSION['email'];
$sql=mysqli_query($conn,"Select *from users where email='$email'");
$b=mysqli_fetch_array($sql);
$name=$b['username'];
$addedby=$name;
$aid=$b['id'];
$po_code=$_POST['po_code'];
$addedon = date('Y-m-d H:i:s A',strtotime('+3 hours'));
$counter=$_POST['counter'];
mysqli_autocommit($conn, False);
$query="INSERT into primaryorders(po_code,addedby,addedon)VALUES('$po_code','$aid','$addedon')";
$result=mysqli_query($conn,$query);
$poid=mysqli_insert_id($conn);
for($i=1;$i<=$counter;$i++)
{
    $totalprice=$_POST["totalprice_1"];
    $itemid=$_POST["itemid_$i"];
    $itemname=mysqli_real_escape_string($conn,$_POST["username_$i"]);
    $quantity=$_POST["quantity_$i"];
    $et=$_POST["et_$i"];
    $tax=$_POST["tax_$i"];
    $it=$_POST["it_$i"];
    $total=$_POST["total_$i"];
    $sql=mysqli_query($conn,"SELECT * FROM product where itemid='$itemid'");
    $b=mysqli_fetch_array($sql);
    if($b)
    {
        $query="INSERT into productorder(poid,itemid,itemname,quantity,et,tax,it,total,totalorder)VALUES('$poid','$itemid','$itemname','$quantity','$et','$tax','$it','$total','$totalprice')";
        $result=mysqli_query($conn,$query);
        if($result)
        {

            echo 1;
        }
        else{
            mysqli_rollback($conn);
            echo 0;
            die();
        }
    }
    else{
        mysqli_rollback($conn);
        echo 0;
        die();
    }

    $q="Select *from inventory where itemid='$itemid'";
    $result=mysqli_query($conn,$q);
    $row=mysqli_fetch_array($result);
    if($row==0)
    {

        $s="INSERT into inventory (itemid,inv_qty,addedby,addedon)VALUES('$itemid','$quantity','$aid','$addedon')";
        $r=mysqli_query($conn,$s);

        if($r==true)
        {

        }
        else{
            echo 0;
        }
    }
    else{
        $qty=$quantity+$row['inv_qty'];
        $sql="UPDATE inventory SET inv_qty=$qty where itemid=$itemid";
        $result=mysqli_query($conn,$sql);
        if($result==true)
        {

        }
        else{
            echo 0;
        }
    }

}

$sql="UPDATE  primaryorders SET totalorder='$totalprice' where poid='$poid'";
$result= mysqli_query($conn,$sql);
mysqli_commit($conn);

?>

