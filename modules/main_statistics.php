<?php
$statistics_page_text .= 
"
<table cellspacing=\"0\" class=\"list_table\" width=\"50%\">
<tr>
<td align=\"center\"><a onfocus=\"this.blur()\" href=\"./?page=statistics&realm=1\"><img src=\"./style/images/armory/icon_lock.png\" onmouseover=\"Tip('".$str[$lang]['59']."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"')\"><br>".$realm_title['1']."</a>
<td align=\"center\"><a onfocus=\"this.blur()\" href=\"./?page=statistics&realm=2\"><img src=\"./style/images/armory/star2.png\" onmouseover=\"Tip('".$str[$lang]['59']."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"')\"><br>".$realm_title['2']."</a>
</tr>
</table>
";
?>
<div class="news-title"><?php echo @$str[$lang]['59'];?> <?php echo @$str[$lang]['180'];?></div>
<div class="mb_main">
<br><br><br>
<div class="opacity pic">
	<center><?php echo $statistics_page_text;?></center>
</div>
</div>
<div class="mb_down"></div>