<?
$this->load->view("restaurantportal/header_view");
$this->load->view("restaurantportal/sidepanel_view");
?>
<?
$this->load->view("restaurantportal/top_bar");
?>
<div class="title_bar">
    <h1>Logo / Slogan</h1>
</div>
<div class="title_bar content">
    <?
$this->load->view("restaurantportal/messages");
?>

    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-8 col-xl-8 col-12 ">
            <div>
                <span class="notify_text notify_text_new" style="margin-left: 0px;">
                    1) Only JPG, GIF or PNG.
                    <br>
                    2) Image size is less then 2MB.
                    <br>
                    3) Dimensions less then 1920x700.
                </span>
                <br>
                <label class="logo_text">Upload New Logo</label>
                <?
					echo form_open_multipart(base_url().'restaurantsettings/logoslogan');
					?>
                <div class="inline_form_adj">

                    <label class="file width_mob_adj">
                        <input type="file" class="width_mob_adj" name="logo" aria-label="File browser example">
                        <span class="file-custom span_adj">Choose file</span>
                    </label>
                    <div>
                        <button type="submit" class="btn  upload_btn_adj">Upload</button>
                        <input type="hidden" value="logoupload" name="logoupload" />
                    </div>

                </div>
                </form>
            </div>
            <div class="top_adj text_center_adj">
                <p class="logo_text">New Uploaded Logo</p>
                <img src="<?= !empty($new_logo) ? base_url() . "uploads/restaurant/logo/" . $new_logo : base_url() . "images/current-logo01.jpg" ?>"
                    class="rounded-circle" alt="Cinque Terre" width="108" height="108">
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4 col-12">
            <div class="current_logo_adj">
                <img src="<?= ($restaurant["logo"] != "" && $restaurant["logo"] != "noimage.jpg") ? base_url() . "uploads/restaurant/logo/" . $restaurant["logo"] : base_url() . "images/current-logo01.jpg" ?>"
                    class="rounded-circle" alt="Cinque Terre" width="128.5" height="128.5">
                <p class="logo_text_color">Current Logo</p>
            </div>
        </div>


    </div>
    <?
echo form_open_multipart(base_url().'restaurantsettings/logoslogan');
?>
    <div class="row  top_adj">
        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
            <div class="form-group">
                <label class="slogan_text" for="restaurant_slogan">Restaurant Slogan </label><span
                    class="notify_text notify_text_new">Leave empty if not required.</span>
                <input type="input" class="input-top-adj form-control" name="restaurant_slogan"
                    placeholder="Slogan here" value="<?= $restaurant["restaurant_slogan"] ?>">
            </div>
            <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                <input type="hidden" name="logo" value="<?= !empty($new_logo) ? $new_logo : "" ?>" />
                <input type="submit" name="save" class="btn  btn_adj" value="Save">
            </div>

        </div>
    </div>
    </form>
</div>
<?
$this->load->view("restaurantportal/footer_view");
?>