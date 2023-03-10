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
$query = "SELECT * FROM users  ";
$result = mysqli_query($conn, $query);
?>

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th>Sr No</th>
        <th>Username</th>
        <th>Email</th>
        <th>Status</th>

        <th>Updated BY </th>

        <th>Updated on </th>


    </tr>

    </thead>

    <tbody>

    <?php
    while($row=$result->fetch_assoc())
    {
        ?>
        <tr>
            <td><?php echo ++$sr;?></td>
            <td><?php echo $row['username'] ; ?></td>
            <td><?php echo $row['email'] ; ?></td>
            <td><?php echo $row['status'] ; ?></td>
            <td><?php
                $addedby= $row['updatedby'];
                $qw=mysqli_query($conn,"Select username from users where id='$addedby'");
                $r=mysqli_fetch_array($qw);
                $addedby=$r['username'];
                echo $addedby;

                ?></td>
            <td><?php echo $row['updatedon'] ; ?></td>
        </tr>
        <?php
    }
    ?>

    </tbody>
</table>

