
<?php
$_GET["id"];
$namechar = $_GET["id"];
mysql_connect ("$host","$user","$password") or die ('Нет соединения с хостом!');        
mysql_select_db ("$saitbd") or die ('Нет соединения с базой!');  
mysql_query("set names UTF8"); 
   $result = mysql_query("SELECT * FROM news WHERE id = $namechar");

$myrow = mysql_fetch_array($result);



	echo 	
		"
											
			
				<div class=\"full-news\">
<center><div class=\"full-news-name\">".$myrow['nazva']."</div></center>
</br></br></br>
<div class=\"full-news-text\">
".$myrow['textfull']."
</br>

<script type=\"text/javascrip\" src=\"//vk.com/js/api/openapi.js?139\"></script>
<script type=\"text/javascript\">
  VK.init({apiId: 5884059, onlyWidgets: true});
</script>
<div id=\"vk_like\"></div>
<script type=\"text/javascript\">
VK.Widgets.Like(\"vk_like\", {type: \"button\", height: 18});
</script>

</div>


</div>
				
		";
		
?>
