


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <title>Shopping Cart</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
   
    <!-- our custom CSS -->
   <link rel="stylesheet" type="text/css" href="stylecart.css">
</head>
<body>
	<?php include_once 'connectcart.php'; ?>
	<?php

	if(isset($_SESSION['message'])):?>
		<div class="alert alert-<?=$_SESSION["msg_type"]?>">

			<?php
				echo $_SESSION["message"];
				unset($_SESSION["message"]);

			?>
		</div>
	<?php endif ?>	

	<div class="container" style="width:60%">
		<h2>Shopping Cart</h2>
		<?php
		$query="SELECT *FROM product ORDER BY id ASC";
		$result=mysqli_query($con,$query);

		if(mysqli_num_rows($result)){

			while($row=mysqli_fetch_array($result)){
		?>

		<div class="col-md-3">
			<form method="post" action="connectcart.php?action=add&id=<?php echo $row["id"]; ?>">
				<div class="product">
					<img src="<?php echo $row["image"]; ?>" class="img-responsive">
					<h5 class="text-info"><?php echo $row["pname"];?></h5>
					<h5 class="text-danger"><?php echo $row["price"];?></h5>
					<input type="text" name="quantity" class="form-control" value="1">
					<input type="hidden" name="hidden_name" value="<?php echo $row["pname"];?>">
					<input type="hidden" name="hidden_price" value="<?php echo $row["price"];?>">
					<input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success" value="Add to Cart">
					

				</div>
				


			</form>


		</div>
		<?php
	}
}


		?>

		<div style="clear: both"></div>
		<h3 class="title2">Shopping Cart Details</h3>

		<div class="table-responsive">
			<table class="table table-bordered">

			<tr>
				<th width="30%">Product Name</th>
				<th width="10%">Quantity</th>
				<th width="13%">Product Details</th>
				<th width="10%">Total price</th>
				<th width="17%">Remove Item</th>


			</tr>

			<?php
				if (!empty($_SESSION["cart"])) {
					$total=0;
					foreach ($_SESSION["cart"] as $key => $value) {
					?>
				<tr>
					<td><?php echo $value["item_name"];?></td>
					<td><?php echo $value["item_quantity"];?></td>
					<td>$ <?php echo $value["product_price"];?></td>
					<td>$ <?php echo number_format($value["item_quantity"] *$value["product_price"]) ;?></td>
					<td><a href="connectcart.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span class="text-danger">Remove Item</span></a></td>


				</tr>
				<?php
				  	$total=$total+($value["item_quantity"]* $value["product_price"]);
				  }
				?>			
				<tr>
					<td colspan="3" align="right">Total</td>
					<th align="right">$ <?php echo number_format($total);?></th>
					<td></td>

				</tr>
				<?php
			}

				?>
				</table>
		</div>


	</div>

</body>
</html>