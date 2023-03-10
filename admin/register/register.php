<?php
include('../connect/connect.php');
session_start();
$sAction=$_POST['action'];
if($sAction=="adduser")
{
    $query = "SELECT * FROM users ORDER BY ID DESC LIMIT 1 ";
    $result = mysqli_query($conn, $query);
    $row=mysqli_fetch_array($result);
    if($row)
    {
        $u_code=$row['u_code'];
        $u_code=str_split($u_code,2);
        $u_code= $u_code[1];
        $u_code++;
        $u="UC";
        $u_code=$u.$u_code;
    }
    else{
        $u_code="UC1";
    }

    $html='
<style>
p{
    font-size: 14px;
}
</style>
    <link href="http://localhost/admin/admin/css/sb-admin-2.min.css" rel="stylesheet">
<div class="row" id="divmain"> </div><div class="col-lg-6"> <div class="p-5"> 
            <div class="text-center">
             <h1 class="h4 text-gray-900 mb-4" style="text-align: left">Register New User</h1>
             <table>
            <td style="padding-left: 1100px" ">
            <a href="users.php" role="button" title="Back" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-arrow-left" ></i></a>
                
            </td>
            </table>
             </div>
             <div class="form-group">
            <label>User Code</label>
                    <input style="width: 100px;" type="text" id = "u_code" name="u_code" value="'.$u_code.'" readonly  class="form-control  text-center" />
             
            </div>
             <form  enctype="multipart/form-data" id="uploadForm" action="" method="post" style="margin-top: -15px">
             <div class="form-group"><input type="file" name="file" id="file"></div>             
             <div class="form-group"><label >Username</label><span style="color: red">*</span> <input type="text" class="form-control " id="username" name="username" aria-describedby="emailHelp" placeholder="Enter Username"required autocomplete="off"> </div>
             <div class="form-group"><label >Email</label><span style="color: red">*</span> <input type="email" pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$" class="form-control " id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address"required autocomplete="off"> </div>
            <div class="form-group"> <label >Password</label><span style="color: red">*</span><input type="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$" class="form-control " id="password" name="password" placeholder="Enter Password" required autocomplete="off"> </div>
            <div class=""><label >Number</label><span style="color: red">*</span> <input type="text" class="form-control " id="number" pattern="\d{11}" name="number" oninput="this.value = this.value.replace(/[^0-9]/g, \'\').replace(/(\.*)\./g, \'$1\');" maxlength="11"  placeholder="Enter Number" required> </div><div class="form-group" autocomplete="off"> </div>
            <input type="radio"  name="status" id="status" value="active"class="fields" required="required" />Active
                                <input type="radio" name="status" id="status" value="disabled"class="fields" required="required" />Disabled
            <input type="submit" name="Register"  value="Register" class="btn btn-info  btn-block submit"> </form> 
            </div>
                </div>
            </div>
              <div   id="message" style="display: none;margin-top: -303px;margin-left: 600px" >
        <p id="letter" class="invalid" ">A <b>lowercase</b> letter</p>
        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
        <p id="numbers" class="invalid">A <b>number</b></p>
        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
        <p id="special" class="invalid">A  <b>Special character</b></p>
    </div>
    <br />

</div>
      <script>
      var myInput = document.getElementById("password");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("numbers");
        //console.log(number);
        var length = document.getElementById("length");
        var special = document.getElementById("special");

        

         //When the user clicks on the password field, show the message box
         myInput.onfocus =function() {
             document.getElementById("message").style.display = "block";
         }

         //When the user clicks outside of the password field, hide the message box
         myInput.onblur =function() {
             document.getElementById("message").style.display = "none";
         }

        // When the user starts to type something inside the password field
        myInput.onkeyup =function() {
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
           if(myInput.value.match(lowerCaseLetters)) {
               document.getElementById("letter").style.color="green";
//                letter.classList.remove(".invalid");
//                letter.classList.add(".valid");
            } else {
                document.getElementById("letter").style.color="red";
                letter.classList.add("invalid");
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if(myInput.value.match(upperCaseLetters)) {
               
                document.getElementById("capital").style.color="green";
                capital.classList.add("valid");
            } else {
                document.getElementById("capital").style.color="red";
                capital.classList.add("invalid");
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if(myInput.value.match(numbers)) {
               
                document.getElementById("numbers").style.color="green";
                number.classList.add("valid");
            } else {
                document.getElementById("numbers").style.color="red";
                number.classList.add("invalid");
            }

            // Validate length
            if(myInput.value.length >= 8) {
               
               document.getElementById("length").style.color="green";
                length.classList.add("valid");
            } else {
                document.getElementById("length").style.color="red";
                length.classList.add("invalid");
            }
            // Validate Characters
            var speciall=/[!@()#$%^&*|\/>.<,_=+-]/g;
           
            if(myInput.value.match(speciall))
            {
                document.getElementById("special").style.color="green";
                special.classList.add("valid");
            }
            else
            {
                document.getElementById("special").style.color="red";
                special.classList.add("invalid");
            }
        }


</script>      
            
            ';

    echo $html;

}



if($sAction=="edituser")
{

    $id=$_POST['id'];
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
$email=$_SESSION['email'];
$a=mysqli_query($conn, "SELECT * FROM users where email='$email'");
$b=mysqli_fetch_array($a);
$name=$b['username'];
$upid=$b['id'];
$sActive="";
$sdisabled="";
$sql=mysqli_query($conn,"SELECT * from users where id='$id'");
$result=mysqli_fetch_array($sql);
$username=$result['username'];
    $email=$result['email'];
    $password=$result['password'];
    $number=$result['number'];
    $status=$result['status'];
    if($status==1)
    {
        $sActive="checked=checked";
    }
    else{
        $sdisabled="checked=checked";
    }
    $html='
<style>
    p{
    font-size: 14px;
}
</style>

    <link href="http://localhost/admin/admin/css/sb-admin-2.min.css" rel="stylesheet">
<div class="row" id="divmain"> </div><div class="col-lg-6"> <div class="p-5"> 
            <div class="text-center">
             <h1 class="h4 text-gray-900 mb-4" style="text-align: left">Update User</h1>
             </div>
             <table>
            <td style="padding-left: 1100px" ">
            <a href="users.php" role="button" title="Back" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-arrow-left" ></i></a>
                
            </td>
            </table>
            <form  onsubmit="return updateuser()"class="user" method="POST" style="margin-top: -15px" > 
             <div class="form-group"><input type="text" class="form-control " id="id" name="id" aria-describedby="emailHelp"  hidden value='.$id.' required autocomplete="off"> </div>
             <div class="form-group"><label >Username</label><span style="color: red">*</span> <input type="text" class="form-control " id="username" name="username" aria-describedby="emailHelp" value="'.$username.'" required autocomplete="off"> </div>
             <div class="form-group"><label >Email</label><span style="color: red">*</span> <input type="email" class="form-control " id="email" name="email" aria-describedby="emailHelp" value='.$email.' required autocomplete="off" readonly> </div>
            <div class="form-group"><label >Password</label><span style="color: red">*</span> <input type="password" class="form-control "  id="password" name="password" required value="********"  autocomplete="off" onclick="setnull()"> </div>
            <div class="form-group"><label >Number</label><span style="color: red">*</span> <input type="text" class="form-control " id="number" required name="number" pattern="\d{11}"  oninput="this.value = this.value.replace(/[^0-9]/g, \'\').replace(/(\.*)\./g, \'$1\');"  maxlength="11"   value='.$number.' > </div><div class="form-group" autocomplete="off"> </div>
            <div class="form-group"><input type="radio"  name="status" id="status" value="active" class="fields" required="required" '.$sActive.' />Active
                                <input type="radio" name="status" id="status" value="disabled" class="fields" required="required" '.$sdisabled.' />Disabled</div>
            <input type="submit" name="update"  value="Update" class="btn btn-info  btn-block"> </form> 
            </div>
                </div>
            </div>
              <div   id="message" style="display: none;margin-top: -303px;margin-left: 600px" >
        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
        <p id="numbers" class="invalid">A <b>number</b></p>
        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
        <p id="special" class="invalid">A  <b>Special character</b></p>
    </div>
    <br />

</div>

  <script>
        function setnull()
        {
            var mine = document.getElementById("password").value=""; 
        }
      var myInput = document.getElementById("password");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("numbers");
        //console.log(number);
        var length = document.getElementById("length");
        var special = document.getElementById("special");

        

         //When the user clicks on the password field, show the message box
         myInput.onfocus =function() {
             document.getElementById("message").style.display = "block";
         }

         //When the user clicks outside of the password field, hide the message box
         myInput.onblur =function() {
             document.getElementById("message").style.display = "none";
         }

        // When the user starts to type something inside the password field
        myInput.onkeyup =function() {
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
           if(myInput.value.match(lowerCaseLetters)) {
               document.getElementById("letter").style.color="green";
//                letter.classList.remove(".invalid");
//                letter.classList.add(".valid");
            } else {
                document.getElementById("letter").style.color="red";
                letter.classList.add("invalid");
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if(myInput.value.match(upperCaseLetters)) {
               
                document.getElementById("capital").style.color="green";
                capital.classList.add("valid");
            } else {
                document.getElementById("capital").style.color="red";
                capital.classList.add("invalid");
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if(myInput.value.match(numbers)) {
               
                document.getElementById("numbers").style.color="green";
                number.classList.add("valid");
            } else {
                document.getElementById("numbers").style.color="red";
                number.classList.add("invalid");
            }

            // Validate length
            if(myInput.value.length >= 8) {
               
               document.getElementById("length").style.color="green";
                length.classList.add("valid");
            } else {
                document.getElementById("length").style.color="red";
                length.classList.add("invalid");
            }
            // Validate Characters
            var speciall=/[!@()#$%^&*|\/>.<,_=+-]/g;
           
            if(myInput.value.match(speciall))
            {
                document.getElementById("special").style.color="green";
                special.classList.add("valid");
            }
            else
            {
                document.getElementById("special").style.color="red";
                special.classList.add("invalid");
            }
        }


</script> 

';
    echo $html;
}
if($sAction=="userrole")
{
    $userid = $_POST['id'];
    $a=mysqli_query($conn, "SELECT * FROM users where id='$userid'");
    $b=mysqli_fetch_array($a);
    $adduser=$b['adduser'];
    $deleteuser=$b['deleteuser'];
    $edituser=$b['edituser'];
    $addproduct=$b['addproduct'];
    $deleteproduct=$b['deleteproduct'];
    $editproduct=$b['editproduct'];
    $addstore=$b['addstore'];
    $deletestore=$b['deletestore'];
    $editstore=$b['editstore'];
    $addprimary=$b['addprimary'];
    $addsecondary=$b['addsecondary'];
    $addreport=$b['addreport'];
    $viewuser=$b['viewuser'];
    $viewproduct=$b['viewproduct'];
    $viewstore=$b['viewstore'];
    $viewprimary=$b['viewprimary'];
    $viewsecondary=$b['viewsecondary'];
    $viewreport=$b['viewreport'];
    $checked="checked";
    $html='
    <link href="http://localhost/admin/admin/css/sb-admin-2.min.css" rel="stylesheet">
<div class="row" id="divmain"> </div><div class="col-lg-6"> <div class="p-5"> 
            <div class="text-center">
             <h1 class="h4 text-gray-900 mb-4">User Role</h1>
             </div>
             <form  onsubmit="return updateuserrole()" class="checkbox" method="POST" > 
             <input type="hidden" name="id" id="id"value='.$userid.'>
             <div class="form-group"><input type="checkbox" name="checkall" id="checkall"></div>
             <div class="form-group">Users:<input type="checkbox" size="25" id="viewuser" class="checkall"  name="viewuser"  value="'.$viewuser .'" '.($viewuser == 1 ? "checked" : "").'/>View <input type="checkbox" size="25" id="adduser" class="checkall" value="'.$adduser .'" name="adduser"  '.($adduser == 1 ? "checked" : "").' />Add <input type="checkbox" size="25" id="edituser" class="checkall" value="'.$edituser .'" name="edituser"  '.($edituser == 1 ? "checked" : "").' />Edit <input type="checkbox" size="25" id="deleteuser" class="checkall" name="deleteuser" value="'.$deleteuser.'"  '.($deleteuser == 1 ? "checked" : "").' /> Delete</div>
             <div class="form-group">Product:<input type="checkbox" size="25" id="viewproduct" class="checkall" name="viewproduct"  '.($viewproduct == 1 ? "checked" : "").' />View <input type="checkbox" size="25" id="addproduct" class="checkall" name="addproduct"  '.($addproduct == 1 ? "checked" : "").' />Add <input type="checkbox" size="25" id="editproduct" class="checkall" name="editproduct"  '.($editproduct == 1 ? "checked" : "").' />Edit <input type="checkbox" size="25" id="deleteproduct" class="checkall" name="deleteproduct"  '.($deleteproduct == 1 ? "checked" : "").' /> Delete</div>
             <div class="form-group">Store:<input type="checkbox" size="25" id="viewstore" class="checkall" name="viewstore"  '.($viewstore == 1 ? "checked" : "").' />View <input type="checkbox" size="25" id="addstore" class="checkall" name="addstore"  '.($addstore == 1 ? "checked" : "").' />Add <input type="checkbox" size="25" id="editstore" class="checkall" name="editstore"  '.($editstore == 1 ? "checked" : "").' />Edit <input type="checkbox" size="25" id="deletestore" class="checkall" name="deletestore"  '.($deletestore == 1 ? "checked" : "").' /> Delete</div>
             <div class="form-group">Primary Orders:<input type="checkbox" size="25" id="viewprimary" class="checkall" name="viewprimary"  '.($viewprimary == 1 ? "checked" : "").' />View <input type="checkbox" size="25" id="addprimary" class="checkall" name="addprimary"  '.($addprimary == 1 ? "checked" : "").' />Add</div>
             <div class="form-group">Secondart orders:<input type="checkbox" size="25" id="viewprimary" class="checkall" name="viewprimary"  '.($viewprimary == 1 ? "checked" : "").' />View <input type="checkbox" size="25" id="addsecondary" class="checkall" name="addsecondary"  '.($addsecondary == 1 ? "checked" : "").' />Add </div>    
             <div class="form-group">Reports:<input type="checkbox" size="25" id="viewreports" class="checkall" name="viewreports"  '.($viewreport == 1 ? "checked" : "").' />View <input type="checkbox" size="25" id="addreport" class="checkall" name="addreport"  '.($addreport == 1 ? "checked" : "").' />Add </div>    
             <div><input type="submit" name="save" value="Save" class="form-group" /></div>
        <script>
    $(function () {
        $("#checkall").click(function () {
            $(\'.checkall\').attr(\'checked\', this.checked);
        });
        $(".checkall").click(function () {
            if ($(\'.checkall\').length == $(\'.checkall:checked\').length) {
                $(\'#checkall\').attr(\'checked\', \'checked\');
            } else {
                $(\'#checkall\').removeAttr(\'checked\');
            }
        });
    });
</script>   
           
           ';
    echo $html;
}
?>





