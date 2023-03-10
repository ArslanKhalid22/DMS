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
$query = "SELECT * FROM primaryorders  ";
$result = mysqli_query($conn, $query);
?>

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th width="5%">Sr No</th>
        <th width="30%">ADDED BY</th>

        <th width="30%">ADDED ON</th>

        <th width="35%">ORDER PRICE</th>



    </tr>

    </thead>

    <tbody>

    <?php
    while ($row = $result->fetch_assoc()) {


        ?>

        <tr>
            <td><?php echo ++$sr;?></td>

            <td><?php
                $addedby= $row['addedby'];
                $qw=mysqli_query($conn,"Select * from users where id='$addedby'");
                $r=mysqli_fetch_array($qw);
                $added=$r['username'];
                echo $added;

                ?></td>

            <td><?php echo $row['addedon']; ?></td>

            <td><?php echo $row['totalorder'];?></td>

        </tr>

    <?php       }



    ?>

    </tbody>
</table>

