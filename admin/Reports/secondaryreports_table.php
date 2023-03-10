<?php
include('../connect/connect.php');
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
$email=$_SESSION['email'];

$sr=0;
$query = "SELECT * FROM secondaryorder  ";
$result = mysqli_query($conn, $query);
?>

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

    <thead>

    <tr>
        <th>Sr No</th>

        <th>STORE NAME</th>
        <th>ORDERDATE</th>
        <th>DELIVERY DATE</th>
        <th>ADDED BY</th>
        <th>ADDED ON</th>
        <th>ORDER PRICE</th>

    </tr>

    </thead>

    <tbody>

    <?php



    while ($row = $result->fetch_assoc()) {


        ?>

        <tr>
            <td><?php echo ++$sr;?></td>
            <?php $sid=$row['storeid'];?>
            <td><?php
                $que="Select *from store where storeid=$sid";
                $res=mysqli_query($conn,$que);
                $a=mysqli_fetch_array($res);
                $name=$a['storename'];

                echo $name;
                ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['deliverydate']; ?></td>
            <td><?php
                $addedby= $row['addedby'];
                $qw=mysqli_query($conn,"Select username from users where id='$addedby'");
                $r=mysqli_fetch_array($qw);
                $addedby=$r['username'];
                echo $addedby;

                ?></td>
            <td><?php echo $row['addedon']; ?></td>
            <td><?php echo $row['totalprice']; ?></td>

        </tr>

    <?php       }



    ?>

    </tbody>

</table>

