
<?php
session_start();
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
include('../include/header.php');
include('../include/navbar.php');
include('../connect/connect.php');
$email=$_SESSION['email'];
$sr=0;
$id=$_GET['userid'];
$query = "SELECT * FROM users where id='$id'";

$resul = mysqli_query($conn, $query);
$b=mysqli_fetch_array($resul);
?>
<style>
</style>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <?php include ('../include/profile.php')?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid"  id="divmain">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">User Detail</h1>
            <table>
                <td style="padding-left: 1200px" ">
                <a href="users.php" role="button" title="Back" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-arrow-left" ></i></a>

                </td>
            </table>

            <!-- DataTales Example -->
            <div class="card shadow mb-4" >


                <div class="card-body" style="">
                    <form onsubmit="return submitt()" name="form_data" id="form_data" method="post">

                        <div class="card-body">
                            <table>
                                <thead>
                                <tr>
                                    <th>User Code</th>
                                    <td style="padding-left: 100px"><?php
                                        echo $b['u_code']?></td>

                                </tr>

                                <tr>
                                    <th>UserName</th>
                                    <td style="padding-left: 100px"><?php   echo $b['username']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td style="padding-left: 100px"><?php
                                        echo $b['email']?></td>
                                </tr>
                                <tr>
                                    <th>Number</th>
                                    <td style="padding-left: 100px"><?php
                                        echo $b['number']?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td style="padding-left: 100px"><?php
                                        if($b['status']==1)
                                        {
                                            echo "Active";
                                        }
                                        else{
                                            echo "Disabled";
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <th>Added By</th>
                                    <td style="padding-left: 100px"><?php
                                        $updatedby= $b['addedby'];
                                        $qw=mysqli_query($conn,"Select username from users where id='$updatedby'");
                                        $r=mysqli_fetch_array($qw);
                                        $updatedby=$r['username'];
                                        echo $updatedby;?></td>
                                </tr>
                                <tr>
                                    <th>Added On</th>
                                    <td style="padding-left: 100px"><?php
                                        echo $b['addedon']?></td>
                                </tr><tr>
                                    <th>Updated By</th>
                                    <td style="padding-left: 100px"><?php
                                        $updatedby= $b['updatedby'];
                                        $qw=mysqli_query($conn,"Select username from users where id='$updatedby'");
                                        $r=mysqli_fetch_array($qw);
                                        $updatedby=$r['username'];
                                        echo $updatedby;?></td>
                                </tr>
                                <tr>
                                    <th>Updated On</th>
                                    <td style="padding-left: 100px"><?php
                                        echo $b['updatedon']?></td>
                                </tr>
<tr>
                                    <th>Roles</th>
                                    <td style="padding-left: 100px"><?php
                                        echo $b['UserRoles']?></td>
                                </tr>




                                </thead>
                            </table >
                        </div>

                    </form>
                </div>
                <div  style="width: 200px;height: 200px;position: absolute;top: 20px;right: 100px;
" >

                    <img class="img-profile rounded-circle" src="../<?php echo $b['file_name']; ?> " width="200px" height="200px">

<!--                    <img src="../--><?php //echo $b['file_name']; ?><!-- " width="200px" height="200px">-->



                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


    <!-- End of Content Wrapper -->



    <?php


    include ('../include/scripts.php');
    include ('../include/footer.php');





    ?>


