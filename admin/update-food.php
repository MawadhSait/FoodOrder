<?php include('partials/menu.php');?>

<?php
if(isset($_GET['id'])){


    $id = $_GET['id']; 


    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
    $res2 = mysqli_query($conn,$sql2);

    

    if($res2==true){
        $row2 = mysqli_fetch_assoc($res2);
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $Current_image = $row2['image_name'];
        $CurrentCategory_id= $row2['category_id'];
        $featuered= $row2['featuered'];
        $active= $row2['active'];
    }else{
        $_SESSION['no-food-found']="<div class='error'>NO shuch a Foood</div>";
        header("location:http://localhost/FoodOrder/admin/manage-food.php");   
    
    }


}
?>


<div class="main-content">
    <div class="wrapper">
        <h1>update Food</h1>
<br><br>




<form action="" method="POST" enctype="multipart/form-data">

    <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>"> 
                </td>
            </tr>
            <tr>
                <td>Desciribtion:</td>
                <td><textarea name="descrition" id="" cols="30" rows="5"  ><?php echo $description; ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Price</td>
                <td>
                    <input type="number"name="price" value="<?php echo $price; ?>">
                </td>
            </tr>


            <tr>
                <td>Current Image:</td>
                <td>
                 <?php 
                        if($Current_image!=""){
                            ?>
                            <img src="http://localhost/FoodOrder/images/food/<?php echo $Current_image;?>" width="150px" alt="">
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


            <tr>
                <td>Category</td>
                <td>
                <select name="category" >
                    <?php
                    //create php code to display Food from database
                    $sql = "SELECT * FROM tbl_category WHERE active='yes'";

                    $res=mysqli_query($conn,$sql);
                    $count = mysqli_num_rows($res);

                    if($count>0){
                            while($row=mysqli_fetch_assoc($res)){
                                $CategoryId = $row['id'];
                                $CategoryTitle=$row['title'];
                                ?>
                                <option <?php if($CurrentCategory_id == $CategoryId){echo "selected";} ?> value="<?php echo $CategoryId; ?>"><?php echo $CategoryTitle; ?></option> 
                                <?php
                            }
                    }else{
                        ?>
                         <option value="0">No category Found</option> 
                        <?php
                    }
                    ?>

              
                    
                    </select>
                </td>

            </tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($active=="yes") {echo "checked";}?> type="radio" name="featuered" value="yes">YES
                    <input <?php if($active=="no") {echo "checked";}?> type="radio" name="featuered" value="no">NO
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input <?php if($active=="yes") {echo "checked";}?>  type="radio" name="active" value="yes">YES
                    <input <?php if($active=="no") {echo "checked";}?>  type="radio" name="active" value="no">NO
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="current_image" value="<?php echo $Current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="submit" class="btn-secoundery">
                </td>
            </tr>

    </table>

</form>




<?php 
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $title=$_POST["title"];
    $description=$_POST['descrition'];
    $price = $_POST['price'];
    $Current_image = $_POST['current_image'];
    $category = $_POST['category'];
    $featuered= $_POST['featuered'];
    $active= $_POST['active'];

    if(isset($_FILES['image']['name'])){
        $image_name = $_FILES['image']['name'];

        if($image_name!=""){
            $ext = end(explode('.',$image_name));

            $image_name = "food-Name".rand(000,999).'.'.$ext;

            $src_path = $_FILES['image']['tmp_name'];
            $dist_path ="../images/food/".$image_name;

            $upload = move_uploaded_file($src_path,$dist_path);

            if($upload==false){
                $_SESSION['uploade']="<div class='error'> Failed to upload Image</div>";
                    header('location:'.SITURL.'/admin/add-food.php');
                    die();
            }
            
            if($Current_image!=""){
                $remove_path = "../images/food/".$Current_image;
                $remove = unlink($remove_path);

                if($remove==false){
                    $_SESSION['remove-failed']="<div class='error'> Failed to upload Image</div>";
                    header('location:'.SITURL.'/admin/manage-food.php');
             
                }
            }


        }else{
            $image_name=$Current_image;
        }
    
        
    }else{
        $image_name=$Current_image;
    }


    $sql3 = "UPDATE tbl_food SET 
    title = '$title', 
    description = '$description', 
    price = $price,
    image_name = '$image_name',
    category_id = '$category',
    featuered = '$featuered',
    active = '$active' WHERE id=$id";

    $res3= mysqli_query($conn,$sql3);
    if ($res3==true) {
        $_SESSION['update']="<div class='success'> Updated food</div>";
        header('location:'.SITURL.'/admin/manage-food.php');
    }else{
        $_SESSION['update']="<div class='error'> NOT Updated food</div>";
        header('location:'.SITURL.'/admin/manage-food.php');
    }

}

?>


</div>
</div>


<?php include('partials/footer.php');?>