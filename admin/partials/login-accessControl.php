<?php 
//Authoraization -accessPanel
//check wheater the user is logged in or not
if(!isset($_SESSION['user'])){
    $_SESSION['no-login-msg']="<div class='error text-center'> Please login to access admin Panel </div>";
    header('location:http://localhost/FoodOrder/admin/login.php');   
}
?>