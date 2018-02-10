<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include_once '../sql/Bootstrap.php';
	      include_once '../user/userCheck.php';
	?>
	<title>考试测试</title>
</head>
<body>
	<?php
	if(isset($_REQUEST['id']))
		$id=$_REQUEST['id'];
	else $id=1;
	include '../sql/test_sql.php';
	$test=new radio();
	$radioTest=$test->radioTest($id);
	?>
	<div class="jumbotron">
		<h3><strong><?php echo $radioTest['2']; ?></strong> <span class="glyphicon" style="color: green; "></span></h3>
		<blockquote>
			<?php for($i=1;$i<=9;$i++){ $j=$i+2; if($radioTest[$j] == '')  break;?>
			<div class="radio">
				<label>
					<input class="option" type="radio" name="option" id="option" value="<?php echo $radioTest[$j]; ?>">
					<?php echo $radioTest[$j]; ?>
				</label>
			</div>
			<?php } ?>
		</blockquote>
	</div>
	<script type="text/javascript">
		var	classid = '<?php echo $id;?>';
		$(document).ready(function(){
			var data = sessionStorage.getItem('radio-'+classid);
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
		 	sessionStorage.setItem('radio-'+classid, val);
		 	//通过ajax动态提交答案
		 	$.post("submitTest.php",
		 	 {
		 	 	class:"<?php echo $radioTest[1];?>",
		 	 	testclass:"radio",
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