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
<?php if($userType == "admin") { ?>
<div class="trl-menu">
    <?php if(isset($breadcrumbs)) { ?>
    <?php echo $breadcrumbs; ?>
    <?php }else{ ?>
    <?php echo "No Data"; ?>
    <?php } ?>
</div>
<br class="clear" />
<?php } ?>
<?
	$this->load->view("restaurantportal/top_bar");
?>
<div class="title_bar">
    <h1>Manage Orders</h1>
</div>
<div class="title_bar content">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-12">
            <div id="exTab1" class="">
                <ul class="nav  nav-tabs ul_tab_date">
                    <li class="li_variants_adj nav-item">
                        <a href="<?= base_url() . "restaurantorders/allorder" ?>" class="nav-link padding_li">All
                            Orders</a>
                    </li>
                    <li class="active li_variants_adj nav-item">
                        <a href="<?= base_url() . "restaurantorders/paymentreport" ?>"
                            class="nav-link padding_li">Monthly Statements</a>
                    </li>
                    <li class="li_tab_date date_color"><?= date("l, M dS , Y") ?>&nbsp;<span><?= date("h:i A") ?></span>
                    </li>
                </ul>
                <div class="tab-content clearfix">
                    <div class="tab-pane active" id="1a">
                        <div class="card ">
                            <div class="card-body p-4">
                                <?
									$attributes = array('id' => 'frmsearchorder','name' => 'frmsearchorder');
									echo form_open(base_url().'restaurantorders/paymentreport',$attributes);
								?>
                                <div class="row mb-4">
                                    <div class="col-md-6 col-lg-4 col-xl-4 col-12 dis_flex_desktop margin_btm_orders">
                                        <div class="show_adj_again ">
                                            <input type="hidden" name="order_status" value="Delivered" />
                                            <label class="label_show_adj" for="inlineFormSelectPref">Month: </label>
                                            <select name="month" class="form-select combwd01 statements_select_month"
                                                id="inlineFormSelectPref">
                                                <option value="0">Select Month</option>
                                                <? for ($i=1;$i<13;$i++) { ?>
                                                <option value="<?= $i ?>"
                                                    <?= (isset($filters["month"]) && $filters["month"] == $i) ? 'selected="selected"' : '' ?>>
                                                    <?= date("F", mktime(0, 0, 0, $i, 1, 2010)) ?></option>
                                                <? } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-4 col-12 dis_flex_desktop margin_btm_orders">
                                        <div class="show_adj_again ">
                                            <input type="hidden" name="order_status" value="Delivered" />
                                            <label class="label_show_adj" for="inlineFormSelectPref">Year: </label>
                                            <select name="year" class="form-select combwd01 statements_select_year"
                                                id="inlineFormSelectPref">
                                                <option value="0">Select Year</option>
                                                <? for ($i=date("Y");$i>2009;$i--) { ?>
                                                <option value="<?= $i ?>"
                                                    <?= (isset($filters["year"]) && $filters["year"] == $i) ? 'selected="selected"' : '' ?>>
                                                    <?= $i ?></option>
                                                <? } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xl-4 col-12">
                                        <button type="submit"
                                            class="btn margin_top_stng icon_btn_adj statements_search_button "><span>Search</span></button>
                                    </div>

                                </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Month</th>
                                                <th>Total No. Of Orders</th>
                                                <th>Total Amount</th>
                                                <th>Total City Tax</th>
                                                <th>Total State Tax</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($list) && count($list) > 0 ) { ?>
                                            <?php foreach ($list as $row) { ?>
                                            <tr style="cursor:pointer">
                                                <td>
                                                    <a href="javascript:void(null);" class="link01"
                                                        onclick="getMonthReport();"><?= date("F Y", strtotime($row["start"])) ?></a>
                                                </td>
                                                <td>
                                                    <?= $row["total_order"] ?>
                                                </td>
                                                <? $english_format_number = number_format($row["total_amount"], 2, '.', '');?>
                                                <td>
                                                    <span>₦ <?= $english_format_number ?></span>
                                                </td>
                                                <? $english_format_number = number_format($row["total_city_tax"], 2, '.', '');?>
                                                <td>
                                                    <span>₦ <?= $english_format_number ?></span>
                                                </td>
                                                <? $english_format_number = number_format($row["total_state_tax"], 2, '.', '');?>
                                                <td>
                                                    <span>₦ <?= $english_format_number ?></span>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php } else { ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    Sorry! No payment history found.
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="show_rows_adj">
                                    <ul class="pagination"><?php //echo $paginationLinks; ?></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start Mid Right -->

</div>

<!-- End Mid Right -->
<?
   $this->load->view("restaurantportal/footer_view");
?>