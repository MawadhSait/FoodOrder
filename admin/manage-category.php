<?php include('partials/menu.php');?>

  <!-- main content Section Starts Here -->
  <div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        
<br><br>
<!-- Button trigger modal --> 
        <a href="http://localhost/FoodOrder/admin/add-category.php" class="btn-primary">Add Category</a>

        <br><br><br>

        <?php
          if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
           unset($_SESSION['add']);//removing session message
          }
          if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
           unset($_SESSION['upload']);//removing session message
          }
        
        if(isset($_SESSION['remove'])){
          echo $_SESSION['remove'];
         unset($_SESSION['remove']);//removing session message
        }

        if(isset($_SESSION['delete'])){
          echo $_SESSION['delete'];
         unset($_SESSION['delete']);//removing session message
        }
        if(isset($_SESSION['update'])){
          echo $_SESSION['update']; 
          unset($_SESSION['update']);//removing session message 
        } 
        if(isset($_SESSION['failed-remove'])){
          echo $_SESSION['failed-remove']; 
          unset($_SESSION['failed-remove']);//removing session message 
        }


        
        ?>

    <table class="tbl-full">
      <tr>
        <th>S.N</th>
        <th>full Name</th>
        <th>username</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
      </tr>

      <?php 

      $sn= 1;
            $sql="SELECT * FROM tbl_category";

            $res= mysqli_query($conn,$sql);

            $count = mysqli_num_rows($res);
            if($count>0){
              while ($row=mysqli_fetch_assoc($res)) {
                  $id=$row['id'];
                  $title=$row['title'];
                  $image_name=$row['image_name'];
                  $featured=$row['featured'];
                  $active=$row['active'];
                 
                  ?>
                  <tr>
                  <td><?php echo  $sn++;?></td>

                  <td><?php echo $title;?></td>

                  <td>
                    <?php 
                    if($image_name!=""){
                      ?>
                    <img src="<?php echo SITURL;?>/images/category/<?php echo $image_name?>" width="100px" alt="">
                    <?php

                    }else{
                      echo "<div class='error'>no photo added</div>";
                    }

                    
                    ?>

                  </td>

                  <td><?php echo $featured;?></td>

                  <td><?php echo $active;?></td>

                  <td>
                    <a href="<?php echo SITURL ?>/admin/update-category.php?id=<?php echo $id ?>" class="btn-secoundery" class="btn-secoundery">update Category</a>
                    <a href="<?php echo SITURL ?>/admin/delete-category.php?id=<?php echo $id ?>&image_name=<?php echo $image_name ?>" class="btn-danger">delete Category</a>
                    
                    
                  </td>
                </tr>

<br><br>
                <?php
              }

            }else{
              
              //there is no data in db
              ?>
              <tr>
                <td colspan="6"><div class="error">No Category added</div></td>
              </tr>
              <?php
            }

          ?>


   



    </table>

    </div>   
  </div>
    <!-- main content Section Ends Here -->


 
    </div>   
  </div>
    <!-- main content Section Ends Here -->


 



    <?php include('partials/footer.php');?>