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
    <h1>Employee Information</h1>
</div>


<div class="title_bar content" style="border-bottom: none;">
    <div class="row">
        <div class="col-12">
            <h4>Personal Information</h4>
            <div class="avatar">
                <img src="<?php echo base_url() . '/images/dashboard.png'; ?>" alt="">
                <span>John Doe</span>
            </div>
        </div>
    </div>
</div>

<div class="title_bar content">
    <form class="form">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="f_name" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">First Name (required)</label>
                    <input type="text" name="f_name" required id="f_name" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="l_name" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Last Name (required)</label>
                    <input type="text" name="l_name" id="l_name" required class="form-control">
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="home_phone" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Home Phone</label>
                    <input type="text" name="home_phone" id="home_phone" class="form-control">
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bd" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Birthday</label>
                    <input type="date" name="bd" id="bd" class="form-control">
                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="addres" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Address</label>
                    <input type="text" name="addres" id="addres" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="zipcode" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Zip / Postal Code</label>
                    <input type="text" name="zipcode" id="zipcode" class="form-control">
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="City" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">City</label>
                    <input type="text" name="City" id="City" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="state" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">State / Province</label>
                    <input type="text" name="state" id="state" class="form-control">
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="submit" name="save" class="form-control orange_btn btn btn-primary text-white" value="Save">
                    <span class="discard">Discard Changes</span>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="title_bar content">
    <h4>Role Assignemtn</h4>
    <form class="form">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="location" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Location</label>
                    <select name="location" id="location" class="form-select">
                        <option value="">Location 1</option>
                        <option value="">Location 1</option>
                        <option value="">Location 1</option>
                        <option value="">Location 1</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="grid">
                    <div>
                        <span>Departments</span>
                        <div class="checkboxes">
                            <label for="department">
                                <input type="checkbox" name="department" id="department" class="">
                                Kitchen
                            </label>
                        </div>
                    </div>
                    <div>
                        <span>Roles</span>
                        <div class="checkboxes">
                            <label for="role">
                                <input type="checkbox" name="role" id="role" class="">
                                <badge class="badge bg-warning">Cock</badge>
                            </label>
                            <label for="role1">
                                <input type="checkbox" name="role1" id="role1" class="">
                                <badge class="badge bg-success">Dishwasher</badge>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>


<div class="title_bar content">
    <h4>Employment</h4>
    <form class="form">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="max_weekly_hours" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Max Weekly Hours</label>
                    <input type="text" name="max_weekly_hours" id="max_weekly_hours" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="hire_date" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Hire Date</label>
                    <input type="date" name="hire_date" id="hire_date" class="form-control">
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">Active</option>
                        <option value="">Disabled</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="submit" name="save" class="form-control orange_btn btn btn-primary text-white" value="Save">
                    <span class="discard">Discard Changes</span>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="title_bar content">
    <h4>Wages</h4>
    <form class="form">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wage_type" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Wage Type</label>
                    <select name="wage_type" id="wage_type" class="form-select">
                        <option value="">Hourly</option>
                        <option value="">Weekly</option>
                        <option value="">Monthly</option>
                    </select>
                    <span class="short">Employees can only have one wage type.</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wage" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Wage</label>
                    <input type="text" name="wage" id="wage" class="form-control">
                    <span class="short">This rate will be applicable from next salary cycle.</span>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">Active</option>
                        <option value="">Disabled</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="submit" name="save" class="form-control orange_btn btn btn-primary text-white" value="Save">
                    <span class="discard">Discard Changes</span>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="title_bar content">
    <h4>Notes</h4>
    <form class="form">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="notes" class="form-label notes" style="font-weight: 600;color:rgba(0,0,0,.7)">Scheduling Notes
                        <span class="right">Max 1000 Characters</span>
                    </label>
                    <textarea name="notes" id="notes" rows="5" class="form-control"></textarea>
                    <span class="short">These notes will be available when viewing the schedule. Only you and other management staff can see scheduling notes.</span>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="submit" name="save" class="form-control orange_btn btn btn-primary text-white" value="Save">
                    <span class="discard">Discard Changes</span>
                </div>
            </div>
        </div>
    </form>
</div>

<?
	$this->load->view("restaurantportal/footer_view");
?>