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
	$judgeTest=$test->judgeTest($id);
	?>
	<div class="jumbotron">
		<h3><strong><?php echo $judgeTest['2']; ?></strong>  <span class="glyphicon" style="color: green; "></h3>
		<blockquote>
			<div class="radio">
				<label>	
					<input type="radio" class="option" name="option" value="1">
					正确
				</label>
			</div>
			<div class="radio">
				<label>	
					<input type="radio" class="option" name="option" value="0">
					错误
				</label>
			</div>
		</blockquote>
	</div>
	<script type="text/javascript">
		var	classid = '<?php echo $id;?>';
		$(document).ready(function(){
			var data = sessionStorage.getItem('judge-'+classid);
			if(data != null){
				//console.log(data);
				var selects = document.getElementsByName("option");
				for (var i=0; i<selects.length; i++){
					if (selects[i].value == data) {
						selects[i].checked= true;
						break;
					}
				}
			}
		});
		$(".option").click(function(){
		 	var val=$('input:radio[name="option"]:checked').val();
		 	sessionStorage.setItem('judge-'+classid, val);
		 	//通过ajax动态提交答案
		 	$.post("submitTest.php",
		 	 {
		 	 	class:"<?php echo $judgeTest[1];?>",
		 	 	testclass:"judge",
		 	 	classid:classid,
		 	 	anwers:val
		 	 },
		 	 function(data,status){
		 	 	if(data != 0) alert(data);
		 	 	else {
		 	 		//$(".glyphicon").addClass('glyphicon-ok');
		 	 	}
		 	 });
		 });
	</script>
</body>
</html>