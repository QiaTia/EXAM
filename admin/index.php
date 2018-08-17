<?php
    include('admin_check.php');
    snackbar('欢迎回来,'.$username);
?>
<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <link rel="icon" type="image/png" href="../images/time.png">
  <link rel="stylesheet" href="//cdn.90so.net/layui/2.2.6/css/layui.css"  media="all">
  <title>考试系统-后台管理中心</title>
  <style type="text/css">
    *{padding: 0;margin: 0}
    body{position:relative;}
    .nav-side{overflow-y:auto;position: absolute; top:0;left:0;min-width:60px;width:220px;height:100vh;background-color: #20222A}
    .admin{position: absolute;top:0;left:220px;height:100vh;width: calc(100vw - 220px);position:relative; display: block}
    .nav-side,.admin{transition:All .3s ease-in-out}
    .nav-appbar{position:absolute;top:0;height: 50px;width: 100%;background-color: #393D49;line-height: 50px}
    .admin-body{position:absolute;top:50px;width: 100%;background-color:#eee;height: calc(100vh - 50px)}
    #iframe1{width:calc(100% - 1rem);height:calc(100% - 1.2rem); border-width:0px;padding: .5rem}
    .layui-icon,.mdui-icon,a{color:#DDD}.layui-icon{font-size:1.5rem}
    a:hover>.layui-icon{color: #FF4081}
    .meun-toggle{padding-left:3rem}
    .nav-side>li,.nav-side>li>a{line-height: 50px}
    .nav-side>li{font-size: 1rem;overflow-x:hidden;overflow-y:auto;white-space:nowrap;transition:All .3s ease}
    .collapse{margin-left: 1rem}
    .nav-side>li>a{padding-left:1rem}
    .nav-side>li>a>i{margin-right:1rem}
    .nav-side>li:hover{border-left:solid #FF4081 5px}
    li:hover{background-color:#181C2A}
    .nav-right{float:right;line-height:50px;height:50px;margin-right:1.5rem}
    .nav-right>li{float:left;list-style:none;padding:0 .7rem}
    .nav-right>li:hover{border-top:solid #FF4081 3px;background-color:#2B3249}
    ::selection{ background: rgba(255,40,81,.5); color: #fff}
    #note>textarea{font-size: 1.1rem;color: #333}
  </style>
 </head>
<body>
<!-- 侧边栏 -->
  <ul class="nav-side" mdui-collapse="{accordion: true}">
    <li><a href="javascript:;"><img src="../images/time.png" alt="icon" width="26" height="26"><span>&nbsp;后台管理中心</span></a></li>
    <li><a href="javascript:onframe('admin');"><i class="layui-icon">&#xe68e;</i><span>主页</span></a></li>
    <hr class="layui-bg-green">

    <li><a href="javascript:meunToggle();">
      <i class="mdui-list-item-icon mdui-icon material-icons">people</i> 
      <span> 用户管理<i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i></span>
    </a>
  </li>
      <!-- 学生 管理 -->
    <ul class="collapse">
      <li class="mdui-list-item mdui-ripple">
        <a href="javascript:onframe('user_admin');">
        <div class="mdui-list-item-content">教师查看</div></a>
      </li>
      <li class="mdui-list-item mdui-ripple">
        <a href="javascript:onframe('student_admin');">
        <div class="mdui-list-item-content">学生管理</div></a>
      </li>
      <li class="mdui-list-item mdui-ripple">
        <a href="javascript:onframe('class_admin');">
        <div class="mdui-list-item-content">班级管理</div></a>
      </li>
      <li class="mdui-list-item mdui-ripple">
        <a href="javascript:onframe('student_new');">
        <div class="mdui-list-item-content">添加学生</div></a>
      </li>
    </ul>

  <hr class="layui-bg-green">
    <li><a href="javascript:meunToggle();"><i class="mdui-list-item-icon mdui-icon material-icons">error</i><span>教师管理<i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i></span></a></li>
    <!-- 发布考试 试卷管理 阅卷中心 -->
    <ul class="collapse">
      <li class="mdui-list-item mdui-ripple">
        <a href="javascript:onframe('test/testNew');">
        <div class="mdui-list-item-content">发布考试</div></a>
      </li>
      <li class="mdui-list-item mdui-ripple">
        <a href="javascript:onframe('test/testAdmin');">
        <div class="mdui-list-item-content">试卷管理</div></a>
      </li>
      <li class="mdui-list-item mdui-ripple">
        <a href="javascript:onframe('marking_admin');">
        <div class="mdui-list-item-content">阅卷中心</div></a>
      </li>
    </ul>

  <hr class="layui-bg-green">
    <li><a href="javascript:meunToggle();"><i class="mdui-list-item-icon mdui-icon material-icons">&#xe1bd;</i><span>试题管理<i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i></span></a></li>
    <!-- 试题新建 编辑 删除操作 --> 
    <ul class="collapse">
      <li class="mdui-list-item mdui-ripple" mdui-menu="{target: '#newTest'}"><a href="javascript:;">新建题目<i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i></a></li>
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
      <li class="mdui-list-item mdui-ripple">
        <a href="javascript:onframe('cate');">
        <div class="mdui-list-item-content">科目管理</div></a>
      </li> 
      <li class="mdui-list-item mdui-ripple">
        <a href="javascript:onframe('radio_admin');">
        <div class="mdui-list-item-content">单选题管理</div></a>
      </li>
      <li class="mdui-list-item mdui-ripple">
        <a href="javascript:onframe('checkbox_admin');">
        <div class="mdui-list-item-content">多选题管理</div></a>
      </li>
      <li class="mdui-list-item mdui-ripple">
        <a href="javascript:onframe('judge_admin');">
        <div class="mdui-list-item-content">判断选题管理</div></a>
      </li>
      <li class="mdui-list-item mdui-ripple">
        <a href="javascript:onframe('fill_admin');">
        <div class="mdui-list-item-content">填空题管理</div></a>
      </li>
      <li class="mdui-list-item mdui-ripple">
        <a href="javascript:onframe('saq_admin');">
        <div class="mdui-list-item-content">简答题管理</div></a>
      </li>
    </ul>

  <hr class="layui-bg-green">
  <li><a href="http://qiatia.cn/content.php?i=31#reply" target="_blank"><i class="mdui-list-item-icon mdui-icon material-icons">feedback</i><span>我要反馈？</span></a></li>
</ul>
<!-- 右边内容栏目 -->
  <div class="admin">
    <!-- 顶部导航栏 -->
    <div class="nav-appbar">
      <a href="javascript:meunToggle();" class="meun-toggle"><i class="layui-icon">&#xe668;</i></a>
      <ul class="nav-right">
        <li><a href="javascript:note();"><i class="layui-icon">&#xe66e;</i></a></li>
        <li><a href="javascript:Fullscreen();"><i class="layui-icon">&#xe638;</i></a></li>
        <li><a href="javascript:closeTag();"><i class="layui-icon">&#x1006;</i></a></li>
      </ul>
      <div class="nav-right">
        <div id="tp-weather-widget"></div>
                <script>(function(T,h,i,n,k,P,a,g,e){g=function(){P=h.createElement(i); a=h.getElementsByTagName(i)[0];P.src=k;P.charset="utf-8";P.async=1;a.parentNode.insertBefore(P,a)};T["ThinkPageWeatherWidgetObject"]=n;T[n]||(T[n]=function(){(T[n].q=T[n].q||[]).push(arguments)});T[n].l=+new Date();if(T.attachEvent){T.attachEvent("onload",g)}else{T.addEventListener("load",g,false)}}(window,document,"script","tpwidget","//widget.seniverse.com/widget/chameleon.js"));tpwidget("init", {"flavor": "slim","location": "WX4FBXXFKE4F","geolocation": "enabled","language": "zh-chs","unit": "c","theme": "chameleon","container": "tp-weather-widget","bubble": "disabled","alarmType": "badge","color": "#FFFFFF","uid": "U9EC08A15F","hash": "039da28f5581f4bcb5c799fb4cdfb673"});tpwidget("show");</script>
           </div>
    </div>
    <!-- 内容布局 -->
  <div class="admin-body">
     <iframe src="admin.php" name="iframe1" id="iframe1"></iframe>
   </div>
</div>
  <div id="note" style="display: none">
    <textarea style="min-width: 350px;min-height: 150px;border:none;">在这里输入你需要处理的内容，下次打开内容还会存在哟~</textarea>
  </div>
  <script src="//libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
  <script src="//cdn.90so.net/layui/2.2.6/layui.js " charset="utf-8"></script>
  <script type="text/javascript">
    var meun = 0
      ,rame = getQueryString('rame')
      ,fullscreenEnabled = 1
      ,layer;
    layui.use('layer', function(){
        layer = layui.layer;
        layer.msg('hello!欢迎来到EXAM后台管理中心！');
      });
      if(rame!=null) onframe(rame);
    function meunToggle() {
      if(!meun){
        $('.nav-side').width(60);
        $('.admin').css({'left':'60px','width':'calc(100vw - 60px)'});
        $('.meun-toggle > i').html('&#xe66b;');
        $('.nav-side>li>a>span').hide();
        $('.collapse').hide();
        meun = 1;
      }else{
        $('.nav-side').width(220);
        $('.admin').css({'left':'220px','width':'calc(100vw - 220px)'});
        $('.meun-toggle > i').html('&#xe668;');
        $('.nav-side>li>a>span').show();
        $('.collapse').show();
        meun = 0;
      }
      return 0;
    }
    function onframe(link){
      window.frames["iframe1"].location.href=link+".php";
      meun = 1;
      meunToggle();
      return 0;
    }
    function onframe2(link){
      window.frames["iframe1"].location.href=link;
      return 0;
    }
    function launchFullscreen(element) {
      if(element.requestFullscreen) {
        element.requestFullscreen();
      } else if(element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
      } else if(element.webkitRequestFullscreen) {
        element.webkitRequestFullscreen();
      } else if(element.msRequestFullscreen) {
        element.msRequestFullscreen();
      }
      return 1;
    }
    function exitFullscreen() {
      if(document.exitFullscreen) {
          document.exitFullscreen();
      } else if(document.mozCancelFullScreen) {
         document.mozCancelFullScreen();
      } else if(document.webkitExitFullscreen) {
          document.webkitExitFullscreen();
      }
      return 0;
    }
    function Fullscreen() {
      if(fullscreenEnabled){
        launchFullscreen(document.documentElement);
        fullscreenEnabled = 0;
      } else{
        exitFullscreen();
        fullscreenEnabled = 1;
      }
    }
    function closeTag() {
      window.history.back(-1);
      window.location.href='../';
    }
    function getQueryString(name) { 
      var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
      var r = window.location.search.substr(1).match(reg); 
      if (r != null) return unescape(r[2]); return null; 
    }
    function note() {
      layer.open({
        type: 1,
        title:'便戈',
        shadeClose:true,
        resize:false,
        content: $('#note') //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
      });
    }
    $(document).ready(function(){
      var msg=localStorage.note;
      console.log(msg)
      if(msg!='') $('#note>textarea').val(msg);
      $('#note>textarea').blur(function(){
        localStorage.note = $('#note>textarea').val();
      })
    });
  </script>
</body>
</html>
