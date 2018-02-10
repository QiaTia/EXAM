<?php 
require_once "../sql/eSql.php";
if(main('curriculum')) 
	echo "string";
/*
*  给与必要参数,遍历操作
*/
function testIdEach($tableName,$search){
	$testIdEach = null;
	$con_link = mysql_connect($GLOBALS['host'],$GLOBALS['user'],$GLOBALS['pwd']);
	mysql_query('set names utf8'); 
	mysql_select_db($GLOBALS['db']); 
	$sql="select * from `$tableName` where `class` = '$search'";
	$con=mysql_query($sql,$con_link); 
	while ($info = mysql_fetch_assoc($con)) {
		# code...
		$testIdEach = $testIdEach.$info['id'].',';
	}
	if(!$con) die ($sql.'失败'); 
	return $testIdEach;
}
/*
*  给与必要参数,更新操作
*/
function testIdUpDate($tableName,$id,$field,$val){
	$con_link = mysql_connect($GLOBALS['host'],$GLOBALS['user'],$GLOBALS['pwd']);
	mysql_query('set names utf8'); 
	mysql_select_db($GLOBALS['db']); 
	$sql="UPDATE `$tableName` SET  `$field` =  '$val' WHERE `id` =$id;";
	$con=mysql_query($sql,$con_link); 
	if(!$con) die ($sql.'失败'); 
	return 1;
}
/*
*  给与必要参数,返回数据
*/
function main($tableName){
	$con_link = mysql_connect($GLOBALS['host'],$GLOBALS['user'],$GLOBALS['pwd']);
	mysql_query('set names utf8'); 
	mysql_select_db($GLOBALS['db']); 
	$sql="SELECT *FROM  `$tableName`";
	$con=mysql_query($sql,$con_link); 
	while($info = mysql_fetch_assoc($con)){
		$field = array('radio','checkbox','judge','fill','saq');
		$i = 0;
		while(isset($field[$i])){
			$name = $info['name'];
			$val = testIdEach($field[$i],$name);
			$update = testIdUpDate($tableName,$info['id'],$field[$i],$val);
			$i++;
		}
	}
	return 1;
}
?>