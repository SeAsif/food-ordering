<?
   $this->load->view("restaurantportal/header_view");
   $this->load->view("restaurantportal/sidepanel_view");
   ?>
<?
$this->load->view("restaurantportal/top_bar");
?>


<div class="title_bar title_bar_adj">
    <h1>All Reports</h1>
</div>
<div class="tabs_padding">
    <div class="row">
        <div class="col-xs-12">
            <div>
                <ul class="nav nav-tabs ">
                    <li class="nav-item active">
                        <a href="#home" class="nav-link   anchor_color" data-toggle="tab">Overview</a>
                    </li>
                    <li class="nav-item">
                        <a href="#sales" class="nav-link anchor_color" data-toggle="tab">Sales</a>
                    </li>
                    <li class="nav-item">
                        <a href="#order_history" class="nav-link anchor_color" data-toggle="tab">Order History</a>
                    </li>
                    <li class="nav-item">
                        <a href="#customers" class="nav-link anchor_color" data-toggle="tab">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a href="#loyality" class="nav-link anchor_color" data-toggle="tab">Loyality and Rewards</a>
                    </li>
                </ul>

                <div class="tab-content tabs_background">
                    <div class="tab-pane fade show active" id="home">
                        <div class="tabs_padding">
                            <div class="card card_width mb-4 cards_tab_setting">
                                <div class="card-header" style="background-color: transparent;font-weight: 500;">
                                    Select Date
                                </div>
                                <div class="card-body p-3">
                                    <form class="row row-cols-lg-auto g-3 align-items-center">
                                        <div class="col-sm-12 col-md-6 date_input_width">
                                            <label class="" for=" inlineFormInputGroupUsername">Start Date</label>
                                            <input type="date" class="form-control " id="inlineFormInputGroupUsername"
                                                placeholder="Username">
                                        </div>

                                        <div class="col-sm-12 col-md-6 date_input_width">
                                            <label class="" for="inlineFormSelectPref">End Date</label>
                                            <input type="date" class="form-control " id="inlineFormInputGroupUsername"
                                                placeholder="Username">
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <button type="submit" class="btn default_orange_button"
                                                style="margin-top:20px;width:auto !important">show</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card card_width mb-4 cards_tab_setting">
                                <div class="card-header" style="background-color: transparent;font-weight: 500;">
                                    Report Based on Location Overview
                                </div>
                                <div class="card-body p-3">
                                    <div class="table-responsive">
                                        <table class="table table_tr_border table_layout_auto">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Location</th>
                                                    <th scope="col"># of Orders</th>
                                                    <th scope="col">Average Subtotal</th>
                                                    <th scope="col">Average Total</th>
                                                    <th scope="col">Delivery Charges</th>
                                                    <th scope="col">Taxes</th>
                                                    <th scope="col">Subtotal</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>

                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="text_center">No Data Available</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show " id="customers">
                        <div class="tabs_padding">
                            <div class="card card_width mb-4 cards_tab_setting">
                                <div class="card-header flex_header_card "
                                    style="background-color: transparent;font-weight: 500;">
                                    <span>Select Date</span>
                                    <button type="submit" class="btn default_orange_button" style="">Download
                                        CSV</button>
                                </div>
                                <div class="card-body p-3">
                                    <form class="row row-cols-lg-auto g-3 align-items-center">
                                        <div class="col-12 date_input_width">
                                            <label class="" for=" inlineFormInputGroupUsername">Start Date</label>
                                            <input type="date" class="form-control " id="inlineFormInputGroupUsername"
                                                placeholder="Username">
                                        </div>

                                        <div class="col-12 date_input_width">
                                            <label class="" for="inlineFormSelectPref">End Date</label>
                                            <input type="date" class="form-control " id="inlineFormInputGroupUsername"
                                                placeholder="Username">
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn default_orange_button"
                                                style="margin-top:20px;width:auto !important">show</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card card_width mb-4 cards_tab_setting">
                                <div class="card-header" style="background-color: transparent;font-weight: 500;">
                                    Report Based on 0 registered customers
                                </div>
                                <div class="card-body p-3">
                                    <div class="table-responsive">
                                        <table class="table table_tr_border table_layout_auto">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Customer ID</th>
                                                    <th scope="col">First Name</th>
                                                    <th scope="col">Last Name</th>
                                                    <th scope="col">Order Count</th>
                                                    <th scope="col">Average Spent</th>
                                                    <th scope="col">Total Spent</th>
                                                    <th scope="col">Last Order</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        <p class="text_center">No Data Available</p>
                                        <div class=" flex-columns flex-setting">
                                            <div class="inline_block_adj show_rows_adj">
                                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Show Rows
                                                    :</label>
                                                <select class="custom-select my-1 show_rows_count"
                                                    id="inlineFormCustomSelectPref">
                                                    <option selected>30</option>
                                                    <option value="1">50</option>
                                                    <option value="2">60</option>
                                                    <option value="3">70</option>
                                                </select>
                                            </div>
                                            <div class="show_rows_adj pagination_top">
                                                <nav aria-label="Page navigation example ">
                                                    <ul class="pagination">
                                                        <li class="page-item "><a class="page-link active"
                                                                href="#">Prev</a></li>
                                                        <li class="page-item active"><a class="page-link" href="#">1</a>
                                                        </li>
                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">Next</a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show " id="order_history">
                        <div class="tabs_padding">
                            <div class="card card_width mb-4 cards_tab_setting">
                                <div class="card-header flex_header_card "
                                    style="background-color: transparent;font-weight: 500;">
                                    <span>Select Date</span>

                                </div>
                                <div class="card-body p-3">
                                    <form class="row row-cols-lg-auto g-3 align-items-center">
                                        <div class="col-12  tabs_padding new_input_width">
                                            <label class="" for=" inlineFormInputGroupUsername">From</label>
                                            <input type="date" class="form-control " id="inlineFormInputGroupUsername"
                                                placeholder="Username">
                                        </div>

                                        <div class="col-12 tabs_padding new_input_width">
                                            <label class="" for="inlineFormSelectPref">To</label>
                                            <input type="date" class="form-control " id="inlineFormInputGroupUsername"
                                                placeholder="Username">
                                        </div>
                                        <div class="col-sm-12 full_width ">
                                            <label class="" for="inlineFormSelectPref">Order type</label>
                                            <select class="form-control " disabled aria-label="Default select example">
                                                <option selected>All</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-12 full_width file_coloumn">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-sm-12 col-md-4 col-lg-2 col-xl-2">
                                                    <p>Export Report</p>
                                                </div>
                                                <div class="col-sm-12 col-md-3 col-lg-2 col-xl-1  export_files_margin">
                                                    <div class="d-flex align-items-center">
                                                        <span class="export_file_font"><i
                                                                class="fas fa-file-pdf pdf_file_icon"></i></span> <span
                                                            class="file_text_border">PDF</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-3 col-lg-2 col-xl-1">
                                                    <div class="d-flex align-items-center"><span
                                                            class="export_file_font"><i
                                                                class="fas fa-file-csv csv_file_icon"></i></span> <span
                                                            class="file_text_border">CSV</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 full_width">
                                            <button type="submit" class="btn default_orange_button" style="">
                                                Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card card_width mb-4 cards_tab_setting">
                                <div class="card-header" style="background-color: transparent;font-weight: 500;">
                                    History
                                </div>
                                <div class="card-body p-3">
                                    <div class="table-responsive">
                                        <table class="table table_tr_border table_layout_auto">
                                            <thead>
                                                <tr>
                                                    <th scope="col"># Order</th>
                                                    <th scope="col">Customer Name</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Due On</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Actions</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>

                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="text_center">Select period to view orders</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show " id="sales">
                        <div class="tabs_padding">
                            <div class="card card_width mb-4 cards_tab_setting">
                                <div class="card-header flex_header_card "
                                    style="background-color: transparent;font-weight: 500;">
                                    <span>Select Date</span>

                                </div>
                                <div class="card-body p-3">
                                    <form class="row row-cols-lg-auto g-3 align-items-center">
                                        <div class="col-12 date_input_width">
                                            <label class="" for=" inlineFormInputGroupUsername">Start Date</label>
                                            <input type="date" class="form-control " id="inlineFormInputGroupUsername"
                                                placeholder="Username">
                                        </div>

                                        <div class="col-12 date_input_width">
                                            <label class="" for="inlineFormSelectPref">End Date</label>
                                            <input type="date" class="form-control " id="inlineFormInputGroupUsername"
                                                placeholder="Username">
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn default_orange_button"
                                                style="margin-top:20px;width:auto !important">show</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card card_width mb-4 cards_tab_setting">
                                <div class="card-header" style="background-color: transparent;font-weight: 500;">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-9">
                                            <span> For Past Year </span>
                                        </div>
                                        <div class="col-sm-12 col-md-3">
                                            <select class="form-select select_adjustment"
                                                aria-label="Default select example">
                                                <option selected>Monthly</option>
                                                <option value="1">Yearly</option>
                                                <option value="2">Weekly</option>
                                                <option value="3">Daily</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-sm-12 flex_row">
                                            <figure class="highcharts-figure">
                                                <div id="container"></div>
                                                <p class="highcharts-description">

                                                </p>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card_width mb-4 cards_tab_setting">
                                <div class="card-header" style="background-color: transparent;font-weight: 500;">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <span> Order Type </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-sm-12 flex_row">
                                            <figure class="highcharts-figure">
                                                <div id="pie_container"></div>
                                                <p class="highcharts-description">

                                                </p>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show " id="loyality">
                        <div class="tabs_padding">
                            <div class="card card_width mb-4 cards_tab_setting">
                                <div class="card-header  " style="background-color: transparent;font-weight: 500;">
                                    <span>Select Date</span>

                                </div>
                                <div class="card-body p-3">
                                    <form class="row row-cols-lg-auto g-3 align-items-center">
                                        <div class="col-12 date_input_width">
                                            <label class="" for=" inlineFormInputGroupUsername">Start Date</label>
                                            <input type="date" class="form-control " id="inlineFormInputGroupUsername"
                                                placeholder="Username">
                                        </div>

                                        <div class="col-12 date_input_width">
                                            <label class="" for="inlineFormSelectPref">End Date</label>
                                            <input type="date" class="form-control " id="inlineFormInputGroupUsername"
                                                placeholder="Username">
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn default_orange_button"
                                                style="margin-top:20px;width:auto !important">show</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card card_width mb-4 cards_tab_setting">
                                <div class="card-header flex_header_card "
                                    style="background-color: transparent;font-weight: 500;">
                                    <span>Report based on Loyality Overview</span>
                                    <button type="submit" class="btn default_orange_button" style="">Download
                                        CSV</button>
                                </div>
                                <div class="card-body p-3">
                                    <div class="table-responsive">
                                        <table class="table table_tr_border table_layout_auto">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Location</th>
                                                    <th scope="col">#Enrolled into Loyality</th>
                                                    <th scope="col">Points Earned</th>
                                                    <th scope="col">Points Used</th>
                                                    <th scope="col">Points Available</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>

                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="text_center">No Data Available</p>

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
<?
   $this->load->view("restaurantportal/footer_view");
   ?>
<script>
jQuery(".nav-tabs li a").click(function() {
    setTimeout(() => {
        if (jQuery(".nav-tabs li:first-child").hasClass("active")) {
            jQuery(".tab-content").addClass("tabs_background");
            jQuery(".tab-content").removeClass("tabs_custome");
        } else {
            jQuery(".tab-content").removeClass("tabs_background");
            jQuery(".tab-content").addClass("tabs_custome");
        }
    }, 200);
});
</script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
Highcharts.chart('container', {
    title: {
        text: ''
    },
    exporting: {
        enabled: false
    },
    credits: {
        enabled: false
    },


    yAxis: {
        title: {
            text: ''
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: false
            },
            enableMouseTracking: false
        }
    },

    series: [{
        data: [1.3, 2, 2.2, 2, 3, 3.3, 3.6, 3.9, 4, 5]
    }, ],

    xAxis: {
        categories: ['6/2020', '7/2020', '8/2020', '9/2020', '10/2020', '11/2020', '12/2020', '1/2021',
            '2/2021', '3/2021'
        ]
    },


    responsive: {

        rules: [{
            condition: {
                maxWidth: 700
            },
            chartOptions: {
                legend: {

                }
            }
        }]
    }

});
Highcharts.chart('pie_container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    credits: {
        enabled: false
    },

    exporting: {
        enabled: false
    },
    title: {
        text: ''
    },
    exporting: {
        enabled: false
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    legend: {
        layout: 'horizontal',
        align: 'center',
        verticalAlign: 'top',
        enabled: true,
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Order Type',
        colorByPoint: true,
        data: [{
            name: 'Curboids',
            y: 35,
            color: "#1F77B4"
        }, {
            name: 'Delivery',
            y: 25,
            color: "#FF7F0E"
        }, {
            name: 'Dine-in',
            y: 25,
            color: "#D62728"
        }, {
            name: 'Dine-in',
            y: 15,
            color: "#2CA02C"
        }, ]
    }]
});
</script>