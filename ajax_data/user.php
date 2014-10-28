<?php

@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

 
 
    if (isset($_POST['id'])){
		$CountyID = $_POST['id'];
	    $sql4="SELECT id,name,username,mfl,facility,category
	    FROM user
	    WHERE id ='$CountyID'";
	    
	    $result=mysql_query($sql4,$conn) or die(mysql_error());
	
	   while ($data_array=mysql_fetch_array($result))
       {
       	$table.='<table class="table table-striped"><tr><th  style="text-align:center">User ID</th><th  style="text-align:center">Full Name</th><th  style="text-align:center">Username</th><th  style="text-align:center">Mfl Code</th><th  style="text-align:center">Facility Name</th></tr>';
        $table .= '<tbody><tr><td style="text-align:center">'.$data_array[0].'</td><td style="text-align:center">'.$data_array[1].'</td><td style="text-align:center">'.$data_array[2].'</td><td style="text-align:center">'.$data_array[3].'</td><td style="text-align:center">'.$data_array[4].'</td></tr></tbody></table>';
	   }
    }
  
   echo $table;
?>
