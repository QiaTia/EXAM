<?php
include_once 'sql/eSql.php';
    $eSql = new eSql();
#试卷ID
    $id = isset($_POST['id'])?$_POST['id']:1;
#考试用户ID
    SESSION_start();
    $userId = $_SESSION['userid'];
//获取抽提的数量
	$info = $eSql->sqlSelect('test',$id);
	$radioNum = explode(',',$info['radio'])[0];
	$checkboxNum = explode(',',$info['checkbox'])[0];
	$judgeNum = explode(',',$info['judge'])[0];
	$fillNum = explode(',',$info['fill'])[0];
	$saqNum = explode(',',$info['saq'])[0];
#info
	$cate=$info['cate'];
	$title=$info['title'];
	$startTime=$info['startTime'];
	$overTime=$info['overTime'];
//获取题目总量
	$testNum = $eSql->sqlSelect2('curriculum','name',$cate);
    $radioAllNum = explode(',',$testNum['radio']);
    $checkboxAllNum = explode(',',$testNum['checkbox']);
	$judgeAllNum = explode(',',$testNum['judge']);
	$fillAllNum = explode(',',$testNum['fill']);
	$saqAllNum = explode(',',$testNum['saq']);

#随机抽题
	$radioTest = implode(',',rangeTest($radioAllNum,$radioNum));
	$checkboxTest = implode(',',rangeTest($checkboxAllNum,$checkboxNum));
	$judgeTest = implode(',',rangeTest($judgeAllNum,$judgeNum));
	$fillTest = implode(',',rangeTest($fillAllNum,$fillNum));
	$saqTest = implode(',',rangeTest($saqAllNum,$saqNum));

	#echo $radioTest.$checkboxTest.$judgeTest.$fillTest.$saqTest;
	
#存入数据库
	$con_link = mysql_connect($GLOBALS['host'],$GLOBALS['user'],$GLOBALS['pwd']);
	mysql_query('set names utf8'); 
	mysql_select_db($GLOBALS['db']); 
	$sql = "INSERT INTO `test_pape` (`userid` ,`curriculum`,`title`,`starttime`,`endtime`,`radio`,`checkbox`,`judge`,`fill`,`saq`) VALUES ('$userId','$cate',  '$title','$startTime','$overTime','$radioTest','$checkboxTest','$judgeTest','$fillTest','$saqTest');";
	$result = mysql_query($sql,$con_link); 
	if(!$result) echo false.$sql;
	else echo true;
#拆分数据
function rangeTest($numbers,$Num){
	//$numbers = range (1,$AllNum); 
	//shuffle 将数组顺序随即打乱 
	array_pop($numbers);
	shuffle($numbers); 
	//array_slice 取该数组中的某一段 
	$result = array_slice($numbers,0,$Num); 
	return $result;
}
?>