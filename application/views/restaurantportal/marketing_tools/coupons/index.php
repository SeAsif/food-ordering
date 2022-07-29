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
        Coupons
    </h1>
    <a href="<?= base_url() . "marketingtools/create_coupon"; ?>" type="button" class="btn opr_btn_adj ">
        Add a Coupon
    </a>
</div>
<div class="title_bar flexable" id="return_message" style="display:none"></div>
<div class=" title_bar content employe_table">
    <?
            $this->load->view("restaurantportal/messages");
            ?>
    <div class="card card_width ">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th scope="col">Coupon Code</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Never Expires</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <? 
                    if(!empty($coupons)){
                        foreach($coupons as $key=>$value){
                    ?>

                            <tr>
                                <td><? echo $value->code;?></td>
                                <?php $symbol = $value->discount_type == 'Naira' ? '₦' : '%' ?>
                                <td><? echo $value->discount.' '.$symbol;?></td>
                                <?php $is_default = $value->is_default == 1 ? 'Yes' : 'No' ?>
                                <td><?php echo $is_default; ?></td>
                                <?php if ($value->is_default == 0) { ?>
                                    <td><?php echo date('M d Y, D', strtotime($value->start_date)); ?></td>
                                    <td><?php echo date('M d Y, D', strtotime($value->end_date)); ?></td>
                                <?php } else { ?>
                                    <td><?php echo '---' ?></td>
                                    <td><?php echo '---'; ?></td>
                                <?php } ?>

                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="<?= base_url() . "marketingtools/edit_coupon/".$value->id; ?>" style=" background-color: #5dcaca; " class="btn margin_top_stng icon_btn_adj"><i class="fas fa-edit icon_margin"></i> Edit</a>
                                        <? echo $value->status=="Active" ? '<button class="btn margin_top_stng icon_btn_adj" onclick="open_model_update_status('.$value->id.')"><i class="fa fa-ban icon_margin"></i> Inactive</button>':'<button class="disable-active btn margin_top_stng icon_btn_adj" onclick="open_model_update_status('.$value->id.')">Active</button>';?>
                                        <button style="background-color: #F7665E;" onclick="open_model('<? echo $value->id;?>')" class="btn icon_btn_adj"><i class=" fa fa-trash icon_margin"></i> Delete</button>
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

<!-- Start Delete Popup Window Here -->
<div class="modal fade" id="delete_hour" tabindex="-1" aria-labelledby="delete_hourLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="submit_form" action="javascript: void(0)">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete_hourLabel">Delete Coupon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <strong>Are you want to delete Coupon </strong>
                </div>
                <div class="title_bar flexable" id="return_message_delete" style="display:none"></div>
                <div class="modal-footer-new">
                    <input type="hidden" name="row_id" id="row_id" />
                    <button type="submit" class="btn modal_btn_width text-white modal_btn_one"
                        onclick="delete_row()">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Delete Popup Window Here -->






<!-- Start update_status Popup Window Here -->
<div class="modal fade" id="update_status" tabindex="-1" aria-labelledby="delete_hourLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form id="update_submit_form" action="javascript: void(0)">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete_hourLabel">Update Coupon Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <strong>Are you want to Update Coupon Status </strong>
                </div>
                <div class="title_bar flexable" id="return_message_update" style="display:none"></div>
                <div class="modal-footer-new">
                    <input type="hidden" name="row_id" id="row_id_update" />
                    <button type="submit" class="btn modal_btn_width text-white modal_btn_one" onclick="update_row()">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End update_status Popup Window Here -->

</div>
<!-- End Mid Right -->
<script>
function open_model(id) {
    $("#delete_hour").modal('show');
    $("#row_id").val(id);
}


function open_model_update_status(id){
$("#update_status").modal('show');
$("#row_id_update").val(id);   
}

function update_row(){
    var formData = $("#update_submit_form").serialize();

$.ajax({
type: 'POST',
url: '<?= base_url() . "marketingtools/update_coupon_status" ?>',
data: formData,
success: function(data) {
    console.log(data)
    if (data.status == "success") {
        var return_message = '<div class="alert alert-success" role="alert">' + data
            .message + '</div>';
        $("#return_message_update").show();
        $("#return_message_update").append(return_message);
        $("#delete_hour").modal('hide');
        setTimeout(() => {
            window.location.href =
                "<?= base_url() . "marketingtools/coupons"; ?>"
        }, 1000);
    } else {
        var return_message = '<div class="alert alert-danger" role="alert">' + data
            .message + '</div>';
        $("#return_message_update").show();
        $("#return_message_update").append(return_message);
        setTimeout(() => {
            $("#return_message_update").hide();
        }, 1000);
    }
},
complete: function() {
    $('body, html').animate({
        scrollTop: $('#return_message_update').top
    }, 'slow');
}


});   
}
function  delete_row(){
  
    var formData = $("#submit_form").serialize();

    $.ajax({
        type: 'POST',
        url: '<?= base_url() . "marketingtools/delete_coupon" ?>',
        data: formData,
        success: function(data) {
            console.log(data)
            if (data.status == "success") {
                var return_message = '<div class="alert alert-success" role="alert">' + data
                    .message + '</div>';
                $("#return_message_delete").show();
                $("#return_message_delete").append(return_message);
                $("#delete_hour").modal('hide');
                setTimeout(() => {
                    window.location.href =
                        "<?= base_url() . "marketingtools/coupons"; ?>"
                }, 1000);
            } else {
                var return_message = '<div class="alert alert-danger" role="alert">' + data
                    .message + '</div>';
                $("#return_message_delete").show();
                $("#return_message_delete").append(return_message);
                setTimeout(() => {
                    $("#return_message_delete").hide();
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
</script>

<?
   $this->load->view("restaurantportal/footer_view");
   ?>