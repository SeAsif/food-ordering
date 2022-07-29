<?
$this->load->view("userfront/header_view_new");
?>
<style>
ui-state-hover {
    background: transparent !important;
    border-color: transparent !important;
}

.close {
    background: transparent !important;
    border: none !important;
}

.fontawesome-icon {
    font-family: 'FontAwesome';

}

.filter-cat-icons,
.content-cat-icon {
    color: #5DCACA;
}

.content-cat-icon {
    font-size: 20px;
}

.m-menu li:hover .filter-cat-icons {
    color: #fff;
}
</style>

<div class="full-height main-menu-bg-color">
    <!-- <div class="row my-row bg">
		<div class="main-container">
			<ul class="m-menu">
				<li class="active"><a href=""><i class="fas fa-bars"></i>All</a></li>
				<?
				foreach ($categories as  $key => $category) {
				?>
				<li><a href="#category-<?= $key ?>"><img width="100px" src='<?= !empty($category->category_icon) ? base_url('uploads/restaurant/category/') . $category->category_icon : base_url('images/fooditem.png') ?>' /><?= $category->category_name ?></a></li>
				<?
				}
				?>
			</ul>
		</div>
	</div> -->
    <style>
    @media only screen and (min-width:767px) {
        .mobile_image {
            display: none !important;
        }

        .desktop_image {
            display: block !important;
        }
    }

    @media only screen and (max-width:767px) {
        .mobile_image {
            display: block !important;
        }

        .desktop_image {
            display: none !important;
        }
    }
    </style>
    <div class="row banner">
        <div class="address_bar resturant-info-bar-background">
            <div class="content">
                <div class="info">
                    <!-- <label><?= $restaurantInfo["restaurant_name"] ?></label> -->
                    <p class="address returantinfo-heading-color"><i
                            class="fas fa-map-marker-alt returantinfo-heading-color"></i><?= $restaurantInfo["address"] ?>
                    </p>
                </div>
                <label class="more-info-txt-color" data-bs-toggle="modal" data-bs-target="#exampleModal">More Info <i
                        class="far fa-arrow-alt-circle-right more-info-txt-color"></i></label>
            </div>
        </div>
        <?php if (!empty($restaurantInfo["banner"])) { ?>
        <!-- allow_banner == "Yes" -->
        <img src="<?= base_url() . "uploads/restaurant/banner/" . $restaurantInfo["banner"] ?>"
            class="img-fluid desktop_image banner_img">
        <?php } else { ?>
        <img src="<?= base_url() ?>/images/restaurant_banner.png">
        <?php } ?>
        <?php if (!empty($restaurantInfo["mobile_banner"])) { ?>
        <!-- allow_banner == "Yes" -->
        <img src="<?= base_url() . "uploads/restaurant/banner/" . $restaurantInfo["mobile_banner"] ?>"
            class="img-fluid mobile_image banner_img">
        <?php } else { ?>
        <img src="<?= base_url() ?>/images/restaurant_banner.png" class="img-fluid mobile_image banner_img">
        <?php } ?>
    </div>
    <div class="slider-bg-color">
        <div class="main-container categories_slider">
            <div class="owl-carousel owl-theme">
                <?
				foreach ($categories as  $key => $category) {
				?>
                <div class="item">
                    <a href="#category-<?= $key ?>">
                        <img width="100px"
                            src='<?= !empty($category->category_icon) ? base_url('uploads/restaurant/category/') . $category->category_icon : base_url('images/fooditem.png') ?>' />
                        <span><?= $category->category_name ?></span>
                    </a>
                </div>
                <?
				}
				?>
            </div>
        </div>
    </div>
   <div class="scrollmenu main-menu-bg-color">
        <?php if (!empty($restaurantCoupons)) { ?>
            <?php foreach ($restaurantCoupons as $coupon) { ?>
                <?php if($coupon['customer_log'] == "Yes") { ?>
                    <?php if($this->session->userdata('id')!="") { ?>
                        <button class="btn primary-btn-bg-color primary-btn-text-color">
                            <?php 
                                $symbol = $coupon['discount_type'] == 'Naira' ? '₦' : '%';
                                echo 'Get '. $coupon['discount'].''.$symbol . ' off ('. $coupon['code'] . ')';
                            ?>
                        </button>
                    <?php } ?>
                <?php } else { ?>        
                    <button class="btn primary-btn-bg-color primary-btn-text-color">
                        <?php 
                            $symbol = $coupon['discount_type'] == 'Naira' ? '₦' : '%';
                            echo 'Get '. $coupon['discount'].''.$symbol . ' off ('. $coupon['code'] . ')';
                        ?>
                    </button>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>

	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content main-menu-bg-color" style="border-radius: 20px;">
				<div class="modal-header">
					<h5 class="modal-title category-text-color" id="exampleModalLabel"><?= $restaurantInfo["restaurant_name"] ?></h5>
					<button type="button" class="close_button" data-bs-dismiss="modal" aria-label="Close">
						<i class=" fa fa-lg fa-times category-text-color"></i>
					</button>
				</div>
				<div class="modal-body">
					<h3 class="menu-heading">About</h3>
					<p class="menu-sub-heading"><?= $restaurantInfo["restaurant_slogan"] ?> </p>

					<h3 class="menu-heading">Address</h3>
					<p class="menu-sub-heading"><?= $restaurantInfo["address"] ?></p>

					<h3 class="menu-heading">Timings</h3>
					<div class="table-responsive">
						<table class="table">
							<thead class="menu-sub-heading">
								<tr>
									<th scope="col">Day</th>
									<th scope="col">Start Time</th>
									<th scope="col">End Time</th>
								</tr>
							</thead>
							<tbody class="menu-sub-heading">
								<?

								foreach ($restaurantInfo['timings'] as $key => $timing) {
								?>
                                <tr>
                                    <td><?= $timing['day'] ?></td>
                                    <td><?= $timing['start'] ?></td>
                                    <td><?= $timing['end'] ?></td>
                                </tr>
                                <?
								}
								?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-container">
        <div class="food row">
            <?
			foreach ($categories as $key => $category) {
			?>
            <div class="burgers" id="category-<?= $key ?>">
                <!-- <div><?= !empty($category->category_icon) ? '<span class="fas fontawesome-icon content-cat-icon">&#x' . $category->category_icon . ';&nbsp;</span>' : '' ?></div> -->
                <label class="heading">
                    <span class="category-text-color main-menu-bg-color">
                        <?= $category->category_name ?>
                    </span>
                </label>
            </div>
            <div class="grid_row">
                <?
					foreach ($items as $item) {
						if ($item['category_name'] == $category->category_name) {
					?>
                <div class=" item" onclick="openItem(<?= $item["id"] ?>);">
                    <!-- <div class=" item" data-bs-toggle="modal" data-bs-target="#menuDetailInfo"> -->
                    <div class="item-img">
                        <?php if (isset($item["item_image"]) && !empty($item["item_image"])) { ?>
                        <img src="<?= base_url() . "uploads/restaurant/menuItems/" . $item["item_image"]; ?>">
                        <?php } else { ?>
                        <img src="<?= base_url() ?>/images/fooditem.png">
                        <?php } ?>
                    </div>
                    <div class="item-inner">
                        <label
                            class="item-h  menu-heading"><?= substr($item["item_name"], 0, 28) ?><?= strlen($item["item_name"]) > 28 ? '...' : '' ?></label>
                        <span class="menu-heading">₦<?= $item["item_price"] ?></span>
                        <p class="menu-sub-heading">
                            <?= substr($item["item_description"], 0, 50) ?><?= strlen($item["item_description"]) > 50 ? '...' : '' ?>
                        </p>
                    </div>
                </div>
                <?
						}
					}
					?>
            </div>
            <?
			}
			?>
        </div>
    </div>
</div>

<div class="modal fade" id="menuDetailInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="itemDetailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content main-menu-bg-color">
            <div class="modal-header">
                <h5 class="modal-title category-text-color" id="exampleModalLabel">Item Detail</h5>
                <button type="button" class="close_button" data-bs-dismiss="modal" aria-label="Close">
                    <i class=" fa fa-lg fa-times category-text-color"></i>
                </button>
            </div>
            <div class="modal-body">
                <iframe src="" id="itemDetailIframe" style="width: 100%;" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Start Menu Popups -->
<script language="javascript" src="<?= base_url() ?>js/frontfunctions.js"></script>
<script language="javascript">
var url = '<?= base_url() ?>userrestaurant/addtocart/';

function refreshItemPage() {
    document.location.href = document.location.href;
}

function proceedToCheckout() {
    document.location.href = '<?= base_url('userorder/checkout') ?>';
}

function openItem(nItemId) {
    itemId = nItemId;
    // var pageFrame = document.getElementById('itemIframe');
    var pageFrame = document.getElementById('itemDetailIframe');

    pageFrame.src = url + nItemId;

    $('#itemDetailModal').modal('show');

    // $('#dialog-message').dialog('open');
    return false;
}
</script>

<script type="text/javascript">
// $(function() {
// 	$("#flight_date").datepicker();
// });

$(function() {
    // Dialog	( Start Edit Variant Popup Window Here )
    // $('#dialog-message').dialog({
    // 	autoOpen: false,
    // 	modal: true,
    // 	width: 560
    // });

});
</script>

<!-- End Menu Popups -->

<!--................. Start Menu Tool Tip ..............-->
<link rel="stylesheet" href="<?= base_url() ?>css/jquery.tooltip.css" />
<script src="<?= base_url() ?>js/jquery.tooltip.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
    $('#set1 *').tooltip();
});

$(function() {
    $('#set2 *').tooltip();
});
</script>
<!--................. End Menu Tool Tip ..............-->


<!-- <script type="text/javascript" src="<?= base_url() ?>js/frontfunctions.js"></script> -->
<!-- Start Tool Tip -->

<!-- <script type="text/javascript" src="<?= base_url() ?>js/front/tipster.js"></script> -->
<!-- The data section you edit. Feel free to make this an external file too if you want. -->
<!--<script type="text/javascript">
var docTips = new TipObj('docTips');
with (docTips)
{

template = '<table cellpadding="1" cellspacing="0" width="%2%" border="0">' +
  '<tr><td><table cellpadding="3" cellspacing="0" width="100%" border="0">' +
  '<tr><td class="tipClass">%3%</td></tr></table></td></tr></table>';



 tips.view = new Array(14, 5, 40, 'Views');

}
	function showTips(price,item_name, item_detail )
	{
		docTips.tips.sitename = new Array(14, -2, 150, '<table width="368" border="0" cellpadding="1" cellspacing="0"><tbody><tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0"><tbody><tr><td class="tipClass toolTop" style="padding:18px 0px 20px 20px;">'+item_name+'<br /><h2>Basic Price: $'+price+'</h2><p>'+item_detail+'</p></td></tr></tbody></table></td></tr></tbody></table>');
		docTips.show('sitename');
	}
</script>-->

<!-- Start Tool Tip -->


<div id="docTipsLayer"
    style="position: absolute; z-index: 10000; visibility: hidden; left: 300px; top: 815px; width: auto; opacity: 0;">

</div>



<!-- <div class="crum-menu">
	<a href="<?= base_url() ?>home">Home</a><span>&gt;</span>
	<a href="<?= base_url() ?>usersearch/searchresult">Search Result</a><span>&gt;</span>
	Restaurant Menu
</div> -->
<div class="cont-wrap">
    <div class="rest-mid">

        <!-- Start Restaurant Menu and Cart -->
        <div class="rest-mid-cont">

            <!-- Start Left Cart Section -->

            <!-- End Restaurant Menu and Cart -->

        </div>
    </div>




    <?
	$this->load->view("userfront/footer_view");
	?>

    <script>
    jQuery(document).ready(function() {
        jQuery('.absolute_icon').click(function() {
            jQuery(".m-menu").animate({
                scrollLeft: 1000 + 5
            }, 800);
        });
    });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
        integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"
        integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA=="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"
        integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A=="
        crossorigin="anonymous" />
    <style>
    .owl-carousel .owl-nav.disabled {
        display: block !important;
    }
    </style>
    <script>
    jQuery('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        center: true,
        responsive: {
            0: {
                items: 2
            },
            450: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });
    </script>