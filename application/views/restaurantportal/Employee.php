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
</style>
<?
$this->load->view("restaurantportal/top_bar");
?>
<div class="title_bar flexable">
    <h1>Staff</h1>
    <button class="btn orange_btn text-white"> <i class="fa fa-plus"></i> Add Staff</button>
</div>


<div class="title_bar content">
    <div class="grid-flex">
        <div class="form-group">
            <select name="search" id="search" class="form-select">
                <option value="">Staff</option>
                <option value="">Staff</option>
                <option value="">Staff</option>
                <option value="">Staff</option>
            </select>
        </div>
        <div class="form-group flex">
            <label for="role">Filter By</label>
            <select name="role" id="role" class="form-select">
                <option value="">Select Role</option>
                <option value="">Roles</option>
                <option value="">Roles</option>
                <option value="">Roles</option>
            </select>
        </div>
        <div class="form-group flex">
            <button class="btn btn-primary orange-btn mr-3"><i class="fas fa-filter"></i></button>
            <button class="btn btn-primary orange-btn"><i class="fas fa-redo"></i></button>
        </div>
    </div>
</div>

<div class="title_bar content">
    <div class="card">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table employe_table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Location</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <img src="<?php echo base_url() . '/images/dashboard.png'; ?>" class="table-image" alt="">
                            </td>
                            <td>John Doe</td>
                            <td>johdoe@gmail.com</td>
                            <td>+123456789</td>
                            <td>Downtown</td>
                            <td>Dish Washer</td>
                            <td class="flex_direction">
                                <button style=" background-color: #5dcaca; " class="btn margin_top_stng icon_btn_adj"><i class="fas fa-edit icon_margin"></i> Edit</button>
                                <!-- <button class="disable-active btn margin_top_stng icon_btn_adj">Activate</button> -->
                                <button class="btn margin_top_stng icon_btn_adj"><i class="fa fa-ban icon_margin"></i> Disable</button>
                                <button style="background-color: #F7665E; " class="btn icon_btn_adj"><i class=" fa fa-trash icon_margin"></i> Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="<?php echo base_url() . '/images/dashboard.png'; ?>" class="table-image" alt="">
                            </td>
                            <td>John Doe</td>
                            <td>johdoe@gmail.com</td>
                            <td>+123456789</td>
                            <td>Downtown</td>
                            <td>Dish Washer</td>
                            <td class="flex_direction">
                                <button style=" background-color: #5dcaca; " class="btn margin_top_stng icon_btn_adj"><i class="fas fa-edit icon_margin"></i> Edit</button>
                                <!-- <button class="disable-active btn margin_top_stng icon_btn_adj">Activate</button> -->
                                <button class="btn margin_top_stng icon_btn_adj"><i class="fa fa-ban icon_margin"></i> Disable</button>
                                <button style="background-color: #F7665E; " class="btn icon_btn_adj"><i class=" fa fa-trash icon_margin"></i> Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="<?php echo base_url() . '/images/dashboard.png'; ?>" class="table-image" alt="">
                            </td>
                            <td>John Doe</td>
                            <td>johdoe@gmail.com</td>
                            <td>+123456789</td>
                            <td>Downtown</td>
                            <td>Dish Washer</td>
                            <td class="flex_direction">
                                <button style=" background-color: #5dcaca; " class="btn margin_top_stng icon_btn_adj"><i class="fas fa-edit icon_margin"></i> Edit</button>
                                <!-- <button class="disable-active btn margin_top_stng icon_btn_adj">Activate</button> -->
                                <button class="btn margin_top_stng icon_btn_adj"><i class="fa fa-ban icon_margin"></i> Disable</button>
                                <button style="background-color: #F7665E; " class="btn icon_btn_adj"><i class=" fa fa-trash icon_margin"></i> Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="<?php echo base_url() . '/images/dashboard.png'; ?>" class="table-image" alt="">
                            </td>
                            <td>John Doe</td>
                            <td>johdoe@gmail.com</td>
                            <td>+123456789</td>
                            <td>Downtown</td>
                            <td>Dish Washer</td>
                            <td class="flex_direction">
                                <button style=" background-color: #5dcaca; " class="btn margin_top_stng icon_btn_adj"><i class="fas fa-edit icon_margin"></i> Edit</button>
                                <!-- <button class="disable-active btn margin_top_stng icon_btn_adj">Activate</button> -->
                                <button class="btn margin_top_stng icon_btn_adj"><i class="fa fa-ban icon_margin"></i> Disable</button>
                                <button style="background-color: #F7665E; " class="btn icon_btn_adj"><i class=" fa fa-trash icon_margin"></i> Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="<?php echo base_url() . '/images/dashboard.png'; ?>" class="table-image" alt="">
                            </td>
                            <td>John Doe</td>
                            <td>johdoe@gmail.com</td>
                            <td>+123456789</td>
                            <td>Downtown</td>
                            <td>Dish Washer</td>
                            <td class="flex_direction">
                                <button style=" background-color: #5dcaca; " class="btn margin_top_stng icon_btn_adj"><i class="fas fa-edit icon_margin"></i> Edit</button>
                                <!-- <button class="disable-active btn margin_top_stng icon_btn_adj">Activate</button> -->
                                <button class="btn margin_top_stng icon_btn_adj"><i class="fa fa-ban icon_margin"></i> Disable</button>
                                <button style="background-color: #F7665E; " class="btn icon_btn_adj"><i class=" fa fa-trash icon_margin"></i> Delete</button>
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