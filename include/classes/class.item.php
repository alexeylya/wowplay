<?php
	class Item {
		private $m_inv_data = array();
		private $m_ii_data = array();
		private $m_it_data = array();
		private $m_socket_data = array();
		private $m_socket_bdesc = '';
		private $m_ench_desc = array();
		private $mysql_path = array();
		private $mysql_login = array();
		private $mysql_password = array();
		private $mysql_db = array();
		private $mysql_db_characters = array();
		private $mysql_db_world = array();
		private $ConnectDB = array();

		public function ConnectToDB($r_num) {
			$this -> ConnectDB['cms'] = @mysql_connect($GLOBALS['mysql_path']['cms'], $GLOBALS['mysql_login']['cms'], $GLOBALS['mysql_password']['cms']);
			@mysql_query("SET NAMES 'utf8_general_ci'", $this -> ConnectDB['cms']);

			$this -> mysql_db_characters['server'] = $GLOBALS['mysql_db_characters'][$r_num];
			$this -> mysql_db_world['server'] = $GLOBALS['mysql_db_world'][$r_num];
			$this -> ConnectDB['server'] = @mysql_connect($GLOBALS['mysql_path'][$r_num], $GLOBALS['mysql_login'][$r_num], $GLOBALS['mysql_password'][$r_num]);
			@mysql_query("SET NAMES 'utf8_general_ci'", $this -> ConnectDB['server']);
		}
		
		public function CloseConnectToDB($r_num) {
			@mysql_close($this -> ConnectDB['cms']);
			@mysql_close($this -> ConnectDB['server']);
		}
		
		public function LoadFromDB($r_num, $type, $item) {
			$ConnectDB['cms'] = $this -> ConnectDB['cms'];
			$ConnectDB['server'] = $this -> ConnectDB['server'];
			$Server_Type = $GLOBALS['server_type'][$r_num];
			$func_mysql_db_characters['server'] = $GLOBALS['mysql_db_characters'][$r_num];
			$func_mysql_db_world['server'] = $GLOBALS['mysql_db_world'][$r_num];
			$func_mysql_db['cms'] = $GLOBALS['mysql_db']['cms'];
			if ($type == 0) {
				$this -> m_inv_data = @mysql_fetch_array(mysql_query("SELECT * FROM `".$func_mysql_db_characters['server']."`.`character_inventory` WHERE item = '$item' LIMIT 1", $ConnectDB['server']));
				$this -> m_ii_data = @mysql_fetch_array(mysql_query("SELECT * FROM `".$func_mysql_db_characters['server']."`.`item_instance` WHERE guid = '$item' LIMIT 1", $ConnectDB['server']));
				if ($Server_Type == 0) { $this -> m_it_data = @mysql_fetch_array(mysql_query("SELECT * FROM `".$func_mysql_db_world['server']."`.`item_template` WHERE entry = '".($this -> m_inv_data['item_template'])."' LIMIT 1", $ConnectDB['server'])); }
				if ($Server_Type == 1) { $this -> m_it_data = @mysql_fetch_array(mysql_query("SELECT * FROM `".$func_mysql_db_world['server']."`.`item_template` WHERE entry = '".($this -> m_ii_data['itemEntry'])."' LIMIT 1", $ConnectDB['server'])); }
				
				if ( $this -> m_ii_data['randomPropertyId'] > 0 ) {$this -> m_irp_data = @mysql_fetch_array(mysql_query("SELECT * FROM `".$func_mysql_db['cms']."`.`armory_item_random_propety` WHERE id = '".($this -> m_ii_data['randomPropertyId'])."' LIMIT 1", $ConnectDB['cms']));}
				if ( $this -> m_ii_data['randomPropertyId'] < 0 ) {$this -> m_irs_data = @mysql_fetch_array(mysql_query("SELECT * FROM `".$func_mysql_db['cms']."`.`armory_item_random_suffix` WHERE id = '".abs($this -> m_ii_data['randomPropertyId'])."' LIMIT 1", $ConnectDB['cms']));}
				
				$enchantments = explode(" ", $this -> m_ii_data['enchantments']);
				if (@$enchantments[6] > 0) {
					$this -> m_socket_data[1] = @mysql_fetch_array(mysql_query("SELECT * FROM `".$func_mysql_db['cms']."`.`armory_item_enchantment` WHERE id = '".$enchantments[6]."' LIMIT 1", $ConnectDB['cms']));
					$this -> m_socket_data[1]['GemProperties'] = mysql_result(mysql_query("SELECT GemProperties FROM `".$func_mysql_db_world['server']."`.`item_template` WHERE entry = '".($this -> m_socket_data[1]['GemID'])."' LIMIT 1", $ConnectDB['server']), 0);
					$this -> m_socket_data[1]['displayid'] = mysql_result(mysql_query("SELECT displayid FROM `".$func_mysql_db_world['server']."`.`item_template` WHERE entry = '".($this -> m_socket_data[1]['GemID'])."' LIMIT 1", $ConnectDB['server']), 0);
					$this -> m_socket_data[1]['color'] = mysql_result(mysql_query("SELECT color FROM `".$func_mysql_db['cms']."`.`armory_gem_properties` WHERE id = '".($this -> m_socket_data[1]['GemProperties'])."' LIMIT 1", $ConnectDB['cms']), 0);
					$this -> m_socket_data[1]['icon'] = mysql_result(mysql_query("SELECT name FROM `".$func_mysql_db['cms']."`.`armory_itemicon` WHERE id = '".($this -> m_socket_data[1]['displayid'])."' LIMIT 1", $ConnectDB['cms']), 0);
				}
				if (@$enchantments[9] > 0) {
					$this -> m_socket_data[2] = @mysql_fetch_array(mysql_query("SELECT * FROM `".$func_mysql_db['cms']."`.`armory_item_enchantment` WHERE id = '".$enchantments[9]."' LIMIT 1", $ConnectDB['cms']));
					$this -> m_socket_data[2]['GemProperties'] = mysql_result(mysql_query("SELECT GemProperties FROM `".$func_mysql_db_world['server']."`.`item_template` WHERE entry = '".($this -> m_socket_data[2]['GemID'])."' LIMIT 1", $ConnectDB['server']), 0);
					$this -> m_socket_data[2]['displayid'] = mysql_result(mysql_query("SELECT displayid FROM `".$func_mysql_db_world['server']."`.`item_template` WHERE entry = '".($this -> m_socket_data[2]['GemID'])."' LIMIT 1", $ConnectDB['server']), 0);
					$this -> m_socket_data[2]['color'] = mysql_result(mysql_query("SELECT color FROM `".$func_mysql_db['cms']."`.`armory_gem_properties` WHERE id = '".($this -> m_socket_data[2]['GemProperties'])."' LIMIT 1", $ConnectDB['cms']), 0);
					$this -> m_socket_data[2]['icon'] = mysql_result(mysql_query("SELECT name FROM `".$func_mysql_db['cms']."`.`armory_itemicon` WHERE id = '".($this -> m_socket_data[2]['displayid'])."' LIMIT 1", $ConnectDB['cms']), 0);
				}
				if (@$enchantments[12] > 0) {
					$this -> m_socket_data[3] = @mysql_fetch_array(mysql_query("SELECT * FROM `".$func_mysql_db['cms']."`.`armory_item_enchantment` WHERE id = '".$enchantments[12]."' LIMIT 1", $ConnectDB['cms']));
					$this -> m_socket_data[3]['GemProperties'] = mysql_result(mysql_query("SELECT GemProperties FROM `".$func_mysql_db_world['server']."`.`item_template` WHERE entry = '".($this -> m_socket_data[3]['GemID'])."' LIMIT 1", $ConnectDB['server']), 0);
					$this -> m_socket_data[3]['displayid'] = mysql_result(mysql_query("SELECT displayid FROM `".$func_mysql_db_world['server']."`.`item_template` WHERE entry = '".($this -> m_socket_data[3]['GemID'])."' LIMIT 1", $ConnectDB['server']), 0);
					$this -> m_socket_data[3]['color'] = mysql_result(mysql_query("SELECT color FROM `".$func_mysql_db['cms']."`.`armory_gem_properties` WHERE id = '".($this -> m_socket_data[3]['GemProperties'])."' LIMIT 1", $ConnectDB['cms']), 0);
					$this -> m_socket_data[3]['icon'] = mysql_result(mysql_query("SELECT name FROM `".$func_mysql_db['cms']."`.`armory_itemicon` WHERE id = '".($this -> m_socket_data[3]['displayid'])."' LIMIT 1", $ConnectDB['cms']), 0);
				}
				@$this -> m_socket_bdesc = mysql_result(mysql_query("SELECT description FROM `".$func_mysql_db['cms']."`.`armory_item_enchantment` WHERE id = '".($this -> m_it_data['socketBonus'])."' LIMIT 1", $ConnectDB['cms']), 0);
				if (@$enchantments[0] > 0) { $this -> m_ench_desc[0] = mysql_result(mysql_query("SELECT description FROM `".$func_mysql_db['cms']."`.`armory_item_enchantment` WHERE id = '".$enchantments[0]."' LIMIT 1", $ConnectDB['cms']), 0); }
				if (@$enchantments[3] > 0) { $this -> m_ench_desc[3] = mysql_result(mysql_query("SELECT description FROM `".$func_mysql_db['cms']."`.`armory_item_enchantment` WHERE id = '".$enchantments[3]."' LIMIT 1", $ConnectDB['cms']), 0); }
			} elseif ($type == 1) { $this -> m_it_data = @mysql_fetch_array(mysql_query("SELECT * FROM `".$func_mysql_db_world['server']."`.`item_template` WHERE entry = '$item' LIMIT 1", $ConnectDB['server'])); }
		}
		
		public function GetGUID() {
			return $this -> m_inv_data['item'];
		}
		
		public function GetENTRY() {
			return $this -> m_it_data['entry'];
		}
		
		public function GetQUALITY() {
			return $this -> m_it_data['Quality'];
		}
		
		public function GetRANDOMPROPERTYID() {
			return @$this -> m_ii_data['randomPropertyId'];
		}
		
		public function GetRANDOMITEM() {
			if (@$this -> m_it_data['RandomProperty'] > 0 || @$this -> m_it_data['RandomSuffix'] > 0) { return 1; }
			return 0;
		}
		
		public function GetCLASS() {
			return $this -> m_it_data['class'];
		}
		
		public function GetCONTAINERSLOTS() {
			return $this -> m_it_data['ContainerSlots'];
		}
		
		public function GetSUBCLASS() {
			return $this -> m_it_data['subclass'];
		}
		
		public function GetNAME() {
			$ConnectDB['cms'] = $this -> ConnectDB['cms'];
			$func_mysql_db['cms'] = $GLOBALS['mysql_db']['cms'];
			@$randomPropertyId = $this -> m_ii_data['randomPropertyId'];
			$name = @mysql_result(mysql_query("SELECT name_loc8 FROM `".$func_mysql_db['cms']."`.`armory_locales_item` WHERE entry = '".($this -> m_it_data['entry'])."' LIMIT 1", $ConnectDB['cms']), 0);
			if (strlen($name) == 0) {$name = @$this -> m_it_data['name'];}
			if ($randomPropertyId == 0) { return $name; }
			elseif ($randomPropertyId > 0) { return $name . " " . $this -> m_irp_data['name']; }
			elseif ($randomPropertyId < 0) { return $name . " " . $this -> m_irs_data['name']; }
		}
		
		public function GetBONDING() {
			return $this -> m_it_data['bonding'];
		}
		
		public function GetUNIQUE() {
			if (($this -> m_it_data['Flags']&524288) > 0) { return 1;}
			return 0;
		}
		
		public function GetLEVEL() {
			return $this -> m_it_data['ItemLevel'];
		}
		
		public function GetMAXCOUNT() {
			return $this -> m_it_data['maxcount'];
		}
		
		public function GetINVENTORYTYPE() {
			return $this -> m_it_data['InventoryType'];
		}
		
		public function GetDMGMIN($num) {
			return $this -> m_it_data['dmg_min'.$num];
		}
		
		public function GetDMGMAX($num) {
			return $this -> m_it_data['dmg_max'.$num];
		}
		
		public function GetDMGTYPE($num) {
			return $this -> m_it_data['dmg_type'.$num];
		}
		
		public function GetDMGSPEED() {
			return $this -> m_it_data['delay'];
		}
		
		public function GetDMGMID($num) {
			return round(($this->GetDMGMIN($num) + $this->GetDMGMAX($num)) / ($this -> GetDMGSPEED() / 1000) / 2, 1);
		}
		
		public function GetARMOR() {
			return $this -> m_it_data['armor'];
		}
		
		public function GetSTATTYPE($num) {
			return $this -> m_it_data['stat_type'.$num];
		}
		
		public function GetSTATVALUE($num) {
			return $this -> m_it_data['stat_value'.$num];
		}
		
		public function GetDURABILITY() {
			return @$this -> m_ii_data['durability'];
		}
		
		public function GetMAXDURABILITY() {
			return $this -> m_it_data['MaxDurability'];
		}
		
		public function GetSPELLRES($num) {
			if ($num == 0) {return @$this -> m_it_data['holy_res'];}
			if ($num == 1) {return @$this -> m_it_data['fire_res'];}
			if ($num == 2) {return @$this -> m_it_data['nature_res'];}
			if ($num == 3) {return @$this -> m_it_data['frost_res'];}
			if ($num == 4) {return @$this -> m_it_data['shadow_res'];}
			if ($num == 5) {return @$this -> m_it_data['arcane_res'];}
		}
		
		public function GetSOCKET($num) {
			$enchantments = @explode(" ", $this -> m_ii_data['enchantments']);
			if ($num == 1) {return @$enchantments[6];}
			if ($num == 2) {return @$enchantments[9];}
			if ($num == 3) {return @$enchantments[12];}
		}
		
		public function GetSOCKETDESC($num) {
			return $this -> m_socket_data[$num]['description'];
		}
		
		public function GetSOCKETSLOTCOLOR($num) {
			return $this -> m_it_data['socketColor_'.$num];
		}
		
		public function GetSOCKETCOLOR($num) {
			return $this -> m_socket_data[$num]['color'];
		}
		
		public function GetSOCKETICON($num) {
			return $this -> m_socket_data[$num]['icon'];
		}
		
		public function GetSOCKETBONUSDESC() {
			$ConnectDB['cms'] = $this -> ConnectDB['cms'];
			$func_mysql_db['cms'] = $GLOBALS['mysql_db']['cms'];
			return @mysql_result(mysql_query("SELECT description FROM `".$func_mysql_db['cms']."`.`armory_item_enchantment` WHERE id = '".($this -> m_it_data['socketBonus'])."' LIMIT 1", $ConnectDB['cms']), 0);
		}
		
		public function GetSOCKETBONUS() {
			@$enchantments = explode(" ", $this -> m_ii_data['enchantments']);
			return @$enchantments[15];
		}
		
		public function GetENCHANTMENTS($num) {
			$enchantments = @explode(" ", $this -> m_ii_data['enchantments']);
			return @$enchantments[$num];
		}
		
		public function GetENCHANTMENTSDESC($num) {
			return $this -> m_ench_desc[$num];
		}
		
		public function GetALLOWABLECLASS() {
			return $this -> m_it_data['AllowableClass'];
		}
		
		public function GetALLOWABLERACE() {
			return $this -> m_it_data['AllowableRace'];
		}
		
		public function GetREQUIREDLEVEL() {
			return $this -> m_it_data['RequiredLevel'];
		}
		
		public function GetREQUIREDSKILL() {
			return $this -> m_it_data['RequiredSkill'];
		}
		
		public function GetREQUIREDSKILLDESC() {
			$ConnectDB['cms'] = $this -> ConnectDB['cms'];
			$func_mysql_db['cms'] = $GLOBALS['mysql_db']['cms'];
			return @mysql_result(mysql_query("SELECT name FROM `".$func_mysql_db['cms']."`.`armory_skill_line` WHERE id = '".($this -> m_it_data['RequiredSkill'])."' LIMIT 1", $ConnectDB['cms']), 0);
		}
		
		public function GetREQUIREDSKILLRANK() {
			return $this -> m_it_data['RequiredSkillRank'];
		}
		
		public function GetREQUIREDSPELL() {
			return $this -> m_it_data['requiredspell'];
		}
		
		public function GetREQUIREDSPELLDESC() {
			$ConnectDB['cms'] = $this -> ConnectDB['cms'];
			$func_mysql_db['cms'] = $GLOBALS['mysql_db']['cms'];
			return @mysql_result(mysql_query("SELECT SpellName FROM `".$func_mysql_db['cms']."`.`armory_spell` WHERE id = '".($this -> m_it_data['requiredspell'])."' LIMIT 1", $ConnectDB['cms']), 0);
		}
		
		public function GetREQUIREDREPUTATIONFACTION() {
			return $this -> m_it_data['RequiredReputationFaction'];
		}
		
		public function GetREQUIREDREPUTATIONFACTIONNAME() {
			$ConnectDB['cms'] = $this -> ConnectDB['cms'];
			$func_mysql_db['cms'] = $GLOBALS['mysql_db']['cms'];
			return @mysql_result(mysql_query("SELECT name FROM `".$func_mysql_db['cms']."`.`armory_faction` WHERE id = '".($this -> m_it_data['RequiredReputationFaction'])."' LIMIT 1", $ConnectDB['cms']), 0);
		}
		
		public function GetREQUIREDREPUTATIONRANK() {
			return $this -> m_it_data['RequiredReputationRank'];
		}
		
		public function GetSPELL($num) {
			return $this -> m_it_data['spellid_'.$num];
		}
		
		public function GetSPELLTRIGGER($num) {
			return $this -> m_it_data['spelltrigger_'.$num];
		}
		
		public function GetSPELLCOOLDOWN($num) {
			return $this -> m_it_data['spelltrigger_'.$num];
		}
		
		public function GetSPELLDESC($num) {
			$ConnectDB['cms'] = $this -> ConnectDB['cms'];
			$func_mysql_db['cms'] = $GLOBALS['mysql_db']['cms'];
			//return @mysql_result(mysql_query("SELECT Description_ru_ru FROM `".$func_mysql_db['cms']."`.`armory_spell` WHERE id = '".($this -> m_it_data['spellid_'.$num])."' LIMIT 1", $ConnectDB['cms']), 0);
			return $this -> GetSPELLREPLACEDESC($this -> m_it_data['spellid_'.$num], @mysql_result(mysql_query("SELECT Description_ru_ru FROM `".$func_mysql_db['cms']."`.`armory_spell` WHERE id = '".($this -> m_it_data['spellid_'.$num])."' LIMIT 1", $ConnectDB['cms']), 0));
		}
		
		private function GetSPELLREPLACEDESC($spell_id, $desc) {
			$letter = array('${','}');
			$values = array( '[',']');
			$text = str_replace($letter, $values, $desc);
			$test = "";
			preg_match_all("/([$][0-9]{0,10}[a-z]{1}[0-9]{0,1})/", $text, $result);
			for ($i=0; $i< count($result[0]); $i++) {
				$r_var[$i]['str'] = $result[0][$i];
				preg_match("/^[$]([0-9]{0,10})([a-z]{1})([0-9]{0,1})/", $r_var[$i]['str'], $var);
				$t_spell['id'] = $var[1];
				$t_spell['mod'] = $var[2];
				$t_spell['num'] = $var[3];
				if ($t_spell['id']) { $r_var[$i]['r_str'] = ($this -> GetSPELLINFO($t_spell['id'], $t_spell['mod'], $t_spell['num']));
				} else {$r_var[$i]['r_str'] = ($this -> GetSPELLINFO($spell_id, $t_spell['mod'], $t_spell['num']));}
				$text = str_replace ($r_var[$i]['str'], $r_var[$i]['r_str'], $text);
			}
			preg_match_all("/[[]([\S]{1,500})[]]/", $text, $result);
			for ($i=0; $i< count($result[0]); $i++) {
				$r_var[$i]['str'] = $result[0][$i];
				eval("\$r_var[$i]['r_str'] = abs(round(".$result[1][$i]."));");
				$text = str_replace ($r_var[$i]['str'], $r_var[$i]['r_str'], $text);
			}
			return $text;
		}
		
		private function GetSPELLINFO($spell_id, $mod, $num = 1) {
			$ConnectDB['cms'] = $this -> ConnectDB['cms'];
			$func_mysql_db['cms'] = $GLOBALS['mysql_db']['cms'];
			$r_str = '';
			if ($num == '') { $num = "1";}
			
			if ($mod == "s" || $mod == "m") {
				$result = @mysql_fetch_array(mysql_query("SELECT * FROM `".$func_mysql_db['cms']."`.`armory_spell` WHERE id = '$spell_id' LIMIT 1", $ConnectDB['cms']));
				$r_str = abs($result['EffectBasePoints_'.$num] + $result['EffectBaseDice_'.$num]);
				if($result['EffectDieSides_'.$num]>$result['EffectBaseDice_'.$num] && ($result['EffectDieSides_'.$num]-$result['EffectBaseDice_'.$num] != 1)) { $r_str .= ' - '.abs($result['EffectBasePoints_'.$num] + $result['EffectDieSides_'.$num]); }
			}
			
			if ($mod == "d") {
				$result = @mysql_fetch_array(mysql_query("SELECT * FROM `".$func_mysql_db['cms']."`.`armory_spell_duration` WHERE id IN (SELECT DurationIndex FROM ".$func_mysql_db['cms'].".armory_spell WHERE id = '$spell_id') LIMIT 1", $ConnectDB['cms']));
				$seconds = $result['duration_1'] / 1000;
				$time_text = '';
				if ($seconds >= 24*3600) {$time_text.= intval($seconds/(24*3600))." д"; if ($seconds%=24*3600) $time_text.=" ";
				} elseif ($seconds >= 3600) {$time_text.= intval($seconds/3600)." ч"; if ($seconds%=3600) $time_text.=" ";
				} elseif ($seconds >= 60) {$time_text.= intval($seconds/60)." мин"; if ($seconds%=60) $time_text.=" ";
				} elseif ($seconds > 0) {$time_text .= "$seconds сек";}
				$r_str = $time_text;
			}
			
			if ($mod == "t") {
				$result = @mysql_fetch_array(mysql_query("SELECT * FROM `".$func_mysql_db['cms']."`.`armory_spell` WHERE id = '$spell_id' LIMIT 1", $ConnectDB['cms']));
				$r_str = $result['EffectAmplitude_1'] ? $result['EffectAmplitude_'.$num]/1000 : 5;
			}
			
			if ($mod == "o") {
				$result = @mysql_fetch_array(mysql_query("SELECT * FROM `".$func_mysql_db['cms']."`.`armory_spell_duration` WHERE id IN (SELECT DurationIndex FROM ".$func_mysql_db['cms'].".armory_spell WHERE id = '$spell_id') LIMIT 1", $ConnectDB['cms']));
				$result2 = @mysql_fetch_array(mysql_query("SELECT * FROM `".$func_mysql_db['cms']."`.`armory_spell` WHERE id = '$spell_id' LIMIT 1", $ConnectDB['cms']));
				$d = $result['duration_1'] / 1000;
				$t = $result2['EffectAmplitude_1'] ? $result2['EffectAmplitude_'.$num]/1000 : 5;
				$s = abs($result2['EffectBasePoints_'.$num] + $result2['EffectBaseDice_'.$num]);
				if($result2['EffectDieSides_'.$num]>$result2['EffectBaseDice_'.$num] && ($result2['EffectDieSides_'.$num]-$result2['EffectBaseDice_'.$num] != 1)) { $s .= ' - '.abs($result2['EffectBasePoints_'.$num] + $result2['EffectDieSides_'.$num]); }
				$r_str = @intval($s * $d / $t);
			}
			
			if ($mod == "x") {
				$r_str = @mysql_result(mysql_query("SELECT EffectChainTarget_$num FROM `".$func_mysql_db['cms']."`.`armory_spell` WHERE id = '$spell_id' LIMIT 1", $ConnectDB['cms']), 0);
			}
			
			if ($mod == "v") {
				$r_str = @mysql_result(mysql_query("SELECT AffectedTargetLevel FROM `".$func_mysql_db['cms']."`.`armory_spell` WHERE id = '$spell_id' LIMIT 1", $ConnectDB['cms']), 0);
			}
			
			if ($mod == "b") {
				$r_str = @mysql_result(mysql_query("SELECT EffectPointsPerComboPoint_$num FROM `".$func_mysql_db['cms']."`.`armory_spell` WHERE id = '$spell_id' LIMIT 1", $ConnectDB['cms']), 0);
			}
			
			if ($mod == "e") {
				$r_str = @mysql_result(mysql_query("SELECT EffectMultipleValue_$num FROM `".$func_mysql_db['cms']."`.`armory_spell` WHERE id = '$spell_id' LIMIT 1", $ConnectDB['cms']), 0);
			}
			
			if ($mod == "i") {
				$r_str = @mysql_result(mysql_query("SELECT MaxAffectedTargets FROM `".$func_mysql_db['cms']."`.`armory_spell` WHERE id = '$spell_id' LIMIT 1", $ConnectDB['cms']), 0);
			}
			
			if ($mod == "f") {
				$r_str = @mysql_result(mysql_query("SELECT DmgMultiplier_$num FROM `".$func_mysql_db['cms']."`.`armory_spell` WHERE id = '$spell_id' LIMIT 1", $ConnectDB['cms']), 0);
			}
			
			if ($mod == "q") {
				$r_str = @mysql_result(mysql_query("SELECT EffectMiscValue_$num FROM `".$func_mysql_db['cms']."`.`armory_spell` WHERE id = '$spell_id' LIMIT 1", $ConnectDB['cms']), 0);
			}
			
			if ($mod == "h") {
				$r_str = @mysql_result(mysql_query("SELECT procChance FROM `".$func_mysql_db['cms']."`.`armory_spell` WHERE id = '$spell_id' LIMIT 1", $ConnectDB['cms']), 0);
			}
			
			if ($mod == "n") {
				$r_str = @mysql_result(mysql_query("SELECT procCharges FROM `".$func_mysql_db['cms']."`.`armory_spell` WHERE id = '$spell_id' LIMIT 1", $ConnectDB['cms']), 0);
			}
			
			if ($mod == "u") {
				$r_str = @mysql_result(mysql_query("SELECT StackAmount FROM `".$func_mysql_db['cms']."`.`armory_spell` WHERE id = '$spell_id' LIMIT 1", $ConnectDB['cms']), 0);
			}
			
			if ($mod == "a") {
				$result = @mysql_result(mysql_query("SELECT EffectRadiusIndex_$num FROM `".$func_mysql_db['cms']."`.`armory_spell` WHERE id = '$spell_id' LIMIT 1", $ConnectDB['cms']), 0);
				$r_1 = @mysql_result(mysql_query("SELECT radius_1 FROM `".$func_mysql_db['cms']."`.`armory_spell_radius` WHERE id = '$result' LIMIT 1", $ConnectDB['cms']), 0);
				$r_2 = @mysql_result(mysql_query("SELECT radius_2 FROM `".$func_mysql_db['cms']."`.`armory_spell_radius` WHERE id = '$result' LIMIT 1", $ConnectDB['cms']), 0);
				$r_3 = @mysql_result(mysql_query("SELECT radius_3 FROM `".$func_mysql_db['cms']."`.`armory_spell_radius` WHERE id = '$result' LIMIT 1", $ConnectDB['cms']), 0);
				if ($r_1 == 0 || $r_1 == $r_3) { $r_str = $r_3; } else { $r_str = $r_1 - $r_3; }
			}
			return $r_str;
		}
		
		public function GetRSENCHID($num) {
			return @$this -> m_irs_data['EnchantID_'.$num];
		}
		
		public function GetRSENCHDESC($num) {
			$ConnectDB['cms'] = $this -> ConnectDB['cms'];
			$func_mysql_db['cms'] = $GLOBALS['mysql_db']['cms'];
			$desc = mysql_result(mysql_query("SELECT description FROM `".$func_mysql_db['cms']."`.`armory_item_enchantment` WHERE id = '".($this -> m_irs_data['EnchantID_'.$num])."' LIMIT 1", $ConnectDB['cms']), 0);
			if ($this -> m_it_data['Quality'] == 2) { $field_name = "uncommon_"; }
			if ($this -> m_it_data['Quality'] == 3) { $field_name = "rare_"; }
			if ($this -> m_it_data['Quality'] == 4) { $field_name = "epic_"; }
			$r_points = @mysql_result(mysql_query("SELECT ".($field_name.$num)." FROM `".$func_mysql_db['cms']."`.`armory_random_property_points` WHERE itemlevel = '".($this -> m_it_data['ItemLevel'])."' LIMIT 1", $ConnectDB['cms']), 0);
			$prefix = $this -> m_irs_data['Prefix_'.$num];
			$e_points = round($r_points * $prefix/10000, 0);
			$desc = str_ireplace('$i', $e_points, $desc);
			return $desc;
		}
		
		public function GetRPENCHID($num) {
			return @$this -> m_irp_data['EnchantID_'.$num];
		}
		
		public function GetRPENCHDESC($num) {
			$ConnectDB['cms'] = $this -> ConnectDB['cms'];
			$func_mysql_db['cms'] = $GLOBALS['mysql_db']['cms'];
			return @mysql_result(mysql_query("SELECT description FROM `".$func_mysql_db['cms']."`.`armory_item_enchantment` WHERE id = '".($this -> m_irp_data['EnchantID_'.$num])."' LIMIT 1", $ConnectDB['cms']), 0);
		}
	}
?>
