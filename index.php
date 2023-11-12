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
    <?php
            
            if(isset($_SESSION['order'])){
                echo $_SESSION['order'];
                unset($_SESSION['order']);
            }

            ?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php


                $sql = "SELECT * FROM tbl_category WHERE featured='yes' AND active='yes' LIMIT 3";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);

                if($count>0){
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title= $row['title'];
                        $image_name = $row['image_name'];
                            if($image_name!=""){

                            
                                ?>

                        <a href="category-foods.php?category_id=<?php echo $id;?>">
                                <div class="box-3 float-container">
                                    <img src="http://localhost/FoodOrder/images/category/<?php echo $image_name;?>" class="img-responsive img-curve">

                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                        </a>
                    
                        <?php
                        }else{
                            echo "<div class='error text-center'> NO image </div>";
                        }
                    }
                }else{
                    echo "<div class='error'> There is no thing to show </div>";
                }
            ?>

           

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
                <?php 
                $sql2 = "SELECT * FROM tbl_food WHERE active='yes' AND featuered='yes' LIMIT 6";
                $res2=mysqli_query($conn,$sql2);
                $count2 = mysqli_num_rows($res2);

                if($count2>0){
                    while ($row2=mysqli_fetch_assoc($res2)) { 
                        $idFood = $row2['id'];
                        $titleFood =$row2['title'];
                        $imageFood = $row2['image_name'];
                        $price=$row2['price'];
                        $description = $row2['description'];
                        ?>
                        <div class="food-menu-box">
                        <div class="food-menu-img">
                                <img src="http://localhost/FoodOrder/images/food/<?php echo $imageFood ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        </div>

                        <div class="food-menu-desc">
                                <h4><?php echo $titleFood ?></h4>
                                <p class="food-price">$<?php echo $price ?></p>
                                <p class="food-detail">
                                <?php echo $description ?>
                                </p>
                                <br>

                            <a href="http://localhost/FoodOrder/order.php?food_id=<?php echo $idFood;?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                        <?php
                    }

                }else{
                    echo "<div class='error'>There is no food</div>";
                }

                ?>
            

            

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php')?>