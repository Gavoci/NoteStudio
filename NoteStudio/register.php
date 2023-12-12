<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registrazione</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <input type="text" name="username" placeholder="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <input type="email" name="email" placeholder="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <input type="password" placeholder="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <input type="password" placeholder="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		sei gia registrato? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>