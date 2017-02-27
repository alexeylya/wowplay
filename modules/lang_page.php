
	
		<select onchange='location.replace("./?page=main&lang=" + this.options[this.selectedIndex].value)' id="lang2">
		<?php
			for ($i = 1; $i <= $lang_count; $i++) {
				if (@$lang == $i) {
					echo "<option selected=\"selected\" value=\"$i\">".$lang_name[$i]."</option>";
				} else { echo "<option value=\"$i\">".$lang_name[$i]."</option>"; }
			}
		?>
		</select>
	
