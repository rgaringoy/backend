<?php
use Classes\DB;

/**
 * This is short for mysql query
 *
 * @param $query
 * @return bool|mysqli_result
 * @throws Exception
 */
function db_query($query)
{
    $ret = mysqli_query(DB::get_connection(), $query, MYSQLI_STORE_RESULT);
    if (!$ret) {
        throw new Exception (mysqli_error(DB::get_connection()));
    }

    return $ret;
}

/**
 * Short for mysql query but return an array of results
 *
 * @param  string $query
 * @return array
 */
function db_select($query)
{
    // run query adn return query.
    $results = db_query($query);
    $ret = array();

    if ($results) {
        while($fetched = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
            $ret[] =  $fetched;
        }
    }

    return $ret;
}

/**
 * Insert Data
 *
 * @param $table
 * @param array $data
 * @return resource
 */
function db_insert($table, array $data) {
    // retrieve the keys of the array (column titles)
    $fields = array_keys($data);

    // clean strings
    foreach ($data as $key => $value) { $data[$key] = mres($value); }

    // build the query
    $sql = "INSERT INTO ".$table."(`".implode('`,`', $fields)."`) VALUES('".implode("','", $data)."')";

    // run and return the query result resource
    return db_query($sql);
}

/**
 * Quick delete query
 *
 * @param  string $table
 * @param  array $data
 * @param  mixed $where
 * @return bool
 */
function db_update($table, array $data, $where) {// check for optional where clause
    // loop and build the column /
    $sets = array();
    foreach($data as $column => $value) {
        $sets[] = "`{$column}` = \"".mres($value)."\"";
    }

    // build the query
    $sql = "UPDATE ".$table.' SET '. implode(', ', $sets) . ' WHERE '. db_where($where);
    // run and return the query result resource

    return db_query($sql);
}

/**
 * Quick delete query
 *
 * @param  string $table
 * @param  mixed $where
 * @return bool
 */
function db_delete($table, $where) {// check for optional where clause
    // run and return the query result resource
    return db_query("DELETE FROM ".$table.' WHERE '. db_where($where));
}

/**
 * Only supports "and", "or" and "equals"
 *
 * @param  string|array $where
 * @param  bool|true $join_and
 * @return string
 */
function db_where($where, $join_and = true) {
    $where_clause = array();

    if (is_array($where)) {
        foreach ($where as $key => $value) {
            if (is_numeric($key)) {
                $where_clause[] = $value;
            } else {
                if (db_where_key_has_condition($key)) {
                    // if has condition with it?
                    // i.e array('name =' => $var) or array('age >' => $int)
                    $where_clause[] = " {$key} \"".mres($value)."\" ";
                } else {
                    $where_clause[] = " {$key} = \"".mres($value)."\" ";
                }
            }
        }
    } else {
        $where_clause[] = $where;
    }

    return '('.join($join_and ? ' AND ' : ' OR ', $where_clause).')';
}

function db_where_key_has_condition($key)
{
    $acceptable = array(
      '>=',
      '>',
      '<=',
      '<',
      '=',
      'LIKE', // any acceptable?
    );

    preg_match('/\s*\S+\s*$/i', $key, $matches);

    return isset($matches[0]) && in_array(trim($matches[0]),$acceptable);
}

/**
 * short for mysql query but return only a singl row of array
 *
 * @param  string $query
 * @return bool|array
 */
function db_select_one($query) {
    $results = db_select($query);

    return isset($results[0]) ? $results[0] : false;
}

/**
 * get database last id
 *
 * @return int
 */
function db_last_id()
{
    return mysqli_insert_id(DB::get_connection());
}

/**
 * Mysql Real Scape string short
 *
 * @param $string
 * @return array|string
 */
function mres($string) {
    if (is_array($string)) {
        return array_map('mres', $string);
    }

    return mysqli_real_escape_string(DB::get_connection(), $string);
}
