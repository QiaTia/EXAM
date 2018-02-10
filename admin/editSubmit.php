<?php
require_once "../sql/sql.php";
$sql_db = new sql_db();
SESSION_start();
$userid=$_SESSION['userid'];
if(isset($_POST['cate'])){
	$cate=$_POST['cate'];
	$id = $_POST['id'];
	$title=$_POST['title'];
	switch ($cate){  //进行分类提交
	case "radio":
		$anwers = $_POST['anwers'];
		$option = $_POST['option'];
		$con_link = mysql_connect($sql_db->host,$sql_db->user,$sql_db->pwd);
		mysql_query("set names utf8"); 
		mysql_select_db($sql_db->db); 
		$sql="UPDATE  `radio` SET  `title` = '$title', `option_1`='$option[0]', `option_2`='$option[1]', `option_3`='$option[2]', `option_4`='$option[3]', `option_5`='$option[4]', `option_6`='$option[5]', `option_7`='$option[6]', `option_8`='$option[7]', `option_9`='$option[8]', `answer`='$anwers' WHERE `id` =$id;";
		$con=mysql_query($sql,$con_link); 
		if(!$con) {echo $sql; die ('更新失败'); }
		break;
	case 'checkbox':
	    $option = $_POST['option'];
	    $anwers = implode(',',$_POST['anwers']);
	    $con_link = mysql_connect($sql_db->host,$sql_db->user,$sql_db->pwd);
		mysql_query("set names utf8"); 
		mysql_select_db($sql_db->db); 
		$sql="UPDATE `checkbox` SET `title` = '$title', `option_1`='$option[0]', `option_2`='$option[1]', `option_3`='$option[2]', `option_4`='$option[3]', `option_5`='$option[4]', `option_6`='$option[5]', `option_7`='$option[6]', `option_8`='$option[7]', `option_9`='$option[8]', `answer`='$anwers' WHERE `id` =$id;";
		$con=mysql_query($sql,$con_link); 
		if(!$con) {echo $sql; die ('更新失败'); }
			break;
	case "fill":
		$anwers=$_POST['anwers'];
		//$option=$_POST['option'];
		$con_link = mysql_connect($sql_db->host,$sql_db->user,$sql_db->pwd);
		mysql_query("set names utf8"); 
		mysql_select_db($sql_db->db); 
		//print_r($anwers);
		$sql="UPDATE `fill` SET `title`='$title', `answer_1`='$anwers[0]', `answer_2`='$anwers[1]', `answer_3`='$anwers[2]' WHERE `id` =$id;";
		$con=mysql_query($sql,$con_link); 
		if(!$con) {echo $sql; die ('更新失败'); }
		break;
	case "judge":
		$anwers=$_POST['anwers'];
		$con_link = mysql_connect($sql_db->host,$sql_db->user,$sql_db->pwd);
		mysql_query("set names utf8"); 
		mysql_select_db($sql_db->db); 
		//print_r($anwers);
		$sql="UPDATE `judge` SET `title`  ='$title',`answer`='$anwers' WHERE `id` =$id;";
		$con=mysql_query($sql,$con_link); 
		if(!$con) {echo $sql; die ('更新失败'); }
		break;
	case "saq":
		$anwers=$_POST['anwers'];
		$con_link = mysql_connect($sql_db->host,$sql_db->user,$sql_db->pwd);
		mysql_query("set names utf8"); 
		mysql_select_db($sql_db->db); 
		$sql="UPDATE `saq` SET `title`='$title', `answer`='$anwers' WHERE `id` =$id;";
		$con=mysql_query($sql,$con_link); 
		if(!$con) {echo $sql; die ('更新失败'); }
		break;
    }

	//echo $class,$cate,$title,$option,$anwers;
	//print_r($_POST['option']);
	//print_r($_POST['anwers']);
	echo 0;
}
/*
*  给与改条数据的id，对改条数据进行更新
*/
function sqlUpdata($id,$userid,$class,$testclass,$classid,$anwers){
	$con_link = mysql_connect($sql_db->host,$sql_db->user,$sql_db->pwd);
	mysql_query("set names utf8"); 
	mysql_select_db($sql_db->db); 
	$sql="UPDATE `testtemp` SET  `userid` =  '$userid',`class` =  '$class',`testclass` =  '$testclass',`classid` =  '$classid',`anwers` =  '$anwers' WHERE `id` =$id";
	$con=mysql_query($sql,$con_link); 
	if(!$con) die ('更新失败'); 
}
?>