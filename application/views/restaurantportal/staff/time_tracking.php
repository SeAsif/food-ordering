<?
	$this->load->view("restaurantportal/header_view");
	$this->load->view("restaurantportal/sidepanel_view");
?>



<?
$this->load->view("restaurantportal/top_bar");
?>
<style>
.subscriptional_info {
    padding: 15px 30px;
    border-radius: 20px;
    box-shadow: 0 0 8px #f36737;
    margin-bottom: 40px;
    margin-top: 24px;
}

.plan_card {
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0px 0px 20px 5px rgba(0, 0, 0, .1);
    margin-bottom: 16px;
    min-height: 300px;
}

.plan_card h2 {

    color: #20c997;
    font-weight: 900;
}

.clock {
    text-align: center;
}

.time_log h2 {
    text-align: center;
}

.plan_card h3 {

    margin-top: 18px
}

.cr_acc {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
}

.contact_info {
    padding-left: 188px;
    display: block;
}

.time_tracking_card {
    border-radius: 20px 20px 20px 20px !important;
}
</style>
<div class="title_bar flex-columns">
    <h1>Time Tracking</h1>
</div>
<div class="title_bar content no_border">
    <?
$this->load->view("restaurantportal/messages");
?>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-12">
            <section id="advert_pckg" class="advert_sect font_rlw">
                <div class="container">
                    <div class="row">
                        <?php if($this->session->flashdata('message')){ ?>
                        <div class="flash_error_message">
                            <div class="alert alert-info alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <?php echo $this->session->flashdata('message');?>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="col-lg-6 col-sm-6 col-md-6 col-12">
                            <div class="plan_card time_log">
                                <?php if ($perform_action == "insert_log") {  ?>
                                <h2>Today Last Entry</h2>
                                <h3>Date:
                                    <?php echo !empty($log_data) ? date('m/d/Y', strtotime($log_data['date'])) : 'N/A'; ?>
                                </h3>
                                <h3>Check In:
                                    <?php echo !empty($log_data) ? date('h:i A', strtotime($log_data['check_in'])) : 'N/A'; ?>
                                </h3>
                                <h3>Check Out:
                                    <?php echo !empty($log_data) ? date('h:i A', strtotime($log_data['check_out'])) : 'N/A'; ?>
                                </h3>
                                <?php } else { ?>
                                <h2>Current Entry</h2>
                                <h3>Date: <?php echo date('m/d/Y', strtotime($log_data['date'])); ?></h3>
                                <h3>Check In: <?php echo date('h:i A', strtotime($log_data['check_in'])); ?></h3>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6 col-12">
                            <div class="plan_card clock">
                                <canvas id="canvas" width="200" height="200"
                                    style="background-color:transparent"></canvas>
                                <form action="<?php echo base_url('staffTracking'); ?>" method="post"
                                    class="float-left w-100 position-relative mt-2">
                                    <input type="hidden" name="perform_action" value="<?php echo $perform_action; ?>" />
                                    <input type="hidden" name="tracking_id" value="<?php echo $latest_log_id; ?>" />
                                    <?php if ($allow_tracking == 'yes') { ?>
                                    <?php if ($perform_action == "insert_log") { ?>
                                    <button type="submit" class="orange_btn btn text-white cr_acc">
                                        Check In
                                    </button>
                                    <?php } else { ?>
                                    <button type="submit" class="orange_btn btn text-white cr_acc">
                                        Check Out
                                    </button>
                                    <?php } ?>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div id="" class="container">
                <div class="tab-content clearfix">
                    <div class="tab-pane active" id="1a">
                        <div class="card time_tracking_card">
                            <div class="card-body p-4">
                                <div class="col-sm-12">
                                    <div class="table-responsive variant_fixed_table">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Check In</th>
                                                    <th scope="col">Check Out</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($time_tracking)) { ?>
                                                <?php foreach ($time_tracking as $key => $time) { ?>
                                                <tr>
                                                    <td><?php echo $key + 1; ?></td>
                                                    <td><?php echo date('M d Y, D', strtotime($time['date'])); ?></td>
                                                    <td><?php echo date('h:i A', strtotime($time['check_in'])); ?></td>
                                                    <td><?php echo !empty($time['check_out']) ? date('h:i A', strtotime($time['check_out'])) : 'N/A'; ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                <?php } else { ?>
                                                <tr>
                                                    <td colspan="4" class="text-center">
                                                        No Previous Track Found!
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <div class="inline_flex_adj">
                                            <div class="show_rows_adj">
                                                <ul class="pagination"><?= $paginationLinks ?></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    var allow_tracking = '<?php echo $allow_tracking ?>';
    alertify.set('notifier', 'position', 'top-left');

    if (allow_tracking == 'no') {
        var message = '<?php echo $message ?>';
        alertify.warning(message, 0);
    }

});
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var radius = canvas.height / 2;
ctx.translate(radius, radius);
radius = radius * 0.90
setInterval(drawClock, 1000);

function drawClock() {
    drawFace(ctx, radius);
    drawNumbers(ctx, radius);
    drawTime(ctx, radius);
}

function drawFace(ctx, radius) {
    var grad;
    ctx.beginPath();
    ctx.arc(0, 0, radius, 0, 2 * Math.PI);
    ctx.fillStyle = 'white';
    ctx.fill();
    grad = ctx.createRadialGradient(0, 0, radius * 0.95, 0, 0, radius * 1.05);
    grad.addColorStop(0, '#333');
    grad.addColorStop(0.5, 'white');
    grad.addColorStop(1, '#333');
    ctx.strokeStyle = grad;
    ctx.lineWidth = radius * 0.1;
    ctx.stroke();
    ctx.beginPath();
    ctx.arc(0, 0, radius * 0.1, 0, 2 * Math.PI);
    ctx.fillStyle = '#333';
    ctx.fill();
}

function drawNumbers(ctx, radius) {
    var ang;
    var num;
    ctx.font = radius * 0.15 + "px arial";
    ctx.textBaseline = "middle";
    ctx.textAlign = "center";
    for (num = 1; num < 13; num++) {
        ang = num * Math.PI / 6;
        ctx.rotate(ang);
        ctx.translate(0, -radius * 0.85);
        ctx.rotate(-ang);
        ctx.fillText(num.toString(), 0, 0);
        ctx.rotate(ang);
        ctx.translate(0, radius * 0.85);
        ctx.rotate(-ang);
    }
}

function drawTime(ctx, radius) {
    var now = new Date();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    //hour
    hour = hour % 12;
    hour = (hour * Math.PI / 6) +
        (minute * Math.PI / (6 * 60)) +
        (second * Math.PI / (360 * 60));
    drawHand(ctx, hour, radius * 0.5, radius * 0.07);
    //minute
    minute = (minute * Math.PI / 30) + (second * Math.PI / (30 * 60));
    drawHand(ctx, minute, radius * 0.8, radius * 0.07);
    // second
    second = (second * Math.PI / 30);
    drawHand(ctx, second, radius * 0.9, radius * 0.02);
}

function drawHand(ctx, pos, length, width) {
    ctx.beginPath();
    ctx.lineWidth = width;
    ctx.lineCap = "round";
    ctx.moveTo(0, 0);
    ctx.rotate(pos);
    ctx.lineTo(0, -length);
    ctx.stroke();
    ctx.rotate(-pos);
}
</script>
<?
$this->load->view("restaurantportal/footer_view");
?>