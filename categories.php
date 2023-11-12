<?php include('partials-front/menu.php')?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                $sql = "SELECT * FROM tbl_category WHERE active='yes'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count>0){
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $image = $row['image_name']; 

                        if($image!=""){
                                ?>

                         <a href="category-foods.php?category_id=<?php echo $id;?>">
                            <div class="box-3 float-container">
                                    <img src="http://localhost/FoodOrder/images/category/<?php echo $image ?>" alt="" class="img-responsive img-curve">
                                <h3 class="float-text text-white"><?php echo $title ?></h3>
                            </div>
                        </a>
                        <?php
                        }else{
                            echo "<p>No image Found.</p>";
                        }
                    }
                }else{
                    echo "<p>No Category Found.</p>";
                }


            ?>


            

            
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



<?php include('partials-front/footer.php')?>