<?php include('partials/menu.php');?>
<div class="main-content">  
    <div class="wrapper">
    <h1>Add Catgory</h1>
    <br>
    <br>
    <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title</td>
                <td>
                    <input type="text"name="title" placeholder="Category Title">
                </td>
            </tr>

            <tr>
                <td>Select image</td>
                <td>
                    <input type="file" name="image">
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
        $title=$_POST['title'];

        if(isset($_POST['featured'])){
            $featured = $_POST['featured'];
        }else{
            $featured="no";
        }

        if(isset($_POST['active'])){
            $active = $_POST['active'];
        }else{
            $active="no";
        }

        if(isset($_FILES['image']['name'])){

            //to uplade imge we need imgName imgDestination imgPath
            $image_name = $_FILES['image']['name'];
            
            if($image_name!=""){
                        //renaming the image and add random num to img
                $ext = end(explode('.',$image_name)); //get the extension from img

                $image_name = "FoodCategory_".rand(000,999).'.'.$ext; // e.g. FoodCategory_123.jpg


                $source_path=$_FILES['image']['tmp_name'];
                $destination_path="../images/category/".$image_name;

                $upload = move_uploaded_file($source_path,$destination_path);

                if($upload==false){
                    $_SESSION['upload']= "<div class='error'> failed to uploade the image</div>";
                    header("location:".SITURL."admin/add-category.php");
                    die();
                }
            }
         
        }else{
            $image_name = "";
        }



        $sql="INSERT INTO tbl_category SET
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        ";

        $res =mysqli_query($conn, $sql);

        if($res==true){
            $_SESSION['add']= "<div class='success'> Category were added</div>";
            header("location:".SITURL."/admin/manage-category.php");
        }else{
            $_SESSION['add']= "<div class='error'> Category were not added</div>";
            header("location:".SITURL."/admin/manage-category.php");
        }


    }

?>
    </div>
</div>



<?php include('partials/footer.php');?>