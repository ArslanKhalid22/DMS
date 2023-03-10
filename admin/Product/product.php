
<?php
session_start();
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
include('../include/header.php');
include('../include/navbar.php');
include('../connect/connect.php');
$email=             $_SESSION['email'];
$q=                 mysqli_query($conn, "SELECT UserRoles FROM users where email='$email'");
$b=                 mysqli_fetch_assoc($q);
$addw=$b['UserRoles'];
$array=json_decode($addw,true);
$query =            "SELECT * FROM product  ";
$result =           mysqli_query($conn, $query);
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
            <h1 class="h3 mb-2 text-gray-800">Product</h1>


            <!-- DataTales Example -->
            <div class="card shadow mb-4" id="divmain2">
                <div class="card-header py-3">
                    <?php
                    if($array['Product']['Add']==1)
                    {?>
                        <button title="Add Product" onclick="productcreate()" class="btn btn-success"><i class="fa fa-fw fa-plus"></i></button>
                <?php
                    }
                    ?>
                    </div>

                <div class="card-body" >
                    <div class="table-responsive">
                        <?php include ("product_table.php");?>
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
                order: [7, 'desc']
            });
        });

        function productcreate() {
            $.ajax({
                url:        "productCRUD.php",
                data:       {action:"additem"},
                method:     "POST",
                success: function(response) {
                    $("#divmain").html(response);
                }
            });
        }
        function submitproduct() {
            var p_code=     $("#p_code").val();
            var itemname=   $("#itemname").val();
            var et=         $("#et").val();
            var tax=        $("#tax").val();
            var status=     $("#status:checked").val();
            $.ajax({
                url:        "productcreate.php",
                data:       {p_code:p_code,itemname:itemname,et:et,tax:tax,status:status},
                method:     "POST",
                success: async function(response) {
                    //console.log(response);
                    if(response == 1){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Product has been added',
                            confirmButtonText: 'Okay',
                            timer: 2000000
                        }).then((result) =>{

                            if(result.isConfirmed)
                            {
                                window.location.href="";
                            }
                        })

                        // let response = await AsyncAjax("product_table.php");
                        // console.log(response);
                        // $("#divmain").html(response);
                        // return false;
                    }
                    else{
                        Swal.fire('Product Already exist')
                        return false;
                    }
                }
            });
        return false;
        }
        function editproduct(id) {
            var id=     id;
            $.ajax({
                url:       "productCRUD.php",
                data:      {id:id,action:"edititem"},
                method:    "POST",
                success: function(response) {
                    $("#divmain").html(response);
                }
            });
        }
        function updateitem() {
            swal.fire({
                title: 'Do you want to save the changes?',
                icon: 'info',
                showDenyButton: true,

                confirmButtonText: 'Yes',
                denyButtonText: `No`,

            }).then((result) =>  {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var id=       $("#id").val();
                    var itemname= $("#itemname").val();
                    var et=       $("#et").val();
                    var tax=      $("#tax").val();
                    var status=   $("#status:checked").val();
                    $.ajax({
                        url:       "productupdate.php",
                        data:{id:id,itemname:itemname,et:et,tax:tax,status:status},
                        method:"POST",
                        success: async function(response) {
                            console.log(response);
                            if(response == 1){

                                window.location.href="";
                                return false;
                            }
                            else
                            {
                                Swal.fire(response);
                            }

                        }
                    });
                } else if (result.isDenied) {

                }
                else
                {
                    window.location.href="";
                }


            })
            return false;
        }
        // function updateitem() {
        //     var id=       $("#id").val();
        //     var itemname= $("#itemname").val();
        //     var et=       $("#et").val();
        //     var tax=      $("#tax").val();
        //     var status=   $("#status:checked").val();
        //             $.ajax({
        //                 url:       "productupdate.php",
        //                 data:{id:id,itemname:itemname,et:et,tax:tax,status:status},
        //                 method:"POST",
        //                 success: async function(response) {
        //                     console.log(response);
        //                     if(response == 1){
        //                         let response = await AsyncAjax("product_table.php");
        //                         console.log(response);
        //                         $("#divmain").html(response);
        //                         return false;
        //                     }
        //                     else{
        //                         alert(response);
        //                         return false;
        //                     }
        //                 }
        //             });
        //
        // }
        function deleteproduct(id){
            var id = id;
            Swal.fire({
                icon: 'warning',
                title: 'Are you sure you want to delete this record?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: "productdelete.php",
                        data: {id: id},
                        method: "POST",
                        success: function (response) {
                            console.log(response);
                            if (response == 1) {
                                window.location.href = "";
                            } else {
                                alert("Record not deleted");
                                return false;
                            }

                        }
                    })


                }

            });




        }
        
        
    </script>

    <?php


    include ('../include/scripts.php');
    include ('../include/footer.php');





    ?>


