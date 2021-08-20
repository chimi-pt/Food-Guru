<?php
	session_start();
	
	$server="localhost";
	$username="root";
	$password="";
	$database="product_details";

	$con=mysqli_connect($server,$username,$password,$database);

	if (isset($_POST["add"])) {
		if (isset($_SESSION["cart"])) {
		

			$item_array_id=array_column($_SESSION["cart"],"product_id");
			if (!in_array($_GET["id"], $item_array_id)) {

				$count=count($_SESSION["cart"]);
				$item_array=array(

					'product_id'=> $_GET["id"],
					'item_name'=> $_POST["hidden_name"],
					'product_price'=> $_POST["hidden_price"],
					'item_quantity'=> $_POST["quantity"],
				);

				$_SESSION["cart"][$count]=$item_array;
				echo '<script>window.location="cart.php"</script>';
			}else{
				$_SESSION['message']="Product has already been added";
				$_SESSION['msg_type']="danger";

				header('location:cart.php');

				# code...
			}
		}else{

			$item_array=array(
				'product_id'=> $_GET["id"],
					'item_name'=> $_POST["hidden_name"],
					'product_price'=> $_POST["hidden_price"],
					'item_quantity'=> $_POST["quantity"],
				);
			$_SESSION["cart"][0]=$item_array;
			# code...
		}
	}
if (isset($_GET["action"])) {

	if ($_GET["action"]=="delete") {
		foreach ($_SESSION["cart"] as $keys => $value) {
			if ($value["product_id"]==$_GET["id"]) {
				unset($_SESSION["cart"][$keys]);
				$_SESSION['message']="Product has been removed";
				$_SESSION['msg_type']="danger";

				header('location:cart.php');
				# code...
			}
			# code...
		}
		# code...
	}
		# code...
	}	

?>