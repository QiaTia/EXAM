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
		$name = $_POST["name"];
		$sql="INSERT INTO `curriculum` (`id` ,`name`)VALUES (NULL ,  '".$name."');";
		if(! mysql_query($sql,$con_link)) snackbar("新建失败！！".$sql);
		snackbar("新建成功！！");
	}
	if(isset($_REQUEST["del"])){
		$del=$_REQUEST["del"];
		$sql = "delete from curriculum where id = '$del'";
		if(! mysql_query($sql,$con_link)) snackbar("删除失败！！".$sql);
		snackbar("删除成功！！");
	}
	if(isset($_REQUEST["newName"])){
		$newName = $_REQUEST["newName"];
		$newCon = $_REQUEST["newCon"];
		$id = $_REQUEST['id'];
		$sql = "UPDATE  `ksxt`.`curriculum` SET  `name` =  '$newName',`content` =  '$newCon' WHERE  `curriculum`.`id` =$id;";
		if(! mysql_query($sql,$con_link)) snackbar("删除失败！！".$sql);
		snackbar("修改成功".$newName.$newCon.$id);
	}
	$sql="select * from curriculum";//查询表
	$res=mysql_query($sql,$con_link);
?>
<div>
<table   class="mdui-table mdui-table-hoverable">
	<tr  class="mdui-shadow-2">
		<td>编号</td>
		<td>科目</td>
		<td>介绍</td>
		<td>单选题数</td>
		<td>多选题数</td>
		<td>判断题数</td>
		<td>填空题数</td>
		<td>简答题数</td>
		<td>操作</td>
	</tr>
	<?php while ($info = mysql_fetch_assoc($res)) {
		$id = $info['id'];
		$name = $info['name'];
		$con = $info['content'];
	?>
	<tr>
		<td><?php echo $info['id'];;?></td>
		<td ><?php echo $info['name']; ?></td>
		<td><?php echo $info['content']; ?></td>
		<td><?php echo $eSql->sqlNum('radio','class',$info['name']);?></td>
		<td><?php echo $eSql->sqlNum('checkbox','class',$info['name']);?></td>
		<td><?php echo $eSql->sqlNum('judge','class',$info['name']);?></td>
		<td><?php echo $eSql->sqlNum('fill','class',$info['name']);?></td>
		<td><?php echo $eSql->sqlNum('saq','class',$info['name']);?></td>
		<td> 
			<a  onclick="return confirm('确定删除么')" href="cate.php?del=<?php echo $info['id']?>" class="mdui-btn mdui-btn-icon mdui-text-color-red"><i class="mdui-icon material-icons">&#xe14c;</i></a>
			<a onclick="edit('<?php echo $name; ?>','<?php echo $con; ?>','<?php echo $id; ?>')" class="mdui-btn mdui-btn-icon mdui-text-color-red" ><i class="mdui-icon material-icons">&#xe3c9;</i></a> 
		</td>
    </tr>
<?php 
	}
?>
<tr><td colspan="9">
<div class="mdui-textfield ">
<div class="mdui-textfield mdui-textfield-expandable ">
	<button class="mdui-textfield-icon mdui-btn mdui-btn-icon "><i class="mdui-icon material-icons">&#xe145;</i></button>
	    <form action="cate.php" method="post">
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
	function edit(name,con,id){
		var newName = prompt("你要将《"+name+'》修改为', ""); //将输入的内容赋给变量 name 
		var newCon= prompt("你要将<"+con+'>修改为', ""); 
		if (newName || newCon){
			newName=newName?newName:name;
			newCon=newCon?newCon:con;
			window.location.href='cate.php?newName=' + newName +'&newCon='+ newCon+'&id='+id;
		}
		else
		mdui.snackbar({ message: '你啥都没改哎', position: 'top'});
	}
</script>
</body>
</html>