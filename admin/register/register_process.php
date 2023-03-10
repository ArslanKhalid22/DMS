<?php
session_start();
include('../connect/connect.php');
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
$email=$_SESSION['email'];
$a=mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$b=mysqli_fetch_array($a);
$name=$b['username'];
$aid=$b['id'];
$addedon = date('Y-m-d H:i:s A',strtotime('+3 hours'));
//    $filename=$_POST['filename'];
//    $targetDir = "uploads/";
//    $fileName = basename($_FILES["file"]["name"]);
//    $targetFilePath = $targetDir . $fileName;
//    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    $count=0;
    $info=" ";
    $infoo='';
    $numinfo='';
    $passinfo='';
    $n=mysqli_real_escape_string($conn,$_POST['username']);
    $e=$_POST['email'];
    $email=strtolower($e);
    $emailcheck=preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/',$email);
    if(!$emailcheck){
        $count++;
        echo 0;
        return;
    }
    $password=$_POST['password'];
    $num=$_POST['number'];
    $u_code=$_POST['u_code'];
    $s=$_POST['status'];
    if($s=="active")
    {
        $s=1;
    }
    else{
        $s=0;
    }
    $sql="SELECT *from users";
    $result=mysqli_query($conn,$sql);
    while($row=$result->fetch_assoc())
    {
        $existemail=$row['email'];
        if($existemail==$email)
        {
            $count++;
            echo "Email already exist";
            return;
        }
    }
if($_FILES['file']['name']){

    move_uploaded_file($_FILES['file']['tmp_name'], "../image/".$_FILES['file']['name']);

    $img = "image/".$_FILES['file']['name'];

}
    if($count==0)
    {

        if($n!=NULL && $email!=NULL && $password!=NULL)
        {

                $sql=mysqli_query($conn, "
                INSERT INTO users
                (u_code,username,email,password,number,status,addedby,addedon,
                file_name,UserRoles)
                VALUES
                ('$u_code','$n','$email','$password','$num','$s','$aid','$addedon',
                '$img','Not Assigned Yet')");
                if($sql)
                {
                   echo 1;
                   return;
                }
                else
                {
                    echo 0;
                    return;
                }
            }

    }
    else
    {
        echo 0;
        return;
    }


?>
