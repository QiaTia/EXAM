<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>发布考试</title>
</head>

<body>
<?php 
date_default_timezone_set("PRC");
include_once '../../sql/sql2.php';
include_once '../../sql/mdui.php';
include_once '../../sql/eSql.php';
$eSql = new eSql();
if(isset($_POST['btn'])){
  $title=$_POST['title'];
	$cate=$_POST["cate"];
	$class=empty($_POST['class'])?'':implode(',',$_POST['class']);
  if($class == '') die("请选择班级");
	$startTime=empty($_POST["startTime"])?' ':$_POST["startData"].' '.$_POST["startTime"];
	$overTime=empty($_POST["overTime"])?' ':$_POST["overData"].' '.$_POST["overTime"];
	$radio = $_POST['radio'].','.$_POST['radioNum'];
	$checkbox = $_POST['checkbox'].','.$_POST['checkboxNum'];
	$judge = $_POST['judge'].','.$_POST['judgeNum'];
	$fill = $_POST['fill'].','.$_POST['fillNum'];
	$saq = $_POST['saq'].','.$_POST['saqNum'];
  #sql语句区
	$sql = "INSERT INTO  `test` (`title` ,`cate` ,`class` ,`startTime` ,`overTime` ,`radio` ,`checkbox` ,`judge` ,`fill` ,`saq`)VALUES ('$title',  '$cate',  '$class',  '$startTime',  '$overTime',  '$radio',  '$checkbox',  '$judge',  '$fill',  '$saq');";
	if (!mysql_query($sql,$con_link )){
		die('Error: ' . mysql_error());
	}else{
    echo '<script> alert("发布成功,正在返回"); window.location.href="testAdmin.php" </script>';
  }
 // print_r($startTime.$overTime);
		//关闭连接
}
?>
<div class="mdui-container">
<form name="form1" method="post" action="testNew.php">
   <h4>发布考试</h4>
   <div class="mdui-textfield">
   	<label class="mdui-textfield-label">试卷标题</label>
   	<input class="mdui-textfield-input" name="title" type="text" placeholder="期中考试测试题?" required/>
    <div class="mdui-textfield-error">标题不能为空</div>
   </div>
    <label class="mdui-textfield-label">选择科目:</label>
        <select name="cate" class="mdui-select" style="margin-left: 75px;" mdui-select>
            <?php
                $sql="select * from curriculum";//查询表
                $res=mysql_query($sql,$con_link);
                while ($info = mysql_fetch_assoc($res)) {
            ?>
            <option value="<?php echo $info['name']; ?>"><?php echo $info['name']; ?></option>
            <?php } ?>
        </select>
   	<label class="mdui-textfield-label">选择班级:</label>
        <select multiple size="4" class="mdui-select"  name="class[]"  style="margin-left: 75px;">
            <?php
                $sql="select * from class";//查询表
                $res=mysql_query($sql,$con_link);
                while ($info = mysql_fetch_assoc($res)) {
            ?>
            <option value="<?php echo $info['class']; ?>"><?php echo $info['class']; ?></option>
            <?php } ?>
        </select>
    <div class="mdui-row-xs-2">
        <label class="mdui-textfield-label">开考时间及结束时间</label>
        <div class="mdui-col mdui-row-xs-3 mdui-row-gapless">
        	<label class="mdui-textfield-label">开考时间</label>
          <div class="mdui-col">
            <input type="date" name="startData" class="mdui-textfield-input">
          </div>
          <div class="mdui-col">
            <input type="time" name="startTime" class="mdui-textfield-input">
          </div>
        </div>
        <div class="mdui-col mdui-row-xs-3 mdui-row-gapless">
        	<label class="mdui-textfield-label">结束时间</label>
          <div class="mdui-col">
            <input type="date" name="overData" class="mdui-textfield-input">
          </div>
          <div class="mdui-col">
            <input type="time" name="overTime" class="mdui-textfield-input">
          </div>
        </div>
		
   </div>
    <div class="mdui-row-xs-5">
        <label class="mdui-textfield-label">请选题型及数目</label>
		<div class="mdui-col"> 
			<label class="mdui-textfield-label">单选题</label>
			<div class="mdui-textfield"><input class="mdui-textfield-input" name="radio" type="number" placeholder="数量" value="30" /></div>
			<div class="mdui-textfield"><input class="mdui-textfield-input" name="radioNum" type="number" placeholder="单位分数" value="1" /></div>
		</div>

		<div class="mdui-col"> 
			<label class="mdui-textfield-label">多选题</label>
			<div class="mdui-textfield"><input class="mdui-textfield-input" name="checkbox" type="number" placeholder="数量" value="10" /></div>
			<div class="mdui-textfield"><input class="mdui-textfield-input" name="checkboxNum" type="number" placeholder="单位分数"  value="2"/></div>
		</div>

		<div class="mdui-col"> 
			<label class="mdui-textfield-label">判断题</label>
			<div class="mdui-textfield"><input class="mdui-textfield-input" name="judge" type="number" placeholder="数量" value="5" /></div>
			<div class="mdui-textfield"><input class="mdui-textfield-input" name="judgeNum" type="number" placeholder="单位分数"  value="2"/></div>
		</div>

		<div class="mdui-col"> 
			<label class="mdui-textfield-label">填空题</label>
			<div class="mdui-textfield"><input class="mdui-textfield-input" name="fill" type="number" placeholder="数量" value="5" /></div>
			<div class="mdui-textfield"><input class="mdui-textfield-input" name="fillNum" type="number" placeholder="单位分数"  value="2"/></div>
		</div>
		<div class="mdui-col"> 
			<label class="mdui-textfield-label">简答题</label>
			<div class="mdui-textfield"><input class="mdui-textfield-input" name="saq" type="number" placeholder="数量" value="2"/></div>
			<div class="mdui-textfield"><input class="mdui-textfield-input" name="saqNum" type="number" placeholder="单位分数"  value="15"/></div>
		</div>
   </div>
<div class="mdui-row-xs-2">
  <div class="mdui-col">
    <input  class="mdui-btn mdui-btn-block mdui-color-theme-accent mdui-ripple" type="submit" name="btn" id="btn" value="添加">
  </div>
  <div class="mdui-col">
    <input class="mdui-btn mdui-btn-block mdui-color-theme-accent mdui-ripple" type="reset" name="btn2" id="btn2" value="重置">
  </div>
</div>
</form>
</div>
</body>
</html>
