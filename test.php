<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="styletest.css">

    <!-- Bootstrap CSS -->
   <link rel="stylesheet"  href="css/bootstrap.min.css">

    <title>Login</title>
  </head>
  <body>

  	<?php include_once 'connect.php'; ?>
  	<?php

	if(isset($_SESSION['message'])):?>
		<div class="alert alert-<?=$_SESSION["msg_type"]?>">

			<?php
				echo $_SESSION["message"];
				unset($_SESSION["message"]);

			?>
		</div>
	<?php endif ?>	

    <div class="container">
    	<div class="login-box">
    	<div class="row">
    		<div class="col-md-6 login-left">
    			<h2>Login</h2>
    			<form action="connect.php" method="post">

    			<div class="form-group">
				<input type="text" placeholder="User Name" name="user"  class="form-control" required>
				
				</div>

				<div class="form-group">
					<input type="password" placeholder="Enter password" name="password" id="myInput"   class="form-control" required>
					<input type="checkbox"   
					onclick="myFunction()">

					<script>
						
						function myFunction(){
							var x=
							document.getElementById("myInput");
							if(x.type ==="password")
							{
								x.type="text";
							}
							else
							{
								x.type="password";
							}
						}
					</script>
				</div>

				<div class="form-group lead">
				<label for="usertype">I'm a :</label>
				<input type="radio"  name="usertype"  value="client" class="custom-radio" required>&nbsp;Client |
				<input type="radio"  name="usertype"  value="admin" class="custom-radio" required>&nbsp;Admin 
				
				</div>
				<button type="submit" name="login" class="btn btn-primary">Login</button>
    			</form>

    		</div>	



    			<div class="col-md-6 login-right">
    			<h2>Register Here</h2>
    			<form action="connect.php" method="post">

    				<input type="hidden" name="id" value="<?php echo $id; ?>">

    			<div class="form-group">
					<label for="user_name">User Name</label>
					<input type="text" name="fname" value="<?php echo $name;?>"class="form-control" required>

				</div>
				
				<div class="form-group">
					
					<label for="password">Password</label>
					<input type="password" name="pword" id="myInputs" value="<?php echo $password;?>" class="form-control" required>
					<input type="checkbox"   
					onclick="myFunctions()">

					<script>
						
						function myFunctions(){
							var x=
							document.getElementById("myInputs");
							if(x.type ==="password")
							{
								x.type="text";
							}
							else
							{
								x.type="password";
							}
						}
					</script>
				</div>
				<div class="form-group">
				<label for="usertype">Select :</label>
				<input type="radio"  name="usertype"  value="client" class="custom-radio" required>&nbsp;Client |
				<input type="radio"  name="usertype"  value="admin" class="custom-radio" required>&nbsp;Admin 
				</div>

				<?php
				if($update==true):
				?>

				<button type="submit" name="update" class="btn btn-info">Update</button>
				<?php else: ?>
				
				<button type="submit" name="register" class="btn btn-primary">Register</button>
    			
    			<?php endif;?>	
    			</form>






    		</div>


    	</div>



    	</div>
    </div>

    


    

    

    	
  	<?php
  		$mysqli= new mysqli('localhost','root','','user_registration') or die(mysqli_error($mysqli));
  		$result = mysqli_query($con,"SELECT * FROM user_details");
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
    
    
  </body>
</html>