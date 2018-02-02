<?php

	include 'action.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>CRUD PROJECT</title>
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
    	.jumbotron{
    		padding: 25px;
    		background-color: #222222;
    		color: #fff;
    		padding-top: 15px;
    	}
    </style>
    
  </head>
  <body>
  <div class="jumbotron text-center">
    <h2>BASIC CRUD OPERATION USING PHP & MySQLi</h2>
  </div>

    <div class="container">
    	<div class="row">
    	<div class="col-md-2"></div>
    	<div class="col-md-8">
    		<div class="panel panel-success">
    			<div class="panel-heading" style="text-align: center;">Enter Student Details</div>
    			<div class="panel-body">
    			<?php 
    				if(isset($_GET["update"])){
    					$id = $_GET["id"] ?? null;
    					$where = array ("id" =>$id);
    					$row = $obj->select_record("students",$where);
    					?>
	    				<form method="POST" action="action.php">
	    				<table class="table table-hover table-strippped table-responsive">
	    					<tr>
		    					
		    					<td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
		    				</tr>
		    				<tr>
		    					<td>UserName</td>
		    					<td><input type="text" name="UserName"  value = "<?php echo $row['UserName'];?>" class="form-control" placeholder="Enter Username"></td>
		    				</tr>
		    				<tr>
		    					<td>Email Address</td>
		    					<td><input type="text" name="email" value = "<?php echo $row['email'];?>" class="form-control" placeholder="Email Address"></td>
		    				</tr>
		    				<tr>
		    					
		    					<td colspan="2"><input type="submit" 
		    					class="btn btn-success" name="Edit" value="Update Student"></td>
		    				</tr>
	    				</table>
	    				</form>
    					<?php 
    				}
    				else{

    					?>	
    					<form method="POST" action="action.php">
    				<table class="table table-hover table-strippped table-responsive">
	    				<tr>
	    					<td>UserName</td>
	    					<td><input type="text" name="UserName" class="form-control" placeholder="Enter Username"></td>
	    				</tr>
	    				<tr>
	    					<td>Email Address</td>
	    					<td><input type="text" name="email" class="form-control" placeholder="Enter Email Address"></td>
	    				</tr>
	    				<tr>
	    					
	    					<td colspan="2"><input type="submit" class="btn btn-success" name="submit" value="Add Student"></td>
	    				</tr>
    				</table>
    				</form>


    					<?php  
    				}
    				?>
    			</div>
    		</div>
    	</div>
    	<div class="col-md-2"></div>	
    	</div>
    </div>
    
    <div class="container">
    	<h2 class="text-center" style="background-color: #000;color: #fff;width:300px;padding: 10px;text-align: center;margin-left: 420px;margin-bottom: 50px;border-radius: 10px;">USER LIST</h2>
    	<div class="row">
    		<div class="col-md-2"></div>
    		<div class="col-md-8">
	    		<table class="table table-hover table-strippped table-responsive">
	    			<tr>
	    				<th>User ID</th>
	    				<th>UserName</th>
	    				<th>Email Address</th>
	    				<th>&nbsp;</th>
	    				<th>&nbsp;</th>
	    			</tr>
	    			<?php
	    			$myrow = $obj->fetch_record("students");
	    			foreach ($myrow as $row ) {
	    				?>
	    					<tr>
			    				<td><?php echo $row["id"];?></td>
			    				<td><?php echo $row["UserName"];?></td>
			    				<td><b><?php echo $row["email"];?></b></td>
			    				<td><a href="index.php?update=1&id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a></td>
			    				<td><a href="action.php?delete=1&id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
			    			</tr>
	    				<?php
	    			 	}

	    			?>
	    			
	    		</table>
    		</div>
    		<div class="col-md-2"></div>
    	</div>
    </div>

    <!-- jQuery library -->
    <script src="js/jquery.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>