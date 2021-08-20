<?php
error_reporting(0); 
?> 

<?php

  $msg = ""; 

  if (isset($_POST['submitImage'])) { 

  
    $food_name=$_POST["fooditem"];
    $food_image=$_FILES["food-image"];
    $food_price=$_POST["price"];

    $filename = $_FILES["food-image"]["name"]; 

    $tempname = $_FILES["food-image"]["tmp_name"];     

        $folder = "assets/".$filename; 

    $file_type= substr($original_file_name, strpos(
    $original_file_name, '.'),strlen($original_file_name));

    $new_file_name=time().$file_type;

          

    $db = mysqli_connect("localhost", "root", "", "food_system");
        $sql = "INSERT INTO `fooditem`(`Name`,`Image_Orig_Name`, `Image_Path_Name`, `UnitPrice`)VALUES ('$food_name', '$filename','$new_file_name','$food_price')";

        mysqli_query($db, $sql); 

        if (move_uploaded_file($tempname, $folder))  { 

            $msg = "Image uploaded successfully"; 

        }else{ 

            $msg = "Failed to upload image"; 

      } 

  } 

  $result = mysqli_query($db, "SELECT * FROM fooditem"); 
?> 

<!DOCTYPE html>
<html>
<head>
  <title>Upload Image</title>
  <link rel="stylesheet" type="text/css" href="upload.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
</head>
<body>
  <form action="" method="POST" enctype="multipart/form-data">

  <div class="form_item">

    <label for="fooditem">Food Name</label>
    <input type="text"  name="fooditem" class="form-input" required="true" placeholder="Enter food name" id="fooditem"><br><br>

    <label for="foodimage">Food Image</label>
    <input type="file" name="food-image" required="true" id="foodimage"><br><br>

    <label for="foodprice">Food Price</label>
    <input type="number"  name="price" class="form-input" id="foodprice" required="true"><br><br>
  </div>

    <input type="submit" class="sub" name="submitImage" value="SAVE">

  </form>

</body>
</html>