<?php

error_reporting(E_NOTICE);
include ('../connect/connect.php');

$filename="UserReports";
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
?>
<table class="table" bordered="1">
    <tr><th colspan="6">Userinfo</th>
        <th colspan="4">User</th>
        <th colspan="4">Product</th>
        <th colspan="4">Store</th>
        <th colspan="2">Primary Order</th>
        <th colspan="2">Secondary Order</th>
        <th colspan="6">Reports</th>
    <tr>
        <th>UserId</th>
        <th>Username</th>
        <th>Email</th>
        <th>Status</th>
        <th>Updated By</th>
        <th>Updated On</th>
        <th>View User</th>
        <th>Add User</th>
        <th>Edit User</th>
        <th>Delete User</th>
        <th>View Product</th>
        <th>Add product</th>
        <th>Edit product</th>
        <th>Delete product</th>
        <th>View Store</th>
        <th>Add Store</th>
        <th>Edit Store</th>
        <th>Delete Store</th>
        <th>View Primary order</th>
        <th>Add Primary order</th>
        <th>View Secondary Order</th>
        <th>Add Secondary Order</th>
        <th>View Primary Report</th>
        <th>Generate Primary Report</th>
        <th>View Secondary Report</th>
        <th>Generate Seconadary Report</th>
        <th>View Daily Report</th>
        <th>Generate Daily report Report</th>

    </tr>
    <?php
    while ($row = $result->fetch_assoc())
    {
        ?>

        <tr>
            <td><?php echo $row["id"]?></td>
            <td><?php echo $row["username"]?></td>
            <td><?php echo $row["email"]?></td>
            <td><?php echo $row["status"]?></td>
            <td><?php
                $addedby= $row['updatedby'];
                $qw=mysqli_query($conn,"Select username from users where id='$addedby'");
                $r=mysqli_fetch_array($qw);
                $addedby=$r['username'];
                echo $addedby;
                ?></td>
            <td><?php echo $row["updatedon"]?></td>
            <td><?php echo $row["viewuser"]?></td>
            <td><?php echo $row["adduser"]?></td>
            <td><?php echo $row["edituser"]?></td>
            <td><?php echo $row["deleteuser"]?></td>
            <td><?php echo $row["viewproduct"]?></td>
            <td><?php echo $row["addproduct"]?></td>
            <td><?php echo $row["editproduct"]?></td>
            <td><?php echo $row["deleteproduct"]?></td>
            <td><?php echo $row["viewstore"]?></td>
            <td><?php echo $row["addstore"]?></td>
            <td><?php echo $row["editstore"]?></td>
            <td><?php echo $row["deletestore"]?></td>
            <td><?php echo $row["viewprimary"]?></td>
            <td><?php echo $row["addprimary"]?></td>
            <td><?php echo $row["viewsecondary"]?></td>
            <td><?php echo $row["addsecondary"]?></td>
            <td><?php echo $row["viewreport"]?></td>
            <td><?php echo $row["addreport"]?></td>
            <td><?php echo $row["viewreport"]?></td>
            <td><?php echo $row["addreport"]?></td>
            <td><?php echo $row["viewreport"]?></td>
            <td><?php echo $row["addreport"]?></td>
        </tr>
        <?php
        // Genrating Execel  filess
        header("Content-type: application/xls");
        header("Content-Disposition: attachment; filename=".$filename."-Report.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
    }
    ?>
</table>


