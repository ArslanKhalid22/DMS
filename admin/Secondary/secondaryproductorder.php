<?php


include ('../connect/connect.php');
session_start();
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
$counter=$_POST['counter'];
$date=$_POST['orderdate'];
$deliverydate=$_POST['deliverydate'];
if($date>$deliverydate)
{
    echo "wrong delivery date";
    die();
}
else{

}
for($i=1;$i<=$counter;$i++)
{

    $itemid=$_POST["itemid_$i"];
    $quantity=$_POST["quantity_$i"];
    $q="Select *from inventory where itemid='$itemid'";
    $result=mysqli_query($conn,$q);
    $row=mysqli_fetch_assoc($result);
    $qty=$row['inv_qty']-$quantity;

    if($qty<0)
    {
        echo $_POST["username_$i"];
        echo " ";
        echo " are not availble ";
        die();
    }


}
$email=$_SESSION['email'];
$sql=mysqli_query($conn,"Select *from users where email='$email'");
$b=mysqli_fetch_array($sql);
$name=$b['username'];
$aid=$b['id'];
$addedby=$name;
$addedon = date('Y-m-d H:i:s A',strtotime('+3 hours'));
//print_r($_POST);
$counter=$_POST['counter'];
$storeid=$_POST['storeid'];
$so_code=$_POST['so_code'];
$date=date('Y-m-d H:i:s A',strtotime('+3 hours'));
$deliverydate=$_POST['deliverydate'];

mysqli_autocommit($conn, False);
$query="INSERT into secondaryorder(so_code,storeid,date,deliverydate,addedby,addedon,totalprice)VALUES('$so_code','$storeid','$date','$deliverydate','$aid','$addedon','')";
$result=mysqli_query($conn,$query);
$so_id=mysqli_insert_id($conn);
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
        $query="INSERT into secondaryproductorder(so_id,itemid,itemname,quantity,et,tax,it,total,totalorder)VALUES('$so_id','$itemid','$itemname','$quantity','$et','$tax','$it','$total','$totalprice')";
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
    $row=mysqli_fetch_assoc($result);
    if($row==0)
    {
        echo "WE ARE OUT OF STOCK";

    }
    else{

        $qty=$row['inv_qty']-$quantity;
        $sql="UPDATE inventory SET inv_qty=$qty where itemid=$itemid";
        $result=mysqli_query($conn,$sql);
        if($qty==0)
        {
            $s="Delete from inventory where itemid='$itemid'";
            $r=mysqli_query($conn,$s);
        }
    }

}

$sql="UPDATE  secondaryorder SET totalprice='$totalprice' where so_id='$so_id'";
$result= mysqli_query($conn,$sql);
mysqli_commit($conn);

?>