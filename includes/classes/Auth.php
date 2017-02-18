<?php namespace Classes;

use Models\User;

class Auth {

	const AUTH_SESSION_USER_ID = "_auth_session_user_id";

	protected $options = [
		'only_active_user'	    => true,
		'max_attempt'	        => 10,
		'max_attempt_period'    => 1, // hour
	];

	protected $error_messages = [];

	/**
	 * Auth constructor.
	 *
	 * @param  array $options
	 */
	function __construct($options = array())
	{
		$this->options = array_merge($this->options, $options);
	}

	/**
	 * Attempt to log in user
	 *
	 * @param  $email - user email
	 * @param  $password - user password
	 * @return array - user information array
	 */
	public function attempt($email, $password)
	{
		// do stuff here!
		$user = User::find_by_email($email);
		$user_pass = User::find_by_password($password);

		if ($user && $user_pass) {
			// do stuff here!
			return $this->AUTH_SESSION_USER_ID;
		}

		$this->add_error_message('User not found.'); // remove me
	}

	/**
	 * Return true if log in attempt fails
	 *
	 * @return bool
	 */
	public function fails()
	{
		$errors = $this->get_error_messages();

		return !empty($errors);
	}

	/**
	 * Check if any user is log in. If found any, then return user id
	 *
	 * @return string
	 */
	public static function check()
	{
		return session_get(self::AUTH_SESSION_USER_ID, false);
	}

	/**
	 * Check if any user is log in. If found any, then return user id
	 *
	 * @return string
	 */
	public static function logout()
	{
		return session_remove(self::AUTH_SESSION_USER_ID);
	}

	/**
	 * Set user ID
	 *
	 * @param  string $user_id
	 * @return $this
	 */
	public function login($user_id)
	{
		session_set(self::AUTH_SESSION_USER_ID, $user_id);

		return $this;
	}

	/**
	 * Return all errors
	 *
	 * @return array - error messages
	 */
	public function get_error_messages()
	{
		return $this->error_messages;
	}

	/**
	 * Add error message
	 *
	 * @param  string $message
	 * @return $this
	 */
	public function add_error_message($message)
	{
		$this->error_messages[] = $message;

		return $this;
	}

	/**
	 * Add error message
	 *
	 * @return string
	 */
	public function get_error_message_first()
	{
		$messages = $this->get_error_messages();

		return !empty($messages) ? $messages[0] : null;
	}

}