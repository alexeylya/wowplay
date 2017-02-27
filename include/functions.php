<?php
	function getPasswordHash($username, $pass){
		$user = strtoupper($username);
		$pass = strtoupper($pass);
		return SHA1($user.':'.$pass);
	}
	function getGmlevelFromId($id, $r_id) {
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_realmd = $GLOBALS["mysql_db_realmd"][$r_id];
		$result = @mysql_result(mysql_query("SELECT gmlevel FROM `$func_mysql_db_realmd`.`account_access` WHERE id ='$id'", $func_ConnectDB), 0);
		if ($result) { return $result; }
		return "0";
	}
	
	function getLoginFromId($id, $r_id) {
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_realmd = $GLOBALS["mysql_db_realmd"][$r_id];
		$result = @mysql_result(mysql_query("SELECT username FROM `$func_mysql_db_realmd`.`account` WHERE id ='$id'", $func_ConnectDB), 0);
		if ($result) { return $result; }
		return "";
	}
	
	function getCharExist($guid, $r_id) {
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_characters = $GLOBALS["mysql_db_characters"][$r_id];
		$result = mysql_num_rows(mysql_query("SELECT name FROM `$func_mysql_db_characters`.`characters` WHERE guid = '$guid'", $func_ConnectDB));
		if ($result > 0) { return 1; }
		return 0;
	}
	
	function getNameFromGuid($guid, $r_id) {
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_characters = $GLOBALS["mysql_db_characters"][$r_id];
		$result = @mysql_result(mysql_query("SELECT name FROM `$func_mysql_db_characters`.`characters` WHERE guid ='$guid'", $func_ConnectDB), 0);
		if ($result) { return $result; }
		return "";
	}
	
	function getGuildFromGuid($guid, $r_id) {
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_characters = $GLOBALS["mysql_db_characters"][$r_id];
		$result = @mysql_result(mysql_query("SELECT guildid FROM `$func_mysql_db_characters`.`guild_member` WHERE guid = '$guid'", $func_ConnectDB), 0);
		if ($result) { return $result; }
		return 0;
	}
	
	function getGuildNameFromGuildId($guildid, $r_id) {
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_characters = $GLOBALS["mysql_db_characters"][$r_id];
		$result = @mysql_result(mysql_query("SELECT name FROM `$func_mysql_db_characters`.`guild` WHERE guildid = '$guildid'", $func_ConnectDB), 0);
		if ($result) { return $result; }
		return "";
	}
	
	function getBanTime($id, $r_id) {
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_realmd = $GLOBALS["mysql_db_realmd"][$r_id];
		$result = @mysql_result(mysql_query("SELECT unbandate FROM `$func_mysql_db_realmd`.`account_banned` WHERE id = '$id' AND active = '1' LIMIT 1", $func_ConnectDB), 0);
		if ($result > 0) { return $result;}
		return "0";
	}
	
	function getOnlineUserCount($r_id) {
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_characters = $GLOBALS["mysql_db_characters"][$r_id];
		$func_online_count = @mysql_num_rows(mysql_query("SELECT account FROM `$func_mysql_db_characters`.`characters` WHERE online = '1'", $func_ConnectDB));
		if ($func_online_count) { return $func_online_count; }
		return 0;
	}
	
	function getUptime($r_id) {
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_realmd = $GLOBALS["mysql_db_realmd"][$r_id];
		$result = @mysql_result(mysql_query("SELECT max(starttime) FROM `$func_mysql_db_realmd`.`uptime` WHERE realmid = '$r_id'", $func_ConnectDB), 0);
		if ($result == 0) {return array(0, 0, 0, 0);}
		$uptime = time() - $result;
		$uptime_sec = $uptime%60;
		$uptime = intval($uptime/60);
		$uptime_min = $uptime%60;
		$uptime = intval($uptime/60);
		$uptime_hours = $uptime%24;
		$uptime = intval($uptime/24);  
		$uptime_days = $uptime;
		return array($uptime_days, $uptime_hours, $uptime_min, $uptime_sec);
	}
	
	function getBannedUserCount($r_id) {
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_realmd = $GLOBALS["mysql_db_realmd"][$r_id];
		$func_banned_count = @mysql_num_rows(mysql_query("SELECT id FROM `$func_mysql_db_realmd`.`account_banned` WHERE active = '1'", $func_ConnectDB));
		if ($func_banned_count) { return $func_banned_count; }
		return 0;
	}
	
	function getIEMyth($guid, $r_id) {
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_characters = $GLOBALS["mysql_db_characters"][$r_id];
		$result = @mysql_result(mysql_query("SELECT itemEntry FROM `$func_mysql_db_characters`.`item_instance` WHERE guid = '$guid' LIMIT 1", $func_ConnectDB), 0);
		if ($result > 0) { return $result;}
		return "0";
	}
	
	function getMailId($r_id) {
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_characters = $GLOBALS["mysql_db_characters"][$r_id];
		$result = @mysql_fetch_array(mysql_query("SELECT MAX(id) id FROM `$func_mysql_db_characters`.`mail` LIMIT 1", $func_ConnectDB));
		if ($result) {
			$id = $result['id'] + 1;
			return $id;
		} else { return 0; }
	}
	
	function getItemInstanceId($r_id) {
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_characters = $GLOBALS["mysql_db_characters"][$r_id];
		$result = @mysql_fetch_array(mysql_query("SELECT MAX(guid) guid FROM `$func_mysql_db_characters`.`item_instance` LIMIT 1", $func_ConnectDB));
		if ($result) {
			$id = $result['guid'] + 1;
			return $id;
		} else { return 0; }
	}
	
	function sendMail($receiver, $subject, $body, $item = 0, $gold = 0, $r_id) {
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_characters = $GLOBALS["mysql_db_characters"][$r_id];
		$func_mail_sender_guid = $GLOBALS["mail_sender_guid"][$r_id];
		$func_server_type = $GLOBALS["server_type"][$r_id];
		$func_mail_id = getMailId($r_id);
		$has_items = '0';
		if ($func_mail_id > 0) {
			if ($item > 0) { $has_items = '1'; }
			$expire_time = time() + 86400;
			$deliver_time = time() + 5;
			$gold = $gold * 10000;
			$query = @mysql_query("INSERT INTO `$func_mysql_db_characters`.`mail` SET id = '$func_mail_id', stationery = '61', sender = '$func_mail_sender_guid', receiver = '$receiver', subject = '$subject', body = '$body', has_items = '$has_items', expire_time = '$expire_time', deliver_time = '$deliver_time', money = '$gold'", $func_ConnectDB);
			if ($query) {
				if ($has_items = 1) {
					if ($func_server_type == 0) {
						mysql_query("INSERT INTO `$func_mysql_db_characters`.`mail_items` SET mail_id = '$func_mail_id', item_guid = '".createItemInstance($receiver, $item, $r_id)."', item_template = '$item', receiver = '$receiver'", $func_ConnectDB);
						return 1;
					}
					if ($func_server_type == 1) {
						mysql_query("INSERT INTO `$func_mysql_db_characters`.`mail_items` SET mail_id = '$func_mail_id', item_guid = '".createItemInstance($receiver, $item, $r_id)."', receiver = '$receiver'", $func_ConnectDB);
						return 1;
					}
				}
				return 1;
			} else { return 0; }
		} else { return 0; }
	}
	
	function createItemInstance($receiver, $item, $r_id){
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_characters = $GLOBALS["mysql_db_characters"][$r_id];
		$func_mysql_db_world = $GLOBALS["mysql_db_world"][$r_id];
		$func_server_type = $GLOBALS["server_type"][$r_id];
		$guid = getItemInstanceId($r_id);
		if ($guid) {
			$result = @mysql_fetch_array(mysql_query("SELECT MaxDurability, spellcharges_1, spellcharges_2, spellcharges_3, spellcharges_4, spellcharges_5, Flags FROM `$func_mysql_db_world`.`item_template` WHERE entry = '$item' LIMIT 1", $func_ConnectDB));
			$MaxDurability = $result['MaxDurability'];
			$Flags = $result['Flags'];
			$charges = $result['spellcharges_1']." ".$result['spellcharges_2']." ".$result['spellcharges_3']." ".$result['spellcharges_4']." ".$result['spellcharges_5']." ";
			if ($func_server_type == 0) {
				$result = @mysql_query("INSERT INTO `$func_mysql_db_characters`.`item_instance`  SET guid = '$guid', owner_guid = '$receiver', flags = '$Flags', duration = '$MaxDurability', count = '1', charges = '$charges', enchantments = '0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 '", $func_ConnectDB);
			}
			if ($func_server_type == 1) {
				$result = @mysql_query("INSERT INTO `$func_mysql_db_characters`.`item_instance`  SET guid = '$guid', owner_guid = '$receiver', flags = '$Flags', duration = '$MaxDurability', count = '1', charges = '$charges', enchantments = '0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 ', itemEntry = '$item'", $func_ConnectDB);
			}
			if ($result) {
				return $guid;
			} else { return 0; }
		} else { return 0; }
	}
	
	function getItemExist($item_id, $r_id){
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_world = $GLOBALS["mysql_db_world"][$r_id];
		$query = @mysql_query("SELECT entry FROM `$func_mysql_db_world`.`item_template` WHERE entry = '$item_id' LIMIT 1", $func_ConnectDB);
		if ($query) { return 1; } else { return 0; }
	}
	
	function getItemName($item_id){
		$func_ConnectDB = $GLOBALS["ConnectDB"]['cms'];
		$func_mysql_db = $GLOBALS["mysql_db"]['cms'];
		$result = @mysql_result(mysql_query("SELECT name_loc8 FROM `$func_mysql_db`.`armory_locales_item` WHERE entry = '$item_id' LIMIT 1", $func_ConnectDB), 0);
		if ($result) { return $result; } else { return 0; }
	}
	
	function getItemLvl($item_id, $r_id){
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_world = $GLOBALS["mysql_db_world"][$r_id];
		$result = @mysql_result(mysql_query("SELECT itemlevel FROM `$func_mysql_db_world`.`item_template` WHERE entry = '$item_id' LIMIT 1", $func_ConnectDB), 0);
		if ($result) { return $result; } else { return 0; }
	}
	
	function getCharAccountByGuid($guid, $r_id){
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_characters = $GLOBALS["mysql_db_characters"][$r_id];
		$result = @mysql_result(mysql_query("SELECT account FROM `$func_mysql_db_characters`.`characters` WHERE guid ='$guid' LIMIT 1", $func_ConnectDB), 0);
		if ($result) { return $result; } else { return 0; }
	}
	
	function getCharOnlineByGuid($guid, $r_id) {
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_characters = $GLOBALS["mysql_db_characters"][$r_id];
		$result = @mysql_result(mysql_query("SELECT online FROM `$func_mysql_db_characters`.`characters` WHERE guid = '$guid' LIMIT 1", $func_ConnectDB), 0);
		if ($result) { return $result; }
		return 0;
	}
	
	function getCharLvlByGuid($guid, $r_id) {
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_characters = $GLOBALS["mysql_db_characters"][$r_id];
		$result = @mysql_result(mysql_query("SELECT level FROM `$func_mysql_db_characters`.`characters` WHERE guid = '$guid' LIMIT 1", $func_ConnectDB), 0);
		if ($result) { return $result; }
		return 0;
	}
	
	function getAccountBonuses($login) {
		$func_ConnectDB = $GLOBALS["ConnectDB"]['cms'];
		$func_mysql_db = $GLOBALS["mysql_db"]['cms'];
		$result = @mysql_result(mysql_query("SELECT bonuses FROM `$func_mysql_db`.`lk_bonuses` WHERE acc_name = '$login'", $func_ConnectDB), 0);
		if ($result) { return $result;}
		return 0;
	}
	
	function setAccountBonuses($login, $bonuses, $type) {
		$func_ConnectDB = $GLOBALS["ConnectDB"]['cms'];
		$func_mysql_db = $GLOBALS["mysql_db"]['cms'];
		if (@mysql_num_rows(mysql_query("SELECT * FROM `$func_mysql_db`.`lk_bonuses` WHERE acc_name = '$login' LIMIT 1", $func_ConnectDB)) == 0) { @mysql_query("INSERT INTO `$func_mysql_db`.lk_bonuses SET acc_name = '$login'", $func_ConnectDB); }
		if ($type == 1) {
			$query = @mysql_query("UPDATE `$func_mysql_db`.`lk_bonuses` SET bonuses=bonuses-$bonuses WHERE acc_name = '$login'", $func_ConnectDB);
			if ($query) { return 1; }
			return 0;
		} elseif ($type == 2) {
			$query = @mysql_query("UPDATE `$func_mysql_db`.`lk_bonuses` SET bonuses=bonuses+$bonuses WHERE acc_name = '$login'", $func_ConnectDB);
			if ($query) { return 1; }
			return 0;
		}
		return 0;
	}
	
	function getItemCost($item_id, $r_id) {
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_world = $GLOBALS["mysql_db_world"][$r_id];
		$factors_r = $GLOBALS["lk_shop_f"][$r_id];
		$factors_q = array( 1, 1.1, 1.2, 1.3, 1.4, 2.5);
		$cost = 0;
		
		$item_t = @mysql_fetch_array(mysql_query("SELECT * FROM `$func_mysql_db_world`.`item_template` WHERE entry = '$item_id' LIMIT 1;", $func_ConnectDB));
		if ($item_t) {
			$i_entry = $item_t['entry'];
			$i_class = $item_t['class'];
			$i_subclass = $item_t['subclass'];
			$i_itemlevel = $item_t['ItemLevel'];
			$i_stackable = $item_t['stackable'];
			$i_quality = $item_t['Quality'];
			$i_itemset = $item_t['itemset'];
			$i_itemslots = $item_t['ContainerSlots'];
			
			$tmp = @file_get_contents('./modules/lk/item_black_list.txt');
			$wl = @explode(",",$tmp);
			if (in_array($i_entry, $wl)) { return 0; }
			if ($i_stackable > 1) { return 0; }
			if ($i_class == 15 && $i_subclass == 5) { // Маунты
				$cost = 150 * $factors_q[$i_quality] / $factors_r;
			} elseif ($i_class == 15 && $i_subclass == 2) { // Спутники
				$cost = 100 * $factors_q[$i_quality] / $factors_r;
			} elseif (($i_class == 2 || $i_class == 4) && $i_itemlevel > 10) { // Оружее и броня
				@$cost = $i_itemlevel * 2 / $factors_r * $factors_q[$i_quality];
			} elseif ($i_class == 9 && $i_subclass != 0) { // Рецепты
				@$cost = $i_itemlevel * 3 / $factors_r * $factors_q[$i_quality];
			} elseif ($i_class == 1 || $i_class == 11) { // Сумки
				$cost = $i_itemslots / $factors_r * 10;
			}
			
			return ceil($cost);
		} else { return 0; }
	}
	
	function getLvlCost($lvl, $r_id) {
		$factors_r = $GLOBALS["lk_shop_f"][$r_id];
		return ceil($lvl * 17 / $factors_r);
	}
	
	function getGoldCost($Gold, $r_id) {
		$factors_r = $GLOBALS["lk_shop_f"][$r_id];
		if ($Gold < 1000) {return 0;}
		return ceil($Gold / $factors_r / 5);
	}
	
	function getUnbanCost($id) {
		$unban_time = getBanTime($id);
		$time = time();
		if ($unban_time < $time) { 
			return 200; 
		} else {
			$ban_days = ceil(($unban_time - $time) / 86400);
			return ($ban_days * 10);
		}
	}
	
	function getDisplayidFromTemplate($item_template, $r_id) {
		$func_ConnectDB = $GLOBALS["ConnectDB"][$r_id];
		$func_mysql_db_world = $GLOBALS["mysql_db_world"][$r_id];
		$result = @mysql_result(mysql_query("SELECT displayid FROM `$func_mysql_db_world`.`item_template` WHERE entry = '$item_template'", $func_ConnectDB), 0);
		if ($result > 0) {return $result;}
		return "0";
	}
	
	function getIconFromDisplayId($displayid) {
		$func_ConnectDB = $GLOBALS["ConnectDB"]['cms'];
		$func_mysql_db = $GLOBALS["mysql_db"]['cms'];
		$result = @mysql_result(mysql_query("SELECT name FROM `$func_mysql_db`.`armory_itemicon` WHERE id = '$displayid'", $func_ConnectDB), 0);
		if ($result) {return $result;}
		return "";
	}
	
	function getFactionText($faction, $flag) {
		$func_ConnectDB = $GLOBALS['char_rep'];
		$func_ConnectDB2 = $GLOBALS['mf_id'];
		$text = "";
		$qwe = "";
		for ($i=1; $i<=$flag; $i++) { $qwe .= "+++";}
		foreach ($faction as $id => $value) {
			if ($value['name']) {
				$text .= $qwe.$id.$value['name']."<br>";
				$test = @$func_ConnectDB[$id]['childs'];
				if (sizeof($test) > 0) { $text .= getFactionText($test, $flag + 1);}
			}
		}
		return $text;
	}
	
	function getFaction($faction_id, $fields="*") {
		$func_ConnectDB = $GLOBALS["ConnectDB"][1];
		$func_mysql_db_realmd = $GLOBALS["mysql_db_realmd"][1];
		$result = @mysql_fetch_array(mysql_query("SELECT * FROM `$func_mysql_db_realmd`.`armory_faction` WHERE id = '$faction_id' LIMIT 1", $func_ConnectDB));
		return $result;
	}
	
	function getReputationDataFromReputation($rep){
		$func_reputation_rank = $GLOBALS["reputation_rank"];
		$func_BaseRep = -42000;
		$func_RepStep = array(36000, 3000, 3000, 3000, 6000, 12000, 21000, 1000);
		$current  = $func_BaseRep;
		
		for ($i=0; $i<8; $current+=$func_RepStep[$i], $i++) {
			if ($current + $func_RepStep[$i] > $rep) {
				return array('rank'=>$i, 'rank_name'=>$func_reputation_rank[$i], 'rep'=>$rep - $current, 'max'=>$func_RepStep[$i]);
			}
		}
		
		return array('rank'=>7, 'rank_name'=>$func_reputation_rank[7], 'rep'=>$func_RepStep[7], 'max'=>$func_RepStep[7]);
	}
	
	function getBaseReputationFlagForFaction($faction_id, $race, $class){
		$func_ConnectDB = $GLOBALS["ConnectDB"][1];
		$func_mysql_db_realmd = $GLOBALS["mysql_db_realmd"][1];
		$result = @mysql_fetch_array(mysql_query("SELECT * FROM `$func_mysql_db_realmd`.`armory_faction` WHERE id = '$faction_id' LIMIT 1", $func_ConnectDB));
		if (empty($result)) return 0;
		$racemask  = 1<< ($race -1);
		$classmask = 1<<($class-1);
		for ($i = 0; $i < 4; $i++) {
			if ($result['BaseRepRaceMask_'.$i] & $racemask && ($result['BaseRepClassMask_'.$i] == 0 || $result['BaseRepClassMask_'.$i] & $classmask)) {return $result['BaseRepValue_'.$i];}
		}
		return 0;
	}
	
	function validateText($text){
	  $letter = array("'", '"', "<",">", ">", "\r","\n");
	  $values = array("`",'&quot;',"&lt;","&gt;","&gt;",""  ,"<br>");
	  return str_replace($letter, $values, $text);
	}
?>