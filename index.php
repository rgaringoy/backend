<?php
require_once __DIR__.'/includes/init.php';

if (!\Classes\Auth::check()) {
	redirect('/login.php');
}

?><?php include_once __DIR__.'/partials/header.php' ?>
<?php include_once __DIR__.'/partials/footer.php' ?>