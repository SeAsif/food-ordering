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
        Email Marketing
    </h1>
</div>
<div class="title_bar content employe_table">
    <div class="card card_width ">
        <div class="card-body p-3">
            <div class="flex">
                <p>Send automated email messages to your registered customers who opted to receive specials, All campaigns wil l be sent out everyday at 9 AM. EST</p>
                <button type="button" class="btn opr_btn_adj mt-0">
                    Mail Server Setting
                </button>
            </div>
        </div>
    </div>
</div>
<div class="title_bar title_bar_adj">
    <h1>
        My Campaigns
    </h1>
    <button type="button" data-bs-toggle="modal" data-bs-target="#mail_setting" class="btn opr_btn_adj ">
        New Campaign
    </button>
</div>
<style>
    .flex {
        display: grid;
        grid-template-columns: 75% 20%;
        column-gap: 5%;
        align-items: center;
        justify-content: center;
    }
</style>
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
                            <th scope="col">Type</th>
                            <th scope="col">Name</th>
                            <th scope="col">Condition</th>
                            <th scope="col">Period</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>500FF</td>
                            <td>Happy Birthday</td>
                            <td>21-Jan-21</td>
                            <td>21-Feb-21</td>
                            <td class="flex_direction">
                                <button style=" background-color: #5dcaca; " class="btn margin_top_stng icon_btn_adj"><i class="fas fa-edit icon_margin"></i> Edit</button>
                                <!-- <button class="disable-active btn margin_top_stng icon_btn_adj">Activate</button> -->
                                <button style="background-color: #F7665E; " data-bs-toggle="modal" data-bs-target="#delete_hour" class="btn icon_btn_adj"><i class=" fa fa-trash icon_margin"></i> Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>500FF</td>
                            <td>50.00%</td>
                            <td>21-Jan-21</td>
                            <td>21-Feb-21</td>
                            <td class="flex_direction">
                                <button style=" background-color: #5dcaca; " class="btn margin_top_stng icon_btn_adj"><i class="fas fa-edit icon_margin"></i> Edit</button>
                                <!-- <button class="disable-active btn margin_top_stng icon_btn_adj">Activate</button> -->
                                <button style="background-color: #F7665E; " data-bs-toggle="modal" data-bs-target="#delete_hour" class="btn icon_btn_adj"><i class=" fa fa-trash icon_margin"></i> Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>500FF</td>
                            <td>50.00%</td>
                            <td>21-Jan-21</td>
                            <td>21-Feb-21</td>
                            <td class="flex_direction">
                                <button style=" background-color: #5dcaca; " class="btn margin_top_stng icon_btn_adj"><i class="fas fa-edit icon_margin"></i> Edit</button>
                                <!-- <button class="disable-active btn margin_top_stng icon_btn_adj">Activate</button> -->
                                <button style="background-color: #F7665E; " data-bs-toggle="modal" data-bs-target="#delete_hour" class="btn icon_btn_adj"><i class=" fa fa-trash icon_margin"></i> Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>500FF</td>
                            <td>50.00%</td>
                            <td>21-Jan-21</td>
                            <td>21-Feb-21</td>
                            <td class="flex_direction">
                                <button style=" background-color: #5dcaca; " class="btn margin_top_stng icon_btn_adj"><i class="fas fa-edit icon_margin"></i> Edit</button>
                                <!-- <button class="disable-active btn margin_top_stng icon_btn_adj">Activate</button> -->
                                <button style="background-color: #F7665E; " data-bs-toggle="modal" data-bs-target="#delete_hour" class="btn icon_btn_adj"><i class=" fa fa-trash icon_margin"></i> Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- <div class="show_rows_adj">
            <ul class="pagination"><?= $paginationLinks ?></ul>
        </div> -->
    </div>
</div>

<div class="modal fade" id="mail_setting" tabindex="-1" aria-labelledby="delete_hourLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete_hourLabel">Mail Server Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        You may use own mail server to send out branded email and text campaigns to customers.
                    </p>
                    <div class="form-group mb-3">
                        <label for="smtp" class="w-100">
                            SMTP Username
                            <input  type="text" id="smtp" class="mt-2 form-control" placeholder="SMTP Username">
                        </label>
                    </div>
                    <div class="form-group mb-3">
                        <label for="smtp_p" class="w-100">
                            SMTP Password
                            <input  type="password" id="smtp_p" class="mt-2 form-control" placeholder="*******">
                        </label>
                    </div>
                    <div class="form-group mb-3">
                        <label for="smtp_server" class="w-100">
                            SMTP Server
                            <input  type="text" id="smtp_server" class="mt-2 form-control" placeholder="e.g server">
                        </label>
                    </div>
                    <div class="form-group mb-0">
                        <label for="smtp_port" class="w-100">
                            SMTP Port
                            <input  type="text" id="smtp_port" class="mt-2 form-control" placeholder="587">
                        </label>
                    </div>
                </div>

                <div class="modal-footer-new">
                    <input type="submit" class="btn modal_btn_width text-white modal_btn_one" name="operation_hour_id" id="operation_hour_id" value="Submit" />
                    <button type="submit" class="icon_btn_adj btn modal_btn_width text-white modal_btn_one">Cancle</button>
                </div>
            </form>
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
                    <strong>Are you want to delete Campaign </strong>
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