<?php
include_once('../connect/connect.php');
//if(!isset($_COOKIE["PHPSESSID"]))
//{
//    session_start();
//}
if(!isset($_SESSION['email']))
{
    session_start();
    if(!isset($_SESSION['email']))
        header("location:../index.php");
}

//echo "WORKING";
//die();
$email=$_SESSION['email'];
$q=mysqli_query($conn, "SELECT UserRoles,id FROM users where email='$email'");
$b=mysqli_fetch_assoc($q);
$addw=$b['UserRoles'];
$array=json_decode($addw,true);
$id=$b['id'];
$sr=0;
$query = "SELECT * FROM users  ";
$result = mysqli_query($conn, $query);

?>

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th style="width: 4%">User Code</th>
        <th >Username</th>
        <th>Email</th>
        <th>Number</th>
        <th>Status</th>
        <th style="white-space: nowrap">Added By</th>
        <th style="white-space: nowrap">Added on</th>
        <th style="white-space: nowrap">Updated By</th>
        <th style="white-space: nowrap">Updated on</th>

            <th style="text-align: center;">Action</th>


    </tr>
    </thead>
    <tbody>

    <?php



    while ($row = $result->fetch_assoc()) {

        ?>

        <tr>
            <td><?php echo $row['u_code'];?></td>
            <td><?php echo $row['username']; ?></td>

            <td><?php echo $row['email'];
                ?></td>

            <td><?php echo $row['number']; ?></td>
            <td><?php $status= $row['status'];
                if($status==1)
                {
                    echo "Active";
                }
                else{
                    echo "Disabled";
                }

                ?></td>

            <td><?php
                $addedby= $row['addedby'];
                $qw=mysqli_query($conn,"Select username from users where id='$addedby'");
                $r=mysqli_fetch_array($qw);
                $addedby=$r['username'];
                echo $addedby;

                ?></td><td><?php
                $addedon= $row['addedon'];
                echo $addedon;

                ?></td><td><?php
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
            ?>
            <td >

                <?php
                if($array["Users"]["Delete"]==1&&$array["Users"]["Update"]==1)
                {
                    ?>

                    <button title="Edit User"  onclick="useredit(<?php echo $row['id']; ?>)" class="btn btn-primary set" " ><i class="fas fa-fw fa-edit"></i></button>
                    <?php
                }
                else if ($array["Users"]["Delete"]==1&&$array["Users"]["Update"]==0)
                {
                    ?>
                    <?php

                }
                else if ($array["Users"]["Delete"]==0&&$array["Users"]["Update"]==1)
                {
                    ?>

                    <button title="Edit User" onclick="useredit(<?php echo $row['id']; ?>)" class="btn btn-primary set"><i class="fas fa-fw fa-edit"></i></button>
                    <?php

                }
                if($id==13)
                {?>
                    <a title="User Role" href="userroleupdate.php?userid=<?php echo $row['id']; ?>" class="btn btn-dark" role="button" aria-pressed="true"><i class="fas fa-fw fa-person-booth"></i></a>
                    <a title="User Role" href="userview.php?userid=<?php echo $row['id']; ?>" class="btn btn-light" role="button" aria-pressed="true"><i class="fas fa-fw fa-eye"></i></a>

                    <!--                        <button class="btn btn-success"><a href="userroleupdate.php?userid=--><?php //echo $row['id']; ?><!--"> <i class="fas fa-fw fa-person-booth"></i></a></button>-->

                    <?php
                }

                ?>



            </td>


            <!--                <td><a  href="productupdate.php?itemid=--><?php //echo $row['itemid']; ?><!--"<i class="glyphicon glyphicon-edit"</i></a>&nbsp;<a class="glyphicon glyphicon-remove" href="productdelete.php?itemid=--><?php //echo $row['itemid']; ?><!--"</a></td>-->

        </tr>

    <?php       }



    ?>

    </tbody>
</table>
