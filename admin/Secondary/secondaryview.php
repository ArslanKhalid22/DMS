
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
$query = "SELECT * FROM secondaryorder where so_id='$id'";
$resul = mysqli_query($conn, $query);
$b=mysqli_fetch_array($resul);
$query = "SELECT * FROM secondaryproductorder where so_id='$id'";
$result = mysqli_query($conn, $query);
?>
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
            <h1 class="h3 mb-2 text-gray-800">Secondary Product Order</h1>
            <table>
                <td style="padding-left: 1200px" ">
                <a href="secondaryorder.php" role="button" title="Back" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-arrow-left" ></i></a>

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
                                    <th>Secondary Order Code</th>
                                    <td style="padding-left: 100px"><?php
                                        echo $b['so_code']?></td>
                                </tr>
                                <tr>
                                    <th>No of Sku</th>
                                    <td style="padding-left: 100px"><?php  $id=$b['so_id'];$count=mysqli_query($conn,"SELECT COUNT(*) from secondaryproductorder where so_id='$id';"); $c=mysqli_fetch_array($count);
                                        echo $c[0]; ?></td>
                                </tr>
                                <tr>
                                    <th>Order Date</th>
                                    <td style="padding-left: 100px"><?php
                                        echo $b['date']?></td>
                                </tr>
                                <tr>
                                    <th>Delivery Date</th>
                                    <td style="padding-left: 100px"><?php
                                        echo $b['deliverydate']?></td>
                                </tr>
                                <tr>
                                    <th>Total Amount</th>
                                    <td style="padding-left: 100px"><?php echo number_format($b['totalprice'])?></td>
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
                            </table >
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tr>
                                <th>Sr No</th>
                                <th >Item Name</th>

                                <th >Quantity</th>

                                <th >Exc Tax</th>

                                <!--            <th>UPDATED BY</th>-->
                                <!---->
                                <!--            <th>UPDATED ON</th>-->

                                <th>Tax</th>
                                <th>Inx Tax</th>
                                <th>Total</th>

                            </tr>

                            </thead>

                            <tbody>

                            <?php



                            while ($row = $result->fetch_assoc()) {


                            ?>

                            <tr>
                                <td><?php echo ++$sr;?></td>
                                <td><?php echo $row['itemname'];  ?></td>

                                <td><?php echo $row['quantity']; ?></td>

                                <td><?php echo $row['et']; ?></td>


                                <td><?php echo $row['tax'];?></td>
                                <td><?php echo $row['it'];?></td>
                                <td><?php echo number_format($row['total']);$totalorder=$b['totalprice']?></td>
                                <!--                <td><a class="btn btn-info" href="storeupdate.php?storeid=--><?php //echo $row['storeid']; ?><!--">Edit</a><a class="btn btn-danger" href="storedelete.php?storeid=--><?php //echo $row['storeid']; ?><!--">Delete</a></td>-->

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


