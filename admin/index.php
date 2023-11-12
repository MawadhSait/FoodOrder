<?php include('partials/menu.php');?>
 





  <!-- main content Section Starts Here -->
  <div class="main-content">
    <div class="wrapper">
        <h1>Dahboard</h1>

        <div class="col-4 text-center">
          
            <?php  
            $sql1="SELECT * FROM tbl_category";

            $res1= mysqli_query($conn,$sql1);

            $count1 = mysqli_num_rows($res1);
            echo " <h1>$count1 </h1>";
            ?>
              Categories
        </div>
        <div class="col-4 text-center">
        <?php  
            $sql2="SELECT * FROM tbl_food";

            $res2= mysqli_query($conn,$sql2);

            $count2 = mysqli_num_rows($res2);
            echo " <h1>$count2 </h1>";
            ?>
              Food
        </div>
        <div class="col-4 text-center">
        <?php  
            $sql3="SELECT * FROM tbl_order";

            $res3= mysqli_query($conn,$sql3);

            $count3 = mysqli_num_rows($res3);
            echo " <h1>$count3 </h1>";
            ?>
              Total Orders
        </div>
        <div class="col-4 text-center">
        <?php  
            $sql4="SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delevierd'";

            $res4= mysqli_query($conn,$sql4);
            $row = mysqli_fetch_assoc($res4);

            $total_revenu = $row['Total'];
            echo " <h1>$ $total_revenu </h1>";
            ?>
              Total Rvenu
        </div>
        
        <div class="clearfix"></div>
    </div>
  </div>
    <!-- main content Section Ends Here -->


 



    <?php include('partials/footer.php');?>