<?php


include ('../connect/connect.php');

$filename="primaryreports";
$datefrom = $_POST['datefrom'];
$dateto = $_POST['dateto'];

if ($dateto < $datefrom) {

    echo '<script>alert("Wrong date")</script>';
    header("location:../Reports/primaryreports.php");
    die();
}
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=download.csv');
$output=fopen("php://output","w");
fputcsv($output,array('Order Id','Store Code','Store Id','date','DeliveryDate','AddedBy','Addedon','OrderPrice'));
$filename="secondaryorders";
$query = "SELECT * FROM secondaryorder where DATE(deliverydate) BETWEEN '$datefrom' AND '$dateto'";
$result = mysqli_query($conn, $query);
while($row=$result->fetch_assoc())
{
    fputcsv($output,$row);
}
fclose($output);


?>


