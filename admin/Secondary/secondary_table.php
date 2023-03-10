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
$add=$array['SecondaryOrder']['Add'];
$view=$array['SecondaryOrder']['View'];
$query = "SELECT * FROM secondaryorder  ";
$result = mysqli_query($conn, $query);
?>
<style>
    th{
            white-space: nowrap;
    }
</style>
<table  class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
    <tr>
        <th >SO Code</th>
        <th >Store Name</th>
        <th>No OF SKU</th>
        <th>Order Date</th>
        <th >Delivery Date</th>
        <th>Amount</th>
        <th >Added By</th>
        <th >Added On</th>

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


            <td><?php echo $row['so_code']; ?></td>
            <?php  $sid=$row['storeid'];?>
            <td><?php
                $que="Select *from store where storeid=$sid";
                $res=mysqli_query($conn,$que);
                $a=mysqli_fetch_array($res);
                $name=$a['storename'];
                echo $name;
                ?></td>
            <td><?php  $id=$row['so_id'];$count=mysqli_query($conn,"SELECT COUNT(*) from secondaryproductorder where so_id='$id';"); $b=mysqli_fetch_array($count);
                echo $b[0]; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['deliverydate']; ?></td>
            <td><?php echo number_format($row['totalprice']); ?></td>
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
            <td><a href="secondaryview.php?orderid=<?php echo $row['so_id'];?>" role="button" class="btn btn-primary"><i class="fas fs-fw fa-eye" ></i></a></td>
<?php
            }
     ?>
        </tr>

    <?php       }



    ?>

    </tbody>
</table>

