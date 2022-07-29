<?
   $this->load->view("restaurantportal/header_view");
   $this->load->view("restaurantportal/sidepanel_view");
   ?>
<?
$this->load->view("restaurantportal/top_bar");
?>
<!-- End Dialog Popups -->
<div class="title_bar title_bar_adj">
    <h1>
        Update Coupon
    </h1>
</div>
<div class="title_bar flexable" id="return_message" style="display:none"></div>
<div class=" title_bar content employe_table no_border_bottom">
    <?
            $this->load->view("restaurantportal/messages");
            ?>
    <style>
    .width_changed {
        width: 30%;
    }

    .grid_roww {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        column-gap: 25px;
    }

    .no_margin {
        margin: 0;
        height: 5px !important;
    }

    .input_error {
        color: red;
        display: none;
    }

    @media only screen and (max-width:575px) {
        .grid_roww {
            grid-template-columns: repeat(1, 1fr) !important;
            column-gap: 0px !important;
            row-gap: 10px !important;
        }

        .width_changed {
            width: 100% !important;
        }
    }

    @media only screen and (max-width:767px) and (min-width:575px) {
        .grid_roww {
            grid-template-columns: repeat(2, 1fr) !important;
            column-gap: 10px !important;
            row-gap: 10px !important;
        }

        .width_changed {
            width: 100% !important;
        }
    }

    </style>

    <form id="submit_form" action="javascript: void(0)">
        <input type="hidden" name="id" value="<? echo $coupon->id;?>">
        <div class="card card_width mb-4">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Enter the Coupon Code for this coupon. Customers will have to enter this code to receive their discount.
            </div>
            <div class="card-body p-3">
                <div class="form-group">
                    <label class="font_family width_changed" for="coupon">
                        <span class="mb-2" style="display: block;font-weight:500;">Coupon Code</span>
                        <input type="text" class="form-control" name="code" id="coupon_code" value="<? echo $coupon->code;?>">
                        <span class="input_error" id="error_coupon_code">Please enter coupon code.</span>
                    </label>
                </div>
            </div>

        </div>

        <div class="card card_width mb-4">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Coupon Duration
            </div>
            <div class="card-body p-3">
                <div class="grid_roww">
                    <div class="form-group">
                        <label class="font_family w-100" for="coupon">
                            <span class="mb-2" style="display: block;font-weight:500;">Start Date</span>
                            <input type="date" class="form-control" name="start_date" id="start_date"
                                value="<? echo $coupon->start_date;?>">
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="font_family w-100" for="coupon">
                            <span class="mb-2" style="display: block;font-weight:500;">End Date</span>
                            <input type="date" class="form-control" name="end_date" id="end_date"
                                value="<? echo $coupon->end_date;?>">
                        </label>
                    </div>
                    <div class="form-group" style="display: flex;align-items:flex-end;height:100%;">
                        <span style="display: block;margin-right:20px;">Or</span>
                        <div class="form-check mb-0">
                            <?php $is_default = $coupon->is_default == 1 ? 'checked="checked"' : '';?>
                            <input class="form-check-input coupon_checkbox" type="checkbox" name="is_default" id="never_expires" <?php echo $is_default;?>>
                            <label class="form-check-label" for="flexCheckDefault">
                            Never Expires
                            </label>
                        </div>
                    </div>
                    <span class="input_error" id="error_date_secction">Please select date or checked the default option.</span>
                </div>
            </div>

        </div>

        <div class="card card_width mb-4">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Usage
            </div>
            <div class="card-body p-3">
                <div class="form-group">
                    <label class="font_family width_changed" for="coupon">
                        <span class="mb-2" style="display: block;font-weight:500;">How Many Times</span>
                        <?php $usage_value = $coupon->usage != 0 ? $coupon->usage : '';?>
                        <input type="number" min="1" class="form-control" name="usage" id="usage" value="<?php echo $usage_value; ?>">
                    </label>

                    <label class="form-check-label" for="flexCheckDefault">
                        <span style="margin: 15px;">Or</span>
                        <?php $is_unlimited = $coupon->usage == 0 ? 'checked="checked"' : '';?>
                        <input class="form-check-input coupon_checkbox" type="checkbox" name="is_unlimited" id="unlimited" <?php echo $is_unlimited; ?>>
                        Unlimited
                    </label>
                    <span class="input_error" id="error_usage">Please select number or checked the unlimited
                        option.</span>
                </div>
            </div>
        </div>
        <div class="card card_width mb-4">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Discount in % or Amount ?
            </div>
            <div class="card-body p-3">
                <div class="form-check form-check-inline">

                    <?php $is_percentage = $coupon->discount_type == 'Percentage' ? 'checked="checked"' : '';?>
                    <input class="form-check-input" type="radio" name="discount_type" id="inlineRadio1" value="Percentage" <?php echo $is_percentage;?>>
                    <label class="form-check-label" for="inlineRadio1">% Percent</label>
                </div>
                <div class="form-check form-check-inline">
                    <?php $is_Naira = $coupon->discount_type == 'Naira' ? 'checked="checked"' : '';?>
                    <input class="form-check-input" type="radio" name="discount_type" id="inlineRadio2" value="Naira" <?php echo $is_Naira;?>>
                    <label class="form-check-label" for="inlineRadio2"> &#8358; (naira)</label>
                </div>
                <div class="form-group mt-3">
                    <label class="font_family width_changed" for="coupon">
                        <span class="mb-2" style="display: block;font-weight:500;">Discount</span>
                        <input type="text" class="form-control" name="discount" id="discount_value" value="<? echo $coupon->discount;?>">
                        <span class="input_error" id="error_discount_value">Please enter discount value.</span>
                    </label>
                </div>
            </div>

        </div>

        <h3 class="mb-4 mt-1">Coupon Settings</h3>

        <div class="card card_width mb-4">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Enable the Coupon Code
            </div>
            <div class="card-body p-3">
                <div class="form-check form-check-inline">
                    <?php $is_active = $coupon->status == 'Active' ? 'checked="checked"' : '';?>
                    <input class="form-check-input" type="radio" checked name="status" id="active" value="Active" <?php echo $is_active;?>>
                    <label class="form-check-label" for="active">Active</label>
                </div>
                <div class="form-check form-check-inline">
                    <?php $is_inactive = $coupon->status == 'Inactive' ? 'checked="checked"' : '';?>
                    <input class="form-check-input" type="radio" name="status" id="inactive" value="Inactive" <?php echo $is_inactive;?>>
                    <label class="form-check-label" for="inactive"> Inactive</label>
                </div>
            </div>
            <hr class="no_margin">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Customers log in required
            </div>
            <div class="card-body p-3">
                <div class="form-check form-check-inline">
                    <?php $is_yes = $coupon->customer_log == 'Yes' ? 'checked="checked"' : '';?>
                    <input class="form-check-input" type="radio" name="customer_log" id="yes" value="Yes" <?php echo $is_yes;?>>
                    <label class="form-check-label" for="yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <?php $is_no = $coupon->customer_log == 'No' ? 'checked="checked"' : '';?>
                    <input class="form-check-input" type="radio" name="customer_log" id="no" value="No" <?php echo $is_no;?>>
                    <label class="form-check-label" for="no"> No</label>
                </div>
            </div>
            <hr class="no_margin">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Show Coupon on Home Page
            </div>
            <div class="card-body p-3">
                <div class="form-check form-check-inline">
                    <?php $public_coupon = $coupon->is_home_page == 'Public' ? 'checked="checked"' : '';?>
                    <input class="form-check-input" type="radio" name="is_home_page" id="public" value="Public" <?php echo $public_coupon;?>>
                    <label class="form-check-label" for="public">Public</label>
                </div>
                <div class="form-check form-check-inline">
                    <?php $private_coupon = $coupon->is_home_page == 'Private' ? 'checked="checked"' : '';?>
                    <input class="form-check-input" type="radio" name="is_home_page" id="private" value="Private" <?php echo $private_coupon; ?>>
                    <label class="form-check-label" for="private"> Private</label>
                </div>
            </div>

        </div>

        <input type="submit" class="btn default_orange_button mb-4" value="Submit">

    </form>
</div>

<!-- Start Delete Popup Window Here -->
<div class="modal fade" id="delete_hour" tabindex="-1" aria-labelledby="delete_hourLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addtiming_form" action="<?= base_url() ?>staffhours/deleteoperetionalhours" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete_hourLabel">Delete operation hours</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <strong>Are you want to delete Coupon </strong>
                </div>

                <div class="modal-footer-new">
                    <input type="hidden" name="operation_hour_id" id="operation_hour_id" value="" />
                    <button type="submit" class="btn modal_btn_width text-white modal_btn_one">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Delete Popup Window Here -->
</div>
<!-- End Mid Right -->
<script type="text/javascript">
$("#submit_form").submit(function(e) {
    e.preventDefault();
    var flag = 0;
    var coupon_code = $("#coupon_code").val();
    var discount_value = $("#discount_value").val();
    var start_date = $("#start_date").val();
    var end_date = $("#end_date").val();
    var usage = $("#usage").val();    

    if (coupon_code == "" || coupon_code == undefined) {
        $("#error_coupon_code").show();
        flag = 1;
    }

    if (!$('#never_expires').is(':checked')) {
        if (start_date == '' && end_date == '') {
            $("#error_date_secction").show();
            flag = 1;
        }
    }

    if (!$('#unlimited').is(':checked')) {
        if (usage == '') {
            $("#error_usage").show();
            flag = 1;
        }
    }

    if (discount_value == "" || discount_value == undefined) {
        $("#error_discount_value").show();
        flag = 1;
    } else {
        if(discount_value != '' && !/^[0-9]+$/.test(discount_value)) {
           $("#error_discount_value").show();
           $("#error_discount_value").html('Only number are accepted for discount value.');
           flag = 1;
        } else if (discount_value == '0') {
            $("#error_discount_value").show();
            $("#error_discount_value").html('Please enter value greater then 0.');
            flag = 1;
        }
    }

    if (flag == 1) {
        alertify.alert("Warning", "Please provide required fields first!")
        return false;
    } else {
        var formData = $("#submit_form").serialize();

        $.ajax({
            type: 'POST',
            url: '<?= base_url() . "marketingtools/update_coupon" ?>',
            data: formData,
            success: function(data) {
                console.log(data)
                if (data.status == "success") {
                    var return_message = '<div class="alert alert-success" role="alert">' + data
                        .message + '</div>';
                    $("#return_message").show();
                    $("#return_message").append(return_message);
                    setTimeout(() => {
                        window.location.href =
                            "<?= base_url() . "marketingtools/coupons"; ?>"
                    }, 1000);
                } else {
                    var return_message = '<div class="alert alert-danger" role="alert">' + data
                        .message + '</div>';
                    $("#return_message").show();
                    $("#return_message").append(return_message);
                    setTimeout(() => {
                        $("#return_message").hide();
                    }, 5000);
                }
            },
            complete: function() {
                $('body, html').animate({
                    scrollTop: $('#data_picker').top
                }, 'slow');
            }

        });
    }    
});
</script>
<?
   $this->load->view("restaurantportal/footer_view");
   ?>