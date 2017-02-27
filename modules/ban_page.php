<?php
	if ($ConnectDB[$realm_num]) {
		$banned_user_count = getBannedUserCount($realm_num);
		$page_count = ceil($banned_user_count/$page_count_ban);
		
		if (isset($_GET['page_num'])) {
			if (preg_match("/^[0-9]+$/", $_GET['page_num'])) {
				$page_num = $_GET['page_num'];
				if ($page_num < '1' || $page_num > $page_count) { $page_num = '1';} 
			} else { $page_num = '1'; }
		} else { $page_num = '1'; }
		$page_num = $page_num - 1;
		
		if ($banned_user_count > 0) {
			$banned_user_db = @mysql_query("SELECT id, bandate, unbandate, bannedby, banreason FROM `".$mysql_db_realmd[$realm_num]."`.`account_banned` WHERE active = 1 ORDER BY id LIMIT ".($page_count_ban*$page_num).",$page_count_ban", $ConnectDB[$realm_num]);
			if ($banned_user_db) {
				$banned_user_page_text = 
					"
					<table cellspacing=\"0\" class=\"list_table\">
						<thead>
							<tr height=\"33\">
								<th width=\"300\">".@$str[$lang]['46']."</th>
								<th width=\"300\">".@$str[$lang]['47']."</th>
								<th width=\"300\">".@$str[$lang]['48']."</th>
								<th width=\"300\">".@$str[$lang]['49']."</th>
								<th width=\"300\">".@$str[$lang]['50']."</th>
							</tr>
						</thead>
					";
				$i = "1";
				while($result = mysql_fetch_array($banned_user_db))
				{
					$name = getLoginFromId($result['id'], 1);
					$banned_user_page_text .= 
						"
							<tr>
								<td class=\"col$i\" align=\"center\">".$name."<a></td>
								<td class=\"col$i\" align=\"center\">".date("H:i:s d.m.Y", $result['bandate'])."</td>
								<td class=\"col$i\" align=\"center\">".date("H:i:s d.m.Y", $result['unbandate'])."</td>
								<td class=\"col$i\" align=\"center\">".$result['bannedby']."</td>
								<td class=\"col$i\" align=\"center\">".$result['banreason']."</td>
							</tr>
						";
					if ($i=="1") {$i="2";} else {$i="1";}
				}
				$banned_user_page_text .= "</table>";
				if ($page_count > 1) {
					$banned_user_page_text .= "<br/><div style=\"text-align: right; widht: 100%; padding-right: 35px;\" >";
					for ($i = 0; $i < $page_count; $i++) {
						if ($i==$page_num) {$banned_user_page_text .= $i+1;} else {$banned_user_page_text .= "<a href=./?page=ban&page_num=".($i+1).">".($i+1)."</a>";}
						if (($i + 1) < $page_count) {$banned_user_page_text .= " - ";}
					}
					$banned_user_page_text .= "</div>";
				}
				$banned_user_page_text .= "<br>";
			} else { $banned_user_page_text =
						"<br>
						<center>".@$str[$lang]['51']."</center>
						<br>";}
		} else { $banned_user_page_text =
					"<br>
					<center>".@$str[$lang]['51']."</center>
					<br>";}
	} else { $banned_user_page_text =
					"<br>
					<center>".@$str[$lang]['44']."</center>
					<br>";}
?>
<div class="mb_top"><?php echo @$str[$lang]['52'];?> <?php echo $realm_title[$realm_num];?></div>
<div class="mb_main">
	<?php echo $banned_user_page_text;?>
</div>
<div class="mb_down"></div>
