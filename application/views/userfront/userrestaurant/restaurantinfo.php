<?
$this->load->view("userfront/header_view");
?>

<script type="text/javascript" src="<?= base_url() ?>js/frontfunctions.js"></script>

<div class="crum-menu">
	<a href="<?= base_url() ?>home">Home</a><span>&gt;</span>
	<a href="<?= base_url() ?>usersearch/searchresult">Search Result</a><span>&gt;</span>
	Restaurant Info
</div>
<div class="cont-wrap">
	<div class="cont-round"><img src="<?= base_url() ?>images/front/rest-top.jpg" alt="top" border="0" /></div>
	<div class="rest-mid">

		<?
		//print_r ($restaurantInfo);
		$this->load->view("userfront/userrestaurant/restaurant_header");
		?>

		<!-- Start Restaurant Food Navigation Bar -->
		<div class="food-menu font11">
			<?
			if ($restaurantInfo["take_out"] == "Yes") {
			?>
				<a href="#" title="Take Out" class="takeout">Take Out</a>
				<!--          <span><img src="<?= base_url() ?>images/front/take-out.png" alt="take out" /></span> -->
			<?
			}
			if ($restaurantInfo["dine_in"] == "Yes") {
			?>
				<a href="#" title="Dine Inn" class="dine-inn">Dine In</a>
				<!--        <span><img src="<?= base_url() ?>images/front/dine-inn.png" alt="dine in" /></span> -->
			<?
			}
			if ($restaurantInfo["legal_sea_food"] == "Yes") {
			?>
				<a href="#" title="Legal Sea Food" class="seafood">Legal Sea Food</a>
				<!--   <span><img src="<?= base_url() ?>images/front/sea-food.png" alt="sea food" /></span> -->
			<?
			}
			if ($restaurantInfo["location_security"] == "Post") {
			?>
				<!-- <a href="#" title="Post Security" class="post-security">Post Security</a> -->
				<!--     <span><img src="<?= base_url() ?>images/front/post-security.png" alt="post security" /></span> -->
			<?
			}
			if ($restaurantInfo["location_security"] == "Pre") {
			?>
				<!-- <a href="#" title="Pre Security" class="pre-security">Pre Security</a> -->
				<!--     <span><img src="<?= base_url() ?>images/front/pre-security.jpg" alt="pre security" /></span> -->
			<?
			} ?>
			<!-- <a href="#" title="Pre Security" class="proximity">Proximity</a> -->
			<!-- &nbsp;&nbsp;<?= $restaurantInfo["proximity_to_gate"] ?>(m) -->
		</div>
		<!-- End Restaurant Food Navigation Bar -->

		<!-- Start Restaurant Content, Map and Image -->
		<div class="rest-mid-cont">
			<h2>About Us</h2>
			<div class="mid-cont-txt">
				<p><?= $restaurantInfo["restaurant_details"] ?></p>
			</div>
			<div class="mid-cont-img"><img src="<?= base_url() ?>images/front/rest-img.jpg" alt="img" /></div><br class="clear" />
			<h2>Location</h2>
			<?
			//					$x	=	round($restaurantInfo["coordinate_x1"]+($restaurantInfo["width"]/2));
			//					$y	=	round($restaurantInfo["coordinate_y1"]+($restaurantInfo["height"]/2));
			$x	=	$restaurantInfo["coordinate_x1"];
			$y	=	$restaurantInfo["coordinate_y1"] - 20;
			?>
			<span class="map-address"><?= $restaurantInfo["address"] ?></span>


			<div class="rest-map">
				<!-- <div class="srch-map">
                            <div class="map-baloon" style="top:<?= $y ?>px; left:<?= $x ?>px; z-index:1">
                                <a href="javascript:void(null)" onclick="$('#tooltip').show(); this.className='selected'"></a>
                            </div>
							<div id="map"></div>
                        </div> -->
				<iframe width="930" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?
q=<?= $restaurantInfo["address"] ?>&key=AIzaSyB4VW8c9meKlW7gUydZ74W4l7S7lnedgFM"></iframe>
				<div class="popup" id="tooltip" style="display:none;">
					<a href="javascript:void(null)" onclick="$('#tooltip').hide();" title="Close" class="closebtn">
						<img src="<?= base_url() ?>images/front/closebtn.jpg" alt="take out" border="0" />
					</a>
					<h2><?= $restaurantInfo["restaurant_name"] ?><br /></h2>
					<p><?= $restaurantInfo["restaurant_details"] ?></p>
					<?
					if ($restaurantInfo["take_out"] == "Yes") {
					?>
						<a href="#" title="Take Out">
							<img src="<?= base_url() ?>images/front/take-out.png" alt="take out" border="0" />
						</a>
					<?
					}
					if ($restaurantInfo["legal_sea_food"] == "Yes") {
					?>
						<a href="#" title="Sea Food" style="margin-top:3px;">
							<img src="<?= base_url() ?>images/front/sea-food.png" alt="sea food" border="0" />
						</a>
					<?
					}
					if ($restaurantInfo["dine_in"] == "Yes") {
					?>
						<a href="#" title="Dine Inn">
							<img src="<?= base_url() ?>images/front/dine-inn.png" alt="dine inn" border="0" />
						</a>
					<?
					}
					if ($restaurantInfo["location_security"] == "Post") {
					?>
						<a href="#" title="Post Security">
							<img src="<?= base_url() ?>images/front/post-security.png" alt="post security" border="0" />
						</a>
					<?
					}
					if ($restaurantInfo["location_security"] == "Pre") {
					?>
						<a href="#" title="Pre Security">
							<img src="<?= base_url() ?>images/front/pre-security.jpg" alt="post security" border="0" />
						</a>
					<?
					}
					?>
					<a href="#" title="Proximity">
						<img src="<?= base_url() ?>images/front/proximity.png" alt="proximity" border="0" class="float-left" />
						&nbsp;&nbsp;<?= $restaurantInfo["proximity_to_gate"] ?>
					</a>
				</div>
			</div>
		</div>
		<!-- End Restaurant Content, Map and Image -->
	</div>
	<div class="cont-round"><img src="<?= base_url() ?>images/front/rest-bottom.jpg" alt="top" border="0" /></div>
</div>
<!-- <script>
function myMap() {
var mapProp= {
  center:new google.maps.LatLng(51.508742,-0.120850),
  zoom:5,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4VW8c9meKlW7gUydZ74W4l7S7lnedgFM&callback=myMap"></script>
	    	 -->
<?
$this->load->view("userfront/footer_view");
?>