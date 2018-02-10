<?php
require_once 'sql.php';
$sql_db = new sql_db();
$mysql_host = $sql_db->host;
$mysql_user = $sql_db->user;
$mysql_pwd = $sql_db->pwd;
$mysql_db = $sql_db->db;
// 新增操作(字段必须齐全除自增id)
function insert($tableName, $columnArray) {
    $con = mysql_connect($GLOBALS["mysql_host"], $GLOBALS["mysql_user"], $GLOBALS["mysql_pwd"]);
    mysql_query("set names 'utf8' ");
    mysql_query("set character_set_client=utf8");
    mysql_query("set character_set_results=utf8");
    if (!$con) {
        return '连接错误';
    } else {
        mysql_select_db($GLOBALS["mysql_db"], $con);
        $keys = array_keys($columnArray);
        $values = array_values($columnArray);
        $strk = implode(",", $keys);
        $strv = implode("','", $values);
        $sql = "INSERT INTO $tableName ($strk) VALUES ('$strv')";
        echo $sql;
        $flag = mysql_query($sql, $con);
        mysql_close($con);
        if ($flag) {
            return true;
        } else {
            return false;
        } 
    } 
} 

// 更新操作(字段可以不齐全)
function update($tableName, $columnArray, $id) {
    $con = mysql_connect($GLOBALS["mysql_host"], $GLOBALS["mysql_user"], $GLOBALS["mysql_pwd"]);
    mysql_query("set names 'utf8' ");
    mysql_query("set character_set_client=utf8");
    mysql_query("set character_set_results=utf8");
    if (!$con) {
        return '连接错误';
    } else {
        mysql_select_db($GLOBALS["mysql_db"], $con);
        reset($columnArray);
        $sets = array();
        while (list($key, $value) = each($columnArray)) {
            array_push($sets, "$key='$value'");
        } 
        $str = implode(",", $sets);
        $sql = "UPDATE $tableName SET $str WHERE id='" . mysql_real_escape_string($id) . "'";
        echo $sql;
        $flag = mysql_query($sql, $con);
        mysql_close($con);
        if ($flag) {
            return true;
        } else {
            return false;
        } 
    } 
} 

// 删除操作
function remove($tableName, $id) {
    $con = mysql_connect($GLOBALS["mysql_host"], $GLOBALS["mysql_user"], $GLOBALS["mysql_pwd"]);
    mysql_query("set names 'utf8' ");
    mysql_query("set character_set_client=utf8");
    mysql_query("set character_set_results=utf8");
    if (!$con) {
        return '连接错误';
    } else {
        mysql_select_db($GLOBALS["mysql_db"], $con);
        $sql = "DELETE FROM $tableName WHERE id='" . mysql_real_escape_string($id) . "'";
        echo $sql;
        $flag = mysql_query($sql, $con);
        mysql_close($con);
        if ($flag) {
            return true;
        } else {
            return false;
        } 
    } 
} 

// 单条查询操作(字段可以不齐全)
// 表名  array("字段名" => "","字段命" => "")   id
//return 数组
function select($tableName, $columnArray, $id) {
    $con = mysql_connect($GLOBALS["mysql_host"], $GLOBALS["mysql_user"], $GLOBALS["mysql_pwd"]);
    mysql_query("set names 'utf8' ");
    mysql_query("set character_set_client=utf8");
    mysql_query("set character_set_results=utf8");
    if (!$con) {
        return '连接错误';
    } else {
        mysql_select_db($GLOBALS["mysql_db"], $con);
        $keys = array_keys($columnArray);
        $str = implode(",", $keys);
        $sql = "SELECT $str FROM $tableName where id='" . mysql_real_escape_string($id) . "'";
        $result = mysql_query($sql, $con);
        $values = array();
        $row = mysql_fetch_object($result);
        mysql_close($con);
        foreach ($keys as $key) {
            array_push($values, $row -> $key);
        } 
        return array_combine($keys, $values);
    } 
} 

// 复杂查询操作(带分页,条件,排序,字段可以不齐全)#传$paramSql进来的时候记得先用mysql_real_escape_string过滤一下
function search($tableName, $currentPage, $pageSize, $order, $sort, $columnArray, $paramSql) {
    $con = mysql_connect($GLOBALS["mysql_host"], $GLOBALS["mysql_user"], $GLOBALS["mysql_pwd"]);
    mysql_query("set names 'utf8' ");
    mysql_query("set character_set_client=utf8");
    mysql_query("set character_set_results=utf8");
    if (!$con) {
        return '连接错误';
    } else {
        $orderSql = "";
        if ($order && $sort) {
            $orderSql = "order by $order $sort";
        } 
        $limitSql="";
        if($currentPage && $pageSize){
            $limitSql="limit " . ($currentPage-1) * $pageSize . ",$pageSize";
        }
        mysql_select_db($GLOBALS["mysql_db"], $con);
        $keys = array_keys($columnArray);
        $str = implode(",", $keys);
        $sql = "SELECT $str FROM $tableName $paramSql $orderSql $limitSql";
        $result = mysql_query($sql, $con);
        mysql_close($con);
        $allresult = array();
        while ($row = mysql_fetch_object($result)) {
            $values = array();
            foreach ($keys as $key) {
                array_push($values, $row -> $key);
            } 
            $obj = array_combine($keys, $values);
            array_push($allresult, $obj);
        } 
        return $allresult;
    } 
} 
?>