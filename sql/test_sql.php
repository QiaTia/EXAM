<?php
/**
*  导入sql全局账号密码
*/
include 'sql.php';
$sql_db = new sql_db();
$host = $sql_db->host;
$user = $sql_db->user;
$pwd = $sql_db->pwd;
$db = $sql_db->db;
/**
*  
*/
class radio 
{
	function sql_query($id,$tableName){
		$con_link = mysql_connect($GLOBALS['host'],$GLOBALS['user'],$GLOBALS['pwd']);
		mysql_query('set names utf8'); 
		mysql_select_db($GLOBALS['db']); 
		$sql = "select * from $tableName where id=$id";
		$result = mysql_query($sql,$con_link); 
		$info = mysql_fetch_row($result);
		return $info;
	}
	function test($id,$cate){
		return $this->sql_query($id,$cate);
	}
	function radioTest($id){
		return $this->sql_query($id,'radio');
	}
	function checkboxTest($id){
		return $this->sql_query($id,'checkbox');
	}
	function curriculumTest($id){
		return $this->sql_query($id,'curriculum');
	}
	function fillTest($id){
		return $this->sql_query($id,'fill');
	}
	function judgeTest($id){
		return $this->sql_query($id,'judge');
	}
	function saqTest($id){
		return $this->sql_query($id,'saq');
	}
}
?>