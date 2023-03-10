<?php
error_reporting(E_NOTICE);
include ('../connect/connect.php');

session_start();
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
$email=$_SESSION['email'];
include('../include/header.php');
include ('../include/navbar.php');
$userid = $_GET['userid'];
$a=mysqli_query($conn, "SELECT * FROM users where id='$userid'");
$b=mysqli_fetch_array($a);
$addw=$b['UserRoles'];
$array=json_decode($addw,true);
$adduser=$array['Users']['Add'];
$deleteuser=$array['Users']['Delete'];
$edituser=$array['Users']['Update'];
$addproduct=$array['Product']['Add'];
$deleteproduct=$array['Product']['Delete'];
$editproduct=$array['Product']['Update'];
$addstore=$array['Store']['Add'];
$deletestore=$array['Store']['Delete'];
$editstore=$array['Store']['Update'];
$addprimary=$array['PrimaryOrder']['Add'];
$addsecondary=$array['SecondaryOrder']['Add'];
$addreport=$array['Record']['Add'];
$viewuser=$array['Users']['View'];
$viewproduct=$array['Product']['View'];
$viewstore=$array['Store']['View'];
$viewprimary=$array['PrimaryOrder']['View'];
$viewsecondary=$array['SecondaryOrder']['View'];
$viewreport=$array['Record']['View'];

?>
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
            <h1 class="h3 mb-2 text-gray-800">USERS</h1>


            <!-- DataTales Example -->
            <div class="card shadow mb-4" id="divmain2">
                <div class="card-header py-3">

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <form method="post" action="useri.php?userid=<?php echo $userid?>" class="checkbox">
                            <table  align="center" cellpadding="5" cellspacing="5" border="0" class="design">
                                <tr><td colspan="2" class="info" align="center"><h1>Product Update</h1></td></tr>
                                <input type="hidden" name="itemid" value="">
                                <tr><td><input type="checkbox" name="checkall" id="checkall"  ></td></tr>
                                <td><input type="hidden" name="id" id="id" value="<?php $userid?>"></td>
                                <tr><td class="labels">Users: <br>
                                    </td>
                                    <td><input type="checkbox" size="25" id="viewuser"  class="checkall" name="viewuser" <?php if($viewuser==1) {echo "checked";}?>>View</td>
                                    <td><input type="checkbox" size="25" class="checkall"  name="adduser" <?php if($adduser==1) {echo "checked";}?>>Add</td>
                                    <td><input type="checkbox" size="25" class="checkall"  name="deleteuser"<?php if($deleteuser==1){echo "checked";} ?>>Delete</td>
                                    <td><input type="checkbox" size="25" class="checkall"  name="edituser" <?php if($edituser==1){echo "checked";}?>>Edit</td>
                                </tr>
                                <tr><td class="labels">Product: <br>
                                    </td>
                                    <td><input type="checkbox" size="25" class="checkall"name="viewproduct" <?php if($viewproduct==1) {echo "checked";}?>>View</td>
                                    <td><input type="checkbox" size="25" class="checkall"name="addproduct" <?php if($addproduct==1) {echo "checked";}?>>Add</td>
                                    <td><input type="checkbox" size="25" class="checkall"name="deleteproduct"<?php if($deleteproduct==1){echo "checked";} ?>>Delete</td>
                                    <td><input type="checkbox" size="25" class="checkall"name="editproduct" <?php if($editproduct==1){echo "checked";}?>>Edit</td>
                                </tr>
                                <tr><td class="labels">Store: <br>
                                    </td>
                                    <td><input type="checkbox" size="25" class="checkall"name="viewstore" <?php if($viewstore==1) {echo "checked";}?>>View</td>
                                    <td><input type="checkbox" size="25" class="checkall"name="addstore" <?php if($addstore==1) {echo "checked";}?>>Add</td>
                                    <td><input type="checkbox" size="25" class="checkall"name="deletestore"<?php if($deletestore==1){echo "checked";} ?>>Delete</td>
                                    <td><input type="checkbox" size="25" class="checkall"name="editstore" <?php if($editstore==1){echo "checked";}?>>Edit</td>
                                </tr>
                                <tr><td class="labels">Primary order: <br>
                                    </td>
                                    <td><input type="checkbox" size="25" class="checkall"name="viewprimary" <?php if($viewprimary==1) {echo "checked";}?>>View</td>
                                    <td><input type="checkbox" size="25" class="checkall"name="addprimary" <?php if($addprimary==1) {echo "checked";}?>>Add</td>
                                </tr>
                                <tr><td class="labels">Secondary order: <br>
                                    </td>
                                    <td><input type="checkbox" size="25" class="checkall"name="viewsecondary" <?php if($viewsecondary==1) {echo "checked";}?>>View</td>
                                    <td><input type="checkbox" size="25" class="checkall"name="addsecondary" <?php if($addsecondary==1) {echo "checked";}?>>Add</td>
                                </tr>
                                <tr><td class="labels">Report: <br>
                                    </td>
                                    <td><input type="checkbox" size="25" class="checkall"name="viewreport" <?php if($viewreport==1) {echo "checked";}?>>View</td>
                                    <td><input type="checkbox" size="25" class="checkall"name="addreport" <?php if($addreport==1) {echo "checked";}?>>Add</td>
                                </tr>
                                <tr><td colspan="0" align="center"><input type="submit" name="save" value="Save" class="fields" /></td><td>
                                    <td ><button style="border:none" ><a  href="preview.php?userid=<?php echo $userid;?>">Preview</button></td>
                                </tr>


                            </table>

                        </form>




                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

        <script >
            $(function () {
                $("#checkall").click(function () {
                    $('.checkall').attr('checked', this.checked);
                });
                $(".checkall").click(function () {
                    if ($(".checkall").length == $(".checkall:checked").length) {
                        $("#checkall").attr("checked", "checked");
                    } else {
                        $("#checkall").removeAttr("checked");
                    }
                });
            });
        </script>

    <!-- End of Content Wrapper -->


    <?php


    include ('../include/scripts.php');
    include ('../include/footer.php');





    ?>
