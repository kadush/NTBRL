 <?php
include("assessheader.php");
?>

<link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
<link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery-ui.css">

<link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery.ui.tabs.css">
	<script src="../jquery-ui-1.10.3/tests/jquery-1.9.1.js"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.core.js"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.widget.js"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.mouse.js"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.resizable.js"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.accordion.js"></script>
    <script src="../jquery-ui-1.10.3/ui/jquery.ui.tabs.js"></script>
<link rel="stylesheet" href="../jquery-ui-1.10.3/demos/demos.css">
 <script>
$(function() {
$( "#tabs" ).tabs();
});

</script>


<div class="clearer">&nbsp;</div>

<div class="main" id="main-two-columns">

	<div class="left" id="main-left">
           
         <div id="tabs">
<ul>
                 <li><a href="#fragment-1">Section I</a></li>
                 <li><a href="#fragment-2">Section II</a></li>
                 <li><a href="#fragment-3">Section III</a></li>
                 <li><a href="#fragment-4">Section IV</a></li>
                 <li><a href="#fragment-5">Section V</a></li>
                 <li><a href="#fragment-6">Section VI</a></li>
                </ul>
                
                
                
             <div id="fragment-1">
             
         
           </div>
            
            
            
             <div id="fragment-2">
             
            <form name="save2" method="post">
            <table class="data-table" border="1">
            <tr> 
		<th><h3>Section 2.1 </h3></th>
        </tr>
        <tr>
        <td>
		<div>
        
			<p>
            <label>Facility Name:</label><input type="hidden" name="facility" id="facility" value="<?php echo $row_rsfacSEC[0]; ?>" /><input type="text" name="facilityN" id="facilityN" width="40px" value="<?php echo $row_rsfacSEC[1]; ?>" disabled/></p>
            <p>
            <label> Cumulative no of TB patients (in the last 3 years):  </label>
            <input type="text" name="cumulativeTB" id="cumulativeTB" width="40px"/>
            </p>
			<p>
			  <label> No of patients with presumptive TB per month: </label>
              <input type="text" name="TBpermonth" id="TBpermonth" width="40px"/>
		  </p>
			<p>
			  <label >No of MDR-TB suspects/month (contacts, retreatment, relapses, non-converters):  </label>
               <input type="text" name="MTB" id="MTB" width="40px"/>
		  </p>
			<p>
			  <label>No  of TB patients on HIV care and treatment:</label>
			  <input type="text" name="hiv" id="hiv" width="40px"/>
		  </p>
		</div>
        </td>
        </tr>
        <tr>
        <th>
        		<h3>Section 2.2 </h3>
        </th>
        </tr>
        <tr>
        <td>        
		<div>
			<p><label>How are patients followed up when their results come back? </label>
       <select name="follow" id="follow"  >
      <option value="0">Select One</option>
      <option value="Patients told to come back on certain date">Patients told to come back on certain date</option>
      <option value="Contacted via phone when results are in">Contacted via phone when results are in</option>
      <option value="Health workers find them during outreach session's">Health workers find them during outreach session's</option>
      <option value="Wait for patients to come back to facility">Wait for patients to come back to facility</option>
      
    </select>     
            
            </p>
		</div>
        
        </td>
        </tr>
        <tr>
        <th>
		<h3>Section 2.3</h3>
        </th>
        </tr>
        <tr>
        <td>
		<div>
			<p><label>Where are patients initiated on treatment?</label>
            
            <select name="treat" id="treat"  >
      <option value="0">Select One</option>
      <option value="At this facility when they come to collect their results">At this facility when they come to collect their results       </option>
      <option value="Referred to a different facility to obtain treatment">Referred to a different facility to obtain treatment</option>
      
    </select>
             </p>
			
		</div>
        </td>
        </tr>
        <tr>
        <th>
		<h3>Section 2.4</h3>
        </th>
        <tr>
        <td>
		<div>
			<p><label>If referred to a different facility, is the list of patients initiated sent back from the treatment site?</label>
            
            <select name="site" id="site"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select> </p>
		</div>
        
        </td>
        </tr>
        <tr>
        <th>
        <h3>Section 2.5</h3>
        </th>
        <tr>
        <td>
		<div>
			<p><label>How many patients initiated come for follow up visits (ONLY answer if treatment at this facility) </label>
      <select name="come" id="come"  >
      <option value="0">Select One</option>
      <option value="Less than 10%">Less than 10%</option>
      <option value="10-20%">10-20%</option>
      <option value="20-30%">20-30%</option>
      <option value="30-40%">30-40%</option>
      <option value="40-50% ">40-50%</option>
      <option value="50-60%">50-60%</option>
      <option value="60-75%">60-75%</option>
      <option value="75-100%">75-100%</option>
    </select>
            </p>
		</div>
        </td>
        </tr>
        <tr>
        <th>
        <h3>Section 2.6</h3>
        </th>
        <tr>
        <td>
		<div>
			<p><label>Are all patients that come in for a TB test also given an HIV test?</label> 
      <select name="hivtest" id="hivtest"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      </select>
            </p>
		</div>
        </td>
        </tr>
        <tr>
        <th>
        <h3>Section 2.7</h3>
        </th>
        <tr>
        <td>
		<div>
			<p><label>Are all patients that come in for an HIV treatment screened and tested for TB test?</label>
      <select name="tbtest" id="tbtest"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      </select>
            </p>
		</div>
        </td>
        </tr>
        <tr>
        <th>
        <h3>Section 2.8</h3>
        </th>
        <tr>
        <td>
        <div>
			<p><label> What are the biggest challenges when it comes to tuberculosis care?</label> 
            <textarea name="challenges" id="challenges" rows="4" cols="50"> 
            </textarea> 
            
            </p>
		</div>
        </td>
        </tr>
        
        <tr>
        
        <div id="submit" align="center">
<input name="submitsection2" type="submit" id="submitsection2" value="Save & Continue"  class="button"> 
 </div>
            
         </tr>
         </table>
         </form>
         
         
         </div>
         
         
         
          <div id="fragment-3">
            
            <form name="save3" method="post">
            <table class="data-table" border="1">
            <tr> 
		<th width="65%"><h3>Section 3.1 </h3></th>
        </tr>
        <tr>
        <td>
        
          
		<div>
        <p>
            <label>Facility Name:</label><input type="hidden" name="facility" id="facility" value="<?php echo $row_rsfacSEC[0]; ?>" /><input type="text" name="facilityN" id="facilityN" width="40px" value="<?php echo $row_rsfacSEC[1]; ?>" disabled/></p>
			<p><label>What is the make, model and serial number of the GeneXpert instrument?</label></p>
		  
            <ul>
				<li>Make and model:<input type="text" name="make" id="make" /></li>
				<li>Serial No:<input type="text" name="serial" id="serial" /></li>
				
			</ul>
		</div>
        </td>
        </tr>
        <tr>
        <th>
        
		<h3>Section 3.2</h3>
       </th>
       </tr>
       	
        <tr>
        <td>
        <div>
			<p><label>Is there local support and/ online support for the instrument?  </label>
            <select name="local" id="local"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select> </p>
    </div>
            </td>
            </tr>
		
      <tr>
        <th>        
		<h3>Section 3.3</h3>
        </th>
        </tr>
		
        <tr>
        <td><div>
        
        
	    <p><label>At the site, is there a computer (desktop/ laptop) that can be configured to be used to run the instruments' software LIMS? </label>
        <select name="comp" id="comp"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select> 
        </p>
        </div>
        </td>
        </tr>
        <tr>
        <td>
        <div>
        <label>If so what are the hardware and software specifications?</label>
			<ul>
                <li>Operating System:<input type="text" name="os" id="os" /></li>
				<li>RAM (Random Access Memory:<input type="text" name="ram" id="ram" /></li>
				<li>CPU Processor speed:<input type="text" name="cpu" id="cpu" /></li>
				<li>Hard disk space:<input type="text" name="space" id="space" /></li>
			</ul>
            </div>
          </td>
          </tr>  
		
        <tr>
        <th>
		<h3>Section 3.4</h3>
        </th>
		
        <tr>
        <td><div>
		  <p><label>Are there any existing polices on software installation and configuration on the computers?</label>
          <select name="policies" id="policies"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select>
          </p>
          </div>
          </td>
          </tr>
		
        <tr>
        <th>
        <h3>Section 3.5</h3>
        </th>
        </tr>
		
        <tr>
        <td><div>
		  <p><label>Is there an existing LIS (Laboratory Information System)? </label>
          <select name="lis" id="lis"  >
      <option value="0">Select One</option>
      <option value="LAN">LAN</option>
      <option value="Modem">Modem</option>
      <option value="wireless">wireless</option>
    </select>
          </p>
          </div>
        </td>
        </tr>
        <tr>
        <td>
        <div>
          <p>
          <label>If yes, please specify the details including the name, the vendor etc</label>
              <ul>       
                <li>Is it LIS HL7 (server) compliant? <select name="server" id="server"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select></li>
                <li> How is the reporting done on LIS?<input type="text" name="lisrep" id="lisrep" /></li>
              </ul>
          </p>
          
		</div>
        </td>
        </tr>
        <tr>
        <th>
        <h3>Section 3.6</h3>
        </th>
        </tr>
		
        <tr>
        <td>
        <div>
		  <p><label>Is there an existing network infrastructure and if so, what are the specific design configurations (LAN (Local Area Network), W-LAN)?</label>
          <select name="netwak" id="netwak"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select>
          </p>
		 </div>
        </td>
       </tr>
       
        <tr>
        <th>
        <h3>Section 3.7</h3>
        </th>
		
        <tr>
        <td>
        <div>
		  <p><label> Does the lab section have access to stable Internet? </label>
          <select name="internet" id="internet"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select>
          
          <ul>       
                <li>If yes, who pays for internet?<input type="text" name="pay" id="pay" /> </li>
                <li>How many days per week is it available?<input type="text" name="available" id="available" /></li>
                <li>How fast is the Internet connection?<input type="text" name="fast" id="fast" /> </li>
          </ul>
          </p>
          </div>
          </td>
          </tr>
		
        <tr>
        <th>
        <h3>Section 3.8</h3>
        </th>
        </tr>
        <tr>
        <td>
		<div>
		  <p><label>What do you use to connect to the Internet? </label>
          
          <select name="connect" id="connect"  >
      <option value="0">Select One</option>
      <option value="LAN">LAN</option>
      <option value="Modem">Modem</option>
      <option value="wireless">wireless</option>
    </select>
            </p>
		</div>
        </td>
        </tr>
        <tr>
        <th>
        <h3>Section 3.9</h3>
        </th>
        <tr>
        <td>
		<div>
        
		  <p><label>What is the mobile company network coverage stable in you area</label>
          
          <select name="provider" id="provider"  >
      <option value="0">Select One</option>
      <option value="Safaricom">Safaricom</option>
      <option value="Zain">Zain</option>
      <option value="Yu">Yu</option>
       <option value="Orange">Orange</option>
    </select>
          </p>
          </div>
          </td>
          </tr>
          <tr>
		  <div id="submit" align="center" >
            <input type="submit" name="submitsection3" id="submitsection3" value="Save & Continue"  class="button">
            </div>
            </tr>
           </table>
           </form> 
            
            
            
            
              
            
</div>
              
              
          <div id="fragment-4">
          
          <form name="save4" method="post">
          <table border='0' class='data-table'>	
         <tr class='even'><input type="hidden" name="facility" id="facility" value="<?php echo $row_rsfacSEC[0]; ?>" />
           <th>Name of Genexpert site</th>
           <td> <input type="facility" name="facility" id="facility"   value="<?php echo $row_rsfacSEC[1]; ?>" disabled/></td>
           </tr>
           <tr>
            <th>Name of Referral site</th>
            <td> <select name="Rfacility" id="Rfacility" selected='selected' >
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
             </tr>
              <tr>
            <th>Type of test received from site? (Diagnosis or RIF  Resistance)
</th><td> <input type="text" name="test" id="test"   value="" /></td>
</tr>
             <tr><th>Approximate distance from site</th> <td> <input type="text" name="distance" id="distance"   value="" /></td></tr>
             <tr><th>Average Number of Samples per Week</th><td> <input type="text" name="sample" id="sample"   value="" /></td></tr>
             <tr><th>Frequency of sample referral </th><td> <input type="text" name="frequency" id="frequency"   value="" /></td></tr>
            
              
          
            
            <tr>
              <div id="submit" align="center" >
            <input type="submit" name="submitsection4" id="submitsection4" value="Save & Continue"  class="button">
            </div>
            </tr>
            </table>
          
          </form>
             
            
</div>
              
              
         <div id="fragment-5">
        <form name="save4" method="post">
          <table border='0' class='data-table'>	
		    <tr class='even'>
            <th>
           <h3>Section 5.1</h3>
           </th>
           
           <tr>
           <td>
		<div>
            <p>
              <label>Facility Name:</label>
              <input type="hidden" name="facility" id="facility" value="<?php echo $row_rsfacSEC[0]; ?>" /><input type="text" name="facilityN" id="facilityN" width="40px" value="<?php echo $row_rsfacSEC[1]; ?>" disabled/>
            </p>
            <p>&nbsp; </p>
            <p><strong>How  many samples have been processed in the GeneXpert in the last one year </strong><em>(1-09-12 to 30-08-13)</em> <input type="text" name="Gsample" id="facility"   value="" /></p>
            
			<p><strong>Total tests performed?<input type="text" name="ttest" id="ttest"   value="" /></strong></p>
			<p><strong>MTB  detected</strong><input type="text" name="mtb" id="mtb"   value="" /></p>
			<p><strong>RIF </strong><em>(Rifampicin)</em><strong>Resistant</strong><input type="text" name="Rifampicin" id="Rifampicin"   value="" /></p>
		</div>
        </td>
        </tr>
        <tr>
        <th>
		<h3>Section 5.2</h3>
        </th>
        <tr>
        <td>
		<div>
		  <p><strong>How are samples  received in the lab recorded </strong><em>(workflow from sample receipt to processing)</em><strong>?</strong><input type="text" name="recsample" id="recsample"   value="" /></p>
		  <p><strong>How is the  workflow managed?</strong><input type="facility" name="workflow" id="workflow"   value="" /></p>
</div>
       </td>
       </tr>
        <tr>
        <th>
		<h3>Section 5.3</h3>
        </th>
         <tr>
        <td>
		<div>
	    <p><strong>What  is the average turn around time from sample collection to results being  returned to clinic or patients?</strong><input type="text" name="averageturnaround" id="averageturnaround"   value="" /></p>
	    <p><strong>Results  returned within the facility to TB Clinic? </strong><input type="text" name="resultreturn" id="resultreturn"   value="" /></p>
	    <p><strong>Results  returned to referring facilities?</strong><input type="text" name="resultback" id="resultback"   value="" /></p>
			
		</div>
        </td>
       </tr>
         <tr>
        <th>
        
		<h3>Section 5.4</h3>
        </th>
         <tr>
        <td>
		<div>
		  <p><strong>What  is the standard format used to relay results to clinicians?</strong>
          <select name="format" id="format"  >
      <option value="0">Select One</option>
      <option value="hard copy (replicate of request form)"> hard copy (replicate of request form)</option>
      <option value="hardcopy (GeneXpert printout)">hardcopy (GeneXpert printout)</option>
      <option value="email">email</option>
     		
    </select></p>
		</div>
        </td>
        </tr>
         <tr>
        <th>
        <h3>Section 5.5</h3>
        </th>
        </tr>
         <tr>
        <td>
		<div>
		  <p><strong>Does the facility  still use sputum microscopy for TB detection?<select name="microscopy" id="microscopy"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select></strong></p>
		  <p><strong> If yes, please specify under  which cases microscopy is carried out</strong> <select name="ptype" id="ptype"  selected='selected'>
      <option value="0">Type of Patient</option>
      <?php
do { 
?>
      <option value="<?php echo $row_rstype_of_patient['type']?>"><?php echo $row_rstype_of_patient['type']; ?></option>
      <?php
} while ($row_rstype_of_patient = mysql_fetch_assoc($rstype_of_patient));
  $rows = mysql_num_rows($rstype_of_patient);
  if($rows > 0) {
      mysql_data_seek($rstype_of_patient, 0);
	  $row_rstype_of_patient = mysql_fetch_assoc($rstype_of_patient);
  }
?>
    </select></p>
        </div>
</td>
</tr>
        <tr>
        <th>
        <h3>Section 5.6</h3>
        </th>
         <tr>
        <td>
		<div>
		  <p><strong>Are  RIF resistance cases referred to the NTRL for DST </strong>(1-09-2012-30-08-2013)<strong>? </strong><select name="rif" id="rif"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select></p>
		  <p><strong>If yes, how many samples have been referred to NTRL?</strong><input type="text" name="sampleNO" id="sampleNO" /></p>
		</div>
        </td>
        </tr>
         <tr>
        <th>
        <h3>Section 5.7</h3>
        </th>
        </tr>
         <tr>
        <td>
		<div>
		  <p><strong>How are results from NTRL recorded in the facility? </strong><select name="recorded" id="recorded"  >
      <option value="0">Select One</option>
      <option value="Using a folder"> Using a folder</option>
      <option value="Using a referral lab register">Using a referral lab register	</option>
       <option value="using LIMS">using LIMS	</option>
     		
    </select></p>
		</div>
           </td>
           </tr>
           <tr>
           <div id="submit" align="center" >
            <input type="submit" name="submitsection5" id="submitsection5" value="Save & Continue"  class="button">
            </div>
         
            </tr>
              
            </table>
            </form>
             </div >
          
                           
         <div id="fragment-6">
         <form name="save6" method="post">
          <table border='0' class='data-table'>	
          <tr>
          <th>
             <h3>Section 6.1</h3>
           </th> 
           </tr>
           <tr>
          <td> 
		<div>
            <p>
              <label>Facility Name:</label>
              <input type="hidden" name="facility" id="facility" value="<?php echo $row_rsfacSEC[0]; ?>" /><input type="text" name="facilityN" id="facilityN" width="40px" value="<?php echo $row_rsfacSEC[1]; ?>" disabled/>
            </p>
            <p><strong>Who is  responsible for supplying GeneXpert reagents and commodities to the facility?</strong>
              <select name="responsible" id="responsible"  >
                <option value="0">Select One</option>
                <option value="Partner Budget (specify which tests)">Partner Budget (specify which tests)</option>
                <option value="CMS (KEMSA) (specify which tests)">CMS (KEMSA) (specify which tests)</option>
                
              </select>
            </p>
</div>
</td>
</tr>
<tr>
          <th>
		<h3>Section 6.2</h3>
        </th>
        </tr>
        <tr>
          <td>
		<div>
		  <p><strong>How  are lab supplies distributed?</strong><select name="distribution" id="distribution"  >
      <option value="0">Select One</option>
      <option value="Using a folder"> Using a folder</option>
      <option value="Using a referral lab register">Using a referral lab register	</option>
       <option value="using LIMS">using LIMS	</option>
     		
    </select></p>
		</div>
        </td>
        </tr>
        <tr>
          <th>
		<h3>Section 6.3</h3>
        </th>
        </tr>
        <tr>
          <td>
		<div>
	    <p><strong>If pull system, what is the timeframe for these deliveries? Are lab supplies  ordered and delivered in the same timeframe each time? (i.e. quarterly,  monthly)</strong><select name="timeframe" id="timeframe"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select></p>
		</div>
        </td>
        </tr>
        <tr>
          <th>
		<h3>Section 6.4</h3>
        </th>
        </tr>
        <tr>
          <td>
		<div>
		  <p><strong>Is  there a set day when the facility reports on stock commodities?</strong><select name="day" id="day"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select></p> 
          <p><strong>If  yes, where does the facility send the stock commodity management report to?</strong><select name="send" id="send"  >
      <option value="0">Select One</option>
      <option value="Using a folder"> Using a folder</option>
      <option value="Using a referral lab register">Using a referral lab register	</option>
       <option value="using LIMS">using LIMS	</option>
     		
    </select></p>
		</div>
        </td>
        </tr>
        <tr>
          <th>
        <h3>Section 6.5</h3>
        </th>
        </tr>
        <tr>
          <td>
          <div>
	  <p><strong>Is there a contact  officer at the district for the facility to call with issues or queries  regarding stock levels of lab commodities?</strong><select name="contactperson" id="contactperson"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select></p>
		  <p>If yes, specify who
		  	<ul>
          <li>Contact  Name:<input type="text" name="name" id="name" /></li>
		   <li> Contact  Number:<input type="text" name="no" id="no" /></li>
           </ul>
           </p>
        </div>
        </td>
       </tr>
       <tr>
          <th>
        <h3>Section 6.7</h3>
        </th>
        </tr>
        <tr>
          <td>
		<div>
		  <p><strong>How  many emergency GeneXpert kits have been ordered in the last year?</strong><input type="text" name="emergencykits" id="emergencykits" /></p>
		</div>
        </td>
        </tr>
        <tr>
          <th>
        <h3>Section 6.8</h3>
        </th>
        </tr>
        <tr>
          <td>
		<div>
		  <p><strong>How are lab commodities for TB Xpert testing tracked and recorded at this facility?</strong> <input type="text" name="XpertTracking" id="XpertTracking" /></p>
		</div>
        </td>
        </tr>
        <tr>
          <th>
        <h3>Section 6.9</h3>
        </th>
        </tr><tr>
          <td>
		<div>
		  <p><strong>If  there is a system in place to monitor Xpert kits are these updated regularly?  </strong><select name="system" id="system"  >
      <<option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
     		
    </select> </p>
          
          <p><strong>If yes, how often are these systems updated? </strong><input type="text" name="howoften" id="howoften" /></p>
        </div>
        </td>
        </tr>
        <tr>
          <th>
        <h3>Section 6.10</h3>
        </th>
        </tr>
        <tr>
          <td>
		<div>
		  <p><strong>Where are TB Xpert testing Kits stored?</strong><input type="text" name="Kitsstored" id="Kitsstored" /> </p>
          <p><strong>If the kits are stored away from TB lab, how are they managed and dispensed to the lab?</strong><input type="text" name="Managed" id="Managed" /></p>
		</div>
		</td>
        </tr>
                    
            <tr>
             <div id="submit" align="center" >
            <input type="submit" name="submitsection6" id="submitsection6" value="Save & Continue"  class="button">
            </div>
              
        </tr>
              
            </table>
            </form>
          </div>
              
              
              
         </div>
         
     </div>
		</div>
<div class="clearer">&nbsp;</div>

	  
	</div>
</div>
</div>

</body>
</html>
<?php
include("../includes/footer.php");
?>