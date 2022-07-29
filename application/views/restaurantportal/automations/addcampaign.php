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
        Add Campaign
    </h1>
</div>

<div class=" title_bar content employe_table">
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
            height: 1px !important;
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

    <form>
        <div class="card card_width mb-4">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Campaign
            </div>
            <div class="card-body p-3">
                <div class="grid_roww">
                    <div class="form-group">
                        <label class="font_family w-100" for="coupon">
                            <span class="mb-2" style="display: block;font-weight:500;">Name</span>
                            <input type="text" class="form-control">
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="font_family w-100" for="coupon">
                            <span class="mb-2" style="display: block;font-weight:500;">Subject Line</span>
                            <input type="text" class="form-control">
                        </label>
                    </div>
                </div>
            </div>
            <!-- <div class="show_rows_adj">
            <ul class="pagination"><?= $paginationLinks ?></ul>
        </div> -->
        </div>

        <div class="card card_width mb-4">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Condition (send this message to registered customers based on)
            </div>
            <div class="card-body p-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" checked name="activeinactive" id="birthday" value="option1">
                    <label class="form-check-label" for="birthday">Birthday</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="activeinactive" id="aniversary" value="option2">
                    <label class="form-check-label" for="aniversary"> Anniversary</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="activeinactive" id="registration" value="option2">
                    <label class="form-check-label" for="registration"> Registration</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="activeinactive" id="f_order" value="option2">
                    <label class="form-check-label" for="f_order"> First Order</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="activeinactive" id="l_order" value="option2">
                    <label class="form-check-label" for="l_order"> Last Order</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="activeinactive" id="s_date" value="option2">
                    <label class="form-check-label" for="s_date"> Specific Day (9 AM EST)</label>
                </div>
                <span class="mt-5 d-block">How many times can a customer use the coupone?</span>
            </div>
            <hr class="no_margin">
            <div class="card-body p-3">
                <div class="grid_roww">
                    <div class="form-group">
                        <label class="font_family w-100" for="coupon">
                            <span class="mb-2" style="display: block;font-weight:500;">Days</span>
                            <input type="number" class="form-control" min="0">
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="font_family w-100" for="coupon">
                            <span class="mb-2" style="display: block;font-weight:500;">Anniversary</span>
                            <select name="" class=" form-select" id="">
                                <option value="">Select</option>
                                <option value="">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                                <option value="">4</option>
                                <option value="">5</option>
                                <option value="">6</option>
                                <option value="">7</option>
                                <option value="">8</option>
                                <option value="">9</option>
                                <option value="">10</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>

            <!-- <div class="show_rows_adj">
            <ul class="pagination"><?= $paginationLinks ?></ul>
        </div> -->
        </div>


        <div class="card card_width mb-4">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Compose Email
            </div>
            <div class="card-body p-0">
                <textarea name="editor1"></textarea>
            </div>

            <!-- <div class="show_rows_adj">
            <ul class="pagination"><?= $paginationLinks ?></ul>
        </div> -->
        </div>

        <div class="card card_width mb-4">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Include a coupon code?
            </div>
            <div class="card-body p-3">
                <div class="form-group">
                    <label class="font_family width_changed" for="coupon">
                        <!-- <span class="mb-2" style="display: block;font-weight:500;">How Many Times</span> -->
                        <select name="" class=" form-select" id="">
                            <option value="">Select</option>
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4</option>
                            <option value="">5</option>
                            <option value="">6</option>
                            <option value="">7</option>
                            <option value="">8</option>
                            <option value="">9</option>
                            <option value="">10</option>
                        </select>
                        <!-- <input type="text" class="form-control"> -->
                    </label>
                    <span class="red d-block mt-2">The selected coupon can only be redeemed by only recipients.</span>
                </div>
            </div>

            <!-- <div class="show_rows_adj">
            <ul class="pagination"><?= $paginationLinks ?></ul>
        </div> -->
        </div>
        <div class="card card_width mb-4">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Duration
            </div>
            <div class="card-body p-3">
                <div class="grid_roww">
                    <div class="form-group">
                        <label class="font_family w-100" for="coupon">
                            <span class="mb-2" style="display: block;font-weight:500;">Start Date</span>
                            <input type="date" class="form-control">
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="font_family w-100" for="coupon">
                            <span class="mb-2" style="display: block;font-weight:500;">End Date</span>
                            <input type="date" class="form-control">
                        </label>
                    </div>
                    <div class="form-group" style="display: flex;align-items:flex-end;height:100%;">
                        <span style="display: block;margin-right:20px;">Or</span>
                        <div class="form-check mb-0">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Never Expires
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="show_rows_adj">
            <ul class="pagination"><?= $paginationLinks ?></ul>
        </div> -->
        </div>


        <div class="card card_width mb-4">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Enable Campaign
            </div>
            <div class="card-body p-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" checked name="inlineRadioOptions" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">Active</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2"> Inactive</label>
                </div>
            </div>
            <!-- <div class="show_rows_adj">
            <ul class="pagination"><?= $paginationLinks ?></ul>
        </div> -->
        </div>



        <input type="submit" class="btn btn-primary orange_btn text-white mb-4" value="Submit">

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
<?
   $this->load->view("restaurantportal/footer_view");
   ?>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor1');
</script>