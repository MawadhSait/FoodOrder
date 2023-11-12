<?php include('partials/menu.php');?>

  <!-- main content Section Starts Here -->
  <div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>

<br><br>

    <?php
        $id = $_GET['id'];

    ?>

    <form action="" method="post">

        <table class="col-30">
            <tr>
                <td>Current password:</td>
                <td>
                    <input type="text" name="current_password" placeholder="current password">
                </td>
            </tr>

            <tr>
                <td>New password:</td>
                <td>
                    <input type="text" name="New_password" placeholder="New password">
                </td>
            </tr>

            <tr>
                <td>Confirm new password:</td>
                <td>
                    <input type="text" name="Confirm_new_password" placeholder="Confirm new password">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="Change Password" class="btn-secoundery">
                </td>
            </tr>


        </table>
    </form>

    </div>
 </div>



 <?php

    if(isset($_POST['submit'])){
        $id=$_POST['id'];
        $cpass = md5($_POST['current_password']);
        $Npass = md5($_POST['New_password']);
        $CNpass = md5($_POST['Confirm_new_password']);
   

    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$cpass'";

    $res = mysqli_query($conn,$sql);

    if($res==true){
        $count = mysqli_num_rows($res);

        if($count==1){

            if($Npass==$CNpass){


                $sql= "UPDATE tbl_admin SET password='$Npass' WHERE id=$id";
                $res2 = mysqli_query($conn,$sql);
                
                if($res2==true){
                    $_SESSION['changePass'] = "<div class='success'> Password is changed</div>";
                    header("location:".SITURL."/admin/manage-admin.php");

                }else{
                    $_SESSION['changePass'] = "<div class='error'> Password is not changed </div>";
                    header("location:".SITURL."/admin/manage-admin.php");
                }


                
            }else{
                $_SESSION['Not_match'] = "<div class='error'> Password not match</div>";
                header("location:".SITURL."/admin/manage-admin.php");
            }
        }else{
            $_SESSION['Not_found'] = "<div class='error'> User not found</div>";
            header("location:".SITURL."/admin/manage-admin.php");
        }
    }
}


 ?>
<?php include('partials/footer.php');?>