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

.week-picker {
    display: none;
}

.grid_roww {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    column-gap: 10px;
}
</style>
<?
$this->load->view("restaurantportal/top_bar");
?>
<div class="title_bar flexable">
    <h1>View Schedule</h1>
</div>
<form action="">
    <div class="title_bar grid_roww">
        <div class="form-group">
            <label for="date_picker">
                <input type="text" placeholder="week picker" class="form-control" id="date_picker">
                <div class="week-picker"></div>
            </label>
        </div>
        <div class="form-group">
            <label for="" class="w-100">
                <select name="" class="form-control form-select custom_select" id="">
                    <option value="test">Test</option>
                    <option value="test">Test</option>
                    <option value="test">Test</option>
                    <option value="test">Test</option>
                    <option value="test">Test</option>
                </select>
            </label>
        </div>
        <div class="form-group">
            <label for="" class="w-100">
                <select name="" class="form-control form-select custom_select" id="">
                    <option value="test">Test</option>
                    <option value="test">Test</option>
                    <option value="test">Test</option>
                    <option value="test">Test</option>
                    <option value="test">Test</option>
                </select>
            </label>
        </div>
        <div class="form-group">
            <button class="btn btn-primary orange_btn text-white"
                style="background-color:#5dcaca;border-color:#5dcaca;width:unset !important;">Today</button>
        </div>
        <div class="form-group " style="text-align: right; display:flex;justify-content:flex-end;">
            <button style="margin-right:0;" class="btn btn-primary orange_btn text-white">Publish Schedule</button>
        </div>
    </div>
</form>

<style>
.radio_buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
}

.radio_buttons input {
    display: none;
}

.radio_buttons label {
    font-size: 14px;
    border: 1px solid rgba(0, 0, 0, .5);
    padding: 8px 10px;
    border-radius: 10px;
    min-width: 50px;
    align-items: center;
    text-align: center;
    transition: .3s all;
}

.radio:checked+label {
    color: #fffF;
    background-color: #37B8AC;
    border-color: #37B8AC;
}

.fc-button-group>.fc-button:not(:last-child) {
    margin-right: 10px;
}

.fc-body .fc-resource-area .fc-cell-content img {
    margin-right: 10px;
    border-radius: 50%;
    object-fit: cover;
    width: 100%;
}


.fc .fc-toolbar.fc-header-toolbar,
.fc-toolbar {

    margin-bottom: 0 !important;
    padding: 15px;
}

.fc-flat .fc-expander-space {
    display: block !important;
}

.fc-body .fc-resource-area .fc-cell-content {
    display: grid;
    grid-template-columns: 20% 75%;
    column-gap: 5%;
}

.fc-body .fc-resource-area .fc-cell-content .fc-cell-text span {
    display: block;
    line-height: 1;
}

.event_table tr th,
.event_table tr td {
    vertical-align: middle;
}

.event_table tr td {
    padding-left: 0;
    padding-right: 0;
}

.event_table tr td span.event {
    display: block;
    padding: 5px 10px;
    width: 100%;
    background-color: rgba(93, 202, 202, .3);
}

.event_table tr th span {
    font-weight: bold;
    display: block;
    font-size: 20px;
}

.event_table tr.header {
    background-color: #5dcaca;
    color: #fff;
}

.event_table tr.header td {
    font-weight: bold !important;
    color: #fff !important;
}

.event_table tr th span small {
    font-weight: normal;
    display: block;
    font-size: 12px;
    line-height: 1;
}

.avatar {
    margin-top: 0 !important;
    align-items: center;
    justify-content: center;
    /* flex-direction: column; */
}

.avatar span.image_holder {
    position: relative;
    margin-right: 20px;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: block;
    /* background: red; */
    overflow: hidden;
}

.avatar span.image_holder img {
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    margin-right: 0;
    height: 100%;
    /* border-radius: 50%; */
}

.avatar p {
    margin-bottom: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
</style>

<div class="title_bar content">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table event_table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>
                                <span>
                                    Mon
                                    <small>Mar 9</small>
                                </span>
                            </th>
                            <th>
                                <span>
                                    Tue
                                    <small>Mar 10</small>
                                </span>
                            </th>
                            <th>
                                <span>
                                    Wed
                                    <small>Mar 11</small>
                                </span>
                            </th>
                            <th>
                                <span>
                                    Thu
                                    <small>Mar 12</small>
                                </span>
                            </th>
                            <th>
                                <span>
                                    Fri
                                    <small>Mar 13</small>
                                </span>
                            </th>
                            <th>
                                <span>
                                    Sat
                                    <small>Mar 14</small>
                                </span>
                            </th>
                            <th>
                                <span>
                                    Sun
                                    <small>Mar 15</small>
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="header">
                            <td colspan="8">Cook</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="avatar">
                                    <span class="image_holder">
                                        <img src="https://www.pngitem.com/pimgs/m/30-307416_profile-icon-png-image-free-download-searchpng-employee.png"
                                            alt="">
                                    </span>
                                    <p>
                                        John Doe
                                        <span>24 Hrs</span>
                                    </p>
                                </div>
                            </td>
                            <td>
                                <span class="event">9am -5pm</span>
                            </td>
                            <td></td>
                            <td>
                                <span class="event">9am -5pm</span>
                            </td>
                            <td>
                                <span class="event">9am -5pm</span>
                            </td>
                            <td></td>
                            <td>
                                <span class="event">9am -5pm</span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="avatar">
                                    <span class="image_holder">
                                        <img src="https://www.pngitem.com/pimgs/m/30-307416_profile-icon-png-image-free-download-searchpng-employee.png"
                                            alt="">
                                    </span>
                                    <p>
                                        John Doe
                                        <span>24 Hrs</span>
                                    </p>
                                </div>
                            </td>
                            <td>
                                <span class="event">9am -5pm</span>
                            </td>
                            <td></td>
                            <td>
                                <span class="event">9am -5pm</span>
                            </td>
                            <td>
                                <span class="event">9am -5pm</span>
                            </td>
                            <td></td>
                            <td>
                                <span class="event">9am -5pm</span>
                            </td>
                            <td></td>
                        </tr>
                        <tr class="header">
                            <td colspan="8">Dishwasher</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="avatar">
                                    <span class="image_holder">
                                        <img src="https://www.pngitem.com/pimgs/m/30-307416_profile-icon-png-image-free-download-searchpng-employee.png"
                                            alt="">
                                    </span>
                                    <p>
                                        John Doe
                                        <span>24 Hrs</span>
                                    </p>
                                </div>
                            </td>
                            <td>
                                <span class="event">9am -5pm</span>
                            </td>
                            <td></td>
                            <td>
                                <span class="event">9am -5pm</span>
                            </td>
                            <td>
                                <span class="event">9am -5pm</span>
                            </td>
                            <td></td>
                            <td>
                                <span class="event">9am -5pm</span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="avatar">
                                    <span class="image_holder">
                                        <img src="https://www.pngitem.com/pimgs/m/30-307416_profile-icon-png-image-free-download-searchpng-employee.png"
                                            alt="">
                                    </span>
                                    <p>
                                        John Doe
                                        <span>24 Hrs</span>
                                    </p>
                                </div>
                            </td>
                            <td>
                                <span class="event">9am -5pm</span>
                            </td>
                            <td></td>
                            <td>
                                <span class="event">9am -5pm</span>
                            </td>
                            <td>
                                <span class="event">9am -5pm</span>
                            </td>
                            <td></td>
                            <td>
                                <span class="event">9am -5pm</span>
                            </td>
                            <td></td>
                        </tr>
                        <tr class="addmore">
                            <td>
                                <button style="min-height: 40px;" class="btn btn-primary orange_btn text-white">
                                    <i style="margin-right:10px;" class="fa fa-plus"></i>
                                    Add More
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?
	$this->load->view("restaurantportal/footer_view");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
    integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ=="
    crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
    integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
    integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-weekpicker@1.0.4/src/jquery.weekpicker.min.js"></script>
<script>
jQuery(function() {
    jQuery('.week-picker').weekpicker();
});
jQuery(document).ready(function() {
    jQuery('#date_picker').click(function() {

    });
});
</script>