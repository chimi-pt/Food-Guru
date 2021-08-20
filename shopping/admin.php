<?php

session_start();

if (!isset($_SESSION['username']) || $_SESSION['role']!="admin" )
{
    header("location:test.php");
}

?>

<?php

  $msg = ""; 
  $server="localhost";
  $username="root";
  $password="";
  $database="productsdb";

  $db=mysqli_connect($server,$username,$password,$database);

  if (isset($_POST['submitImage'])) { 

  
    $food_name=$_POST["fooditem"];
    $file=$_FILES["file"];
    $food_price=$_POST["price"];


    $filename = $_FILES["file"]["name"]; 
    $fileTmpName=$_FILES["file"]["tmp_name"];
    $fileSize=$_FILES["file"]["size"];
    $fileError=$_FILES["file"]["error"];
    $fileType=$_FILES["file"]["type"];

    $fileExt= explode('.', $filename);
    $fileActualExt=strtolower(end($fileExt));
    $allowed=array('jpg','jpeg','png');

    if (in_array($fileActualExt, $allowed)) 
    {
      if ($fileError=== 0)
         {
           if ($fileSize < 10000000) 
              {
                $fileNameNew=uniqid('', true).".".$fileActualExt;

                $folder='uploads/'.$fileNameNew;

                $fileDestination='uploads/'.$fileNameNew;
                if(move_uploaded_file($fileTmpName, $fileDestination))
                {
                   echo "Uploaded Successfully";
                }else
                {
                    echo "Error";
                }

              }
              else
                  {
                    echo "Your file is too big!";
                  }
        }
        else
        {
          echo "There was an error uploading your file!";
        }
    }
    else
    {
      echo "You cannot upload files of this type!";
    }

    

          

    $db = mysqli_connect("localhost", "root", "", "productsdb");
        $sql = "INSERT INTO `producttb`(`product_name`,`product_price`, `product_image`)VALUES ('$food_name','$food_price','$folder')";

        mysqli_query($db, $sql); 

}
  

  $result = mysqli_query($db, "SELECT * FROM productb"); 
?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Food</title>
  <link rel="stylesheet"  href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/styleadmin.css">
  <script src="../js/all.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Mr+Dafoe&display=swap" rel="stylesheet">
  <link rel="stylesheet"  href="../magnific-popup/magnific-popup.css">
</head>
<body>
<div class="container-fluid info p-3" id="top-icons">
    <div class="row">
      <div class="col d-flex justify-content-between align-items-baseline flex-wrap">
        <div class="info-icons p-2">
          <a href="#" class="mr-2 primary-color"><i class="fab fa-facebook fa-2x"></i></a>
          <a href="#" class="mr-2 primary-color"><i class="fab fa-instagram fa-2x"></i></a>
          <a href="#" class="mr-2 primary-color"><i class="fab fa-twitter fa-2x"></i></a>
          <a href="#" class="mr-2 primary-color"><i class="fab fa-yelp  fa-2x"></i></a>
        </div>
        <h2 class="primary-color p-2 text-capitalize" style="font-family: 'Mr Dafoe', cursive;">Kariokor Nairobi</h2>
      </div>
    </div>
  </div>     

  <header id="header">
    <div class="container">
      <div class="row height-90 align-items-center justify-content-center">
        <div class="col">
          <div class="banner text-center">
              <h1 class="display-1 text-capitalize w-50 mx-auto" style="font-family: 'Mr Dafoe', cursive;">
                <small style="color: #ffc107">food</small><strong class="primary-color">Guru</strong>

              </h1>  
              <a href="shopping/index.php" class="btn main-btn guru-btn my-4 text-capitalize" style="font-family: 'Mr Dafoe', cursive; text-decoration: none;">Welcome</a>

          </div>

        </div>
      </div>

    </div>

    <a href="#users" class="btn header-link primay-color"><i class="fas fa-arrow-down"></i></a>
  </header>

<nav class="navbar navbar-expand-lg"> 
<a href="#" class="navbar-brand text-uppercase primary-color" style="font-family: 'Mr Dafoe', cursive;"><?=  $_SESSION ['username'] ?></a>
<button class="navbar-toggler" 
type="button" data-toggle="collapse" data-target="#myNavbar">
        <div class="toggler-btn"> 
            <div class="bar bar1"> </div>
            <div class="bar bar2"> </div>
            <div class="bar bar3"> </div>


         </div>





 </button>


 <div class="collapse navbar-collapse" id="myNavbar"> 
    <ul class="navbar-nav mx-auto"> 
    

        <li class="nav-item"> 
            <a href="#users" class="nav-link text-capitalize">Users</a>
         </li>
         <li class="nav-item">
            <a href="#displaymenu" class="nav-link text-capitalize">UploadImage</a>
           </li>
           <li class="nav-item">
            <a href="#mnn" class="nav-link text-capitalize">Menu</a>
           </li>
           <li class="nav-item">
            <a href="#orders" class="nav-link text-capitalize">Orders</a>
            </li>
           




        </li>





    </ul>

<form action="../logout.php" class="form-inline d-none d-lg-block mr-5">
      <button  class="btn nav-btn text-capitalize " type="submit" style="font-family: 'Mr Dafoe', cursive;"> log out </button>





</form>



 </div>



</nav>


 <section class="users">
   <header class="headers" id="users" >

	<?php
  		$mysqli= new mysqli('localhost','root','','user_registration') or die(mysqli_error($mysqli));
  		$result = mysqli_query($mysqli,"SELECT * FROM user_details");
  		//pre_r($result);
  		//pre_r($result->fetch_assoc());
  		?>

      
    <div class="container">
  		<div class="row justify-content-center">
  			<table class="meza">
  				<thead>
  				<tr>
   				<th>User Name</th>
   				<th>Password</th>
   				<th>User Type</th>
   				<th colspan="2">Action</th>
 				</tr>
				</thead> 

		<?php
		$i=0;
			while($row=$result->fetch_assoc()): ?>
			<tr>
    			<td><?php echo $row["Name"]; ?></td>
    			<td><?php echo $row["password"]; ?></td>
    			<td><?php echo $row["user_type"]; ?></td>
      		  	<td>
     			 <a href="test.php?edit=<?php echo $row['user_id']; ?>" class="btn btn-info">Edit</a>
      			 <a href="connect.php?delete=<?php echo $row['user_id']; ?>" class="btn btn-danger">Delete</a>
     			</td>
    		</tr>
    	<?php endwhile;?>

    		</table>
  		</div>


  		<?php
  		function pre_r($array)
  		{
  			echo "<pre>";
  			print_r($array);
  			echo "</pre>";
  		}

  	?>

    

  </div>
  </header>

      </section>


 <?php
  require_once('php/CreateDb.php');
 require_once('php/component1.php');




 //create instance of CreateDb class
 $database=new CreateDb("Productsdb","Producttb");


 $id=0;
$update=false;

$foodname='';
$foodprice='';



 if(isset($_POST['edit']))
 {
  $id=$_POST['product_id'];
    $update=true;

    $con=mysqli_connect("localhost","root","","productsdb");
    $result = mysqli_query($con,"SELECT * FROM producttb WHERE id=$id")or die ($con->error());

    
      $row=$result->fetch_array();
      $foodname=$row['product_name'];
      $foodprice=$row['product_price'];
      
      # code...
    

    
  }
 if (isset($_POST['update']))
 {
  $id=$_POST['id'];
  $foodname=$_POST['fooditem'];
  $foodprice=$_POST['price'];
 
   $con=mysqli_connect("localhost","root","","productsdb");
  $query="UPDATE  producttb SET product_name='$foodname',product_price='$foodprice' WHERE id=$id";
  mysqli_query($con,$query);

    

  echo "<script>alert('Image Updated')</script>";
    echo "<script>window.location='admin.php'</script>";
}




  if (isset($_POST['remove']))
 {
  
    $value=["product_id"];
      $id=$_POST['product_id'];
        

      
   $con=mysqli_connect("localhost","root","","productsdb");
    $con->query("DELETE FROM producttb WHERE id=$id")or die ($con->error());
    echo "<script>alert('Image Deleted')</script>";
    echo "<script>window.location='admin.php'</script>";
     
    
  
}


?>


<section  id="displaymenu">
  <h2>.</h2>
  <div class="login-box boxy">
   <div class="card text-center">
            <div class="card-header">
              <h1 class="text-uppercase">upload image</h1>


            </div>
            <div class="card-body">
             <form action="" method="POST" enctype="multipart/form-data">


      <input type="hidden" name="id" value="<?php echo $id; ?>" class="form-control form-control-lg">
               


                <div class="input-group my-3">
                  

                  <input type="text"  name="fooditem" class="form-control form-control-lg" value="<?php echo $foodname; ?>"   required="true" placeholder="Enter food name" id="fooditem" class="form-control">

                </div>





                <div class="input-group my-3">
                  <?php
                     if($update==true):
                  ?>

                  <?php else: ?>  
                  <input type="file" name="file" class=" form-control-lg" required="true" id="foodimage" >
                  <?php endif;?> 

                </div>

               




                <div class="input-group my-3">

                   <input type="number"  name="price" class="form-control form-control-lg" value="<?php echo $foodprice; ?>" id="foodprice" class="form-control" placeholder="Enter Price" required="true">

                </div>

                 <?php
        if($update==true):
        ?>
            <button type="submit" name="update"class="btn btn-block btn-lg text-uppercase contact-btn"><i class="far fa-hand-point-right mr-2"></i>update</button>

              <?php else: ?>  
            <button type="submit" name="submitImage" class="btn btn-block btn-lg text-uppercase contact-btn"><i class="far fa-hand-point-right mr-2"></i>Upload</button>
             <?php endif;?>  




              </form>

            </div>


          </div>
        </div>



    </div>

 



<div class="container">
  <div>
      <h2 class="title-text" id="mnnn">Menu</h2>
    </div>
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











    
  </section>


  <section id="orders">
  	




  </section>

  <section id="orders">
  	<?php
  		$mysqli= new mysqli('localhost','root','','productsdb') or die(mysqli_error($mysqli));
  		$result = mysqli_query($mysqli,"SELECT * FROM orders");
  		//pre_r($result);
  		//pre_r($result->fetch_assoc());
  		?>

      
    <div class="container">
  		<div class="row justify-content-center">
  			<table class="meza">
  				<thead>
          <tr>
          <th>User Name</th>
          <th>Product Name</th>
          <th>Product Price</th>
          <th>Total</th>
          
          
        </tr>
        </thead> 

		<?php
		$i=0;
			while($row=$result->fetch_assoc()): ?>
			 <tr>
          <td class="text-capitalize primary-color" style="font-family: 'Mr Dafoe', cursive;font-size: 30px;"><?php echo $row["UserName"]; ?></td>
          <td><?php echo $row["ProductName"]; ?></td>
          <td><?php echo $row["ProductPrice"]; ?></td>
          <td><?php echo $row["Total"]; ?></td>
         
             
        </tr>
    	<?php endwhile;?>

    		</table>
  		</div>


  		

    

  </div>




  </section>






<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/jquery.ripples-min.js"></script>
<script src="../magnific-popup/jquery.magnific-popup.js"></script>
<script src="../js/script.js"></script>
</body>
</html>