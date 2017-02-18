<?php

define('MESSAGE_SESSION_SUFFIX_KEY', '_message_');

/**
 * Session All
 *
 * @return mixed
 */
function session_all()
{
    return $_SESSION;
}

/**
 * Get session data
 *
 * @param  string $key
 * @param  mixed $default
 * @return mixed
 */
function session_get($key, $default = null)
{
    $result = array_get($_SESSION, $key, $default);
    session_remove_flash($key);

    return $result;
}

/**
 * Set session data
 *
 * @todo   support dot separated
 * @param  string $key
 * @param  mixed $value
 * @return mixed
 */
function session_set($key, $value = null)
{
    return $_SESSION[$key] = $value;
}

/**
 * check if has session
 *
 * @param $key
 * @return bool
 * @todo also check from flash session
 */
function session_has($key)
{
    return array_key_exists($key, $_SESSION);
}

/**
 * Save data to session and remove once retrieved.
 *
 * @param  string $key
 * @param  mixed $value
 * @return mixed
 */
function session_flash($key, $value)
{
    if (!session_has('_flash_data')) {
        session_set('_flash_data', []);
    }

    $_SESSION['_flash_data'][$key] = $value;

    session_set($key, $value);

    return $value;
}

/**
 * Remove Session Flash
 *
 * @param  $key
 * @return mixed
 */
function session_remove_flash($key)
{
    if (!session_has('_flash_data')) {
        session_set('_flash_data', []);
    }

    $old = '';
    if (isset($_SESSION['_flash_data'][$key])) {
        $old = $_SESSION['_flash_data'][$key];
        unset($_SESSION['_flash_data'][$key]);
        unset($_SESSION[$key]);
    }

    return $old;
}

/**
 * Session remove
 *
 * @param  string $key
 * @return mixed
 */
function session_remove($key)
{
    $old = session_get($key);
    unset($_SESSION[$key]);
    return $old;
}

/**
 * add messages
 *
 * @param  string $message
 * @param $type
 * @param string $group
 * @return array|mixed
 */
function add_message($message, $type = MESSAGE_SUCCESS, $group = 'default')
{
    $group = MESSAGE_SESSION_SUFFIX_KEY.$group;
    $messages = session_get($group, []);

    if (!is_array($messages)) {
        $messages = [];
    }

    $messages[$type] = $message;

    session_set($group, $messages);

    return $messages;
}

/**
 * get session messages
 *
 * @param  string $group
 * @param  bool $remove - should remove the messages from session
 * @return mixed
 */
function get_messages($group = 'default', $remove = true)
{
    $group = MESSAGE_SESSION_SUFFIX_KEY.$group;
    $messages = session_get($group, []);
    if ($remove) {
        session_remove($group);
    }
    return $messages;
}

/**
 * Render messages
 *
 * @param  string $group
 * @return null|string
 */
function render_messages($group = 'default')
{
    $default_messages = get_messages($group);
    $html = null;
    if (!empty($default_messages)) {
        $html .= '<ul class="list-unstyled message-group-'.$group.'">';
        foreach ($default_messages as $type => $message) {
            $html .= '<li class="alert alert-'.$type.'">'.$message.'</li>';
        }
        $html .= '</ul>';
    }

    return $html;
}

/**
 * Validate token
 *
 */
function before_token()
{
    if (get_session_token() != input_get_token()) {
        throw new TokenMismatchedException('Token Mismatched.');
    }
}


/**
 * get session token
 *
 * @return string
 */
function get_session_token()
{
    return session_id();
}

/**
 * Alias of session commit
 *
 * @return Void
 */
function session_save()
{
    session_commit();
}


