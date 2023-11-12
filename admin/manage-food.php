<?php include('partials/menu.php');?>

  <!-- main content Section Starts Here -->
  <div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        
<br><br>
<!-- Button trigger modal --> 
        <a href="<?php echo SITURL; ?>/admin/add-food.php" class="btn-primary">Add Food</a>

        <br><br><br>


        <?php
    if(isset($_SESSION['add'])){
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
    if(isset($_SESSION['delete'])){
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
    } 
    if(isset($_SESSION['upload'])){
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    } 
   if(isset($_SESSION['unauthorized'])){
    echo $_SESSION['unauthorized'];
    unset($_SESSION['unauthorized']);
    }
    if(isset($_SESSION['no-food-found'])){
      echo $_SESSION['no-food-found'];
      unset($_SESSION['no-food-found']);
      }
      if(isset($_SESSION['remove-failed'])){
        echo $_SESSION['remove-failed'];
        unset($_SESSION['remove-failed']);
        }
        if(isset($_SESSION['update'])){
          echo $_SESSION['update'];
          unset($_SESSION['update']);
          }

    
?>
<br>

    <table class="tbl-full">
    <tr>
        <th>S.N</th>
        <th>title</th>
        <th>price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
      </tr>

      <?php
      $sn=1;
        $sql = "SELECT * FROM tbl_food";
        $res = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($res);
        if($count>0){
            while($row=mysqli_fetch_assoc($res)){
              $id=$row['id'];
              $title= $row['title'];
              $price=$row['price'];
              $image =$row['image_name'];  
              $featured =$row['featuered'];  
              $active =$row['active'];  
              ?>
      <tr>
              <td><?php echo $sn++; ?></td>
              <td><?php echo $title; ?></td>
              <td><?php echo $price;?> $</td>
              <td>
                <?php 
                  if ($image==""){
                    echo "<div class='error'> Image not Added</div>";
                  }else{
                      ?>
                   <img src="http://localhost/FoodOrder/images/food/<?php echo $image; ?>" width="100px" alt="">

                      <?php
                  }
                ?>
                </td>
              <td><?php echo $featured;?></td>
              <td><?php echo $active; ?></td>
              <td>
                    <a href="<?php echo SITURL ?>/admin/update-food.php?id=<?php echo $id ?>" class="btn-secoundery" class="btn-secoundery">update Category</a>
                    <a href="<?php echo SITURL ?>/admin/delete-food.php?id=<?php echo $id ?>&image_name=<?php echo $image ?>" class="btn-danger">delete Category</a>
              </td>
      </tr>

<?php

            }
        }else{
          echo "<tr><td colspan='7' class='error'> Food not Added Yet </td> </tr>";
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