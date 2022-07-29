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
    <h1>View Schedule</h1>
    <button class="btn orange_btn text-white" data-bs-toggle="modal" data-bs-target="#add_new_modal">Add New</button>
</div>
<div class="title_bar grid_roww">
    <input type='text' id='weeklyDatePicker' class="form-control" placeholder="Select Week" />
</div>
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
</style>
<div class="modal fade" id="add_new_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rink Santo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="day" class="for m-label">Select Role</label>
                        <select required class="form-select" id="day">
                            <option>Cock</option>
                            <option>Dishwasher</option>
                            <option>Sweepar</option>
                            <option>Guard</option>
                        </select>
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <input type="time" style="display: inline-block;width:30%;margin-right:4%;" class="form-control" name="starttime" id="starttime" aria-describedby="emailHelp">
                        <input type="time" style="display: inline-block;width:30%;" class="form-control" name="endtime" id="endtime" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Days</label>
                        <div class="radio_buttons">
                            <input type="radio" value="monday" id="monday" name="days" id="" class="radio">
                            <label for="monday">Mon</label>
                            <input type="radio" value="tuesday" id="tuesday" name="days" id="" class="radio">
                            <label for="tuesday">Tue</label>
                            <input type="radio" value="wednesday" id="wednesday" name="days" id="" class="radio">
                            <label for="wednesday">Wed</label>
                            <input type="radio" value="thursday" id="thursday" name="days" id="" class="radio">
                            <label for="thursday">Thu</label>
                            <input type="radio" value="friday" id="friday" name="days" id="" class="radio">
                            <label for="friday">Fri</label>
                            <input type="radio" value="saturday" id="saturday" name="days" id="" class="radio">
                            <label for="saturday">Sat</label>
                            <input type="radio" value="sunday" id="sunday" name="days" id="" class="radio">
                            <label for="sunday">Sun</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <textarea name="additional_notes" id="additional_notes" class="form-control" placeholder="Additional Notes" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="justify-content: flex-start;">
                    <button type="submit" class="btn btn-primary orange_btn text-white">Save</button>
                    <button type="cancle" class="btn btn-secondary  text-white">Cancle</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="title_bar content">
    <div class="card">
        <div class="card-body">

            <!-- <div id="calendar"></div> -->
            <div id="calendar1"></div>

        </div>
    </div>
</div>

<?
$this->load->view("restaurantportal/footer_view");
?>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous"></script> -->

<!-- <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.4.2/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timeline@4.4.2/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/resource-common@4.4.2/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/resource-timeline@4.4.2/main.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.4.2/main.min.css" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/timeline@4.4.2/main.min.css" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/resource-timeline@4.4.2/main.min.css" crossorigin="anonymous" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.6.0/main.min.js" crossorigin="anonymous"></script> -->

<!-- <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.4.2/main.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timeline@4.4.2/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/resource-common@4.4.2/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/resource-timeline@4.4.2/main.min.js"></script>
<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.4.2/main.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/timeline@4.4.2/main.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/resource-timeline@4.4.2/main.min.css"> -->


<link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.5.0/fullcalendar.min.css' rel='stylesheet' />
<link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar-scheduler/1.1.0/scheduler.css' rel='stylesheet' />
<script src='http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js'></script>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.5.0/fullcalendar.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar-scheduler/1.1.0/scheduler.js'></script>


<!-- <script>

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['resourceTimeline'],
            header: {
                left: 'today prev,next',
                center: 'title',
                right: 'resourceTimelineDay,resourceTimelineWeek'
            },

            defaultView: 'customWeek',
            views: {
                customWeek: {
                    type: 'timeline',
                    duration: {
                        weeks: 1
                    },
                    slotDuration: {
                        days: 1
                    },
                    buttonText: 'Custom Week'
                }
            },

            defaultView: 'resourceTimelineDay',
            resources: [{
                "id": "a",
                "title": "Auditorium A"
            }, {
                "id": "b",
                "title": "Auditorium B"
            }, {
                "id": "c",
                "title": "Auditorium C"
            }, {
                "id": "d",
                "title": "Auditorium D"
            }, {
                "id": "e",
                "title": "Auditorium E"
            }, {
                "id": "f",
                "title": "Auditorium F"
            }, {
                "id": "g",
                "title": "Auditorium G"
            }, {
                "id": "h",
                "title": "Auditorium H"
            }, {
                "id": "i",
                "title": "Auditorium I"
            }, {
                "id": "j",
                "title": "Auditorium J"
            }, {
                "id": "k",
                "title": "Auditorium K"
            }, {
                "id": "l",
                "title": "Auditorium L"
            }, {
                "id": "m",
                "title": "Auditorium M"
            }, {
                "id": "n",
                "title": "Auditorium N"
            }, {
                "id": "o",
                "title": "Auditorium O"
            }, {
                "id": "p",
                "title": "Auditorium P"
            }, {
                "id": "q",
                "title": "Auditorium Q"
            }, {
                "id": "r",
                "title": "Auditorium R"
            }, {
                "id": "s",
                "title": "Auditorium S"
            }, {
                "id": "t",
                "title": "Auditorium T"
            }, {
                "id": "u",
                "title": "Auditorium U"
            }, {
                "id": "v",
                "title": "Auditorium V"
            }, {
                "id": "w",
                "title": "Auditorium W"
            }, {
                "id": "x",
                "title": "Auditorium X"
            }, {
                "id": "y",
                "title": "Auditorium Y"
            }, {
                "id": "z",
                "title": "Auditorium Z"
            }],

            resourceRender: function(info) {
                var image = document.createElement('img');
                image.src = 'https://www.gstatic.com/images/branding/product/2x/photos_96dp.png';
                image.width = 40;
                info.el.querySelector('.fc-expander-space')
                    .prepend(image);
                var date = document.createElement('span');
                date.innerText = '24 Hrs';
                info.el.querySelector('.fc-cell-text')
                    .append(date);
            }
        });

        calendar.render();
    });

</script> -->

<script>
    $(function() { // document ready

        $('#calendar1').fullCalendar({
            resourceAreaWidth: 230,
            now: '2015-08-07',
            editable: true,
            aspectRatio: 1.5,
            scrollTime: '00:00',
            header: {
                left: 'promptResource today prev,next',
                center: 'title',
                right: 'Week'
            },
            // resourceRender: function(info) {
            //     var image = document.createElement('img');
            //     image.src = 'https://www.gstatic.com/images/branding/product/2x/photos_96dp.png';
            //     image.width = 40;
            //     $('.fc-expander-space')
            //         .prepend(image);
            //     var date = document.createElement('span');
            //     date.innerText = '24 Hrs';
            //     $('.fc-cell-text')
            //         .append(date);
            // },
            firstDay: 1,
            defaultView: 'Week',
            views: {
                Week: {
                    type: 'timeline',
                    duration: {
                        weeks: 1
                    },
                    slotDuration: {
                        days: 1
                    },
                    buttonText: 'Week'
                }
            },
            resourceLabelText: ' ',
            resources: [{
                    id: 'v',
                    title: 'Auditorium V'
                },
                {
                    id: 'w',
                    title: 'Auditorium W'
                },
                {
                    id: 'x',
                    title: 'Auditorium X'
                },
                {
                    id: 'y',
                    title: 'Auditorium Y'
                },
                {
                    id: 'z',
                    title: 'Auditorium Z'
                }
            ],
            events: [{
                    id: '1',
                    resourceId: 'b',
                    start: '2015-08-07T02:00:00',
                    end: '2015-08-07T07:00:00',
                    title: 'event 1'
                }, {
                    id: '4',
                    resourceId: 'e',
                    start: '2015-08-07T03:00:00',
                    end: '2015-08-07T08:00:00',
                    title: 'event 4'
                },
                {
                    id: '5',
                    resourceId: 'f',
                    start: '2015-08-07T00:30:00',
                    end: '2015-08-07T02:30:00',
                    title: 'event 5'
                }
            ]
        });

    });
</script>