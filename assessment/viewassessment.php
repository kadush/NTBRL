<?php
include("assessheader.php");
require_once('../connection/db.php'); 

if (isset($_GET['id'])){
		$FacilityID = $_GET['id'];
	}
mysql_select_db($database, $ntrl);
$q = "SELECT facilitys.name AS name FROM facilitys
WHERE `facilitys`.`facilitycode` ='$FacilityID'";
$r = mysql_query($q, $ntrl) or die(mysql_error());
$rn = mysql_fetch_array($r);
$fac=$rn['name'];

?>

<?php
mysql_select_db($database, $ntrl);
$query_rsfac = "SELECT section1.facility AS FCODE, section1.assessor AS ASSE, section1.doa AS DOA, section1.medName AS MN, section1.medPhone AS MP, section1.TbName AS TN, section1.TbPhone AS TP, section1.labName AS LN, section1.labPhone AS LP, section1.gName AS GN, section1.gPhone AS GP,section1.DtName AS DtN, section1.DtPhone AS DtP, `facilitys`.`name` AS FN, `districts`.`name` AS DN, `countys`.`name` AS CN, `facilitys`.`ftype` AS FT, `facilitys`.`owner` AS FO
FROM section1, facilitys, districts, countys
WHERE `section1`.`facility` = `facilitys`.`facilitycode`
AND `facilitys`.`facilitycode` ='$FacilityID'
AND `districts`.`ID` = `facilitys`.`district`
AND `countys`.`ID` = `districts`.`county`

";
$rsfac = mysql_query($query_rsfac, $ntrl) or die(mysql_error());
$row_rsfac = mysql_fetch_array($rsfac);



$query_rsSec2 = "SELECT section2.facility AS a, section2.cumulative AS b, section2.tbpermonth AS c, section2.mtb AS d, section2.hiv AS e, section2.followup AS f, section2.treatment AS g, section2.list AS h,section2.posfollow AS i, section2.hivtest AS j, section2.tbtest k, section2.challenges AS l
FROM section2
WHERE section2.facility='$FacilityID'
";
$rsSec2 = mysql_query($query_rsSec2, $ntrl) or die(mysql_error());
$row_rsSec2 = mysql_fetch_array($rsSec2);


$query_rsSec3 = "SELECT section3.facility AS a, section3.make AS b, section3.serial AS c, section3.make2 AS b2, section3.serial2 AS c2,section3.make3 AS b3, section3.serial3 AS c3,section3.make4 AS b4, section3.serial4 AS c4,section3.make5 AS b5, section3.serial5 AS c5,section3.online AS d, section3.computer AS e, section3.os AS f, section3.ram AS g, section3.cpu AS h,section3.space AS i, section3.policy AS j, section3.lis k, section3.server AS l, section3.lisreport AS m, section3.network AS n, section3.net_connection AS o, section3.pay AS p, section3.availability AS q, section3.convenience AS r, section3.data AS s, section3.provider AS t
FROM section3
WHERE section3.facility='$FacilityID'";

$rsSec3 = mysql_query($query_rsSec3, $ntrl) or die(mysql_error());
$row_rsSec3 = mysql_fetch_array($rsSec3);


$query_rsSec4= "SELECT *
FROM section4
WHERE section4.facility='$FacilityID'";

$rsSec4= mysql_query($query_rsSec4, $ntrl) or die(mysql_error());
$row_rsSec4= mysql_fetch_array($rsSec4);	



$query_rsSec5= "SELECT *
FROM section5
WHERE section5.facility='$FacilityID'";

$rsSec5= mysql_query($query_rsSec5, $ntrl) or die(mysql_error());
$row_rsSec5= mysql_fetch_array($rsSec5);		


$query_rsSec6= "SELECT *
FROM section6
WHERE section6.facility='$FacilityID'";

$rsSec6= mysql_query($query_rsSec6, $ntrl) or die(mysql_error());
$row_rsSec6= mysql_fetch_array($rsSec6);	
?>



<link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
<link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery.ui.all.css">
	<script src="../jquery-ui-1.10.3/tests/jquery-1.9.1.js"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.core.js"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.widget.js"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.mouse.js"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.resizable.js"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.accordion.js"></script>

<link rel="stylesheet" href="../jquery-ui-1.10.3/demos/demos.css">

<script>
	$(function() {
		$( "#accordion" ).accordion({
			heightStyle: "content",
			collapsible: true,
            active: false
		});
	});
	</script>
   
<div class="clearer">&nbsp;</div>

<div class="main" id="main-two-columns">

			<div class="left" id="main-left">
            
<div class="section-title" style="width:990px">Assessment Details for <?php echo $fac  ?> </div>

<div id="accordion-resizer" class="ui-widget-content">
	<div id="accordion">
		<h3><strong>SECTION ONE: Health Facility Contact  Information</strong></h3>
		<div>
			
        <table align="center"  border="1" cellpadding="0" cellspacing="0" class="data-table" style="width: auto; height:auto">
        <tr>
       <th><h3>Section 1.1</h3></th>
        </tr>	
		<tr class='even'>
		<th>Name of Assessor: </th>
        <td><input type="text" name="assessor" id="assessor"   value="<?php echo $row_rsfac['ASSE']; ?>"/></td>
        <th>Date of Assessment:</th>
        <td><input type="text" name="date" id="date"    value="<?php echo $row_rsfac['DOA']; ?>" /></td>
        </tr>
        
        <tr class='even'>
		<th>Facility Name:	</th>
        <td><input type="text" name="faciltyN" id="faciltyN"  value="<?php echo $row_rsfac['FN']; ?>" /></td>
        <th>Facility MFL Code: 	</th>
        <td><input type="text" name="fcode" id="fcode"    value="<?php echo $row_rsfac['FCODE']; ?>"/></td>
        </tr>
        
        <tr class='even'>
		<th>County:	 </th>
        <td><input type="text" name="county" id="county"  value="<?php echo $row_rsfac['CN']; ?>" /></td>
        <th>District:	</th>
        <td><input type="text" name="district" id="district"    value="<?php echo $row_rsfac['DN']; ?>" /></td>
        </tr>
        
        <tr class='even'>
		<th>Type of Facility: </th>
        <td><input type="text" name="faciltyType" id="faciltyType"  value="<?php echo $row_rsfac['FT']; ?>" /></td>
        <th>Facility Ownership:</th>
        <td><input type="text" name="faciltyOwn" id="faciltyOwn"    value="<?php echo $row_rsfac['FO']; ?>" /></td>
        </tr>
        
        <tr>
       <th><h3>Section 1.2</h3></th>
        </tr>	
		<tr class='odd'>
		<th>Position: </th>
        
        <th>Name:</th>
        
        <th>Phone Number:</th>
        </tr>
        
        <tr class='even'>
		<th>Medical Superintendent/ Facility in-charge:	</th>
        <td><input type="text" name="medname" id="medname"  value="<?php echo $row_rsfac['MN']; ?>" /></td>
        <td><input type="text" name="phone" id="phone"   value="<?php echo $row_rsfac['MP']; ?>"  /></td>
        </tr>
        
         <tr class='odd'>
		<th>TB Clinic in-charge:	</th>
        <td><input type="text" name="TBname" id="TBname"  value="<?php echo $row_rsfac['TN']; ?>" /></td>
        <td><input type="text" name="TBphone" id="TBphone"   value="<?php echo $row_rsfac['TP']; ?>"/></td>
        </tr>
        
        <tr class='even'>
		<th>Lab Manager	:	</th>
        <td><input type="text" name="labname" id="labname"  value="<?php echo $row_rsfac['LN']; ?>"/></td>
        <td><input type="text" name="labphone" id="labphone"    value="<?php echo $row_rsfac['LP']; ?>"/></td>
        </tr>
        
        <tr class='odd'>
		<th>GeneXpert bench Tech:	</th>
        <td><input type="text" name="Gname" id="Gname"  value="<?php echo $row_rsfac['GN']; ?>"/></td>
        <td><input type="text" name="Gphone" id="Gphone"    value="<?php echo $row_rsfac['GP']; ?>" /></td>
        </tr>
        <tr class='even'>
		<th>DTLC:	</th>
        <td><input type="text" name="DtName" id="DtName"  value="<?php echo $row_rsfac['DtN']; ?>"/></td>
        <td><input type="text" name="DtPhone" id="DtPhone"    value="<?php echo $row_rsfac['DtP']; ?>" /></td>
        </tr>
        </table>
</div>
		<h3><strong>SECTION TWO: TB Clinical Information (TB Clinic)</strong></h3>
		<div>
		  
          
          
          <h3>Section 2.1 </h3>
		<div>
			<p>
            <label> Cumulative no of TB patients (in the last 3 years):  </label>
            <?php echo $row_rsSec2['b']; ?></p>
			<p>
			  <label> No of patients with presumptive TB per month: </label>
              <?php echo $row_rsSec2['c']; ?>
		  </p>
			<p>
			  <label >No of MDR-TB suspects/month: </label>
              <?php echo $row_rsSec2['d']; ?>
		  </p>
			<p>
			  <label>No of TB patients on HIV care and treatment:</label>
			  <?php echo $row_rsSec2['e']; ?>
			  
		  </p>
		</div>
		<h3>Section 2.2 </h3>
		<div>
			<p><label>How are patients followed up when their results come back?
            </label>
            <?php echo $row_rsSec2['f']; ?></p>
		</div>
		<h3>Section 2.3</h3>
		<div>
			<p><label>Where are patients initiated on treatment?</label>
            <?php echo $row_rsSec2['g']; ?></p>
			
		</div>
		<h3>Section 2.4</h3>
		<div>
			<p><label>If referred to a different facility, is the list of patients initiated sent back from the treatment site?</label>
            <?php echo $row_rsSec2['h']; ?> </label></p>
		</div>
        <h3>Section 2.5</h3>
		<div>
			<p><label>How many patients initiated come for follow up visits (ONLY answer if treatment at this facility) </label>
            <?php echo $row_rsSec2['i']; ?></p>
		</div>
        <h3>Section 2.6</h3>
		<div>
			<p><label>Are all patients that come in for a TB test also given an HIV test?</label>
            <?php echo $row_rsSec2['j']; ?></p>
		</div>
        <h3>Section 2.7</h3>
		<div>
			<p><label>Are all patients that come in for an HIV treatment screened and tested for TB test?</label>
            <?php echo $row_rsSec2['k']; ?></p>
		</div>
        <h3>Section 2.8</h3>
		<div>
			<p><label> What are the biggest challenges when it comes to tuberculosis care?</label>
            <?php echo $row_rsSec2['l']; ?> </label></p>
		</div>
          
          
          
          
          
          
          
          
		</div>
		<h3><strong>SECTION THREE: M-Health infrastructure (in the lab) </strong></h3>
		<div>
	    
        
        <h3>Section 3.1</h3>
		<div>
			<p><label>What is the make, model and serial number of the GeneXpert instrument?</label></p>
			<ul>
              <table border="1" cellpadding="0" cellspacing="0" class="data-table" width="100%">
                <tr>
                  <th style="font-size:9px;">#</th>
                  <th style="font-size:9px;">GeneXpert1</th>
                  <th style="font-size:9px;">
                    GeneXpert2</th>
                  <th style="font-size:9px;">
                    GeneXpert3</th>
                  <th style="font-size:9px;">                    GeneXpert4</th>
                  <th style="font-size:9px;">                    GeneXpert5</th>
                </tr>
                <tr>
                  <th style="font-size:9px;">Make and model:</th>
                  <td><?php echo $row_rsSec3['b']; ?></td>
                  <td><?php echo $row_rsSec3['b2']; ?></td>
                  <td><?php echo $row_rsSec3['b3']; ?></td>
                   <td><?php echo $row_rsSec3['b4']; ?></td>
	                <td><?php echo $row_rsSec3['b5']; ?></td>
                </tr>
                <tr>
                  <th style="font-size:9px;">Serial No:</th>
                  <td><?php echo $row_rsSec3['c']; ?></td>
                  <td><?php echo $row_rsSec3['c2']; ?></td>
                  <td><?php echo $row_rsSec3['c3']; ?></td>
                  <td><?php echo $row_rsSec3['c4']; ?></td>
                  <td><?php echo $row_rsSec3['c5']; ?></td>
	                
                </tr>
              </table>			
			</ul>
		</div>
		<h3>Section 3.2</h3>
		<div>
			<p><label>Is there local support and/ online support for the instrument?  </label>
              <?php echo $row_rsSec3['d']; ?> </label></p>
		</div>
		<h3>Section 3.3</h3>
		<div>
	    <p><label>At the site, is there a computer (desktop/ laptop) that can be configured to be used to run the instruments' software LIMS? </label>  <?php echo $row_rsSec3['e']; ?> </label></p><label>If so what are the hardware and software specifications?</label>  <?php echo $row_rsSec3['f']; ?> </label>
			<ul>
                <li>Operating System:  <?php echo $row_rsSec3['g']; ?> </label></li>
				<li>RAM (Random Access Memory:  <?php echo $row_rsSec3['h']; ?> </label></li>
				<li>CPU Processor speed:  <?php echo $row_rsSec3['i']; ?> </label></li>
				<li>Hard disk space:  <?php echo $row_rsSec3['j']; ?> </label></li>
			</ul>
		</div>
		<h3>Section 3.4</h3>
		<div>
		  <p><label>Are there any existing polices on software installation and configuration on the computers?</label>  <?php echo $row_rsSec3['k']; ?> </label></p>
		</div>
        <h3>Section 3.5</h3>
		<div>
		  <p><label>Is there an existing LIS (Laboratory Information System)? </label>  <?php echo $row_rsSec3['k']; ?> </label>
          </p>
          <p>
          If yes, please specify the details including the name, the vendor etc
            <ul>       
                <li>Is it LIS HL7 (server) compliant?   <?php echo $row_rsSec3['l']; ?> </label></li>
                <li> How is the reporting done on LIS?  <?php echo $row_rsSec3['m']; ?> </label></li>
            </ul>
          </p>
		</div>
        <h3>Section 3.6</h3>
		<div>
		  <p><label>Is there an existing network infrastructure and if so, what are the specific design configurations (LAN (Local Area Network), W-LAN)?</label>  <?php echo $row_rsSec3['n']; ?> </label></p>
		</div>
        <h3>Section 3.7</h3>
		<div>
		  <p><label> Does the lab section have access to stable Internet? </label>  <?php echo $row_rsSec3['o']; ?> </label>
          
          <ul>       
                <li>If yes, who pays for internet?   <?php echo $row_rsSec3['p']; ?> </label></li>
                <li>How many days per week is it available?  <?php echo $row_rsSec3['q']; ?> </label></li>
                <li>How fast is the Internet connection?   <?php echo $row_rsSec3['r']; ?> </label></li>
          </ul>
          </p>
		</div>
        <h3>Section 3.8</h3>
		<div>
		  <p><label>What do you use to connect to the Internet? </label>  <?php echo $row_rsSec3['s']; ?> </label>  </p>
		</div>
        <h3>Section 3.9</h3>
		<div>
		  <p><label>What is the mobile company network coverage stable in you area</label>
		  ?<?php echo $row_rsSec3['t']; ?> </label></p>
		</div>
        
        
        
        
		</div>
		<h3><strong>SECTION FOUR: Sample Referral  System</strong></h3>
		<div>
		  <h3>Section 4.1</h3>
		<div>
			<p>
            
            <table border='0' class='data-table'>	
		    <tr class='even'>
           
            <th>Name of Referral site</th>
            <th>Type of test received from site? (Diagnosis or RIF  Resistance)
</th>
            <th>Approximate distance from site</th>
            <th>Average Number of Samples per Week</th>
            <th>Frequency of sample referral </th>
            </tr>
            
             <?php do { ?>      
<tr class="odd gradeX">
 
<td> <?php echo $row_rsSec4['reference']; ?></td> 
<td> <?php echo $row_rsSec4['test']; ?></td>
<td> <?php echo $row_rsSec4['distance']; ?></td>
<td><?php echo $row_rsSec4['sample']; ?></td>
<td> <?php echo $row_rsSec4['frequency']; ?></td> 

    </tr>
      <?php } while ($row_rsSec4 = mysql_fetch_assoc($rsSec4)); ?> 
      
       <?php  ?>  
            </table>
            </p>
		</div>
		</div>
        <h3><strong>SECTION FIVE: Laboratory Workflow</strong></h3>
		<div>
		  <h3>Section 5.1</h3>
		<div>
			<p><strong>How  many samples have been processed in the GeneXpert in the last one year </strong><em>(1-09-12 to 30-08-13):</em></label>
            </p>
			<p><strong>Total tests performed:</strong><?php echo $row_rsSec5['ttest']; ?> </label></p>
			<p><strong>MTB  detected:</strong><?php echo $row_rsSec5['mtb']; ?> </label></p>
			<p><strong>RIF </strong><em>(Rifampicin)</em><strong>Resistant:</strong><?php echo $row_rsSec5['Rifampicin']; ?> </label></p>
		</div>
		<h3>Section 5.2</h3>
         	 	 	 	 	 
		<div>
		  <p><strong>How are samples  received in the lab recorded </strong><em>(workflow from sample receipt to processing)</em><strong>?</strong><?php echo $row_rsSec5['recsample']; ?> </label></p>
		  <p><strong>How is the  workflow managed?</strong><?php echo $row_rsSec5['workflow']; ?> </label></p>
</div>
		<h3>Section 5.3</h3>
		<div>
	    <p><strong>What  is the average turn around time from sample collection to results being  returned to clinic or patients?</strong></label></p>
	    <p><strong>Results  returned within the facility to TB Clinic? </strong><?php echo $row_rsSec5['resultreturn']; ?> </label></p>
	    <p><strong>Results  returned to referring facilities?</strong><?php echo $row_rsSec5['resultback']; ?> </label></p>
			
		</div>
		<h3>Section 5.4</h3>
		<div>
          
		  <p><strong>What  is the standard format used to relay results to clinicians?</strong><?php echo $row_rsSec5['format']; ?> </label></p>
		</div>
        <h3>Section 5.5</h3>
		<div>
		  <p><strong>Does the facility  still use sputum microscopy for TB detection?</strong><?php echo $row_rsSec5['microscopy']; ?> </label>
          
           </p>
		  <p><strong>If yes, please specify under  which cases microscopy is carried out? </strong>
		    <?php echo $row_rsSec5['ptype']; ?> </label>
		    </p>
        </div>
        <h3>Section 5.6</h3>
		<div>
		  <p><strong>Are  RIF resistance cases referred to the NTRL for DST </strong>(1-09-2012-30-08-2013)<strong>? </strong><?php echo $row_rsSec5['rif']; ?> </label></p>
		  <p><strong>If yes, how many samples have been referred to NTRL?</strong><?php echo $row_rsSec5['sampleNO']; ?> </label></p>
		</div>
        <h3>Section 5.7</h3>
		<div>
		  <p><strong>How are results from NTRL recorded in the facility? </strong><?php echo $row_rsSec5['recorded']; ?> </label></p>
		</div>
	</div>
		 	 	 	
        <h3><strong>SECTION SIX: Stock Management</strong></h3>
		<div>
		
         	 	 	 	 	
        <h3>Section 6.1</h3>
		<div>
			<p><strong>. Who is  responsible for supplying GeneXpert reagents and commodities to the facility?</strong><?php echo $row_rsSec6['responsible']; ?></p>
</div>
		<h3>Section 6.2</h3>
		<div>
		  <p><strong>How  are lab supplies distributed?</strong><?php echo $row_rsSec6['distribution']; ?></p>
		</div>
		<h3>Section 6.3</h3>
		<div>
	    <p><strong>If pull system, what is the timeframe for these deliveries? Are lab supplies  ordered and delivered in the same timeframe each time? (i.e. quarterly,  monthly)</strong><?php echo $row_rsSec6['timeframe']; ?></p>
		</div>
		<h3>Section 6.4</h3>
		<div>
		  <p><strong>Is  there a set day when the facility reports on stock commodities?</strong><?php echo $row_rsSec6['day']; ?></p>
		</div>
        <h3>Section 6.5</h3>
		<div>
		  <p><strong>If  yes, where does the facility send the stock commodity management report to?</strong><?php echo $row_rsSec6['send']; ?></p>
		</div>
         	 	 	
        <h3>Section 6.6</h3>
		<div>
		  <p><strong>Is there a contact  officer at the district for the facility to call with issues or queries  regarding stock levels of lab commodities?</strong><?php echo $row_rsSec6['contactperson']; ?></p>
		  <p>If yes, specify who
		  	<ul>
          <li>Contact  Name: <?php echo $row_rsSec6['name']; ?></li>
		   <li> Contact  Number:<?php echo $row_rsSec6['no']; ?></li>
           </ul>
           </p>
        </div>
        <h3>Section 6.7</h3>
		<div>
		  <p><strong>How  many emergency GeneXpert kits have been ordered in the last year?</strong><?php echo $row_rsSec6['emergencykits']; ?></p>
		</div>
        <h3>Section 6.8</h3> 	 	 	 	 	
		<div>
		  <p><strong>How are lab commodities for TB Xpert testing tracked and recorded at this facility?</strong><?php echo $row_rsSec6['XpertTracking']; ?></p>
		</div>
        <h3>Section 6.9</h3>
		<div>
		  <p><strong>If  there is a system in place to monitor Xpert kits are these updated regularly?   </strong><?php echo $row_rsSec6['system']; ?></p><p><strong>If yes, how often are these systems updated? </strong><?php echo $row_rsSec6['howoften']; ?></p>
        </div>
        <h3>Section 6.10</h3>
		<div>
		  <p><strong>Where are TB Xpert testing Kits stored?</strong><?php echo $row_rsSec6['Kitsstored']; ?> </p>
          <p><strong>If the kits are stored away from TB lab, how are they managed and dispensed to the lab?</strong><?php echo $row_rsSec6['Managed']; ?></p>
		</div>
        <h3>Section 6.11</h3>
		<div>
		   <p><strong>Additional comments</strong></p><p><?php echo $row_rsSec6['com']; ?></p>
		</div>
              
        
        
        
        </div>
        
	</div>
</div>
           
           </div>

		
<div class="clearer">&nbsp;</div>

	  </div>
	</div>
</div>
</div>

</body>
</html>
<?php
include("../includes/footer.php");
?>