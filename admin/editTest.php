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
	if(!isset($_REQUEST['id'])) 
		alert("请先选择题号","./");
	$id = $_REQUEST['id'];
	include '../sql/test_sql.php';
	$test=new radio();
	$radioTest=$test->test($id,$cate);
	//print_r($radioTest);
	?>
	<title>修改题目</title>
</head>
<body class="mdui-appbar-with-toolbar">
<div class="mdui-appbar mdui-appbar-fixed">
  <div class="mdui-toolbar mdui-color-theme">
  	<span class="mdui-typo-title">修改题目 </span>
  	<div class="mdui-toolbar-spacer"></div>
  	<a href="javascript:;" class="mdui-btn mdui-btn-icon"  mdui-tooltip="{content: '操作'}"  mdui-menu="{target: '#meua'}"><i class="mdui-icon material-icons">more_vert</i></a>
  	<ul id="meua" class="mdui-menu">
  		<li class="mdui-menu-item">
  			<a  onclick="submit()" href="javascript:;" class="mdui-ripple">
  				<i class="mdui-menu-item-icon mdui-icon material-icons">check</i>
  			完成保存</a>
  		</li>
  		<li class="mdui-menu-item">
  			<a href="<?php echo $cate;?>_admin.php">
  				<i class="mdui-menu-item-icon mdui-icon material-icons">clear</i>
  				算了不弄了
  			</a>
  		</li>
  	</ul>
  	<i class="mdui-icon material-icons"></i>
  </div>
</div>
<div class="mdui-container">
	<div class="mdui-textfield mdui-textfield-floating-label">
		<label class="mdui-textfield-label">请输入题目标题</label>
		<textarea name="title" class="mdui-textfield-input" maxlength="3200"><?php echo  $radioTest['2'];?></textarea>
	</div>
    <label class="mdui-textfield-label">选项答案区域</label>
	<?php switch ($cate) {
		//单选题
		case 'radio':
			# code...
		?>
	<div class="col-lg-6  form-signin rows">
		<?php for($i=1;$i<=9;$i++){ $j=$i+2; if($radioTest[$j] == '')  break;?>
		 <div class="form-group input-group">
		 	<span class="input-group-addon">
		 		<input type="radio" name="anwers" value="<?php echo $i;?>" <?php if($radioTest[12]==$radioTest[$j]) echo 'checked="checked"';?>>
		 	</span>
		 	<input type="text" name="option" class="form-control" placeholder="选项<?php echo $i;?>" value="<?php echo $radioTest[$j]; ?>">
		 </div><!-- /input-group -->
		 <?php } ?>
		<!--<button onclick="append('radio')" class="btn btn-default"><i class="mdui-icon material-icons">add</i>新增选项</button>-->
	</div>
		<?php
			break;
		//多选题
		case 'checkbox':
			# code...
		?>
	<div class="col-lg-6  form-signin">
		参考答案：<?php echo $radioTest[12]; ?>
		<?php for($i=1;$i<=9;$i++){ $j=$i+2; if($radioTest[$j] == '')  break;?>
		 <div class="form-group input-group">
		 	<span class="input-group-addon">
		 		<input type="checkbox" name="anwers" value="<?php echo $i;?>">
		 	</span>
		 	<input type="text" name="option" class="form-control" placeholder="选项<?php echo $i;?>" value="<?php echo $radioTest[$j]; ?>">
		 </div><!-- /input-group -->
		 <?php } ?>
		 <!-- <button onclick="append('checkbox')" class="btn btn-default"><i class="mdui-icon material-icons">add</i>新增选项</button>-->
	</div>
		<?php
			break;
		//判断题
		case 'judge':
			# code...
		?>
		<div class="form-signin">
			<label  class="mdui-radio">	
				<input type="radio" class="option" name="option" value="1" <?php echo $radioTest[3]?'checked':'' ?>>
				<i class="mdui-radio-icon"></i>正确 
			</label>
			<label  class="mdui-radio">	</label>
			<label  class="mdui-radio">	
				<input type="radio" class="option" name="option" value="0" <?php echo $radioTest[3]?'':'checked' ?>>
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
		<?php for($i=1;$i<=3;$i++){ $j=$i+2; if($radioTest[$j] == '')  break;?>
		 <div class="form-group input-group">
		 	<div class="input-group-addon"><?php echo $i;?></div>
		 	<input type="text" name="option" class="form-control" placeholder="项目1" value="<?php echo $radioTest[$j];?>">
		 </div><!-- /input-group -->
		 <?php } ?>
		 <!--<button onclick="append('fill')" class="btn btn-default"><i class="mdui-icon material-icons">add</i>新增选项</button>-->
	</div>
		<?php
			break;
		//简答题
		case 'saq':
			# code...
		?>
	<div class="form-signin">
		<textarea class="form-control option" name="option"  rows="5"  placeholder="请输入参考答案，可为空" style="height: 100%;"><?php echo $radioTest[3];?></textarea>
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
	/*
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
	}*/
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
		    	$.post("editSubmit.php",
		    	{
		 	 	cate: cate,
		 	 	id:<?php echo $id?>,
		 	 	title: title,
		 	 	option:option,
		 	 	anwers:anwers
		 	    },
		 	    function(data,status){
		 	    	if(data == 0) {
		 	    		if (confirm("修改成功。是否返回管理首页？")) 
		 	    			window.location.href="<?php echo $cate;?>_admin.php";
		 	    		}
		 	    	else if(data[data.length-1] ==0){
		 	    		if (confirm("修改成功。是否返回管理首页？")) {
		 	    			window.location.href="<?php echo $cate;?>_admin.php";
		 	    		}else{
		 	    			//alert("点击了取消"); 
		 	    		}
		 	    	}
		 	    	else {
		 	    		console.log(data);
		 	 		}
		 	 	});
		}
</script>
</body>
</html>