<?php include('partials/menu.php');?>

  <!-- main content Section Starts Here -->
  <div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>

<br><br>
<!-- Button trigger modal --> 
  <?php
   
      if(isset($_SESSION['add'])){
        echo $_SESSION['add'];
        unset($_SESSION['add']);//removing session message
      }

      if(isset($_SESSION['delete'])){
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);//removing session message
      }
      if(isset($_SESSION['update'])){
        echo $_SESSION['update'];
        unset($_SESSION['update']);//removing session message
      }
      if(isset($_SESSION['changePass'])){
        echo $_SESSION['changePass'];
        unset($_SESSION['changePass']);//removing session message
      }
      if(isset($_SESSION['Not_match'])){
        echo $_SESSION['Not_match'];
        unset($_SESSION['Not_match']);//removing session message
      }
      if(isset($_SESSION['Not_found'])){
        echo $_SESSION['Not_found'];
        unset($_SESSION['Not_found']);//removing session message
      }
      if(isset($_SESSION['login'])){
        echo $_SESSION['login'];
        unset($_SESSION['login']);//removing session message
      }
      
  ?>
<br><br><br>

        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <br><br><br>

    <table class="tbl-full">
        <?php
            $sql = "SELECT * FROM tbl_admin";
            $res = mysqli_query($conn, $sql);
            $sn = 1;
        if($res==TRUE)
        {
          $count = mysqli_num_rows($res);

          if($count>0)
          {
            while($rows=mysqli_fetch_assoc($res)){
              $id = $rows['id'];
              $full_name=$rows['full_name'];
              $username=$rows['username'];

              ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $username; ?></td>
                        <td>
                          <a href="<?php echo SITURL;?>/admin/change-pass.php?id=<?php echo $id;?>"class="btn-primary">change password</a>
                          <a href="<?php echo SITURL;?>/admin/update-admin.php?id=<?php echo $id;?>" class="btn-secoundery">update Admin</a>
                          <a href="<?php echo SITURL;?>/admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">delete Category</a>
                          
                        </td>
                      </tr>

              <?php



            }

          }else{

          }
        }
      ?>
    
    </table>

    </div>   
  </div>
    <!-- main content Section Ends Here -->


 



    <?php include('partials/footer.php');?>