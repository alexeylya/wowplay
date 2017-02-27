<?php 
include_once './include/config.php';
mysql_connect ("$dbip:$dbport","$dblogin","$dbpass");  
mysql_select_db ("$cdb");  
$online = @mysql_query ("select count(*) from characters where online = 1");  
$online = @mysql_result ($online,0);  
$allianceonline = @mysql_query ("select count(*) from characters where online = 1 and race in (1,3,4,7,11)");  
$allianceonline = @mysql_result ($allianceonline,0);  
$hordeonline = @mysql_query ("select count(*) from characters where online = 1 and race in (2,5,6,8,10)");  
$hordeonline = @mysql_result ($hordeonline,0);  
@mysql_selectdb ("$rdb");  
$max = @mysql_query ("select max(`maxplayers`) from uptime WHERE `realmid`= '1'");          
$max = @mysql_result ($max,0);  
?>

<?php 
include_once './include/config.php';
mysql_connect ("$dbip:$dbport","$dblogin","$dbpass");  
mysql_select_db ("$cdb");  
$online = mysql_query ("select count(*) from characters where online = 1");  
$online = mysql_result ($online,0);  
?>

<?php  
include_once './include/config.php';
mysql_connect ("$dbip:$dbport","$dblogin","$dbpass");        
   mysql_select_db ("$rdb");            
   $uptime = mysql_query ("select max(`starttime`) from `uptime` WHERE `realmid`= '1'");            
   $uptime = time()-mysql_result ($uptime,0);            
   $sec = $uptime%60;            
   $uptime = intval ($uptime/60);            
   $min = $uptime%60;            
   $uptime = intval ($uptime/60);            
   $hours = $uptime%24;            
   $uptime = intval($uptime/24);                 
   $days = $uptime;           
?> 

<?php 
include_once './include/config.php';
mysql_connect ("$dbip2:$dbport2","$dblogin2","$dbpass2");  
mysql_select_db ("$cdb2");  
$online1 = mysql_query ("select count(*) from characters where online = 1");  
$online1 = mysql_result ($online1,0);  
?>
<?php 
include_once './include/config.php';
mysql_connect ("$dbip2:$dbport2","$dblogin2","$dbpass2");  
mysql_select_db ("$cdb2");  
$online1 = mysql_query ("select count(*) from characters where online = 1");  
$online1 = mysql_result ($online1,0);  
$allianceonline1 = mysql_query ("select count(*) from characters where online = 1 and race in (1,3,4,7,11)");  
$allianceonline1 = mysql_result ($allianceonline1,0);  
$hordeonline1 = mysql_query ("select count(*) from characters where online = 1 and race in (2,5,6,8,10)");  
$hordeonline1 = mysql_result ($hordeonline1,0);  
@mysql_selectdb ("$rdb2");  
$max1 = mysql_query ("select max(`maxplayers`) from uptime WHERE `realmid`= '2'");          
$max1 = mysql_result ($max1,0);  
?>
