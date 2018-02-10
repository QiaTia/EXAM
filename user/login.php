<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
<?php 
include "../sql/Bootstrap.php";
?>
<title>登录</title>
<style type="text/css">
body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
<script type="text/javascript">
  $(document).ready(function(){
      $("#btn_submit").click(function(){
        if ($("input[name='name']").val().length < 3)  alert("账号格式不符合标准！");
        if($("input[name='pw']").val().length < 6) alert("密码长度不符合标准！");
        else{
        $.post("ajax_login.php",
          {
            name:$("input[name='name']").val(),
            pw:$("input[name='pw']").val(),
            cookie:$("input[name='cookie']").val()
          },
          function(data,status){
            if(data != 0) alert(data);
            else {
              location.href="../";
            }
            });
      }
      });
    });
</script>
  </head>

  <body>

    <div class="container">
      <div class="form-signin">
        <h2 class="form-signin-heading" style="line-height:3em; margin-bottom:10px;">请登录</h2>
        <div class="form-group input-group">
          <span class="input-group-addon" style="height:44px;"><a class="glyphicon glyphicon-user"></a></span>
          <label class="sr-only">学号/教师号/管理员账号</label>
          <input name="name" type="text"  class="form-control" placeholder="学号/教师号/管理员账号" required autofocus>
        </div>
        <div class="form-group input-group">
          <span class="input-group-addon" style="height:44px;"><a class="glyphicon glyphicon-lock"></a></span>
          <label class="sr-only">密码</label>
          <input name="pw" type="password" class="form-control" placeholder="密码" required>
        </div>
        <div class="form-group checkbox">
          <label>
            <input name="cookie" type="checkbox" value="remember-me"> 记住密码
          </label>
        </div>
        <div class="form-group">
          <button id="btn_submit" class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
          <a href="../" class="btn btn-lg btn-primary btn-block">取消</a>
        </div>
      </div>

    </div> <!-- /container -->
  </body>
</html>
