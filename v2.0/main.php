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
			<option value="">全部</option> 
			<option value="">若要選擇請先選擇月份!</option> 
		  </select>
	</div>
	
	<div class="form-group mb-3">
		  <label  for="time" style='font-size:20px;color:white'>時間</label>
		  <select class="form-control" id="time" name="time" type='submit'>
		    <option value="dayAll">全天</option>
			<option value="morning">上午</option>
			<option value="noon">中午</option>
			<option value="afternoon">下午</option>
			<option value="night">晚上</option>
			
		  </select>
	</div>
	</form>
	<button class="btn btn-primary" style="font-size:20px" id="chooseBtn" >篩選</button>

  
  </div>
  <div id="map"></div>
</div>
<!-----------------------------------------------modal--------------------------------------------------->	
<div class='modal ' id='dialog1' tabindex='-1' role='dialog' >
	<div class='modal-dialog modal-dialog-centered' role='document'>
		<div class='modal-content' style="background-color:rgb(250,214,137);">
			<div class='modal-header'>
				<h2 class='modal-title' style='font-family:微軟正黑體;color:rgb(0,137,108) ;'>懶人計算法</h2>

			</div>
				<div class='modal-body'>
					<form>
						<div class="form-group mb-3">
							  <label  for="inputGroupSelect01" style='font-size:20px'>你現在身處位置</label>
							  <select class="form-control" id="inputGroupSelect01">
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
	<!-----------------------------------------------script--------------------------------------------------->	
<script src="./js/map.js"></script>         <!-- include map.js here because it must appear after <div id="map"> -->
<script src="./js/main.js"></script>
<script src="./js/draw.js"></script>
