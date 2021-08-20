<?php

session_start();



$server="localhost";
$username="root";
$password="";
$database="user_registration";

$con=mysqli_connect($server,$username,$password,$database);




$User_name=$_POST["user"];
$Password=$_POST["password"];




$s="SELECT *from user_details where Name='$User_name' && password='$Password'";

$result=mysqli_query($con,$s);

$num=mysqli_num_rows($result);


if($num==1)
{
	$_SESSION['username']=$User_name;
	header ('location:home.php');
}
else
{
	header('location:test.php');
}


?>