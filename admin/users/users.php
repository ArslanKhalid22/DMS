

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
$q=mysqli_query($conn, "SELECT UserRoles,id FROM users where email='$email'");
$b=mysqli_fetch_assoc($q);
$id=$b['id'];
$addw=$b['UserRoles'];
$array=json_decode($addw,true);
$sr=0;
$query = "SELECT * FROM users  ";
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
            <h1 class="h3 mb-2 text-gray-800">User</h1>


            <!-- DataTales Example -->
            <div class="card shadow mb-4" id="divmain2">
                <div class="card-header py-3">
                    <?php if($array['Users']['Add']==1)
                    {?>
                        <button title="Add User" onclick="adduser()" class="btn btn-success"><i class="fas fa-fw fa-plus"></i></button>

                        <?php

                    }
                    ?>

                </div>

                <div class="card-body" >
                    <div class="table-responsive">
                        <?php include ("user_table.php");?>
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

        function adduser() {
            $.ajax({
                url:     "../register/register.php",
                data:    {action:"adduser"},
                method:  "POST",
                success: function(response) {
                    //alert(response);
                    $("#divmain").html(response);
                }
            });
        }
        $(document).ready(function (e) {
            $(document).on('click', '.submit', function () {
                $("#uploadForm").submit(function () {
                    var formData = new FormData(this);
                    var u_code=    $("#u_code").val();
                    formData.append('u_code', u_code);
                    console.log("formdata", $(this).serializeArray());
                    $.ajax({
                        url: "../register/register_process.php",
                        type: "POST",
                        data: formData,
                        contentType: false, cache: false, processData: false,
                        success: function (response) {
                            if (response == 1) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Your Product has been added',
                                    confirmButtonText: 'Okay',
                                    timer: 2000000
                                }).then((result) =>{

                                    if(result.isConfirmed)
                                    {
                                        window.location.href="";
                                    }
                                })
                                // let response = await AsyncAjax("user_table.php");
                                // console.log(response);
                                // $("#divmain").html(response);
                            }
                            else {
                                if (response == 0) {
                                    Swal.fire("Record not added");
                                    return false;
                                }
                                Swal.fire(response);
                            }
                        }
                    });
                    return false;
                })
            });
        });
        // function registeruser() {
        //
        //     var u_code=    $("#u_code").val();
        //     var username=  $("#username").val();
        //     var email=     $("#email").val();
        //     var password=  $("#password").val();
        //     var number=    $("#number").val();
        //     var status=    $("#status:checked").val();
        //     // var filename=  $("#image").val();
        //     $.ajax({
        //         url:       "../register/register_process.php",
        //         data:      {u_code:u_code,username:username,email:email,password:password,number:number,status:status},
        //         method:    "POST",
        //         success: async function(response) {
        //             console.log(response);
        //             if(response == 1){
        //                 window.location.href="";
        //                 // let response = await AsyncAjax("user_table.php");
        //                 // console.log(response);
        //                 // $("#divmain").html(response);
        //                 return false;
        //             }
        //             else{
        //                 if(response==0)
        //                 {
        //                     alert("Record not added");
        //                     return false;
        //                 }
        //                 alert(response);
        //                 return false;
        //             }
        //         }
        //     });
        //     return false;
        // }
        function useredit(id) {
            var id=        id;
            $.ajax({
                url:       "../register/register.php",
                data:      {id:id,action:"edituser"},
                method:    "POST",
                success:function (response) {
                    //alert(response);
                    $("#divmain").html(response);
                }
            });
        }
        function updateuser(){
            swal.fire({
                title: 'Do you want to save the changes?',
                icon: 'info',
                showDenyButton: true,
                confirmButtonText: 'Yes',
                denyButtonText: `No`,

            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var id=         $("#id").val();
                    console.log(id);
                    var username=   $("#username").val();
                    var email=      $("#email").val();
                    var password=   $("#password").val();
                    console.log(password);
                    var number=     $("#number").val();
                    var status=     $("#status:checked").val();
                    $.ajax({
                        url:        "useredit.php",
                        data:       {id:id,username:username,email:email,password:password,number:number,status:status},
                        method:     "POST",
                        success: async function(response) {
                            if(response == 1){
                                window.location.href="";
                                // console.log(response);
                                //  response = await AsyncAjax("user_table.php");
                                //  console.log(response);
                                //     $("#divmain").html(response);
                                return false;
                            }
                            else{
                                if(response==0)
                                {
                                    Swal.fire('Changes are not saved', '', 'info')
                                    return false;
                                }
                                Swal.fire(response);
                                return false;
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


        function userdelete(id) {
            var id=         id;
            $.ajax({
                url:        "userdelete.php",
                data:       {id:id},
                method:     "POST",
                success:function (response) {
                    window.location.href="";
                }
            })
        }

    </script>

    <?php


    include ('../include/scripts.php');
    include ('../include/footer.php');





    ?>


