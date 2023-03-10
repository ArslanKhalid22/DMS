<?php
include('../connect/connect.php');
$sAction=$_REQUEST['action'];
if($sAction=="additem")
{
    $query = "SELECT * FROM product ORDER BY itemid DESC LIMIT 1 ";
    $result = mysqli_query($conn, $query);
    $row=mysqli_fetch_array($result);
    if($row)
    {
        $p_code=$row['p_code'];

        $p_code=str_split($p_code,2);
        $p_code= $p_code[1];
        $p_code++;
        $p="PC";
        $p_code=$p.$p_code;
    }
    else{
        $p_code="PC1";
    }
    $html='
    <link href="http://localhost/admin/admin/css/sb-admin-2.min.css" rel="stylesheet">
<div class="row" id="divmain"> </div><div class="col-lg-6"> <div class="p-5"> 
            <div class="text-center">
             <h1 class="h4 text-gray-900 mb-4" style="text-align: left">Add Product</h1>
             <table>
            <td style="padding-left: 1100px" ">
            <a href="product.php" role="button" title="Back" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-arrow-left" ></i></a>
                
            </td>
            </table>
             </div>
             
            <div class="form-group">
            <label>Sku Code</label>
                    <input style="width: 100px;" type="text" id = "p_code" name="p_code" value="'.$p_code.'" readonly  class="form-control  text-center" />
             
            </div>
            
                 
             <form onsubmit= "return submitproduct()"class="user" method="POST" action=""> 
             
             <div class="form-group"><label >Itemname</label><span style="color: red">*</span> <input type="text" class="form-control " id="itemname" name="itemname" aria-describedby="emailHelp" placeholder="Enter Itemname"required autocomplete="off" maxlength="20"> </div>
             <div class="form-group"> <label>Exclusive Price</label><span style="color: red">*</span><input type="text" class="form-control " id="et" name="et"  placeholder="Enter Et"required autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\..*)\./g, \'$1\');"> </div>
            <div class="form-group"><label>Tax</label><span style="color: red">*</span> <input type="text" class="form-control " id="tax" name="tax"  placeholder="Enter Tax"required autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\..*)\./g, \'$1\');"> </div>
            <div class="form-group"><input type="radio"  name="status" id="status" value="active"class="fields" required="required" />Active
                                <input type="radio" name="status" id="status" value="disabled"class="fields" required="required" />Disabled</div>
            <input type="submit" name="Add"  value="Add" class="btn btn-info  btn-block"> </form> 
            </div>
                </div>
            </div>';

    echo $html;
}
if($sAction=="edititem")
{
    $id=$_POST['id'];
    $sActive="";
    $sdisabled="";
    $sql=mysqli_query($conn,"SELECT * from product where itemid='$id'");
    $result=mysqli_fetch_array($sql);
    $itemname=$result['itemname'];
    $et=$result['et'];
    $tax=$result['tax'];
    $status=$result['status'];

    if($status==1)
    {
        $sActive="checked=checked";
    }
    else{
        $sdisabled="checked=checked";
    }
    $html='
    <link href="http://localhost/admin/admin/css/sb-admin-2.min.css" rel="stylesheet">
<div class="row" id="divmain"> </div><div class="col-lg-6"> <div class="p-5"> 
            <div class="text-center">
             <h1 class="h4 text-gray-900 mb-4" style="text-align: left;">Update Product</h1>
             </div>
              <table>
            <td style="padding-left: 1100px" ">
            <a href="product.php" role="button" title="Back" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-arrow-left" ></i></a>
                
            </td>
            </table>
             <form onsubmit="return updateitem()"class="user" method="POST" action=""> 
            <input type="hidden" class="form-control " id="id" name="id"   hidden value='.$id.' >
             <div class="form-group"><label>Itemname</label><span style="color: red">*</span> <input type="text" class="form-control " id="itemname" name="itemname" aria-describedby="emailHelp" value= '.$itemname.' required autocomplete="off"> </div>
             <div class="form-group"><label>Ecxlusive Price</label><span style="color: red">* </span><input type="text" class="form-control"  id="et" name="et"  value='.$et.' required autocomplete="off"  oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\..*)\./g, \'$1\');"> </div>
            <div class="form-group"><label>Tax</label><span style="color: red">*</span> <input type="text" class="form-control " id="tax" name="tax" value='.$tax.' required autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\..*)\./g, \'$1\');"> </div>
            <div class="form-group"><input type="radio"  name="status" id="status" value="active" class="fields" required="required" '.$sActive.' /><span>Active</span>
                                <input type="radio" name="status" id="status" value="disabled" class="fields" required="required" '.$sdisabled.' />Disabled</div>
            <input type="submit" name="update"  value="Update" class="btn btn-info  btn-block">
             </form> 
            </div>
                </div>
            </div>
            
            
            ';
    echo $html;
}

?>