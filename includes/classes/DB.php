<?php namespace Classes;

use Exception;
use mysqli;

class DB
{
	static protected $connection;

	/**
	 * Connect to database
	 *
	 * @param  $param - array
	 * @return mysqli
	 * @throws Exception
	 */
	public static function connect($param)
	{
		$options = array_merge(array(
			'host' => null,
			'user' => null,
			'pass' => null,
			'port' => null,
			'db_name' => null,
		), $param);


		$connection = mysqli_connect($options['host'], $options['user'], $options['pass'], $options['db_name'],
			$options['port']);

		if (!$connection) {
			throw new Exception (mysqli_error($connection));
		}

		mysqli_query($connection, "SET CHARACTER SET utf8");

		self::$connection = $connection;

		return $connection;
	}

	/**
	 * Get database connection
	 *
	 * @return mysqli
	 */
	public static function get_connection()
	{
		return self::$connection;
	}


}