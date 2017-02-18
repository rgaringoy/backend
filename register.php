<?php
require_once __DIR__.'/includes/init.php';

?>
<?php include_once __DIR__.'/partials/header.php' ?>
	<h1>Register</h1>
	<form action="/actions/register.php" method="POST">
		<div class="form-group">
			<label for="exampleInputEmail1">Email address</label>
			<input type="email" class="form-control" id="email" placeholder="Email" name="email">
		</div>
		<div class="form-group">
			<label for="exampleInputPassword1">Password</label>
			<input type="password" class="form-control" id="password" placeholder="Password" name="password">
		</div>
		<div class="form-group">
			<label for="exampleInputPassword1">Confirm Password</label>
			<input type="password" class="form-control" id="confirm_password" placeholder="Password" name="password">
		</div>
		<button type="submit" class="btn btn-default">Submit</button>
		<a class="btn btn-default" href="/login.php">Login</a>
	</form>

<?php include_once __DIR__.'/partials/footer.php' ?>