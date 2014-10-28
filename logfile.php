<?php
@session_start();
require_once('connection/db.php'); 

if(isset($_POST['login'])){
	$username=$_POST['username'];
    $password=$_POST['password'];
	
	if ($username=="" or $password==""){
	
	    $_SESSION['loginfail']="1";
		$errormsg = 'Log in failed.Please check your credentials again. ';
		session_destroy();
		}

	else {
	
	        $loginSql="select username,password,category,name, mfl FROM user where username='$username' AND password='$password' LIMIT 1";
     		$login=mysql_query($loginSql) or die(mysql_error());
			$loginContent=mysql_fetch_row($login);
			
			//checks there is such a user
     		if (!$loginContent) {
				 $errormsg='Invalid Username/Password';
				
			 }
			 
			//sessions
			$_SESSION['cat']=$loginContent['2'];
        	$_SESSION['nm']=$loginContent['3'];
			$_SESSION['mfl']=$loginContent['4'];
			
			
			//save activity
			$sq="INSERT INTO activitylog (`uname`, `activity`, `ugroup`) VALUES ('".$_SESSION['nm']."','login','".$_SESSION['cat']."')";
			$activity=mysql_query($sq) or die(mysql_error());
			//check if te facility has reported for th previous month
			
			$currentmonth=@date("m");
			$currentyear=@date("Y");
			$previousmonth=@date("m")- 1;
			
			if ($currentmonth ==1)
			{
			$previousmonth=12;
			$currentyear=@date("Y")-1;
			}
			else
			{
			$previousmonth=@date("m")- 1;
			$currentyear=@date("Y");
			}
			
			
			$query_rssample2 = "SELECT * FROM consumption WHERE MONTH(date)='$previousmonth' and  YEAR(date)='$currentyear' and  facility=".$_SESSION['mfl'];
			$rssample2 = @mysql_query($query_rssample2) or die(mysql_error());
			$row_rssample2 = @mysql_fetch_assoc($rssample2);
			$totalrow = @mysql_num_rows($rssample2);
            //checks level of user and whether acount is active
			if( $loginContent['2']==1){
							
			echo "<script>";
			echo "window.location.href='admin/index.php'";
			echo "</script>";
			}
						
			else if($loginContent['2']==2){
			
			echo "<script>";
			echo "window.location.href='assessment/sections.php'";
			echo "</script>";
			}
						
			else if( $loginContent['2']==3){
				
				if ($totalrow==0) {
					echo "<script>";
					echo "window.location.href='pendings.php'";
					echo "</script>";
				}
				else {
					echo "<script>";
					echo "window.location.href='index.php'";
					echo "</script>";
				   }
			}
						
			else if($loginContent['2']==4){
			 	
			echo "<script>";
			echo "window.location.href='pm/overall.php'";
			echo "</script>";
			}
			
			else if($loginContent['2']==6){
			 	
			echo "<script>";
			echo "window.location.href='pm/overall.php'";
			echo "</script>";
			}
			else if($loginContent['2']==5){
				$facilitycode= $_SESSION['mfl'];

				$sqlCN="SELECT  countys.ID AS cid,countys.name AS cN 
				FROM countys,facilitys ,districts
				WHERE 
				`facilitys`.`facilitycode`='$facilitycode'
				AND `districts`.`ID` = `facilitys`.`district`
				AND `countys`.`ID` = `districts`.`county` ";
				
				$qCN=mysql_query($sqlCN) or die(mysql_error());
				$rwCN=mysql_fetch_assoc($qCN);
				$countyID=$rwCN['cid'];
				$cname=$rwCN['cN'];
				
			 	
			echo "<script>";
			echo "window.location.href='dtlc/countyview.php?id=".$countyID."'";
			echo "</script>";
			}
			
			$output=true;
	
	 }
	
}
mysql_close($ntrl);
?>