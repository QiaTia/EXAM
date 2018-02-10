<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>后台管理中心</title>
 </head>
<body  class="mdui-theme-primary-indigo" style="padding-top: 20px;">
<?php
    include('admin_check.php');
	  if(isset($_REQUEST["del"])) {
      $del=$_REQUEST["del"];
      $sql = "delete from user where id = '$del'";
			//执行
			$result = mysql_query($sql);
			 if(!$result) echo "删除失败！";
	  }
    if(isset($_REQUEST["refresh"])) {
      $del=$_REQUEST["refresh"];
      $sql = "UPDATE `user` SET  `password`= 'e10adc3949ba59abbe56e057f20f883e' WHERE `id` = '$del'";
      //执行
      $result = mysql_query($sql);
       if(!$result) die ("重置失败！");
    }
    $perNumber=30;
    $count=mysql_query("select * from user where vip = 1"); //获得记录总数  
    $totalNumber=mysql_num_rows($count);//获取数据库长度 
    $totalPage=ceil($totalNumber/$perNumber); //计算出总页数 
    if (isset($_GET['page'])) $page=$_GET['page']; //如果没有值,则赋值1  
    else $page= 1;//获得当前的页面值  
    $startCount=($page-1)*$perNumber; //分页开始,根据此方法计算出开始的记录  
	  if(isset($_REQUEST['cx'])){  
      $cx=$_REQUEST['cx'];
      $totalPage=1;
	  	$sql="select * from user  WHERE  `name` LIKE  '%$cx%'AND `vip` =1";//
    }
	  else
	     $sql="select * from user where vip = 1 limit $startCount,$perNumber";//查询xsxx表
	$res=mysql_query($sql,$con_link);
	$num=mysql_num_rows($res);//获取数据库长度
?>
<div class="">
    <div class="mdui-textfield mdui-textfield-expandable mdui-float-right">
        <button class="mdui-textfield-icon mdui-btn mdui-btn-icon" mdui-tooltip="{content: '输入学生姓名'}">
         <i class="mdui-icon material-icons">search</i></button>  
     <form name="form1" method="post" action="">
            <input name="cx"  class="mdui-textfield-input" type="text"  placeholder="用户名"/>
      <input type="submit" value="text" style="display:none;" />
       </form>
                   <button class="mdui-textfield-close mdui-btn mdui-btn-icon">
           <i class="mdui-icon material-icons">close</i>
            </button>
    </div>
<table   class="mdui-table mdui-table-hoverable" >
  <tr  class="mdui-shadow-2">
    <td>学号</td>
    <td>班级</td>
    <td>姓名</td>
    <td>性别</td>
    <td>最后一次登录时间</td>
		<td>操作</td>
   </tr>
 <?php 
        while( $info=mysql_fetch_assoc($res)){
	     
  ?><tr>
    <td><?php echo $info['id'] ?></td>
    <td><?php echo $info['class'] ?></td>
    <td><?php echo $info['name'] ?></td>
    <td><?php  echo $info['sex']?"男":"女";?></td>
    <td><?php echo $info['login_date'] ?></td>
    <td> 
      <a  onclick="return confirm('确定删除么')" href="student_admin.php?del=<?php echo $info['id']?>" class="mdui-btn mdui-btn-icon mdui-text-color-red"><i class="mdui-icon material-icons">&#xe14c;</i></a>
      <a  onclick="return confirm('重置改学生密码为123456么？')" href="student_admin.php?refresh=<?php echo $info['id']?>" class="mdui-btn mdui-btn-icon mdui-text-color-red"><i class="mdui-icon material-icons">refresh</i></a>
    </td>
      </tr>
  <?php }?>
  </table>
  
<!--分页显示块-->
<div class="mdui-typo" style="margin-bottom: 20px;">
 <?php if ($page != 1) { //页数不等于1  ?> 
  <a class="mdui-typo-title-opacity" href="student_admin.php?page=<?php echo $page - 1;?>">上一页</a> <!--显示上一页-->  
<?php  
}  
if ($totalPage > 2) { 
for ($i=1;$i<=$totalPage;$i++) {  //循环显示出页面  
  if($page == $i){ ?> <span class="mdui-typo-title-opacity"><?php echo $i ;?></span>   <?php continue; } 
?>  
<a class="mdui-typo-title-opacity" href="student_admin.php?page=<?php echo $i;?>"><?php echo $i ;?></a>  
<?php  
} 
} 
if ($page<$totalPage) { //如果page小于总页数,显示下一页链接  
?>  
<a class="mdui-typo-title-opacity" href="student_admin.php?page=<?php echo $page + 1;?>">下一页</a>  
<?php  
}   
?>  
</div> 
<!--分页显示块结束-->
  
</div>
</body>
</html>
