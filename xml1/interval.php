<?php
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

$sqlmonthly="SELECT count(section6.howoften) as monthly FROM `section6` WHERE section6.howoften='Monthly'";	
$querymonthly=mysql_query($sqlmonthly,$conn ) or die(mysql_error());
$rsmonthly=mysql_fetch_assoc($querymonthly);

  $monthly=$rsmonthly['monthly'];
/* ****************************************************/		
$sqlBW="SELECT count(section6.howoften) as Biweekly FROM `section6` WHERE section6.howoften='Biweekly'";	
$queryBW=mysql_query($sqlBW,$conn ) or die(mysql_error());
$rsBW=mysql_fetch_assoc($queryBW);

  $Biweekly=$rsBW['Biweekly'];
/* ****************************************************/	
$sqlwk="SELECT count(section6.howoften) as Weekly FROM `section6` WHERE section6.howoften='Weekly'";	
$querywk=mysql_query($sqlwk,$conn ) or die(mysql_error());
$rswk=mysql_fetch_assoc($querywk);

  $Weekly=$rswk['Weekly'];

/* ****************************************************/	
$sqlevery="SELECT count(section6.howoften) as every FROM `section6` WHERE section6.howoften='Every 2-4 days'";	
$queryevery=mysql_query($sqlevery,$conn ) or die(mysql_error());
$rsevery=mysql_fetch_assoc($queryevery);

  $every=$rsevery['every'];
/* ****************************************************/
$sqldaily="SELECT count(section6.howoften) as daily FROM `section6` WHERE section6.howoften='Daily'" ;	
$querydaily=mysql_query($sqldaily,$conn ) or die(mysql_error());
$rsdaily=mysql_fetch_assoc($querydaily);

  $daily=$rsdaily['daily'];
/* ****************************************************/
$sqlsuper="SELECT count(section6.howoften) as super FROM `section6` WHERE section6.howoften='During supervision'";	
$querysuper=mysql_query($sqlsuper,$conn ) or die(mysql_error());
$rssuper=mysql_fetch_assoc($querysuper);

  $super=$rssuper['super'];
/* ****************************************************/	
	?>


<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">
 <set value="<?php echo $monthly; ?>" label="Monthly" color="4249AD"/>
 <set value="<?php echo $Biweekly; ?>" label="Biweekly" color="D4AC31" />
 <set value="<?php echo $Weekly; ?>" label="Weekly" color="429EAD"/>
 <set value="<?php echo $every; ?>" label="Every 2-4 days" color="AD42A2"/>
 <set value="<?php echo $daily; ?>" label="Daily" color="008900"/>
 <set value="<?php echo $super; ?>" label="During Supervision" color="BF0000"/>

 </chart>