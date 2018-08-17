
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="//cdn.90so.net/layui/2.2.6/css/layui.css"  media="all">
  <script src="Chart.min.js"></script>
  <style type="text/css">
    .layui-card-body{min-height:99px}
  </style>
</head>
<body>
  
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md8">
        <div class="layui-row layui-col-space15">
          <div class="layui-col-md6">
            <div class="layui-card">
              <div class="layui-card-header">快捷方式</div>
              <div class="layui-card-body">
                <!--  code -->
              </div>
            </div>
          </div>
          <div class="layui-col-md6">
            <div class="layui-card">
              <div class="layui-card-header">待办事项</div>
              <div class="layui-card-body">
               <!--  code -->
              </div>
            </div>
          </div>
          <div class="layui-col-md12">
            <div class="layui-card">
              <div class="layui-card-header">数据概览</div>
              <div class="layui-card-body">
                <!-- code -->
                <!-- <canvas id="doughnut" height="300" width="200"></canvas> -->
                <canvas id="line" height="300" width="500"></canvas>
                <!-- <canvas id="polarArea" height="300" width="200"></canvas>
				<canvas id="bar" height="300" width="200"></canvas>
				<canvas id="pie" height="300" width="200"></canvas> -->
				<canvas id="radar" height="300" width="200"></canvas>
              </div>
            </div>
            <div class="layui-card">
              <div class="layui-card-header">今日热帖</div>
              <div class="layui-card-body">
                  <!-- code -->
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="layui-col-md4">        
        <div class="layui-card">
          <div class="layui-card-header">最近发布</div>
          <div class="layui-card-body">
           <!--  code~ -->
          </div>
        </div>

        <div class="layui-card">
          <div class="layui-card-header">关于EXAM</div>
          <div class="layui-card-body layui-text layadmin-text">
            <h3>云南能源职业技术学院 2015届 计网151班 毕业设计项目</h3>
            <h3>大致功能：</h3>
            前台：学生进行随机抽提考试，并提交所做的答案，共五种题型：单选，多选，判断，填空，简答<br>
			后台：管理员进行题目增删改查，发布考试，删除考试，阅卷功能，添加学生，重置学生密码，删除学生<br>
<h3>使用框架</h3>
前端：bootstrap, JQuery. 后台管理：MDUI, bootstrap, JQuery. 图表 ：Chart <br>
虽然使用了图表插件，但是并没画出什么实际效果
          </div>
        </div>
      </div>
      
    </div>
  </div>
<div class="Copyright" style=" width: 190px; margin: 24px auto;"> <span>Copyright © 2018 <a href="//www.QiaTia.top">QiaTia</a></span></div>
<script src="//cdn.90so.net/layui/2.2.6/layui.js " charset="utf-8"></script>
<script>
		//环形图绘制
		var doughnutData = [
				{
					value: 30,
					color:"#F7464A"
				},
				{
					value : 50,
					color : "#46BFBD"
				},
				{
					value : 100,
					color : "#FDB45C"
				},
				{
					value : 40,
					color : "#949FB1"
				},
				{
					value : 120,
					color : "#4D5360"
				}
			
			];
			//折线图绘制
		var lineChartData = {
			labels : ["","","","","","",""],
			datasets : [
				{
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					data : [65,59,90,81,56,55,40]
				},
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					data : [28,48,40,19,96,27,100]
				}
			]
			
		};
		//饼图 2 绘制
		var pieData = [
				{
					value: 30,
					color:"#F38630"
				},
				{
					value : 50,
					color : "#E0E4CC"
				},
				{
					value : 100,
					color : "#69D2E7"
				}
			
			];
			//柱形图绘制
		var barChartData = {
			labels : ["January","February","March","April","May","June","July"],
			datasets : [
				{
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,1)",
					data : [65,59,90,81,56,55,40]
				},
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					data : [28,48,40,19,96,27,100]
				}
			]
			
		};
		//饼图绘制
	var chartData = [
			{
				value : Math.random(),
				color: "#D97041"
			},
			{
				value : Math.random(),
				color: "#C7604C"
			},
			{
				value : Math.random(),
				color: "#21323D"
			},
			{
				value : Math.random(),
				color: "#9D9B7F"
			},
			{
				value : Math.random(),
				color: "#7D4F6D"
			},
			{
				value : Math.random(),
				color: "#584A5E"
			}
		];
		//
		var radarChartData = {
			labels : ["","","","","","",""],
			datasets : [
				{
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					data : [65,59,90,81,56,55,40]
				},
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					data : [28,48,40,19,96,27,100]
				}
			]
			
		};
	//new Chart(document.getElementById("doughnut").getContext("2d")).Doughnut(doughnutData);
	new Chart(document.getElementById("line").getContext("2d")).Line(lineChartData);
	new Chart(document.getElementById("radar").getContext("2d")).Radar(radarChartData);
	//new Chart(document.getElementById("polarArea").getContext("2d")).PolarArea(chartData);
	//new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);
	//new Chart(document.getElementById("pie").getContext("2d")).Pie(pieData);
	
	</script>
</body>
</html>