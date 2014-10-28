<?php
require_once('connection/db.php'); 
mysql_select_db($database, $ntrl);
$query_rsfacilitys = "SELECT facilitys.ID, facilitys.name FROM facilitys ORDER BY facilitys.name";
$rsfacilitys = mysql_query($query_rsfacilitys, $ntrl) or die(mysql_error());
$row_rsfacilitys = mysql_fetch_assoc($rsfacilitys);
$totalRows_rsfacilitys = mysql_num_rows($rsfacilitys);
?>
<?php
   if(isset($_GET['msg'])){
	echo $_GET['msg'];
	}
   ?>
<form method="post" action="sampleview.php" name="save" >
        
        <table  border="1" cellpadding="0" cellspacing="0" class="data-table" style="width: auto; height:auto">	
        <tr>
        <th>
        		<h3>Section 1.1 </h3>
        </th>
        </tr>
		<tr class='even'>
        
		<th>Name of Assessor: </th>
        <td><input type="text" name="assessor" id="assessor" /></td>
        <th>Date of Assessment:</th>
        <td><input type="text" name="date" id="date"   value="" /></td>
        </tr>
        
        <tr class='even'>
		<th>Facility Name:	</th>
        <td>
        
        <select name="faciltyN" id="faciltyN" selected='selected' >
      <option value="0">Select Facility</option>
      <?php
do { 
?>
      <option value="<?php echo $row_rsfacilitys['ID']?>"><?php echo $row_rsfacilitys['name']; ?></option>
      <?php
} while ($row_rsfacilitys = mysql_fetch_assoc($rsfacilitys));
  $rows = mysql_num_rows($rsfacilitys);
  if($rows > 0) {
      mysql_data_seek($rsfacilitys, 0);
	  $row_rsfacilitys = mysql_fetch_assoc($rsfacilitys);
  }
?>
    </select></td>
        <th>Facility MFL Code: 	</th>
        <td><input type="text" name="fcode" id="fcode"   value="" /></td>
        </tr>
        
        <tr class='even'>
		<th>County:	 </th>
        <td><input type="text" name="county" id="county" /></td>
        <th>District:	</th>
        <td><input type="text" name="district" id="district"   value="" /></td>
        </tr>
        
        <tr class='even'>
		<th>Type of Facility: </th>
        <td><input type="text" name="faciltyType" id="faciltyType" /></td>
        <th>Facility Ownership:</th>
        <td><input type="text" name="faciltyOwn" id="faciltyOwn"   value="" /></td>
        </tr>
        <tr>
        <th>
        		<h3>Section 1.2 </h3>
        </th>
        </tr>
       
       	
		<tr class='odd'>
		<th>Position: </th>
        
        <th>Name:</th>
        
        <th>Phone Number:</th>
        </tr>
        
        <tr class='even'>
		<th>Medical Superintendent/ Facility in-charge:	</th>
        <td><input type="text" name="medname" id="medname" /></td>
        <td><input type="text" name="medphone" id="medphone"   value="" /></td>
        </tr>
        
         <tr class='odd'>
		<th>TB Clinic in-charge:	</th>
        <td><input type="text" name="TBname" id="TBname" /></td>
        <td><input type="text" name="TBphone" id="TBphone"   value="" /></td>
        </tr>
        
        <tr class='even'>
		<th>Lab Manager	:	</th>
        <td><input type="text" name="labname" id="labname" /></td>
        <td><input type="text" name="labphone" id="labphone"   value="" /></td>
        </tr>
        
        <tr class='odd'>
		<th>GeneXpert bench Tech:	</th>
        <td><input type="text" name="Gname" id="Gname" /></td>
        <td><input type="text" name="Gphone" id="Gphone"   value="" /></td>
        </tr>
        
        <tr>
         <div id="submit" align="center" >
            <input type="submit" name="submitsection1" id="submitsection1" value="Save & Continue"  class="button">
          </div>
          </tr>
</table>
              </form>
              
              
    