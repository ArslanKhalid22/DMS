<?php
include('../connect/connect.php');

if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
    $email=             $_SESSION['email'];
    $q=                 mysqli_query($conn, "SELECT UserRoles FROM users where email='$email'");
    $b=                 mysqli_fetch_assoc($q);
    $query =            "SELECT * FROM product  ";
    $result =           mysqli_query($conn, $query);

?>
<html>
<style>
</style>

    <table  id="dataTable" class="table-bordered">
        <thead>
        <tr>
            <th style="white-space:nowrap">Sku Code</th>
            <th>Itemname</th>
            <th>ET</th>
            <th>Tax</th>
            <th>IT</th>
            <th>Status</th>
            <th style="white-space:nowrap">Added BY</th>
            <th>Addedon</th>
            <th style="white-space:nowrap">Updated by</th>
            <th>Updated on</th>

            <?php
            if($array['Product']['Add']==0&&$array['Product']['Delete']==0&&$array['Product']['Update']==0)
            {

            }
            else{
                ?>
            <th>Action</th>
            <?php
            }

            ?>


        </tr>
        </thead>
        <tbody>

        <?php
        $sr=0;
        while ($row = $result->fetch_assoc())
        {
            ?>
            <tr>
                <td><?php   echo $row['p_code'];     ?></td>
                <td><?php   echo $row['itemname'];   ?></td>
                <td><?php   echo number_format($row['et']);         ?></td>
                <td><?php   echo number_format($row['tax']);        ?></td>
                <td><?php   echo number_format($row['it']);         ?></td>

                <td>
                    <?php   $status= $row['status'];
                            if($status==1)
                            {
                                    echo "Active";
                            }
                            else{
                                    echo "Disabled";
                            }

                    ?>
                </td>

                <td>
                    <?php
                            $addedby= $row['addedby'];
                            $qw=mysqli_query($conn,"Select username from users where id='$addedby'");
                            $r=mysqli_fetch_array($qw);
                            $addedby=$r['username'];
                            echo $addedby;

                    ?>
                </td>


                <td><?php   echo $row['addedon']        ?></td>

                <td>
                    <?php
                            $updatedby= $row['updatedby'];
                            $qw=mysqli_query($conn,"Select username from users where id='$updatedby'");
                            $r=mysqli_fetch_array($qw);
                            $updatedby=$r['username'];
                            echo $updatedby;

                    ?>
                </td>
                <td>
                    <?php
                            $update= $row['updatedon'];
                            if($update!="0000-00-00 00:00:00")
                            {
                                echo $update;
                            }
                    ?>
                </td>

                    <?php
                            if($array['Product']['Delete']==1&&$array['Product']['Update']==1)
                            {
                    ?>
                <td style="white-space: nowrap">
                            <button title="Edit Product" onclick="editproduct(<?php echo $row['itemid']; ?>)"
                                    class="btn btn-primary "><i class="fa fa-fw fa-edit" ></i>
                            </button>
                            <button title="Delete Product" onclick="deleteproduct(<?php echo $row['itemid']; ?>)"
                                    class="btn btn-danger "><i class="fa fa-fw fa-trash" ></i>
                            </button>
                </td>
                     <?php
                            }
                            else if ($array['Product']['Delete']==1&&$array['Product']['Update']==0)
                            {
                     ?>
                <td style="white-space: nowrap">
                            <button title="Delete Product" onclick="deleteproduct(<?php echo $row['itemid']; ?>)" class="btn btn-danger "><i class="fa fa-fw fa-trash-o" style="font-size:48px;color:red "></i></button>
                </td>
                     <?php

                            }
                            else if ($array['Product']['Delete']==0&&$array['Product']['Update']==1)
                            {
                     ?>
                <td style="white-space: nowrap">
                            <button title="Edit Product" onclick="editproduct(<?php echo $row['itemid']; ?>)" class="btn btn-primary "><i class="fa fa-fw fa-trash-o" style="font-size:48px;color:red "></i></button>
                </td>
                     <?php

                    }


                    ?>

            </tr>


                    <?php
        }
                    ?>
        </tbody>
    </table>

