
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
$add=$array['Store']['Add'];
$delete=$array['Store']['Delete'];
$edit=$array['Store']['Update'];
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <?php include('../include/profile.php');?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid"  id="divmain">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Store</h1>


            <!-- DataTales Example -->
            <div class="card shadow mb-4" id="divmain2">
                <div class="card-header py-3">
                    <?php
                    if($add==1)
                    {?>
                        <button title="Add Store" onclick="storecreate()" class="btn btn-success"><i class="fas fa-fw fa-plus"></i> </button>
                 <?php
                    }
                    ?>
                    </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <?php include "store_table.php" ?>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


    <!-- End of Content Wrapper -->

    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({

                // Set the 3rd column of the
                // DataTable to ascending order
                order: [6, 'desc']
            });
        });
        function storecreate() {
            $.ajax({
                url:"storeCRUD.php",
                data:{action:"addstore"},
                method:"POST",
                success: function(response) {
                    $("#divmain").html(response);
                }
            });
        }
        function submitstore() {
            var s_code=     $("#s_code").val();
            var storename=  $("#storename").val();
            var longitude=  $("#longitude").val();
            var latitude=   $("#latitude").val();
            var status=     $("#status:checked").val();
            $.ajax({
                url:"storecreate.php",
                data:{s_code:s_code,storename:storename,longitude:longitude,latitude:latitude,status:status},
                method:"POST",
                success: async function(response) {
                    console.log(response);
                    if (response == 1) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Store has been added',
                            confirmButtonText: 'Okay',
                            timer: 2000000
                        }).then((result) =>{

                            if(result.isConfirmed)
                            {
                                window.location.href="";
                            }
                        })
                        // let response = await AsyncAjax("store_table.php");
                        // console.log(response);
                        // $("#divmain").html(response);

                    } else {
                        if (response == 0) {
                            Swal.fire("Record not added");
                            return false;
                        }
                        Swal.fire(response);
                    }
                }
            });
            return false;
        }
        function editstore(id) {
            var id=id;
            $.ajax({
                url:"storeCRUD.php",
                data:{id:id,action:"edititem"},
                method:"POST",
                success: function(response) {
                    $("#divmain").html(response);
                }
            });
        }
        function updatestore() {



            swal.fire({
                title: 'Do you want to save the changes?',
                icon: 'info',
                showDenyButton: true,
                confirmButton: 'btn btn-success',
                confirmButtonText: 'Yes',
                denyButtonText: `No`,

            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var id=$("#id").val();
                    var storename=$("#storename").val();
                    var longitude=$("#longitude").val();
                    var latitude=$("#latitude").val();
                    var status=$("#status:checked").val();
                    $.ajax({
                        url:"storeupdate.php",
                        data:{id:id,storename:storename,longitude:longitude,latitude:latitude,status:status},
                        method:"POST",
                        success: async function(response) {
                            console.log(response);
                            if(response == 1){
                                window.location.href="";
                                // let response = await AsyncAjax("store_table.php");
                                // console.log(response);
                                // $("#divmain").html(response);
                                return false;
                            }
                            else{
                                if(response==0)
                                {
                                    Swal.fire("Record not added");
                                    return false;
                                }
                                else
                                {
                                    Swal.fire(response);
                                }

                            }
                        }

                    });


                }
                else if (result.isDenied) {

                }
                else
                {
                    window.location.href="";
                }
            })
            return false;
        }



        function deletestore(id){
            var id=id;
            $.ajax({
                url:"storedelete.php",
                data:{id:id},
                method:"POST",
                success: async function(response) {
                    console.log(response);
                    if(response == 1){
                        window.location.href="";
                    }
                    else{
                        alert("Record not deleted");
                        return false;
                    }
                }
            })
        }



    </script>

    <?php


    include ('../include/scripts.php');
    include ('../include/footer.php');





    ?>


