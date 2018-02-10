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
	$saqTest=$test->saqTest($id);
	?>
<div class="jumbotron">
	<h3><strong><?php echo $saqTest['2']; ?></strong>  <span class="glyphicon" style="color: green; "></h3>
	<blockquote>
		<footer>回答区域:</footer>
		<div class="form-group">
			<textarea class="form-control option" name="option"  rows="4"></textarea>
		</div>
	</blockquote>
</div>
<script type="text/javascript">
	var	classid = '<?php echo $id;?>';
		$(document).ready(function(){
			var data = sessionStorage.getItem('saq-'+classid);
			if(data != null){
				//console.log(data);
				$(".option").text(data);
			}
		});
		$(".option").blur(function(){
		 	var val=$('textarea[name="option"]').val();
		 	//alert(val);
		 	//通过ajax动态提交答案
		 	if(val.length > 3 ){
		 		sessionStorage.setItem('saq-'+classid, val);
		 		$.post("submitTest.php",
		 		{
		 	 	 class:"<?php echo $saqTest['1'];?>",
		 	 	 testclass:"saq",
		 	 	 classid:classid,
		 	 	 anwers:val
		 	 	},
		 	 	function(data,status){
		 	 	 if(data != 0) alert(data);
		 	 	 else {
		 	 		//$(".glyphicon").addClass('glyphicon-ok');
		 	 	 }
		 	 	});
		 	}
		 });
	</script>
</body>
</html>