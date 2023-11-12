<?php include('partials-front/menu.php')?>
<?php



    if(isset($_GET['food_id'])){
        $id = $_GET['food_id']; 

        $sql = "SELECT * FROM tbl_food WHERE id=$id";
        $result=mysqli_query($conn,$sql);   
        $count = mysqli_num_rows($result);
        if ($count == 1){   
            $row= mysqli_fetch_assoc($result) ; 
            
            $title = $row['title'];
            $imageFood = $row['image_name'];
            $price1=$row['price'];
            $description = $row['description'];
        }else{
            header("Location: index.php");
        }
        

    }else{
        header("Location: index.php");
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            <br>
            <br>

         
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="#" method="POST"class="order">
                <fieldset>
                    <legend>Food Selected</legend>

                    <div class="food-menu-img">

                    <?php 
                        if($imageFood==""){
                            echo "<div class='error'> Image Not Available</div>";
                        }else{
                            ?>
                        <img src="images/food/<?php echo $imageFood?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php
                        }
                    ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">$<?php echo $price1?></p>
                        <input type="hidden" name="price" value="<?php echo $price1; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>


            <?php

        if(isset($_POST['submit'])){

            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];

            $total = $price * $qty;

            $order_date = date("Y-m-d h:i:sa");

            $Customer_name = $_POST['full-name'];
            $Customer_phone_no = $_POST['contact'];
            $Customer_email = $_POST['email'];
            $Customer_address = $_POST['address'];

            $status = "ordered";

            $sql2 = "INSERT INTO tbl_order SET 
            food='$food',
            price=$price,
            qty=$qty,
            total=$total,
            order_date= '$order_date' ,
            status='$status',
            customer_name= '$Customer_name' ,
            customer_contact= '$Customer_phone_no' ,
            customer_email= '$Customer_email' ,
            customer_address= '$Customer_address'";
            
            $res = mysqli_query($conn,$sql2);

          if($res==true){
                $_SESSION['order']="<div class='success'> Food Ordered successfly </div>";
                header('location:index.php');
            }else{
                $_SESSION['order']="<div class='error'> Failed to Food Ordered  </div>";
                header('location:index.php');
            }

        }


            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php')?>