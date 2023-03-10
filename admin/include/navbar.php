
<?php
include('../connect/connect.php');
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
$email=$_SESSION['email'];
$q=mysqli_query($conn, "SELECT UserRoles,id FROM users where email='$email'");
$b=mysqli_fetch_assoc($q);
$id=$b['id'];
$addw=$b['UserRoles'];
$array=json_decode($addw,true);
$viewuser=$array['Users']['View'];
$viewproduct=$array['Product']['View'];
$viewstore=$array['Store']['View'];
$viewreport=$array['Record']['View'];
$viewprimary=$array['PrimaryOrder']['View'];
$viewsecondary=$array['SecondaryOrder']['View'];
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="http://localhost/admin/admin/dashboard/index.php">
        <div class="sidebar-brand-icon rotate-n-15">

            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">JUGNU<sup></sup></div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="http://localhost/admin/admin/dashboard/index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>
    <?php
    if($viewproduct==1)
    {?>
        <li class="nav-item">
            <a class="nav-link" href="http://localhost/admin/admin/Product/product.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Product</span></a>
        </li>
    <?php
    }
    ?>
    <!-- Nav Item - Pages Collapse Menu -->

    <?php
    if($viewstore==1)
    {?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="http://localhost/admin/admin/store/store.php">
                <i class="fas fa-fw fa-store"></i>
                <span>Store</span></a>
        </li>
        <?php
    }
    ?>
    <!-- Nav Item - Utilities Collapse Menu -->

    <?php
    if($viewuser==1)
    {?>
        <li class="nav-item">
            <a class="nav-link" href="http://localhost/admin/admin/users/users.php">
                <i class="fas fa-fw fa-user-circle"></i>
                <span>User</span></a>
        </li>
        <?php
    }
    ?>

        <li class="nav-item">
            <a class="nav-link" href="http://localhost/admin/admin/inventory/inventory.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Inventory</span></a>
        </li>

    <?php
    if($viewprimary==1)
    {?>
        <li class="nav-item">
            <a class="nav-link" href="http://localhost/admin/admin/Primary/primaryorder.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Primary Order</span></a>
        </li>
        <?php
    }


    ?>

    <?php
    if($viewsecondary==1)
    {?>
        <li class="nav-item">
            <a class="nav-link" href="http://localhost/admin/admin/Secondary/secondaryorder.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Secondary Order</span></a>
        </li>

        <?php
    }


    ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

<!--     //Nav Item - Pages Collapse Menu-->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
           aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Reports</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="../Reports/primaryreports.php">Primary Reports</a>
                <a class="collapse-item" href="../Reports/secondaryreports.php">Secondary Reports</a>
                <a class="collapse-item" href="../Reports/userreport.php">Users Report</a>
                <a class="collapse-item" href="../Reports/stockreport.php">Stock Reprt</a>
                <div class="collapse-divider"></div>

            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
<!--    <li class="nav-item">-->
<!--        <a class="nav-link" href="charts.html">
<!--            <i class="fas fa-fw fa-chart-area"></i>-->
<!--            <span>Charts</span></a>-->
<!--    </li>-->
<!--
<!--    <!-- Nav Item - Tables -->
<!--    <li class="nav-item">-->
<!--        <a class="nav-link" href="tables.html">-->
<!--            <i class="fas fa-fw fa-table"></i>-->
<!--            <span>Tables</span></a>-->
<!--    </li>-->



</ul>
<!-- End of Sidebar -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button onclick="logout()" class="btn btn-primary" type="button" data-dismiss="modal">Logout</button>
<!--                <a class="btn btn-primary" href="../login/logout.php">Logout</a>-->
            </div>
        </div>
    </div>
</div>
<script>
    function logout() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }

        })

        Toast.fire({
            icon: 'success',
            title: 'Signed out successfully'
        })
        $.ajax({
            url: '../login/logout.php',
            data: "post",
            success: function(response) {
                if (response == 1) {
                    window.location.href = "../index.php";



                }
            }
        })
        return false;
    }
</script>