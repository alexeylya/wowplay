<?php
	if ($ConnectDB[$realm_num]) {
		$statistics_chars_count_a = 0;
		$statistics_chars_count_h = 0;
		$statistics_chars_count = 0;
		$online_chars_count_a = 0;
		$online_chars_count_h = 0;
		$statistics_race_count = array("");
		$statistics_class_count = array(array(""), array(""));
		
		$i = 0;
		while ($i <= 11) {
			$statistics_race_count[$i]=0;
			$statistics_class_count[$i][0]=0;
			$statistics_race_count[$i]=0;
			$statistics_class_count[$i][1]=0;
			$i++;
		}
		
		$online_user_db = @mysql_query("SELECT * FROM `".$mysql_db_characters[$realm_num]."`.`characters` WHERE online = 1", $ConnectDB[$realm_num]);
		if ($online_user_db) {
			while($result = mysql_fetch_array($online_user_db)){
				if ($result['race'] == 1 || $result['race'] == 3 || $result['race'] == 4 || $result['race'] == 7 || $result['race'] == 11) { 
					$online_chars_count_a++;
				} else {
					$online_chars_count_h++;
				}
			}
		}
		
		$statistics_user_db = @mysql_query("SELECT * FROM `".$mysql_db_characters[$realm_num]."`.`characters`", $ConnectDB[$realm_num]);
		if ($statistics_user_db) {
			while($result = mysql_fetch_array($statistics_user_db)){
				if ($result['race'] == 1 || $result['race'] == 3 || $result['race'] == 4 || $result['race'] == 7 || $result['race'] == 11) { 
					$statistics_chars_count_a++;
					$statistics_race_count[$result['race']]++;
					$statistics_class_count[$result['class']][0]++;
				} else {
					$statistics_chars_count_h++;
					$statistics_race_count[$result['race']]++;
					$statistics_class_count[$result['class']][1]++;
				}
				$statistics_chars_count++;
			}
		}
		
		if (!($fp[$realm_num])) { $online_chars_count_a = 0; $online_chars_count_h = 0; }
		
		$statistics_page ="
			<table width=\"100%\" border=\"0\" class=\"list_table\">
				<tr><td align=\"center\" height=\"20\"></tr>
				<tr>
					<td align=\"center\">
						<img src=\"./style/images/b_alliance.png\" onmouseover=\"Tip('".@$str[$lang]['40'][0]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>
						".@$str[$lang]['53']." - $statistics_chars_count_a<br>
						".@$str[$lang]['54']." - $online_chars_count_a
					</td>
					<td align=\"center\">
						<img src=\"./style/images/b_horde.png\" onmouseover=\"Tip('".@$str[$lang]['40'][1]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>
						".@$str[$lang]['55']." - $statistics_chars_count_h<br>
						".@$str[$lang]['56']." - $online_chars_count_h
					</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"2\">
						<br><b>".@$str[$lang]['57']."</b><br><br>
					</td>
				</tr>
				<tr>
					<td align=\"center\">
						<table align=\"center\" width=\"100\" border=\"0\" class=\"list_table\">
							<tr>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/1.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".@$str[$lang]['38'][0][1]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_class_count[1][0]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/2.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".@$str[$lang]['38'][0][2]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_class_count[2][0]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/3.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".@$str[$lang]['38'][0][3]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_class_count[3][0]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/4.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".@$str[$lang]['38'][0][4]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_class_count[4][0]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/5.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".@$str[$lang]['38'][0][5]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_class_count[5][0]."</td>
							</tr>
							<tr>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/6.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".@$str[$lang]['38'][0][6]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_class_count[6][0]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/7.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".@$str[$lang]['38'][0][7]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_class_count[7][0]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/8.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".@$str[$lang]['38'][0][8]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_class_count[8][0]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/9.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".@$str[$lang]['38'][0][3]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_class_count[9][0]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/11.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".@$str[$lang]['38'][0][11]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_class_count[11][0]."</td>
							</tr>
						</table>
					</td>
					<td align=\"center\">
						<table align=\"center\" width=\"100\" border=\"0\" class=\"list_table\">
							<tr>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/1.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".@$str[$lang]['38'][0][1]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_class_count[1][1]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/2.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".@$str[$lang]['38'][0][2]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_class_count[2][1]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/3.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".@$str[$lang]['38'][0][3]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_class_count[3][1]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/4.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".@$str[$lang]['38'][0][4]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_class_count[4][1]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/5.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".@$str[$lang]['38'][0][5]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_class_count[5][1]."</td>
							</tr>
							<tr>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/6.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".@$str[$lang]['38'][0][6]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_class_count[6][1]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/7.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".@$str[$lang]['38'][0][7]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_class_count[7][1]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/8.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".@$str[$lang]['38'][0][8]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_class_count[8][1]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/9.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".@$str[$lang]['38'][0][9]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_class_count[9][1]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/11.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".@$str[$lang]['38'][0][11]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_class_count[11][1]."</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"2\">
						<br><b>".@$str[$lang]['58']."</b><br><br>
					</td>
				</tr>
				<tr>
					<td align=\"center\">
						<table align=\"center\" width=\"100\" border=\"0\" class=\"list_table\">
							<tr>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/1-0.gif\" height=\"32\" width=\"32\"  onmouseover=\"Tip('".$str[$lang]['39'][0][1]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_race_count[1]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/3-0.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".$str[$lang]['39'][0][3]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\" ><br>".$statistics_race_count[3]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/4-0.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".$str[$lang]['39'][0][4]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_race_count[4]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/7-0.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".$str[$lang]['39'][0][7]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_race_count[7]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/11-0.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".$str[$lang]['39'][0][11]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_race_count[11]."</td>
							</tr>
						</table>
					</td>
					<td align=\"center\">
						<table align=\"center\" width=\"100\" border=\"0\" class=\"list_table\">
							<tr>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/2-0.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".$str[$lang]['39'][0][2]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_race_count[2]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/5-0.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".$str[$lang]['39'][0][5]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"><br>".$statistics_race_count[5]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/6-0.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".$str[$lang]['39'][0][6]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"')\"><br>".$statistics_race_count[6]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/8-0.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".$str[$lang]['39'][0][8]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"')\"><br>".$statistics_race_count[8]."</td>
								<td width=\"100\" align=\"center\"><img src=\"./style/images/icon/big/10-0.gif\" height=\"32\" width=\"32\" onmouseover=\"Tip('".$str[$lang]['39'][0][10]."', WIDTH, 150, OFFSETX, 10, OFFSETY, -40, STICKY, false);\"')\"><br>".$statistics_race_count[10]."</td>
							</tr>
						</table>
					</td>
				</tr>
				
			</table>
			";
	} else { $statistics_page =
				 "<br>
				 <center>".@$str[$lang]['44']."</center>
				 <br>";}
?>
<div class="mb_top"></br><div class="news-title"><center><?php echo @$str[$lang]['59'];?> <?php echo $realm_title[$realm_num];?></center></div></div><br>
<div class="mb_main">
	<?php echo $statistics_page;?>
</div>
<div class="mb_down"></div>