
<div class="rest-menu">
    <a href="<?=base_url()."userfavorites/favoritemenu"?>" <?=($activemenu=="favoritemenu")?'class="selected"':""?>>
    	<span title="Favorite Menu">Favorite Menu</span>
    </a>
    <a href="<?=base_url()."userfavorites/favoriterestaurant"?>" <?=($activemenu=="favoriterestaurant")?'class="selected"':""?>>
    	<span title="Favorite Resturant">Favorite Restaurant</span>
    </a>
    <a href="<?=base_url()."userfavorites/favoriteorder"?>" <?=($activemenu=="favoriteorder")?'class="selected"':""?>>
    	<span title="Favorite Orders">Favorite Orders</span>
    </a>
</div>
