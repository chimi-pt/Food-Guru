<?php


session_start();

$server="localhost";
$username="root";
$password="";
$database="user_registration";

$con=mysqli_connect($server,$username,$password,$database);

$id=0;
$update=false;
$msg="";
$name='';
$password='';


if (isset($_POST["register"])) 
{
$User_name=$_POST["fname"];
$Password=$_POST["pword"];
$User_type=$_POST["usertype"];


$s="SELECT *from user_details where Name='$User_name'";

$result=mysqli_query($con,$s);

$num=mysqli_num_rows($result);


if($num==1)
{
	$_SESSION['message']="Username already taken";
	$_SESSION['msg_type']="danger";

	header('location:test.php');
}
else
{
	$query="INSERT INTO user_details(Name,password,user_type)VALUES('$User_name','$Password','$User_type')";
	mysqli_query($con,$query);

	$_SESSION['message']="Record has been saved";
	$_SESSION['msg_type']="success";

	header('location:test.php');
}


}

if(isset($_GET['delete']))
	{
		$id=$_GET['delete'];
		$con->query("DELETE FROM user_details WHERE user_id=$id")or die ($con->error());


		$_SESSION['message']="Record has been deleted";
		$_SESSION['msg_type']="danger";

		header('location:test.php');
	}
if(isset($_GET['edit']))
	{
		$id=$_GET['edit'];
		$update=true;


		$result = mysqli_query($con,"SELECT * FROM user_details WHERE user_id=$id")or die ($con->error());

		
			$row=$result->fetch_array();
			$name=$row['Name'];
			$password=$row['password'];
			$usertype=$row['user_type'];
			# code...
		

		
	}

if (isset($_POST['update']))
 {
	$id=$_POST['id'];
	$name=$_POST['fname'];
	$password=$_POST['pword'];
	$usertype=$_POST['usertype'];

	$query="UPDATE  user_details SET Name='$name', password='$password' ,user_type='$usertype' WHERE user_id=$id";
	mysqli_query($con,$query);

		

	$_SESSION['message']="Record has been updated";
	$_SESSION['msg_type']="warning";

	header('location:test.php');


}
if (isset($_POST["login"])) 
{
	$User_name=$_POST["user"];
	$Password=$_POST["password"];
	$User_type=$_POST["usertype"];

	$sql="SELECT *from user_details where Name=? AND password=? AND user_type=?";

	$stmt=$con->prepare($sql);
	$stmt->bind_param("sss",$User_name,$Password,$User_type);
	$stmt->execute();
	$result=$stmt->get_result();
	$row=$result->fetch_assoc();

	session_regenerate_id();
	$_SESSION['username']=$row['Name'];
	$_SESSION['role']=$row['user_type'];
	session_write_close();

	if ($result->num_rows==1 && $_SESSION['role']=="client") 
	{
		header("location: homepage2.php");
	}
	else if ($result->num_rows==1 && $_SESSION['role']=="admin") 
	{
		header("location:shopping/admin.php");
	}
	else
	{
		//header('location:test.php');
		//$_SESSION['message']="Username or Password is Incorrect!";
		//$_SESSION['msg_type']="danger";
		echo "<script>alert('Username or Password is Incorrect!')</script>";
 		echo "<script>window.location='test.php'</script>";
	}
}


?>