
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
$q=mysqli_query($conn, "SELECT UserRoles FROM users where email='$email'");
$b=mysqli_fetch_assoc($q);
$addw=$b['UserRoles'];
$array=json_decode($addw,true);
$add=$array['Record']['Add'];
$sr=0;
$query = "SELECT * FROM users ";
$result = mysqli_query($conn, $query);
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <?php include('../include/profile.php');?>

        <!-- Begin Page Content -->
        <div class="container-fluid"  id="divmain">

            <!-- Page Heading -->

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-2 text-gray-800">Users</h1>

            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <?php
                    if($add==1) {
                        ?>
                        <form class="form-inline" method="post" action="../users/generate_user.php">
                            <table border="0">
                                <td>
                                    <button onclick="generate_users()" class="btn-primary btn-sm"><i
                                                class="fas fa-download fa-sm"></i> Generate Report
                                    </button>
                                </td>
                            </table>


                        </form>
                        <?php
                    }
                    ?>

                </div>

                <div class="card-body" id="divmain2">
                    <div class="table-responsive"></div>
                    <?php include("users_table.php");?>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <script>
        function generate_users() {
            var dateto=$("#dateto").val();
            //console.log(dateto);
            var datefrom=$("#datefrom").val();
            $.ajax({
                url:        "../users/generate_user.php",
                data:       {dateto:dateto,datefrom:datefrom},
                method:     "POST",
                success: function(response) {

                }
            });
        }
    </script>
    <?php


    include ('../include/scripts.php');
    include ('../include/footer.php');





    ?>


