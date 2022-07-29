<?
   $this->load->view("restaurantportal/header_view");
   $history = false;
   //    $this->load->view("restaurantportal/sidepanel_view");
   ?>
<script language="javascript">
var path = '<?= base_url(); ?>';
</script>
<!--................. Start Orders Drop Menu ..............-->
<script src="<?= base_url() ?>js/drop-menu.js" type="text/javascript"></script>
<!--................. End Orders Drop Menu ..............-->
<script>
$(function() {
    $("#accordion").accordion({
        collapsible: true,
        hide: true,
        active: false
    });
    $("#accordion1").accordion({
        collapsible: true,
        hide: true,
        active: false
    });
});
</script>
<style>
.grid_row .right_sidebar .title_bar.content .card .card-body table tr.order-row:hover .order_code {
    text-decoration: underline;
}

.csIPLoader {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
    width: 100%;
    background: rgba(255, 255, 255, .9);
    z-index: 99;
    text-align: center;
    padding-top: 450px;
    font-size: 50px;
}
</style>
<?php
$this->load->view("restaurantportal/sidepanel_view");
?>
<!-- Start Mid Right -->
<?
$this->load->view("restaurantportal/top_bar");
?>
<div class="title_bar">
    <h1>New Orders</h1>
</div>
<?php if($this->session->flashdata('payment_success')){ ?>
<div class="alert alert-success" role="alert">
    <?php echo $this->session->flashdata('payment_success');?>
</div>
<?php } ?>

<div class="title_bar content">
    <div style="display: none" class="csIPLoader jsIPLoader" data-page="approver"><i class="fad fa-sync fa-spin"></i>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-12">
            <div id="exTab1" class="">
                <?php if($pre_order == "Yes"){ ?>
                <ul class="nav nav-tabs">
                    <li class="<?= empty($_GET['day']) ? 'active' : '' ?> li_variants_adj nav-item">
                        <a href="<?= base_url() . "dashboard" ?>" class="nav-link padding_li">Today's Orders</a>
                    </li>
                    <li
                        class="<?= (isset($_GET['day']) && $_GET['day'] == 'tomorrow') ? 'active' : '' ?> li_variants_adj nav-item">
                        <a href="<?= base_url() . "dashboard?day=tomorrow" ?>" class="nav-link padding_li">Tomorrow's
                            Orders</a>
                    </li>
                    <li
                        class="<?= (isset($_GET['day']) && $_GET['day'] == 'upcoming') ? 'active' : '' ?> li_variants_adj nav-item">
                        <a href="<?= base_url() . "dashboard?day=upcoming" ?>" class="nav-link padding_li">Upcoming
                            Orders</a>
                    </li>
                    <li
                        class="<?= (isset($_GET['day']) && $_GET['day'] == 'past') ? 'active' : '' ?> li_variants_adj nav-item">
                        <a href="<?= base_url() . "dashboard?day=past" ?>" class="nav-link padding_li">Past Orders</a>
                    </li>
                </ul>
                <? } ?>
                <div class="tab-content clearfix">
                    <div class="tab-pane active" id="1a">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table_layout_auto">
                                        <thead>
                                            <tr>
                                                <th>Order Code</th>
                                                <th>Status</th>
                                                <th>Type</th>
                                                <th>Table/Room</th>
                                                <th>Received On</th>
                                                <th>Pre order</th>
                                                <th>Pickup Time</th>
                                                <th>Total</th>
                                                <th>Tax</th>
                                                <th>Payment Type</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <?php
												$nCount	=	$ncounter1;
												if ($total_neworders_count > 0) {
												?>
                                        <tbody id="append_new_order">
                                            <?php
														foreach ($neworders as $order) {
														?>
                                            <tr onclick="openOrderDetails(<?= $order['id'] ?>)" style="cursor:pointer"
                                                class="order-row">
                                                <td class="order_code"><?= $order["order_code"] ?></td>
                                                <td>
                                                    <? if ($order["order_status"]=="Delivered")
																								echo "<img src='".base_url()."images/delivered.png' alt='mark' border='0' title='Completed' />";
																								else if ($order["order_status"]=="Unpaid")
																								echo "<img src='".base_url()."images/newest.png' alt='mark' border='0' title='Unpaid' />";
																								else if ($order["order_status"]=="Pending")
																								echo "<img src='".base_url()."images/under-process.png' alt='mark' border='0' title='Pending'/>";
																								else if ($order["order_status"]=="Rejected")
																								echo "<img src='".base_url()."images/rejected.png' alt='mark' border='0' title='Rejected' />";
																								else if ($order["order_status"]=="Confirmed")
																								echo "<img src='".base_url()."images/delivered.png' alt='mark' border='0' title='Confirmed' />";
																																?>
                                                </td>
                                                <td>
                                                    <?= $order["order_type"] ?>
                                                </td>
                                                <td>
                                                    <?php $table_no = !empty($order["order_table"]) ? $order["order_table"] : "";  ?>
                                                    <?php echo $table_no; ?>
                                                </td>
                                                <td>
                                                    <?= date("m/d/Y", strtotime($order["stamp"])) ?>
                                                    <? echo"<br />";?>
                                                    <?= date("h:i A", strtotime($order["stamp"])) ?>
                                                </td>
                                                <td>
                                                    <?= $order["pre_order"] ?>
                                                </td>
                                                <td>
                                                    <?= date("m/d/Y", strtotime($order["delivery_time"])) ?>
                                                    <? echo"<br />";?>
                                                    <?= date("h:i A", strtotime($order["delivery_time"])) ?>
                                                </td>
                                                <td>
                                                    <? $english_format_number = number_format($order["totalprice"], 2, '.', '');?>
                                                    ₦ <?= $english_format_number ?>
                                                </td>
                                                <td>
                                                    <? $totalTax = $order["city_tax"] + $order["state_tax"]?>
                                                    <? $english_format_number = number_format($totalTax, 2, '.', '');?>
                                                    ₦ <?= $english_format_number ?>
                                                </td>
                                                <td>
                                                    <?= $order["payment_method"] ?>
                                                </td>
                                                <td class="action-td">
                                                    <?
																		if ($order["order_status"]	==	"Confirmed") {
																			?>
                                                    <a style=" background-color: #5dcaca; "
                                                        class="btn margin_top_stng icon_btn_adj mark-delivered"
                                                        href="javascript:void(null);"
                                                        onclick="updateOrderStatus(<?= $order["id"] ?>,'Delivered')"
                                                        class="delivered">Mark Completed</a>
                                                    <? } else { ?>
                                                    <?php echo "Delivered"; ?>
                                                    <? } ?>
                                                </td>
                                            </tr>
                                            <?php $nCount++; ?>
                                            <? } ?>
                                        </tbody>
                                        <?php } else { ?>
                                        <tbody>
                                            <tr>
                                                <td colspan="11">Sorry! No orders found.</td>
                                            </tr>
                                        </tbody>
                                        <?php } ?>

                                    </table>
                                </div>
                                <div class="show_rows_adj">
                                    <ul class="pagination"><?= $paginationLinks ?></ul>
                                </div>
                                <!-- <iframe allowtransparency="true" frameborder="0" width="706" height="492" style="background:0px none;" id="itemIframe" name="itemIframe" src="<?= base_url() ?>restaurantorders/ordersdetail/<?= $order["id"] ?>">
													<noscript>
														Your browser doesn't appear to support frames. Please see the <a href="<?= base_url() ?>restaurantitem/addItem">non-framed version</a> of this page.
													</noscript>
													</iframe> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="orderDetailsModel" tabindex="-1" aria-labelledby="orderDetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderDetailsLabel">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-centre ">
                        <div class="col-12">
                            <iframe style="width: 100%;min-height: 650px;" id="order-details" src=""></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ($history == true) { ?>
<div class="title_bar alternate">
    <h1>Order History</h1>
</div>
<div class="title_bar content no_border">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order Code</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Received On</th>
                            <th>Pickup Time</th>
                            <th>Total</th>
                            <th>Tax</th>
                            <th>W Commission</th>
                            <th>Net Receivable</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
						$nCount	=	$ncounter1;
						if ($total_historyorders_count > 0) {
						?>
                    <tbody>
                        <?php
								foreach ($historyorders as $order) {
								?>
                        <tr>
                            <td><?= $order["order_code"] ?></td>
                            <td>
                                <? if ($order["order_status"]=="Delivered")
		                              echo "<img src='".base_url()."images/delivered.png' alt='mark' border='0' title='Delivered' />";
		                              else if ($order["order_status"]=="Unpaid")
		                              echo "<img src='".base_url()."images/newest.png' alt='mark' border='0' title='Unpaid' />";
		                              else if ($order["order_status"]=="Pending")
		                              echo "<img src='".base_url()."images/under-process.png' alt='mark' border='0' title='Pending'/>";
		                              else if ($order["order_status"]=="Rejected")
		                              echo "<img src='".base_url()."images/rejected.png' alt='mark' border='0' title='Rejected' />";
		                              else if ($order["order_status"]=="Confirmed")
		                              echo "<img src='".base_url()."images/under-process.png' alt='mark' border='0' title='Pending'/>";
		                                               ?>
                            </td>
                            <td>
                                <?= $order["order_type"] ?>
                            </td>
                            <td>
                                <?= date("m/d/Y", strtotime($order["stamp"])) ?>
                                <? echo"<br />";?>
                                <?= date("h:i A", strtotime($order["stamp"])) ?>
                            </td>
                            <td>
                                <?= date("m/d/Y", strtotime($order["delivery_time"])) ?>
                                <? echo"<br />";?>
                                <?= date("h:i A", strtotime($order["delivery_time"])) ?>
                            </td>
                            <td>
                                <? $english_format_number = number_format($order["totalprice"], 2, '.', '');?>
                                ₦<?= $english_format_number ?>
                            </td>
                            <td>
                                <? $totalTax = $order["city_tax"] + $order["state_tax"]?>
                                <? $english_format_number = number_format($totalTax, 2, '.', '');?>
                                ₦<?= $english_format_number ?>
                            </td>
                            <td>
                                <? $net = $order["totalprice"]-$order["tgb_comission"];
		                              //	$net = $net + $totalTax;
		                              	$english_format_number = number_format($net, 2, '.', '');?>
                                ₦<?= $english_format_number ?>
                            </td>
                        </tr>
                        <?php
									$nCount++;
								}
								?>
                    </tbody>
                    <?php } else { ?>
                    <tbody>
                        <tr>
                            <td style="float:left; padding:10px;">Sorry! No orders found.</td>
                        </tr>
                    </tbody>
                    <?php } ?>

                </table>
            </div>

            <!-- <iframe allowtransparency="true" frameborder="0" width="706" height="492" style="background:0px none;" id="itemIframe" name="itemIframe" src="<?= base_url() ?>restaurantorders/ordersdetail/<?= $order["id"] ?>">
            <noscript>
               Your browser doesn't appear to support frames. Please see the <a href="<?= base_url() ?>restaurantitem/addItem">non-framed version</a> of this page.
            </noscript>
            </iframe> -->
        </div>
    </div>
</div>
<?php } ?>


<script>
<?php if($subscription_status == 'expired') { ?>
var message = "Please subscribe your trial has ended.";
alertify.alert('Notice', message);
<?php } ?>

function updateOrderStatus(orderid, status) {
    $('.jsIPLoader').show();
    $.ajax({
        type: "POST",
        url: "<?= base_url() ?>restaurantorders/updateOrderStatus/" + orderid,
        data: "order_status=" + status + "",
        success: function(orderstatus) {
            if (orderstatus > 0) {
                document.location.href = window.location.href;
            }
        } //end function
    });
}

function openOrderDetails(id) {
    if ($(event.target).hasClass('mark-delivered')) {
        return false;
    }
    $("#orderDetailsModel").modal('show');
    $("#order-details").attr('src', '<?= base_url() ?>restaurantorders/ordersdetail/' + id + '/history');
}
</script>
<!-- End Mid Right -->
<?
   $this->load->view("restaurantportal/footer_view");
?>