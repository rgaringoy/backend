<?php
require_once __DIR__.'/includes/init.php';

if (!\Classes\Auth::check()) {
	redirect('/login.php');
}

?>

<?php include_once __DIR__.'/partials/header.php' ?>

<h1>This is your dashboard.
<a href="/actions/logout.php">Logout</a>
</h1>

<?php include_once __DIR__.'/partials/footer.php' ?>