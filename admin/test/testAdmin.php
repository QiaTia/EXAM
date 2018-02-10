<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>阅卷中心</title>
</head>
<body>
<?php
	include_once '../../sql/eSql.php';
	include_once '../../sql/mdui.php';
	include_once '../../sql/sql2.php';
	$eSql = new eSql();
	$sql="select * from test_pape";//查询表
	$res=mysql_query($sql,$con_link);
?>
<div>
<table class="mdui-table">
	<tr class="mdui-shadow-2">
		<td>编号</td>
		<td>学号</td>
		<td>姓名</td>
		<td>班级</td>
		<td>考试时间</td>
		<td>考试名称</td>
		<td>查看试卷</td>

	</tr>
	<?php while ($info = mysql_fetch_assoc($res)) {
		if(!$info['state']) continue;
		$userInfo = $eSql->sqlSelect('user',$info['userid']);
		?>
	<tr>
		<td><?php echo $info['id']; ?></td>
		<td ><?php echo $info['userid']; ?></td>
		<td ><?php echo $userInfo['name']; ?> </td>
		<td ><?php echo $userInfo['class'];?></td>
		<td ><?php echo $info['starttime']; ?></td>
		<td><?php echo $info['title'];?></td>
		<td> 
			<a href="check.php?id=<?php echo $info['id'].'&userid='.$info['userid']; ?>" class="mdui-btn mdui-btn-icon mdui-text-color-red"><i class="mdui-icon material-icons">&equiv;</i></a>
		</td>
    </tr>
<?php 
	}
?>
</table>
</div>
</body>
</html>