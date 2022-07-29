
<div class="rest-menu">
    <a href="<?=base_url()."userrestaurant/restaurantmenu/".?>" <?=($activemenu=="restaurantmenu")?'class="selected"':""?>>
    	<span title="Our Menu">Our Menu</span>
    </a>
    <a href="<?=base_url()."userrestaurant/restaurantinfo"?>" <?=($activemenu=="restaurantinfo")?'class="selected"':""?>>
    	<span title="Our Restaurant">Our Restaurant</span>
    </a>
    <a href="<?=base_url()."userrestaurant/reviews"?>" <?=($activemenu=="reviews")?'class="selected"':""?>>
    	<span title="Reviews">Reviews</span>
    </a>
</div>
