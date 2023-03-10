<?php
include ('../connect/connect.php');
if(isset($_POST['save'])) {

    $userid = $_GET['userid'];
    if ($_POST['adduser'] != null) {
        $adduser = $_POST['adduser'];
        $adduser = 1;
    } else {
        $adduser = 0;
    }
    if ($_POST['deleteuser'] != null) {
        $deleteuser = $_POST['deleteuser'];
        $deleteuser = 1;
    } else {
        $deleteuser = 0;

    }
    if ($_POST['edituser'] != null) {
        $edituser = $_POST['edituser'];
        $edituser = 1;

    } else {
        $edituser = 0;

    }
    if ($_POST['viewuser'] != null) {
        $viewuser = $_POST['viewuser'];
        $viewuser = 1;

    } else {
        $viewuser = 0;

    }
    if ($_POST['addproduct'] != null) {
        $addproduct = $_POST['addproduct'];
        $addproduct = 1;

    } else {
        $addproduct = 0;

    }
    if ($_POST['deleteproduct'] != null) {
        $deleteproduct = $_POST['deleteproduct'];
        $deleteproduct = 1;

    } else {
        $deleteproduct = 0;

    }
    if ($_POST['editproduct'] != null) {
        $editproduct = $_POST['editproduct'];
        $editproduct = 1;

    } else {
        $editproduct = 0;

    }
    if ($_POST['viewproduct'] != null) {
        $viewproduct = $_POST['viewproduct'];
        $viewproduct = 1;

    } else {
        $viewproduct = 0;

    }
    if ($_POST['addstore'] != null) {
        $addstore = $_POST['addstore'];
        $addstore = 1;

    } else {
        $addstore = 0;

    }
    if ($_POST['deletestore'] != null) {
        $deletestore = $_POST['deletestore'];
        $deletestore = 1;

    } else {
        $deletestore = 0;

    }
    if ($_POST['editstore'] != null) {
        $editstore = $_POST['editstore'];
        $editstore = 1;

    } else {
        $editstore = 0;

    }
    if ($_POST['viewstore'] != null) {
        $viewstore = $_POST['viewstore'];
        $viewstore = 1;

    } else {
        $viewstore = 0;

    }
    if ($_POST['addprimary'] != null) {
        $addprimary = $_POST['addprimary'];
        $addprimary = 1;

    } else {
        $addprimary = 0;

    }
    if ($_POST['viewprimary'] != null) {
        $viewprimary = $_POST['viewprimary'];
        $viewprimary = 1;

    } else {
        $viewprimary = 0;

    }
    if ($_POST['addsecondary'] != null)
    {
        $addsecondary = $_POST['addsecondary'];
        $addsecondary = 1;

    } else {
        $addsecondary = 0;

    }
    if ($_POST['viewsecondary'] != null) {
        $viewsecondary = $_POST['viewsecondary'];
        $viewsecondary = 1;

    } else {
        $viewsecondary = 0;

    }
    if ($_POST['addreport'] != null)
    {
        $addreport = $_POST['addreport'];
        $addreport = 1;

    } else {
        $addreport = 0;

    }
    if ($_POST['viewreport'] != null) {
        $viewreport = $_POST['viewreport'];
        $viewreport = 1;

    } else {
        $viewreport = 0;

    }
    $AddUser=array();
    $Add_User['Users'] = array(
        "Add"    =>  $adduser ,
        "Update" =>  $edituser,
        "View"   =>  $viewuser,
        "Delete" =>  $deleteuser,

    );
    $Add_User['Product'] = array(
        "Add"    =>  $addproduct ,
        "Update" =>  $editproduct,
        "View"   =>  $viewproduct,
        "Delete" =>  $deleteproduct,

    );
    $Add_User['Store'] = array(
        "Add"    =>  $addstore ,
        "Update" =>  $editstore,
        "View"   =>  $viewstore,
        "Delete" =>  $deletestore,

    );
    $Add_User['PrimaryOrder'] = array(
        "Add"    =>  $addprimary ,
        "View"   =>  $viewprimary,

    );
    $Add_User['SecondaryOrder'] = array(
        "Add"    =>  $addsecondary ,
        "View"   =>  $viewsecondary,

    );
    $Add_User['Record'] = array(
        "Add"    =>  $addreport ,
        "View"   =>  $viewreport,

    );
    $roles = json_encode($Add_User);

    $sql="Update users SET UserRoles=  '$roles' where id = $userid  ";
    $result = mysqli_query($conn, $sql);
//    $sql = "UPDATE  users SET adduser='$adduser',edituser='$edituser',deleteuser='$deleteuser',viewuser='$viewuser',addproduct='$addproduct',editproduct='$editproduct',deleteproduct='$deleteproduct',viewproduct='$viewproduct',addstore='$addstore',editstore='$editstore',deletestore='$deletestore',viewstore='$viewstore'
//    ,addprimary='$addprimary',viewprimary='$viewprimary',addsecondary='$addsecondary',viewsecondary='$viewsecondary', addreport='$addreport',viewreport='$viewreport 'where id='$userid'";
//
//    $result = mysqli_query($conn, $sql);
    if($result)
    {
        header("location:users.php");
    }
    else{



    }


}