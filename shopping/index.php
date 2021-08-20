<?php
//start session
session_start();

require_once('php/CreateDb.php');
 require_once('php/component.php');




 //create instance of CreateDb class
 $database=new CreateDb("Productsdb","Producttb");


 if(isset($_POST['add']))
 {
 	if(isset($_SESSION['cart']))
 	{


 	$item_array_id=array_column($_SESSION['cart'], "product_id");

 	if (in_array($_POST['product_id'],$item_array_id)) 
 	{
 		echo "<script>alert('Product has already been added in the cart...!')</script>";
 		echo "<script>window.location='index.php'</script>";
 	}

 	else
 	{
 		$count=count($_SESSION['cart']);
 		$item_array=array('product_id'=>$_POST['product_id']);

 		$_SESSION['cart'][$count]=$item_array;
 		

 	}
 	//print_r($_POST['product_id']);
	


 	

 	}else
 		{
 			$item_array=array('product_id'=>$_POST['product_id']);

 			//create new session variable
 			$_SESSION['cart'][0]=$item_array;
 			print_r($_SESSION['cart']);
 		}
 }



?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Shopping</title>
  <link rel="stylesheet"  href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="styleindex.css">
  <script src="../js/all.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Mr+Dafoe&display=swap" rel="stylesheet">
  <link rel="stylesheet"  href="../magnific-popup/magnific-popup.css">
</head>
<body>



<?php 
require_once('php/header.php');


 ?>


<div class="container">
	<div class="row text-center py-5">
		<?php
		$result=$database->getData();
		while($row=mysqli_fetch_assoc($result))
		{
			component($row['product_name'],$row['product_price'],$row['product_image'],$row['id']);
		}


		?>

	</div>

</div>




		 




<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/jquery.ripples-min.js"></script>
<script src="../magnific-popup/jquery.magnific-popup.js"></script>
<script src="../js/script.js"></script>
</body>
</html>