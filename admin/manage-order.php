<?php include('partials/menu.php');?>

  <!-- main content Section Starts Here -->
  <div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        
<br><br>

<?php
if(isset($_SESSION['update'])){
  echo $_SESSION['update']; //displaying session message if any
  unset($_SESSION['update']);

}
?>


    <table class="tbl-full">
      <tr>
        <th>S.N</th>
        <th>Food</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Total</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>customer name</th>
        <th>contact</th>
        <th>email</th>
        <th>address</th>
        <th>Action</th>
      </tr>
    <?php 
    $sn = 1;
    $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
    $result=mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);

    if($count>0){
      while($rows=mysqli_fetch_assoc($result)){
        $id = $rows['Id'];
        $food = $rows['food'];
        $price = $rows['price'];
        $qty = $rows['qty'];
        $total =$rows['total'];
        $order_date = $rows['order_date'];
        $Status =  $rows['status'];
        $Customer_name = $rows['customer_name'];
        $Customer_phone_no = $rows['customer_contact'];
        $Customer_email = $rows['customer_email'];
        $Customer_address = $rows['customer_address'];


        ?>
         <tr>
        <td><?php echo $sn++?></td>
        <td><?php echo $food?></td>
        <td><?php echo $price?></td>
        <td><?php echo $qty?></td>
        <td><?php echo $total?></td>
        <td><?php echo $order_date?></td>
        <td>
            <?php
            if ($Status == 'ordered') {
              echo "<label style='color:black;'> $Status </label> ";
            }
              if($Status == "On Delivery"){
                echo "<label style='color:green;'> $Status </label> ";
              }
              if($Status == "Delevierd"){
                echo "<label style='color:orange;'> $Status </label> ";
              }
              if($Status == "Canceled"){
                echo "<label style='color:red;'> $Status </label> ";
              }
            ?>
        </td>
        <td><?php echo $Customer_name?></td>
        <td><?php echo $Customer_phone_no?></td>
        <td><?php echo $Customer_email?></td>
        <td><?php echo $Customer_address?></td>
        <td> 
           <a href="<?php echo SITURL ?>/admin/update-order.php?id=<?php echo $id ?>" class="btn-secoundery" class="btn-secoundery">update </a>
           </td>
      </tr>
      <br>
      <div class="line"></div>

        <?php
      }
    }else{
      echo "<div class='error' colspan='12'> There is no order Yet</div>";
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