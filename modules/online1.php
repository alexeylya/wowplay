<div class="obschiu-onlay-bg"><div class="obschiu-onlay-text"><font style="font-size:14px;">
<?  
$date = strtotime("23 february 2017");  
$sec=$date - time();  
$days=floor(($date - time()) /86400);  
$h1=floor(($date - time()) /3600);  
$m1=floor(($date - time()) /60);  
$hour=floor($sec/60/60 - $days*24);  
$hours=floor($sec/60/60);  
$min=floor($sec/60 - $hours*60);  
 
switch(substr($days, -1)){  
case 1: $o='';  
break;  
case 2: case 3: case 4: case 5: case 6: case 7: case 8: case 9: case 0: $o='';  
break;}  
 
switch(substr($days, -2)){  
case 1: $d='день';  
break;  
case 2: case 3: case 4: $d='дня';  
break;  
default: $d='дней';  
}  
 
switch(substr($hour, -2)) {  
case 1: $h='час';  
break;  
case 2: case 3: case 4: $h='часа';  
break;  
default: $h='часов';  
}  
 
switch(substr($min, -2)) {  
case 1: $m='минута';  
break;  
case 2: case 3: case 4: $m='минуты';  
break;
default:$m='минут';
}   
?>  
<? if ($sec>0) echo '<strong>До открытия&nbsp;'.$o.':&nbsp</strong>'; ?>
<strong><? if ($days>0) echo $days.'&nbsp;'.$d; ?>,
<? if ($h1>0) echo '&nbsp;'.$hour.'&nbsp;'.$h; ?>
<? if ($m1>0) echo '&nbsp;и&nbsp;'.$min.'&nbsp;'.$m; ?></strong>
<strong><? if ($sec<0) echo ("Открытие сегодня!!!"); ?></strong>

</font></div></div>