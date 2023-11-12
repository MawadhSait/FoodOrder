<?php include('partials/menu.php');?>
<div class="main-content">  
    <div class="wrapper">
    <h1>Add Food</h1>
    <br>
    <br>

    <?php
    if(isset($_SESSION['uploade'])){
        echo $_SESSION['uploade'];
        unset($_SESSION['uploade']);
    }

?>

    <br>
    <br>
    <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title</td>
                <td>
                    <input type="text"name="title" placeholder="food Title">
                </td>
            </tr>

            <tr>
                <td>Desciribtion:</td>
                <td><textarea name="descrition" id="" cols="30" rows="5" placeholder="Description of the food"></textarea></td>
            </tr>

            <tr>
                <td>Price</td>
                <td>
                    <input type="number"name="price">
                </td>
            </tr>

            <tr>
                <td>Select image</td>
                <td>
                    <input type="file" name="image">
                 </td>
            </tr>

            <tr>
                <td>Category:</td>
                <td>
                <select name="category" >
                    <?php
                    //create php code to display categories from database
                    $sql = "SELECT * FROM tbl_category WHERE active='yes'";

                    $res=mysqli_query($conn,$sql);
                    $count = mysqli_num_rows($res);

                    if($count>0){
                            while($row=mysqli_fetch_assoc($res)){
                                $id = $row['id'];
                                $title=$row['title'];
                                ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option> 
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

            <tr>
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured" value="yes">YES
                    <input type="radio" name="featured" value="no">NO
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" name="active" value="yes">YES
                    <input type="radio" name="active" value="no">NO
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="submit" class="btn-secoundery">
                </td>
            </tr>


        </table>
    </form>


    <?php
    if(isset($_POST['submit'])){
        $title= $_POST['title'];
        $descrition = $_POST['descrition'];
        $price = $_POST['price'];
        $category=$_POST['category'];

        if(isset($_POST['featured'])){
            $featured = $_POST['featured'];
        }else{
            $featured='no'; 
        }

        if(isset($_POST['active'])){
            $active = $_POST['active'];
        }else{
            $active='no'; 
        }

        if(isset($_FILES['image']['name'])){
            $image_name = $_FILES['image']['name'];

            if($image_name!=""){
                $ext= end(explode('.',$image_name));//splite the name to extract the extinsion of the img

                $image_name="Food_name".rand(000,999).'.'.$ext; ;


                //source path is the current location of the img
                $src =$_FILES['image']['tmp_name'];

                //destination path for the img to be uploaded
                $dist="../images/food/".$image_name;

                $upload = move_uploaded_file($src,$dist);

                if($upload==false){

                    $_SESSION['uploade']="<div class='error'> Failed to upload Image</div>";
                    header('location:'.SITURL.'/admin/add-food.php');
                    die();
                }


            }
        }else{
            $image_name ="";    
        }
        

        $sql2="INSERT INTO tbl_food SET
        title ='$title',
        description ='$descrition',
        price = $price, image_name ='$image_name',
        category_id ='$category',
        featuered ='$featured', 
        active ='$active'";

        $res2 = mysqli_query($conn,$sql2);

        if($res2==true){
            
            $_SESSION['add']="<div class='success'>  Food was added</div>";
            header("Location:http://localhost/FoodOrder/admin/manage-food.php");
        }else{
            $_SESSION['add']="<div class='error'> Food was not added</div>";
            header("Location:http://localhost/FoodOrder/admin/manage-food.php");
        }



    }

?>



    </div>
</div>



<?php include('partials/footer.php');?>