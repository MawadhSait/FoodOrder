
<?php
include('../config/constant.php');

?>


<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="../css/admin.css">

    <link rel="apple-touch-icon" sizes="180x180" href="../images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>
<style>
   

</style>
    <body>

   
        <div class="login tt">
            <h1 class="text-center">Login</h1>
            <br><br>
            <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);//removing session message
            }if(isset($_SESSION['no-login-msg'])){
                echo $_SESSION['no-login-msg'];
                unset($_SESSION['no-login-msg']);
            }
                ?><br><br>
            <form action="" method="POST" class="text-center">
           

                Username: <br>
                <input type="text" name="username" placeholder="Enter username" ><br><br>

                Password: <br>
                <input type="text" name="password" placeholder="Enter password">
                <br><br>

                <input type="submit" name="submit" value="login" class="btn-primary">
            </form>
        </div>



    </body>

</html>


<?php

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($conn,$_POST['username']);

    $raw_password = md5($_POST['password']);
    $password = mysqli_real_escape_string($conn,$raw_password);

    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    $res = mysqli_query($conn,$sql);   

    $count= mysqli_num_rows($res);


    if($count==1){

        $_SESSION['login'] = "<div class='success '> welcome you  are loged in</div>";
        $_SESSION['user'] = $username;
        header("location:http://localhost/FoodOrder/admin/");
    }else{
        $_SESSION['login'] = "<div class='error text-center'> You are not loged in</div>";

        header("location:http://localhost/FoodOrder/admin/login.php");
    }

}

?>