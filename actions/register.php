<?php

require_once __DIR__.'/../includes/init.php';

// should be valid post
if (!isset($_POST)) return ;

$email = input_get('email');
$password = input_get('password');

if (empty($email) || empty($password)) {
	add_message('Email or password must not be empty.', MESSAGE_WARNING);
	redirect("/register.php");
}

\Models\User::create([
	'email' => $email,
	'password' => md5($password),
	'confirmed' => 1,
	'confirmation_code' => str_shuffle(md5(str_shuffle(input_get('email').rand(1,9999)))),
]);

add_message('Successfully added User', MESSAGE_SUCCESS);

redirect("/register.php");

