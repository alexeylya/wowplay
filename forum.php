<link rel="stylesheet" type="text/css" href="templates/main/css/styles.css">
<link type="text/css" href="./style/main.css" rel="stylesheet" />
<script type="text/javascript" src="./style/main.js"></script>
<?php 
$conf = array( 
'host' => 'mysql.hostinger.ru', // ���� ���� ������ 
'user' => 'u925597011_123', // ����� ���� ������ 
'pass' => '29061994', // ������ ���� ������ 
'db' => 'u925597011_123', // �������� ���� ������ 
'url_forum' => 'wow-play.ru/forum', // url ���� �� ������ 
//'int' => 1,5, // ���������� ����������� ��������� ��� 
'coder' => 'cp1251', // ��������� ������ �� ���� 
'prefix' => '' // ������� ������ ���� 
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
$tm = '<tr></tr><td><h6>��� ��� �� ������</h6></td>'; 
} 
return $tm; 
} 
?>  

<table> 
<? echo theme($conf); ?> 
</table>