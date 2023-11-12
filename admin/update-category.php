<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>update Category</h1>
<br><br>


<?php
        if(isset($_GET['id'])){
            $id=$_GET['id'];    

            $sql = "SELECT * FROM tbl_category WHERE id='$id'";
            $res = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($res);

            if($count==1){

                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $Current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];

            }else{
                $_SESSION['no-category-found']="<div class='error'>NO shuch a Category</div>";
                header("location:http://localhost/FoodOrder/admin/manage-category.php");   
            }
        }else{
            header("location:http://localhost/FoodOrder/admin/manage-category.php");
        }

?>


<form action="" method="POST" enctype="multipart/form-data">

<table class="tbl-30">
        <tr>
            <td>Title:</td>
            <td>
                <input type="text" name="title" value="<?php echo $title;?>"> 
            </td>
        </tr>

        <tr>
            <td>Current Image:</td>
            <td>
                <?php 
                    if($Current_image!=""){
                        ?>
                        <img src="<?php echo SITURL;?>/images/category/<?php echo $Current_image;?>" width="150px" alt="">
                        <?php
                    }else{
                        echo "<div class='error'> NO image to display </div>";
                    }
                ?>
            </td>
        </tr>

        <tr>
            <td>NEW Image:</td>
            <td>
            <input type="file" name="image" >
            </td>
        </tr>

        <tr>
            <td>Featured:</td>
            <td>
                <input <?php if($featured=="yes") {echo "checked";}?> type="radio" name="featured" value="yes">YES
                <input <?php if($featured=="no") {echo "checked";}?>  type="radio" name="featured" value="no">NO
            </td>
        </tr>

        <tr>
            <td>Active:</td>
            <td>
                <input <?php if($active=="yes") {echo "checked";}?>  type="radio" name="active" value="yes">YES
                <input <?php if($active=="yes") {echo "checked";}?>  type="radio" name="active" value="no">NO
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="submit" class="btn-secoundery">
            </td>
        </tr>

</table>

</form>

<?php
if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $title = $_POST['title'];
    $Current_image = $_POST['image_name'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];
    
    if(isset($_FILES['image']['name'])){
        $image_name = $_FILES['image']['name'];

        if($image_name!=""){  //as in adding 
            //renaming the image and add random num to img
            $ext = end(explode('.',$image_name)); //get the extension from img

            $image_name = "FoodCategory_".rand(000,999).'.'.$ext; // e.g. FoodCategory_123.jpg


            $source_path=$_FILES['image']['tmp_name'];
            $destination_path="../images/category/".$image_name;

            $upload = move_uploaded_file($source_path,$destination_path);

            if($upload==false){
                $_SESSION['upload']= "<div class='error'> failed to uploade the image</div>";
                header("location:".SITURL."admin/manage-category.php");
                die();
            }
           if($Current_image!=""){
                $remove_path = "../images/category/".$Current_image;
                $remove = unlink($remove_path);

                if($remove==false){
                    $_SESSION['failed-remove']= "<div class='error'> failed to remove the image</div>";
                    header("location:".SITURL."/admin/manage-category.php");
                    die();
                }
           }
        }else{
            $image_name=$Current_image;
        }

    }
    else{
        $image_name=$Current_image;
    }


    $sql2="UPDATE tbl_category SET title='$title', image_name='$image_name', featured='$featured', active='$active'WHERE id=$id";

    $res2 = mysqli_query($conn,$sql2);

    if($res2==true){

        $_SESSION['delete']="<div class='success'>Category Updated Successfully</div>"; 
           header('Location:http://localhost/FoodOrder/admin/manage-category.php');
    }else{
        $_SESSION['delete']="<div class='error'>Category Not Updated </div>"; 
        header('Location:http://localhost/FoodOrder//admin/manage-category.php');
    }


}

?>


    </div>
</div>


<?php include('partials/footer.php');?>