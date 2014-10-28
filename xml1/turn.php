<?php 

@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

$sqlsame="SELECT COUNT(section5.resultreturn) as same FROM section5 WHERE section5.resultreturn='Same day'" ;	
$querysame=mysql_query($sqlsame,$conn ) or die(mysql_error());
$rssame=mysql_fetch_assoc($querysame);

$same=$rssame['same'];
/* ****************************************************/
$sqlday="SELECT COUNT(section5.resultreturn) as day FROM section5 WHERE section5.resultreturn='24 hours'";	
$queryday=mysql_query($sqlday,$conn ) or die(mysql_error());
$rsday=mysql_fetch_assoc($queryday);

 $day=$rsday['day'];

?>
<chart yAxisName="# of Facilities"  useRoundEdges="1" bgColor="FFFFFF,FFFFFF" showBorder="0">

        <set label="Same day" value="<?php echo $same ?>"  /> 
        <set label="24 Hours" value="<?php echo $day ?>" /> 
        
</chart>