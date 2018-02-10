<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="icon" type="image/png" href="../../images/time.png">
	<?php  
		include_once "../../sql/Bootstrap.php";
		include_once '../../sql/sql2.php';
		include_once '../../sql/eSql.php';
		$eSql = new eSql();
	    SESSION_start();
	       if($_SESSION['vip'] < 9)
	       	echo '<script> alert("	权限不够,请先登录！"); window.location.href="./"; </script>';
	    $id = $_REQUEST['id']; 
	    $username = $_SESSION['userinfo'];
	    $userId = $_REQUEST['userid'];
	    $testInfo = $eSql->sqlSelect('test_pape',$id);
//获取每提分数单位量
	    $numInfo = $eSql->sqlSelect2('test','title',$testInfo['title']);
	    $radioNum = explode(',',$numInfo['radio'])[1];
	    $checkboxNum = explode(',',$numInfo['checkbox'])[1];
	    $judgeNum = explode(',',$numInfo['judge'])[1];
	    $fillNum = explode(',',$numInfo['fill'])[1];
	    $saqNum = explode(',',$numInfo['saq'])[1];
#初始值
	    $radioAllNum = 0;$checkboxAllNum = 0;$judgeAllNum = 0;
	    $radioAnwer = null; $checkboxAnwer =null; $judgeAnwer =null; $fillAnwer =null;$saqAnwer =null;
#获取答案
	    function stuAnwers($testClass,$testId){
	    	$con_link = mysql_connect($GLOBALS['host'],$GLOBALS['user'],$GLOBALS['pwd']);
	    	mysql_query('set names utf8'); 
	    	mysql_select_db($GLOBALS['db']); 
	    	$sql = "select * from `testtemp` where `userid` = '".$GLOBALS['userId']."' and `testclass` ='$testClass' and `classid` = '$testId'";
	    	$result = mysql_query($sql,$con_link); 
	    	return mysql_fetch_assoc($result);
	    }
	?>
	<style type="text/css">
		.right{text-align: right; color: red; font-weight: bolder;}
	</style>
	<title>阅卷</title>
	
</head>
<body>
		<!-- Fixed navbar -->
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				 <a type="button" class="navbar-toggle collapsed"  href="javascript:history.go(-1);">
                    <span class="glyphicon glyphicon-arrow-left"></span>
                </a>
                <a class="navbar-brand" href="javascript:void(0);"><?php echo $eSql->sqlSelect('user',$userId)['name'].'的&nbsp;'.$testInfo['title'].'考卷批改';?></a>
            </div>
			<div class="collapse navbar-collapse navbar-right">
				<a class="navbar-brand" href="javascript:history.go(-1);">返回</a>
			</div>
		</div>
	</nav>
 <div class="container">
  		<div class="tab-content">

  			<!-- 单选题 -->
    		<div class="radio">
    			<h3>单选题</h3>
    			<table class="table table-striped">
    				<tr> <td>题目</td> <td>参考答案</td><td>学生答案</td><td>分值</td></tr>
			<?php
			    $i = 0;
			    $radio = explode(',',$testInfo['radio']);
			    while (isset($radio[$i])){
			    $test=$eSql->sqlSelect('radio',$radio[$i]); 
			    $info = stuAnwers('radio',$radio[$i]);?>
			    <tr>
    				<td><?php echo $test['title']; ?></td>
					<td><?php echo $test['answer']; ?></td>
					<td><?php echo $info['anwers']?$info['anwers']:'还没做哎';?></td>
					<td><?php echo ($test['answer'] == $info['anwers'])?$radioNum:0;  if($test['answer'] == $info['anwers'])$radioAllNum +=$radioNum;?></td>
				</tr>
						<?php $i++;
						 $radioAnwer = $radioAnwer.($info['anwers']?$info['anwers']:'还没做哎').'/,';
						}?>
				</table>
				<h3 class="right">总分：<?php echo $radioNum*$i;?>&nbsp;&nbsp;学生得分：<?php echo $radioAllNum;?></h3>
				<hr>
    		</div>

    		<!-- 多选题 -->
    		<div class="checkbox">
    			<h3>多选题</h3>
    			<table class="table table-striped">
    				<tr> <td>题目</td> <td>参考答案</td><td>学生答案</td><td>分值</td></tr>
			<?php
			    $i = 0;
			    $checkbox = explode(',',$testInfo['checkbox']);
			    while (isset($checkbox[$i])){
			    $test=$eSql->sqlSelect('checkbox',$checkbox[$i]);
			    $info = stuAnwers('checkbox',$checkbox[$i]);?>
			    <tr>
    				<td><?php echo $test['title']; ?></td>
    				<td><?php $check_box = explode(',',$test['answer']);
    			            $j = 0;
    			            $checkboxAnwers = $test['option_'.$check_box[$j]];
    				        while (isset($check_box[$j+1])){
    				        	$checkboxAnwers = $checkboxAnwers.','.$test['option_'.$check_box[$j+1]];
    				        	$j++;
    				        }
							echo $checkboxAnwers; ?></td>
					<td><?php echo $info['anwers']?$info['anwers']:'还没做哎'; ?></td>
					<td><?php echo ($checkboxAnwers == $info['anwers'])?$checkboxNum:0; if($checkboxAnwers == $info['anwers'])$checkboxAllNum +=$checkboxNum;?></td>
				</tr><?php $i++;
						 $checkboxAnwer = $checkboxAnwer.($info['anwers']?$info['anwers']:'还没做哎').'/,';
						}?>
				</table>
				<h3 class="right">总分：<?php echo $checkboxNum*$i;?>&nbsp;&nbsp;学生得分：<?php echo $checkboxAllNum;?></h3>
				<hr>
    		</div>

    		<!-- 判断题 -->
    		<div class="judge">
    			<h3>判断题</h3>
    			<table class="table table-striped">
    				<tr><td>题目</td> <td>参考答案</td><td>学生答案</td><td>分值</td></tr>
			<?php
				$i = 0;
			    $judge = explode(',',$testInfo['judge']);
			    while (isset($judge[$i])){
			    	$test=$eSql->sqlSelect('judge',$judge[$i]);
			        $info = stuAnwers('judge',$judge[$i]); ?>
			    <tr>
    				<td><?php echo $test['title']; ?></td>
					<td><?php echo $test['answer']?"正确":"错误"; ?></td>
					<td><?php if(isset($info['anwers'])) echo $info['anwers']?"正确":"错误"; else echo "还没做哎"; ?></td>
					<td><?php echo ($test['answer'] == $info['anwers'])?$judgeNum:0; if($test['answer'] == $info['anwers'])$judgeAllNum +=$judgeNum;?></td>
					</tr><?php $i++;
						 $judgeAnwer = $judgeAnwer.(isset($info['anwers'])?($info['anwers']?"正确":"错误"):"还没做哎").'/,';
						}?>
				</table>
				<h3 class="right">总分：<?php echo $judgeNum*$i;?>&nbsp;&nbsp;学生得分：<?php echo $judgeAllNum;?></h3>
				<hr>
    		</div>

			<!-- 填空题 -->
    		<div class="fill">
    			<h3>填空题(单题2分)</h3>
    			<table class="table table-striped">
    				<tr><td>题目</td> <td>参考答案</td><td>学生答案</td><td>打分</td></tr>
			<?php
				$i = 0;
			    $fill = explode(',',$testInfo['fill']);
			    while (isset($fill[$i])){
			    	$test=$eSql->sqlSelect('fill',$fill[$i]); 
			        $info = stuAnwers('fill',$fill[$i]);?>
			    <tr>
    				<td><?php echo $test['title']; ?></td>
					<td><?php echo $test['answer_1'].' '.$test['answer_2'].' '.$test['answer_3']; ?></td>
					<td><?php echo $info['anwers']?$info['anwers']:'还没做哎'; ?></td>
					<td><input type="number" class="form-control" name="fillTestNum" placeholder="请为学社打分<?php if($info['anwers']==null) echo ",推荐打0分" ?> " <?php if($info['anwers']==null)echo 'value="0"'?>></td> 
				</tr>
					<?php $i++;
						 $fillAnwer = $fillAnwer.($info['anwers']?$info['anwers']:'还没做哎').'/,';
						}?>
				</table>
				<h3  class="right">总分：<?php echo $fillNum*$i;?>&nbsp;&nbsp;学生得分：<span class="Num">0</span></h3>
				<hr>
    		</div>

    		<!-- 解答题 -->
    		<div class="saq">
    			<h3>解答题(单题15分)</h3>
    			<table class="table table-striped">
    				<tr> <td>题目</td> <td>参考答案</td><td>学生答案</td><td>打分</td></tr>
			<?php
				$i = 0;
			    $saq = explode(',',$testInfo['saq']);
			    while (isset($saq[$i])){
			    	$test=$eSql->sqlSelect('saq',$saq[$i]);  
			        $info = stuAnwers('saq',$saq[$i]);?>
			    <tr>
    				<td><?php echo $test['title']; ?></td>
					<td><?php echo $test['answer']; ?></td>
					<td><?php echo $info['anwers']?$info['anwers']:'还没做哎'; ?></td>
					<td><input type="number" class="form-control" name="saqTestNum" placeholder="请为学社打分<?php if($info['anwers']==null) echo ",推荐打0分" ?>" <?php if($info['anwers']==null)echo 'value="0"'?>></td>
				</tr>
				<?php $i++;
						 $saqAnwer = $saqAnwer.($info['anwers']?$info['anwers']:'还没做哎').'/,';
						}?>
				</table>
				<h3 class="right">总分：<?php echo $saqNum*$i;?>&nbsp;&nbsp;学生得分：<span class="saqNum"></span></h3>
			<hr>
    	</div>
    	<div style="margin-bottom: 120px;">
    		<button type="text" class="allTestNum btn btn-success btn-lg">计算总分数</button>
    		<h3 class="right">客观题分数: <span class="impAllNum"></span>&nbsp;主观题分数:<span class="subAllNum"></span>&nbsp;该学生总分:<span class="allNum"></span></h3>
    		<div class="left" style="width: 49%; float: left;">
    			<button type="text" class="btn btn-success btn-lg btn-block submitPost">提交并保存</button>
    		</div>
    		<div class="left" style="width: 49%; float: left; margin-left: 2%;">
    			<a class="btn btn-success btn-lg btn-block" href="javascript:history.go(-1);">返回不弄了</a>
    		</div>
    	</div>
    </div>
    <script type="text/javascript">
    	var  impAllNum = <?php echo $radioAllNum+$checkboxAllNum+$judgeAllNum;?>,subAllNum = 0;
    	$('.fill .form-control').blur(function(){
    		var els =document.getElementsByName("fillTestNum");
    		var Num = 0, max = <?php echo $fillNum;?>;
    		for (var i = 0,j=els.length;i<j; i++){
    			if(els[i].value > max) {alert('你分数值过大,请重新输入'); els[i].value=0; break;}
    			Num = Number(els[i].value) + Num;
    		}
    		$('.Num').text(Num);
    	});
    	$('.saq .form-control').blur(function(){
    		var els =document.getElementsByName("saqTestNum");
    		var Num = 0, max = <?php echo $saqNum;?>;
    		for (var i = 0,j=els.length;i<j; i++){
    			if(els[i].value > max) {alert('你分数值过大,请重新输入'); els[i].value=0; break;}
    			Num = Number(els[i].value) + Num;
    		}
    		$('.saqNum').text(Num);
    	});
    	$('.allTestNum').click(function(){
    		subAllNum = Number($('.Num').text()) + Number($('.saqNum').text());
    		$('.subAllNum').text(subAllNum);
    		$('.impAllNum').text(impAllNum);
    		$('.allNum').text(subAllNum + impAllNum);
    	});
    	$('.submitPost').click(function(){
    		$.post("submit.php",
		 	 {
		 	 	userid:"<?php echo $testInfo['userid'];?>",
		 	 	title:"<?php echo $testInfo['title'];?>",
		 	 	curriculum:"<?php echo $testInfo['curriculum'];?>",
		 	 	radio:"<?php echo $radioAnwer;?>",
		 	 	checkbox: '<?php echo $checkboxAnwer;?>',
		 	 	judge:'<?php echo $judgeAnwer;?>',
		 	 	fill:'<?php echo $fillAnwer;?>',
		 	 	saq:'<?php echo $saqAnwer;?>',
		 	 	objectivescore:impAllNum,
		 	 	subjectivescore:subAllNum,
		 	 	id: '<?php echo $id;?>'
		 	 },
		 	 function(data,status){
		 	 	if(data != 0 && data[data.length-1] !=0){ alert('保存失败,请重试!'); console.log(data);}
		 	 	else {
		 	 		if (confirm("保存成功,是否返回？")) 
		 	 			window.location.href="javascript:history.go(-1);";
		 	    		
		 	 	}
		 	 });
    	});
    </script>
</body>
</html>