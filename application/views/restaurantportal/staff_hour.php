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
    <h1>Staff Hours</h1>
    <button class="btn orange_btn text-white" data-bs-toggle="modal" data-bs-target="#add_new_modal">Add New Timing</button>
</div>

<div class="modal fade" id="add_new_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Timing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="day" class="form-label">Select Day</label>
                        <select required class="form-select" id="day">
                            <option>Monday</option>
                            <option>Tuesday</option>
                            <option>Wednesday</option>
                            <option>Thursday</option>
                            <option>Friday</option>
                            <option>Saturday</option>
                            <option>Sunday</option>
                        </select>
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="starttime" class="form-label">Start Time</label>
                        <input type="time" class="form-control" name="starttime" id="starttime" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="endtime" class="form-label">End Time</label>
                        <input type="time" class="form-control" name="endtime" id="endtime" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-primary orange_btn text-white">Add Timiing</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Timing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="day" class="form-label">Select Day</label>
                        <select required class="form-select" id="day">
                            <option>Monday</option>
                            <option>Tuesday</option>
                            <option>Wednesday</option>
                            <option>Thursday</option>
                            <option>Friday</option>
                            <option>Saturday</option>
                            <option>Sunday</option>
                        </select>
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="starttime" class="form-label">Start Time</label>
                        <input type="time" class="form-control" name="starttime" id="starttime" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="endtime" class="form-label">End Time</label>
                        <input type="time" class="form-control" name="endtime" id="endtime" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-primary orange_btn text-white">Update Timiing</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="title_bar content" style="border-bottom: none;">
    <div class="card">
        <div class="card-body">
            <div class="table_responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Day</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>01</td>
                            <td>Monday</td>
                            <td>05:30:00</td>
                            <td>10:30:00</td>
                            <td> <button style="background-color: #5fc3ba !important;border-color:#5fc3ba !important;" data-bs-toggle="modal" data-bs-target="#edit_modal" class="btn text-white orange_btn" style="min-height: unset;width:unset !important;"><i class="fa fa-edit"></i> Edit</button> </td>
                        </tr>
                        <tr>
                            <td>02</td>
                            <td>Tuesday</td>
                            <td>05:30:00</td>
                            <td>10:30:00</td>
                            <td> <button style="background-color: #5fc3ba !important;border-color:#5fc3ba !important;" data-bs-toggle="modal" data-bs-target="#edit_modal" class="btn text-white orange_btn" style="min-height: unset;width:unset !important;"><i class="fa fa-edit"></i> Edit</button> </td>
                        </tr>
                        <tr>
                            <td>03</td>
                            <td>Wednesday</td>
                            <td>05:30:00</td>
                            <td>10:30:00</td>
                            <td> <button style="background-color: #5fc3ba !important;border-color:#5fc3ba !important;" data-bs-toggle="modal" data-bs-target="#edit_modal" class="btn text-white orange_btn" style="min-height: unset;width:unset !important;"><i class="fa fa-edit"></i> Edit</button> </td>
                        </tr>
                        <tr>
                            <td>04</td>
                            <td>Thursday</td>
                            <td>05:30:00</td>
                            <td>10:30:00</td>
                            <td> <button style="background-color: #5fc3ba !important;border-color:#5fc3ba !important;" data-bs-toggle="modal" data-bs-target="#edit_modal" class="btn text-white orange_btn" style="min-height: unset;width:unset !important;"><i class="fa fa-edit"></i> Edit</button> </td>
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