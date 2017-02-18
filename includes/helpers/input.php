<?php

/**
 * Returns all input
 *
 * @return array
 */
function input_all()
{
    return $_REQUEST;
}

/**
 * Get input data in dot separated
 *
 * @param  $key
 * @param  mixed $default
 * @return mixed
 */
function input_get($key, $default = null)
{
    return array_get($_REQUEST, $key, $default);
}

/**
 * Get all posts
 *
 * @return array
 */
function input_post_all()
{
    return $_POST;
}

/**
 * Get input post
 *
 * @param  string $key
 * @param  string|null $default
 * @return mixed
 */
function input_post($key, $default = null)
{
    return array_get(isset($_POST) ? $_POST : [], $key, $default);
}

/**
 * Get input post
 *
 * @param  string $key
 * @return mixed
 */
function input_post_has($key)
{
    return array_key_exists($key, isset($_POST) ? $_POST : []);
}

/**
 * If has an input
 *
 * @todo   support dot separated array
 * @param  string $key
 * @return bool
 */
function input_has($key)
{
    return array_key_exists($key, $_REQUEST);
}

/**
 * if input is get
 *
 * @return bool
 */
function input_is_get()
{
    return isset($_GET);
}

/**
 * if input is post
 *
 * @return bool
 */
function input_is_post()
{
    return isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST';
}

/**
 * Get request action
 *
 * @return mixed
 */
function input_get_action()
{
    return input_get('_action');
}

/**
 * Create hidden input action
 *
 * @param  string $action_name
 * @return string
 */
function input_create_action($action_name)
{
	return input_hidden('_action', $action_name);
}

/**
 * Set old inputs
 *
 * @param  array $except
 * @param  array $inputs
 * @return void
 */
function set_old_inputs($except = array(), $inputs = array())
{
    if (!is_array($inputs)) return ;

    $inputs = !empty($inputs) ? $inputs : input_post_all();

    foreach ($except as $name) unset($inputs[$name]);

    if (is_array($inputs)) {
		session_flash('_old_input', $inputs);
    }
}

/**
 * Get old input
 *
 * @param  string $name
 * @param  string|null $default
 * @return mixed
 */
function get_old_input($name=null, $default = null)
{
	if (!get_global('_old_input', false)) {
		set_global('_old_input', session_get('_old_input', []));
	}
	// if name is null, that means get all old input
	if (is_null($name)) {
		return get_global('_old_input', []);
	}

    return array_get(get_global('_old_input', []), $name, $default);
}

/**
 * Get the submitted token
 *
 * @return mixed
 */
function input_get_token()
{
    return input_get('_token');
}

/**
 * Create an input token
 *
 * @return string
 */
function input_create_input_token()
{
	return input_hidden('_token', get_session_token());
}

/**
 * Create input hidden
 *
 * @param  string $name
 * @param  string $value
 * @return string
 */
function input_hidden($name, $value)
{
	return '<input type="hidden" name="'.e($name).'" value="'.e($value).'">';
}
