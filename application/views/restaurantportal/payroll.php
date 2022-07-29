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

<?
 if (!isset($_GET['staff'])){
    $user = FALSE; 
} else {
    $user = $_GET['staff']; 
}
if (!isset($_GET['start_date'])){
    $start_date = FALSE; 
} else {
    $start_date = $_GET['start_date']; 
} 

if (!isset($_GET['end_date'])){
    $end_date = FALSE; 
} else {
    $end_date = $_GET['end_date']; 
} 

if (!isset($_GET['show_rows'])){
    $show_rows = FALSE; 
} else {
    $show_rows = $_GET['show_rows']; 
} 
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
<div class="title_bar flexable" id="return_message" style="display:none"></div>
<div class="title_bar flexable">
    <form class="row  align-items-center" method="GET" action="<?= base_url() . "staffpayroll" ?>">
        <div class="col-sm-12 col-md-6 col-lg-4 div_inline btn_margin_bottom">
            <label class="" for="inlineFormSelectPref">Staff: </label>
            <select class="form-select date_adj select_adj" id="inlineFormSelectPref" name="staff">
                <option selected disabled>Select Staff</option>
                <? if(!empty($staff)){
                    foreach($staff as $key=>$value){
                        if($value->username==$user){
                            echo  '<option value="'.$value->username.'" selected>'.$value->username.'</option>';
                        }else{
                            echo  '<option value="'.$value->username.'">'.$value->username.'</option>';
                        }
               
                }
            }?>
            </select>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 div_inline btn_margin_bottom">
            <label for="birthday">Start: </label>
            <input class="date_adj select_background" type="date" id="start_date" name="start_date"
                value="<? echo $start_date; ?>">
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 div_inline">
            <label for="birthday">End: </label>
            <input class="date_adj select_background" type="date" id="end_date" name="end_date"
                value="<? echo $end_date; ?>">
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
                <table class="table table_layout_auto">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Start Period</th>
                            <th scope="col">End Period</th>
                            <th scope="col">Work</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Description</th>
                            <th scope="col">Changed Amount</th>
                            <th scope="col">Payable Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <? if(!empty($payrolls)){
                        foreach($payrolls as $key=>$data){?>
                        <tr>
                            <td><? echo $data->staff_name;?></td>
                            <td><? echo date('Y-F-d', strtotime($data->start_date));?></td>
                            <td><? echo date('Y-F-d', strtotime($data->end_date));?></td>
                            <td><? echo round($data->total_time,1);?></td>
                            <td>₦ <? echo ($data->total_amount).''.($data->change_amount);?></td>
                            <td><? echo $data->description;?></td>
                            <td>₦ <? echo $data->change_amount??0;?></td>
                            <td>₦ <? echo $data->payable_amount;?></td>
                            <td><? echo $data->status;?></td>
                            <td class="flex_direction">
                                <button style=" background-color: #5dcaca; " class="btn margin_top_stng icon_btn_adj" onclick="Pay('<? echo $data->id;?>')">
                                    Pay</button>
                                <!-- <button class="disable-active btn margin_top_stng icon_btn_adj">Activate</button> -->
                                <button class="btn margin_top_stng icon_btn_adj"
                                    onclick="change_amount('<? echo $data->id;?>','<? echo $data->total_amount;?>')">
                                    Change </button>
                            </td>
                        </tr>
                        <? }
                    }?>



                    </tbody>
                </table>
                <div class=" flex-columns flex-setting">
                    <? if(!empty($links)){?>
                    <div class="inline_block_adj show_rows_adj">
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Show Rows :</label>
                        <select class="custom-select my-1 show_rows_count" id="inlineFormCustomSelectPref">
                            <? foreach(rows_show() as $rows){?>
                            <? if($rows==$show_rows){?>
                            <option value="<? echo $rows; ?>" selected>
                                <? echo $rows; ?>
                            </option>
                            <?}else{?>
                            <option value="<? echo $rows; ?>">
                                <? echo $rows; ?>
                            </option>
                            <? }?>
                            <?}?>
                        </select>
                    </div>
                    <?}?>
                    <div class="show_rows_adj margin_top">
                        <nav aria-label="Page navigation example ">
                            <ul class="pagination">
                                <ul class="pagination"><?= $links?? null ?></ul>
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
                    <form id="payroll_settings" action="javascript: void(0)">
                        <div class="col-sm-12">
                            <label for="effective_date">Effective Date :</label>
                        </div>
                        <input type="hidden" name="id" value="<? echo $payroll_settings->id?? null; ?>">
                        <div class="col-sm-12">
                            <input class="date_adj" type="date" id="effective_date" name="effective_date" value="<? echo $payroll_settings->effective_date??null; ?>">
                        </div>
                        <div class="col-sm-12">
                            <label class="" for="inlineFormSelectPref">Frequency : </label>
                        </div>
                        <div class="col-sm-12">
                            <select class="form-select date_adj select_adj" id="inlineFormSelectPref" name="frequency">
                            <? $frequency=array("Weekly","Bi-Monthly","Monthly"); ?>

                                <? 
                              
                                    foreach($frequency as $data){
                                        if($data==$payroll_settings->frequency??null){
                                    echo '<option value="'.$data.'" selected>'.$data.'</option>';
                                    }else{
                                    echo '<option value="'.$data.'">'.$data.'</option>';
                                    }
                                }
                               
                               
                                ?>
                                
                               
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="title_bar flexable" id="return_message_payroll_setting" style="display:none"></div>
            <div class="modal-footer">
                <button type="button" class="btn  default_orange_button" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn  default_orange_button" id="payroll_settings_submit">Save
                    changes</button>
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
                <form id="submit_form_change_amount" action="javascript: void(0)">
                    <input type="hidden" name="id" id="row_id">
                        <div class="col-sm-12">
                            <label for="changed_amount" class="form-label">Change Amount</label>
                            <input type="number" id="changed_amount" name="change_amount" class="form-control">
                        </div>
                        <div class="col-sm-12">
                            <label for="reason" class="form-label">Reason</label>
                            <textarea class="form-control" name="description" id="reason" rows="3"></textarea>
                        </div>
                        </form>
                   
                </div>
            </div>
            <div class="title_bar flexable" id="return_message_payroll_change" style="display:none"></div>
            <div class="modal-footer">
                <button type="button" class="btn  default_orange_button" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn  default_orange_button submit_form_change_amount">Save changes</button>
            </div>
           
        </div>
    </div>
</div>
<!-- Start Delete Popup Window Here -->
<div class="modal fade" id="delete_hour" tabindex="-1" aria-labelledby="delete_hourLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
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
$(document).ready(function() {


    $("#payroll_settings_submit").click(function(e) {
        e.preventDefault();
 
            var formData = $("#payroll_settings").serialize();

            $.ajax({
                type: 'POST',
                url: '<?= base_url() . "staffpayroll/generate_payroll" ?>',
                data: formData,
                success: function(data) {
                    console.log(data)
                    if (data.status == "success") {
                        var return_message = '<div class="alert alert-success" role="alert">' + data
                            .message + '</div>';
                        $("#return_message_payroll_setting").show();
                        $("#return_message_payroll_setting").append(return_message);
                        setTimeout(() => {
                            window.location.href =
                                "<?= base_url() . "staffpayroll"; ?>"
                        }, 1000);
                    } else {
                        var return_message = '<div class="alert alert-danger" role="alert">' + data
                            .message + '</div>';
                        $("#return_message_payroll_setting").show();
                        $("#return_message_payroll_setting").append(return_message);
                        setTimeout(() => {
                            $("#return_message_payroll_setting").hide();
                        }, 5000);
                    }
                },
                complete: function() {
                    $('body, html').animate({
                        scrollTop: $('#data_picker').top
                    }, 'slow');
                
            },
            
        });
    });

    


    $(".submit_form_change_amount").click(function(){
        var formData = $("#submit_form_change_amount").serialize();

            $.ajax({
                type: 'POST',
                url: '<?= base_url() . "staffpayroll/change_amount" ?>',
                data: formData,
                success: function(data) {
                    console.log(data)
                    if (data.status == "success") {
                        var return_message = '<div class="alert alert-success" role="alert">' + data
                            .message + '</div>';
                        $("#return_message_payroll_change").show();
                        $("#return_message_payroll_change").append(return_message);
                        setTimeout(() => {
                            window.location.href =
                                "<?= base_url() . "staffpayroll"; ?>"
                        }, 1000);
                    } else {
                        var return_message = '<div class="alert alert-danger" role="alert">' + data
                            .message + '</div>';
                        $("#return_message_payroll_change").show();
                        $("#return_message_payroll_change").append(return_message);
                        setTimeout(() => {
                            $("#return_message_payroll_change").hide();
                        }, 5000);
                    }
                },
                complete: function() {
                    $('body, html').animate({
                        scrollTop: $('#data_picker').top
                    }, 'slow');
                }
            });
        })       
    })

</script>

<script type="text/javascript">
$(document).ready(function() {
    $(".search_icon").click(function() {
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();

        if (start_date != "" && end_date != "") {
            window.location.href = '<?= base_url() . "staffpayroll" ?>' + '?start_date=' + start_date +
                '&end_date=' + end_date;
        } else if (start_date != "" && end_date == "") {
            window.location.href = '<?= base_url() . "staffpayroll" ?>' + '?start_date=' + start_date +
                '&end_date=';
        } else if (start_date == "" && end_date != "") {
            window.location.href = '<?= base_url() . "staffpayroll" ?>' + '?start_date=&end_date=' +
                end_date;
        }
    })

    $("#inlineFormCustomSelectPref").change(function() {
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();

        if (start_date != "" && end_date != "") {
            window.location.href = '<?= base_url() . "staffpayroll" ?>' + '?start_date=' + start_date +
                '&end_date=' + end_date + '&show_rows=' + $(this).val();
        } else {
            window.location.href = '<?= base_url() . "staffpayroll" ?>' + '?show_rows=' + $(this).val();
        }
    });

});
</script>
<script>
function change_amount(id, amount) {
    $("#change_amount").modal("show");
    $("#row_id").val(id);
}


function Pay(id) {


    $.ajax({
        type: 'POST',
        url: '<?= base_url() . "staffpayroll/pay/" ?>' + id,
        success: function(data) {
            console.log(data)
            if (data.status == "success") {
                var return_message = '<div class="alert alert-success" role="alert">' +
                    data
                    .message + '</div>';
                $("#return_message").show();
                $("#return_message").append(return_message);
                setTimeout(() => {
                    window.location.href =
                        "<?= base_url() . "staffpayroll/"; ?>"
                }, 1000);
            } else {

                var return_message = '<div class="alert alert-danger" role="alert">' +
                    data
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
</script>




<?
   $this->load->view("restaurantportal/footer_view");
   ?>