<?php include('partials-front/menu.php')?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

           

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                $sql = "SELECT * FROM tbl_food";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);

                if($count>0){
                    while ($row=mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $imageFood = $row['image_name'];
                    $price=$row['price'];
                    $description = $row['description'];
                        ?>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="http://localhost/FoodOrder/images/food/<?php echo $imageFood ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title?></h4>
                    <p class="food-price">$<?php echo $price ?></p>
                    <p class="food-detail">
                    <?php echo $description ?>
                    </p>
                    <br>

                    <a href="order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>

                        <?php

                    }
                }else{

                    echo "<div class='error text-center'> No Food To Show</div>";

                }
            ?>



       

     


           



            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php')?>