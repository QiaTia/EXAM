<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <link rel="icon" type="image/png" href="../images/time.png">
  <title>考试系统-后台管理中心</title>
  <style type="text/css">
    #iframe1{
      width: 100%;
      border: none; 
    }
  </style>
  <script src="http://cdn.static.runoob.com/libs/jquery/1.10.2/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#iframe1").css("height", 0.89*$(window).height() );
    });
    $(window).resize(function(){
      $("#iframe1").css("height", 0.89*$(window).height() );
    });
    function onframe(link){
      window.frames["iframe1"].location.href=link+".php";
    }
    function onframe2(link){
      window.frames["iframe1"].location.href=link;
    }
  </script>
  <?php
    include('admin_check.php');
    snackbar('欢迎回来,'.$username);
  ?>
 </head>
<body  class="mdui-drawer-body-left mdui-appbar-with-toolbar">
<div class="mdui-appbar mdui-appbar-fixed">
<div class="mdui-toolbar mdui-color-theme">
  <a href="javascript:;" class="mdui-btn mdui-btn-icon" mdui-drawer="{target: '#drawer'}"><i class="mdui-icon material-icons">menu</i></a>
  <span class="mdui-typo-title">欢迎管理员 <?php echo $username;?></span>
  <div class="mdui-toolbar-spacer"></div>
  <a href="javascript:;" class="mdui-btn mdui-btn-icon" mdui-menu="{target: '#btn_meun'}"><i class="mdui-icon material-icons">&#xe5d4;</i></a>
  <ul class="mdui-menu"  id="btn_meun" >
    <li class="mdui-menu-item">
      <a href="./" class="mdui-ripple">
        <i class="mdui-menu-item-icon mdui-icon material-icons">refresh</i>刷新一下
      </a>
    </li>
    <li class="mdui-divider"></li>
    <li class="mdui-menu-item">
      <a href="../" class="mdui-ripple">
        <i class="mdui-menu-item-icon mdui-icon material-icons">&#xe88a;</i>回到主页
      </a>
    </li>
  </ul>
</div>
</div>
<div id="drawer" class="mdui-drawer"> 
  <ul class="mdui-list">
    <li class="mdui-subheader">
      <i class="mdui-list-item-icon mdui-icon material-icons">star</i>管理中心</li>
    <a href="javascript:void(0);" onclick="onframe('admin')">
    <li class="mdui-list-item mdui-ripple">
      <div class="mdui-list-item-content">主页</div>
    </li></a>
    <li class="mdui-subheader">
      <i class="mdui-list-item-icon mdui-icon material-icons">&#xe051;</i> 用户管理</li>
    <!-- 学生 管理 -->

   <a onclick="onframe('user_admin')" href="javascript:void(0);" ;>
    <li class="mdui-list-item mdui-ripple">
      <div class="mdui-list-item-content">教师查看</div>
    </li></a>
    <a onclick="onframe('student_admin')" href="javascript:void(0);" ;>
    <li class="mdui-list-item mdui-ripple">
      <div class="mdui-list-item-content">学生管理</div>
    </li></a>
    <a onclick="onframe('class_admin')" href="javascript:void(0);" ;>
    <li class="mdui-list-item mdui-ripple">
      <div class="mdui-list-item-content">班级管理</div>
    </li></a>
    <a onclick="onframe('student_new')" href="javascript:void(0);" ;>
    <li class="mdui-list-item mdui-ripple">
      <div class="mdui-list-item-content">添加学生</div>
    </li></a>
    <li class="mdui-subheader"><i class="mdui-list-item-icon mdui-icon material-icons">error</i>教师管理</li>
    <!-- 发布考试 试卷管理 阅卷中心 -->
    <a onclick="onframe('test/testNew')" href="javascript:void(0);" ;>
    <li class="mdui-list-item mdui-ripple">
      <div class="mdui-list-item-content">发布考试</div>
    </li></a>
    <a onclick="onframe('test/testAdmin')" href="javascript:void(0);" ;>
    <li class="mdui-list-item mdui-ripple">
      <div class="mdui-list-item-content">试卷管理</div>
    </li></a>
    <a onclick="onframe('marking_admin')" href="javascript:void(0);" ;>
    <li class="mdui-list-item mdui-ripple">
      <div class="mdui-list-item-content">阅卷中心</div>
    </li></a>

    <li class="mdui-subheader"><i class="mdui-list-item-icon mdui-icon material-icons">&#xe1bd;</i> 试题管理</li> 
    <!-- 试题新建 编辑 删除操作 --> 
    <li class="mdui-list-item mdui-ripple" mdui-menu="{target: '#newTest'}">新建题目<i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i></li>
    <ul class="mdui-menu mdui-menu-cascade" id="newTest">
      <li class="mdui-menu-item">
        <a onclick="onframe2('newTest.php?cate=radio')" class="mdui-ripple">新建单选题</a>
      </li>
      <li class="mdui-menu-item">
        <a onclick="onframe2('newTest.php?cate=checkbox')" class="mdui-ripple">新建多选题</a>
      </li>
      <li class="mdui-menu-item">
        <a onclick="onframe2('newTest.php?cate=judge');" class="mdui-ripple">新建判断题</a>
      </li>
      <li class="mdui-menu-item">
        <a onclick="onframe2('newTest.php?cate=fill')" class="mdui-ripple">新建填空题</a>
      </li>
      <li class="mdui-menu-item">
        <a onclick="onframe2('newTest.php?cate=saq')" class="mdui-ripple">新建简答题题</a>
      </li>
      <li class="mdui-divider"></li>
      <li class="mdui-menu-item">
        <a href="javascript:;" class="mdui-ripple">算了不建了</a>
      </li>
    </ul>
    <a onclick="onframe('cate')" href="javascript:void(0);">
    <li class="mdui-list-item mdui-ripple">
      <div class="mdui-list-item-content">科目管理</div>
    </li></a>
    <a onclick="onframe('radio_admin')" href="javascript:void(0);";>
    <li class="mdui-list-item mdui-ripple">
      <div class="mdui-list-item-content">单选题管理</div>
    </li></a>
    <a onclick="onframe('checkbox_admin')" href="javascript:void(0);";>
    <li class="mdui-list-item mdui-ripple">
      <div class="mdui-list-item-content">多选题管理</div>
    </li></a>
    <a onclick="onframe('judge_admin')" href="javascript:void(0);";>
    <li class="mdui-list-item mdui-ripple">
      <div class="mdui-list-item-content">判断选题管理</div>
    </li></a>
    <a onclick="onframe('fill_admin')" href="javascript:void(0);";>
    <li class="mdui-list-item mdui-ripple">
      <div class="mdui-list-item-content">填空题管理</div>
    </li></a>
    <a onclick="onframe('saq_admin')" href="javascript:void(0);";>
    <li class="mdui-list-item mdui-ripple">
      <div class="mdui-list-item-content">简答题管理</div>
    </li></a>

    <li class="mdui-subheader">
      <i class="mdui-list-item-icon mdui-icon material-icons">feedback</i> FeedBack</li>
    <a href="#">
    <li class="mdui-list-item mdui-ripple">
      <div class="mdui-list-item-content">我要反馈？</div>
    </li></a>
  </ul>
</div>
<div  class="mdui-container-fluid"  >
   <iframe src="admin.php" name="iframe1" id="iframe1">
</div>

</body>
</html>
