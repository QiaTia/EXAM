<?php
include("../sql/sql2.php");
date_default_timezone_set("PRC");
if(isset($_POST['name'])){
  $id=$_POST['name'];
  $pw=md5($_POST['pw']);
 if(isset($_POST['cookie']))  $cookie=$_POST['cookie'];
  $sql="select * from user where id='$id'";
  $result=mysql_query($sql,$con_link);
  $num=mysql_num_rows($result);
  if($num==0)
	 echo '用户名不存在,请先注册!';
  else{
	  $sql="select * from user where id='$id' and password='$pw'";
	  $con=mysql_query($sql,$con_link); 
	  $num=mysql_num_rows($con);
	  if($num==0)
		  echo '密码不正确,请检查!';
	  else{
		  $info=mysql_fetch_assoc($con);
		  SESSION_start();
		  $id = $info['id'];
		  $_SESSION['userinfo']=$info['name'];
		  $_SESSION['userid']=$info['id'];
		  $_SESSION['vip']=$info['vip'];
		  if($cookie=='is'){
			  setcookie('username', $id,time()+60*60*24*30);
			  setcookie('pw', $pw,time()+60*60*24*30);
		  }
		  echo 0;
		$time=date("Y-m-d H:i:sa",time());
		$sql="UPDATE `user` SET `login_date`= '$time' WHERE id='$id'";
		mysql_query($sql,$con_link);
	  }
  }
}
?>
