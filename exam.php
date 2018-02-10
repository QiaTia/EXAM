<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="icon" type="image/png" href="images/time.png">
	<?php  include_once "sql/Bootstrap.php";
	date_default_timezone_set("PRC");
	       SESSION_start();
	       if(!isset($_SESSION['userinfo'])){
	       	echo '<script> alert("请先登录！"); window.location.href="./"; </script>';
	       }
	       $userId = $_SESSION['userid'];
	       include_once 'sql/eSql.php';
	       $id=$_REQUEST['id'];
	       $eSql = new eSql();
	       $info = $eSql->sqlSelect('test',$id);
	       $overTime = $info['overTime'];
	       $radioNum = explode(',',$info['radio'])[0];
	       $checkboxNum = explode(',',$info['checkbox'])[0];
	       $judgeNum = explode(',',$info['judge'])[0];
	       $fillNum = explode(',',$info['fill'])[0];
	       $saqNum = explode(',',$info['saq'])[0];
	       $title = $info['title'];
	       if($overTime=='0000-00-00 00:00:00') $overTime = date("Y-m-d H:i:s",time()+7200);

	       	$con_link = mysql_connect($GLOBALS['host'],$GLOBALS['user'],$GLOBALS['pwd']);
	       	mysql_query('set names utf8');
	       	mysql_select_db($GLOBALS['db']);
	       	$testInfo = mysql_fetch_assoc(mysql_query("select * from `test_pape` where `title` = '$title' and `userid` = '$userId'",$con_link));
	       	$radioTest = explode(',',$testInfo['radio']);
	       	$checkboxTest = explode(',',$testInfo['checkbox']);
	       	$judgeTest = explode(',',$testInfo['judge']);
	       	$fillTest = explode(',',$testInfo['fill']);
	       	$saqTest = explode(',',$testInfo['saq']);
	?>
	<title><?php echo $info['title'];?>——考试中</title>
	<style type="text/css">
		.btn-default{ width: 66px; margin-top: 4px; }
		.timer button.time-button{
			line-height: 36px; 
  			background: #d9534f; 
  			color: #fff; 
  			font-weight: normal;
  			font-size:30px;
  			margin:12px 0; 
  			padding: 8px 36px;
  		}
  		ul li a {color: green;}
  		.timer{width: 210px;  margin: 0 auto;}
	</style>
</head>
<body>
		<!-- Fixed navbar -->
	<nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
            	<a onclick="overTest()"> 
                <div class="navbar-toggle collapsed" >
                    <span class="glyphicon glyphicon-ok-sign"></span>
                </div></a>
                <a class="navbar-brand" href="javascript:void(0)"><?php echo $info['title'];?>——考试中 &raquo;<span class="title"></span></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                    <li><a onclick="overTest()" href="javascript:void(0)">交卷</a>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

	<div class="container">
	<div class="col-md-8 main-content">
		<div class="embed-responsive embed-responsive-16by9">
			<iframe class="embed-responsive-item" src="test/radio.php?id=<?php echo $radioTest[0];?>" name="iframe">
			</iframe>
		</div>
		<nav aria-label="...">
			<ul class="pager">
				<!-- 上一页 下一页 -->
				<li class="previous"><a href="javascript:void(0);" onclick="onframe(0)"><span aria-hidden="true">&larr;</span> 上一题</a></li>
				<li class="next"><a href="javascript:void(0);" onclick="onframe(1)">下一题 <span aria-hidden="true">&rarr;</span></a></li>
			</ul>
		</nav>
	</div>
	<div class="col-md-4 sidebar">
		<div class ="timer" id="time-button"></div>
		<!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#test1" aria-controls="home" role="tab" data-toggle="tab">一</a></li>
    <li role="presentation"> <a href="#test2" aria-controls="profile" role="tab" data-toggle="tab">二</a></li>
    <li role="presentation"> <a href="#test3" aria-controls="profile" role="tab" data-toggle="tab">三</a></li>
    <li role="presentation"> <a href="#test4" aria-controls="profile" role="tab" data-toggle="tab">四</a></li>
    <li role="presentation"> <a href="#test5" aria-controls="profile" role="tab" data-toggle="tab">五</a></li>
  </ul>
  </ul>
  </ul>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="test1"> 
    	<!-- 单选抽题区 -->
		<?php for($i = 1; $i <= $radioNum; $i++){?>
		<a class="btn btn-default" href="javascript:void(0);" onclick="onframe2('radio','<?php echo $i;?>')" role="button"><?php echo $i;?></a>
		<?php } ?>
	</div>
    <div role="tabpanel" class="tab-pane" id="test2"> 
    	<!-- 多选抽题区 -->
		<?php for($i = 1; $i <= $checkboxNum; $i++){?>
		<a class="btn btn-default" href="javascript:void(0);" onclick="onframe2('checkbox','<?php echo $i;?>')" role="button"><?php echo $i;?></a>
		<?php } ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="test3"> 
    	<!-- 判断抽题区 -->
		<?php for($i = 1; $i <= $judgeNum; $i++){?>
		<a class="btn btn-default" href="javascript:void(0);" onclick="onframe2('judge','<?php echo $i;?>')" role="button"><?php echo $i;?></a>
		<?php } ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="test4"> 
    	<!-- 填空抽题区 -->
		<?php for($i = 1; $i <= $fillNum; $i++){?>
		<a class="btn btn-default" href="javascript:void(0);" onclick="onframe2('fill','<?php echo $i;?>')" role="button"><?php echo $i;?></a>
		<?php } ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="test5"> 
    	<!-- 简答抽题区 -->
		<?php for($i = 1; $i <= $saqNum; $i++){?>
		<a class="btn btn-default" href="javascript:void(0);" onclick="onframe2('saq','<?php echo $i;?>')" role="button"><?php echo $i;?></a>
		<?php } ?>
    </div>
  </div>
	</div>
</div>
<script type="text/javascript">
	var tableId = 1,
	    tableName = 'radio',
	    radioNum = <?php echo $radioNum;?>,
	    checkboxNum = <?php echo $checkboxNum;?>,
	    judgeNum = <?php echo $judgeNum;?>,
	    fillNum = <?php echo $fillNum;?>,
	    saqNum = <?php echo $saqNum;?>;

	var title = new Array();
	    title['radio'] = '单选题'; 
	    title['checkbox'] = '多选题'; 
	    title['judge'] = '判断题'; 
	    title['fill'] = '填空题'; 
	    title['saq'] = '简答题'; 
	var testPage =  new Array();
	    testPage['radio'] =eval('<?php echo json_encode($radioTest);?>'),
	    testPage['checkbox'] =eval('<?php echo json_encode($checkboxTest);?>'),
	    testPage['judge'] =eval('<?php echo json_encode($judgeTest);?>'),
	    testPage['fill'] =eval('<?php echo json_encode($fillTest);?>'),
	    testPage['saq'] =eval('<?php echo json_encode($saqTest);?>');
	    //console.log(radioTest);
	disPlay();
	function onframe(table){
		if (table){
			if(tableName =='radio' && tableId == radioNum){
				tableName = 'checkbox'; tableId=1;
				$('li a[href="#test2"]').tab('show'); 
			}else if(tableName =='checkbox' && tableId == checkboxNum){
				tableName = 'judge'; tableId=1;
				$('li a[href="#test3"]').tab('show'); 
			}else if(tableName =='judge' && tableId == judgeNum){
				tableName = 'fill'; tableId=1;
				$('li a[href="#test4"]').tab('show'); 
			}else if(tableName =='fill' && tableId == fillNum){
				tableName = 'saq'; tableId=1;
				$('li a[href="#test5"]').tab('show'); 
			}else tableId++;
		}
		else {
			if(tableName =='saq' && tableId == 1){
				tableName = 'fill'; tableId=fillNum;
				$('li a[href="#test4"]').tab('show'); 
			}else if(tableName =='fill' && tableId == 1){
				tableName = 'judge'; tableId=judgeNum;
				$('li a[href="#test3"]').tab('show'); 
			}else if(tableName =='judge' && tableId == 1){
				tableName = 'checkbox'; tableId=checkboxNum;
				$('li a[href="#test2"]').tab('show'); 
			}else if(tableName =='checkbox' && tableId == 1){
				tableName = 'radio'; tableId=radioNum;
				$('li a[href="#test1"]').tab('show'); 
			}else 
			tableId--;
		}
		var testId = testPage[tableName][tableId-1];
		var link = "test/" + tableName + ".php?id=" + testId;
		window.frames["iframe"].location.href = link;
		disPlay();
	}
	function onframe2(tableName2,tableId2){
		tableName = tableName2;
		tableId = tableId2;
		var testId = testPage[tableName][tableId-1];
		var link = "test/" + tableName + ".php?id=" + testId;
		window.frames["iframe"].location.href = link;
		disPlay();
	}
	function disPlay(){
		$(".title").text(title[tableName]+'第'+tableId+'题');
		for(var i=1; i <= radioNum; i++){
			if(sessionStorage.getItem('radio-'+testPage['radio'][i-1]) != null)
				if(!$('.btn-default').eq(i-1).is("btn-success"))
					$('.btn-default').eq(i-1).addClass("btn-success");
			if(sessionStorage.getItem('checkbox-'+testPage['checkbox'][i-1]) != null)
				if(!$('.btn-default').eq(radioNum+i-1).is("btn-success"))
					$('.btn-default').eq(radioNum+i-1).addClass("btn-success");
			if(sessionStorage.getItem('judge-'+testPage['judge'][i-1]) != null)
				if(!$('.btn-default').eq(checkboxNum+radioNum+i-1).is("btn-success"))
					$('.btn-default').eq(checkboxNum+radioNum+i-1).addClass("btn-success");
			if(sessionStorage.getItem('fill-'+testPage['fill'][i-1]) != null)
				if(!$('.btn-default').eq(checkboxNum+radioNum+fillNum+i-1).is("btn-success"))
					$('.btn-default').eq(checkboxNum+radioNum+fillNum+i-1).addClass("btn-success");
			if(sessionStorage.getItem('saq-'+testPage['saq'][i-1]) != null)
				if(!$('.btn-default').eq(judgeNum+checkboxNum+radioNum+fillNum+i-1).is("btn-success"))
					$('.btn-default').eq(judgeNum+checkboxNum+radioNum+fillNum+i-1).addClass("btn-success");
		}
		if (tableName =='radio' && tableId <= 1) {
			//$(".previous").addClass("disabled");
			$(".previous").hide();
		}
		else {
			//$(".previous").removeClass("disabled");
			$(".previous").show();
		}
		if (tableName=='saq' && tableId >= saqNum) {
			//$(".next").addClass("disabled"); 
			$(".next").hide();
		}
		else {
			//$(".next").removeClass("disabled");
			$(".next").show();
		}
		
	}


//                         考试倒计时   2017/12/19 22:46:00 2017-12-20 21:11:31

	  function GetRTime(){
	  	var EndExam = '<?php echo $overTime;?>';//'2017-12-20 12:58:20'
	    var EndTime= new Date(EndExam);
	    var NowTime = new Date();
	    var t = EndTime.getTime() - NowTime.getTime();
	    var d = 0;
	    var hours = 0;
	    var minutes = 0;
	    var seconds = 0;
	    if(t>=0){
	      d=Math.floor(t/1000/60/60/24);
	    	if ( d <= 9){
        		d = "0" + d;}
	      hours=Math.floor(t/1000/60/60%24);
	      	if ( hours <= 9){
        	hours = "0" + hours;}
	      minutes=Math.floor(t/1000/60%60);
	      	if ( minutes <= 9){
        		minutes = "0" + minutes;}
	      seconds=Math.floor(t/1000%60);
	      	if ( seconds <= 9){
        		seconds = "0" + seconds;}
        		}
        	document.getElementById("time-button").innerHTML ="<button type='button' class='time-button btn btn-danger'>" + hours + ": " + minutes + ": " + seconds + " </button>";
	      if (d == 0 && hours == 0 && minutes == 05 && seconds == 0) alert('注意，还有5分钟!');   
	      else if(t < 0)  {
	      	window.location.href='./';
	      	sessionStorage.clear(); 
	      	alert('时间到，考试已结束!!'); 
	      }
	  }
	  $(document).ready(function(){
	  	setInterval(GetRTime,1000); 
	  }); 
	  function overTest(){
	  	if (confirm("还有那么久呢?确认要交卷？")) {
	  		sessionStorage.clear();  
	  		window.location.href='./';
	  	}
	  }
</script>
</body>
</html>