<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include '../sql/Bootstrap.php';?>
	<title>考试测试</title>
</head>
<body>
	<?php
	if(isset($_REQUEST['id']))
		$id=$_REQUEST['id'];
	else $id=1;
	include '../sql/test_sql.php';
	$test=new radio();
	$fillTest=$test->fillTest($id);
	?>
<div class="jumbotron">
	<h3><strong><?php echo $fillTest['2']; ?></strong>  <span class="glyphicon" style="color: green; "></h3>
	<blockquote>
	    <div class="form-horizontal">
			<footer>回答区域:</footer>
			<?php for($i=1;$i<=3;$i++){ $j=$i+2; if($fillTest[$j] == '')  break;?>
			<div class="form-group">
			    <div class="input-group col-sm-4">
			    	<div class="input-group-addon"><?php echo $i;?></div>
			    	<input type="text" class="form-control option" name="option" placeholder="请填写">
			    </div>
			</div>
			<?php } ?>
		</div>
	</blockquote>
</div>
	<script type="text/javascript">
		var	classid = '<?php echo $id;?>';
		$(document).ready(function(){
			if(sessionStorage.getItem('fill-'+classid) != null){
				var data = sessionStorage.getItem('fill-'+classid).split(",");
				//console.log(data[1],classid);
				var selects = document.getElementsByName("option");
				for (var i = 0; i<selects.length; i++){
					selects[i].value = data[i];
				}
			}
		});
		$(".option").blur(function(){
			var val= new Array();
			var selects = document.getElementsByName("option");
			for(var i = 0; i < selects.length; i++){
				val.push(selects[i].value);
			} 
			//console.log(val);
			//alert(val);
			//通过ajax动态提交答案
			if(val['0'].length >= 1 && val['0'] !=null){  //先判断输入内容不为空
		 	sessionStorage.setItem('fill-'+classid, val);
		 	if(val.length == selects.length){
		 	$.post("submitTest.php",
		 	 {
		 	 	class:"<?php echo $fillTest['1'];?>",
		 	 	testclass:"fill",
		 	 	classid:classid,
		 	 	anwers:val
		 	 },
		 	 function(data,status){
		 	 	if(data != 0) console.log(data);
		 	 	else {
		 	 		//$(".glyphicon").addClass('glyphicon-ok');
		 	 	}
		 	 });
		   }
		  }
		 });
	</script>
</body>
</html>