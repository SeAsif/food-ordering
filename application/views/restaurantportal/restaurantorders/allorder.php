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
var path = '<?= base_url(); ?>';
</script>
<script>
$(function() {
    $("#accordion").accordion({
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
</style>
<!--................. Start Orders Drop Menu ..............-->
<script src="<?= base_url() ?>js/drop-menu.js" type="text/javascript"></script>
<!--................. End Orders Drop Menu ..............-->
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
	 ?>
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
                    <li class="active li_variants_adj nav-item">
                        <a href="<?= base_url() . "restaurantorders/allorder" ?>" class="nav-link padding_li">All
                            Orders</a>
                    </li>
                    <li class="li_variants_adj nav-item">
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
										echo form_open(base_url().'restaurantorders/allorder',$attributes);
									?>
                                <div class="row mb-4">
                                    <div class="col-md-6 col-lg-4 col-xl-4 col-12 dis_flex_desktop margin_btm_orders">
                                        <div class="show_adj_again ">
                                            <label class="label_show_adj" for="inlineFormSelectPref">View Orders:
                                            </label>
                                            <select name="order_status" class="form-select select_view_orders "
                                                id="inlineFormSelectPref">
                                                <option value="All"
                                                    <?= ($filters["order_status"]	==	"All") ? 'selected="selected"' : '' ?>>
                                                    All</option>
                                                <option value="Pending"
                                                    <?= ($filters["order_status"]	==	"Pending") ? 'selected="selected"' : '' ?>>
                                                    Pending</option>
                                                <option value="Unpaid"
                                                    <?= ($filters["order_status"]	==	"Unpaid") ? 'selected="selected"' : '' ?>>
                                                    Un Paid</option>
                                                <option value="Confirmed"
                                                    <?= ($filters["order_status"]	==	"Confirmed") ? 'selected="selected"' : '' ?>>
                                                    Accepted</option>
                                                <option value="Rejected"
                                                    <?= ($filters["order_status"]	==	"Rejected") ? 'selected="selected"' : '' ?>>
                                                    Rejected</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-4 col-12 margin_btm_orders">
                                        <div class="show_adj_again">
                                            <label class="label_show_adj mid_inputs_margin" for="inlineFormSelectPref">
                                                Order Code: </label>
                                            <input name="order_code" type="text"
                                                class="form-control fixed_width_inputs order_code_all_orders "
                                                value="<?= !empty($filters["order_code"]) ? $filters["order_code"] : '' ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-0 col-lg-4 col-xl-4 col-12">

                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-4 col-12 ">
                                        <div class="show_adj_again margin_btm_orders">
                                            <label class="label_show_adj" for="inlineFormSelectPref">Delivery From Date:
                                            </label>
                                            <?
											$date	=	"";
																		if (!empty($filters["from_delivery_date"]))
												$date	=	date("m/d/Y",strtotime($filters["from_delivery_date"]));
											?>
                                            <input name="from_delivery_date" type="text" id="datepicker"
                                                class="form-control fixed_width_inputs start_delivery_date"
                                                value="<?= $date ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-4 col-12">
                                        <div class="show_adj_again mid_inputs_margin margin_btm_orders">
                                            <label class="label_show_adj" for="inlineFormSelectPref">Delivery To Date:
                                            </label>
                                            <?
												$date	=	"";
																			if (!empty($filters["to_delivery_date"]))
													$date	=	date("m/d/Y",strtotime($filters["to_delivery_date"]));
												?>
                                            <input name="to_delivery_date" type="text" id="datepicker1"
                                                class="form-control fixed_width_inputs" value="<?= $date ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xl-4 col-12">
                                        <button type="submit"
                                            class="btn margin_top_stng icon_btn_adj all_orders_search_btn"><span>Search</span></button>
                                    </div>

                                </div>
                                </form>
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
                                                <th>Net Receivable</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
											if (count($orders) > 0) {
												foreach ($orders as $order) {
											?>
                                            <tr onclick="openOrderDetails(<?= $order['id'] ?>)" style="cursor:pointer"
                                                class="order-row">
                                                <td class="order_code"><?= $order["order_code"] ?></td>
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
								                              echo "<img src='".base_url()."images/delivered.png' alt='mark' border='0' title='Confirmed' />";
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
                                                    ₦ <?= $english_format_number ?>
                                                </td>
                                                <td>
                                                    <? $totalTax = $order["city_tax"] + $order["state_tax"]?>
                                                    <? $english_format_number = number_format($totalTax, 2, '.', '');?>
                                                    ₦ <?= $english_format_number ?>
                                                </td>
                                                <td>
                                                    <? $net = $order["totalprice"]-$order["tgb_comission"];
		                              //	$net = $net + $totalTax;
		                              	$english_format_number = number_format($net, 2, '.', '');?>
                                                    ₦ <?= $english_format_number ?>
                                                </td>

                                            </tr>
                                            <?php

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
                                <div class="show_rows_adj">
                                    <ul class="pagination"><?= $paginationLinks ?></ul>
                                </div>
                            </div>
                            <div class="modal fade" id="orderDetailsModel" tabindex="-1"
                                aria-labelledby="orderDetailsLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="orderDetailsLabel">Order Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row justify-content-centre ">
                                                <div class="col-12">
                                                    <iframe style="width: 100%;min-height: 650px;" id="order-details"
                                                        src=""></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="2a">
                        <div class="card ">
                            <div class="card-body p-4">
                                <div class="row mb-4">
                                    <div class="col-md-3 col-lg-3 col-xl-3 col-12 dis_flex_desktop">
                                        <div class="show_adj_again">
                                            <label class="label_show_adj" for="inlineFormSelectPref"> Months: </label>
                                            <select class="form-select select_show_width months_adj"
                                                id="inlineFormSelectPref">
                                                <option selected>All</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3 col-12">
                                        <div class="show_adj_again">
                                            <label class="label_show_adj end_date_adj" for="inlineFormSelectPref">
                                                EndDate : </label>
                                            <select class="form-select select_show_width" id="inlineFormSelectPref">
                                                <option selected>All</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3 col-12">
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3 col-12">
                                        <span class="span_search"><i class="fas fa-search search_icon"></i></span>
                                        <button style=" background-color: #5dcaca; "
                                            class="btn margin_top_stng icon_btn_adj">Export to CSV</button>

                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Month</th>
                                                    <th scope="col">Total Orders</th>
                                                    <th scope="col">Total Amount</th>
                                                    <th scope="col">Fee</th>
                                                    <th scope="col">Net Payable to Research</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Paid To Restaurant</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td> Jan </td>
                                                    <td> 4 </td>
                                                    <td> $123.0 </td>
                                                    <td> $12.65 </td>
                                                    <td> $5463 </td>
                                                    <td> Paid </td>
                                                    <td> Paid </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class=" flex-columns">
                                    <div class="inline_block_adj show_rows_adj">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Show Rows :</label>
                                        <select class="custom-select my-1 show_rows_count"
                                            id="inlineFormCustomSelectPref">
                                            <option selected>30</option>
                                            <option value="1">50</option>
                                            <option value="2">60</option>
                                            <option value="3">70</option>
                                        </select>
                                    </div>
                                    <div class="show_rows_adj">
                                        <nav aria-label="Page navigation example ">
                                            <ul class="pagination">
                                                <li class="page-item "><a class="page-link active" href="#">Prev</a>
                                                </li>
                                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                            </ul>
                                        </nav>
                                    </div>
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
<script type="text/javascript">
$(function() {

    // Datepicker
    $('#datepicker').datepicker({
        inline: true
    });
    $('#datepicker1').datepicker({
        inline: true
    });


});

function openOrderDetails(id) {
    $("#orderDetailsModel").modal('show');
    $("#order-details").attr('src', '<?= base_url() ?>restaurantorders/ordersdetail/' + id + '/history');
}
</script>
<!-- End Mid Right -->
<?
   $this->load->view("restaurantportal/footer_view");
   ?>