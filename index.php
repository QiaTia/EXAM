<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/index.css">
    <link rel="icon" type="image/png" href="images/time.png">
    <link type="text/css" rel="stylesheet" href="css/mobile_date.css">
	<title>考试系统</title>
      <?php  
        include_once "sql/Bootstrap.php";
        include_once 'sql/eSql.php';
        $eSql = new eSql();
       SESSION_start();
       if (isset($_REQUEST['exit'])) {
        session_unset();
        session_destroy();
        // snackbar('ok');
            }
	?>
</head>
<body>
	<!-- Fixed navbar -->
	<nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">考试系统</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                    <li><a href="./">首页</a>
                    </li>
                    <li><a href="about/about.php">关于</a>
                    </li>
                    <li class="dropdown">
                    <?php
                     if(!isset($_SESSION['userinfo'])){?>
                        <a href="user/login.php">登录</a>
                        <?php } 
                         else{?>
                             <a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['userinfo'];?>
                             <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        <?php 
                            if($_SESSION['vip'] >=9){
                                ?><li><a href="admin/">后台管理</a></li>
                           <?php }
                        ?>
                        <li><a href="./user">个人中心</a>
                        </li>
                        <li>   <a href="index.php?exit">退出登录</a>                     
                        </li>
                        </ul><?php }?>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">
    <div class="col-md-8"  style="margin-top:50px;">
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Examination</h1>
        <?php
          if(!isset($_SESSION['userinfo']))
          {?> 
            <p>我们的考试系统是服务于本校学生,暂不开放注册</p>
            <p>如果你是本校学校,那</p>
            <p>
              <a class="btn btn-lg btn-primary" href="user/login.php" role="button">请先登录 &raquo;</a>
            </p>
            <?php } 
          else{
            $userid = $_SESSION['userid'];
            $class = $eSql->sqlSelect('user',$userid)['class'];
            $con_link = mysql_connect($host,$user,$pwd);
            mysql_query('set names utf8'); 
            mysql_select_db($GLOBALS['db']); 
            $sql = "select * from test";
            $result = mysql_query($sql,$con_link);
            while ($info = mysql_fetch_assoc($result)){
              if(in_array($class,explode(',',$info['class']))){
            ?>
            <p><a class="btn btn-lg btn-primary" href="examLoad.php?id=<?php echo $info['id'];?>" role="button"><?php echo $info['title'];?> &raquo;</a></p><br>
            <?php }}} ?>
       </div>
     </div>
     <div class="col-md-4" style="margin-top:50px;">
       <div class="box">
        <section class="date">
            <div class="head">
                <div class="prev">上一月</div>
                <div class="tomon"><span class="year"></span>年 <span class="month"></span>月</div>
                <div class="next">下一月</div>
            </div>
            <ol><li>周日</li><li>周一</li><li>周二</li><li>周三</li><li>周四</li><li>周五</li><li>周六</li></ol>
            <ul>
                <li>日期</li><li>日期</li><li>日期</li><li>日期</li><li>日期</li><li>日期</li><li>日期</li>
                <li>日期</li><li>日期</li><li>日期</li><li>日期</li>
            </ul>
        </section>
    </div>
    <script type="text/javascript" src="js/mobile_date.js"></script>
  </div>
       <hr>
    </div> 
    <!-- container -->
<div class="Copyright"> <span>Copyright © 2017-12 <a href="http://www.QiaTia.top">QiaTia</a> <a href="http://www.timecost.top">iTime</a></span> </div>
</body>
</html>