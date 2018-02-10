<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="icon" type="image/png" href="../../images/time.png">
	<?php  
		include_once "../../sql/Bootstrap.php";
		include_once '../../sql/eSql.php';
		$eSql = new eSql();
	    $id = $_REQUEST['id']; 
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
#获取答案
	    $con_link = mysql_connect($sql_db->host,$sql_db->user,$sql_db->pwd);
	    mysql_query("set names utf8"); 
	    mysql_select_db($sql_db->db); 
	    $sql = "SELECT * FROM  `test_manage` WHERE  `userid` = '$userId' and `title` = '".$testInfo['title']."'";
	    $result = mysql_query($sql,$con_link); 
	    $stuAnwers =  mysql_fetch_assoc($result);;
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
                <a class="navbar-brand" href="javascript:void(0);"><?php echo $eSql->sqlSelect('user',$userId)['name'].'的&nbsp;'.$testInfo['title'].'考卷查看';?></a>
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
    				<tr> <td>题目</td> <td>参考答案</td><td>学生答案</td></tr>
			<?php
			    $i = 0;
			    $radio = explode(',',$testInfo['radio']);
			    while (isset($radio[$i])){
			    $test=$eSql->sqlSelect('radio',$radio[$i]); 
			    $info = explode('/,',$stuAnwers['radio']);?>
			    <tr>
    				<td><?php echo $test['title']; ?></td>
					<td><?php echo $test['answer']; ?></td>
					<td><?php echo $info[$i];?></td>
				</tr>
						<?php $i++;
						}?>
				</table>
				<h3 class="right">总分：<?php echo $radioNum*$i;?>&nbsp;&nbsp;</h3>
				<hr>
    		</div>

    		<!-- 多选题 -->
    		<div class="checkbox">
    			<h3>多选题</h3>
    			<table class="table table-striped">
    				<tr> <td>题目</td> <td>参考答案</td><td>学生答案</td></tr>
			<?php
			    $i = 0;
			    $checkbox = explode(',',$testInfo['checkbox']);
			    while (isset($checkbox[$i])){
			    $test=$eSql->sqlSelect('checkbox',$checkbox[$i]);
			    $info =  explode('/,',$stuAnwers['checkbox']);?>
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
					<td><?php echo $info[$i];?> </td>
				</tr><?php $i++;
						}?>
				</table>
				<h3 class="right">总分：<?php echo $checkboxNum*$i;?>&nbsp;&nbsp;</h3>
				<hr>
    		</div>

    		<!-- 判断题 -->
    		<div class="judge">
    			<h3>判断题</h3>
    			<table class="table table-striped">
    				<tr><td>题目</td> <td>参考答案</td><td>学生答案</td></tr>
			<?php
				$i = 0;
			    $judge = explode(',',$testInfo['judge']);
			    while (isset($judge[$i])){
			    	$test=$eSql->sqlSelect('judge',$judge[$i]);
			        $info = explode('/,',$stuAnwers['judge']); ?>
			    <tr>
    				<td><?php echo $test['title']; ?></td>
					<td><?php echo $test['answer']?"正确":"错误"; ?></td>
					<td><?php echo $info[$i];?> </td>
					</tr><?php $i++;
						}?>
				</table>
				<h3 class="right">总分：<?php echo $judgeNum*$i;?>&nbsp;&nbsp;</h3>
				<hr>
    		</div>

			<!-- 填空题 -->
    		<div class="fill">
    			<h3>填空题(单题2分)</h3>
    			<table class="table table-striped">
    				<tr><td>题目</td> <td>参考答案</td><td>学生答案</td></tr>
			<?php
				$i = 0;
			    $fill = explode(',',$testInfo['fill']);
			    while (isset($fill[$i])){
			    	$test=$eSql->sqlSelect('fill',$fill[$i]); 
			        $info =  explode('/,',$stuAnwers['fill']);?>
			    <tr>
    				<td><?php echo $test['title']; ?></td>
					<td><?php echo $test['answer_1'].' '.$test['answer_2'].' '.$test['answer_3']; ?></td>
					<td><?php echo $info[$i];?> </td>
				</tr>
					<?php $i++;
						}?>
				</table>
				<hr>
    		</div>

    		<!-- 解答题 -->
    		<div class="saq">
    			<h3>解答题(单题15分)</h3>
    			<table class="table table-striped">
    				<tr> <td>题目</td> <td>参考答案</td><td>学生答案</td></tr>
			<?php
				$i = 0;
			    $saq = explode(',',$testInfo['saq']);
			    while (isset($saq[$i])){
			    	$test=$eSql->sqlSelect('saq',$saq[$i]);  
			        $info =  explode('/,',$stuAnwers['saq']);?>
			    <tr>
    				<td><?php echo $test['title']; ?></td>
					<td><?php echo $test['answer']; ?></td>
					<td><?php echo $info[$i];?> </td>
				</tr>
				<?php $i++;
						}?>
				</table>
			<hr>
    	</div>
    	<div style="margin-bottom: 120px;">
    		<h3 class="right">客观题分数: <span><?PHP echo $stuAnwers['objectivescore'];?></span>&nbsp;主观题分数:<span><?PHP echo $stuAnwers['subjectivescore'];?></span>&nbsp;该学生总分:<span><?PHP echo $stuAnwers['totalscore'];?></span></h3>
    	</div>
    </div>
</body>
</html>