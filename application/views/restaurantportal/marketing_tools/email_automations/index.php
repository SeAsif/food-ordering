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
<div class="title_bar flexable" id="return_message" style="display:none"></div>
<div class="title_bar content employe_table">
    <div class="card card_width ">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-10">
                    <p>Send automated email messages to your registered customers who opted to receive specials, All
                        campaigns wil l be sent out everyday at 9 AM. EST</p>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-2">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#mail_setting"
                        class="btn opr_btn_adj mail_btn_responsive mt-0">
                        Mail Server Setting
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="title_bar ">
    <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-10">
            <h1>
                My Campaigns
            </h1>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-2">
            <a href="<?= base_url('marketingtools') . "/create_campaign" ?>" type="button"
                class="btn opr_btn_adj mail_btn_responsive ">
                New Campaign
            </a>
        </div>
    </div>
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
<div class=" title_bar content employe_table" style="border-bottom:none">
    <?
            $this->load->view("restaurantportal/messages");
            ?>
    <div class="card card_width ">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table_layout_auto">
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

                        <?
                    if(!empty($email_automations)){
                        foreach($email_automations as $key=>$value){

                   ?>
                        <tr>
                            <td>
                                <? echo $value->code; ?>
                            </td>
                            <td>
                                <? echo $value->name; ?>
                            </td>
                            <td>
                                <? echo $value->start_date; ?>
                            </td>
                            <td>
                                <? echo $value->end_date; ?>

                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?= base_url() . "marketingtools/edit_campaign/".$value->id; ?>"
                                        style=" background-color: #5dcaca; " class="btn margin_top_stng icon_btn_adj"><i
                                            class="fas fa-edit icon_margin"></i> Edit</a>
                                    <!-- <button class="disable-active btn margin_top_stng icon_btn_adj">Activate</button> -->
                                    <button style="background-color: #F7665E; "
                                        onclick="open_model(<? echo $value->id; ?>)" class="btn icon_btn_adj"><i
                                            class=" fa fa-trash icon_margin"></i> Delete</button>
                                </div>

                            </td>
                        </tr>


                        <?
                        }
                    }
                    ?>


                    </tbody>
                </table>
            </div>
        </div>
        <div class="show_rows_adj">
            <ul class="pagination"><?= $links?? null ?></ul>
        </div>
    </div>
</div>

<div class="modal fade" id="mail_setting" tabindex="-1" aria-labelledby="delete_hourLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="submit_form_email_server_settings" action="javascript: void(0)">

                <input type="hidden" name="id" value="<? echo $mail_server_setting[0]->id?? null; ?>">
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

                            <input type="text" id="smtp" name="smtp_username" class="mt-2 form-control"
                                placeholder="SMTP Username"
                                value="<? echo $mail_server_setting[0]->smtp_username ?? null; ?>">


                            <!--<input type="text" id="smtp" class="mt-2 form-control" placeholder="SMTP Username">-->


                        </label>
                    </div>
                    <div class="form-group mb-3">
                        <label for="smtp_p" class="w-100">

                            <input type="password" id="smtp_p" name="smtp_password" class="mt-2 form-control"
                                placeholder="*******"
                                value="<? echo $mail_server_setting[0]->smtp_password ?? null; ?>">


                            <!--<input type="password" id="smtp_p" class="mt-2 form-control" placeholder="*******">-->


                        </label>
                    </div>
                    <div class="form-group mb-3">
                        <label for="smtp_server" class="w-100">


                            <input type="text" id="smtp_server" name="smtp_server" class="mt-2 form-control"
                                placeholder="e.g server"
                                value="<? echo $mail_server_setting[0]->smtp_server?? null; ?>">


                            <!--<input type="text" id="smtp_server" class="mt-2 form-control" placeholder="e.g server">-->


                        </label>
                    </div>
                    <div class="form-group mb-0">
                        <label for="smtp_port" class="w-100">

                            <input type="text" name="smtp_port" id="smtp_port" class="mt-2 form-control"
                                placeholder="587" value="<? echo $mail_server_setting[0]->smtp_port?? null; ?>">


                            <!--<input type="text" id="smtp_port" class="mt-2 form-control" placeholder="587">-->


                        </label>
                    </div>
                </div>
                <div class="title_bar flexable" id="return_message_m" style="display:none"></div>
                <div class="modal-footer-new">

                    <input type="submit" class="btn modal_btn_width text-white modal_btn_one" name="operation_hour_id"
                        onclick="email_server_settings()" id="operation_hour_id" value="Submit" />
                    <button type="submit" class="icon_btn_adj btn modal_btn_width text-white modal_btn_one"
                        data-bs-dismiss="modal" aria-label="Close">Cancle</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Start Delete Popup Window Here -->
<div class="modal fade" id="delete_hour" tabindex="-1" aria-labelledby="delete_hourLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="submit_form" action="javascript: void(0)">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete_hourLabel">Delete Email Campaign</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <strong>Are you want to delete Campaign </strong>
                </div>

                <div class="modal-footer-new">
                    <input type="hidden" name="row_id" id="row_id" value="">
                    <button type="submit" class="btn modal_btn_width text-white modal_btn_one"
                        onclick="delete_row()">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Delete Popup Window Here -->


</div>
<!-- End Mid Right -->


<script>
function open_model(id) {
    $("#delete_hour").modal('show');
    $("#row_id").val(id);
}

function delete_row() {

    var formData = $("#submit_form").serialize();

    $.ajax({
        type: 'POST',
        url: '<?= base_url() . "marketingtools/delete_campaign" ?>',
        data: formData,
        success: function(data) {
            console.log(data)
            if (data.status == "success") {
                var return_message = '<div class="alert alert-success" role="alert">' + data
                    .message + '</div>';
                $("#return_message").show();
                $("#return_message").append(return_message);
                $("#delete_hour").modal('hide');
                setTimeout(() => {
                    window.location.href =
                        "<?= base_url() . "marketingtools/email_automations"; ?>"
                }, 1000);
            } else {
                var return_message = '<div class="alert alert-danger" role="alert">' + data
                    .message + '</div>';
                $("#return_message").show();
                $("#return_message").append(return_message);
                setTimeout(() => {
                    $("#return_message").hide();
                }, 1000);
            }
        },
        complete: function() {
            $('body, html').animate({
                scrollTop: $('#return_message').top
            }, 'slow');
        }


    });
}



function email_server_settings() {
    var formData = $("#submit_form_email_server_settings").serialize();

    $.ajax({
        type: 'POST',
        url: '<?= base_url() . "marketingtools/email_server_settings" ?>',
        data: formData,
        success: function(data) {
            console.log(data)
            if (data.status == "success") {
                var return_message = '<div class="alert alert-success" role="alert">' + data
                    .message + '</div>';
                $("#return_message_m").show();
                $("#return_message_m").append(return_message);
                $("#delete_hour").modal('hide');
                setTimeout(() => {
                    window.location.href =
                        "<?= base_url() . "marketingtools/email_automations"; ?>"
                }, 1000);
            } else {
                var return_message = '<div class="alert alert-danger" role="alert">' + data
                    .message + '</div>';
                $("#return_message_m").empty();
                $("#return_message_m").show();
                $("#return_message_m").append(return_message);
            }
        },
        complete: function() {
            $('body, html').animate({
                scrollTop: $('#return_message').top
            }, 'slow');
        }


    });
}
</script>
<?
   $this->load->view("restaurantportal/footer_view");
   ?>