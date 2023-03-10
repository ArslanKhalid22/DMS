<?php


include '../connect/connect.php';
session_start();
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
$queryString = isset($_REQUEST["q"])?$_REQUEST["q"]:"";
if($queryString == ""){
    echo json_encode(array());
}
else{
    $callBackString = $_REQUEST["callback"];
    $duplicate = json_decode($_REQUEST["duplicate"], true);
    $sCondition = "";
    foreach($duplicate AS $sKey => $id) {
        $sCondition .= $id.",";
    }
    $sCondition = trim($sCondition, ",");
    $newCondition = "";
    if($sCondition != "")
        $newCondition = " AND storeid NOT IN ($sCondition)";
    $resultArray = array();
    $query="SELECT * FROM store WHERE storename LIKE '{$queryString}%' $newCondition and status='active'";
    $result=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($result)){
        /*$itemid=$row['itemid'];
        $itemname=$row['itemname'];
        $et=$row['et'];
        $tax=$row['tax'];
        $it=$row['it'];*/
        $resultArray[] = array(
            "storeid" => (int) $row['storeid'],
            "label" => $row['storename'],
            "value" => $row['storename'],


        );
    }

    echo $callBackString."(".json_encode($resultArray).")";
}
?>