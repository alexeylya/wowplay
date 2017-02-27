<link rel="stylesheet" type="text/css" href="templates/main/css/styles.css">
<link type="text/css" href="./style/main.css" rel="stylesheet" />
<script type="text/javascript" src="./style/main.js"></script>
<?php 
$conf = array( 
'host' => 'mysql.hostinger.ru', // хост базы данных 
'user' => 'u925597011_123', // логин базы данных 
'pass' => '29061994', // пароль базы данных 
'db' => 'u925597011_123', // название базы форума 
'url_forum' => 'wow-play.ru/forum', // url путь до форума 
//'int' => 1,5, // количество отображение последних тем 
'coder' => 'cp1251', // кодировка вывода из базы 
'prefix' => '' // префикс таблиц базы 
); 


function connect($config) { 
$db = @mysql_connect($config['host'], $config['user'], $config['pass']); 
if (!$db) { 
exit('error connect DB'); 
} else { 
mysql_query("SET NAMES {$config['coder']}"); 
if (mysql_select_db($config['db'])) { 
return $db; 
} else { 
exit('not found DB->' . $config['db']); 
} 
} 
} 

function theme_forum_db($prefix, $int) { 
$zap = 'SELECT tid, title FROM ' . $prefix . 'topics ORDER BY start_date desc LIMIT 1,5'; 
if ($query = mysql_query($zap)) { 
while ($result = mysql_fetch_assoc($query)) { 
if (!is_null($result)) { 
$n[] = $result; 
} else { 
$n = ''; 
} 
} 
return @$n; 
mysql_close(); 
} else { 
exit('error table DB'); 
} 
} 

function theme($conf) { 
connect($conf); 
$theme = theme_forum_db($conf['prefix'], $conf['int']); 
if (!is_null($theme)) { 
foreach ($theme as $result) { 
$tm .= '<tr></tr><td><a class="tooltip" href="' . $conf['url_forum'] . 'index.php?/topic/' . $result['tid'] . '-' . $result['tid'] . '/">' . $result['title'] . '</a></td>'; 
} 
} else { 
$tm = '<tr></tr><td><h6>нет тем на форуме</h6></td>'; 
} 
return $tm; 
} 
?>  

<table> 
<? echo theme($conf); ?> 
</table>