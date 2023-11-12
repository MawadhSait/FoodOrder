<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>update Admin</h1>
<br><br>

<?php
$id = $_GET['id'];

$sql = "SELECT * FROM tbl_admin WHERE id=$id";
$res = mysqli_query($conn,$sql);

if($res==true){
 
    $count = mysqli_num_rows($res);

    if($count==1){
        echo " Admin is Available";
        $row= mysqli_fetch_assoc($res);

        $fullname = $row['full_name'];
        $username = $row['username'];
        
    }else{
        header("location:".SITURL."/admin/manage-admin");
    }
}

?>


<form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $fullname?>">
                    </td>
                </tr>
                <tr>
                    <td>username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secoundery">
                    </td>
                </tr>
                
            </table>
</form>


<?php 
    if(isset($_POST['submit'])){
        $fullname = $_POST['full_name'];
        $username=$_POST['username'];
        $id= $_POST['id'];

        $sql="UPDATE tbl_admin SET full_name='$fullname', username='$username' WHERE id='$id'";
        $res = mysqli_query($conn,$sql);

        if($res=true){
            $_SESSION['update']="<div class='success'> Admin is Updated </div>";
            header("location:".SITURL."/admin/manage-admin.php");
        }
         else {
            $_SESSION['update']="<div class='error'> Admin is Updated </div>";
            header("location:".SITURL."/admin/manage-admin.php");
         }
    }

?>

    </div>
</div>

<?php include('partials/footer.php');?>