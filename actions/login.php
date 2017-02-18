<?php

require_once __DIR__.'/../includes/init.php';

// should be valid post
if (!isset($_POST)) return ;

$auth = new \Classes\Auth();
$auth->attempt(input_get('email'), input_get('password'));

if ($auth->fails()) {
	add_message($auth->get_error_message_first(), MESSAGE_ERROR);

	redirect("/login.php");
} 

if ($auth->success()) {
	redirect("/dashboard.php");
}


