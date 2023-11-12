<?php
include('../config/constant.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $imageName = $_GET['image_name'];
    
   
        if($imageName != ""){
            $path = "../images/category/".$imageName; 
            $remove = unlink($path); //remove the img
    
            if($remove==false){
                $_SESSION['remove']= "<div class='error'> Failed to remove Category imge.</div>";
    
                header("location:http://localhost/FoodOrder/admin/manage-category.php");
    
                die();
            }
        }
    
        $sql = "DELETE FROM tbl_category WHERE id=$id";
    
        $res = mysqli_query($conn,$sql);
        if($res==true){
            $_SESSION['delete']="<div class='success'>Category Deleted Successfully</div>"; 
           header('Location:http://localhost/FoodOrder/admin/manage-category.php');
        }else{
            $_SESSION['delete']="<div class='error'>Category Not delelted</div>"; 
            header('Location:http://localhost/FoodOrder//admin/manage-category.php');
        }
    
   
    }
    else{
    
       header("location:http://localhost/FoodOrder/admin/manage-category.php");
    }
    


?>