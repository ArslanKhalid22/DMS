<?php
//action.php
include ('../connect/connect.php');
$u_code=$_POST['u_code'];
//image uploading
if($_FILES['file']['name']){

    move_uploaded_file($_FILES['file']['tmp_name'], "../image/".$_FILES['file']['name']);

    $img = "image/".$_FILES['file']['name'];

}

$sql="INSERT INTO `users`(file_name) VALUES ('$img')";

mysqli_query($conn, $sql);
?>