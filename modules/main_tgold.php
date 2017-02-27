<?php
$tgoldmain_page_text .= 
"
<table cellspacing=\"0\" class=\"list_table\" width=\"50%\">
<tr>
<td align=\"center\"><a onfocus=\"this.blur()\" href=\"./?page=tgold&realm=1\"><img src=\"./style/images/armory/pcnamechange.png\" onmouseover=\"Tip('".$str[$lang]['39'][0][10]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"')\"><br>".$realm_title['1']."</a>
<td align=\"center\"><a onfocus=\"this.blur()\" href=\"./?page=tgold&realm=2\"><img src=\"./style/images/armory/pcnamechange.png\" onmouseover=\"Tip('".$str[$lang]['39'][0][10]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"')\"><br>".$realm_title['2']."</a>
</tr>
</table>
";
?>
<div class="news-title"><center><?php echo @$str[$lang]['81'];?> <?php echo @$str[$lang]['180'];?></center></div>
<div class="mb_main">
<br><br><br>
<div class="opacity pic">
<center><?php echo $tgoldmain_page_text;?></center>

</div>
</div>
<div class="mb_down"></div>