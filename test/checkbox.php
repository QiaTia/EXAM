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
	$checkboxTest=$test->checkboxTest($id);
	?>
	<div class="jumbotron">
		<h3><strong><?php echo $checkboxTest['2']; ?></strong>  <span class="glyphicon" style="color: green; "></h3>
		<blockquote>
			<?php for($i=1;$i<=9;$i++){ $j=$i+2; if($checkboxTest[$j] == '')  break;?>
			<div class="checkbox">
				<label>
					<input class="option" type="checkbox" name="option"  value="<?php echo $checkboxTest[$j]; ?>">
					<?php echo $checkboxTest[$j]; ?>
				</label>
			</div>
			<?php } ?>
		</blockquote>
	</div>
	<script type="text/javascript">
		var	classid = '<?php echo $id;?>';
		$(document).ready(function(){
			if(sessionStorage.getItem('checkbox-'+classid) != null){
				var data = sessionStorage.getItem('checkbox-'+classid).split(",");
				//console.log(data,classid);
				var selects = document.getElementsByName("option");
				for (var i=0; i<selects.length; i++){
					for(var j=0; j<data.length; j++){
						if (selects[i].value == data[j]) {
							selects[i].checked= true;
							break;
						}
				    }
				}
			}
		});
		 $(".option").blur(function(){
		 	var option = document.getElementsByName('option');
		 	var val= new Array();
		 	for(var i = 0; i < option.length; i++){
		 		if(option[i].checked)
		 			val.push(option[i].value);
		 	} 
		 	if (val['0'] != null) {
		 		sessionStorage.setItem('checkbox-'+classid, val);
		 		if(val.length >=2 ){
		 		//console.log(val);
		 		$.post("submitTest.php",
		 		{
		 	 	 class:"<?php echo $checkboxTest['1'];?>",
		 	 	 testclass:"checkbox",
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