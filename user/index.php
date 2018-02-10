<!doctype html>
<html>
<head>
<meta charset="utf-8">
<style>
  .mdui-toolbar{  z-index:1;}
  #imghead{ border: dashed 1px #000;  }
</style>
<?php
include '../sql/my_sql.php';
include '../sql/sql2.php';
include '../sql/mdui.php';
include '../admin/tinkphp.php';
include '../sql/Bootstrap.php';

date_default_timezone_set("PRC");

SESSION_start();
if(isset($_SESSION['userinfo'])) {
  $username=$_SESSION['userinfo'];
  $userid=$_SESSION['userid'];
}
else alert("请先登录","login.php");

//     密码修改
if(isset($_POST['pw_old'])){
  $pw_old = md5($_POST['pw_old']);
  $pw_now1 = md5($_POST['pw_now1']);
  $pw_now2 = md5($_POST['pw_now2']);

  $sql = "select * from user where id ='$userid'";
    $con=mysql_query($sql,$con_link); 
    $num=mysql_num_rows($con);
    if($num==1){
    $sql="select * from user where id='$userid' and password='$pw_old'";
    $con=mysql_query($sql,$con_link); 
    $num=mysql_num_rows($con);
    if($num==0){
      alert('密码不正确,请检查!','#');}
    else{
      if($pw_now1 != $pw_now2){
        alert('两次密码不相同,请检查!',"#");}
      else{
        $sql = "UPDATE  `ksxt`.`user` SET  `password`='$pw_now2' where `id`='$userid'";
          $con=mysql_query($sql,$con_link); 
          if(!$con) die('失败!');
          else {
            alert("修改成功,请重新登录!","login.php");
            session_unset();
            session_destroy();
          }
      }
    }
  }
  }  


?>
<title><?php echo $username;?></title>
</head>

<body class="mdui-theme-accent-deep-orange  mdui-appbar-with-toolbar">

  <!-- Fixed navbar -->
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
         <a type="button" class="navbar-toggle collapsed"  href="../">
                    <span class="glyphicon glyphicon-arrow-left"></span>
                </a>
                <a class="navbar-brand" href="javascript:void(0);">个人中心</a>
            </div>
      <div class="collapse navbar-collapse navbar-right">
        <a class="navbar-brand" href="../">返回</a>
      </div>

      <!-- Nav tabs -->
    </div>
  </nav>

<div class="mdui-container">
   <div class="mdui-panel" mdui-panel>


   <div class="mdui-panel-item">
    <div class="mdui-panel-item-header">
     <div class="mdui-panel-item-title">姓名</div>
      <div class="mdui-panel-item-summary"> <?php echo $username;?> </div>
    </div>
  </div>
 
   <div class="mdui-panel-item">
    <div class="mdui-panel-item-header">
     <div class="mdui-panel-item-title">学号</div>
      <div class="mdui-panel-item-summary"> <?php echo $userid;?> </div>
    </div>
  </div> 

  <div class="mdui-panel-item">
    <div class="mdui-panel-item-header">
    <div class="mdui-panel-item-title">邮箱</div>
    <div class="mdui-panel-item-summary"> <?php echo select('user',array("email" => ""),$userid)['email']; ?> </div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
    <div class="mdui-panel-item-body">
      <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">New Email</label>
        <input class="mdui-textfield-input" type="email" required/>
        <div class="mdui-textfield-error">邮箱格式错误</div>
      </div>
    <div class="mdui-panel-item-actions">
        <button class="mdui-btn mdui-ripple mdui-color-theme-accent" mdui-panel-item-close>cancel</button>
        <button class="mdui-btn mdui-ripple mdui-color-theme-accent">save</button>
    </div>
    </div>
  </div>

    <div class="mdui-panel-item">
    <div class="mdui-panel-item-header"><div class="mdui-panel-item-title" style="float: right;"><i class="mdui-icon material-icons">content_paste</i></div>
    <div class="mdui-panel-item-summary">我的成绩</div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
    <div class="mdui-panel-item-body">
<?php 
  $con_link = mysql_connect($sql_db->host,$sql_db->user,$sql_db->pwd);
  mysql_query("set names utf8"); 
  mysql_select_db($sql_db->db); 
	$sql="select * from test_pape where userid='$userid'";//查询xsxx表
	$res=mysql_query($sql,$con_link);
?>
<table   class="mdui-table mdui-table-hoverable" >
  <tr  class="mdui-shadow-2">
    <td>科目</td>
    <td>考试名称</td>
    <td>考试时间</td>
    <td>客观题分数</td>
    <td>总分</td>
    <td>查看试卷</td>
  </tr>
 <?php 
    if(mysql_num_rows($res) == 0){
        echo '<tr class="mdui-shadow-2"><td colspan="4">还没有考试！</td></tr>';
    }else{
    while($info=mysql_fetch_assoc($res)){
  ?><tr>
    <?php 
      $starttime =  date('Y/m/d H:i',strtotime($info['starttime']));
      $endtime =  date('H:i',strtotime($info['endtime']));
     ?>
    <td><?php echo $info['curriculum'] ?></td>
    <td><?php echo $info['title'] ?></td>
    <td ><?php echo $starttime; ?>-<?php echo $endtime; ?></td>
    <td><?php  
    $sql = "SELECT * FROM  `test_manage` WHERE  `userid` = '$userid' and `title` = '".$info['title']."'"; 
    $result=mysql_query($sql,$con_link);
    if(mysql_num_rows($result) == 0){
      $objectivescore = '还未批改吧';
      $totalscore = '还未批改吧';
    }else {
      $testInfo = mysql_fetch_assoc($result);
      $objectivescore = $testInfo['objectivescore'];
      $totalscore =  $testInfo['totalscore'];
    }
    echo  $objectivescore;?></td>
    <td><?php echo $totalscore; ?></td>
    <td><a <?php if(mysql_num_rows($result) != 0){?> href="myTest.php?id=<?php echo $info['id'];?>"<?php }?>><i class="mdui-icon material-icons">loop</i></a></td>
    </tr>
  <?php }}?>
  </table>
    </div>
  </div>
  
  <div class="mdui-panel-item">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title"><i class="mdui-icon material-icons">lock</i></div>
    <div class="mdui-panel-item-summary">修改密码</div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
    <div class="mdui-panel-item-body">
       <form action="index.php" method="post">
       <div class="mdui-textfield mdui-textfield-floating-label">
        <i class="mdui-icon material-icons">lock</i>
        <label class="mdui-textfield-label">原密码：</label>
        <input name='pw_old'  class="mdui-textfield-input" type="password" pattern="^.*(?=.{6,}).*$" required/>
        <div class="mdui-textfield-error">密码至少 6 位</div>
      </div>
      <div class="mdui-textfield mdui-textfield-floating-label">
        <i class="mdui-icon material-icons">lock</i>
        <label class="mdui-textfield-label">新密码：</label>
        <input name='pw_now1'  class="mdui-textfield-input" type="password" pattern="^.*(?=.{6,}).*$" required/>
        <div class="mdui-textfield-error">密码至少 6 位</div>
      </div>
      <div class="mdui-textfield mdui-textfield-floating-label">
        <i class="mdui-icon material-icons">lock</i>
        <label class="mdui-textfield-label">再输一次:</label>
        <input name='pw_now2'  class="mdui-textfield-input" type="password" pattern="^.*(?=.{6,}).*$" required/>
        <div class="mdui-textfield-error">密码至少 6 位</div>
      </div>
       <!-- </form> -->
    <div class="mdui-panel-item-actions">
        <button type="reset" class="mdui-btn mdui-ripple mdui-color-theme-accent" mdui-panel-item-close>cancel</button>
        <button type='sbumit' id="btn2" class="mdui-btn mdui-ripple mdui-color-theme-accent">save</button>
    </div></form>
    </div>
  </div>
  <div class="mdui-panel-item ">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title">注册时间</div>
        <div class="mdui-panel-item-summary"> <?php echo select('user',array("date" => ""),$userid)['date']; ?>  </div>
          <i class="mdui-icon material-icons">access_time</i>
    </div>
  </div><a onclick="exit()">
  <div  class="mdui-panel-item mdui-hoverable">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title"><i class="mdui-icon material-icons">&#xe879;</i></div>
      <div class="mdui-panel-item-summary">退出登录</div>
      <i class="mdui-icon material-icons">&#xe5c4;</i>
    </div>
  </div></a>
</div>
</div>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="in_img.js"></script>
<script type="text/javascript">
function exit(){
  window.location.href="../?exit";
}
function new_con(){
  window.location.href="../new.php";
}
$(document).ready(function(){
  $("#subimt").click(function(){
    $("#form1").submit();
});  
});
</script>
</body>
</html>