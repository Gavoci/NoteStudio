<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>LoginL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<input type="text" placeholder="username" name="username" >
  	</div>
  	<div class="input-group">
  		<input type="password" placeholder="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		non sei ancora registrato ? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>