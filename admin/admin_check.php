<?php
	include '../sql/sql2.php';
	include_once 'tinkphp.php';
    SESSION_start();
    if(isset($_SESSION['vip'])){
    	if($_SESSION['vip'] >= 9 ) $username=$_SESSION['userinfo'];
    	else alert('用户权限不够！','../');
    }else{
    	alert('请先登录！或用户权限不够！','../');
    }
?>