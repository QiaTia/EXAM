<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>抽题中</title>      
	<?php 
	include_once "sql/Bootstrap.php";
	include_once 'sql/eSql.php';
	$eSql = new eSql();
	SESSION_start();
	$userId = $_SESSION['userid'];
	$id=$_REQUEST['id'];
	$title = $eSql->sqlSelect('test',$id)['title'];
	$con_link = mysql_connect($GLOBALS['host'],$GLOBALS['user'],$GLOBALS['pwd']);
	mysql_query('set names utf8');
	mysql_select_db($GLOBALS['db']);
	$result = mysql_query("select * from `test_pape` where `title` = '$title' and `userid` = '$userId'",$con_link);
	$num = mysql_num_rows($result);
	if($num != 0)  echo '<script> window.location.href="exam.php?id='.$id.'" </script>';
	?>  
	<style>
        .content{ width: 100%;height: 100%; }
        .Logo{ width: 220px; height: 220px; background: url('images/load.gif') 50% 50% no-repeat rgb(249, 249, 249); margin: 0 auto;}
        .Text{width: 125px;margin: 0 auto;}
    </style>
</head>
<body>
	<div class="loader content">
        <div class="loader Logo"></div>
        <div class="loader Text">正在抽题中~~~</div>
    </div>
    <script type="text/javascript">
    	id = <?php echo $id;?>;
    $(document).ready(function(){
    	$.post("rangTest.php",
		 	 {
		 	 	id:id
		 	 },
		 	 function(data,status){
		 	 	if(data == true){ 
		 	 		window.location.href="exam.php?id="+id;
		 	 		$(".loader").fadeOut("slow");
		 	 	}else{
		 	 		console.log(data);
		 	 		$(".Text").text('抽题失败,请返回重试');
		 	 		//window.location.href="index.php";
		 	 		//$(".loader").fadeOut("slow");
		 	 	}
		});
    });
    </script>
</body>
</html>