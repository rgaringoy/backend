<?php namespace Models;


abstract class Base {

	public static $table_name;
	public static $primary_key = 'id';

	/**
	 * Find multiple data by multiple where
	 *
	 * @param  string|array $where
	 * @param  string $additional
	 * @return array
	 */
	public static function find_where($where, $additional=null)
	{
		$where = db_where($where);
		$where_raw = !empty($where) ? "WHERE {$where}" : null;
		$table = static::$table_name;
		$data = db_select("SELECT *FROM `{$table}` {$where_raw} {$additional}");
		return $data;
	}

	/**
	 * Find single data by multiple where
	 *
	 * @param  string|array $where
	 * @param  string $additional
	 * @return bool|array
	 */
	public static function find_where_one($where, $additional=null)
	{
		$where = db_where($where);
		$where_raw = !empty($where) ? "WHERE {$where}" : null;

		$table = static::$table_name;
		
		return db_select_one("SELECT *FROM `{$table}` {$where_raw} {$additional} limit 1");
	}

	/**
	 * Find single data by id
	 *
	 * @param  string $id
	 * @return bool|array
	 */
	public static function find_by_id($id)
	{
		return self::find($id);
	}

	/**
	 * Find single data by Email
	 *
	 * @param  string $email
	 * @return bool|array
	 */
	public static function find_by_email($email)
	{
		return self::find($email, 'email');
	}

	/**
	 * Find single data by Password
	 *
	 * @param  string $password
	 * @return bool|array
	 */
	public static function find_by_password($password)
	{
		return self::find($password, 'password');
	}

	/**
	 * Find single data by id
	 *
	 * @param  string $id
	 * @param  string $key
	 * @return array|bool
	 */
	public static function find($id, $key = null)
	{
		$col_key = !empty($key) ? $key : static::$primary_key;
		return self::find_where_one([
			$col_key => mres($id)
		]);
	}

	/**
	 * Create data
	 *
	 * @param  $data
	 * @return mixed
	 */
	public static function create($data)
	{
		db_insert(static::$table_name, $data);

		return self::find_where_one([
			self::get_primary_key() => db_last_id()
		]);
	}

	/**
	 * Update data
	 *
	 * @param  array $data
	 * @param  string|array $where
	 * @return mixed
	 */
	public static function update($data, $where)
	{
		$old = self::find_where($where);
		db_update(static::$table_name, $data, $where);

		return $old;
	}

	/**
	 * Delete data
	 *
	 * @param  string|array $where
	 * @return mixed
	 */
	public static function delete($where)
	{
		$found = self::find_where($where);
		db_delete(self::getTableName(), $where);

		return $found;
	}

	/**
	 * Get table name
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return static::$table_name;
	}

	/**
	 * Get table id
	 *
	 * @return string
	 */
	public static function get_primary_key()
	{
		return static::$primary_key;
	}

	/**
	 * Select all data from a table
	 *
	 * @param  string $additional
	 * @return self
	 */
	public static function all($additional = null)
	{
		$table_name = static::$table_name;
		$data = db_select("SELECT * FROM {$table_name} {$additional}");
		return $data;
	}
}