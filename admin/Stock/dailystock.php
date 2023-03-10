<?php
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
$aid=$name['id'];
$sr=0;

    //    $datie =date('Y m d');
    //    echo $datie;
    $datie=date('Y-m-d h:i:s A',strtotime('+3 hours'));
    $daydate="2022-10-10";
    $tilldate="2022-10-17";
    $daydatee = new DateTime($daydate);

    //Subtract a day using DateInterval
    $yesterdayTime = $daydatee->sub(new DateInterval('P1D'));

    //Get the date in a YYYY-MM-DD format.
    $yesterday = $yesterdayTime->format('Y-m-d');
    //Print Date.

    //    die();



        $count=0;
        while($daydate<=$tilldate){
        $a=mysqli_query($conn, "SELECT itemid ,itemname FROM product ");

        while ($row = $a->fetch_assoc()) {

        //            echo "hello";
        ?>

        <?php
             $id=$row['itemid'];
            $inv_qty=0;
            //                $qtry="Select *from dailyreport where reportdate=$yesterday";

            $i=mysqli_query($conn,"Select *from dailyreport where reportdate='$yesterday'");

            if ($i->num_rows > 0) {

                while($row=$i->fetch_assoc())
                {
                    $itemid=$row['itemid'];
                    $closingbalance=$row['closing'];
                    if($itemid==$id)
                    {
                        $inv_qty=$closingbalance;
                    }
                }

            }
            //





                $query="Select poid from primaryorders where DATE(addedon)= '$daydate'";
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

                    }
                    else{
                        $Stockin=$count;

                    }
                }
                $query="Select so_id from secondaryorder where DATE(addedon)='$daydate'";
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

                    }
                    else{
                        $Stockout=$count;

                    }
                }

                $closing=$inv_qty+$Stockin-$Stockout;





            $quer="INSERT into dailyreport(itemid,opening,stock_in,stock_out,closing,reportdate,addedby,addedon)
                                VALUES('$id','$inv_qty','$Stockin','$Stockout','$closing','$daydate','$aid','$datie')";
            $dailyresult=mysqli_query($conn,$quer);

            if($dailyresult==TRUE)
            {
                echo "";
            }
            else
            {


            }

        }
            $daydatee = new DateTime($daydate);

            //Subtract a day using DateInterval
            $yesterdayTime = $daydatee->add(new DateInterval('P1D'));

            //Get the date in a YYYY-MM-DD format.
            $yesterday = $yesterdayTime->format('Y-m-d');
            //Print Date.

            $daydate=$yesterday;
            //            echo $daydate;
            $daydatee = new DateTime($daydate);

            //Subtract a day using DateInterval
            $yesterdayTime = $daydatee->sub(new DateInterval('P1D'));

            //Get the date in a YYYY-MM-DD format.
            $yesterday = $yesterdayTime->format('Y-m-d');
            //Print Date.



            }




            ?>
























