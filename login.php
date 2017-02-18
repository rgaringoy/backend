<?php
require_once __DIR__.'/includes/init.php';

if (\Classes\Auth::check()) {
	redirect('/dashboard.php');
}

?>
<?php include_once __DIR__.'/partials/header.php' ?>
	<h1>Log in</h1>
	<form action="/actions/login.php" method="POST">
		<div class="form-group">
			<label for="exampleInputEmail1">Email address</label>
			<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email">
		</div>
		<div class="form-group">
			<label for="exampleInputPassword1">Password</label>
			<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
		</div>
		<button type="submit" class="btn btn-default">Submit</button>
	</form>
	<a class="btn btn-default" href="/register.php">Register</a>
<?php include_once __DIR__.'/partials/footer.php' ?>