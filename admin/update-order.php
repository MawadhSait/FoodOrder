<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>update Order</h1>
<br><br>


<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql="SELECT * FROM tbl_order WHERE id=$id";
    $res = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($res);

    if($count==1){
        $rows=mysqli_fetch_assoc($res);
        $id = $rows['Id'];
        $food = $rows['food'];
        $price = $rows['price'];
        $qty = $rows['qty'];
               
        $Status =  $rows['status'];
        $Customer_name = $rows['customer_name'];
        $Customer_phone_no = $rows['customer_contact'];
        $Customer_email = $rows['customer_email'];
        $Customer_address = $rows['customer_address'];
    }else{
        header("location:manage-order.php");
    }
    

}else{
    header("location:manage-order.php");
}

?>



<form action="" method="POST">


<table>
<tr>
    <td>Food Name</td>
    <td>
        <?php echo $food;?>
        <input type="hidden" name="food" value=" <?php echo $food;?>" required>
    </td>
</tr>
<tr>
    <td>Price</td>
    <td>
    $<?php echo $price;?>
    <input type="hidden" name="price" value=" <?php echo $price;?>" required>
    </td>
</tr>

<tr>
<td>Qty</td>
    <td>
        <input type="number" name="qty" value="<?php echo $qty;?>" required>
    </td>
</tr>

<tr>
<td>Status</td>
    <td>
        <select name="status" >
            <option  <?php if($Status =="ordered"){echo"selected";} ?> value="ordered">Ordered</option>
            <option <?php if($Status =="On Delivery"){echo"selected";} ?> value="On Delivery">ON deliviry</option>
            <option <?php if($Status =="Delevierd"){echo"selected";} ?> value="Delevierd">Delevierd</option>
            <option <?php if($Status =="Canceled"){echo"selected";} ?> value="Canceled">Canceled</option>
        </select>
    </td>
</tr>

<tr>
    <td>customer name</td>
    <td>
        <input type="text" name="customer-name" value="<?php echo $Customer_name;?>" class="input-responsive" required>
    </td>
</tr>

<tr>
    <td>Phone Number</td>
    <td>
        <input type="tel" name="contact" value="<?php echo $Customer_phone_no;?>" class="input-responsive" required>
    </td>
</tr>

<tr>
    <td>customer Email</td>
    <td>
        <input type="email" name="email" value="<?php echo $Customer_email;?>" class="input-responsive" required>
    </td>
</tr>

<tr>
    <td>customer Address</td>
    <td>
        <textarea name="address" rows="10" class="input-responsive" required><?php echo $Customer_address;?></textarea>
    </td>
</tr>

<tr>
<td>
<input type="hidden" name="id" value="<?php echo $id; ?>">
</td>

 <td>   <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary"></td>
</tr>

</table>
</form>


<?php

//
if(isset($_POST['submit']))
{
  $id = $_POST['id'];

    $qty = $_POST['qty'];

    $total = $price * $qty;

    $order_date = date("Y-m-d h:i:sa");

    $Customer_name = $_POST['customer-name'];
    $Customer_phone_no = $_POST['contact'];
    $Customer_email = $_POST['email'];
    $Customer_address = $_POST['address'];

    $status = $_POST['status'];

   echo $sql2 = "UPDATE tbl_order SET qty = $qty,
    total = $total,
    status = '$status',
    customer_name = '$Customer_name',
    customer_contact = '$Customer_phone_no',
    customer_email = '$Customer_email',
    customer_address = '$Customer_address'
    WHERE Id = $id";

    $res2 = mysqli_query($conn,$sql2);
   if ($res2==true) {
        $_SESSION['update']="<div class='success'> Updated the Order</div>";
        header('location:'.SITURL.'/admin/manage-order.php');
   }else{
        $_SESSION['update']="<div class='error'> NOT Updated the order</div>";
        header('location:'.SITURL.'/admin/manage-order.php');
   }
    


}
?>


    </div>
</div>
<?php include('partials/footer.php');?>