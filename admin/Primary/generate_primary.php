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
$query = "SELECT * FROM primaryorders where DATE(addedon) BETWEEN '$datefrom' AND '$dateto'";
$result = mysqli_query($conn, $query);
?>
<table class="table" bordered="1">
    <tr>
        <th>Order Id</th>
        <th>Added BY</th>
        <th>Added on</th>
        <th>Order Price</th>

    </tr>
    <?php
    while ($row = $result->fetch_assoc())
    {
        ?>

        <tr>
            <td><?php echo $row["poid"]?></td>
            <td><?php
                $addedby= $row['addedby'];
                $qw=mysqli_query($conn,"Select username from users where id='$addedby'");
                $r=mysqli_fetch_array($qw);
                $addedby=$r['username'];
                echo $addedby;
                ?></td>
            <td><?php echo $row["addedon"]?></td>
            <td><?php echo $row["totalorder"]?></td>
        </tr>
        <?php
            header("Content-type: application/xls");
            header("Content-Disposition: attachment; filename=".$filename."-Report.xls");
            header("Pragma: no-cache");
            header("Expires: 0");


        ?>
    <?php
    }
    ?>
</table>


