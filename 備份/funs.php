<?php

######################################################################
#
# enable php session 
#
######################################################################
//簡易寫法,但是容易出錯
//session_start();
//複雜且較安全的寫法 (當php非在cli環境下執行,且尚未執行過session_start())
if(php_sapi_name()!= "cli" && session_status() == PHP_SESSION_NONE) 
  session_start();

//是否已經通過登入認證
function isAuthenticated(){
  if(isset($_GET['signout'])){  //當觸發登出時
    unset($_SESSION['authenticated']);  //解除session:authenticated
    include(__DIR__."/signout.php");
    return false;
  }else if(!isset($_SESSION['authenticated'])){
    if(isset($_POST['user'])){  //當有登入動作時,進行帳號密碼判斷
      if($_POST['user']=='test' && $_POST['pswd']=='abc@123456'){ //簡易的帳號密碼判斷,未來可更改為使用資料庫判斷
        $_SESSION['authenticated']=true;
      }
    }
  }
  
  if(isset($_SESSION['authenticated']))
    return true;
  else
    return false; //回傳false,讓後面的程式知道還沒有通過登入認證
}

//是否從首頁進入
function isIndex(){
  if($_SERVER['SCRIPT_NAME']=='/PartTwo/OpenGIS/PartThree/index.php')    //$_SERVER['SCRIPT_NAME'] 執行中的PHP的檔名
    return true;
  else
    return false;
}

function stop(){
  header("HTTP/1.0 404 Not Found");
  exit;
}

//禁止從非index.php進入
if(!isIndex()){
  stop();
}