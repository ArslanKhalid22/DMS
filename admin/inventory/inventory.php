
<?php
session_start();
if(!isset($_SESSION['email']))
{
    header("location:../login/index.php");
}
include('../include/header.php');
include('../include/navbar.php');
include('../connect/connect.php');
$email=$_SESSION['email'];
$query = "SELECT * FROM inventory  ";
$result = mysqli_query($conn, $query);
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <?php include('../include/profile.php');?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid"  id="divmain">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Inventory</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Itemname</th>
                                <th>Quantity</th>
                                <th>Added BY</th>
                                <th>Addedon</th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $sr=0;
                            while ($row = $result->fetch_assoc())
                            {
                                ?>
                                <tr>
                                    <td><?php echo ++$sr;?></td>
                                    <td><?php
                                        $id=$row['itemid'];
                                        $qw=mysqli_query($conn,"Select itemname from product where itemid='$id'");
                                        $r=mysqli_fetch_array($qw);
                                        $itemname=$r['itemname'];
                                        echo $itemname;

                                        ?></td>
                                    <td><?php echo $row['inv_qty']; ?></td>


                                    <td><?php
                                        $addedby= $row['addedby'];
                                        $qw=mysqli_query($conn,"Select username from users where id='$addedby'");
                                        $r=mysqli_fetch_array($qw);
                                        $addedby=$r['username'];
                                        echo $addedby;

                                        ?></td>


                                    <td><?php echo $row['addedon']?></td>

                                </tr>


                                <?php
                            }?>
                            </tbody>
                        </table>
                    </div>
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


