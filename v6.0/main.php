<!-----------------------------------------------Nav----------------------------------------------------->
<nav class="nav navbar-inverse" style='overflow:hidden;position:fixed;bottom:0;width:100%;'>
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
		<div class="navbar-header">
			<ul class="nav navbar-nav ">
				<!--button type="button"--> 
				<li><a href='download.php?hello=true' type="button" style='height:50px;line-height:50px;'>阿伯拖吊紀錄下載</a></li>
		</div>
	  
		<ul class="nav navbar-nav navbar-right">
			<li><a data-toggle="tab" href="#layerlist" id="nav_layerlist" style='height:50px;line-height:50px;'>資料查詢工具列隱藏</a></li>
			<li class="btn">
				<a class="btn" id='calBtn' style='height:45px;line-height:45px;'>懶人計算法</a>
			</li> 	    
			<li><h1 data-toggle="tab" href="#layerlist" id="nav_layerlist" style='color:white'>阿伯拖吊地圖</h1></li>
		</ul> 
    </div>
  </div>
</nav> 
<!-----------------------------------------------SideBar----------------------------------------------------->
<div id="container" style='height: 100%;'>
  <div id="sidebar" style=" background-color:rgba(0,0,0,0.8)">
  	<script>
	days = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
	function changeday(selectID, amonth)
	{
		while (document.all(selectID).options.length > 0) document.all(selectID).remove(0);

		var nOption = document.createElement("OPTION");
	  	nOption.text='全部';
	  	nOption.value=0;
	  	document.all(selectID).add(nOption);

		for (var i = 1; i <= days[amonth-1]; i++)
		{
		  var nOption = document.createElement("OPTION");
		  nOption.text=i;
		  nOption.value=i;
		  document.all(selectID).add(nOption);
		}
	}
	</script>
	<form>
  	<div class="form-group mb-3">
		  <label  for="month" style='font-size:20px;color:white'>月份</label>
		  <select class="form-control" id="month"  name="month" onchange="changeday('day', this.value)" type='submit'>
		    <option value="0">全部</option> 
			<option value="9">9月</option>
			<option value="10">10月</option>
			<option value="11">11月</option>
		  </select>
	</div>
  

	<div class="form-group mb-3">
		  <label  for="day" style='font-size:20px;color:white' >日期</label>
		  <select class="form-control" id="day" name="day" type='submit'>
			<option value="0">全部</option> 
		  </select>
	</div>
	
	<div class="form-group mb-3">
		  <label  for="time" style='font-size:20px;color:white'>時間</label>
		  <select class="form-control" id="time" name="time" type='submit'>
		    <option value="dayAll">全天</option>
			<option value="morning">上午</option>
			<option value="noon">中午</option>
			<option value="afternoon">下午</option>
			
		  </select>
	</div>
	</form>
	<button class="btn btn-primary" style="font-size:20px" id="chooseBtn" >篩選</button>

  
  </div>
  <div id="map"></div>
</div>
<!--------------------------------new---------------modal--------------------------------------------------->	
<div class='modal ' id='dialog1' tabindex='-1' role='dialog' >
	<div class='modal-dialog modal-dialog-centered' role='document'>
		<div class='modal-content' style="background-color:rgb(250,214,137);">
			<div class='modal-header'>
				<h2 class='modal-title' style='font-family:微軟正黑體;color:rgb(0,137,108) ;'>懶人計算法</h2>

			</div>
			<div class='modal-body'>
				<form action="./getGeojson.php" method="post">
					<div class="form-group mb-3">
						  <label  for="location" style='font-size:20px'>你現在身處位置</label>
						  <select class="form-control" id="location">
							<option value="大一女">大一女</option>
							<option value="博雅">博雅</option>
							<option value="研一">研一</option>
							<option value="二活">二活</option>
							<option value="人類">人類系館</option>
							<option value="土木">土木系館</option>
							<option value="大一女">大一女</option>
							<option value="大門">校門口</option>
							<option value="大氣">大氣</option>
							<option value="女九">女九</option>
							<option value="小小福">小小福</option>
							<option value="小福">小福</option>
							<option value="工科海洋">工海系館</option>
							<option value="工綜">工程綜合大樓</option>
							<option value="中非大樓">中非大樓</option>
							<option value="化工">化工系館</option>
							<option value="化學">化學系館</option>
							<option value="天數">天數館</option>
							<option value="心理系">心理系</option>
							<option value="心輔中心">心輔中心</option>
							<option value="文學院">文學院</option>
							<option value="水源">水源校區/宿舍</option>
							<option value="外語">外教</option>
							<option value="生命科學">生命科學館</option>
							<option value="二活">二活</option>
							<option value="生研所">生研所</option>
							<option value="生科">生科館</option>
							<option value="共同">共同</option>
							<option value="地質">地質系館</option>
							<option value="舟山路">舟山路</option>
							<option value="行政大樓">行政大樓</option>
							<option value="二活">二活</option>
							<option value="男一">男一</option>
							<option value="男三">男三</option>
							<option value="男五">男五</option>
							<option value="男七">男七</option>
							<option value="男八">男八</option>
						  </select>
					</div>
					<div class="form-group mb-3">
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
							<span class="input-group-text" id="timeNow" style='font-size:20px;font-weight:700;'>現在時間</span>
						  </div>
						  <input type="text" class="form-control" placeholder="ex:  1800" aria-label="Username" aria-describedby="basic-addon1">
						</div>
					</div>
					<div class="form-group mb-3">
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
							<span class="input-group-text" id="stopTime" style='font-size:20px;font-weight:700;'>預計停留時間(min)</span>
						  </div>
						  <input type="text" class="form-control" placeholder="ex:  15" aria-label="Username" aria-describedby="basic-addon1">
						</div>
					</div>						
				</form>
			</div>
			<div class='modal-footer'>
				<button type='button' class='btn btn-secondary' id='cancelBtn' style='font-size:24px'>取消</button>
				<input type='submit' class="btn btn-primary" style="font-size:24px" id="confirmBtn" value='開始計算' >
			</div>
		</div>
		
	</div>
</div>

<div class='modal ' id='dialog2' tabindex='-1' role='dialog' >
	<div class='modal-dialog modal-dialog-centered' role='document'>
		<div class='modal-content' style="background-color:rgb(250,214,137);">
			<div class='modal-header'>
				<h2 class='modal-title' style='font-family:微軟正黑體;color:rgb(0,137,108) ;'>計算結果</h2>
			</div>
			
			<div class='modal-body'>
			<script
				var Probility= 'calculate.php' 
			></script>
			</div> 
			<div class='modal-footer'>
				<button type='button' class='btn btn-secondary' id='cancelBtn' style='font-size:24px'>取消</button>
				<input type='submit' class="btn btn-primary" style="font-size:24px" id="confirmBtn" value='開始計算' >
			</div>
		</div>
		

	</div>
</div>





<!---------------------old----------modal--------------------------------------------------->	

<!--
<div class='modal ' id='dialog1' tabindex='-1' role='dialog' >
	<div class='modal-dialog modal-dialog-centered' role='document'>
		<div class='modal-content' style="background-color:rgb(250,214,137);">
			<div class='modal-header'>
				<h2 class='modal-title' style='font-family:微軟正黑體;color:rgb(0,137,108) ;'>懶人計算法</h2>

			</div>
				<div class='modal-body'>
					<form action="./calculate.php" method="post">
						<div class="form-group mb-3">
							  <label  for="location" style='font-size:20px'>你現在身處位置</label>
							  <select class="form-control" >
								<option value="1">大一女</option>
								<option value="2">博雅</option>
								<option value="3">研一</option>
							  </select>
						</div>
						<div class="form-group mb-3">
							  <label  for="inputGroupSelect01" style='font-size:20px'>今天禮拜幾</label>
							  <select class="form-control" id="inputGroupSelect01">
								<option value="1">一</option>
								<option value="2">二</option>
								<option value="3">三</option>
								<option value="4">四</option>
								<option value="5">五</option>
								<option value="6">六</option>
								<option value="7">日</option>
							  </select>
						</div>
						<div class="form-group mb-3">
							<div class="input-group mb-3">
							  <div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1" style='font-size:20px;font-weight:700;'>現在時間</span>
							  </div>
							  <input type="text" class="form-control" placeholder="ex:  1800" aria-label="Username" aria-describedby="basic-addon1">
							</div>
						</div>
						<div class="form-group mb-3">
							<div class="input-group mb-3">
							  <div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1" style='font-size:20px;font-weight:700;'>預計停留時間(min)</span>
							  </div>
							  <input type="text" class="form-control" placeholder="ex:  15" aria-label="Username" aria-describedby="basic-addon1">
							</div>
						</div>						
					</form>
				</div>
			</div>
			<div class='modal-footer'>
				<button type='button' class='btn btn-secondary' id='cancelBtn' style='font-size:24px'>取消</button>
				<button type='button' class='btn btn-primary' id='confirmBtn' style='font-size:24px'>開始計算</button>
			</div>
		</div>
	</div>

-->

	<!-----------------------------------------------script--------------------------------------------------->	
<script src="./js/map.js"></script>         <!-- include map.js here because it must appear after <div id="map"> -->
<script src="./js/main.js"></script>
<script src="./js/draw.js"></script>
