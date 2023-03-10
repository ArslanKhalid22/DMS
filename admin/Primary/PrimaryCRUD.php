<?php
include('../connect/connect.php');

$sAction=$_REQUEST['action'];
if($sAction=="addorder")
{
    $query = "SELECT * FROM primaryorders ORDER BY poid DESC LIMIT 1 ";
    $result = mysqli_query($conn, $query);
    $row=mysqli_fetch_array($result);
    if($row)
    {
        $po_code=$row['po_code'];
        $po_code=str_split($po_code,2);
        $po_code= $po_code[1];
        $po_code++;
        $p="PO";
        $po_code=$p.$po_code;
    }
    else{
        $po_code="PO1";
    }
    $html='
    <link href="http://localhost/admin/admin/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
    th{
        padding-left: 40px;
        padding-bottom: 5px;
    }
    td{
    padding-bottom: 10px;
    padding-left: 0px;
    padding-right: 0px;
    }
    </style>
<form onsubmit="return submitt()" name="form_data" id="form_data" method="post">
<div class="card-header py-3"  id="divmain">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Primary Order</h1>
            <table>
            <td style="padding-left: 1200px" ">
            <a href="primaryorder.php" role="button" title="Back" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-arrow-left" ></i></a>
                
            </td>
            </table>
            <!-- DataTales Example -->
            <div class="table-responsive">
                
                <table id="dynamic_field"  >
                    <thead>
                    
                    <th style="text-align:left">PO CODE</th>
                   <tr>
                       
                                
                                
                                <td ><input type="text" id = "po_code" name="po_code" value="'.$po_code.'" readonly  class="form-control  text-center" /></td>
                           
                    </tr>
                    <tr>
                      
                        <th >ITEMNAME<span style="color: red">*</span></th>
                        <th >QUANTITY<span style="color: red">*</span></th>
                        <th >ET</th>
                        <th >TAX</th>
                        <th >IT</th>
                        <th >SUB TOTAL</th>
                    
                   
                    </tr>
                    </thead>
                    <input type="hidden" id="counter" name="counter" value="1">
                    
                    <tr id="row1">
                    <input type="hidden" id="itemid_1" name="itemid_1">
                        <td>
                            <div class="ui-widget">
                                <input type="text"   name="username_1" id="username_1" placeholder="" class="form-control username btn_name"  required autocomplete="off" onkeyup="setnull(this);" >
                            </div>
                        </td>
                        <td><input type="int" pattern="^[0-9]*$" name="quantity_1" id ="quantity_1" placeholder="" class="form-control " required oninput="this.value = this.value.replace(/[^0-9]/g, \'\').replace(/(\.*)\./g, \'$1\');" onkeyup="setTotalPrice(this);" autocomplete="off" /></td>
                        <td><input type="text" id = "et_1" name="et_1" readonly  class="form-control name_list" /></td>
                        <td><input type="text" id = "tax_1" name="tax_1" readonly class="form-control name_list" /></td><br>
                        <td><input type="text" id = "it_1" name="it_1" readonly class="form-control name_list" /></td><br>
                        <td><input type="text" id = "total_1" name="total_1" readonly class="form-control total_field" /></td><br>
                        
                        
                    
                    
                </table>
                <table>
               
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  
                    <th style="white-space:nowrap">TOTAL ORDER</th> 
                    <td style="padding-left: 870px"><input type="text" size="18" name= "totalprice_1"  id="totalprice_1" value="0" placeholder="total price" readonly class="form-control"></td>
                    </tr>
                    </table>
                
                <button type="button" name="add" id="add" class="btn btn-success"><i class="fas fa-fw fa-plus"></i></span></button>
                <input type="submit" name="submit" id="submit" class="btn btn-info submit" value="Submit">
                <button type="button" name="remove" id="remove" class="btn btn-danger btn_remove"><i class="fas fa-fw fa-minus"></i></span></button>
                <br>

            </div>
        </form>
        
            </div>
                </div>
            </div>
     
      </div>      
            
            ';

    echo $html;
}

?>