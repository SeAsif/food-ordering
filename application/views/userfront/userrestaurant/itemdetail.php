
	<h4 class="menu-heading"><?=$itemDetail["item_name"]?></h4>
    <br />
	<h5 class="menu-heading">Price: <strong>₦ <?=$itemDetail["item_price"]?></strong></h5>
    <p class="menu-sub-heading"><?=$itemDetail["item_description"]?></p>
    
    <div class="extraCont menu-heading">
   
        <?
		foreach($menuitemdetail as $item){
		?>
        	<?=$item["group_name"]?> &nbsp;
            <?=$item["name"]?> (₦ <?=$item["price"]?>)
        
			 <br />	
        <?
        }?>    
        <div class="extraWrap">
            <h1 class="menu-heading">Special Instructions</h1>
          <p class="menu-sub-heading"><?=($cartItem[0]["instructions"]!="")?$cartItem[0]["instructions"]:"N/A"?></p>
        </div>
    </div>
    
    <div class="extraWrap">
        <h1 class="menu-heading">Quantity: <span><?=$cartItem[0]["quantity"]?></span></h1>
    </div>
</div>


</div>
