<?php
include_once '../sql/sql2.php';
SESSION_start();
$userid=$_SESSION['userid'];
if(isset($_POST['class'])){
	$class=$_POST['class'];
	$testclass=$_POST['testclass'];
	$classid=$_POST['classid'];
	switch ($testclass){  //进行分类提交
	case "radio":
		$anwers=$_POST['anwers'];
		if(sqlNum($userid,$class,$testclass,$classid)){
			//执行更新操作 
			$id=sqlId($userid,$class,$testclass,$classid);
			sqlUpdata($id,$userid,$class,$testclass,$classid,$anwers);
		}else {
			//执行插入操作
			sqlInto($userid,$class,$testclass,$classid,$anwers);
		}
		break;
	case "fill":
		 $anwers=implode(',',$_POST['anwers']);
		//print_r($anwers);
		//print_r(explode(',', $anwers)); 
		if(sqlNum($userid,$class,$testclass,$classid)){
			//执行更新操作 
			$id=sqlId($userid,$class,$testclass,$classid);
			sqlUpdata($id,$userid,$class,$testclass,$classid,$anwers);
		}else {
			//执行插入操作
			sqlInto($userid,$class,$testclass,$classid,$anwers);
		}
		break;
	case "judge":
		$anwers=$_POST['anwers'];
		if(sqlNum($userid,$class,$testclass,$classid)){
			//执行更新操作 
			$id=sqlId($userid,$class,$testclass,$classid);
			sqlUpdata($id,$userid,$class,$testclass,$classid,$anwers);
		}else {
			//执行插入操作
			sqlInto($userid,$class,$testclass,$classid,$anwers);
		}
		break;
	case "saq":
		$anwers=$_POST['anwers'];
		if(sqlNum($userid,$class,$testclass,$classid)){
			//执行更新操作 
			$id=sqlId($userid,$class,$testclass,$classid);
			sqlUpdata($id,$userid,$class,$testclass,$classid,$anwers);
		}else {
			//执行插入操作
			sqlInto($userid,$class,$testclass,$classid,$anwers);
		}
		break;
	case 'checkbox':
	    $anwers=implode(',',$_POST['anwers']);
		//print_r($anwers);
		//print_r(explode(',', $anwers)); 
		if(sqlNum($userid,$class,$testclass,$classid)){
			//执行更新操作 
			$id=sqlId($userid,$class,$testclass,$classid);
			sqlUpdata($id,$userid,$class,$testclass,$classid,$anwers);
		}else {
			//执行插入操作
			sqlInto($userid,$class,$testclass,$classid,$anwers);
		}
			break;
    }
	echo 0;
}
/*
*  给与必要参数,查询数据库是否有重复
*/
function sqlNum($userid,$class,$testclass,$classid){
	$sql_db = new sql_db();
	$con_link = mysql_connect($sql_db->host,$sql_db->user,$sql_db->pwd);
	mysql_query("set names utf8"); 
	mysql_select_db($sql_db->db); 
	$sql="select * from testtemp where userid='$userid' and class='$class' and testclass='$testclass'  and classid='$classid'";
	$con=mysql_query($sql,$con_link); 
	return mysql_num_rows($con);
}
/*
*  给与必要参数,查询本条记录在数据库的id
*/
function sqlId($userid,$class,$testclass,$classid){
	$sql_db = new sql_db();
	$con_link = mysql_connect($sql_db->host,$sql_db->user,$sql_db->pwd);
	mysql_query("set names utf8"); 
	mysql_select_db($sql_db->db); 
	$sql="select * from testtemp where userid='$userid' and class='$class' and testclass='$testclass' and classid='$classid'";
	$con=mysql_query($sql,$con_link); 
	$info=mysql_fetch_assoc($con);
	return $info['id'];
}
/*
*  给与必要参数,查询本条记录在数据库的id
*/
function sqlInto($userid,$class,$testclass,$classid,$anwers){
	$sql_db = new sql_db();
	$con_link = mysql_connect($sql_db->host,$sql_db->user,$sql_db->pwd);
	mysql_query("set names utf8"); 
	mysql_select_db($sql_db->db); 
	$sql="INSERT INTO `testtemp` ( `userid`, `class`, `testclass`, `classid`, `anwers`) VALUES ('$userid', '$class', '$testclass', '$classid', '$anwers')";
	$con=mysql_query($sql,$con_link); 
	if(!$con) die ('插入失败'); 
}
/*
*  给与改条数据的id，对改条数据进行更新
*/
function sqlUpdata($id,$userid,$class,$testclass,$classid,$anwers){
	$sql_db = new sql_db();
	$con_link = mysql_connect($sql_db->host,$sql_db->user,$sql_db->pwd);
	mysql_query("set names utf8"); 
	mysql_select_db($sql_db->db); 
	$sql="UPDATE `testtemp` SET  `userid` =  '$userid',`class` =  '$class',`testclass` =  '$testclass',`classid` =  '$classid',`anwers` =  '$anwers' WHERE `id` =$id";
	$con=mysql_query($sql,$con_link); 
	if(!$con) die ('更新失败'); 
}
?>