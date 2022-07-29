<?
   $this->load->view("restaurantportal/header_view");
   $this->load->view("restaurantportal/sidepanel_view");
   ?>
<?
$this->load->view("restaurantportal/top_bar");
?>

<div class="title_bar title_bar_adj">
    <h1>Add Reward</h1>
</div>
<div class="title_bar flexable" id="return_message" style="display:none"></div>
<form id="submit_form" action="javascript: void(0)">
    <div class="add_reward_main">
        <div class="row">
            <div class="col-sm-12">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label"> Title </label>
                    <input class="form-control form-control-lg" type="text" placeholder=""
                        aria-label=".form-control-lg example" name="title">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea placeholder="Describe Here" name="description" class="form-control"
                        id="exampleFormControlTextarea1" rows="6"></textarea>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label"> Points Required </label>
                    <input class="form-control form-control-lg" type="text" placeholder=""
                        aria-label=".form-control-lg example" name="points">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label"> Attach A Coupon To This Reward </label>
                    <select class="form-control form-control-lg" name="coupon_id" aria-label="Default select example">
                        <option selected>Select</option>
                        <? 
                            if(!empty($coupons)){
                                foreach($coupons as $key=>$value){
                                echo '<option value="'.$value->id.'">'.$value->code.'</option>';
                                }
                            }
                          ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-12 checbox_coloumn_margin">
                <div class="form-check">
                    <input name="pre_order" type="hidden" value="No" />
                    <input class="form-check-input checkbox_adj" name="is_redeemed" type="checkbox" value="Yes"
                        <?=($restaurant["pre_order"]=="Yes")?'checked="checked"':''?> />
                    <label class="form-check-label flex_label " style="padding-top: 5px;" for="flexCheckDefault">
                        Allow this reward to be redeemed more than once
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <input type="submit" style="padding:7px" class="btn orange_btn text-white mob_btn_adj mb-4"
                    value="Create">
                <button class="btn margin_top_stng icon_btn_adj reward_cancel_btn mob_btn_adj">
                    Cancel</button>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
$("#submit_form").submit(function(e) {
    e.preventDefault();
    var formData = $("#submit_form").serialize();

    $.ajax({
        type: 'POST',
        url: '<?= base_url() . "marketingtools/store_reward" ?>',
        data: formData,
        success: function(data) {
            console.log(data)
            if (data.status == "success") {
                var return_message = '<div class="alert alert-success" role="alert">' + data
                    .message + '</div>';
                $("#return_message").show();
                $("#return_message").append(return_message);
                setTimeout(() => {
                    window.location.href = "<?= base_url() . "marketingtools/rewards"; ?>"
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
                scrollTop: $('#return_message').top
            }, 'slow');
        }

    });
});
</script>





<?
   $this->load->view("restaurantportal/footer_view");
   ?>