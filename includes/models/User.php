<?php namespace Models;

class User extends Base{

	const STATUS_ACTIVE = 'active';
	const STATUS_INACTIVE = 'inactive';

	public static $table_name = 'users';
	public static $primary_key = 'id';

}