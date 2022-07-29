<?
   $this->load->view("restaurantportal/header_view");
   $this->load->view("restaurantportal/sidepanel_view");
   ?>
<style>
.div_inline {
    display: inline-flex;
    align-items: center;
}

.float_element {
    float: right;
}

.date_adj {
    max-width: 250px !important;
    width: 250px;
    border-radius: 10px !important;
    margin-left: 5px;
    border: 1px solid #ced4da !important;
    padding: 10px;
}

.flex-setting {
    justify-content: end !important;
}

.show_rows_adj {
    margin-left: 10px !important;
}

.margin_top {
    margin-top: 25px !important;
}
</style>
<?
$this->load->view("restaurantportal/top_bar");
?>

<!-- End Dialog Popups -->
<div class="title_bar title_bar_adj">

    <div class="row" style="width:100%">
        <div class="col-md-6 col-sm-12">
            <h1>Payroll</h1>
        </div>
        <div class="col-md-6 col-sm-12">
            <button class="btn orange_btn text-white float_element default_orange_button" data-bs-toggle="modal"
                data-bs-target="#payroll_setting">Payroll Settings</button>
        </div>
    </div>

</div>
<div class="title_bar flexable">
    <form class="row  align-items-center">
        <div class="col-sm-12 col-md-6 col-lg-4 div_inline btn_margin_bottom">
            <label class="" for="inlineFormSelectPref">Staff: </label>
            <select class="form-select date_adj select_adj" id="inlineFormSelectPref">
                <option selected>Select Staff</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 div_inline btn_margin_bottom">
            <label for="birthday">Start: </label>
            <input class="date_adj select_background" type="date" id="birthday" name="birthday">
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 div_inline">
            <label for="birthday">End: </label>
            <input class="date_adj " type="date" id="birthday" name="birthday">
            <button type="submit" class="span_search float_element"><i class="fas fa-search search_icon"></i></button>
        </div>

    </form>
</div>

<div class=" title_bar content employe_table">
    <?
            $this->load->view("restaurantportal/messages");
            ?>
    <div class="card card_width ">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table_setting">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Start Period</th>
                            <th scope="col">End Period</th>
                            <th scope="col">Work</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Description</th>
                            <th scope="col">Changed Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>21-Jan-2021</td>
                            <td>21-Apri-2021</td>
                            <td>6 Hours</td>
                            <td>$123</td>
                            <td>this is the new amount added</td>
                            <td>+ 200</td>
                            <td>Paid</td>
                            <td class="flex_direction">
                                <button style=" background-color: #5dcaca; " class="btn margin_top_stng icon_btn_adj">
                                    Pay</button>
                                <!-- <button class="disable-active btn margin_top_stng icon_btn_adj">Activate</button> -->
                                <button class="btn margin_top_stng icon_btn_adj" data-bs-toggle="modal"
                                    data-bs-target="#change_amount">
                                    Change </button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>21-Jan-2021</td>
                            <td>21-Apri-2021</td>
                            <td>6 Hours</td>
                            <td>$123</td>
                            <td>this is the new amount added</td>
                            <td>+ 200</td>
                            <td>Paid</td>
                            <td class="flex_direction">
                                <button style=" background-color: #5dcaca; " class="btn margin_top_stng icon_btn_adj">
                                    Pay</button>
                                <!-- <button class="disable-active btn margin_top_stng icon_btn_adj">Activate</button> -->
                                <button class="btn margin_top_stng icon_btn_adj" data-bs-toggle="modal"
                                    data-bs-target="#change_amount">
                                    Change </button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>21-Jan-2021</td>
                            <td>21-Apri-2021</td>
                            <td>6 Hours</td>
                            <td>$123</td>
                            <td>this is the new amount added</td>
                            <td>+ 200</td>
                            <td>Paid</td>
                            <td class="flex_direction">
                                <button style=" background-color: #5dcaca; " class="btn margin_top_stng icon_btn_adj">
                                    Pay</button>
                                <!-- <button class="disable-active btn margin_top_stng icon_btn_adj">Activate</button> -->
                                <button class="btn margin_top_stng icon_btn_adj" data-bs-toggle="modal"
                                    data-bs-target="#change_amount">
                                    Change </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <div class=" flex-columns flex-setting">
                    <div class="inline_block_adj show_rows_adj">
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Show Rows :</label>
                        <select class="custom-select my-1 show_rows_count" id="inlineFormCustomSelectPref">
                            <option selected>30</option>
                            <option value="1">50</option>
                            <option value="2">60</option>
                            <option value="3">70</option>
                        </select>
                    </div>
                    <div class="show_rows_adj margin_top">
                        <nav aria-label="Page navigation example ">
                            <ul class="pagination">
                                <li class="page-item "><a class="page-link active" href="#">Prev</a></li>
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
<div class="modal fade" id="payroll_setting" tabindex="-1" aria-labelledby="change_amount" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payroll Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <form>
                        <div class="col-sm-12">

                            <label for="effective_date">Effective Date :</label>

                        </div>
                        <div class="col-sm-12">
                            <input class="date_adj" type="date" id="effective_date" name="birthday">
                        </div>
                        <div class="col-sm-12">
                            <label class="" for="inlineFormSelectPref">Payroll : </label>

                        </div>
                        <div class="col-sm-12">
                            <select class="form-select date_adj select_adj" id="inlineFormSelectPref">
                                <option selected> Weekly </option>
                                <option value="1">Monthly</option>
                                <option value="2">Yearly</option>

                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  default_orange_button" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn  default_orange_button">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="change_amount" tabindex="-1" aria-labelledby="change_amount" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Amount</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form>
                        <div class="col-sm-12">
                            <label for="changed_amount" class="form-label">Change Amount</label>
                            <input type="number" id="changed_amount" class="form-control">
                        </div>
                        <div class="col-sm-12">
                            <label for="reason" class="form-label">Reason</label>
                            <textarea class="form-control" id="reason" rows="3"></textarea>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  default_orange_button" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn  default_orange_button">Save changes</button>
            </div>
        </div>
    </div>
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