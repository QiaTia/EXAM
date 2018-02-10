<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>科目管理</title>
</head>
<body>
<?php
	include_once 'admin_check.php';
	include_once '../sql/eSql.php';
	$eSql = new eSql();
	if(isset($_POST['btn'])){
		$name = $_POST["name"];-
		$sql="INSERT INTO `class` (`class`)VALUES ( '".$name."');";
		if(! mysql_query($sql,$con_link)) snackbar("新建失败！！".$sql);
		snackbar("新建成功！！");
	}
	if(isset($_REQUEST["del"])){
		$del=$_REQUEST["del"];
		$sql = "delete from class where id = '$del'";
		if(! mysql_query($sql,$con_link)) snackbar("删除失败！！".$sql);
		snackbar("删除成功！！");
	}
	$sql="select * from class";//查询表
	$res=mysql_query($sql,$con_link);
?>
<div>
<table   class="mdui-table">
	<tr  class="mdui-shadow-2">
		<td>编号</td>
		<td>科目</td>
		<td>学生数</td>
		<td>操作</td>
	</tr>
	<?php while ($info = mysql_fetch_assoc($res)) {?>
	<tr>
		<td><?php echo $info['id']; ?></td>
		<td ><?php echo $info['class']; ?></td>
		<td><?php echo $eSql->sqlNum('user','class',$info['class']);?></td>
		<td> 
			<a  onclick="return confirm('确定删除么')" href="class_admin.php?del=<?php echo $info['id']?>" class="mdui-btn mdui-btn-icon mdui-text-color-red"><i class="mdui-icon material-icons">&#xe14c;</i></a>
		</td>
    </tr>
<?php 
	}
?>
<tr><td colspan="4">
<div class="mdui-textfield ">
<div class="mdui-textfield mdui-textfield-expandable ">
	<button class="mdui-textfield-icon mdui-btn mdui-btn-icon "><i class="mdui-icon material-icons">&#xe145;</i></button>
	    <form action="class_admin.php" method="post">
			<input class="mdui-textfield-input" type="text" name="name" placeholder="新建科目"/>
			<input class="mdui-btn mdui-btn-icon mdui-text-color-red" style="display: none;" type="submit" name="btn"/>
	    </form>
	<button class="mdui-textfield-close mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">close</i></button>
</div>
</div>
</td> 
</tr>
</table>
</div>
<script type="text/javascript">
	function edti(){
		mdui.snackbar({ message: '预留功能啦,别点了!' });
	}
</script>
</body>
</html>