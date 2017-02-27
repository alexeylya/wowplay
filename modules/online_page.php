
<?php

	if ($fp[$realm_num]) {
		if ($ConnectDB[$realm_num]) {
			$online_user_count = getOnlineUserCount($realm_num);
			$page_count = ceil($online_user_count/$page_count_online);
			
			if (isset($_GET['page_num'])) {
				if (preg_match("/^[0-9]+$/", $_GET['page_num'])) {
					$page_num = $_GET['page_num'];
					if ($page_num < '1' || $page_num > $page_count) { $page_num = '1';} 
				} else { $page_num = '1'; }
			} else { $page_num = '1'; }
			$page_num = $page_num - 1;

			if ($online_user_count>"0") {
				$online_user_db = @mysql_query("SELECT name, race, guid, gender, class, level, account FROM `".$mysql_db_characters[$realm_num]."`.`characters` WHERE online = 1 ORDER BY name LIMIT ".($page_count_online*$page_num).",$page_count_online", $ConnectDB[$realm_num]);
				$online_user_count_a = 0;
				$online_user_count_h = 0;
				if ($online_user_db) {
					$online_page_text = 
						"
						<table cellspacing=\"0\" class=\"list_table\">
							<thead>
								<tr height=\"33\">
									<th width=\"300\">".@$str[$lang]['32']."</th>
									<th width=\"100\">".@$str[$lang]['33']."</th>
									<th width=\"100\">".@$str[$lang]['34']."</th>
									<th width=\"100\">".@$str[$lang]['35']."</th>
									<th width=\"100\">".@$str[$lang]['36']."</th>
									<th width=\"300\">".@$str[$lang]['37']."</th>
								</tr>
							</thead>
						";
					
					$i = "1";
					while($result = mysql_fetch_array($online_user_db)){
						$guildid = getGuildFromGuid($result['guid'], $realm_num);
						if ($guildid > 0) { $guidlname = "\"".getGuildNameFromGuildId($guildid, $realm_num)."\""; } else { $guidlname = @$str[$lang]['42'];}
						if ($result['race'] == 1 || $result['race'] == 3 || $result['race'] == 4 || $result['race'] == 7 || $result['race'] == 11) { $char_side = "0"; $online_user_count_a++; } else { $char_side = "1";  $online_user_count_h++; };
						if (getGmlevelFromId($result['account'], $realm_num)>0) {$gm = "<div class=\"online_gm\">".$result['name']."</div>";} else {$gm = $result['name'];}
						$online_page_text .= 
							"
								<tr>
									<td class=\"col$i\" align=\"center\">".$gm."</a></td>
									<td class=\"col$i\" align=\"center\"><img src=\"./style/images/icon/".$result['race']."-".$result['gender'].".gif\" height=\"18\" width=\"18\" onmouseover=\"Tip('".@$str[$lang]['39'][$result['gender']][$result['race']]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"></td>
									<td class=\"col$i\" align=\"center\"><img src=\"./style/images/icon/".$result['class'].".gif\" height=\"18\" width=\"18\" onmouseover=\"Tip('".@$str[$lang]['38'][$result['gender']][$result['class']]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"></td>
									<td class=\"col$i\" align=\"center\"><img src=\"./style/images/icon/side-$char_side.png\" height=\"18\" width=\"18\" onmouseover=\"Tip('".@$str[$lang]['40'][$char_side]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"></td>
									<td class=\"col$i\" align=\"center\">".$result['level']."</td>
									<td class=\"col$i\" align=\"center\">$guidlname</td>
								</tr>
							";
						if ($i=="1") {$i="2";} else {$i="1";}
					}
					
					$online_page_text .= "</table>";
					if ($page_count > 1) {
						$online_page_text .= "<br/><div style=\"text-align: right; widht: 100%; padding-right: 35px;\" >";
						for ($i = 0; $i < $page_count; $i++) {
							if ($i==$page_num) {$online_page_text .= $i+1;} else {$online_page_text .= "<a href=./?page=online&page_num=".($i+1)."&realm=$realm_num>".($i+1)."</a>";}
							if (($i + 1) < $page_count) {$online_page_text .= " - ";}
						}
						$online_page_text .= "</div>";
					}
				} else { $online_page_text =
							"<br>
							<center>".@$str[$lang]['45']."</center>
							<br>";}
			} else { $online_page_text =
						"<br>
						<center>".@$str[$lang]['45']."</center>
						<br>";}
		} else { $online_page_text =
					"<br>
					<center>".@$str[$lang]['44']."</center>
					<br>";}
	} else { $online_page_text =
				"<br>
			 	<center>".@$str[$lang]['43']."</center>
			 	<br>";}
?>
<div class="mb_top"></br><div class="news-title"><center><?php echo @$str[$lang]['41'];?> <?php echo $realm_title[$realm_num];?></center></div></div><br>
<div class="mb_main">
	<?php echo $online_page_text;?>
</div>
<div class="mb_down"></div>
