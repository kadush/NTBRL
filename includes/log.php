<?php
//login function

	function login($username,$password){
$loginSql="select username,password,category FROM user where username='$username' AND password='$password' LIMIT 1";
     		$login=mysql_query($loginSql) or die(mysql_error());
			$loginContent=mysql_fetch_row($login);
			
			//checks there is such a user
     		
			 if($loginContent!="" && $loginContent['2']=='1'){
			
			//sessions
        	$_SESSION['nm']=$loginContent['0'];
						
//checks level of user and whether acount is active
			if( $loginContent['2']==1){
			$redirect="admin/index.php";
			header("Location:".$redirect);
			}
			
			else if($loginContent['2']==2){
			$redirect="assessment/sections.php";	
			header("Location:".$redirect);
			}
						
			else if($loginContent['2']==3){
			$redirect="index.php";	
			header("Location:".$redirect);
			}
						
			else if($loginContent['2']==4){
			$redirect="index.php";	
			header("Location:".$redirect);
			}
			
			
			$output=true;
	

	 }
	 
			
  }
    

//gets the userlevels to be echoed during the partner registration
		function getUsergroup(){
			$sql="select * from usergroup";
			$result=mysql_query($sql);
		 	$res_array = array();
        	for($count = 0; @$row = mysql_fetch_array($result); $count++)  {   
            $res_array[$count] = $row;
        		}
       		 return $res_array;    
			
			}
				

  
	
									
?>