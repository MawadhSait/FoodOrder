<?php
session_start();

//create constant to store non repeating values
define('SITURL','http://localhost/FoodOrder');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME', 'foodorder');



$conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD,DB_NAME) or die(mysqli_error());

?>