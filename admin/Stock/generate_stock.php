<?php

error_reporting(E_NOTICE);
include ('../connect/connect.php');
session_start();
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
$email=$_SESSION['email'];
$user=mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$name=mysqli_fetch_array($user);
$username=$name['username'];
$filename="stockreport";
$datefrom = $_POST['datefrom'];
$dateto = $_POST['dateto'];
$today=date("Y-m-d");
$daydatee = new DateTime($dateto);

//Subtract a day using DateInterval
$yesterdayTime = $daydatee->sub(new DateInterval('P1D'));

//Get the date in a YYYY-MM-DD format.
$yesterday = $yesterdayTime->format('Y-m-d');
if ($dateto < $datefrom) {

    echo '<script>alert("Wrong date")</script>';
    header("location:../Reports/stockreport.php");
    die();
}
$query = "SELECT * FROM dailyreport where DATE(reportdate) BETWEEN '$datefrom' AND '$yesterday' ORDER BY reportdate ASC ";
$result = mysqli_query($conn, $query);
?>
<table class="table" bordered="1">
    <tr>
        <th>ITEM ID</th>
        <th>Opening Stock</th>

        <th>Stock_in</th>

        <th>Stock_out</th>

        <th>Closing Stock</th>

        <th>End Stock Date</th>

        <th>Added By</th>

        <th>ADDED ON</th>


    </tr>
    <?php
    while ($row = $result->fetch_assoc())
    {?>
        <tr>
        <td><?php echo $row['itemid'] ?></td>
        <td><?php echo $row['opening'] ; ?></td>
        <td><?php echo $row['stock_in'] ; ?></td>
        <td><?php echo $row['stock_out'] ; ?></td>
        <td><?php echo $row['closing'] ; ?></td>
        <td><?php echo $row['reportdate'] ; ?></td>
        <td><?php
            $addedby= $row['addedby'];
            $qw=mysqli_query($conn,"Select username from users where id='$addedby'");
            $r=mysqli_fetch_array($qw);
            $addedby=$r['username'];
            echo $addedby;
            ?></td>
        <td><?php echo $row['addedon'] ; ?></td>

        </tr><?php
        header("Content-type: application/xls");
        header("Content-Disposition: attachment; filename=".$filename."-Report.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
    }?>

    <?php

    if($dateto==$today)
    {
        $a=mysqli_query($conn, "SELECT itemid FROM product ");

        while ($row = $a->fetch_assoc()) {

            //            echo "hello";
            ?>

            <tr>

                <td><?php echo $row['itemid'] ; $id=$row['itemid']?></td>

                <?php
                $inv_qty=0;
                //                $qtry="Select *from dailyreport where reportdate=$yesterday";

                $i=mysqli_query($conn,"Select *from dailyreport where reportdate='$yesterday'");

                if ($i->num_rows > 0) {



                    while($row=$i->fetch_assoc())
                    {
                        $itemid=$row['itemid'];
                        $closingbalance=$row['closing'];
//                    echo $closingbalance;
                        if($itemid==$id)
                        {
                            $inv_qty=$closingbalance;
                        }
                    }

                }
                ?>
                <td><?php  if($inv_qty!="")
                    {
                        echo $inv_qty;
                    }
                    else{
                        echo 0;
                    }?></td>



                <td>

                    <?php

                    //                            $q=mysqli_query($conn,"Select poid from primaryorders where addedon =$daydate");
                    //                            $r=mysqli_fetch_array($q);
                    //                            $poid=$r['poid'];
                    //                            echo $poid;
                    $query="Select poid from primaryorders where DATE(addedon)= '$dateto'";
                    $result=mysqli_query($conn,$query);
                    if($result)
                    {
                        $count=0;
                        while($q=$result->fetch_assoc())
                        {
                            $poid=$q['poid'];
//                            echo $poid;
                            $w=mysqli_query($conn,"Select SUM(quantity) from productorder where itemid='$id' AND poid='$poid'");
                            if($w==true)
                            {
                                $c=mysqli_fetch_array($w);
                                $Stockin=$c['SUM(quantity)'];
//                                echo $Stockin;
                                $count+=$Stockin;
                            }
                        }
                        if($count>0)
                        {
                            $Stockin=$count;
                            echo $count;
                            echo " ";
                        }
                        else{
                            $Stockin=$count;
                            echo 0;
                        }
                    }
                    ?>

                </td>
                <td>
                    <?php
                    $query="Select so_id from secondaryorder where DATE(addedon)='$dateto'";
                    $result=mysqli_query($conn,$query);
                    if($result)
                    {
                        $count=0;
                        while($q=$result->fetch_assoc())
                        {
                            $soid=$q['so_id'];


                            $w=mysqli_query($conn,"Select SUM(quantity) from secondaryproductorder where itemid=$id and so_id=$soid");
                            if($w==true)
                            {
                                $c=mysqli_fetch_array($w);
                                $Stockout=$c['SUM(quantity)'];
                                $count+=$Stockout;


                            }
                        }
                        if($count>0)
                        {
                            $Stockout=$count;
                            echo $count;
                            echo " ";
                        }
                        else{
                            $Stockout=$count;
                            echo 0;
                        }
                    }
                    ?>






                </td>
                <td><?php
                    $closing=$inv_qty+$Stockin-$Stockout;
                    echo  $closing;
                    ?></td>
                <td><?php  echo $dateto?></td>
                <td><?php echo $username ?></td>
                <td><?php echo $today ;?></td>

            </tr>

            <?php
            header("Content-type: application/xls");
            header("Content-Disposition: attachment; filename=".$filename."-Report.xls");
            header("Pragma: no-cache");
            header("Expires: 0");






        }
    }



    ?>


</table>


