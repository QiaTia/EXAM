<?php
	include_once '../admin/tinkphp.php';
    SESSION_start();
    if(isset($_SESSION['userinfo'])){
    	if($_SESSION['vip'] >= 1 ) $username=$_SESSION['userinfo'];
    	else alert('用户权限不够！','../');
    }else{
    	alert('请先登录！','../');
    }
?>