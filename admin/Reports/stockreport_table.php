<?php
include('../connect/connect.php');
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
$email=$_SESSION['email'];
$q=mysqli_query($conn, "SELECT UserRoles FROM users where email='$email'");
$b=mysqli_fetch_assoc($q);
$addw=$b['UserRoles'];
$array=json_decode($addw,true);
$view=$array['Record']['View'];
$sr=0;
$query = "SELECT * FROM dailyreport ";
$result = mysqli_query($conn, $query);
?>

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>

    <tr>
        <th>Sr No</th>

        <th>Opening Stock</th>

        <th>Stock_in</th>

        <th>Stock_out</th>

        <th>Closing Stock</th>

        <th>End Stock Date</th>

        <th>Added By</th>

        <th>ADDED ON</th>


    </tr>

    </thead>

    <tbody>
    <?php
    $count=0;
    while($row=$result->fetch_assoc())
    {
        ?>
        <tr>
            <td><?php echo ++$sr;?></td>
            <?php $id=$row['itemid']?>
            <td><?php echo $row['opening'] ; ?></td>
            <td><?php echo $row['stock_in'] ; ?></td>
            <td><?php echo $row['stock_out'] ; ?></td>
            <td><?php echo $row['closing'] ; ?></td>
            <td><?php echo $row['reportdate'] ; ?></td>
            <td><?php
                $addedby= $row['addedby'];
                $qw=mysqli_query($conn,"Select username from users where id='$addedby'");
                $r=mysqli_fetch_array($qw);
                $addedby=$r['username'];
                echo $addedby;

                ?></td>
            <td><?php echo $row['addedon'] ; ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>

</table>
</table>

