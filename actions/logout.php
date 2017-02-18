<?php

require_once __DIR__.'/../includes/init.php';

\Classes\Auth::logout();

add_message('Successfully Logged Out', MESSAGE_SUCCESS);
redirect("/login.php");