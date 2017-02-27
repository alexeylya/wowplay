<!DOCTYPE html>


	<?php

	include_once './include/a.charset.php';
	include_once './include/config.php';
	include_once './include/functions.php';
	include_once './include/string.php';
	$query = charset_x_win($query);
    
	if (isset($_GET['lang'])) {
		if (preg_match("/^[0-9]+$/", $_GET['lang'])) {
			@$lang = $_GET['lang'];
			$_SESSION['lang'] = $lang;
			if ($lang < '1' || $lang > $lang_count) { $lang = '1'; $_SESSION['lang'] = '1';} 
		} else { $lang = '1'; $_SESSION['lang'] = '1';}
	}
	
	if (isset($_SESSION['lang'])) {
		if (preg_match("/^[0-9]+$/", $_SESSION['lang'])) {
			@$lang = $_SESSION['lang'];
			if ($lang < '1' || $lang > $lang_count) { $lang = '1'; $_SESSION['lang'] = '1';} 
		} else { $lang = '1'; $_SESSION['lang'] = '1';}
	} else { $lang = '1'; $_SESSION['lang'] = '1';}
	
	if (isset($_GET['page'])) {
		if (preg_match("/^[a-zA-Z0-9_]+$/", $_GET['page'])) {
			@$page = strtolower($_GET['page']);
		} else { $page = 'main'; }
	} else { $page = 'main'; }
	
	if (isset($_GET['do'])) {
		if (preg_match("/^[a-zA-Z0-9_]+$/", $_GET['do'])) {
			@$do = strtolower($_GET['do']);
		} else { $do = ''; }
	} else { $do = ''; }
	
	if (isset($_GET['realm'])) {
		if (preg_match("/^[0-9]+$/", $_GET['realm'])) {
			@$realm_num = $_GET['realm'];
			if ($realm_num < '1' || $realm_num > $realm_count) { $realm_num = '1';} 
		} else { $realm_num = '1'; }
	} else { $realm_num = '1'; }
	
	if (isset($_GET['guid'])) {
		if (preg_match("/^[0-9]+$/", $_GET['guid'])) {
			@$guid = $_GET['guid'];
		} else { $guid = '1'; }
	} else { $guid = '1'; }
	
	if (isset($_GET['vote'])) {
		if (preg_match("/^[0-9]+$/", $_GET['vote'])) {
			@$vote = $_GET['vote'];
			if ($vote < '1' || $vote > $vote_count) { $vote = '';} 
		} else { $vote = ''; }
	} else { $vote = ''; }
	
	if (isset($_SESSION['logined'][$realm_num])) { 
		@$user_logined[$realm_num] = $_SESSION['logined'][$realm_num];
		@$user_guid[$realm_num] = $_SESSION['acc_id'][$realm_num];
	} else { $user_logined[$realm_num] = '0'; }
	
	if ($page == "main"){
		$page_mtitle = @$str[$lang]['0'];
		$page_path = "./modules/main/main_page_$lang.php";
	} elseif($page == "rules"){
		$page_mtitle = @$str[$lang]['1'];
		$page_path = "./modules/rules/rules_page_$lang.php";
	} elseif($page == "about"){
		$page_mtitle = @$str[$lang]['2'];
		$page_path = "./modules/about/about_page_$lang.php";
	} elseif($page == "transfer"){
		$page_mtitle = @$str[$lang]['3'];
		$page_path = "./modules/transfer/transfer_page_$lang.php";
	} elseif($page == "license"){
		$page_mtitle = @$str[$lang]['4'];
		$page_path = "./modules/license/license_page_$lang.php";
	} elseif($page == "online"){
		$page_mtitle = @$str[$lang]['5'];
		$page_path = "./modules/online_page.php";
	} elseif($page == "connect"){
		$page_mtitle = @$str[$lang]['6'];
		$page_path = "./modules/connect/connect_page_$lang.php";
//	} elseif($page=="ban"){
//		$page_mtitle = @$str[$lang]['7'];
//		$page_path = "./modules/ban_page.php";
//	} elseif($page=="reg"){
//		$page_mtitle = @$str[$lang]['8'];
//		$page_path = "./modules/reg_page.php";
	} elseif($page=="statistics"){
		$page_mtitle = @$str[$lang]['9'];
		$page_path = "./modules/statistics_page.php";
	} elseif($page=="tkills"){
		$page_mtitle = @$str[$lang]['10'];
		$page_path = "./modules/tkills_page.php";
	} elseif($page=="tgold"){
		$page_mtitle = @$str[$lang]['11'];
		$page_path = "./modules/tgold_page.php";
	} elseif($page=="tonline"){
		$page_mtitle = @$str[$lang]['12'];
		$page_path = "./modules/tonline_page.php";
	} 
	elseif($page=="addnews"){
		$page_mtitle = @$str[$lang]['13'];
		$page_path = "./modules/addnew/addnews.php";
	} 
	elseif($page=="ononline"){
		$page_mtitle = @$str[$lang]['5'];
		$page_path = "./modules/main_online.php";
	} 
	elseif($page=="tgoldmain"){
		$page_mtitle = @$str[$lang]['11'];
		$page_path = "./modules/main_tgold.php";
	} 
	elseif($page=="tkillsmain"){
		$page_mtitle = @$str[$lang]['10'];
		$page_path = "./modules/main_tkills.php";
	} 
	elseif($page=="statisticsmain"){
		$page_mtitle = @$str[$lang]['9'];
		$page_path = "./modules/main_statistics.php";
	} 
	elseif($page=="tonlinemain"){
		$page_mtitle = @$str[$lang]['12'];
		$page_path = "./modules/main_tonline.php";
	} 
	elseif($page=="404"){
		$page_mtitle = @$str[$lang]['14'];
		$page_path = "./modules/error/err404.php";
//	} elseif($page=="lk" && $do=="buy"){
//		$page_mtitle = @$str[$lang]['14'];
//		$page_path = "./modules/lk/buy_page.php";
//	} elseif($page=="lk" && $do=="getbonuses"){
//		$page_mtitle = @$str[$lang]['14'];
//		$page_path = "./modules/lk/donate_page.php";
//	} elseif($page=="lk" && $do=="buyitem"){
//		$page_mtitle = @$str[$lang]['14'];
//		$page_path = "./modules/lk/buy_item_page.php";
//	}  elseif($page=="lk" && $do=="buylvl"){
//		$page_mtitle = @$str[$lang]['14'];
//		$page_path = "./modules/lk/buy_lvl_page.php";
//	} elseif($page=="lk" && $do=="buygold"){
//		$page_mtitle = @$str[$lang]['14'];
//		$page_path = "./modules/lk/buy_gold_page.php";
//	} elseif($page=="lk"){
//		$page_mtitle = @$str[$lang]['14'];
//		$page_path = "./modules/lk/main.php";
	} else {
		$page_mtitle = @$str[$lang]['0'];
		$page_path = "./modules/main/main_page_$lang.php";
	}
	for ($i = 1; $i <= $realm_count; $i++) {
		$sql = @mysql_query("SET NAMES utf8_general_ci");
		$ConnectDB[$i] = @mysql_connect($mysql_path[$i], $mysql_login[$i], $mysql_password[$i]);
		$fp[$i] = @fsockopen ($server_path[$i], $server_port[$i], $errno, $errstr, 0.5);
		@mysql_query("SET NAMES '$mysql_cod'", $ConnectDB[$i]);
	}
	
	$ConnectDB['cms'] = @mysql_connect($mysql_path['cms'], $mysql_login['cms'], $mysql_password['cms']);
	@mysql_query("SET NAMES '$mysql_cod'", $ConnectDB['cms']);
?>
<html lang="ru">
<head>
<style>a { cursor: url(/style/images/arrow.cur), pointer; }</style>
<title><?php echo $site_title;?></title>
<link rel="stylesheet" type="text/css" href="templates/main/css/styles.css">
<link type="text/css" href="./style/main.css" rel="stylesheet" />
<script type="text/javascript" src="./style/main.js"></script>
<script type="text/javascript" src="./style/utils.js"></script>
<script type="text/javascript" src="./style/my_tooltip.js"></script>
<link rel="shortcut icon" href="./favicon.ico" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.js "></script>
<script src="templates/main/js/jquery.tools.min.js"></script>
<script src="templates/main/js/jquery.fancybox-1.3.4.pack.js"></script>
<script src="templates/main/js/jquery.easing.1.3.js"></script>
<script src="templates/main/js/tms-0.3.js"></script>
<script src="templates/main/js/script.js"></script>	
<script type="text/javascript" src="//wow.zamimg.com/widgets/power.js"></script><script>var wowhead_tooltips = { "colorlinks": true, "iconizelinks": true, "renamelinks": true }</script>
<script type="text/javascript" src="//vk.com/js/api/openapi.js?105"></script>
<meta name="robots" value="noindex" />
<script type="text/javascript">
	
function getText(){
  $('#text').show(1000);
  $('#lalka123').show(1000);
}
</script>	
<script type="text/javascript">
function closeText(){
  $('#text').hide(1000);
  $('#lalka123').hide(1000);

}
</script>
<script type="text/javascript">
function getText1(){
  $('#text1').show(1000);
    $('#lalka124').show(1000);
}
</script>	
<script type="text/javascript">
function closeText1(){
  $('#text1').hide(1000);
      $('#lalka124').hide(1000);
}
</script>
<script type="text/javascript">
function getText2(){
  $('#text2').show(1000);
}
</script>	
<script type="text/javascript">
function closeText2(){
  $('#text2').hide(1000);
}
</script>	
<?php include './modules/addnew/abb.php';?>
<!--132-->
</head>

<body>
<header>
<!--Меню-->
<div class="main-menu">
<?php include './modules/main-menu.php';?>
</div>
<!--Меню-->
</header>
<div class="top-line">
</div>
<article>
<div class="left-column">
<!--Общий онлайн
<div id="page-preloader"><span class="spinner"></span></div>-->
<?php include './modules/online.php';?>
<!--Общий онлайн-->

<!--Слайдер-->		
<?php include './modules/slider.php';?>
<!--Слайдер-->		
						
<div style="margin-top:-140px;"></div>

<!--Новости-->	
<?php include './modules/fullnews.php';?>
<!--Новости-->
</div>	
	
<div class="right-column">
<!--block-->
<div class="go-block">
<?php include './modules/block.php';?>
</div>
<!--block-->

<!--realm-->			
<div class="realm-status-bg">		
<?php include './modules/realm.php';?>
</div>	
<!--realm-->

<!--client-->
<div class="client-bg">
<?php include './modules/client.php';?>
</div>
<!--client-->

<div class="clear">
</div>
<div class="player-bg">
<a class="player-play" href="https://www.youtube.com/embed/MU-8wrNgurM" id="showvideo"></a>
</div>
<div class="books-bg">
<div class="books-horde">
<a href="http://ru.wowhead.com/"></a>
</div>
</div>
			
<div class="login-bg">
<div class="login-bg-razmetka">
<?php include './modules/wm_page.php';?>
</div>
</div>
<div class="vk-group">
<center>
<div id="vk_groups" style="padding-top:60px;"></div>

<script type="text/javascript" src="//vk.com/js/api/openapi.js?122"></script>

<div id="vk_groups"></div>
<script type="text/javascript">
VK.Widgets.Group("vk_groups", {redesign: 1, mode: 3, width: "250", height: "400", color1: '02150f', color2: 'db941a', color3: 'f0e2bc'}, 69608473);
</script></center>

</div>
</div>
<div class="clear">
</div>
</article>
</br></br>
<div class="content-bg-bottom">
<?php include './modules/footer.php';?>
</div>
	

<div class="videoplayer">asd</div>
<script>
		$(".trigger").tooltip({
          effect: 'fade',
          fadeOutSpeed: 50,
          predelay: 100,
          position: "bottom left",
          offset: [-45, 20]
		  });
	</script>
</body>
</html>
<?php 
	for ($i = 1; $i <= $realm_count; $i++) {
		@mysql_close($ConnectDB[$i]);
		@fclose($fp[$i]);
	}
?>
