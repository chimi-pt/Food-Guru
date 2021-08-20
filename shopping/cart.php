<?php 
session_start();

require_once("php/CreateDb.php");
require_once("php/component.php");

$db=new CreateDb("Productsdb","Producttb");
$link = mysqli_connect("localhost", "root", "", "Productsdb");

if (isset($_POST['remove']))
 {
	if ($_GET['action']=='remove') 
	{
		foreach ($_SESSION['cart'] as $key => $value) 
		{
			if ($value["product_id"]==$_GET['id'])
			 {
				unset($_SESSION['cart'][$key]);
				

			}
		}
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
  <link rel="stylesheet" type="text/css" href="stylecart.css">
  <script src="../js/all.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Mr+Dafoe&display=swap" rel="stylesheet">
  <link rel="stylesheet"  href="../magnific-popup/magnific-popup.css">
</head>
<body class="bg-light">

<?php 
require_once("php/header.php");
 ?>

 <div class="container-fluid">
 	
 	<div class="row pc-5">
 		<div class="col-md-7">
 			<div class="shopping-cart">
 				<h6 class="text-capitalize" style="color: blue; font-size: 30px;"><?=  $_SESSION ['username'] ?>'s Cart</h6>
 				<hr>
					<?php 
					$total=0;
					if (isset($_SESSION['cart'])) 
					{
						$product_id=array_column($_SESSION['cart'],'product_id');

					$result=$db->getData();
					while ($row=mysqli_fetch_assoc($result)) 
					{
						foreach ($product_id as $id) 
						{
							if ($row['id']==$id) 
							{
								cartElement($row['product_image'],$row['product_name'],$row['product_price'],$row['id']);
								$total=$total+(int)$row['product_price'];
									$prize=$row['product_price'];
									$iad = $_SESSION['username'];
									$img=$row['product_image'];
									$namee = $row['product_name'];
									$orderid=$iad.$namee;

									$sql = "INSERT INTO orders(OrderID,ProductName,ProductPrice)VALUES('$orderid','$namee','$prize')";
										mysqli_query($link, $sql);		
								
							}
						}
					}
					}
					else
					{
						echo "<h5>Cart is Empty :(</h5>";
					}


					 ?>

 				
 			</div>

 		</div>
 		<div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
 			<div class="pt-4">
 				<h6>PRICE DETAILS</h6>
 				<hr>

 				<div class="row price-details">
 					<div class="col-md-6">
 						<?php 
 						if (isset($_SESSION['cart'])) 
 						{
 							$count=count($_SESSION['cart']);
 							echo "<h6>Price ($count items)</h6>";
 						}
 						else
 						{
 							echo "<h6>Price (0 items)</h6>";
 						}

 						 ?>

 						 <h6>Delivery Charges</h6>
 						 <hr>
							<h6>Amount Payable</h6>

 					</div>
 					<div class="col-md-6">
 						
 						<h6>Ksh <?php echo ($total); ?></h6>
 						<h6 class="text-success">FREE</h6>
 						<hr>
 							<h6>Ksh <?php echo ($total); ?></h6>
 					</div>
 				</div>
 			</div>
			<form action="" method="post">
			<button type="submit" name="submitOrder" style="background: green!important; color: white;" class="btn btn-block boton  text-uppercase contact-btn"><i class="far fa-hand-point-right mr-2" ></i>Submit Order</button>
			</form>
 		</div>
 		<?php
 			if (isset($_POST['submitOrder'])) {

 				echo "<script>alert('Order Submitted!')</script>";
 				echo "<script>window.location='cart.php'</script>";
 				$tootal=$total;
 				$iad = $_SESSION['username'];
 				$totalid=$iad.$tootal;


 				
 				$sql = "INSERT INTO orders(UserName,OrderID,Total)VALUES('$iad','$totalid','$tootal')";
				mysqli_query($link, $sql);	


 			}


 		?>
	

 	</div>
 </form>
 </div>












<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/jquery.ripples-min.js"></script>
<script src="../magnific-popup/jquery.magnific-popup.js"></script>
<script src="../js/script.js"></script>	
</body>
</html>