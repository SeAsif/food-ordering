<?
	$this->load->view("restaurantportal/header_view");
	$this->load->view("restaurantportal/sidepanel_view");
?>

<style>
.my_loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1234;
}

#file_loader {
    background: black none repeat scroll 0 0;
    display: none;
    height: 100%;
    left: 0;
    opacity: 0.7;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 9;
    display: block;
    height: 1353px;
}

.loader-icon-box {
    position: absolute;
    top: 50%;
    left: 50%;
    width: auto;
    z-index: 9999;
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
}

.loader-text {
    display: inline-block;
    padding: 28px 10px;
    color: #000;
    background-color: #e9e9e9;
    border-radius: 5px;
    text-align: center;
    font-weight: 600;
    width: 500px;
    display: block;
    margin-top: 35px;
}

.logo {
    width: auto;
    height: auto;
    text-align: center;
}

.logo img {
    display: inline-block;
}

.QR_code_holder {
    width: auto;
    height: auto;
    text-align: center;
}

.QR_code_btn_holder {
    width: auto;
    height: auto;
    text-align: center;
}

.QR_code_btn_holder button {
    background: #F36737;
    color: #fff;
    width: 124px;
    padding: 9px 0px;
    border-radius: 5px;
    border: 0px;
    font-weight: 400;
}

.QR_code_btn_holder a {
    background: #F36737;
    color: #fff;
    width: 124px;
    padding: 9px 0px;
    border-radius: 5px;
    border: 0px;
    display: inline-block;
    font-weight: 400;
}

.QR_code_holder img {
    display: inline-block;
    width: 150px;
    height: 150px;
}

.restaurant_text p {
    display: block;
}

.restaurant_text p {
    color: #F36737;
    font-size: 28px;
    margin: 0px;
    padding: 12px 0px;
}

#QR_table_no {
    font-size: 24px;
}

.QR_link {
    color: #888888;
}

#QR_Note {
    color: #000;
    font-size: 38px;
    font-weight: 800;
    margin: 0px;
}

.powered_by {
    width: auto;
    height: auto;
    text-align: center;
    margin-top: 8px;
    padding-top: 12px;
}

.powered_by_new {
    width: auto;
    height: auto;
    border-top: 2px dashed #888888;
    text-align: center;
    margin-top: 8px;
    padding-top: 12px;
}

@media print {}

.powered_by img {
    width: 30px;
    height: 30px;
}

.powered_by span {
    color: #000;
    position: relative;
    top: 0px;
    right: -9px;
}

.top_popup_close_button {
    float: right;
    background: transparent;
    border: none;
    color: #fff;
    font-size: 28px;
}
</style>
<?
$this->load->view("restaurantportal/top_bar");
?>
<div class="title_bar">
    <h1>Generate QR Code</h1>
</div>
<div class="mid-right">
    <?
        	if (isset($success["msg"])) {
      	?>
    <div class="ui-widget">
        <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
            <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                <strong><?= $success["msg"] ?></strong>
            </p>
        </div>
    </div>
    <?
            }
      	?>

    <br />
    <div class="ui-widget" id="table_no_required" style="display: none;">
        <div class="ui-state-error ui-corner-all" id="table_no_required_text"
            style="padding: 0 .7em; font-size: 14px; line-height: 24px;">

        </div>
    </div>

    <br class="clear" />
    <br />
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="password">
        <tr>
            <td style="width:20%;"><strong>Enter Table/Room</strong></td>
            <td>
                <input name="table_number" id="table_number" type="text" class="form-control qr_responsive w-50" />
                <input name="restaurant_id" id="restaurant_id" type="hidden" value="<?php echo $restaurantID; ?>" />
                <input name="restaurant_name" id="restaurant_name" type="hidden"
                    value="<?php echo $restaurant_name; ?>" />
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <a href="javascript:void(null);" onclick="generate_qr_code();" class="orange_btn btn text-white"
                    style="margin-right:10px;"><span>Generate</span></a>
        </tr>
    </table>
</div>

<!-- Loader Start -->
<div id="QR_code_loader" class="text-center my_loader" style="display: none;">

    <div id="file_loader" class="file_loader">
    </div>
    <div class="loader-icon-box">
        <button style="margin-right: -22px;margin-top: 4px;" type="button"
            class="close_qr_popup top_popup_close_button"><span>&times;</span></button>

        <div class="loader-text" id="loader_text_div">

            <div class="logo">
                <img src="<?= !empty($this->session->userdata('restaurant')['logo']) ? base_url() . "uploads/restaurant/logo/" . $this->session->userdata('restaurant')['logo'] : base_url() . "images/upload-logo01.jpg" ?>"
                    class="rounded-circle" width="108" height="108">
                <!-- <img src="<?= base_url() ?>uploads/restaurant/logo/new_logo.png" /> -->
            </div>
            <div class="restaurant_text">
                <p id="QR_restaurant_name">
                    Just Turkey Restaurant
                </p>
            </div>
            <div>
                <p id="QR_Note">
                    SCAN QR CODE <br> TO SEE THE MENU
                </p>
                <p id="QR_table_no">

                </p>
                <div class="QR_code_holder">
                    <img id="QR_code_image" src="<?= base_url() ?>uploads/restaurant/logo/new_logo.png" />
                </div>
                <p class="QR_link">
                    You can also visit at <span class="menu-url"></span>
                </p>
                <div class="powered_by">
                    <img src="<?= base_url() ?>uploads/restaurant/logo/new_logo.png" /><span>Powered by
                        waivedelivery.com</span>
                </div>
                <div class="QR_code_btn_holder powered_by_new">

                    <a href="<?= base_url() . 'restaurantorders/print_qr_code' ?>" id="print_btn_url"
                        class="close_qr_popup" target="_blank">Print</a>
                    <button onclick="download_QR_code();">Download</button>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Loader End -->


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/kendoUI.min.js"></script>

<script language="javascript">
function generate_qr_code() {
    var QRC_url = '<?= base_url('restaurantorders/qr_code_ajax_handler') ?>';
    var table_number = $("#table_number").val();
    var restaurant_id = $("#restaurant_id").val();
    var restaurant_name = $("#restaurant_name").val();
    //
    var print_QRC_url = '<?= base_url('restaurantorders/print_qr_code/') ?>' + table_number;

    // if (table_number == undefined || table_number == 0 || table_number == '') {
    // 	$("#table_no_required_text").text("Please enter table number.");
    // 	$("#table_no_required").show();
    // } else 
    // if (table_number != '' && !/^[0-9]+$/.test(table_number)) {
    // 	$("#table_no_required_text").text("Only number are accepted.");
    // 	$("#table_no_required").show();
    // } else {
    $("#table_no_required").hide();
    var megaOBJ = {};
    megaOBJ.table_number = table_number;
    megaOBJ.restaurant_id = restaurant_id;

    xhr = $.post(QRC_url, megaOBJ, function(resp) {
        xhr = null;

        $("#QR_restaurant_name").text(restaurant_name);
        //
        if (table_number != '') {
            $("#QR_table_no").text(table_number);
        }
        //
        $("#QR_code_image").attr("src", resp.QRCode);
        //
        $("#print_btn_url").attr("href", print_QRC_url);
        $(".menu-url").text(resp.url_path);
        $("#QR_code_loader").show();
    });
    //}


}

function download_QR_code() {
    $(".QR_code_btn_holder").hide();
    $(".download_QR_code").css("border-top", "none");
    var draw = kendo.drawing;
    draw.drawDOM($("#loader_text_div"), {
            avoidLinks: false,
            paperSize: "auto",
            multiPage: true,
            margin: {
                bottom: "2cm"
            },
            scale: 0.8
        })
        .then(function(root) {
            return draw.exportPDF(root);
        })
        .done(function(data) {
            var pdf = data;
            var table_number = $("#table_number").val();
            var restaurant_name = $("#restaurant_name").val();
            var pdf_name = restaurant_name.replace(' ', '_') + "_table_number#" + table_number + ".pdf";

            kendo.saveAs({
                dataURI: pdf,
                fileName: pdf_name,
            });
            $(".QR_code_btn_holder").show();
            $("#QR_code_loader").hide();
        });
}

function print_QR_code() {
    $(".QR_code_btn_holder").hide();
    var draw = kendo.drawing;
    draw.drawDOM($("#loader_text_div"), {
            avoidLinks: false,
            paperSize: "A4",
            multiPage: true,
            margin: {
                bottom: "2cm"
            },
            scale: 0.8
        })
        .then(function(root) {
            return draw.exportPDF(root);
        })
        .done(function(data) {
            var pdf = data;
            let pdfWindow = window.open("");

            pdfWindow.document.write(
                "<html><head></head><body><iframe width='100%' height='100%' frameBorder='0' src='" +
                pdf + "'#toolbar=0></iframe></body></html>"
            );

            pdfWindow.document.close();

            // setTimeout(() => { 
            //        pdfWindow.focus(); 
            //        pdfWindow.print();
            //    }, 2000);

            $(".QR_code_btn_holder").show();
            $("#QR_code_loader").hide();
        });

}

$(".close_qr_popup").on('click', function() {
    $("#QR_code_loader").hide();
});
</script>

<?
	$this->load->view("restaurantportal/footer_view");
?>