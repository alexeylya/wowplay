<?php

	if ($ConnectDB[$realm_num]) {
			$tkills_db = @mysql_query("SELECT name, race, guid, gender, class, account, totalKills FROM `".$mysql_db_characters[$realm_num]."`.`characters` ORDER BY totalKills DESC LIMIT 0,50", $ConnectDB[$realm_num]);
			if ($tkills_db) {
				$tkills_page_text = 
					"
					<table cellspacing=\"0\" class=\"list_table\">
						<thead>
							<tr height=\"33\">
								<th width=\"100\">".@$str[$lang]['76']."</th>
								<th width=\"300\">".@$str[$lang]['32']."</th>
								<th width=\"100\">".@$str[$lang]['33']."</th>
								<th width=\"100\">".@$str[$lang]['34']."</th>
								<th width=\"300\">".@$str[$lang]['77']."</th>
							</tr>
						</thead>
					";
				$i = "1";
				$pos_n = "1";
				while($result = mysql_fetch_array($tkills_db)){
					$tkills_page_text .= 
						"
							<tr>
								<td class=\"col$i\" align=\"center\">$pos_n</a></td>
								<td class=\"col$i\" align=\"center\">".$result['name']."</a></td>
								<td class=\"col$i\" align=\"center\"><img src=\"./style/images/icon/".$result['race']."-".$result['gender'].".gif\" height=\"18\" width=\"18\" onmouseover=\"Tip('".@$str[$lang]['39'][$result['gender']][$result['race']]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"></td>
								<td class=\"col$i\" align=\"center\"><img src=\"./style/images/icon/".$result['class'].".gif\" height=\"18\" width=\"18\" onmouseover=\"Tip('".@$str[$lang]['38'][$result['gender']][$result['class']]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"></td>
								<td class=\"col$i\" align=\"center\">".$result['totalKills']."</td>
							</tr>
						";
					$pos_n++;
					if ($i=="1") {$i="2";} else {$i="1";}
				}
				$tkills_page_text .= "</table>";
			} else { $tkills_page_text =
						"<br>
						<center>".@$str[$lang]['48']."</center>
						<br>";}
	} else { $tkills_page_text =
				"<br>
				<center>".@$str[$lang]['44']."</center>
				<br>";}
?>
<div class="mb_top"></br><div class="news-title"><center><?php echo @$str[$lang]['79'];?> <?php echo $realm_title[$realm_num];?></center></div></div><br>
<div class="mb_main">
	<?php echo $tkills_page_text;?>
</div>
<div class="mb_down"></div>
