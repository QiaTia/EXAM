<?php
include_once '../../sql/sql2.php';

#获取post表单信息
$userid =$_POST['userid'];
$title =$_POST['title'];
$curriculum =$_POST['curriculum'];
$radio =$_POST['radio'];
$checkbox =$_POST['checkbox'];
$judge =$_POST['judge'];
$fill =$_POST['fill'];
$saq =$_POST['saq'];
$objectivescore =$_POST['objectivescore'];
$subjectivescore =$_POST['subjectivescore'];
$totalscore = $objectivescore + $subjectivescore;
$id = $_POST['id'];

#数据库操作部分
$sql = "INSERT INTO `test_manage` (`userid`,`title`, `curriculum`, `radio`, `checkbox`, `judge`, `fill`, `saq`, `objectivescore`, `subjectivescore`, `totalscore`) VALUES ('$userid', '$title', '$curriculum', '$radio', '$checkbox', '$judge', '$fill', '$saq', '$objectivescore', '$subjectivescore', '$totalscore');";
$sql2 = "UPDATE `test_pape` SET `state` =  '1' WHERE  `test_pape`.`id` = '$id'";
$sql3 = "DELETE FROM `testtemp` WHERE `userid` = $userid";
$result = mysql_query($sql,$con_link); 
if(!$result) die(mysql_error());
$result = mysql_query($sql2,$con_link); 
if(!$result) die(mysql_error());
$result = mysql_query($sql3,$con_link); 
if(!$result) die(mysql_error());
echo 0;
?>