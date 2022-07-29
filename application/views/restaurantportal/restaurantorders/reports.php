<?
if($userType == "admin")
	$this->load->view( 'admin/header_view');
else
{	
$this->load->view("restaurantportal/header_view");
$this->load->view("restaurantportal/sidepanel_view");
}
?>

<script language="javascript">
	var base_url = '<?= base_url() ?>';

	function exportToCsv() {
		$("#export").val("Yes");
		document.frmsearchorder.submit();
	}

	function getMonthReport(nMonth, nYear, nEnd) {
		$("#month").val(nMonth);
		$("#year").val(nYear);
		$("#end_date").val(nEnd);

		document.frmreportorder.submit();
	}
</script>

<!-- Start Dialog Popups -->
<script language="javascript">
	function editMonth(nItemId, nStatus, nPaid) {
		editMonth = nItemId;
		itemId = nItemId;
		paid_to = nPaid;
		status = nStatus;
		document.getElementById('paid_to').value = paid_to;
		if (status == 'Pending') {
			document.getElementById('status').selectedIndex = 0;
		} else if (status == 'In Process') {
			document.getElementById('status').selectedIndex = 1;
		} else {

			document.getElementById('status').selectedIndex = 2;
		}
		document.getElementById('paid_to').value = paid_to;
		$('#edit_month').dialog('open');
		return false;
	}
</script>
<script type="text/javascript">
	$(function() {
		// Dialog	( Start Edit Variant Popup Window Here )
		$('#edit_month').dialog({
			autoOpen: false,
			modal: true,
			width: 300,

			buttons: {
				"Save": function() {
					//$(this).dialog("close"); 
					var paid = $("#paid_to").val();
					var id_list = itemId;
					var status = $("#status").val();
					//$("#variant").val(Variant);
					$.ajax({
						type: "POST",
						url: base_url + "restaurantorders/addPaidToRestaurant/",
						data: "varia=" + paid + "&idlist=" + id_list + "&status=" + status,
						success: function(response) {
							if (response == 'RECORD_ADDED') {
								document.location.href = document.location.href;
							} else {
								alert(response);
							}



						}

					});

				},
				"Cancel": function() {
					$('#edit_month').dialog("close");
					document.location.href = document.location.href;
					//document.getElementById("edit_month").style.display	=	"none";
				}
			}
		});

	});
</script>
<!-- End Dialog Popups -->
<?
if($userType == "admin")
{
?>
<div class="trl-menu">
	<? 
	if(isset($breadcrumbs))
	{
			echo $breadcrumbs;
	}else{
		echo "No Data";
	}
	?>

</div>
<br class="clear" />
<?
}
//print_r($list);
?>


<!-- Start Add New Variant Category Window Here -->
<div id="edit_month" title="Edit Month" style="display:none;">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td style="padding-bottom: 10px; width: 596px; font-size:12px; padding-top:10px;" colspan="2">
				Paid to Restaurant
			</td>
		</tr>
		<tr>
			<td>
				<input type="text" name="paid_to" id="paid_to" value="" style="width:200px; padding:3px;" class="txt-field01">
				<input type="hidden" value="" name="listid" id="listid">
			</td>
		</tr>
		<tr>
			<td style="padding-bottom: 10px; width: 596px; font-size:12px; padding-top:10px;" colspan="2">
				Status
			</td>
		</tr>
		<tr>
			<td>
				<select name="status" id="status" class="combwd01" style="width:200px;">
					<option value="Pending">Pending</option>
					<option value="In Process">In Process</option>
					<option value="Paid">Paid</option>
				</select>

			</td>
		</tr>
		<!--      <td>
        	<a onclick="document.categoryform.submit();" class="global-link" title="Add" href="javascript:void(null);">
            	<span>Add</span>
            </a>
        </td> -->

	</table>
</div>
<!-- End Add New Variant Category Window Here -->

<div class="title_bar">
	<h1>Manage Orders</h1>
</div>
<div class="mid-right">
	<br class="clear">
	<br>
	<br>
	<!--            <a href="<?= base_url() . "restaurantorders/allorder/history" ?>" <?= ($activetab == "ordernew") ? 'class="creat-active"' : 'class="creat-ctgry"' ?>>Order History </a>-->

	<?
if($userType != "admin")
{	
?> <a href="<?= base_url() . "restaurantorders/allorder" ?>" <?= ($activetab == "allorder") ? 'class="creat-active"' : 'class="creat-ctgry"' ?>>All Orders </a>
	<?
}
?>

	<a href="<?= base_url() . "restaurantorders/paymentreport" ?>" <?= ($activetab == "orderreport") ? 'class="creat-active"' : 'class="creat-ctgry"' ?>>Monthly Statements </a>
	<div class="date-time"><strong><?= date("l, M dS , Y") ?>&nbsp;<span><?= date("h:i A") ?></span></strong></div>
	<br class="clear">
	<div class="variant-wrap">
		<div style="padding-top: 20px;" class="itemdrop-list">
			<script type="text/javascript">
				$(function() {

					// Datepicker
					$('#start_date').datepicker({
						inline: true
					});
					// Datepicker
					$('#end_date').datepicker({
						inline: true
					});


				});
			</script>
			<?
					$attributes = array('id' => 'frmreportorder','name' => 'frmreportorder');
					echo form_open(base_url().'restaurantorders/allorder/history',$attributes);
					?>
			<input type="hidden" name="month" id="month" />
			<input type="hidden" name="year" id="year" />
			<input type="hidden" name="end_date" id="end_date" />
			</form>

			<?
					//	$attributes	=	array("id"=>"frmAddItem","name"=>"frmAddItem")
					$attributes = array('id' => 'frmsearchorder','name' => 'frmsearchorder');
					echo form_open(base_url().'restaurantorders/paymentreport',$attributes);
					?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td style="padding-right:10px;">Months:</td>
					<td style="padding-right:20px;">
						<input type="hidden" name="order_status" value="Delivered" />
						<span style="width:29%;">
							<?
							$date	=	"";
                            if (!empty($filters["start_date"]))
								$date	=	date("m/d/Y",strtotime($filters["start_date"]));
							?>
							<select name="month" class="combwd01" style="width:120px;">
								<option value="0">Select Month</option>
								<?
                            for ($i=1;$i<13;$i++)
							{
							?>
								<option value="<?= $i ?>" <?= (isset($filters["month"]) && $filters["month"] == $i) ? 'selected="selected"' : '' ?>><?= date("F", mktime(0, 0, 0, $i, 1, 2010)) ?></option>
								<?
                            }
							?>
							</select>
						</span>
					</td>
					<td style="padding-right:10px;">End Date:</td>
					<td>
						<select name="year" class="combwd01" style="width:120px;">
							<option value="0">Select Year</option>
							<?
                            for ($i=date("Y");$i>2009;$i--)
							{
							?>
							<option value="<?= $i ?>" <?= (isset($filters["year"]) && $filters["year"] == $i) ? 'selected="selected"' : '' ?>><?= $i ?></option>
							<?
                            }
							?>
						</select>
						<input type="hidden" name="export" id="export" />
					</td>
					<td>
						<a href="javascript:void(null);" onclick="document.frmsearchorder.submit();" class="global-link" style="float:right;"><span>Search</span></a>
						<a href="javascript:void(null);" onclick="exportToCsv();" class="global-link" style="float:right; margin-right:10px;">
							<span>Export To CSV</span></a>
					</td>
				</tr>
			</table>
			</form>

		</div>
		<?
			//	print_r($list);
				?>
		<div class="table-responsive">
			<table class="table">
				<tbody>
					<tr>
						<td width="31%">Month</td>
						<td width="32%" align="center">Total No. Of Orders</td>
						<td width="11%" align="center">Total Amount</td>
						<td width="15%" align="center">Waive Inc Fee</td>
						<td width="25%" align="center">Net Payable to Restaurant</td>
						<td width="3%" align="right">Status</td>
						<td width="25%" align="center">Paid To Restaurant</td>
					</tr>
					<?
                      foreach ($list as $row)
					  {
						$payable	=	$row["total"]-$row["comission"];
					  ?>
					<tr class="ctgry-rowbg02">
						<td class="order">
							<a href="javascript:void(null);" class="link01" onclick="getMonthReport(<?= date("m", strtotime($row["start"])) ?>,<?= date("Y", strtotime($row["start"])) ?>,'<?= date("Y-m-d H:i:s", strtotime($row["end"])) ?>');"><?= date("F Y", strtotime($row["start"])) ?></a>

							<?
				   if($userType == "admin")
					{
					?>

							<a href="javascript:void(null);" onclick="editMonth(<?= $row["id"] ?>,'<?= $row["status"] ?>',<?= $row["paid_to_restaurant"] ?>);" class="link01" style="padding-left:10px; color:#1779D4;">(Edit)</a>
							<?
					}
					?>
						</td>
						<td align="center"><?= $row["order_count"] ?></td>
						<? $english_format_number = number_format($row["total"], 2, '.', '');?>
						<td align="center"><span>₦<?= $english_format_number ?></span></td>
						<? $english_format_number = number_format($row["comission"], 2, '.', '');?>
						<td align="center"><span>₦<?= $english_format_number ?></span></td>
						<? $english_format_number = number_format($payable, 2, '.', '');?>
						<td align="center"><span><?= $english_format_number ?></span></td>
						<? // $english_format_number = number_format($row["status"], 2, '.', '');?>
						<td align="right"><span><?= $row["status"] ?></span></td>
						<td align="right"><span><?= $row["paid_to_restaurant"] ?></span></td>
					</tr>
					<tr>
						<td class="td-height" colspan="6"></td>
					</tr>
					<?
                      }
					  ?>

					<tr>
						<td class="td-height" colspan="6"></td>
					</tr>

					<tr>
						<td class="td-height" colspan="6"></td>
					</tr>
				</tbody>
			</table>
		</div>
		<!--              	<div class="status-bar">
                	<span class="rejected">Rejected</span>
                	<span class="delivered01">Delivered</span>
                	<span class="underprocess">Pending</span>
                	<span class="newest">Newest</span>
                </div>
                -->
		<br class="clear">
		<div class="paging">
			<?= isset($paginationLinks) ? $paginationLinks : "" ?>
		</div>

	</div>
</div>
<?
   $this->load->view("restaurantportal/footer_view");
   ?>
