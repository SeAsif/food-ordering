
<div class="rest-menu" style="width:929px;">
    <a href="<?=base_url();?>usersearch/searchresult" <?=($isfavorite=="No" || is_numeric($isfavorite))?'class="selected"':''?>>
    	<span title="All Restaurants">All Restaurants<!-- (12)--></span>
    </a>
    <?
    if ($this->session->userdata('id'))
	{
	?>
    <a href="<?=base_url();?>usersearch/searchresult/Yes" <?=($isfavorite=="Yes")?'class="selected"':''?>>
    	<span title="Favorite Restaurants">Favorite Restaurants<!-- (1)--></span>
    </a>
    <?
    }
	else
	{
	?>
	<a href="javascript:void(null);" onclick="openSign(0);">
    	<span title="Favorite Restaurants">Favorite Restaurants<!-- (1)--></span>
    </a>    
    <?
	}
	?>
</div>