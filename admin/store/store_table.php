<?php

include_once('../connect/connect.php');
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
$email=$_SESSION['email'];
$q=mysqli_query($conn, "SELECT UserRoles FROM users where email='$email'");
$b=mysqli_fetch_assoc($q);
$addw=$b['UserRoles'];
$array=json_decode($addw,true);
$add=$array['Store']['Add'];
$delete=$array['Store']['Delete'];
$edit=$array['Store']['Update'];
$query = "SELECT * FROM store  ";
$result = mysqli_query($conn, $query);
?>
<style>
    th{
        white-space: ;
    }
</style>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th>Code</th>
        <th>Storename</th>
        <th>Longitude</th>
        <th>Latitude</th>
        <th>Status</th>
        <th style="white-space: nowrap">Added BY</th>
        <th>Addedon</th>
        <th style="white-space: nowrap">Updated by</th>
        <th>Updated on</th>
        <?php
        if($delete==0&&$edit==0)
        {

        }
        else{
            ?>
            <th>Action</th>
            <?php
        }

        ?>


    </tr>
    </thead>
    <tbody>

    <?php
    $sr=0;
    while ($row = $result->fetch_assoc())
    {
        ?>
        <tr>
            <td><?php echo $row['s_code'];?></td>

            <td><?php echo $row['storename']; ?></td>

            <td><?php echo round($row['longitude'],10); ?></td>

            <td><?php echo round($row['latitude'],10); ?></td>


            <td><?php $status= $row['status'];
                if($status==1)
                {
                    echo "Active";
                }
                else{
                    echo "Disabled";
                }?></td>

            <td><?php
                $addedby= $row['addedby'];
                $qw=mysqli_query($conn,"Select username from users where id='$addedby'");
                $r=mysqli_fetch_array($qw);
                $addedby=$r['username'];
                echo $addedby;

                ?></td>


            <td><?php echo $row['addedon']?></td>

            <td><?php
                $updatedby= $row['updatedby'];
                $qw=mysqli_query($conn,"Select username from users where id='$updatedby'");
                $r=mysqli_fetch_array($qw);
                $updatedby=$r['username'];
                echo $updatedby;

                ?></td>
            <td><?php $update= $row['updatedon'];
                if($update!="0000-00-00 00:00:00")
                {
                    echo $update;
                }?></td>

                <?php
                if($delete==1&&$edit==1) {
                    ?>
            <td style="white-space: nowrap">
                    <button title="Edit Store" onclick="editstore(<?php echo $row['storeid']; ?>)" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i></button>
                       </td>
                    <?php
                }

                else if ($delete==1&&$edit==0)
                {
                    ?>

                    <?php

                }
                else if ($delete==0&&$edit==1)
                {
                    ?>
            <td style="white-space: nowrap>
                    <button title="Edit Store" onclick="editstore(<?php echo $row['storeid']; ?>)" class="btn btn-primary "><i class="fa fa-fw fa-edit"></i></button>
            </td>
                <?php

                }


                ?>



        </tr>


        <?php
    }?>
    </tbody>
</table>