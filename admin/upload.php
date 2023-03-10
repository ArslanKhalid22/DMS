<?php
//action.php
include ('connect/connect.php');
$u_code=$_POST['u_code'];

//image uploading
if($_FILES['img']['name']){

    move_uploaded_file($_FILES['img']['tmp_name'], "image/".$_FILES['img']['name']);

    $img = "image/".$_FILES['img']['name'];

}

$sql="INSERT INTO `users`(file_name) VALUES ('$img')";

mysqli_query($conn, $sql);
?>