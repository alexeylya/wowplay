<?php
	if ($ConnectDB[$realm_num]) {
			$tkills_db = @mysql_query("SELECT name, race, guid, gender, class, account, totaltime FROM `".$mysql_db_characters[$realm_num]."`.`characters` ORDER BY totaltime DESC LIMIT 0,50", $ConnectDB[$realm_num]);
			if ($tkills_db) {
				$tonline_page_text = 
					"
					<table cellspacing=\"0\" class=\"list_table\">
						<thead>
							<tr height=\"33\">
								<th width=\"100\">".@$str[$lang]['76']."</th>
								<th width=\"300\">".@$str[$lang]['32']."</th>
								<th width=\"100\">".@$str[$lang]['33']."</th>
								<th width=\"100\">".@$str[$lang]['34']."</th>
								<th width=\"300\">".@$str[$lang]['82']."</th>
							</tr>
						</thead>
					";
				$i = "1";
				$pos_n = "1";
				while($result = mysql_fetch_array($tkills_db)){
					$time_text = "";
					$seconds = $result['totaltime'];
					if ($seconds >= 24*3600) {$time_text.= intval($seconds/(24*3600))." д"; if ($seconds%=24*3600) $time_text.=" ";
					} elseif ($seconds >= 3600) {$time_text.= intval($seconds/3600)." ч"; if ($seconds%=3600) $time_text.=" ";
					} elseif ($seconds >= 60) {$time_text.= intval($seconds/60)." м"; if ($seconds%=60) $time_text.=" ";}
					$tonline_page_text .= 
						"
							<tr>
								<td class=\"col$i\" align=\"center\">$pos_n</a></td>
								<td class=\"col$i\" align=\"center\">".$result['name']."</a></td>
								<td class=\"col$i\" align=\"center\"><img src=\"./style/images/icon/".$result['race']."-".$result['gender'].".gif\" height=\"18\" width=\"18\" onmouseover=\"Tip('".@$str[$lang]['39'][$result['gender']][$result['race']]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"></td>
								<td class=\"col$i\" align=\"center\"><img src=\"./style/images/icon/".$result['class'].".gif\" height=\"18\" width=\"18\" onmouseover=\"Tip('".@$str[$lang]['38'][$result['gender']][$result['class']]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"></td>
								<td class=\"col$i\" align=\"center\">$time_text</td>
							</tr>
						";
					$pos_n++;
					if ($i=="1") {$i="2";} else {$i="1";}
				}
				$tonline_page_text .= "</table>";
			} else { $tonline_page_text =
						"<br>
						<center>".@$str[$lang]['48']."</center>
						<br>";}
	} else { $tonline_page_text =
				"<br>
				<center>".@$str[$lang]['44']."</center>
				<br>";}
?>

<div class="mb_top"></br><div class="news-title"><center><?php echo @$str[$lang]['83'];?></center></div></div><br>
<div class="mb_main">
	<?php echo $tonline_page_text;?>
</div>
<div class="mb_down"></div>
