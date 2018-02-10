<?php
require_once "../sql/sql.php";
$sql_db = new sql_db();
SESSION_start();
$userid=$_SESSION['userid'];
if(isset($_POST['cate'])){
	$class=$_POST['class'];
	$cate=$_POST['cate'];
	$title=$_POST['title'];
	switch ($cate){  //进行分类提交
	case "radio":
		$anwers = $_POST['anwers'];
		$option = $_POST['option'];
		$con_link = mysql_connect($sql_db->host,$sql_db->user,$sql_db->pwd);
		mysql_query("set names utf8"); 
		mysql_select_db($sql_db->db); 
		$sql="INSERT INTO `radio` (`class`, `title`, `option_1`, `option_2`, `option_3`, `option_4`, `option_5`, `option_6`, `option_7`, `option_8`, `option_9`, `answer`) VALUES ('$class', '$title', '$option[0]', '$option[1]', '$option[2]', '$option[3]', '$option[4]', '$option[5]', '$option[6]', '$option[7]', '$option[8]', '$anwers');";
		$con=mysql_query($sql,$con_link); 
		if(!$con) {echo $sql; die ('插入失败'); }
		break;
	case 'checkbox':
	    $option = $_POST['option'];
	    $anwers = implode(',',$_POST['anwers']);
	    $con_link = mysql_connect($sql_db->host,$sql_db->user,$sql_db->pwd);
		mysql_query("set names utf8"); 
		mysql_select_db($sql_db->db); 
		$sql="INSERT INTO `checkbox` (`class`, `title`, `option_1`, `option_2`, `option_3`, `option_4`, `option_5`, `option_6`, `option_7`, `option_8`, `option_9`, `answer`) VALUES ('$class', '$title', '$option[0]', '$option[1]', '$option[2]', '$option[3]', '$option[4]', '$option[5]', '$option[6]', '$option[7]', '$option[8]', '$anwers');";
		$con=mysql_query($sql,$con_link); 
		if(!$con) {echo $sql; die ('插入失败'); }
			break;
	case "fill":
		$anwers=$_POST['anwers'];
		//$option=$_POST['option'];
		$con_link = mysql_connect($sql_db->host,$sql_db->user,$sql_db->pwd);
		mysql_query("set names utf8"); 
		mysql_select_db($sql_db->db); 
		//print_r($anwers);
		$sql="INSERT INTO `fill` (`class`, `title`, `answer_1`, `answer_2`, `answer_3`) VALUES ('$class', '$title', '$anwers[0]', '$anwers[1]', '$anwers[2]');";
		$con=mysql_query($sql,$con_link); 
		if(!$con) {echo $sql; die ('插入失败'); }
		break;
	case "judge":
		$anwers=$_POST['anwers'];
		$con_link = mysql_connect($sql_db->host,$sql_db->user,$sql_db->pwd);
		mysql_query("set names utf8"); 
		mysql_select_db($sql_db->db); 
		//print_r($anwers);
		$sql="INSERT INTO  `judge` (`class` ,`title` ,`answer`) VALUES ('$class', '$title', '$anwers');";
		$con=mysql_query($sql,$con_link); 
		if(!$con) {echo $sql; die ('插入失败'); }
		break;
	case "saq":
		$anwers=$_POST['anwers'];
		$con_link = mysql_connect($sql_db->host,$sql_db->user,$sql_db->pwd);
		mysql_query("set names utf8"); 
		mysql_select_db($sql_db->db); 
		$sql="INSERT INTO `saq` (`class`, `title`, `answer`) VALUES  ( '$class', '$title', '$anwers');";
		$con=mysql_query($sql,$con_link); 
		if(!$con) {echo $sql; die ('插入失败'); }
		break;
    }

	//echo $class,$cate,$title,$option,$anwers;
	//print_r($_POST['option']);
	//print_r($_POST['anwers']);
	echo 0;
}
?>