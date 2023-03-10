<?php
include('../connect/connect.php');
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
$email=$_SESSION['email'];
$q=mysqli_query($conn, "SELECT UserRoles FROM users where email='$email'");
$b=mysqli_fetch_assoc($q);
$view=$array['PrimaryOrder']['View'];
$sr=0;
$query = "SELECT * FROM primaryorders  ";
$result = mysqli_query($conn, $query);
?>

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th>PO_Code</th>
        <th>No of SKU</th>
        <th>Order Price</th>
        <th width="20%">Added By</th>

        <th width="30%">Added On</th>


        <?php
        if($view==1)
        {?>
        <th>Action</th>
        <?php
        }
        ?>


    </tr>

    </thead>

    <tbody>

    <?php
    while ($row = $result->fetch_assoc()) {


        ?>

        <tr>

            <td><?php echo $row['po_code']; ?></td>
            <td><?php  $id=$row['poid'];$count=mysqli_query($conn,"SELECT COUNT(*) from productorder where poid='$id';"); $b=mysqli_fetch_array($count);
                echo $b[0]; ?></td>
            <td><?php echo number_format($row['totalorder']);?></td>
            <td><?php
                $addedby= $row['addedby'];
                $qw=mysqli_query($conn,"Select * from users where id='$addedby'");
                $r=mysqli_fetch_array($qw);
                $added=$r['username'];
                echo $added;
                ?></td>

            <td><?php echo $row['addedon']; ?></td>


            <?php if($view==1)
                {?>
                        <td><a href="primaryorderproduct.php?orderid=<?php echo $row['poid'];?>" role="button" class="btn btn-primary"><i class="fas fa-fw fa-eye" ></i></a></td>
            <?php
                }
                        ?>
            </tr>

    <?php       }



    ?>

    </tbody>
</table>

