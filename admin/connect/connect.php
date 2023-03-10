
<?php
$conn=mysqli_connect('localhost','root','','projectdb');
if(mysqli_connect_error())
{
    echo "failed to connect".mysqli_connect_error();
    die();
}
?>
