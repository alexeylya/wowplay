<?php
mysql_connect ("$host","$user","$password" ) or die ('Нет соединения с хостом!');        
mysql_select_db ("$saitbd") or die ('Нет соединения с базой!');  
mysql_query("set names UTF8"); 
   $result = mysql_query("SELECT * FROM news ORDER BY id DESC LIMIT 5");

while($myrow = mysql_fetch_array($result)){



	echo 	
		"
											<div class=\"news-bg\">
				<div class=\"news-title\"><a href=\"./new.php?id=".$myrow['id']."\">".$myrow['nazva']."</a></div>
				<div class=\"news-info\">".$myrow['data']."</div>
				<div class=\"news-image-bg\"><div id=\"img_news_otstup\"><img style=\"width:158px;height:118px;border:2px solid #6e2c77;\" src=\"".$myrow['images']."\" alt=\"\"></div></div>
				<br>
				<div class=\"news\">
					
".$myrow['textmini']."

				</div>

			</div>
		";
		}
?>