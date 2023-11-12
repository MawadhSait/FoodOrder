<?php
include('../config/constant.php');

if(isset($_GET['id']) AND isset($_GET['image_name'])){
    $id = $_GET['id'];  
    $imgName=$_GET["image_name"];



    if($imgName != ""){
        $path = "../images/food/".$imgName;

        //remove the img from folder

        $remove = unlink($path);
        
        if($remove==false){
            $_SESSION['upload']="<div class='error'> Failed to remove image file</div>";
            header('location:http://localhost/FoodOrder/admin/manage-food.php' ); 
            die();

        }

    }
    $sql ="DELETE FROM tbl_food WHERE id='$id'";
    $res = mysqli_query($conn,$sql);

    if($res==true){
        $_SESSION['delete']="<div class='success'>Food item removed successfully!</div>";
        header('location:http://localhost/FoodOrder/admin/manage-food.php' ); 
    }else{
        $_SESSION['delete']="<div class='error'>Food item removed successfully!</div>";
        header('location:http://localhost/FoodOrder/admin/manage-food.php' ); 
    }
    
}else{
    $_SESSION['unauthorized']= "<div class='error'> Unauthorized Access</div>";
    header('location:http://localhost/FoodOrder/admin/manage-food.php' ); 

}

?>