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

.flexable {
    display: flex;
    justify-content: space-between;
    width: 100%;
}

.btn-primary:hover {
    background-color: #f36737;
    border-color: #f36737;
}

.design_setting .input-adj {
    display: inline-block;
    width: 100px;
    /* padding: 2px 5px; */
    border-radius: 5px !important;
    box-shadow: none !important;
    background-color: #e7f1ff;
    border: 1px solid #ced4da;

    margin-left: 10px;
    text-transform: uppercase;
}

.design_setting .colorbar-adj {
    display: inline-block;
    width: 37px !important;
    height: 32px;
    border-radius: 50% !important;
    box-shadow: none !important;
    margin-left: 10px;
    border: 1px solid transparent;
    padding: 0px !important;

}

.design_setting .accordion-button {
    background-color: white;
    color: black;
    box-shadow: 0px !important;
    border-radius: 2px !important;
}

.design_setting .accordion-button:hover {
    color: black !important;
}

.design_setting .accordion-button:focus {
    z-index: 3;
    border-color: rgba(0, 0, 0, .125) !important;
    outline: 0;
    box-shadow: none !important;
}

.alin {
    display: flex;
    align-items: center;
}

.cc-selector input {
    margin: 0;
    padding: 0;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}

.cc-selector-2 input {
    position: absolute;
    z-index: 999;
}

.cc-selector-2 {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    column-gap: 50px;
    row-gap: 30px;
}

.theme-default {
    background-image: url(<?= base_url('images/theme/default.jpeg') ?>);
}

.theme-black {
    background-image: url(<?= base_url('images/theme/black.jpeg') ?>);
}

.theme-blue {
    background-image: url(<?= base_url('images/theme/blue.jpeg') ?>);
}

.theme-blue-white {
    background-image: url(<?= base_url('images/theme/blue-white.jpeg') ?>);
}

.theme-brown {
    background-image: url(<?= base_url('images/theme/brown.jpeg') ?>);
}

.theme-green {
    background-image: url(<?= base_url('images/theme/green.jpeg') ?>);
}

.theme-green-white {
    background-image: url(<?= base_url('images/theme/green-white.jpeg') ?>);
}

.theme-grey {
    background-image: url(<?= base_url('images/theme/grey.jpeg') ?>);
}

.theme-orange {
    background-image: url(<?= base_url('images/theme/orange.jpeg') ?>);
}

.theme-pink {
    background-image: url(<?= base_url('images/theme/pink.jpeg') ?>);
}

.theme-purple {
    background-image: url(<?= base_url('images/theme/purple.jpeg') ?>);
}


.cc-selector-2 input:active+.drinkcard-cc,
.cc-selector input:active+.drinkcard-cc {
    opacity: .9;
}

.cc-selector-2 input:checked+.drinkcard-cc,
.cc-selector input:checked+.drinkcard-cc {
    -webkit-filter: none;
    -moz-filter: none;
    filter: none;
}

.drinkcard-cc {
    cursor: pointer;
    background-size: contain;
    background-repeat: no-repeat;
    display: inline-block;
    width: 180px;
    height: 400px;

}
</style>
<?
   $this->load->view("restaurantportal/top_bar");
   ?>

<div class="title_bar">
    <h1>Edit theme Settings</h1>
</div>

<div class="title_bar">
    <p class="mb-0">Change the colors and design to match your brand</p>
</div>
<div class="title_bar content" style="border-bottom: none;">
    <div class="card">
        <div class="card-body  design_setting pb-3">
            <?
			$this->load->view("restaurantportal/messages");
		?>
            <div class="container">
                <div class="row">
                    <form action="" method="post">
                        <div class="">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-3">
                                    <label class="drinkcard-cc theme-default" for="default">
                                        <input id="default" type="radio" name="theme" value="default"
                                            checked="checked" />
                                    </label>
                                </div>


                                <div class="col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-3">
                                    <label class="drinkcard-cc theme-black" for="black">
                                        <input id="black" type="radio" name="theme" value="black" />
                                    </label>
                                </div>


                                <div class="col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-3">
                                    <label class="drinkcard-cc theme-blue" for="blue">
                                        <input id="blue" type="radio" name="theme" value="blue" />
                                    </label>
                                </div>


                                <div class="col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-3">
                                    <label class="drinkcard-cc theme-blue-white" for="blue-white">
                                        <input id="blue-white" type="radio" name="theme" value="blue-white" />
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-3">
                                    <label class="drinkcard-cc theme-brown" for="brown">
                                        <input id="brown" type="radio" name="theme" value="brown" />
                                    </label>
                                </div>

                                <div class="col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-3">
                                    <label class="drinkcard-cc theme-green" for="green">
                                        <input id="green" type="radio" name="theme" value="green" />
                                    </label>
                                </div>
                                <div class="col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-3">
                                    <label class="drinkcard-cc theme-green-white" for="green-white">
                                        <input id="green-white" type="radio" name="theme" value="green-white" />
                                    </label>
                                </div>
                                <div class="col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-3">
                                    <label class="drinkcard-cc theme-grey" for="grey">
                                        <input id="grey" type="radio" name="theme" value="grey" />
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-3">
                                    <label class="drinkcard-cc theme-orange" for="orange">
                                        <input id="orange" type="radio" name="theme" value="orange" />
                                    </label>
                                </div>
                                <div class="col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-3">
                                    <label class="drinkcard-cc theme-pink" for="pink">
                                        <input id="pink" type="radio" name="theme" value="pink" />
                                    </label>
                                </div>
                                <div class="col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-3">
                                    <label class="drinkcard-cc theme-purple" for="purple">
                                        <input id="purple" type="radio" name="theme" value="purple" />
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Top bar
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="mb-3 form-group">
                                            <label for="topBarBgColor" class="form-label">Background color</label>
                                            <div class="alin"> <input type="text" class="form-control input-adj"
                                                    readonly id="topBarBgColor"> <input
                                                    class="form-control colorbar-adj" type="color"
                                                    onchange="changeColor('#topBarBgColor' )" required
                                                    name="topBarBgColor" id="topBarBgColorPicker"></div>
                                        </div>
                                        <div class="mb-0 form-group">
                                            <label for="topBarTextColor" class="form-label">Text color</label>
                                            <div class="alin"> <input type="text" class="form-control input-adj"
                                                    readonly id="topBarTextColor"> <input
                                                    class="form-control colorbar-adj" type="color"
                                                    onchange="changeColor('#topBarTextColor' )" required
                                                    name="topBarTextColor" id="topBarTextColorPicker"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="true"
                                        aria-controls="collapseThree">
                                        Restaurant info bar
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse "
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="mb-3 form-group">
                                            <label for="resturantInfoBarBgColor" class="form-label">Background
                                                color</label>
                                            <div class="alin"> <input type="text" class="form-control input-adj"
                                                    readonly id="resturantInfoBarBgColor"> <input
                                                    class="form-control colorbar-adj" type="color"
                                                    onchange="changeColor('#resturantInfoBarBgColor' )" required
                                                    name="resturantInfoBarBgColor" id="resturantInfoBarBgColorPicker">
                                            </div>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label for="resturantInfoBarTextColor" class="form-label">Text color</label>
                                            <div class="alin"> <input type="text" class="form-control input-adj"
                                                    readonly id="resturantInfoBarTextColor"> <input
                                                    class="form-control colorbar-adj" type="color"
                                                    onchange="changeColor('#resturantInfoBarTextColor' )" required
                                                    name="resturantInfoBarTextColor"
                                                    id="resturantInfoBarTextColorPicker"></div>
                                        </div>
                                        <div class="mb-0 form-group">
                                            <label for="moreInfoTextColor" class="form-label">More info text and
                                                location
                                                icon
                                                color</label>
                                            <div class="alin"> <input type="text" class="form-control input-adj"
                                                    readonly id="moreInfoTextColor"> <input
                                                    class="form-control colorbar-adj" type="color"
                                                    onchange="changeColor('#moreInfoTextColor' )" required
                                                    name="moreInfoTextColor" id="moreInfoTextColorPicker"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        Menu category slider background
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="mb-3 form-group">
                                            <label for="menuSliderBgColor" class="form-label">Background color</label>
                                            <div class="alin"> <input type="text" class="form-control input-adj"
                                                    readonly id="menuSliderBgColor"> <input
                                                    class="form-control colorbar-adj" type="color"
                                                    onchange="changeColor('#menuSliderBgColor' )" required
                                                    name="menuSliderBgColor" id="menuSliderBgColorPicker"></div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSeven">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSeven" aria-expanded="true"
                                        aria-controls="collapseSeven">
                                        Restaurant menu listing, other pages, and popups content area
                                    </button>
                                </h2>
                                <div id="collapseSeven" class="accordion-collapse collapse "
                                    aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="mb-3 form-group">
                                            <label for="mainMenuBackgroundColor" class="form-label">Background
                                                color</label>
                                            <div class="alin"> <input type="text" class="form-control input-adj"
                                                    readonly id="mainMenuBackgroundColor"> <input
                                                    class="form-control colorbar-adj" type="color"
                                                    onchange="changeColor('#mainMenuBackgroundColor' )" required
                                                    name="mainMenuBackgroundColor" id="mainMenuBackgroundColorPicker">
                                            </div>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label for="mainHeadingTextColor" class="form-label">Main heading text
                                                color</label>
                                            <div class="alin"> <input type="text" class="form-control input-adj"
                                                    readonly id="mainHeadingTextColor"> <input
                                                    class="form-control colorbar-adj" type="color"
                                                    onchange="changeColor('#mainHeadingTextColor' )" required
                                                    name="mainHeadingTextColor" id="mainHeadingTextColorPicker"></div>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label for="lineColor" class="form-label">Line color</label>
                                            <div class="alin"> <input type="text" class="form-control input-adj"
                                                    readonly id="lineColor"> <input class="form-control colorbar-adj"
                                                    type="color" onchange="changeColor('#lineColor' )" required
                                                    name="lineColor" id="lineColorPicker"></div>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label for="menuHeadingpriceTextColor" class="form-label">Menu item title
                                                and
                                                price
                                                text color</label>
                                            <div class="alin"> <input type="text" class="form-control input-adj"
                                                    readonly id="menuHeadingpriceTextColor"> <input
                                                    class="form-control colorbar-adj" type="color"
                                                    onchange="changeColor('#menuHeadingpriceTextColor' )" required
                                                    name="menuHeadingpriceTextColor"
                                                    id="menuHeadingpriceTextColorPicker"></div>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label for="menuSubHeadingTextColor" class="form-label">Item Description and
                                                other
                                                content text</label>
                                            <div class="alin"> <input type="text" class="form-control input-adj"
                                                    readonly id="menuSubHeadingTextColor"> <input
                                                    class="form-control colorbar-adj" type="color"
                                                    onchange="changeColor('#menuSubHeadingTextColor' )" required
                                                    name="menuSubHeadingTextColor" id="menuSubHeadingTextColorPicker">
                                            </div>
                                        </div>
                                        <div class="mb-0 form-group">
                                            <label for="primaryButtonBackgroundColor" class="form-label">Primary Button
                                                Background Color</label>
                                            <div class="alin"> <input type="text" class="form-control input-adj"
                                                    readonly id="primaryButtonBackgroundColor"> <input
                                                    class="form-control colorbar-adj" type="color"
                                                    onchange="changeColor('#primaryButtonBackgroundColor' )" required
                                                    name="primaryButtonBackgroundColor"
                                                    id="primaryButtonBackgroundColorPicker"></div>
                                        </div>
                                        <div class="mb-0 form-group">
                                            <label for="primaryButtonTextColor" class="form-label">Primary Button Text
                                                Color</label>
                                            <div class="alin"> <input type="text" class="form-control input-adj"
                                                    readonly id="primaryButtonTextColor"> <input
                                                    class="form-control colorbar-adj" type="color"
                                                    onchange="changeColor('#primaryButtonTextColor' )" required
                                                    name="primaryButtonTextColor" id="primaryButtonTextColorPicker">
                                            </div>
                                        </div>
                                        <div class="mb-0 form-group">
                                            <label for="secondaryButtonBackgroundColor" class="form-label">Secondary
                                                Button
                                                Background Color</label>
                                            <div class="alin"> <input type="text" class="form-control input-adj"
                                                    readonly id="secondaryButtonBackgroundColor"> <input
                                                    class="form-control colorbar-adj" type="color"
                                                    onchange="changeColor('#secondaryButtonBackgroundColor' )" required
                                                    name="secondaryButtonBackgroundColor"
                                                    id="secondaryButtonBackgroundColorPicker"></div>
                                        </div>
                                        <div class="mb-0 form-group">
                                            <label for="secondaryButtonTextColor" class="form-label">Secondary Button
                                                Text
                                                Color</label>
                                            <div class="alin"> <input type="text" class="form-control input-adj"
                                                    readonly id="secondaryButtonTextColor"> <input
                                                    class="form-control colorbar-adj" type="color"
                                                    onchange="changeColor('#secondaryButtonTextColor' )" required
                                                    name="secondaryButtonTextColor" id="secondaryButtonTextColorPicker">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFifth">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFifteen" aria-expanded="true"
                                        aria-controls="collapseFifteen">
                                        Text input color
                                    </button>
                                </h2>
                                <div id="collapseFifteen" class="accordion-collapse collapse "
                                    aria-labelledby="headingFifth" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="mb-0 form-group">
                                            <label for="textInputColor" class="form-label">Choose Color</label>
                                            <div class="alin"> <input type="text" class="form-control input-adj"
                                                    readonly id="textInputColor"> <input
                                                    class="form-control colorbar-adj" type="color"
                                                    onchange="changeColor('#textInputColor' )" required
                                                    name="textInputColor" id="textInputColorPicker"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary orange_btn" name="saveSetting"
                            style="display: block;color:#fff;margin-left:15px;margin-top:15px;" value="Save Settings">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?
   $this->load->view("restaurantportal/footer_view");
   ?>
<script>
function changeColor(input) {
    var value = jQuery(input + 'Picker').val();
    jQuery(input).val(value);
}

// jQuery('#bgColor').change(function() {
//     jQuery('#bgcolor').val(jQuery('#bgColor').val());
// });
// jQuery('#primaryColor').change(function() {
//     jQuery('#primary_color').val(jQuery('#primaryColor').val());
// });

var current_theme = <?= !empty($restaurant['theme_settings']) ? $restaurant['theme_settings'] : '{}' ?>;
if (current_theme.hasOwnProperty('theme')) {
    $("input[name=theme][value=" + current_theme['theme'] + "]").attr("checked", "checked");
}

function setupCurrentTheme(current_theme) {
    for (var key in current_theme) {
        if (current_theme.hasOwnProperty(key)) {
            $('#' + key).val(current_theme[key]);
            $('#' + key + 'Picker').val(current_theme[key]);
        }
    }
}
if (current_theme)
    setupCurrentTheme(current_theme);
$('input[type=radio][name=theme]').change(function() {

    if (this.value == 'default') {
        current_theme = {
            "theme": "default",
            "topBarBgColor": "#35ada2",
            "topBarTextColor": "#000000",
            "resturantInfoBarBgColor": "#fcfcfc",
            "resturantInfoBarTextColor": "#605f5e",
            "moreInfoTextColor": "#35ada2",
            "menuSliderBgColor": "#ffffff",
            "mainMenuBackgroundColor": "#ffffff",
            "mainHeadingTextColor": "#212121",
            "lineColor": "#37b8ac",
            "menuHeadingpriceTextColor": "#212121",
            "menuSubHeadingTextColor": "#666666",
            "primaryButtonBackgroundColor": "#37b8ac",
            "primaryButtonTextColor": "#FFFFFF",
            "secondaryButtonBackgroundColor": "#f36737",
            "secondaryButtonTextColor": "#FFFFFF",
            "textInputColor": "#000000"
        };
    } else if (this.value == 'black') {
        current_theme = {
            "theme": "black",
            "topBarBgColor": "#00acb3",
            "topBarTextColor": "#000000",
            "resturantInfoBarBgColor": "#ededed",
            "resturantInfoBarTextColor": "#9f9f9f",
            "moreInfoTextColor": "#626262",
            "menuSliderBgColor": "#373e46",
            "mainMenuBackgroundColor": "#212832",
            "mainHeadingTextColor": "#e6e7ec",
            "lineColor": "#39929a",
            "menuHeadingpriceTextColor": "#39929a",
            "menuSubHeadingTextColor": "#d5d9e2",
            "primaryButtonBackgroundColor": "#39929a",
            "primaryButtonTextColor": "#FFFFFF",
            "secondaryButtonBackgroundColor": "#f36737",
            "secondaryButtonTextColor": "#FFFFFF",
            "textInputColor": "#000000"
        };
    } else if (this.value == 'blue') {
        current_theme = {
            "theme": "blue",
            "topBarBgColor": "#001f3e",
            "topBarTextColor": "#f9ffff",
            "resturantInfoBarBgColor": "#0d3056",
            "resturantInfoBarTextColor": "#edffff",
            "moreInfoTextColor": "#edffff",
            "menuSliderBgColor": "#1160a3",
            "mainMenuBackgroundColor": "#1160a3",
            "mainHeadingTextColor": "#f8ffff",
            "lineColor": "#c5d79b",
            "menuHeadingpriceTextColor": "#dddf60",
            "menuSubHeadingTextColor": "#dbfdff",
            "primaryButtonBackgroundColor": "#dddf60",
            "primaryButtonTextColor": "#000",
            "secondaryButtonBackgroundColor": "#f36737",
            "secondaryButtonTextColor": "#FFFFFF",
            "textInputColor": "#000000"
        };
    } else if (this.value == 'blue-white') {
        current_theme = {
            "theme": "blue-white",
            "topBarBgColor": "#1e92df",
            "topBarTextColor": "#e3ffff",
            "resturantInfoBarBgColor": "#fefaf7",
            "resturantInfoBarTextColor": "#5a5a5a",
            "moreInfoTextColor": "#3587c3",
            "menuSliderBgColor": "#FFFFFF",
            "mainMenuBackgroundColor": "#FFFFFF",
            "mainHeadingTextColor": "#000000",
            "lineColor": "#8aebf1",
            "menuHeadingpriceTextColor": "#000000",
            "menuSubHeadingTextColor": "#000000",
            "primaryButtonBackgroundColor": "#1e92df",
            "primaryButtonTextColor": "#FFFFFF",
            "secondaryButtonBackgroundColor": "#f36737",
            "secondaryButtonTextColor": "#FFFFFF",
            "textInputColor": "#000000"
        };
    } else if (this.value == 'brown') {
        current_theme = {
            "theme": "brown",
            "topBarBgColor": "#ebb062",
            "topBarTextColor": "#000000",
            "resturantInfoBarBgColor": "#ecd58f",
            "resturantInfoBarTextColor": "#68552b",
            "moreInfoTextColor": "#68552b",
            "menuSliderBgColor": "#935846",
            "mainMenuBackgroundColor": "#935846",
            "mainHeadingTextColor": "#FFFFFF",
            "lineColor": "#FFFFFF",
            "menuHeadingpriceTextColor": "#e6c689",
            "menuSubHeadingTextColor": "#ffd8cc",
            "primaryButtonBackgroundColor": "#ebb062",
            "primaryButtonTextColor": "#000",
            "secondaryButtonBackgroundColor": "#f36737",
            "secondaryButtonTextColor": "#FFFFFF",
            "textInputColor": "#000000"
        };
    } else if (this.value == 'green') {
        current_theme = {
            "theme": "green",
            "topBarBgColor": "#fedd7c",
            "topBarTextColor": "#000000",
            "resturantInfoBarBgColor": "#df4b6f",
            "resturantInfoBarTextColor": "#FFFFFF",
            "moreInfoTextColor": "#FFFFFF",
            "menuSliderBgColor": "#00b8aa",
            "mainMenuBackgroundColor": "#00b8aa",
            "mainHeadingTextColor": "#FFFFFF",
            "lineColor": "#FFFFFF",
            "menuHeadingpriceTextColor": "#FFFFFF",
            "menuSubHeadingTextColor": "#FFFFFF",
            "primaryButtonBackgroundColor": "#fedd7c",
            "primaryButtonTextColor": "#000000",
            "secondaryButtonBackgroundColor": "#f36737",
            "secondaryButtonTextColor": "#FFFFFF",
            "textInputColor": "#000000"
        };
    } else if (this.value == 'green-white') {
        current_theme = {
            "theme": "green-white",
            "topBarBgColor": "#000000",
            "topBarTextColor": "#FFFFFF",
            "resturantInfoBarBgColor": "#00b8aa",
            "resturantInfoBarTextColor": "#FFFFFF",
            "moreInfoTextColor": "#FFFFFF",
            "menuSliderBgColor": "#FFFFFF",
            "mainMenuBackgroundColor": "#FFFFFF",
            "mainHeadingTextColor": "#00b8aa",
            "lineColor": "#d8d8d8",
            "menuHeadingpriceTextColor": "#000000",
            "menuSubHeadingTextColor": "#d8d8d8",
            "primaryButtonBackgroundColor": "#00b8aa",
            "primaryButtonTextColor": "#FFFFFF",
            "secondaryButtonBackgroundColor": "#f36737",
            "secondaryButtonTextColor": "#FFFFFF",
            "textInputColor": "#000000"
        };
    } else if (this.value == 'grey') {
        current_theme = {
            "theme": "grey",
            "topBarBgColor": "#f3f3f1",
            "topBarTextColor": "#2c2b3b",
            "resturantInfoBarBgColor": "#2a2e4b",
            "resturantInfoBarTextColor": "#FFFFFF",
            "moreInfoTextColor": "#fafcff",
            "menuSliderBgColor": "#f3f3f1",
            "mainMenuBackgroundColor": "#f3f3f1",
            "mainHeadingTextColor": "#d35354",
            "lineColor": "#d35354",
            "menuHeadingpriceTextColor": "#262a33",
            "menuSubHeadingTextColor": "#363739",
            "primaryButtonBackgroundColor": "#2a2e4b",
            "primaryButtonTextColor": "#FFFFFF",
            "secondaryButtonBackgroundColor": "#f36737",
            "secondaryButtonTextColor": "#FFFFFF",
            "textInputColor": "#000000"
        };
    } else if (this.value == 'orange') {
        current_theme = {
            "theme": "orange",
            "topBarBgColor": "#f7ed6a",
            "topBarTextColor": "#61383e",
            "resturantInfoBarBgColor": "#FFFFFF",
            "resturantInfoBarTextColor": "#97899a",
            "moreInfoTextColor": "#bd8797",
            "menuSliderBgColor": "#fefafb",
            "mainMenuBackgroundColor": "#fefafb",
            "mainHeadingTextColor": "#602e63",
            "lineColor": "#dcd8d9",
            "menuHeadingpriceTextColor": "#e89972",
            "menuSubHeadingTextColor": "#a9989e",
            "primaryButtonBackgroundColor": "#e2886e",
            "primaryButtonTextColor": "#FFFFFF",
            "secondaryButtonBackgroundColor": "#f36737",
            "secondaryButtonTextColor": "#FFFFFF",
            "textInputColor": "#000000"
        };
    } else if (this.value == 'pink') {
        current_theme = {
            "theme": "pink",
            "topBarBgColor": "#ebb062",
            "topBarTextColor": "#000000",
            "resturantInfoBarBgColor": "#227877",
            "resturantInfoBarTextColor": "#faebff",
            "moreInfoTextColor": "#faebff",
            "menuSliderBgColor": "#fce8f1",
            "mainMenuBackgroundColor": "#fce8f1",
            "mainHeadingTextColor": "#1d3f3e",
            "lineColor": "#4f7777",
            "menuHeadingpriceTextColor": "#4e7379",
            "menuSubHeadingTextColor": "#63565f",
            "primaryButtonBackgroundColor": "#4e7379",
            "primaryButtonTextColor": "#FFFFFF",
            "secondaryButtonBackgroundColor": "#f36737",
            "secondaryButtonTextColor": "#FFFFFF",
            "textInputColor": "#000000"
        };
    } else if (this.value == 'purple') {
        current_theme = {
            "theme": "purple",
            "topBarBgColor": "#f9e9f3",
            "topBarTextColor": "#130911",
            "resturantInfoBarBgColor": "#FFFFFF",
            "resturantInfoBarTextColor": "#6b6b6b",
            "moreInfoTextColor": "#d4b5bd",
            "menuSliderBgColor": "#6a2b71",
            "mainMenuBackgroundColor": "#692c71",
            "mainHeadingTextColor": "#ec8b68",
            "lineColor": "#9f4176",
            "menuHeadingpriceTextColor": "#ffe386",
            "menuSubHeadingTextColor": "#ffe2ff",
            "primaryButtonBackgroundColor": "#ffe386",
            "primaryButtonTextColor": "#000000",
            "secondaryButtonBackgroundColor": "#f36737",
            "secondaryButtonTextColor": "#FFFFFF",
            "textInputColor": "#000000"
        };
    }
    if (current_theme) {
        console.log(current_theme);
        setupCurrentTheme(current_theme);
    }

});
</script>