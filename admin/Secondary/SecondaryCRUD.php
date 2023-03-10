<?php
include('../connect/connect.php');
$orderdate=date('Y-m-d H:i:s A',strtotime('+3 hours'));
$sAction=$_REQUEST['action'];
if($sAction=="addorder")
{
    $query = "SELECT * FROM secondaryorder ORDER BY so_id DESC LIMIT 1 ";
    $result = mysqli_query($conn, $query);
    $row=mysqli_fetch_array($result);
    if($row)
    {
        $so_code=$row['so_code'];

        $so_code=str_split($so_code,2);

        $so_code= $so_code[1];

        $so_code++;
        $s="SO";
        $so_code=$s.$so_code;

    }
    else{
        $so_code="SO1";
    }
    $html='
    <link href="http://localhost/admin/admin/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
    th{
        text-align: center;
        padding-bottom: 5px;
    }
    td{
    padding-bottom: 10px;
    padding-left: 0px;
    padding-right: 5px;
    }
    </style>
    
        <form name="form_data" id="form_data" method="post">
          <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Secondary Order</h1>
            <table>
            <td style="padding-left: 1200px" ">
            <a href="secondaryorder.php" role="button" title="Back" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-arrow-left" ></i></a>
                
</td>
</table>

            <br>
            <!-- DataTales Example -->
           
            <table class="table-responsives">
            <thead>
                    <th>DATE </th>
                    <th>DELIVERY </th>
                    <th>STORE NAME</th>
                    </thead>
                    <td><input type="text " name="orderdate" value="'.$orderdate.'" class="form-control" readonly ></td>
                    <td><input type="date" name="deliverydate" value="date" class="form-control"></td>
                    <td><input type="text" name="storename" id="storename" class="form-control storename"><a href="secondaryproductorder.php"></a> </td>
                    <td><input type="hidden" name="storeid" id="storeid" ></td>
                    </table>
          
           
            
                <table id="dynamic_field"  >
                    
                    
                    
                    
                    
                    <br>
                    <thead>
                    <th>SO CODE</th>
                   <tr>
                       
                                
                                
                                <td ><input type="text" id = "so_code" name="so_code" value="'.$so_code.'" readonly  class="form-control  text-center" /></td>
                           
                    </tr>
                    <tr>
                       
                        <th >ITEMNAME</th>
                        <th >QUANTITY</th>
                        <th >ET</th>
                        <th >TAX</th>
                        <th >IT</th>
                        <th >SUB TOTAL</th>
                    </tr>
                    </thead>
                    <input type="hidden" id="counter" name="counter" value="1">
                    <tr id="row1">
                    <input type="hidden" id="itemid_1" name="itemid_1">

                        <td >
                            <div class="ui-widget">
                                <input type="text"   name="username_1" id="username_1" placeholder="" class="form-control username btn_name"  required autocomplete="off" onkeyup="setnull(this);" >
                            </div>
                        </td>
                        <td><input type="int" pattern="^[0-9]*$" name="quantity_1" id ="quantity_1" placeholder="" class="form-control " required oninput="this.value = this.value.replace(/[^0-9]/g, \'\').replace(/(\.*)\./g, \'$1\');" onkeyup="setTotalPrice(this);" /></td>
                        <td><input type="text" id = "et_1" name="et_1" readonly  class="form-control name_list" /></td>
                        <td><input type="text" id = "tax_1" name="tax_1" readonly class="form-control name_list" /></td>
                        <td><input type="text" id = "it_1" name="it_1" readonly class="form-control name_list" /></td><br>
                        <td><input type="text" id = "total_1" name="total_1" readonly class="form-control total_field" /></td><br>
                     </table>
                     <table>
               
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      
                        <th style="white-space:nowrap; ">TOTAL ORDER</th> 
                        <td style="padding-left: 917px"><input type="text" size="19" name= "totalprice_1"  id="totalprice_1" value="0" placeholder="total price" readonly class="form-control"></td>
                        </tr>
                    </table>
                <button type="button" name="add" id="add" class="btn btn-success"><i class="fas fa-fw fa-plus"></i></span></button>
                <input type="submit" name="submit" id="submit" class="btn btn-info submit" value="Submit">
                <button type="button" name="remove" id="remove" class="btn btn-danger btn_remove"><i class="fas fa-fw fa-minus"></i></span></button>
                <br>

            </div>
        </form>
          
            
           
                
       
            
            
        ';

    echo $html;
}

?>