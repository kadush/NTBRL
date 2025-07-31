<?php
require_once('../connection/db.php');
include('Asidebar.php');
error_reporting(0);

$query_rsUser = "SELECT user.id as id, user.name as nm,user.facility as fac,user.username as un, user.st as ac, usergroup.groupName as gp FROM user,usergroup WHERE  user.category=usergroup.usergroupID ORDER BY user.id asc";
$rsUser = mysqli_query($dbConn, $query_rsUser) or die(mysqli_error($dbConn)());
$row_rsUser = mysqli_fetch_assoc($rsUser);
$totalRows_rsUser = mysqli_num_rows($rsUser);

$query_rsUsergroup = "SELECT * FROM usergroup ORDER BY usergroup.usergroupID ";
$rsUsergroup = mysqli_query($dbConn, $query_rsUsergroup) or die(mysqli_error($dbConn)());
$row_rsUsergroup = mysqli_fetch_assoc($rsUsergroup);
$totalRows_rsUsergroup = mysqli_num_rows($rsUsergroup);

$query_rsfacilitys = "SELECT mfl, facility FROM facility_map where genesite=1 or truenat=1 ORDER BY facility ";
$rsfacilitys = mysqli_query($dbConn, $query_rsfacilitys) or die(mysqli_error($dbConn)());
$row_rsfacilitys = mysqli_fetch_assoc($rsfacilitys);
$totalRows_rsfacilitys = mysqli_num_rows($rsfacilitys);


$query_rsCounty = "SELECT Distinct county FROM facility_map ORDER BY county ";
$rsCounty = mysqli_query($dbConn, $query_rsCounty) or die(mysqli_error($dbConn)());
$row_rsCounty = mysqli_fetch_assoc($rsCounty);
$totalRows_rsCounty = mysqli_num_rows($rsCounty);

$query_rspartner = "SELECT partnercode, partnername FROM partners ORDER BY partnername";
$rspartner = mysqli_query($dbConn, $query_rspartner) or die(mysqli_error($dbConn)());
$row_rspartner = mysqli_fetch_assoc($rspartner);
$totalRows_rspartner = mysqli_num_rows($rspartner);
?>


<?php

if (isset($_POST["btnsave"])) {

	$newpassword = md5($_POST['password']);
	$repeatnewpassword = md5($_POST['password1']);
	if ($newpassword == $repeatnewpassword) {

		$partner = $_POST['partner'];
		$fac = $_POST['facilityArr'];

		if ($partner == "") {
		} else {

			$sqlq = "UPDATE facilitys SET partner='$partner' where facilitycode IN ($fac)";

			$retvalq = mysqli_query($dbConn, $sqlq);
			//exit;	
		}

		$fname = mysqli_real_escape_string($dbConn, $_POST['fname']);
		$name = mysqli_real_escape_string($dbConn, $_POST['name']);
		
		$sql = "INSERT INTO user (name, category, mfl, facility, email, mobile, partnerid, districtid, username, password, st)
			VALUES('$name',
			'$_POST[category]',
			'$_POST[mfl]',
			'$fname',
			'$_POST[email]',
			'$_POST[no]',
			'$_POST[partner]',
			'$_POST[district]',
			'$_POST[username]',
			'$newpassword',1)";

		$retval = mysqli_query($dbConn, $sql);
		if (!$retval) {
			$errormsg = "Could not enter data.Try Again";
		} else {
			$suceessmsg = 'User successfully added';
			@header("Location:userlog.php");
		}
	} else {
		$errormsg = "Passwords do not match";
	}
}
?>
<script type="text/javascript" language="javascript" src="../jquery-ui-1.10.3/demos/DataTables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../jquery-ui-1.10.3/demos/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
	/* Formating function for row details */


	$(document).ready(function() {


		function fnFormatDetails(oTable, nTr) {
			var aData = oTable.fnGetData(nTr);
			var res = '';
			//location.href = '#?id='+aData[1];
			$.ajax({
				type: "POST",
				url: "../ajax_data/user.php",
				data: "id=" + aData[1],
				async: true,
				cache: false,
				success: function(data) {
					res = data;
					oTable.fnOpen(nTr, res, 'r');

				}

			});
			return res;

		}

		/*
		 * Insert a 'details' column to the table
		 */
		var nCloneTh = document.createElement('th');
		var nCloneTd = document.createElement('td');
		nCloneTd.innerHTML = '<img src="../jquery-ui-1.10.3/demos/DataTables/examples/examples_support/details_open.png">';
		nCloneTd.className = "center";

		$('#example thead tr').each(function() {
			this.insertBefore(nCloneTh, this.childNodes[0]);
		});

		$('#example tbody tr').each(function() {
			this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
		});

		/*
		 * Initialse DataTables, with no sorting on the 'details' column
		 */
		var oTable = $('#example').dataTable({
			"bJQueryUI": true,
			"aoColumnDefs": [{
				"bSortable": false,
				"aTargets": [0]
			}],
			"aaSorting": [
				[1, 'asc']
			]
		});

		/* Add event listener for opening and closing details
		 * Note that the indicator for showing which row is open is not controlled by DataTables,
		 * rather it is done here
		 */
		$('#example tbody td img').live('click', function() {
			var nTr = $(this).parents('tr')[0];
			if (oTable.fnIsOpen(nTr)) {
				/* This row is already open - close it */
				this.src = "../jquery-ui-1.10.3/demos/DataTables/examples/examples_support/details_open.png";
				oTable.fnClose(nTr);
			} else {
				/* Open this row */
				this.src = "../jquery-ui-1.10.3/demos/DataTables/examples/examples_support/details_close.png";
				oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
			}
		});
	});
</script>


<div class="main-content" style="margin-top: -1%">

	<?php include("Aheader.php"); ?>



	<hr />


	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$("#table-1").dataTable({
				"sPaginationType": "bootstrap",
				"aLengthMenu": [
					[10, 25, 50, -1],
					[10, 25, 50, "All"]
				],
				"bStateSave": true
			});

			$(".dataTables_wrapper select").select2({
				minimumResultsForSearch: -1
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function() {

			$("#facility").change(function() {
				$('#fname').val($('option:selected', $(this)).text());
				$('#mfl').val($(this).val());
				//$('#name').val($('option:selected', $(this)).text());

			});
		});
	</script>

	<div class="col-md-6" style="width: auto;">

		<ul class="nav nav-tabs bordered">
			<!-- available classes "bordered", "right-aligned" -->
			<li class="active"><a href="#home" data-toggle="tab">View Users</a></li>
			<li><a href="#profile" data-toggle="tab">Add User</a></li>

		</ul>

		<div class="tab-content" style="width: auto">
			<div class="tab-pane active" id="home" style="width: 950px">
				<table class="table table-bordered" id="example">
					<thead>
						<tr>

							<th>User ID </th>
							<th>Full Name</th>
							<th>Facility</th>
							<th>User Name</th>
							<th>User Category</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php do {
							if ($row_rsUser['ac'] == 1) {
								$row_rsUser['ac'] = '<div class="label label-success">Active</div>';
							} else if ($row_rsUser['ac'] == 0) {
								$row_rsUser['ac'] = '<div class="label label-warning">Disabled</div>';
							}     ?>
							<tr>

								<td><?php echo $row_rsUser['id']; ?></td>
								<td><?php echo $row_rsUser['nm']; ?></td>
								<td><?php echo $row_rsUser['fac']; ?></td>
								<td><?php echo $row_rsUser['un']; ?></td>
								<td><?php echo $row_rsUser['gp']; ?></td>
								<td><?php echo $row_rsUser['ac']; ?></td>
								<td>
									<?php if ($row_rsUser[4] == 1) {
										echo '<a href="activation.php?id=' . $row_rsUser['id'] . '&st=' . $row_rsUser[4] . '"><button class="btn btn-gold" id="deact" type="button" title="Deactivate Account"><i class="entypo-cancel"></i></button></a>';
									} else if ($row_rsUser[4] == 0) {
										echo '<a href="activation.php?id=' . $row_rsUser['id'] . '&st=' . $row_rsUser[4] . '"><button class="btn btn-green" id="act" type="button" title="Activate Account"><i class="entypo-check"></i></button></a>';
									}     ?>
									<a href="deleteUser.php?id=<?php echo $row_rsUser['id']; ?>"><button class="btn btn-red" type="button" title="Delete User/Account"><i class="entypo-trash"></i></button></a>

									<a href="resetUser.php?id=<?php echo $row_rsUser['id']; ?>"><button class="btn btn-blue" type="button" title="Reset User/Account"><i class="entypo-pencil"></i></button></a>
								</td>
							</tr>
						<?php } while ($row_rsUser = mysqli_fetch_array($rsUser)); ?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane" id="profile" style="width: 700px">
				<?php if ($errormsg != "") {
				?>
					<div class="alert alert-danger" style="text-align: center;width: 250px;"><?php

																								echo  $errormsg;

																								?><a href="userlog.php" data-rel="close" style="float: right;"><i class="entypo-cancel"></i></a></div>
				<?php } ?>
				<?php if ($suceessmsg != "") {
				?>
					<div class="alert alert-success" style="text-align: center;width: 250px;"><?php

																								echo   $suceessmsg;

																								?><a href="userlog.php" data-rel="close" style="float: right;"><i class="entypo-cancel"></i></a></div>
				<?php } ?>
				<form name="save" method="post">
					<table class="table table-striped" style="width: 700px;">

						<tr>
							<th style="text-align: center;">
								<font size="1.4">Name</font>
							</th>
							<td style="text-align: center;"><input type="text" class="form-control" name="name" id="name" size="30" required autocomplete="off" /> </td>
							<th style="text-align: center;">
								<font size="1.4">Category</font>
							</th>
							<td style="text-align: center;">
								<select name="category" id="category" class="form-control" required>
									<option value="">Select Usergroup</option>
									<?php
									do {
									?>
										<option value="<?php echo $row_rsUsergroup['usergroupID'] ?>"><?php echo $row_rsUsergroup['groupName']; ?></option>
									<?php
									} while ($row_rsUsergroup = mysqli_fetch_assoc($rsUsergroup));
									$rows = mysqli_num_rows($rsUsergroup);
									if ($rows > 0) {
										mysqli_data_seek($rsUsergroup, 0);
										$row_rsUsergroup = mysqli_fetch_assoc($rsUsergroup);
									}
									?>
								</select>

								<input type="hidden" name="fname" id="fname" />
								<input type="hidden" name="mfl" id="mfl" />
							</td>
						</tr>
						<tr>
							<th colspan='4'>&nbsp;</th>
						</tr>
						<tr>
							<th style="text-align: center;">
								<font size="1.4">Facility</font>
							</th>

							<td style="text-align:center;">
								<div id="fac">
									<select name="facility" id="facility" class="select2" data-allow-clear="true" data-placeholder="Select One Facility">
										<option></option>
										<optgroup label="National Facilities">
											<?php
											do {
											?>
												<option value="<?php echo $row_rsfacilitys['mfl'] ?>"><?php echo $row_rsfacilitys['facility']; ?></option>
											<?php
											} while ($row_rsfacilitys = mysqli_fetch_assoc($rsfacilitys));
											$rows = mysqli_num_rows($rsfacilitys);
											if ($rows > 0) {
												mysqli_data_seek($rsfacilitys, 0);
												$row_rsfacilitys = mysqli_fetch_assoc($rsfacilitys);
											}
											?>
										</optgroup>
									</select>
								</div>

								<div id="fac2">
									<select name="facilityp" id="facilityp" class="select2" data-allow-clear="true" multiple data-placeholder="Select One Facility">
										<option></option>
										<optgroup label="National Facilities">
											<?php
											do {
											?>
												<option value="<?php echo $row_rsfacilitys['mfl'] ?>"><?php echo $row_rsfacilitys['facility']; ?></option>
											<?php
											} while ($row_rsfacilitys = mysqli_fetch_assoc($rsfacilitys));
											$rows = mysqli_num_rows($rsfacilitys);
											if ($rows > 0) {
												mysqli_data_seek($rsfacilitys, 0);
												$row_rsfacilitys = mysqli_fetch_assoc($rsfacilitys);
											}
											?>
										</optgroup>
									</select>
									<input type="hidden" id="facilityArr" name="facilityArr" />
								</div>
							</td>
							<th style="text-align: center;">
								<font size="1.4">Partner</font>
							</th>

							<td style="text-align:center;">
								<div id="par">
									<select class="select2" name="partner" id="partner" data-allow-clear="true" data-placeholder="Select One Partner">
										<option></option>
										<optgroup label="All Partners">
											<option value="0"></option>
											<?php
											do {
											?>
												<option value="<?php echo $row_rspartner['partnercode'] ?>"><?php echo $row_rspartner['partnername']; ?></option>
											<?php
											} while ($row_rspartner = mysqli_fetch_assoc($rspartner));
											$rows = mysqli_num_rows($rspartner);
											if ($rows > 0) {
												mysqli_data_seek($rspartner, 0);
												$row_rspartner = mysqli_fetch_assoc($rspartner);
											}
											?>
										</optgroup>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<th colspan='4'>&nbsp;</th>
						</tr>
						<tr>
							<th style="text-align: center;">
								<font size="1.4">County</font>
							</th>

							<td style="text-align:center;">
								<div id="cou">
									<select class="select2" name="county" id="county" data-allow-clear="true" data-placeholder="Select One County">
										<option></option>
										<optgroup label="All counties">
											<?php
											do {
											?>
												<option value="<?php echo $row_rsCounty['county'] ?>"><?php echo $row_rsCounty['county']; ?></option>
											<?php
											} while ($row_rsCounty = mysqli_fetch_assoc($rsCounty));
											$rows = mysqli_num_rows($rsCounty);
											if ($rows > 0) {
												mysqli_data_seek($rsCounty, 0);
												$row_rsCounty = mysqli_fetch_assoc($rsCounty);
											}
											?>
										</optgroup>
									</select>
								</div>
							</td>
							<th style="text-align: center;">
								<font size="1.4">Sub County</font>
							</th>

							<td style="text-align:center;">
								<div name="district" id="district"> </div>
							</td>

						</tr>

						<div class="clear"></div>
						<br>
						<tr>
							<th colspan='4'>&nbsp;</th>
						</tr>
						<tr>
							<th style="text-align: center;" colspan='1'>
								<font size="1.4">Email:
							</th>
							<td><input type="text" class="form-control" id="email" name="email" data-validate="email" required autocomplete="off" /></td>
							<th style="text-align: center;" colspan='1'>
								<font size="1.4">Mobile No:
							</th>
							<td><input type="text" name="no" id="no" class="form-control" required autocomplete="off" /></td>
						</tr>
						<tr>
							<th colspan='4'>&nbsp;</th>
						</tr>
						<tr>
							<th style="text-align: center;" colspan='1'>
								<font size="1.4">Username</font>
							</th>
							<td style="text-align: left;" colspan='3'><input type="text" class="form-control" name="username" id="username" size="25" required autocomplete="off" /></td>
						</tr>
						<tr>
							<th colspan='4'>&nbsp;</th>
						</tr>
						<tr>
							<th style="text-align: center;">
								<font size="1.4">Password</font>
							</th>
							<td style="text-align: center;"><input type="password" class="form-control" name="password" id="password" required /></td>

							<th style="text-align: center;">
								<font size="1.4">Repeat Password </font>
							</th>
							<td style="text-align: center;"><input type="password" class="form-control" name="password1" id="password1" a required /></td>
						</tr>
						<tr>
							<th colspan='4'>&nbsp;</th>
						</tr>
						<tr>

							<td colspan="4">
								<div align="center">
									<button class="btn btn-success btn-icon icon-left" type="submit" name="btnsave">Add User<i class="entypo-user-add"></i></button>
									<input type="reset" name="button2" id="button2" value="Reset" class="btn btn-default" />
								</div>
							</td>
						</tr>
					</table>
					<input type="hidden" name="MM_insert" value="save" />
				</form>

			</div>

		</div>


	</div>
	<script type="text/javascript">
		jQuery(window).load(function() {
			$('#fac').hide();
			$('#fac2').hide();
			$('#par').hide();
			$('#cou').hide();
			$('#district').hide();
			$("#table-2").dataTable({
				"sPaginationType": "bootstrap",
				"sDom": "t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
				"bStateSave": false,
				"iDisplayLength": 8,
				"aoColumns": [{
						"bSortable": false
					},
					null,
					null,
					null,
					null
				]
			});

			$(".dataTables_wrapper select").select2({
				minimumResultsForSearch: -1
			});

			// Highlighted rows
			$("#table-2 tbody input[type=checkbox]").each(function(i, el) {
				var $this = $(el),
					$p = $this.closest('tr');

				$(el).on('change', function() {
					var is_checked = $this.is(':checked');

					$p[is_checked ? 'addClass' : 'removeClass']('highlight');
				});
			});

			// Replace Checboxes
			$(".pagination a").click(function(ev) {
				replaceCheckboxes();
			});
		});

		// Sample Function to add new row
		var giCount = 1;

		function fnClickAddRow() {
			$('#table-2').dataTable().fnAddData(['<div class="checkbox checkbox-replace"><input type="checkbox" /></div>', giCount + ".2", giCount + ".3", giCount + ".4", giCount + ".5"]);

			replaceCheckboxes(); // because there is checkbox, replace it

			giCount++;
		}
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#facilityp').change(function() {
				var facility = $(this).val();
				//alert(arr1);
				document.getElementById("facilityArr").value = facility;
			})
		});
	</script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$("#category").change(function() {

				if ($("#category option:selected").val() == 1) {

					$('#fac').hide();
					$('#fac2').hide();
					$('#par').hide();
					$('#cou').hide();
					$('#district').hide();

				} else if ($("#category option:selected").val() == 3) {

					$('#fac').show();
					$('#fac2').hide();
					$('#par').hide();
					$('#cou').hide();
					$('#district').hide();
				} else if ($("#category option:selected").val() == 4) {

					$('#fac').hide();
					$('#fac2').hide();
					$('#par').hide();
					$('#cou').hide();
					$('#district').hide();
				} else if ($("#category option:selected").val() == 5 || $("#category option:selected").val() == 11 || $("#category option:selected").val() == 13) {

					$('#fac').show();
					$('#fac2').hide();
					$('#par').hide();
					$('#cou').hide();
					$('#district').hide();
				} else if ($("#category option:selected").val() == 6) {

					$('#fac').hide();
					$('#fac2').hide();
					$('#par').hide();
					$('#cou').hide();
					$('#district').hide();
				} else if ($("#category option:selected").val() == 7) {
					$('#fac').hide();
					$('#fac2').hide();
					$('#par').show();
					$('#cou').hide();
					$('#district').hide();

				} else if ($("#category option:selected").val() == 8) {
					$('#fac').hide();
					$('#fac2').show();
					$('#par').show();
					$('#cou').hide();
					$('#district').hide();

				} else if ($("#category option:selected").val() == 9 || $("#category option:selected").val() == 12) {

					$('#fac').hide();
					$('#fac2').hide();
					$('#par').hide();
					$('#cou').show();
					$('#district').hide();
				} else if ($("#category option:selected").val() == '') {

					$('#fac').hide();
					$('#fac2').hide();
					$('#par').hide();
					$('#cou').hide();
					$('#district').hide();
				}

			});

			$("#county").change(function() {

				if ($("#county option:selected").val() == '') {
					$('#district').hide();
				} else {
					$('#district').show();
					var cid = $("#county option:selected").val();
					//alert(cid);

				}


				$.post("ajax_all.php", {
						d: cid
					},
					function(data) {
						//alert(data);
						$('#district').html(data);
					});

			});
		});
		//return data; 
	</script>

</div>
</div>


<link rel="stylesheet" href="neon/neon-x/assets/js/select2/select2-bootstrap.css" id="style-resource-1">
<link rel="stylesheet" href="neon/neon-x/assets/js/select2/select2.css" id="style-resource-2">

<script src="neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
<script src="neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
<script src="neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
<script src="neon/neon-x/assets/js/joinable.js" id="script-resource-4"></script>
<script src="neon/neon-x/assets/js/resizeable.js" id="script-resource-5"></script>
<script src="neon/neon-x/assets/js/neon-api.js" id="script-resource-6"></script>
<script src="neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
<script src="neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
<script src="neon/neon-x/assets/js/select2/select2.min.js" id="script-resource-9"></script>
<script src="neon/neon-x/assets/js/toastr.js" id="script-resource-7"></script>
<script src="../jquery-ui-1.10.3/ui/jquery.ui.dialog.js"></script>
<script src="neon/neon-x/assets/js/neon-chat.js" id="script-resource-10"></script>
<script src="neon/neon-x/assets/js/neon-custom.js" id="script-resource-11"></script>
<script src="neon/neon-x/assets/js/neon-demo.js" id="script-resource-12"></script>

</body>

</html>