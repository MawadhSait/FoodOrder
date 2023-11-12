<?php
include('../config/constant.php');

$id = $_GET['id'];
$sql = "DELETE FROM tbl_admin WHERE id=$id";

$res = mysqli_query($conn, $sql);

if($res == TRUE){
    $_SESSION['delete']="<div class='success'> Admin is deleted </div>";
    header('location:'.SITURL.'/admin/manage-admin.php');
}else{
    $_SESSION['delete']="<div class='error'> Admin is not delete</div>";
    header("location:".SITURL."/admin/manage-admin.php");
}


?>