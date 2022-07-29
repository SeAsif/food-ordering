<?
   $this->load->view("userfront/header_view_new");
   // $this->load->view("userfront/header_view");
   // $this->load->view("userfront/header_view_new");

  	$default_payment_type = "TakeAway";
  	$dine_in = $restaurantInfo["dine_in"];
  	$take_out = $restaurantInfo["take_out"];
  	$delivery = $restaurantInfo["delivery"];

   	if ($dine_in != "Yes" && $take_out != "Yes" && $delivery == "Yes") {
		$default_payment_type = "Delivery";
   	}
?>
<!-- Start Menu Popups -->
<link rel='stylesheet'
    href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css'>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js'></script>
<script
    src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js'>
</script>


<script language="javascript">
$(document).ready(function() {
    var defaults = {
        calendarWeeks: true,
        showClear: false,
        showClose: false,
        allowInputToggle: true,
        useCurrent: false,
        ignoreReadonly: true,
        format: 'dd-mm-yy',
        toolbarPlacement: 'top',
        icons: {
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-angle-up',
            down: 'fa fa-angle-down',
            previous: 'fa fa-angle-left',
            next: 'fa fa-angle-right',
            today: 'fa fa-dot-circle-o',
            clear: 'fa fa-trash',
            close: 'fa fa-times'
        }
    };



    $(function() {
        var optionsDate = $.extend({}, defaults, {
            format: 'DD-MM-YYYY'
        });
        var optionsTime = $.extend({}, defaults, {
            format: 'HH:mm'
        });

        $('.datepicker').datetimepicker(optionsDate);
        $('.timepicker').datetimepicker(optionsTime);

        var default_payment_type = '<?php echo $default_payment_type; ?>';

        if (default_payment_type == 'Delivery') {
            $("#guest_order_type").val(default_payment_type);
            $(".not_req_guest_field").show();
        }
    });

    $('input[name="order_type"]:first').attr("checked", "checked");
    $('input[type=radio][name=pre_order]').change(function() {
        if (this.value == "Yes") {
            $('#date').attr('required', 'required');
            $('#time').attr('required', 'required');
            document.getElementById("delivery_time_wrapper").style.display = "block";
        } else {
            $('#date').removeAttr('required');
            $('#time').removeAttr('required');
            document.getElementById("delivery_time_wrapper").style.display = "none";
        }
    });
    var previous_order_type = '';
    $('input[type=radio][name=order_type]').change(function() {
        if (this.value == 'Delivery') {
            $('#address').attr('required', 'required');
            document.getElementById("address_wrapper").style.display = "block";
            document.getElementById("delivery_charges_wrapper").style.display = "grid";
            document.getElementById("total").innerHTML = parseFloat(document.getElementById("total")
                .innerHTML) + parseFloat(<?= $restaurantInfo["delivery_charge"] ?>);

        } else {
            $('#address').removeAttr('required');
            document.getElementById("address_wrapper").style.display = "none";
            document.getElementById("delivery_charges_wrapper").style.display = "none";
            console.log
            if (previous_order_type == 'Delivery')
                document.getElementById("total").innerHTML = parseFloat(document.getElementById("total")
                    .innerHTML) - parseFloat(<?= $restaurantInfo["delivery_charge"] ?>);

        }
        previous_order_type = this.value;

    });
});

$('#perform_submit_action').click(function() {
    var payment_mode = $('input[name="payment_method"]:checked').val();
    console.log(payment_mode);
    if (payment_mode == 'cash_on_delivery') {
        $("#form_place_order").submit();
    } else if (payment_mode == 'pay_online') {

        var table_no = $("#table_no").val();
        var location = "<?php echo base_url('payment/initialize/'.$order); ?>"
        var new_location = location + "/" + table_no;
        $(location).attr('href', new_location)
    }
});

var url = '<?= base_url() ?>userrestaurant/itemdetail/';

function refreshItemPage() {
    document.location.href = document.location.href;
}

function openItem(nItemId) {
    $.get(url + nItemId, function(data) {
        $("#item-details").html(data);
    });
    $('#checkoutItemDetails').modal('show');
    // $('#dialog-message').dialog('open');
    return false;
}
</script>
<style>
.breadcrumb a {
    padding: 0px 10px;
    font-family: 'Roboto', sans-serif !important;
    font-size: 18px !important;
    font-weight: 500 !important;
    font-stretch: normal !important;
    font-style: normal !important;
    line-height: 1.56 !important;
    letter-spacing: 0.14px !important;
    text-align: left !important;
    color: rgba(0, 0, 0, 0.87) !important;
}

h1 {
    font-size: 25px;
    font-weight: 800;
    font-stretch: normal;
    font-family: 'Roboto', sans-serif !important;
    font-style: normal;
    line-height: 1.16;
    letter-spacing: 0.14px;
    text-align: left;
    color: rgba(0, 0, 0, 0.87);
}

.Italiano-Piza {
    margin-top: 20px;
}

.close {
    background: transparent !important;
    border-color: transparent !important;
}

h2 {
    font-size: 20px;
    font-weight: 800;
    font-stretch: normal;
    font-family: 'Roboto', sans-serif !important;
    font-style: normal;
    line-height: 1.16;
    letter-spacing: 0.14px;
    text-align: left;
    color: rgba(0, 0, 0, 0.77);
}

h3 {
    font-size: 16px;
    font-weight: 800;
    font-stretch: normal;
    font-family: 'Roboto', sans-serif !important;
    font-style: normal;
    line-height: 1.16;
    letter-spacing: 0.14px;
    text-align: left;
    color: rgba(0, 0, 0, 0.6);
}

.breadcrumb span {
    padding: 0px 10px;
    font-family: 'Roboto', sans-serif !important;
    font-size: 18px !important;
    font-weight: 500 !important;
    font-stretch: normal !important;
    font-style: normal !important;
    line-height: 1.56 !important;
    letter-spacing: 0.14px !important;
    text-align: left !important;
    color: rgba(0, 0, 0, 0.5) !important;
}

.grid_row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    margin-bottom: 20px;
}

.grid_row a,
.grid_row table td {
    padding: 0px 10px;
    font-family: 'Roboto', sans-serif !important;
    font-size: 18px !important;
    font-weight: 500 !important;
    font-stretch: normal !important;
    font-style: normal !important;
    line-height: 1.56 !important;
    letter-spacing: 0.14px !important;
    text-align: left !important;
    /* color: rgba(0, 0, 0, 0.87) !important; */
}

#checkoutform {
    width: 100%;
    text-align: center;
}

#checkoutform .primary-btn {
    padding: 10px 30px;
    font-family: 'Roboto', sans-serif !important;
    font-size: 18px !important;
    font-weight: 500 !important;
    font-stretch: normal !important;
    font-style: normal !important;
    line-height: 1.56 !important;
    letter-spacing: 0.14px !important;
    width: 100% !important;
    display: block;
}

.bordered_row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    padding: 20px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.15);
}

.bordered_row div:last-child {
    text-align: right !important;
}

.bordered_row div {
    font-family: 'Roboto', sans-serif !important;
    font-size: 18px !important;
    font-weight: 500 !important;
    font-stretch: normal !important;
    font-style: normal !important;
    line-height: 1.56 !important;
    letter-spacing: 0.14px !important;
    text-align: left !important;
    /* color: rgba(0, 0, 0, 0.87) !important; */
}

.checkbox-container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.checkbox-container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
}

/* On mouse-over, add a grey background color */
/* .checkbox-container:hover input ~ .checkmark {
  background-color: #ccc;
} */

/* When the checkbox is checked, add a blue background */


/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.checkbox-container input:checked~.checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */

@media only screen and (max-width:767px) {

    .card,
    #checkoutform a {
        width: 100% !important;
    }
}

#signin-message .add-btn {
    padding: 10px;
    margin: 10px 0;
}

.payment_methode {
    padding: 20px;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    text-align: left !important;

}

.order_type {
    padding: 20px;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
}

.payment_methode label,
.payment_methode div {
    font-family: 'Roboto', sans-serif !important;
    font-size: 18px !important;
    font-weight: 500 !important;
    font-stretch: normal !important;
    font-style: normal !important;
    line-height: 1.56 !important;
    letter-spacing: 0.14px !important;
    /* color: rgba(0, 0, 0, 0.87) !important; */

}

@media only screen and (max-width:600px) {
    .payment_methode {
        grid-template-columns: 100% !important;
        column-gap: 0 !important;
        row-gap: 15px !important;
    }
}
</style>
<!-- End Menu Popups -->
<!-- Start Menu Popup -->
<div class="modal fade" id="checkoutItemDetails" tabindex="-1" aria-labelledby="checkoutItemDetailsLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content main-menu-bg-color">
            <div class="modal-header">
                <h1 class="modal-title category-text-color" style="font-weight: bold;" id="checkoutItemDetailsLabel">
                    Item Detail</h1>
                <button type="button" class="close_button" data-bs-dismiss="modal" aria-label="Close">
                    <i class=" fa fa-lg fa-times category-text-color"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="item-details"></div>
                <iframe frameborder="0" style="width: 100%;" height="590" style="background:0px none; padding-top:10px;"
                    id="itemIframe" name="itemIframe" frameborder="0">
                </iframe>
            </div>
        </div>
    </div>
</div>
<?php if($this->session->flashdata('coupon_message')){ ?>
    <div class="flash_error_message">
        <div class="alert alert-info alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?php echo $this->session->flashdata('coupon_message');?>
        </div>
    </div>
<?php } ?>
<!-- End Menu Popup -->
<div class="main-container main-menu-bg-color">
    <!-- <div class="crum-menu breadcrumb">
		<span class="breadcrumb-item">Check Out</span>
	</div> -->
    <div class="cont-wrap ">
        <!-- <div class="cont-round"><img src="<?= base_url() ?>images/front/rest-top.jpg" alt="top" border="0" /></div> -->
        <div class="card main-menu-bg-color">
            <div class="card-header">
                <h1 class="category-text-color">Checkout</h1>
            </div>
            <div class="card-body">
                <div class="rest-mid">
                    <!-- Start Restaurant Head -->
                    <? if(isset($errors) && count($errors))
            {
            ?>
                    <div class="ui-widget" style="margin-top:10px;">
                        <div class="ui-state-error ui-corner-all" style="padding:10px;">
                            <?
                  foreach($errors as $error)
                  echo $error;
                  ?>
                            <a href="<?= base_url('m/') ?><?= $this->session->userdata('restaurantName') ?>"><strong>Click
                                    Here to Reconfirm!</strong></a>
                        </div>
                    </div>
                    <?
            }?>
                    <?
            if (count($cartItems) > 0)
            {
            ?>
                    <!-- Start Content Section -->
                    <div class="account">
                        <div class="about-info">
                            <h2 class="menu-heading" style="margin-bottom:0px;">Review and Submit</h2>
                        </div>
                        <?
               $total	=	0;
               $totalCityTax = 0;
               $totalStateTax = 0;
                              foreach ($cartItems as $cartItem)
               {
								$grandTotal	=	0;
               
               ?>
                        <div class="Italiano-Piza">
                            <h3 class="menu-heading"><?= $cartItem["item_name"] ?></h3>
                            <p class="menu-sub-heading"><?= $cartItem["item_description"] ?></p>
                            <div class="grid_row">
                                <a class="menu-heading" href="javascript:void(null);"
                                    onclick="openItem(<?= $cartItem["id"] ?>);">View Details</a>
                                <div class="qty-price w-100">
                                    <table border="0" cellspacing="0" cellpadding="0" class="w-100">
                                        <tr>
                                            <td class="menu-heading">Qty: <strong><?= $cartItem["quantity"] ?></strong>
                                            </td>
                                            <? $english_format_number = number_format($cartItem["totalprice"], 2, '.', '');?>
                                            <td class="menu-heading">Price:
                                                <strong>₦<?= $english_format_number ?></strong>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <? // $english_format_number = number_format($grandTotal, 2, '.', '');?>
                        <div class="taxTotal menu-heading">
                            <? $totalCityTax = $totalCityTax + $cartItem["city_tax"];
               $totalStateTax = $totalStateTax + $cartItem["state_tax"];
               $grandTotal	=	$grandTotal+$cartItem["totalpricewithtax"]; ?>
                            <? $english_format_number = number_format($cartItem["city_tax"], 2, '.', '');?>
                            <div class="bordered_row menu-heading">
                                <div>
                                    City Tax :
                                </div>
                                <div>
                                    ₦<?= $english_format_number ?>
                                </div>
                            </div>
                            <? $english_format_number = number_format($cartItem["state_tax"], 2, '.', '');?>
                            <div class="bordered_row menu-heading">
                                <div>
                                    State Tax:
                                </div>
                                <div>
                                    ₦<?= $english_format_number ?>
                                </div>
                            </div>
                        </div>

                        <? 
							$total += $grandTotal;
							$english_format_number = number_format($grandTotal, 2, '.', '');
							?>
                        <div class="bordered_row menu-heading">
                            <div>
                                Sub Total:
                            </div>
                            <div>
                                ₦<?= $english_format_number ?>
                            </div>
                        </div>
                        <?               
                             }//end foreach ($cartItems as $cartItem)
														 $yes_count = 0 ;
							if($restaurantInfo["take_out"] == "Yes")
								$yes_count++ ;
							if($restaurantInfo["dine_in"] == "Yes")
								$yes_count++ ;
							if($restaurantInfo["delivery"] == "Yes")
								$yes_count++ ;
               ?>
                        <div class="bordered_row menu-heading" id="delivery_charges_wrapper"
                            style="<?= $restaurantInfo["delivery"] == "Yes" && $yes_count == 1 ? 'display:grid' : 'display:none' ?>">
                            <div>
                                Delivery Charges:
                            </div>
                            <div>₦<?= $restaurantInfo["delivery_charge"] ?></div>

                        </div>
                        <div class="bordered_row menu-heading">
                            <div>
                                <strong>
                                    Total:
                                </strong>
                            </div>
                            <div>
                                <? 
								if($restaurantInfo["delivery"] == "Yes" && $yes_count == 1){ 
									$total_display = $total+$restaurantInfo["delivery_charge"];
								}else{
									$total_display = $total;
								}
							$english_format_number = number_format($total_display, 2, '.', '');
							?>
                                ₦<strong id="total"><?= $english_format_number ?></strong>
                            </div>
                        </div>
                        <form id="checkoutform" action="<?= $this->config->item('SITE_HTTPS'); ?>" method="post">
                            <div class="payment_methode menu-heading">
                                <?php 
							$delievery_address = '';
							
							if($yes_count >= 2){ ?>
                                <div>Order Type: </div>
                                <?php if($restaurantInfo["take_out"] == "Yes"){ ?>
                                <div>
                                    <input name="order_type" type="radio" value="TakeAway" class="" />
                                    Take Away
                                </div>
                                <?php } ?>
                                <?php if($restaurantInfo["dine_in"] == "Yes"){ ?>
                                <div>
                                    <input name="order_type" type="radio" value="DineIn" class="" />
                                    Dine
                                </div>
                                <?php } ?>
                                <?php if($restaurantInfo["delivery"] == "Yes"){ ?>
                                <div>
                                    <input name="order_type" type="radio" value="Delivery" class="" />
                                    Delivery
                                </div>
                                <?php } ?>

                                <? }else if($restaurantInfo["dine_in"] == "Yes"){ ?>
                                <div><input name="order_type" type="hidden" value="DineIn" />
                                    Order Type:</div>
                                <div> Dine In</div>
                                <? }else if($restaurantInfo["take_out"] == "Yes"){ ?>
                                <div><input name="order_type" type="hidden" value="TakeAway" />
                                    Order Type:</div>
                                <div> Take Away</div>
                                <? }else if($restaurantInfo["delivery"] == "Yes"){ ?>
                                <div><input name="order_type" type="hidden" value="Delivery" />
                                    Order Type:</div>
                                <div> Delivery</div>
                                <?php $delievery_address = 'required'; ?>
                                <? } ?>

                            </div>



                            <div id="address_wrapper"
                                style="<?= $restaurantInfo["delivery"] == "Yes" && $yes_count == 1 ? 'display:block' : 'display:none' ?>">
                                <div class="payment_methode menu-heading">
                                    <div>Delivery Address:</div>
                                    <div>
                                        <input name="address" type="text" id="address" value=""
                                            <?php echo $delievery_address; ?> />
                                    </div>
                                </div>
                            </div>
                            <?php if($restaurantInfo["pre_order"] == "Yes"){ ?>
                            <div class="payment_methode menu-heading">
                                <div>Preorder: </div>
                                <div>
                                    <input name="pre_order" type="radio" value="No" checked />
                                    Now

                                </div>
                                <div>
                                    <input name="pre_order" type="radio" value="Yes" />
                                    Later
                                </div>



                                <div id="delivery_time_wrapper" style="display:none">

                                    <div class="form-group">
                                        <div class="input-group datepicker">
                                            <input id="date" name="date" type="text"
                                                class="form-control text-input-color">
                                            <span class="input-group-addon input-group-text">
                                                <span class="fa fa-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group timepicker">
                                            <input id="time" name="time" type="text"
                                                class="form-control text-input-color">
                                            <span class="input-group-addon input-group-text">
                                                <span class="fa fa-clock-o"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?php } ?>
                            <div class="payment_methode menu-heading">
                                <div>Payment Type:</div>
                                <div>
                                    <input name="payment_method" type="radio" value="Cash" checked="checked" />
                                    <label for="cash">Cash</label>
                                </div>
                                <div>
                                    <input name="payment_method" type="radio" value="Card" />
                                    <label for="card">Card</label>
                                </div>
                            </div>
                            <div class="payment_methode menu-heading">
                                <div>Enter valid Coupon Code:</div>
                                <div>
                                    <input class="text-input-color" name="coupon_code" type="text" id="coupon_code"
                                        value="<?php echo urldecode($table); ?>" />
                                </div>

                            </div>
                            <div class="payment_methode menu-heading">
                                <div>Table/Room:</div>
                                <div>
                                    <?php $table = isset($table_no) ? $table_no : ''; ?>
                                    <input class="text-input-color" name="table_no" type="text" id="table_no"
                                        value="<?php echo urldecode($table); ?>" />
                                </div>

                            </div>
                            <input type="hidden" name="restaurant_id"
                                value="<?= $this->session->userdata('restaurantID') ?>" />

                            <input type="hidden" name="order_cost" value="<?= $total ?>" />
                            <input type="hidden" name="user_id" value="<?= $this->session->userdata("id") ?>" />
                            <?
							    if( $this->session->userdata('id')== "" && $this->session->userdata('guest_email')=="")
                  {
                  ?>
                            <a href="javascript:void(null);" onclick="openSign(0);"
                                class="add-btn primary-btn-bg-color primary-btn-text-color primary-btn"
                                id="guest_next">Next</a>
                            <button class="add-btn primary-btn-bg-color primary-btn-text-color" type="submit"
                                id="guest_submit" style="display: none;">Submit</button>
                            <?
                  }else
                  {
                   ?>
                            <button class="add-btn primary-btn-bg-color primary-btn-text-color"
                                type="submit">Submit</button>
                            <?
                  }
                  ?>
                            <!-- <label style="display:block; padding:4px 0px 0px 10px; float:left;">
                  <input name="box" type="checkbox" value="Yes" /> Add this order in my favorite
                  </label> -->
                        </form>
                    </div>
                    <!-- End Content Section -->
                    <?
            }else{
							?>
                    <div class="ui-state-error ui-corner-all" style="padding:10px;">
                        Cart Is Empty
                    </div>
                    <a type="button" class="add-btn primary-btn-bg-color primary-btn-text-color"
                        href="<?= base_url('m/') ?><?= $this->session->userdata('restaurantName') ?>"
                        style="margin-top: 10px;"> Continue Shopping</a>
                    <?
						}//end if (count($cartItems) > 0)
            ?>
                </div>
            </div>
        </div>

        <script>
            $(".order_type").on("click", function() {
                var order_type = $(this).val();
                $("#guest_order_type").val(order_type);

                if (order_type != "Delivery") {
                    $(".not_req_guest_field").hide();
                } else {
                    $(".not_req_guest_field").show();
                }
            });

            
        </script>
        <?
   $this->load->view("userfront/footer_view");
   ?>