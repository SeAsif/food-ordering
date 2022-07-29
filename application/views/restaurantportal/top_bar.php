<div class="title_bar pt-0 pb-0">
    <nav class="navbar navbar-expand-md  p-0">
        <span class="bar_adj" onclick="mycollapsFunction()"><i class="fas fa-bars btn_icon"></i></span>
        <ul class="ul_style mb-0">
            <!-- <li class="border_set"><i class="far fa-bell"></i><span class="badge">3</span></li> -->
            <?php if ($this->session->userdata('restaurant')) { ?>
            <li style="width:250px"><a target="_blank"
                    href="<?= base_url('m/'). urlencode($this->session->userdata('restaurant')['restaurant_name']) ?>"
                    class="btn  btn_adj">Create Order</a>
            </li>
            <?php } ?>
            <?php if ($this->session->userdata('type') == 'employee') { ?>
                <li style="width:250px"><a target="_blank"
                    href="<?= base_url('m/'). urlencode($restaurant['restaurant_name']) ?>"
                    class="btn  btn_adj">Create Order</a>
                </li>
            <?php } ?>
            <li><?= $this->session->userdata('fullname') ?></li>
            <li class=""> <span class="user_icon_adj"><i class="fas fa-user-friends "></i></span></li>
            <li class=""><a class="logouot" href="<?= base_url().'restaurantsettings/logout' ?>">Log out</a></i></li>
            <li class="">
                <div class="dropdown">

                    <span id="dropdownMenuButton1" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-v"
                            aria-hidden="true"></i></span>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                        <li class="li_item_setting"><a class="dropdown-item " href="#">Select Location</a></li>

                        <li class="li_item_setting"><a class="dropdown-item " href="#">Logout</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</div>