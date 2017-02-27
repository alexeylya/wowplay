<?php include_once './include/db.php'; ?>
<div style="padding-top:50px;"></div>
<a href="javascript:void(0);" onclick="closeText1();closeText2();getText()" style="text-decoration:none;">
<div class="realm-name-bg">
<div class="realm-name-text"><?php echo @$realm_title['1'];?> &nbsp - &nbsp <?php echo @$realm_re['1'];?></div>
<div id="text" style="display:none;">
<div class="realmlstaticimg1">
<? 
$fp = @fsockopen ("$dbip","$gameport",$errno,$errstr,1); 
if ($fp) 
echo '<img src="templates/main/images/on.png" alt="">'; 
else 
echo '<img src="templates/main/images/off.png" alt="">'; 
?> 
</div>
<div class="realmlstatictext1" style="display:block;position:relative;">
<a style="font-size:13px;"><?php echo @$str[$lang]['5'];?>: </a>&nbsp <?php  echo "$online";?></br>
<a style="font-size:13px;"><?php echo @$str[$lang]['54'];?>: </a>&nbsp <?php  echo "$allianceonline";?></br>
<a style="font-size:13px;"><?php echo @$str[$lang]['56'];?>: </a>&nbsp <?php  echo "$hordeonline";?></br>
<a style="font-size:13px;"><?php echo @$str['1']['181'];?>:</a>&nbsp <?php echo "$max"; ?></br>
<a style="font-size:13px;"><?php echo @$str[$lang]['179'];?>:</a> &nbsp <?php echo @$realm_ver['1'];?></br>
</div>	
</div>				
</div>
</a>

<div id="lalka123" style="display:none;"><div style="margin-top:120px;"></div></div>
<div id="lalka124" style="display:none;"><div style="margin-top:120px;"></div></div>
<a href="javascript:void(0);" onclick="closeText();closeText1();getText2()" style="text-decoration:none;">
<div class="realm-name-bg">
<div class="realm-name-text"><?php echo @$realm_title['2'];?> &nbsp - &nbsp <?php echo @$realm_re['2'];?></div>
<div id="text2" style="display:none;">
<div class="realmlstaticimg1">
<? 
$fp2 = @fsockopen ("$dbip2","$gameport2",$errno,$errstr,1); 
if ($fp2) 
echo '<img src="templates/main/images/on.png" alt="">'; 
else 
echo '<img src="templates/main/images/off.png" alt="">'; 
?> 
</div>
<div class="realmlstatictext1" style="display:block;position:relative;">
<a style="font-size:13px;"><?php echo @$str[$lang]['5'];?>: </a>&nbsp<?php echo "$online1";?> </br>
<a style="font-size:13px;"><?php echo @$str[$lang]['54'];?>: </a>&nbsp <?php  echo "$allianceonline1";?></br>
<a style="font-size:13px;"><?php echo @$str[$lang]['56'];?>: </a>&nbsp <?php  echo "$hordeonline1";?></br>
<a style="font-size:13px;"><?php echo @$str['1']['181'];?>:</a>&nbsp <?php echo "$max1"; ?></br>
<a style="font-size:13px;"><?php echo @$str[$lang]['179'];?>:</a> &nbsp <?php echo @$realm_ver['2'];?></br>
</div>
</div>				
</div>
</a>