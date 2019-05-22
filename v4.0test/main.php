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
	<form action="/getGeojson.php" method="post">
		<div class="form-group mb-3">
			  <label  for="month" style='font-size:20px;color:white'>月份</label>
			  <select class="form-control" id="month"  name="month" onchange="changeday('day', this.value)" >
				<option value="0">全部</option> 
				<option value="9">9月</option>
				<option value="10">10月</option>
				<option value="11">11月</option>
			  </select>
		</div>
	  

		<div class="form-group mb-3">
			  <label  for="day" style='font-size:20px;color:white' >日期</label>
			  <select class="form-control" id="day" name="day" >
				<option value="">全部</option> 
				<option value="">若要選擇請先選擇月份!</option> 
			  </select>
		</div>
		
		<div class="form-group mb-3">
			  <label  for="time" style='font-size:20px;color:white'>時間</label>
			  <select class="form-control" id="time" name="time" >
				<option value="dayAll">全天</option>
				<option value="morning">上午</option>
				<option value="noon">中午</option>
				<option value="afternoon">下午</option>
				
			  </select>
		</div>
		<input type='submit' class="btn btn-primary" style="font-size:20px" id="chooseBtn" value='篩選' >
	</form>
	

  
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
				<form action="/getGeojson.php" method="post">
					<div class="form-group mb-3">
						  <label  for="location" style='font-size:20px'>你現在身處位置</label>
						  <select class="form-control" id="location"><option value="大一女">大一女</option>
							<option value="大門">大門</option>
							<option value="博雅">博雅</option>
							<option value="小福">小福</option>
							<option value="管院">管院</option>
							<option value="男一">男一</option>
							<option value="活大">活大</option>
							<option value="舟山路">舟山路</option>
							<option value="共同">共同</option>
							<option value="工綜">工綜</option>
							<option value="社科院">社科院</option>
							<option value="文學院">文學院</option>
							<option value="男八">男八</option>
							<option value="水源">水源</option>
							<option value="農化館">農化館</option>
							<option value="男五">男五</option>
							<option value="行政大樓">行政大樓</option>
							<option value="化工">化工</option>
							<option value="生命科學">生命科學</option>
							<option value="教研館">教研館</option>
							<option value="管院一號館">管院一號館</option>
							<option value="男三">男三</option>
							<option value="電機二">電機二</option>
							<option value="凝態">凝態</option>
							<option value="研一">研一</option>
							<option value="萬才">萬才</option>
							<option value="新體">新體</option>
							<option value="大氣">大氣</option>
							<option value="博理館">博理館</option>
							<option value="總圖">總圖</option>
							<option value="校史館">校史館</option>
							<option value="農綜">農綜</option>
							<option value="土木">土木</option>
							<option value="普通">普通</option>
							<option value="女八女九">女八女九</option>
							<option value="明達館">明達館</option>
							<option value="資工系">資工系</option>
							<option value="舊哲">舊哲</option>
							<option value="海洋所">海洋所</option>
							<option value="國青">國青</option>
							<option value="新生">新生</option>
							<option value="工科海洋">工科海洋</option>
							<option value="圖資">圖資</option>
							<option value="二活">二活</option>
							<option value="社會系">社會系</option>
							<option value="心輔中心">心輔中心</option>
							<option value="森林">森林</option>
							<option value="舊數">舊數</option>
							<option value="生科">生科</option>
							<option value="新聞所">新聞所</option>
							<option value="霖澤館">霖澤館</option>
							<option value="計中">計中</option>
							<option value="第二會議中心">第二會議中心</option>
							<option value="電機一">電機一</option>
							<option value="獸醫">獸醫</option>
							<option value="天數">天數</option>
							<option value="男七">男七</option>
							<option value="知武館">知武館</option>
							<option value="保管組">保管組</option>
							<option value="人類">人類</option>
							<option value="化學">化學</option>
							<option value="園藝">園藝</option>
							<option value="舊體">舊體</option>
							<option value="體育場">體育場</option>
							<option value="物理">物理</option>
							<option value="經濟">經濟</option>
							<option value="農藝館">農藝館</option>
							<option value="小小福">小小福</option>
							<option value="花卉館">花卉館</option>
							<option value="城鄉所">城鄉所</option>
							<option value="鹿鳴堂">鹿鳴堂</option>
							<option value="管院二號館">管院二號館</option>
							<option value="戲劇">戲劇</option>
							<option value="心理系">心理系</option>
							<option value="生研所">生研所</option>
							<option value="昆蟲館">昆蟲館</option>
							<option value="管院ㄧ號館">管院ㄧ號館</option>
							<option value="海研">海研</option>
							<option value="漁研">漁研</option>
							<option value="環工所">環工所</option>
							<option value="舊機械">舊機械</option>
							<option value="中非大樓">中非大樓</option>
							<option value="天數館">天數館</option>
							<option value="海工所">海工所</option>
							<option value="應力館">應力館</option>
							<option value="外語">外語</option>
							<option value="地質">地質</option>
							<option value="保健中心">保健中心</option>
							<option value="思亮館">思亮館</option>
							<option value="食品科學館">食品科學館</option>
							<option value="語言中心">語言中心</option>
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
	<!-----------------------------------------------script--------------------------------------------------->	
<script src="./js/map.js"></script>         <!-- include map.js here because it must appear after <div id="map"> -->
<script src="./js/main.js"></script>

