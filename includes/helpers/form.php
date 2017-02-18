<?php

function form_input_token()
{
    return '<input type="hidden" name="_token" value="'.e(get_session_token()).'"/>';
}

/**
 * This will just echo select attribute in html element if two given
 *
 * @param  string $value1 - the dynamic value (usually from the database)/ or the value that should be selected
 * @param  string $value2 - the select or radio actual value
 * @param  string|bool $old_input - If old input is specified
 * @return null|string
 */
function is_selected($value1,$value2,$old_input = false)
{
    // Override value 1
    if ( ! empty($old_input) || $old_input != "") {
        $value1 = $old_input;
    }

    if( $value1 == $value2) {
        return 'selected="selected"';
    } else {
        return NULL;
    }
}

/**
 * Return disabled word if two specified value is equal
 *
 * @param  bool $val1
 * @return string
 */
function is_disabled($val1 = false)
{
    return $val1 ? " disabled " : "";
}

/**
 * @param  string $value1 - Array|String
 * @param  string $value2 - String
 * @param  bool $old_input - Array|String
 * @return null|string
 */
function is_checked($value1, $value2, $old_input = false)
{
    // Override value 1
    if ( ! empty($old_input) || $old_input != "") {
        $value1 = $old_input;
    }
    $checked = ' checked="checked" ';

    if ( ! is_array($value1)) {
        // We need to be string here. We need to convert all the types (except object and array)
        // to string, so we can make sure that we are doing a real condition.
        $value1 = (string) $value1;
        $value2 = (string) $value2;

        return  ($value1 === $value2) ? $checked : NULL;
    }
    else {
        return in_array($value2,$value1) ? $checked : NULL;
    }

}
