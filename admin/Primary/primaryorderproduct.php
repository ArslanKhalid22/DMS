
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
$id=$_GET['orderid'];
$query = "SELECT * FROM primaryorders where poid='$id'";
$resul = mysqli_query($conn, $query);
$b=mysqli_fetch_array($resul);
$query = "SELECT * FROM productorder where poid='$id'";
$result = mysqli_query($conn, $query);
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <?php include ('../include/profile.php') ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->




        <div class="container-fluid"  id="divmain">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Primary Product Order</h1>
            <table>
                <td style="padding-left: 1200px" ">
                <a href="primaryorder.php" role="button" title="Back" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-arrow-left" ></i></a>

                </td>
            </table>
           <!-- DataTales Example -->
            <div class="card shadow mb-4">


                <div class="card-body">
                    <form onsubmit="return submitt()" name="form_data" id="form_data" method="post">
                        <div class="card-body">
                            <table>
                                <thead>
                                <tr>
                                    <th>Primary Order Code</th>
                                    <td style="padding-left: 100px"><?php
                                        echo $b['po_code']?></td>
                                </tr>
                                <tr>
                                    <th>No of Sku</th>
                                    <td style="padding-left: 100px"><?php  $id=$b['poid'];$count=mysqli_query($conn,"SELECT COUNT(*) from productorder where poid='$id';"); $c=mysqli_fetch_array($count);
                                        echo $c[0]; ?></td>
                                </tr>
                                <tr>
                                    <th>Total Amount</th>
                                    <td style="padding-left: 100px"><?php echo number_format($b['totalorder'])?></td>
                                </tr>
                                <tr>
                                    <th>Added By</th>
                                    <td style="padding-left: 100px"><?php $addedby= $b['addedby'];
                                        $qw=mysqli_query($conn,"Select * from users where id='$addedby'");
                                        $r=mysqli_fetch_array($qw);
                                        $added=$r['username'];
                                        echo $added;?></td>
                                </tr>
                                <tr>
                                    <th>Added On</th>
                                    <td style="padding-left: 100px"><?php echo $b['addedon']?></td>
                                </tr>

                                </thead>
                            </table>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tr>

                                <th >Item Name</th>

                                <th >Quantity</th>

                                <th >Exc Tax</th>

                                <th>Tax</th>
                                <th>Inc Tax</th>
                                <th>Total</th>

                            </tr>

                            </thead>

                            <tbody>

                            <?php



                            while ($row = $result->fetch_assoc()) {

                            ?>

                            <tr>

                                <td><?php

                                    $itemname=mysqli_real_escape_string($conn,$row['itemname']);
                                    echo $row['itemname'];  $id=$row['poid'];?></td>

                                <td><?php echo $row['quantity']; ?></td>

                                <td><?php echo $row['et']; ?></td>


                                <td><?php echo $row['tax'];?></td>
                                <td><?php echo $row['it'];?></td>
                                <td><?php echo number_format($row['total']); $totalorder=$row['totalorder'];?></td>

                                <?php       }



                                ?>

                            </tbody>
                        </table class="table table-bordered"  width="100%" cellspacing="0">
                        <table>
                            <thead>
                            <tr>
                                <th style="padding-top: 10px">Total Amount</th>
                                <td></td>
                                <td></td>
                                <td style="padding-left: 970px "><?php echo number_format($totalorder) ?></td>
                            </tr>
                            </thead>

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


