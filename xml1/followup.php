<?php
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

$sql="SELECT count(section2.followup) as follow1 FROM `section2` WHERE section2.followup='Patients told to come back on certain date'";	
$query=mysql_query($sql,$conn ) or die(mysql_error());
$rs=mysql_fetch_assoc($query);

$follow1=$rs['follow1'];
/* ****************************************************/		
$sql2="SELECT count(section2.followup) as follow2 FROM `section2` WHERE section2.followup='Contacted via phone when results are in'";	
$query2=mysql_query($sql2,$conn ) or die(mysql_error());
$rs2=mysql_fetch_assoc($query2);

$follow2=$rs2['follow2'];
/* ****************************************************/	
$sql3="SELECT count(section2.followup) as follow3 FROM `section2` WHERE section2.followup='Health workers find them during outreach session'";	
$query3=mysql_query($sql3,$conn ) or die(mysql_error());
$rs3=mysql_fetch_assoc($query3);

$follow3=$rs3['follow3'];

/* ****************************************************/	
$sql4="SELECT count(section2.followup) as follow4 FROM `section2` WHERE section2.followup='Wait for patients to come back to facility'";	
$query4=mysql_query($sql4,$conn ) or die(mysql_error());
$rs4=mysql_fetch_assoc($query4);

$follow4=$rs4['follow4'];
/* ****************************************************/	
	?>


<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">
 <set value="<?php echo $follow1; ?>" label="Patients told to come back on certain date" color="429EAD"/>
 <set value="<?php echo $follow2; ?>" label="Contacted via phone when results are in" color="4249AD"/>
 <set value="<?php echo $follow3; ?>" label="Health workers find them during outreach session's" color="AD42A2"/>
 <set value="<?php echo $follow4; ?>" label="Wait for patients to come back to facility" color="D4AC31"/>


 </chart>