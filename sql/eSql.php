<?php
/**
*  导入sql全局账号密码
*/
include_once 'sql.php';
$sql_db = new sql_db();
$host = $sql_db->host;
$user = $sql_db->user;
$pwd = $sql_db->pwd;
$db = $sql_db->db;
/**
*  封装的一些常用sql方法
*/
class eSql 
{
	/**
	*  查询单条数据
	*/
	function sqlSelect($tableName,$id){
		$con_link = mysql_connect($GLOBALS['host'],$GLOBALS['user'],$GLOBALS['pwd']);
		mysql_query('set names utf8'); 
		mysql_select_db($GLOBALS['db']); 
		if($id != '')
			$sql = "select * from $tableName where id=$id";
		else
			$sql = "select * from $tableName";
		$result = mysql_query($sql,$con_link); 
		return mysql_fetch_assoc($result);
	}
	/**
	*  查询数据条数，可选指定一个字段
	*/
	function sqlNum($tableName,$option,$val){
		$con_link = mysql_connect($GLOBALS['host'],$GLOBALS['user'],$GLOBALS['pwd']);
		mysql_query('set names utf8'); 
		mysql_select_db($GLOBALS['db']); 
		if($option != '')
			$sql = "select * from $tableName where `".$option."` = '$val'";
		else
			$sql = "select * from $tableName";
		$result = mysql_query($sql,$con_link); 
		$num = mysql_num_rows($result);
		return $num;
		
	}
	/**
	*  差选单条数据，可选，指定一个字段条件
	*/
	function sqlSelect2($tableName,$option,$val){
		$con_link = mysql_connect($GLOBALS['host'],$GLOBALS['user'],$GLOBALS['pwd']);
		mysql_query('set names utf8'); 
		mysql_select_db($GLOBALS['db']); 
		if($option != '')
			$sql = "select * from $tableName where `".$option."` = '$val'";
		else
			$sql = "select * from $tableName";
		$result = mysql_query($sql,$con_link); 
		return mysql_fetch_assoc($result);
	}
	/**
	*  更新单条数据，需指定id，更新字段，更新的内容
	*/
	function sqlUpdate($tableName,$option,$val,$id){
		$con_link = mysql_connect($GLOBALS['host'],$GLOBALS['user'],$GLOBALS['pwd']);
		mysql_query('set names utf8'); 
		mysql_select_db($GLOBALS['db']); 
		$sql = "UPDATE  `$tableName` SET  `$option` =  '$val' WHERE  `id` =$id;";
		$result = mysql_query($sql,$con_link); 
		return $result;
	}
}
?>
