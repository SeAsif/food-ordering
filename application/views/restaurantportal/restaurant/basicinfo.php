<?


$this->load->view("restaurantportal/header_view");

$this->load->view("restaurantportal/sidepanel_view");

echo form_open(base_url() . 'restaurantsettings/basicinfo');
?>
<?
$this->load->view("restaurantportal/top_bar");
?>

<div class="alert alert-success" id="upload_banner_succcess" role="alert" style="display: none;">

</div>

<div class="alert alert-danger" id="upload_banner_error" role="alert" style="display: none;">

</div>

<style>
    .upload_bannar {
        height: 39.5px;
        margin-left: 33px;
        padding: 9.5px 37px 10px;
        background-color: #d6d5d5;
        color: #ffffff;
    }

    .upload_bannar:hover {
        color: white !important;
    }

    .banner_img {
        margin: 12px 0px;
        border: 2px solid #f36737;
    }

    .upload_restaurant_banner {
        border: 2px dashed #fd7e14;
        border-radius: 12px;
        padding: 8px;
    }

    .upload_bannar_btn {
        background: #fd7e14;
        color: #fff;
        border-radius: 11px;
        line-height: 18px;
    }

    #selected_banner {
        width: 400px;
        height: 300px;
    }

    .csIPLoader {
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        width: 100%;
        background: rgba(255, 255, 255, .9);
        z-index: 99;
    }

    .csIPLoader i {
        position: relative;
        top: 50%;
        left: 50%;
        font-size: 60px;
        color: #000000;
        /* color: #81b431; */
        transform: translate(-50%, -50%);
    }
</style>
<div class="title_bar">
    <h1>Basic Info</h1>
</div>
<div class="title_bar content">
    <?
    $this->load->view("restaurantportal/messages");
    ?>
    <div class="row justify-content-center">

        <div class="col-lg-12 col-xl-12 col-md-12 col-12">
            <div class="upload_restaurant_banner">
                <div style="display: none" class="csIPLoader jsIPLoader" data-page="approver"><i class="fad fa-sync fa-spin"></i></div>
                <div class="row">
                    <div class="col-lg-6 col-xl-6 col-md-6 col-12">
                        <span class="notify_text notify_text_new" style="margin-left: 0px;">
                            1) Only JPG, GIF or PNG.
                            <br>
                            2) Image size is less then 2MB.
                            <br>
                            3) Dimensions less then 1920x300.
                        </span>
                        <br>
                        <label class="logo_text">Upload Restaurant Banner <span id="upload_banner_hint">(Web Devices)</span></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" checked="checked" name="banner_type" value="desktop">
                            <label class="form-check-label" for="Desktop">Desktop</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="banner_type" value="mobile">
                            <label class="form-check-label" for="mobile">Mobile</label>
                        </div>
                        <div class="inline_form_adj">
                            <label class="file width_mob_adj">
                                <input type="file" class="width_mob_adj" name="logo" id="upload_banner" aria-label="File browser example" onchange="check_banner_image('upload_banner')">
                                <span class="file-custom span_adj" id="name_upload_banner">Choose file</span>
                            </label>
                            <a href="javascript:;" class="upload_bannar upload_bannar_btn" id="yip" style="display: none">Upload</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 col-md-6 col-12">
                        <div class="top_adj text_center_adj" style="display: none">
                            <p class="">New Selected Banner</p>
                            <img id="selected_banner" class="figure-img img-fluid rounded" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .image_holder {
                position: relative;
                width: 200px;
                height: 200px;
                border-radius: 50%;
                display: inline-block;
                margin-right: 20px;
                margin-top: 20px;
                margin-bottom: 20px;
            }

            .image_holder img {
                object-fit: cover;
                position: absolute;
                width: 100%;
                height: 100%;
                border-radius: 50%;
                margin: 0;
            }

            .image_holder i.fa.fa-times {
                position: absolute;
                top: 5%;
                right: 5%;
                color: #f36737;
                z-index: 1;
                font-size: 20px;
                opacity: 1;
                font-weight: bold;
                cursor: pointer;
            }

            #restaurant_loader {
                position: absolute;
                top: 0;
                right: 0;
                left: 0;
                bottom: 0;
                width: 100%;
                background: rgba(255, 255, 255, .9);
                z-index: 99;
                    text-align: center;
                padding-top: 450px;
                font-size: 50px;
            }
        </style>
        <div class="col-lg-12 col-xl-12 col-md-12 col-12">
            <?php if (!empty($banner)) { ?>
                <div class="image_holder" data-to-delete="web">
                    <i class="fa fa-times"></i>
                    <img src="<?= base_url() . "uploads/restaurant/banner/" . $banner ?>" class="img-fluid banner_img" alt="Cinque Terre 1">
                </div>
            <?php } ?>

            <?php if (!empty($mobile_banner)) { ?>
                <div class="image_holder" data-to-delete="mobile">
                    <i class="fa fa-times"></i>
                    <img src="<?= base_url() . "uploads/restaurant/banner/" . $mobile_banner ?>" class="img-fluid banner_img" alt="Cinque Terre 2">
                </div>
            <?php } ?>
        </div>

        <form>
            <div class="col-sm-12 col_mrg_btm">
                <div class="form-check">
                    <input class="form-check-input checkbox_adj" name="allow_banner" type="checkbox" value="Yes" <?= ($restaurant["allow_banner"] == "Yes") ? 'checked="checked"' : '' ?> />
                    <label class="form-check-label " for="flexCheckDefault">
                        <b>Show Banner on Restauran Portal</b>
                    </label>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6 col-md-6 col-12">
                <div class="form-group">
                    <label for="restaurant_name" class="form-label">Restaurant Name</label>
                    <input type="restaurant_name" class="form-control" name="restaurant_name" aria-describedby="emailHelp" value="<?= $restaurant["restaurant_name"] ?>">
                </div>
            </div>
            <div class="col-lg-6 col-xl-6 col-md-6 col-12">
                <div class="form-group">
                    <label for="delivery_time_before" class="form-label">Display orders pending in Minutes</label>
                    <input type="text" class="form-control" name="delivery_time_before" aria-describedby="emailHelp" value="<?= $restaurant["delivery_time_before"] ?>">
                </div>
            </div>
            <div class="col-lg-12 col-xl-12 col-md-12 col-12 textarea_adj">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">About Restaurant</label> <span class="span_text_adj">MAX 1000 Characters</span>
                    <textarea class="form-control" rows="5" name="restaurant_details"><?= $restaurant["restaurant_details"] ?></textarea>
                </div>
            </div>

            <div class="col-lg-12 col-xl-12 col-md-12 col-12">

                <input type="submit" class="btn  btn_adj" value="Save">

            </div>
        </form>
    </div>
</div>

</form>

<div style="display: none" id="restaurant_loader" data-page="approver"><i class="fad fa-sync fa-spin"></i></div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $('input[type=radio][name=banner_type]').change(function() {
        if (this.value == 'desktop') {
            $("#upload_banner_hint").text('(Web Devices)');
        } else if (this.value == 'mobile') {
            $("#upload_banner_hint").text('(Mobile Devices)');
        }
    });

    function check_banner_image(val) {
        var fileName = $("#" + val).val();

        if (fileName.length > 0) {
            $('#name_' + val).html(fileName.substring(0, 45));
            var ext = fileName.split('.').pop();
            var ext = ext.toLowerCase();

            if (val == 'upload_banner') {
                if (ext != "jpg" && ext != "jpe" && ext != "jpeg" && ext != "png" && ext != "gif") {
                    $("#" + val).val(null);
                    alertify.alert("Warning", "Please select a valid image format.");
                    $('#name_' + val).html('<p class="red">Only (.jpg, .gif, .png) allowed!</p>');
                    $('.upload_bannar_btn').hide();
                    $('.text_center_adj').hide();
                    return false;
                } else {
                    var file_size = Number(($("#" + val)[0].files[0].size / 1024 / 1024).toFixed(2));
                    var image_size_limit = Number('2.00');

                    if (image_size_limit < file_size) {
                        $("#" + val).val(null);
                        alertify.alert("Warning", 'The uploaded image is too long, You can upload image up to 2MB.');
                        $('#name_' + val).html('');
                        $('.upload_bannar_btn').hide();
                        $('.text_center_adj').hide();
                        return false;
                    } else {
                        var selected_file = fileName;
                        var original_selected_file = selected_file.substring(selected_file.lastIndexOf('\\') + 1, selected_file.length);
                        $('#name_' + val).html(original_selected_file);
                        $('.upload_bannar_btn').show();
                        $('.text_center_adj').show();
                        var output = document.getElementById('selected_banner');
                        output.src = URL.createObjectURL($("#" + val)[0].files[0]);
                        output.onload = function() {
                            URL.revokeObjectURL(output.src) // free memory
                        }
                        return true;
                    }

                }
            }
        } else {
            alertify.alert("Warning", "No image selected");
            $('#name_' + val).html('<p class="red">Please select image</p>');
            $('.upload_bannar_btn').hide();
            $('.text_center_adj').hide();
            return false;
        }
    }

    $("#yip").on("click", function() {
        var message = '';
        var flag = 0;

        var fileName = $("#upload_banner").val();

        if (fileName.length > 0) {
            $('#upload_banner').html(fileName.substring(0, 45));
            var ext = fileName.split('.').pop();
            var ext = ext.toLowerCase();


            if (ext != "jpg" && ext != "jpe" && ext != "jpeg" && ext != "png" && ext != "gif") {

                message = 'Please select a valid image format.';
                flag = 1;
            } else {
                var file_size = Number(($("#upload_banner")[0].files[0].size / 1024 / 1024).toFixed(2));
                var image_size_limit = Number('2.00');
                if (image_size_limit < file_size) {
                    message = 'The uploaded image is too long, You can upload image up to 2MB.';
                    flag = 1;
                }
            }
        } else {
            message = 'Please select image to upload';
            flag = 1;
        }


        if (flag == 1) {
            $("#upload_banner_error").show();
            $("#upload_banner_error").html(message);
        } else {
            $('.upload_bannar_btn').hide();
            $('.jsIPLoader').show();
            DoUpload();
        }

    });

    function DoUpload() {

        var file_data = $('#upload_banner').prop('files')[0];
        var upload_banner_type = $('input[name="banner_type"]:checked').val();

        var form_data = new FormData();
        form_data.append('docs', file_data);
        form_data.append('id', <?php echo $restaurant['id']; ?>);
        form_data.append('upload_type', upload_banner_type);

        console.log(form_data);

        $('#yip').addClass('disabled-btn');
        $('#yip').prop('disabled', true);
        $.ajax({
            url: '<?php echo base_url('restaurantsettings/upload_banner') ?>',
            cache: false,
            contentType: false,
            processData: false,
            type: 'post',
            data: form_data,
            success: function(data) {
                $('#yip').removeClass('disabled-btn');
                $('#yip').prop('disabled', false);
                $("#upload_banner_succcess").show();
                $("#upload_banner_succcess").html('New banner has been uploaded successfully');
                setTimeout(function() {
                    window.location = window.location.href;
                }, 3000);

            },
            error: function() {}
        });
    }

    $(".image_holder").on('click', function(){
        $("#restaurant_loader").show();
        var banner_type = $(this).attr('data-to-delete');
        //
        var form_data = new FormData();
        //
        form_data.append('action', 'delete_restaurant_banner');
        form_data.append('banner_type', banner_type);

        $.ajax({
            url: '<?php echo base_url("restaurantsettings/handler"); ?>',
            cache: false,
            contentType: false,
            processData: false,
            type: 'post',
            data: form_data,
            success: function(response){
                $("#restaurant_loader").hide(); 

                if (response.status != "error") {
                    alertify.alert("Success",response.message, function(){
                        document.location.href = '<?= base_url("restaurantsettings/basicinfo") ?>';
                    });
                } else {
                    alertify.alert("Error",response.message);
                }
            },
            error: function(){
            }
        });
    });
</script>

<?
$this->load->view("restaurantportal/footer_view");
?>