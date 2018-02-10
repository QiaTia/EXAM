<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>欢迎加入我们！</title>
</head>

<body>
<?php 
date_default_timezone_set("PRC");
include('../sql/sql2.php');
include('tinkphp.php');
include_once '../sql/eSql.php';
$eSql = new eSql();
if(isset($_POST['btn'])){
	$id=$_POST['num'];
	$name=$_POST["name"];
	$email=isset($_POST["email"])?'':$_POST["email"];
	$pw=md5($_POST["pw"]);
	$sex=$_POST['sex'];
	$class=$_POST['class'];
	$time=date("Y-m-d H:i:sa",time());
	     	$sql="select * from user where id='$id'";
			$result=mysql_query($sql,$con_link );
			$num=mysql_num_rows($result);
			if($num==0){
				$sql = "insert into user (id,name,class,sex,password,email,vip,date)  values('$id','$name','$class','$sex','$pw','$email',1,'$time')";
				if (!mysql_query($sql,$con_link )){
					die('Error: ' . mysql_error());
				}
				alert('添加成功'.$name,'./student_admin.php');
			} 
			else {
			    $error="该学号不可用,请换一个重试!";
				$echo="<script> alert($error);</script>";
			}
	       //关闭连接
	       mysql_close($con_link);
	}

?>
<div  id="con" class="mdui-container">
<form name="form1" method="post" action="student_new.php">
   <h4><?php if(isset($error))echo $error; ?></h4>
    <div class="mdui-textfield mdui-textfield-floating-label">
        <i class="mdui-icon material-icons">account_circle</i>
        <label class="mdui-textfield-label">学号</label>
		<input name='num' class="mdui-textfield-input" type="number" required/>
		<div class="mdui-textfield-error">学号不能为空</div>
   </div> 
   	<label class="mdui-textfield-label">选择班级:</label>
        <select name="class" class="mdui-select" style="margin-left: 75px;" mdui-select>
            <?php
                $sql="select * from class";//查询表
                $res=mysql_query($sql,$con_link);
                while ($info = mysql_fetch_assoc($res)) {
            ?>
            <option value="<?php echo $info['class']; ?>"><?php echo $info['class']; ?></option>
            <?php } ?>
        </select>
    <div class="mdui-textfield mdui-textfield-floating-label">
        <i class="mdui-icon material-icons">account_circle</i>
        <label class="mdui-textfield-label">姓名</label>
		<input name='name' class="mdui-textfield-input" type="text" required/>
		<div class="mdui-textfield-error">姓名不能为空</div>
   </div>
   <div class="mdui-textfield mdui-textfield-floating-label">
        <i class="mdui-icon material-icons">lock</i>
        <label class="mdui-textfield-label">密码</label>
		<input name='pw' class="mdui-textfield-input"  type="password"  pattern="^.*(?=.{6,}).*$" required/>
		<div class="mdui-textfield-error">密码至少 6 位</div>
   </div>
 <div class="mdui-textfield mdui-textfield-floating-label">
   <i class="mdui-icon material-icons">people</i>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <label class="mdui-radio">
     <input type="radio" name="sex" value="1"  checked/>
        <i class="mdui-radio-icon"></i>
            男
        </label>
        <label class="mdui-radio">
            <input type="radio" name="sex" value="0"/>
         <i class="mdui-radio-icon"></i>
             女
         </label>
</div>
   <div class="mdui-textfield mdui-textfield-floating-label">
        <i class="mdui-icon material-icons">email</i>
        <label class="mdui-textfield-label">电子邮箱</label>
		<input name='email' class="mdui-textfield-input" type="email"/>
		<div class="mdui-textfield-error">邮箱格式错误</div>
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