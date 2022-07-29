<?
   $this->load->view("restaurantportal/header_view");
   $this->load->view("restaurantportal/sidepanel_view");
   ?>
<?
$this->load->view("restaurantportal/top_bar");
?>

<div class="title_bar title_bar_adj">
    <h1>Update Reward</h1>
</div>
<div class="title_bar flexable" id="return_message" style="display:none"></div>
<form id="submit_form" action="javascript: void(0)">
<input type="hidden" name="id" value="<? echo $reward->id;?>">
    <div class="add_reward_main">
        <div class="row">
            <div class="col-sm-12">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label"> Title </label>
                    <input class="form-control form-control-lg"  type="text" placeholder=""
                        aria-label=".form-control-lg example" name="title" value="<? echo $reward->title;?>">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea placeholder="Describe Here" name="description" class="form-control" id="exampleFormControlTextarea1"
                        rows="6"> <? echo $reward->description;?> </textarea>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label"> Points Required </label>
                    <input class="form-control form-control-lg"  type="text" placeholder=""
                        aria-label=".form-control-lg example" name="points" value="<? echo $reward->points;?>">
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
                                    if($value->id== $reward->coupon_id){
                                        echo '<option value="'.$value->id.'" selected>'.$value->code.'</option>';
                                    }else{
                                        echo '<option value="'.$value->id.'">'.$value->code.'</option>';
                                    }
                               
                                }
                            }
                          ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-12 checbox_coloumn_margin">
                <div class="form-check">
                    <input name="pre_order" type="hidden" value="No" />
                    <input class="form-check-input checkbox_adj" <? echo $reward->is_redeemed==1? 'checked':''?> name="is_redeemed" type="checkbox" />
                    <label class="form-check-label " style="padding-top: 5px;" for="flexCheckDefault">
                        Allow this reward to be redeemed more than once
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <input type="submit" style="padding:7px" class="btn orange_btn text-white mb-4" value="Create">
                <button class="btn margin_top_stng icon_btn_adj reward_cancel_btn">
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
        url: '<?= base_url() . "marketingtools/update_reward" ?>',
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