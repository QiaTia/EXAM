<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php 
	include_once 'tinkphp.php';
	include_once '../sql/Bootstrap.php';
	if(!isset($_REQUEST['cate'])) 
		alert("请先选择题型","./");
	$cate = $_REQUEST['cate'];
	?>
	<title>新建题目</title>
</head>
<body>
<div class="mdui-container">
	<div class="mdui-textfield mdui-textfield-floating-label">
		<label class="mdui-textfield-label">请输入题目标题</label>
		<textarea name="title" class="mdui-textfield-input" maxlength="3200"></textarea>
	</div>
	<div class="mdui-row"> 
        <div class="mdui-col-xs-4">
            <label class="mdui-textfield-label">选择科目:</label>
            <select name="cate" class="mdui-select" mdui-select>
                <?php
                    include_once '../sql/sql2.php';
                    $sql="select * from curriculum";//查询表
                    $res=mysql_query($sql,$con_link);
                    while ($info = mysql_fetch_assoc($res)) {
                ?>
                    <option value="<?php echo $info['name']; ?>"><?php echo $info['name']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <label class="mdui-textfield-label">选项答案区域</label>
	<?php switch ($cate) {
		//单选题
		case 'radio':
			# code...
		?>
	<div class="col-lg-6  form-signin rows">
		 <div class="form-group input-group">
		 	<span class="input-group-addon">
		 		<input type="radio" name="anwers" value="1">
		 	</span>
		 	<input type="text" name="option" class="form-control" placeholder="选项1">
		 </div><!-- /input-group -->
		 <div class="form-group input-group">
		 	<span class="input-group-addon">
		 		<input type="radio" name="anwers"  value="2">
		 	</span>
		 	<input type="text" name="option" class="form-control" placeholder="选项2">
		 </div><!-- /input-group -->
		 <div class="form-group input-group">
		 	<span class="input-group-addon">
		 		<input type="radio" name="anwers"  value="3">
		 	</span>
		 	<input type="text" name="option" class="form-control" placeholder="选项3">
		 </div><!-- /input-group -->
		<button onclick="append('radio')" class="btn btn-default"><i class="mdui-icon material-icons">add</i>新增选项</button>
	</div>
		<?php
			break;
		//多选题
		case 'checkbox':
			# code...
		?>
	<div class="col-lg-6  form-signin">
		 <div class="form-group input-group">
		 	<span class="input-group-addon">
		 		<input type="checkbox" name="anwers"  value="1">
		 	</span>
		 	<input type="text" name="option" class="form-control" placeholder="选项1">
		 </div><!-- /input-group -->
		 <div class="form-group input-group">
		 	<span class="input-group-addon">
		 		<input type="checkbox" name="anwers"  value="2">
		 	</span>
		 	<input type="text" name="option" class="form-control" placeholder="选项2">
		 </div><!-- /input-group -->
		 <div class="form-group input-group">
		 	<span class="input-group-addon">
		 		<input type="checkbox" name="anwers"  value="3">
		 	</span>
		 	<input type="text" name="option" class="form-control" placeholder="选项3">
		 </div><!-- /input-group -->

		 <button onclick="append('checkbox')" class="btn btn-default"><i class="mdui-icon material-icons">add</i>新增选项</button>
	</div>
		<?php
			break;
		//判断题
		case 'judge':
			# code...
		?>
		<div class="form-signin">
			<label  class="mdui-radio">	
				<input type="radio" class="option" name="option" value="1" checked>
				<i class="mdui-radio-icon"></i>正确 
			</label>
			<label  class="mdui-radio">	</label>
			<label  class="mdui-radio">	
				<input type="radio" class="option" name="option" value="0">
				<i class="mdui-radio-icon"></i> 错误
			</label>
		</div>
		<?php
			break;
		//填空题
		case 'fill':
			# code...
		?>
	<div class="col-lg-6  form-signin">
		 <div class="form-group input-group">
		 	<div class="input-group-addon">1</div>
		 	<input type="text" name="option" class="form-control" placeholder="项目1">
		 </div><!-- /input-group -->
		 <button onclick="append('fill')" class="btn btn-default"><i class="mdui-icon material-icons">add</i>新增选项</button>
	</div>
		<?php
			break;
		//简答题
		case 'saq':
			# code...
		?>
	<div class="form-signin">
		<textarea class="form-control option" name="option"  rows="5"  placeholder="请输入参考答案，可为空" style="height: 100%;"></textarea>
	</div>
		<?php
			break;
		
		default:
			# code...
			break;
	}?>
<div class="row col-xs-12 btn-group" style="margin-top: 20px;">
	 <a onclick="submit()" class="btn btn-default col-xs-6">
	 	<i class="mdui-menu-item-icon mdui-icon material-icons">check</i>
  		完成保存
  	 </a>
  	 <a class="btn btn-default col-xs-6" href="javascript:history.go(-1);">
	 	<i class="mdui-menu-item-icon mdui-icon material-icons">clear</i>
  		算了不弄了
  	 </a>
</div>
</div>
<script type="text/javascript">
	var i=4,
	    j=2;
	function append(cate){
		if(cate == 'radio')
			$("button").before('<div class="form-group input-group"><span class="input-group-addon"><input type="radio" name="anwers"  value="'+i+'"></span><input type="text" name="option" class="form-control" placeholder="选项'+i+'"></div>');
		if(cate == 'checkbox') 
			$("button").before('<div class="form-group input-group"><span class="input-group-addon"><input type="checkbox" name="anwers"  value="'+i+'"></span><input type="text" name="option" class="form-control" placeholder="选项'+i+'"></div>');
		if(i >= 9) $("button").hide();
		if(cate == 'fill'){
			$("button").before('<div class="form-group input-group"><div class="input-group-addon">'+j+'</div><input type="text"name="option" class="form-control"placeholder="项目'+j+'"></div>');
			if(j >= 3) $("button").hide();
			j++;
		}
		i++;
	}
	function  submit(){
		var cate = '<?php echo $cate;?>',
		    title =$('textarea[name="title"]').val(),
		    option,
		    anwers;
		switch(cate)
		{
			case 'radio':
			   var val= new Array();
			   var selects = document.getElementsByName("option");
			   for(var i = 0; i < selects.length; i++){
			   	val.push(selects[i].value);
			   }
			   option=val;
			   anwer = $("input[name='anwers']:checked").val();
			   anwers=val[anwer-1];
			   break;
			case 'checkbox':
			   var val= new Array();
			   var selects = document.getElementsByName("option");
			   for(var i = 0; i < selects.length; i++){
			   	val.push(selects[i].value);
			   }
			   var option = document.getElementsByName('anwers');
			   var anwers= new Array();
			   for(var i = 0; i < option.length; i++){
			   	if(option[i].checked)
			   		anwers.push(option[i].value);
			   } 
			   option=val;
			   //console.log(anwers);
			   break;
			case 'judge':
			   anwers=$('input:radio[name="option"]:checked').val();
			   break;
			case 'fill':
			   var val= new Array();
			   var selects = document.getElementsByName("option");
			   for(var i = 0; i < selects.length; i++){
			   	val.push(selects[i].value);
			   } 
			   anwers=val;
			   break;
			case 'saq':
			   anwers=$('textarea[name="option"]').val();
			   break;
		}
		    //console.log(anwers);
		    if(title.length < 1) alert("题目不能空");
		    else
		    	$.post("submit.php",
		    	{
		 	 	cate: cate,
		 	 	class: $("option:checked").val(),
		 	 	title: title,
		 	 	option:option,
		 	 	anwers:anwers
		 	    },
		 	    function(data,status){
		 	    	console.log(data+data[data.length-1]);
		 	    	if(data==0){
		 	    		if (confirm("新增成功。是否返回管理首页？"))  window.location.href="<?php echo $cate;?>_admin.php";
		 	    		$.post("testIdEach.php");
		 	    	} 
		 	    	else if(data[data.length-1]==0){
		 	    		if (confirm("新增成功。是否返回管理首页？"))  window.location.href="<?php echo $cate;?>_admin.php";
		 	    		$.post("testIdEach.php");
		 	    		}
		 	    	else{
		 	    		alert("失败请重试");
		 	    		console.log(data);
		 	 		}
		 	 	});
		}
</script>
</body>
</html>