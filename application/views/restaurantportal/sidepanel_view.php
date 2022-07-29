<div class="left_sidebar ">
    <div class="navbar">
        <i class="fas fa-bars closing-bars btn_icon"></i>
        <img src="<?= base_url() . 'images/new_logo.png'; ?>" srcset="<?= base_url() . 'images/new_logo@2x.png'; ?>"
            class="img-fluid " alt="">
        <ul class="header_leftsidebar_list">
            <?php if ($this->session->userdata('restaurant')) { ?>
            <li class="nav-item">
                <a class="nav-link <?= ($activemenu == "dashboard") ? 'active' : "" ?>" aria-current="page"
                    href="<?= base_url() . "dashboard" ?>">
                    <img src="<?php echo base_url() . '/images/dashboard.png'; ?>"
                        srcset="<?php echo base_url() . '/images/dashboard@2x.png'; ?>" alt="">
                    <span>Dashboard</span>
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
            <?php } ?>

            <?php if ($this->session->userdata('restaurant')) { ?>
            <li class="nav-item">
                <a class="nav-link submenuheader first" href="#">
                    <img src="<?php echo base_url() . '/images/food.png'; ?>"
                        srcset="<?php echo base_url() . '/images/food@2x.png'; ?>" alt="">
                    <span>Restaurant Info</span><i class="fas fa-chevron-right"></i>
                </a>
                <div class="submenu">
                    <ul>
                        <li><a href="<?= base_url() . "restaurantsettings/basicinfo" ?>"
                                <?= ($activemenu == "basicinfo") ? 'class="active"' : "" ?>><span>Basic Info</span></a>
                        </li>
                        <li><a href="<?= base_url() . "restaurantsettings/basicfeatures" ?>"
                                <?= ($activemenu == "basicfeatures") ? 'class="active"' : "" ?>><span>Basic
                                    Features</span></a></li>
                        <li><a href="<?= base_url() . "restaurantsettings/logoslogan" ?>"
                                <?= ($activemenu == "logoslogan") ? 'class="active"' : "" ?>><span>Logo/
                                    Slogan</span></a></li>
                        <li><a href="<?= base_url() . "restaurantsettings/mapandlocation" ?>"
                                <?= ($activemenu == "mapandlocation") ? 'class="active"' : "" ?>><span>Address</span></a>
                        </li>
                        <li><a href="<?= base_url() . "restauranttimings/operetionalhours" ?>"
                                <?= ($activemenu == "operetionalhours") ? 'class="active"' : "" ?>><span>Opening
                                    Hours</span></a></li>
                    </ul>
                </div>
            </li>
            <?php } ?>

            <?php if ($this->session->userdata('restaurant')) { ?>
            <li class="nav-item">
                <a class="nav-link submenuheader" href="#">
                    <img src="<?php echo base_url() . '/images/menu.png'; ?>"
                        srcset="<?php echo base_url() . '/images/menu@2x.png'; ?>" alt="">
                    <span>Menu</span><i class="fas fa-chevron-right"></i>
                </a>

                <div class="submenu">
                    <ul>
                        <li><a href="<?= base_url() . "restaurantcategory/managefoodcategories" ?>"
                                <?= ($activemenu == "managefoodcategories") ? 'class="active"' : "" ?>><span>Manage Food
                                    Categories</span></a></li>
                        <li><a href="<?= base_url() . "restaurantitem/managefooditems" ?>"
                                <?= ($activemenu == "managefooditems") ? 'class="active"' : "" ?>><span>Manage Food
                                    Items</span></a></li>
                        <li><a href="<?= base_url() . "restaurantvariant/variantitems" ?>"
                                <?= ($activemenu == "variantitems") ? 'class="active"' : "" ?>><span>Manage Food
                                    Variants</span></a></li>
                        <!-- <li><a href="<?= base_url() . "menutimings/menutiming" ?>" <?= ($activemenu == "menutiming") ? 'class="active"' : "" ?>>Menu Timings</a></li> -->
                    </ul>
                </div>
            </li>
            <?php } ?>

            <li class="nav-item">
                <a class="nav-link submenuheader" href="#">
                    <img src="<?php echo base_url() . '/images/iconss/Staff.png'; ?>" alt="">
                    <span>Staff</span><i class="fas fa-chevron-right"></i>
                </a>

                <div class="submenu">
                    <ul>
                        <?php if ($this->session->userdata('restaurant')) { ?>
                        <li><a href="<?= base_url() . "restaurantstaff" ?>"
                                <?= ($activemenu == "restaurant_staff") ? 'class="active"' : "" ?>><span>Restaurant
                                    Staff</span></a></li>
                        <li><a href="<?= base_url() . "staffhours" ?>"
                                <?= ($activemenu == "staffhours") ? 'class="active"' : "" ?>><span>Staff
                                    Hours</span></a></li>
                        <li><a href="<?= base_url() . "staffpayroll" ?>"
                                <?= ($activemenu == "staffpayroll") ? 'class="active"' : "" ?>><span>Payroll</span></a>
                        </li>
                        <?php } ?>
                        <?php if ($this->session->userdata('type') == 'employee') { ?>
                        <li><a href="<?= base_url() . "StaffTracking" ?>"
                                <?= ($activemenu == "stafftracking") ? 'class="active"' : "" ?>><span>Time
                                    Tracking</span></a></li>
                        <li><a href="<?= base_url() . "StaffTracking/myschedule" ?>"
                                <?= ($activemenu == "myschedule") ? 'class="active"' : "" ?>><span>My
                                    Schedule</span></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </li>

            <?php if ($this->session->userdata('restaurant')) { ?>
            <li class="nav-item">
                <a class="nav-link submenuheader first" href="#">
                    <img src="<?php echo base_url() . '/images/map.png'; ?>"
                        srcset="<?php echo base_url() . '/images/map.png'; ?>" alt="">
                    <span>Locations</span><i class="fas fa-chevron-right"></i>
                </a>

                <div class="submenu">
                    <ul>
                        <li><a href="<?= base_url() . "restaurantlocation" ?>"
                                <?= ($activemenu == "manage_location") ? 'class="active"' : "" ?>><span>Location</span></a>
                        </li>
                        <li><a href="<?= base_url() . "restaurantdepartment" ?>"
                                <?= ($activemenu == "manage_department") ? 'class="active"' : "" ?>><span>Department</span></a>
                        </li>
                        <li><a href="<?= base_url() . "restaurantroles" ?>"
                                <?= ($activemenu == "manage_role") ? 'class="active"' : "" ?>><span>Role</span></a></li>
                    </ul>
                </div>
            </li>
            <?php } ?>

            <?php if ($this->session->userdata('restaurant')) { ?>
            <li class="nav-item">
                <a class="nav-link <?= ($activemenu == "schedule") ? 'active' : "" ?>"
                    href="<?= base_url("staffhours/schedule"); ?>">
                    <img src="<?php echo base_url() . '/images/schedule.png'; ?>"
                        srcset="<?php echo base_url() . '/images/schedule.png'; ?>" alt="">
                    <span>Schedule</span>
                </a>
            </li>
            <?php } ?>

            <?php if ($this->session->userdata('restaurant')) { ?>
            <li class="nav-item">
                <a class="nav-link <?= ($activemenu == "print_qr_code") ? 'active' : "" ?>"
                    href="<?= base_url() . "restaurantorders/generate_qr_code" ?>">
                    <img src="<?php echo base_url() . '/images/print.png'; ?>"
                        srcset="<?php echo base_url() . '/images/print@2x.png'; ?>" alt="">
                    <span>Print QR Code</span>
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
            <?php } ?>

            <?php if ($this->session->userdata('restaurant')) { ?>
            <li class="nav-item">
                <a class="nav-link submenuheader" href="#">
                    <img src="<?php echo base_url() . '/images/setting.png'; ?>"
                        srcset="<?php echo base_url() . '/images/setting@2x.png'; ?>" alt="">
                    <span>Settings</span><i class="fas fa-chevron-right"></i>
                </a>

                <div class="submenu">
                    <ul>
                        <li><a href="<?= base_url() . "restaurantsettings/changepassword" ?>"
                                <?= ($activemenu == "changepassword") ? 'class="active"' : "" ?>><span>Account</span></a>
                        </li>
                        <li><a href="<?= base_url() . "restaurantsettings/notification_settings" ?>"
                                <?= ($activemenu == "notification_settings") ? 'class="active"' : "" ?>><span>Notification</span></a>
                        </li>
                        <li><a href="<?= base_url() . "designsettings/theme_setting" ?>"
                                <?= ($activemenu == "theme_setting") ? 'class="active"' : "" ?>><span>Theme</span></a>
                        </li>

                        <li><a href="<?= base_url("subscription") ?>"
                                <?= ($activemenu == "subscription") ? 'class="active"' : "" ?>><span>Subscription</span></a>
                        </li>

                        <li><a href="<?= base_url() . "restaurantsettings/paymentgateway" ?>"
                                <?= ($activemenu == "paymentgateway") ? 'class="active"' : "" ?>><span>Payment
                                    Gateway</span></a></li>
                    </ul>
                </div>
            </li>
            <?php } ?>

            <?php if ($this->session->userdata('restaurant')) { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() . "restaurantorders/allorder" ?>">
                    <img src="<?php echo base_url() . '/images/monthly.png'; ?>"
                        srcset="<?php echo base_url() . '/images/monthly@2x.png'; ?>" alt="">
                    <span>Monthly Statements</span>
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
            <?php } ?>

            <?php if ($this->session->userdata('restaurant')) { ?>
            <li class="nav-item">
                <a class="nav-link submenuheader" href="#">
                    <img src="<?php echo base_url() . '/images/iconss/Revenue-Tools.png'; ?>" alt="">
                    <span>Marketing Tools</span><i class="fas fa-chevron-right"></i>
                </a>

                <div class="submenu">
                    <ul>
                        <?php if ($this->session->userdata('restaurant')) { ?>

	                        <li><a href="<?= base_url() . "marketingtools/coupons" ?>"
	                                <?= ($activemenu == "coupons") ? 'class="active"' : "" ?>><span>Coupons</span></a>
	                        </li>
	                        <li><a href="<?=  base_url() . "marketingtools/email_automations" ?>"
	                                <?= ($activemenu == "email_automations") ? 'class="active"' : "" ?>><span>Email
	                                    Automations</span></a></li>
	                        <li><a href="<?= base_url('marketingtools') . "/rewards" ?>"
	                                <?= ($activemenu == "rewards") ? 'class="active"' : "" ?>><span>Rewards</span></a>
	                        </li>

							<li><a href="<?= base_url('marketingtools') . "/broadcaster" ?>"
	                                <?= ($activemenu == "broadcasting") ? 'class="active"' : "" ?>><span>Broadcaster</span></a>
	                        </li>

                        <?php } ?>

                        <!-- <li><a href="<?= base_url("subscription") ?>" <?= ($activemenu == "subscription") ? 'class="active"' : "" ?>><span>Subscription</span></a></li> -->

                        <!-- <li><a href="<?= base_url() . "restaurantsettings/paymentgateway" ?>" <?= ($activemenu == "paymentgateway") ? 'class="active"' : "" ?>><span>Payment Gateway</span></a></li> -->
                    </ul>
                </div>
            </li>
            <?php } ?>

            <?php if ($this->session->userdata('restaurant')) { ?>
            <li class="nav-item">
                <a class="nav-link <?= ($activemenu == "manager_log_book") ? 'active' : "" ?>"
                    href="<?= base_url() . "managerlogbook/list" ?>">
                    <img src="<?php echo base_url() . '/images/iconss/Manager-Log-Book.png'; ?>" alt="">
                    <span>Manager Log Book</span>
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
            <?php } ?>

            <?php if ($this->session->userdata('restaurant')) { ?>
            <li class="nav-item">
                <a class="nav-link <?= ($activemenu == "reporting") ? 'active' : "" ?>"
                    href="<?= base_url() . "reporting" ?>">
                    <img src="<?php echo base_url() . '/images/reporting.png'; ?>"
                        srcset="<?php echo base_url() . '/images/reporting.png'; ?>" alt="">
                    <span>Reporting</span>
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
            <?php } ?>

            <!-- <?php if ($this->session->userdata('restaurant')) { ?>
				<li class="nav-item">

					<a class="nav-link <?= ($activemenu == "coupons") ? 'active' : "" ?>" href="<?= base_url() . "coupons" ?>">
						<img src="<?php echo base_url() . '/images/print.png'; ?>" srcset="<?php echo base_url() . '/images/print@2x.png'; ?>" alt="">
						<span>Coupons</span>
						<i class="fas fa-chevron-right"></i>
					</a>
				</li>
			<?php } ?> -->

            <!-- <?php if ($this->session->userdata('restaurant')) { ?>
				<li class="nav-item">
					<a class="nav-link <?= ($activemenu == "addcoupons") ? 'active' : "" ?>" href="<?= base_url() . "coupons/addcoupoun" ?>">
						<img src="<?php echo base_url() . '/images/print.png'; ?>" srcset="<?php echo base_url() . '/images/print@2x.png'; ?>" alt="">
						<span>Add Coupoun</span>
						<i class="fas fa-chevron-right"></i>
					</a>
				</li>
			<?php } ?> -->

            <!-- <?php if ($this->session->userdata('restaurant')) { ?>
				<li class="nav-item">
					<a class="nav-link <?= ($activemenu == "automations") ? 'active' : "" ?>" href="<?= base_url() . "mailserver" ?>">
						<img src="<?php echo base_url() . '/images/print.png'; ?>" srcset="<?php echo base_url() . '/images/print@2x.png'; ?>" alt="">
						<span>Email Automation</span>
						<i class="fas fa-chevron-right"></i>
					</a>
				</li>
			<?php } ?>

			<?php if ($this->session->userdata('restaurant')) { ?>
				<li class="nav-item">
					<a class="nav-link <?= ($activemenu == "addcoupons") ? 'active' : "" ?>" href="<?= base_url() . "mailserver/addcampaign" ?>">
						<img src="<?php echo base_url() . '/images/print.png'; ?>" srcset="<?php echo base_url() . '/images/print@2x.png'; ?>" alt="">
						<span>Add Campaign</span>
						<i class="fas fa-chevron-right"></i>
					</a>
				</li>
			<?php } ?>

			<?php if ($this->session->userdata('restaurant')) { ?>
				<li>
					<a class="nav-link <?= ($activemenu == "broadcaster") ? 'active' : "" ?>" href="<?= base_url() . "broadcaster/list" ?>">
						<img src="<?php echo base_url() . '/images/print.png'; ?>" srcset="<?php echo base_url() . '/images/print@2x.png'; ?>" alt="">
						<span>Broadcaster</span>
						<i class="fas fa-chevron-right"></i>
					</a>
				</li>
			<?php } ?> -->

            <!-- <li class="nav-item">
				<a class="nav-link <?= ($activemenu == "coupons") ? 'active' : "" ?>" href="<?= base_url() . "coupons" ?>">
					<img src="<?php echo base_url() . '/images/print.png'; ?>" srcset="<?php echo base_url() . '/images/print@2x.png'; ?>" alt="">
					<span>Coupons</span>
					<i class="fas fa-chevron-right"></i>
				</a>
			</li> -->
            <!-- <li class="nav-item">
				<a class="nav-link <?= ($activemenu == "addcoupons") ? 'active' : "" ?>" href="<?= base_url() . "coupons/addcoupoun" ?>">
					<img src="<?php echo base_url() . '/images/print.png'; ?>" srcset="<?php echo base_url() . '/images/print@2x.png'; ?>" alt="">
					<span>Add Coupoun</span>
					<i class="fas fa-chevron-right"></i>
				</a>
			</li> -->
            <!-- <li class="nav-item">
				<a class="nav-link <?= ($activemenu == "automations") ? 'active' : "" ?>" href="<?= base_url() . "mailserver" ?>">
					<img src="<?php echo base_url() . '/images/print.png'; ?>" srcset="<?php echo base_url() . '/images/print@2x.png'; ?>" alt="">
					<span>Email Automation</span>
					<i class="fas fa-chevron-right"></i>
				</a>
			</li> -->
            <!-- <li class="nav-item">
				<a class="nav-link <?= ($activemenu == "addcoupons") ? 'active' : "" ?>" href="<?= base_url() . "mailserver/addcampaign" ?>">
					<img src="<?php echo base_url() . '/images/print.png'; ?>" srcset="<?php echo base_url() . '/images/print@2x.png'; ?>" alt="">
					<span>Add Campaign</span>
					<i class="fas fa-chevron-right"></i>
				</a>
			</li> -->


            <!-- <li class="nav-item">
				<a class="nav-link" href="<?= base_url() . "restaurantsettings/changepassword" ?>">
					
						<img src="<?php echo base_url() . '/images/setting.png'; ?>" srcset="<?php echo base_url() . '/images/setting@2x.png'; ?>" alt="">
					
					<span>Account Settings</span>
					<i class="fas fa-chevron-right"></i>
				</a>
			</li> -->
            <!-- Manage Location Phase 2 -->

            <!-- <li class="nav-item">
				<a class="nav-link" href="#">
					<span>
						<img src="<?php echo base_url() . '/images/custom_order.png'; ?>" srcset="<?php echo base_url() . '/images/custom_order@2x.png'; ?>" alt="">
					</span>
					Custom Order</a>
			</li> -->
        </ul>
    </div>
    <!-- End Mid Left -->
</div>
<div class="right_sidebar">
    <script type="text/javascript">
    /*/////////////Far-jquery///////////////*/
    jQuery(document).ready(function() {
        jQuery('i.fas.fa-bars.btn_icon').click(function() {

            jQuery('.img-fluid').css('display', 'block');

            if (window.matchMedia('(max-width: 767px)').matches) {
                jQuery('.nav-item').css('display', 'block');
            }

        });
        jQuery('.closing-bars').click(function() {

            jQuery('.grid_row').removeClass('new_grid_row');

            if (window.matchMedia('(max-width: 767px)').matches) {
                jQuery('.nav-item').css('display', 'none');
                jQuery('.img-fluid').css('display', 'none');
            }

        });
    });

    /*//////////////////////////////////////*/
    </script>